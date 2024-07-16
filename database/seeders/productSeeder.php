<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'name'=> 'Sản phẩm 1',
            'price'=> '12000',
            'image'=>'Không có',
            'product_category'=>'2',
            'quanlity'=>'10',
            'short_description'=>'ádasdsad',
            'description'=>'ádasdsad',
            'created_at'=> date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s'),
        ]);

        $faker = Factory::create();
        for($i = 1; $i<=10;$i++){
            DB::table('products')->insert([
                'name'=> 'Sản phẩm '.rand(1,10),
                'price'=> rand(10000,1000000),
                'image'=>'Không có',
                'product_category'=>rand(2,17),
                'quanlity'=>rand(1,100),
                'short_description'=>$faker->sentence,
                'description'=>$faker->sentence,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),
            ]);
    }
}
}
