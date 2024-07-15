<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blogs')->insert([
            'title'=> 'Tiêu đề 1',
            'short_description'=> 'zklxcj',
            'image'=>'Không có',
            'description'=>'đasad',
            'views'=>'1',
            'blog_id'=> '1',
            'user_id'=> '4',
            'comment_id'=>1,
            'created_at'=> date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s'),
        ]);

        $faker = Factory::create();
        for($i = 1; $i<=10;$i++){
            DB::table('blogs')->insert([
                'title'=> 'Tiêu đề '.rand(2,10),
                'short_description'=> $faker->text,
                'image'=>'Không có',
                'description'=>$faker->text,
                'views'=>rand(0,100),
                'blog_id'=> rand(0,10),
                'user_id'=>rand(4,14),
                'comment_id'=>rand(1,19),
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s'),
            ]);
    }
}
}
