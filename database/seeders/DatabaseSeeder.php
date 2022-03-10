<?php

namespace Database\Seeders;

use App\Models\Block;
use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Project::factory()->count(10)->has(Block::factory()->count(3))->create();
        User::factory(5)->create();
        $this->call([
            RolesTableSeeder::class,
        ]);

        $projects = Project::all()->pluck('id');

        foreach ($projects as $project) {
            $roles = Role::all()->pluck('id');
            foreach ($roles as $role) {
                $users = User::all()->random(1)->pluck('id');
                foreach ($users as $user){
                    \DB::table('project_user_role')->insert([
                        [
                            'project_id' => $project,
                            'user_id' =>  $user,
                            'role_id' => $role,
                        ]
                    ]);
                }
            }
        }
    }
}
