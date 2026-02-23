<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\PlanFeature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //
        $features = [
            Str::slug('Auction 1 Month Data'),
            Str::slug('Dashoard Access'),
        ];
              
        if (Feature::doesntExist()) {
            foreach ($features as $key => $value) {
                $feature = Feature::create(['name' => $value]);
                PlanFeature::create(['plan_id' => 1,'feature_id' => $feature->id]);
            }
        }


    }


}
