<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications_list', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('notifications_list')->insert([
            ['name' => 'Auction Activity'],
            ['name' => 'New Auction Finder Alerts'],
            ['name' => 'Upcoming Auction Reminder'],
            ['name' => 'Auction Result Published'],
            ['name' => 'Reauction Alerts'],
            ['name' => 'Auction Delays / Status Updates'],
            ['name' => 'Vehicle Tracking'],
            ['name' => 'Interest-Based Alerts'],
            ['name' => 'Scheduling'],
            ['name' => 'Auction Calendar Reminder'],
            ['name' => 'Daily/Weekly Auction Digest'],
            ['name' => 'System'],
            ['name' => 'Membership / Billing Updates'],
            ['name' => 'System Updates & News Features'],
            ['name' => 'Security Alerts'],
            ['name' => 'News Engagement'],
            ['name' => 'News & Blog Updates'],
            ['name' => 'Special Offers & Promotions'],
            ['name' => 'Survey & Feedback Requests'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications_list');
    }
};
