<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        DB::table('categories')->insert([
            'name' =>'胸'
            ]);
        
        DB::table('categories')->insert([
            'name' =>'背中'
            ]);
        
        DB::table('categories')->insert([
            'name' =>'肩'
            ]);
        
        DB::table('categories')->insert([
            'name' =>'腕'
            ]);
        
        DB::table('categories')->insert([
            'name' =>'脚'
            ]);
            
        DB::table('categories')->insert([
            'name' =>'腹'
            ]);
            
        $this->call([
            CategorySeeder::class
            ]);
    }
}
