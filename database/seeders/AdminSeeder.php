<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate([
            'email' => 'hongan0418@gmail.com'
        ], [
            'name' => 'captocviet',
            'password' => Hash::make('Ctv1234567890@'),
            'level' => 'admin', // hoặc role_id nếu dùng bảng roles
            'recipient' => 'tua',
        ]);
        User::updateOrCreate([
            'email' => 'nguyenvanhoangtam2556@gmail.com'
        ], [
            'name' => 'tamnvht',
            'password' => Hash::make('nvht1111'),
            'level' => 'admin', // hoặc role_id nếu dùng bảng roles
            'name_bank' => 'Vietcombank',
            'short_name' => 'VCB',
            'account_number' => '1024114566',
            'account_name' => 'Nguyễn Văn Hoàng Tâm',
            'recipient' => 'tam',
        ]);
        User::updateOrCreate([
            'email' => 'jennis@gmail.com'
        ], [
            'name' => 'admin',
            'password' => Hash::make('Ctv1234567890'),
            'level' => 'admin', // hoặc role_id nếu dùng bảng roles
            'recipient' => 'cha',
        ]);
    }
}
