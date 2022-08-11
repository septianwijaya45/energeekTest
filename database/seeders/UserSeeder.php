<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id'        => '1',
            'name'      => 'User',
            'email'     => 'user@user.com',
            'password'  => bcrypt('user'),
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ],);
    }
}
