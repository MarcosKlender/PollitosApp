<?php

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rols')->truncate();

        DB::table('rols')->insert([
            ['key' => 'admin', 'name' => 'Administrador', 'description' => 'Este rol tiene todos los privilegios sobre el sistema.', 'created_at' => Carbon::now()->toDateTimeString(), 'updated_at' => Carbon::now()->toDateTimeString()],
            ['key' => 'user', 'name' => 'Usuario Regular', 'description' => 'Este rol tiene privilegios limitados sobre el sistema.', 'created_at' => Carbon::now()->toDateTimeString(), 'updated_at' => Carbon::now()->toDateTimeString()],
        ]);

        DB::table('users')->truncate();

    	foreach (range(1,20) as $index) {
            DB::table('users')->insert([
                'rol_id' => 2,
                'name' => Str::random(10),
                'last_name' => Str::random(10),
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('password'),
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
                'active' => 1,
            ]);
        }
    }
}
