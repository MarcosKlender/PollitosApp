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
        ]);

        // TABLA USUARIOS
        DB::table('users')->truncate();

        // foreach (range(1,15) as $index) {
        //     DB::table('users')->insert([
        //         'rol_id' => 2,
        //         'username' => Str::random(10),
        //         'name' => Str::random(10),
        //         'last_name' => Str::random(10),
        //         'email' => Str::random(10).'@gmail.com',
        //         'password' => Hash::make('password'),
        //         'created_at' => Carbon::now()->toDateTimeString(),
        //         'updated_at' => Carbon::now()->toDateTimeString(),
        //         'active' => 1,
        //     ]);
        // }
        
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

        // TABLA PROVEEDORES
        DB::table('proveedores')->truncate();

        // foreach (range(1,15) as $index) {
        //     DB::table('proveedores')->insert([
        //         'tipo' => Str::random(3),
        //         'ruc_ci' => mt_rand(0000000000000, 9999999999999),
        //         'nombres' => Str::random(10),
        //         'razon_social' => Str::random(10),
        //         'direccion' => Str::random(10),
        //         'telefono' => Str::random(10),
        //         'movil' => Str::random(10),
        //         'email' => Str::random(10).'@gmail.com',
        //         'provincia' => Str::random(10),
        //         'ciudad' => Str::random(10),
        //         'parroquia' => Str::random(10),
        //         'created_at' => Carbon::now()->toDateTimeString(),
        //         'updated_at' => Carbon::now()->toDateTimeString(),
        //     ]);
        // }

        DB::table('proveedores')->insert([
            'tipo' => 'RUC',
            'ruc_ci' => '0000000000001',
            'nombres' => 'PRONACA SD',
            'razon_social' => 'PRONACA SANTO DOMINGO',
            'direccion' => Str::random(10),
            'telefono' => Str::random(10),
            'movil' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'provincia' => Str::random(10),
            'ciudad' => Str::random(10),
            'parroquia' => Str::random(10),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('proveedores')->insert([
            'tipo' => 'RUC',
            'ruc_ci' => '0000000000002',
            'nombres' => 'PRONACA UIO',
            'razon_social' => 'PRONACA QUITO',
            'direccion' => Str::random(10),
            'telefono' => Str::random(10),
            'movil' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'provincia' => Str::random(10),
            'ciudad' => Str::random(10),
            'parroquia' => Str::random(10),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('proveedores')->insert([
            'tipo' => 'RUC',
            'ruc_ci' => '0000000000003',
            'nombres' => 'PRONACA GYE',
            'razon_social' => 'PRONACA GUAYAQUIL',
            'direccion' => Str::random(10),
            'telefono' => Str::random(10),
            'movil' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'provincia' => Str::random(10),
            'ciudad' => Str::random(10),
            'parroquia' => Str::random(10),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('proveedores')->insert([
            'tipo' => 'CI',
            'ruc_ci' => '0000000001',
            'nombres' => 'DEIBY CORP',
            'razon_social' => 'DEIBY MOROCHO',
            'direccion' => Str::random(10),
            'telefono' => Str::random(10),
            'movil' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'provincia' => Str::random(10),
            'ciudad' => Str::random(10),
            'parroquia' => Str::random(10),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('proveedores')->insert([
            'tipo' => 'CI',
            'ruc_ci' => '0000000002',
            'nombres' => 'DANIA CORP',
            'razon_social' => 'DANIA MOROCHO',
            'direccion' => Str::random(10),
            'telefono' => Str::random(10),
            'movil' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'provincia' => Str::random(10),
            'ciudad' => Str::random(10),
            'parroquia' => Str::random(10),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        // TABLA LOTES
        DB::table('lotes')->truncate();

        // TABLA REGISTROS
        DB::table('registros')->truncate();
    }
}
