<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class user_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        user::create($this->userData());
        User::factory()->count(5)->create();
    }
    public function userData()
    {
return [
    'name' => 'Shalkamy',
    'email' => 'shalkamy@gmail.com',
    'password' => hash::make('2901ahmed'),
    'image'=>public_path('users/6399a4d27711a5ad2c9bf5cd_ben-sweet-2LowviVHZ-E-unsplash-1.jpeg'),
    'rule_id'=>1,

];
    }
}
