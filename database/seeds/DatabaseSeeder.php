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
            'rol_id' => 1,
            'username' => 'dmorocho',
            'name' => 'Deiby',
            'last_name' => 'Morocho',
            'email' => 'deibypi12@gmail.com',
            'password' => Hash::make('Dmorocho2020'),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
            'active' => 1,
        ]);

        // TABLA PROVEEDORES
        DB::table('proveedores')->truncate();

        DB::table('proveedores')->insert([
            'pro_ruc' => '1790319857001',
            'pro_nombre' => 'PRONACA',
            'pro_nombre_comercial' => 'PRONACA',
            'pro_telefonos' => Str::random(10),
            'pro_email' => Str::random(10).'@gmail.com',
            'pro_direccion' => Str::random(10),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('proveedores')->insert([
            'pro_ruc' => '1712005063001',
            'pro_nombre' => 'CEVALLOS INTRIAGO SUSANA PATRICIA',
            'pro_nombre_comercial' => 'IPROCA',
            'pro_telefonos' => Str::random(10),
            'pro_email' => Str::random(10).'@gmail.com',
            'pro_direccion' => Str::random(10),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('proveedores')->insert([
            'pro_ruc' => '1715947626001',
            'pro_nombre' => 'PEREZ ATIENCIA RAMIRO DARIO',
            'pro_nombre_comercial' => 'SERPEC',
            'pro_telefonos' => Str::random(10),
            'pro_email' => Str::random(10).'@gmail.com',
            'pro_direccion' => Str::random(10),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('proveedores')->insert([
            'pro_ruc' => '1791306961001',
            'pro_nombre' => 'AVICOLA VITALOA',
            'pro_nombre_comercial' => 'AVITALSA',
            'pro_telefonos' => Str::random(10),
            'pro_email' => Str::random(10).'@gmail.com',
            'pro_direccion' => Str::random(10),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('proveedores')->insert([
            'pro_ruc' => '0993211281001',
            'pro_nombre' => 'AVES Y COMESTIBLES',
            'pro_nombre_comercial' => 'AVES Y COMESTIBLES',
            'pro_telefonos' => Str::random(10),
            'pro_email' => Str::random(10).'@gmail.com',
            'pro_direccion' => Str::random(10),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('proveedores')->insert([
            'pro_ruc' => '1791294505001',
            'pro_nombre' => 'REPROIMAV',
            'pro_nombre_comercial' => 'REPROIMAV',
            'pro_telefonos' => Str::random(10),
            'pro_email' => Str::random(10).'@gmail.com',
            'pro_direccion' => Str::random(10),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('proveedores')->insert([
            'pro_ruc' => '2390017793001',
            'pro_nombre' => 'CORPROAVIC',
            'pro_nombre_comercial' => 'CORPROAVIC',
            'pro_telefonos' => Str::random(10),
            'pro_email' => Str::random(10).'@gmail.com',
            'pro_direccion' => Str::random(10),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('proveedores')->insert([
            'pro_ruc' => '1718632589001',
            'pro_nombre' => 'GAROFALO JIMENEZ DORIS AIDA',
            'pro_nombre_comercial' => 'GAROFALO JIMENEZ DORIS AIDA',
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
