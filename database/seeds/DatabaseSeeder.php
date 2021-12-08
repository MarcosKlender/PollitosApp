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
        // TABLA ROLES
        DB::table('rols')->truncate();

        DB::table('rols')->insert([
            ['key' => 'admin', 'name' => 'Administrador', 'description' => 'Este rol tiene todos los privilegios sobre el sistema.', 'created_at' => Carbon::now()->toDateTimeString(), 'updated_at' => Carbon::now()->toDateTimeString()],
            ['key' => 'user', 'name' => 'Usuario Regular', 'description' => 'Este rol tiene privilegios limitados sobre el sistema.', 'created_at' => Carbon::now()->toDateTimeString(), 'updated_at' => Carbon::now()->toDateTimeString()],
            ['key' => 'oper', 'name' => 'Operador', 'description' => 'Este rol tiene privilegios adicionales sobre el sistema.', 'created_at' => Carbon::now()->toDateTimeString(), 'updated_at' => Carbon::now()->toDateTimeString()],
        ]);

        // TABLA USUARIOS
        DB::table('users')->truncate();
        
        DB::table('users')->insert([
            'rol_id' => 1,
            'username' => 'mcarrasco',
            'name' => 'Marcos',
            'last_name' => 'Carrasco',
            'email' => 'marcos@gmail.com',
            'password' => Hash::make('Ecuador2020'),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
            'active' => 1,
        ]);

        DB::table('users')->insert([
            'rol_id' => 2,
            'username' => 'kcarrasco',
            'name' => 'Klender',
            'last_name' => 'Carrasco',
            'email' => 'klender@gmail.com',
            'password' => Hash::make('Ecuador2020'),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
            'active' => 1,
        ]);

        DB::table('users')->insert([
            'rol_id' => 3,
            'username' => 'dmorocho',
            'name' => 'Deiby',
            'last_name' => 'Morocho',
            'email' => 'deiby@gmail.com',
            'password' => Hash::make('Ecuador2020'),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
            'active' => 1,
        ]);

        // TABLA PROVEEDORES
        DB::table('proveedores')->truncate();

        DB::table('proveedores')->insert([
            'pro_ruc' => '0000000000001',
            'pro_nombre' => 'PRONACA SD',
            'pro_nombre_comercial' => 'PRONACA SANTO DOMINGO',
            'pro_telefonos' => Str::random(10),
            'pro_email' => Str::random(10).'@gmail.com',
            'pro_direccion' => Str::random(10),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        // TABLA LOTES
        DB::table('lotes')->truncate();

        // TABLA REGISTROS
        DB::table('registros')->truncate();
    }
}
