<?php

namespace App\Http\Controllers\Api\Master;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TicketController extends Controller
{

    public function index(Request $request)
    {
        $search  = $request->search;
        $perPage = $request->per_page ?? 10;
        $page    = $request->page ?? 1;

        $query = Ticket::with('user.latestMembership');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('issue_topic', 'like', "%{$search}%")
                ->orWhereHas('user', function ($u) use ($search) {
                    $u->where('firstName', 'like', "%{$search}%");
                });
            });
        }

        $tickets = $query->latest()->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            "success"    => true,
            "recordsTotal"      => $tickets->total(),
            "per_page"   => $tickets->perPage(),
            "offset"     => ($tickets->currentPage() - 1) * $tickets->perPage(),
            "last_page"  => $tickets->lastPage(),
            "data"       => $tickets->items(),
        ]);
    }
    public function show($id)
    {
        $ticket = Ticket::with('replies.user')->findOrFail($id);

        if(!$ticket){
                return response()->json([
                    'message' => 'Record Not Found',
                ], 422);
        }

        return response()->json([
                'message' => 'Record Updated Successfully',
                'data' => $ticket
        ],200);
    }

    public function reply(Request $request, $id)
    {

        $request->validate([
            'message' => 'nullable|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:1048',
        ]);

        $ticket = Ticket::findOrFail($id);

        $attachmentPath = null;

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');

            $filename = time() . '__ff__' . $file->getClientOriginalName();
            $file->move(public_path('uploads/tickets'), $filename);
            $attachmentPath = $filename;
        }

        $reply = TicketReply::create([
            'ticket_id' => $ticket->id,
            'user_id' => auth()->id(),
            'is_admin' => 1, 
            'message' => $request->message ?? '',
            'attachment' => $attachmentPath,
        ]);



        return response()->json([
            'success' => true,
            'message' => 'Reply sent successfully.',
            'data' => $reply->load('user') 
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $ticket->update([
            'status'    => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Ticket updated successfully.',
            'data' => $ticket
        ]);
    }
    public function updatePriority(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $ticket->update([
            'priority'    => $request->priority,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Ticket updated successfully.',
            'data' => $ticket
        ]);
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return response()->json([
            'success' => true,
            'message' => 'Ticket deleted successfully.'
        ]);
    }
}