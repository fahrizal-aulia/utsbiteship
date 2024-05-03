<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Brands;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name'=>'Aulia Rachman',
            'email'=>'iwul@gmail.com',
            'password'=>bcrypt('12345')
    ]);
        User::factory(10)->create();

        Brands::create([
            'product_brand'=>'Brand A',
            'status'=>'Active',
    ]);
        Brands::create([
            'product_brand'=>'Brand B',
            'status'=>'Active',
    ]);
        Brands::create([
            'product_brand'=>'Brand C',
            'status'=>'Active',
    ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
