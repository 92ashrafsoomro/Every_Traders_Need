<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Support\Facades\Auth;
use DataTables;

class TicketUserApiController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            "issue_topic" => "required|string",
            "issue_type"  => "required|string",
            "details"     => "required|string",
            "attachment"  => "nullable|file|max:2048",
        ]);

        $user = Auth::user();

        $ticket = Ticket::create([
            "user_id"     => $user->id,
            "user_name"   => $user->firstName . " " . $user->surname,
            "issue_topic" => $request->issue_topic,
            "issue_type"  => $request->issue_type,
            "details"     => $request->details,
            "priority"    => 'Low',
            "status"      => 0,
            "attachment"  => null,
            "response"    => 1,
        ]);

        if ($request->hasFile('attachment')) {
            $fileName = time().'__ticket__'.$request->file('attachment')->getClientOriginalName();
            $request->file('attachment')->move(public_path('uploads/tickets'), $fileName);
            $ticket->update(['attachment' => $fileName]);
        }

        return response()->json([
            "success" => true,
            "message" => "Ticket submitted successfully",
            "data"    => $ticket
        ]);
    }


    public function index(Request $request)
    {
        $user = Auth::user();

        $search  = $request->search;
        $perPage = $request->per_page ?? 10;

        $query = Ticket::where("user_id", $user->id);

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where("issue_topic", "like", "%{$search}%")
                  ->orWhere("issue_type", "like", "%{$search}%");
            });
        }

        $tickets = $query->latest()->paginate($perPage);

        return response()->json([
            "success" => true,
            "recordsTotal" => $tickets->total(),
            "current_page" => $tickets->currentPage(),
            "last_page" => $tickets->lastPage(),
            "offset"     => ($tickets->currentPage() - 1) * $tickets->perPage(),
            "per_page" => $tickets->perPage(),
            "data" => $tickets->items(),
        ]);
    }


    public function show($id)
    {
        $ticket = Ticket::with("replies")
                    ->where("user_id", Auth::id())
                    ->findOrFail($id);

        return response()->json([
            "success" => true,
            "data"    => $ticket
        ]);
    }


    public function reply(Request $request, $ticket_id)
    {
        $request->validate([
            "message"    => "required|string",
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:1048',
        ]);

        $ticket = Ticket::where("user_id", Auth::id())
                        ->findOrFail($ticket_id);

        $attachmentPath = null;

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');

            $filename = time() . '__ff__' . $file->getClientOriginalName();
            $file->move(public_path('uploads/tickets'), $filename);
            $attachmentPath = $filename;
        }


        $reply = TicketReply::create([
            "ticket_id" => $ticket->id,
            "user_id"   => Auth::id(),
            "is_admin"  => 0,
            "message"   => $request->message,
            'attachment' => $attachmentPath,
        ]);

        return response()->json([
            "success" => true,
            "message" => "Reply submitted successfully",
            "data"    => $reply
        ]);
    }


    public function submitFeedback(Request $request, $id)
    {
        $ticket = Ticket::where("user_id", Auth::id())
                        ->findOrFail($id);

        // if ($ticket->status != 3) {
        //     return response()->json([
        //         "success" => false,
        //         "message" => "Feedback can only be submitted for closed tickets."
        //     ], 400);
        // }

        if (!is_null($ticket->feedback) || !is_null($ticket->rating)) {
            return response()->json([
                "success" => false,
                "message" => "Feedback already submitted."
            ], 400);
        }

        $request->validate([
            "rating"   => "required|integer|min:1|max:5",
            "feedback" => "required|string|max:1000",
        ]);

        $ticket->update([
            "rating"   => $request->rating,
            "feedback" => $request->feedback,
        ]);

        return response()->json([
            "success" => true,
            "message" => "Thank you for your feedback!",
            "data"    => $ticket
        ]);
    }
}
