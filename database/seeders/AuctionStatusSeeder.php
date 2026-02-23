<?php

namespace Database\Seeders;

use App\Models\AuctionStatus;
use App\Models\Feature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AuctionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Feature::doesntExist()) {
            Feature::insert([
                ['title' =>Str::slug('Auction 1 Month Data')],
            ]);
        }
    }


}
