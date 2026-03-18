<?php

namespace App\Services;

use App\Models\User;
use App\Models\Setting;
use App\Mail\NewsAndBlogNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class NewsAndBlogService
{

    public function sendNotification(string $title, string $messageContent)
    {
        $emails = $this->getNewsAndBlogUsersEmail();
        
        return $this->sendNewsAndBlogEmail($emails, $title, $messageContent);
    }

    private function getNewsAndBlogUsersEmail()
    {
        return User::whereIn('id', function($query) {
            $query->select('user_id')
                ->from('user_notification_settings')
                ->where('type', '17')
                ->where('email', 1);
        })
        ->whereNotNull('personalEmail') 
        ->where('personalEmail', '!=', '') 
        ->pluck('personalEmail')
        ->toArray();
    }

 
    private function sendNewsAndBlogEmail(array $emails, string $title, string $messageContent)
    {
        if (empty($emails)) {
            return false;
        }

        $settings = Setting::pluck('value', 'key')->toArray();

        $toEmail = $settings['email'] ?? array_shift($emails);

        try {
            Mail::to($toEmail)
                ->bcc($emails)
                ->send(new NewsAndBlogNotification($title, $messageContent, $settings));
            
            return true;
        } catch (\Exception $e) {
            \Log::error("NewsAndBlog Mail Failed: " . $e->getMessage());
            return false;
        }
    }
}