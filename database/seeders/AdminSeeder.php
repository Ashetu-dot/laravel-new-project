<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
     {
      Admin::create([
            'name' => 'Super Administrator',
            'email' => 'admin@localvendorfinder.com',
            'password' => Hash::make('admin123'),
            'mobile' => '+1234567890',
            'role' => 'super_admin',
            'status' => 'active',
        ]);

        $this->command->info('Default admin user created!');
        $this->command->info('Email: admin@localvendorfinder.com');
        $this->command->info('Password: admin123');
    }
}
