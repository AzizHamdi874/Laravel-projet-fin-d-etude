<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert(
            [
                'name'=>'Admin',
                'prenom'=>'Admin',
                'email'=>'admin@admin.com',
                'role'=>'admin',
                'password'=>Hash::make('admin'),
                'image'=>'',
                
                
            ]
        );
    }
}
