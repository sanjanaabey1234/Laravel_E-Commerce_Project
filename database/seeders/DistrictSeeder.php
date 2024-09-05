<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districts = [
            ['district_id' => 1, 'name' => 'Colombo', 'state' => 'Western', 'country' => 'Sri Lanka'],
            ['district_id' => 2, 'name' => 'Gampaha', 'state' => 'Western', 'country' => 'Sri Lanka'],
            ['district_id' => 3, 'name' => 'Kalutara', 'state' => 'Western', 'country' => 'Sri Lanka'],
            ['district_id' => 4, 'name' => 'Kandy', 'state' => 'Central', 'country' => 'Sri Lanka'],
            ['district_id' => 5, 'name' => 'Matale', 'state' => 'Central', 'country' => 'Sri Lanka'],
            ['district_id' => 6, 'name' => 'Nuwara Eliya', 'state' => 'Central', 'country' => 'Sri Lanka'],
            ['district_id' => 7, 'name' => 'Anuradhapura', 'state' => 'North Central', 'country' => 'Sri Lanka'],
            ['district_id' => 8, 'name' => 'Polonnaruwa', 'state' => 'North Central', 'country' => 'Sri Lanka'],
            ['district_id' => 9, 'name' => 'Kurunegala', 'state' => 'North Western', 'country' => 'Sri Lanka'],
            ['district_id' => 10, 'name' => 'Puttalam', 'state' => 'North Western', 'country' => 'Sri Lanka'],
            ['district_id' => 11, 'name' => 'Jaffna', 'state' => 'Northern', 'country' => 'Sri Lanka'],
            ['district_id' => 12, 'name' => 'Mannar', 'state' => 'Northern', 'country' => 'Sri Lanka'],
            ['district_id' => 13, 'name' => 'Vavuniya', 'state' => 'Northern', 'country' => 'Sri Lanka'],
            ['district_id' => 14, 'name' => 'Kilinochchi', 'state' => 'Northern', 'country' => 'Sri Lanka'],
            ['district_id' => 15, 'name' => 'Batticaloa', 'state' => 'Eastern', 'country' => 'Sri Lanka'],
            ['district_id' => 16, 'name' => 'Ampara', 'state' => 'Eastern', 'country' => 'Sri Lanka'],
            ['district_id' => 17, 'name' => 'Trincomalee', 'state' => 'Eastern', 'country' => 'Sri Lanka'],
            ['district_id' => 18, 'name' => 'Hambantota', 'state' => 'Southern', 'country' => 'Sri Lanka'],
            ['district_id' => 19, 'name' => 'Matara', 'state' => 'Southern', 'country' => 'Sri Lanka'],
            ['district_id' => 20, 'name' => 'Galle', 'state' => 'Southern', 'country' => 'Sri Lanka'],
            ['district_id' => 21, 'name' => 'Ratnapura', 'state' => 'Sabaragamuwa', 'country' => 'Sri Lanka'],
            ['district_id' => 22, 'name' => 'Kegalle', 'state' => 'Sabaragamuwa', 'country' => 'Sri Lanka'],
            ['district_id' => 23, 'name' => 'Mullaitivu', 'state' => 'Northern', 'country' => 'Sri Lanka'],
            ['district_id' => 24, 'name' => 'Polonnaruwa', 'state' => 'North Central', 'country' => 'Sri Lanka'],
            ['district_id' => 25, 'name' => 'Puttalam', 'state' => 'North Western', 'country' => 'Sri Lanka'],
        ];

        foreach ($districts as $district) {
            DB::table('districts')->insert($district);
        }
    }
}
