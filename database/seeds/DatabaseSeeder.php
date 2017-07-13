<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Developer::class, 50)->create();
        factory(App\Project::class, 60)->create();
        factory(App\Technology::class, 20)->create();

        $faker = Faker::create();
        foreach(range(1, 50) as $index)
        {
            DB::table('developer_technology')->insert([
                'developer_id' => $faker->unique()->numberBetween(1,50),
                'technology_id' => $faker->numberBetween(1, 20)
            ]);
        }

        for ($i = 1; $i <= 50; $i++) {
            DB::table('developer_project')->insert([
                'developer_id' => $i,
                'project_id' => $faker->numberBetween(1, 60)
            ]);
        }

        for ($i = 1; $i <= 50; $i++) {
            DB::table('project_technology')->insert([
                'project_id' => $i,
                'technology_id' => $faker->numberBetween(1, 20)
            ]);
        }
    }
}
