<?php

use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //通过 app() 方法来获取一个 Faker 容器 的实例，
        //并借助 randomElement 方法来取出用户 id 数组中的任意一个元素并赋值给微博的 user_id，
        //使得每个用户都拥有不同数量的微博。
        $user_ids = ['1', '2', '3'];
        $faker = app(Faker\Generator::class);
        $statuses = factory(\App\Models\Status::class)->times(100)->make()->each(function ($status) use ($faker, $user_ids) {
            $status->user_id = $faker->randomElement($user_ids);
        });
        \App\Models\Status::insert($statuses->toArray());
    }
}
