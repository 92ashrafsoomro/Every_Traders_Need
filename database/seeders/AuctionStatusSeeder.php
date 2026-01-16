<?php

namespace Database\Seeders;

use App\Models\AuctionStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuctionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //
        if(AuctionStatus::exists()) {
                AuctionStatus::insert([
                    ['title' => 'Draft', 'id' => 1],
                    ['title' => 'Planned',  'id' => 2],
                    ['title' => 'Confirm',  'id' => 3],
                    ['title' => 'In Progress',  'id' => 4],
                    ['title' => 'Done',  'id' => 5],
                    ['title' => 'Cancel',  'id' => 6],
                ]);
        }

    }
}
