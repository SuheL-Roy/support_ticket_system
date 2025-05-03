<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        DB::table('depart_ments')->insert([
            [
                'department_name' => 'Billing Support',             
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'department_name' => 'Technical Support',             
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'department_name' => 'Sales Support',             
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'department_name' => 'Others Support',             
                'created_at' => now(),
                'updated_at' => now(),
            ],
           
        ]);
    }
}
