<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\BannerSeeder;
use Database\Seeders\BlogCateSeeder;
use Database\Seeders\BlogSeeder;
use Database\Seeders\CommentSeeder;
use Database\Seeders\ContactSeeder;
use Database\Seeders\CouponSeeder;
use Database\Seeders\GroupSeeder;
use Database\Seeders\productCateSeeder;
use Database\Seeders\productSeeder;
use Database\Seeders\UserSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(BlogSeeder::class);
        // $this->call(CommentSeeder::class);
        // $this->call(ContactSeeder::class);
        // $this->call(BannerSeeder::class);
        // $this->call(productSeeder::class);
        // $this->call(CouponSeeder::class);    
        // $this->call(UserSeeder::class);
        // $this->call(GroupSeeder::class);
        // $this->call(productCateSeeder::class);
        // $this->call(BlogCateSeeder::class);
    }
}
