<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id'=>'1',
            'staff_id'=>'SuperAdmin',
            'name'=>'Super Admin',
            'email'=>'superadmin@utmspace.edu.my',
            'password'=>Hash::make('superadmin123'),
            'role_id'=>'1',
        ]);
        DB::table('users')->insert([
            'id'=>'2',
            'staff_id'=>'Admin',
            'name'=>'Admin',
            'email'=>'admin@utmspace.edu.my',
            'password'=>Hash::make('admin'),
            'role_id'=>'2',
        ]);
        DB::table('users')->insert([
            'id'=>'3',
            'staff_id'=>'Alice123',
            'name'=>'Alice',
            'email'=>'alice@utmspace.edu.my',
            'password'=>Hash::make('alice'),
            'role_id'=>'3',
        ]);
        DB::table('users')->insert([
            'id'=>'4',
            'staff_id'=>'Bob123',
            'name'=>'Bob',
            'email'=>'bob@utmspace.edu.my',
            'password'=>Hash::make('bob'),
            'role_id'=>'3',
        ]);
        DB::table('users')->insert([
            'id'=>'5',
            'staff_id'=>'Ali123',
            'name'=>'Ali',
            'email'=>'ali@utmspace.edu.my',
            'password'=>Hash::make('ali'),
            'role_id'=>'3',
        ]);

        DB::table('roles')->insert([
        	'name'=>'SuperAdmin',
        ]);

        DB::table('roles')->insert([
        	'name'=>'Admin',
        ]);

        DB::table('roles')->insert([
        	'name'=>'Staff',
        ]);

        DB::table('centers')->insert([
            'code'=>'01',
        	'name'=>'JB',
        ]);

        DB::table('centers')->insert([
            'code'=>'02',
        	'name'=>'KL',
        ]);

        DB::table('file_statuses')->insert([
            'id'=>'1',
        	'name'=>'AVAILABLE',
        ]);

        DB::table('file_statuses')->insert([
            'id'=>'2',
        	'name'=>'UNAVAILABLE',
        ]);

        DB::table('file_statuses')->insert([
            'id'=>'3',
        	'name'=>'CLOSED',
        ]);

        DB::table('file_statuses')->insert([
            'id'=>'4',
        	'name'=>'BOOKED',
        ]);

    }
}
