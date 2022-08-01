<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=\App\Models\User::create(
            [
                'first_name'=>'super ',
                'last_name'=>'admin',
                'email'=>'super@2admins.com',
                'password'=>bcrypt('12345'),
                'username'=>'80020197',
                'role'=>'super_admin'

            ]
        );
        Admin::create([

            'phone'=>'01148077556',
                'account_id'=>$user->id
            ]
        );
$user->attachRole('super_admin');
        //
    }
}
