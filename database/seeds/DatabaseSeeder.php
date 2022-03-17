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
            ['key' => 'ingresos', 'name' => 'Ingresos', 'description' => 'Este rol tiene acceso a PROVEEDORES e INGRESOS.', 'created_at' => Carbon::now()->toDateTimeString(), 'updated_at' => Carbon::now()->toDateTimeString()],
            ['key' => 'egresos', 'name' => 'Egresos', 'description' => 'Este rol tiene acceso a PROVEEDORES, EGRESOS y REPORTES.', 'created_at' => Carbon::now()->toDateTimeString(), 'updated_at' => Carbon::now()->toDateTimeString()],
            ['key' => 'entregas', 'name' => 'Entregas', 'description' => 'Este rol tiene acceso a CLIENTES, ENTREGAS y REPORTES.', 'created_at' => Carbon::now()->toDateTimeString(), 'updated_at' => Carbon::now()->toDateTimeString()],
            ['key' => 'egre_entr', 'name' => 'Egresos y Entregas', 'description' => 'Este rol tiene acceso a PROVEEDORES, CLIENTES, EGRESOS, ENTREGAS y REPORTES.', 'created_at' => Carbon::now()->toDateTimeString(), 'updated_at' => Carbon::now()->toDateTimeString()],
        ]);

        //TABLA BASCULA CONFIGURACION
        DB::table('bascula_configuracion')->truncate();

        DB::table('bascula_configuracion')->insert([
            'cod_bascula' => 'B00-1',
            'nom_bascula' => 'BASCULA1',
            'ipx_bascula' => '192.168.100.11',
            'est_bascula' => '0',
            'usuario_creacion' => 'dmorocho',   
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),         
        ]);

         DB::table('bascula_configuracion')->insert([
            'cod_bascula' => 'B00-2',
            'nom_bascula' => 'BASCULA2',
            'ipx_bascula' => '192.168.100.7',
            'est_bascula' => '0',
            'usuario_creacion' => 'dmorocho',   
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),         
        ]);


        //TABLA CONFIGURACION
        DB::table('configuracion')->truncate();


        DB::table('configuracion')->insert([
            'mod_conf' => 'INGRESOS', 
            'des_conf' => 'PARAMETRO PARA DEFINIR POR DEFAULT UN VALOR EN INPUT "CANTIDAD GAVENTAS LLENAS" - INGRESOS',
            'ele_conf' => 'VALOR_CANT_GAVETAS_LLENAS',
            'val_conf' => '7',
            'est_conf' => 0,
        ]);

         DB::table('configuracion')->insert([
            'mod_conf' => 'EGRESOS', 
            'des_conf' => 'PARAMETRO PARA DEFINIR POR DEFAULT UN VALOR EN INPUT "CANTIDAD GAVENTAS LLENAS" - EGRESOS',
            'ele_conf' => 'VALOR_CANT_GAVETAS_LLENAS',
            'val_conf' => '5',
            'est_conf' => 0,
        ]);

          DB::table('configuracion')->insert([
            'mod_conf' => 'ENTREGAS', 
            'des_conf' => 'PARAMETRO PARA DEFINIR POR DEFAULT UN VALOR - ENTREGAS',
            'ele_conf' => 'VALOR_CANT_GAVETAS',
            'val_conf' => '2',
            'est_conf' => 0,
        ]);

        DB::table('configuracion')->insert([
            'mod_conf' => 'INGRESOS', 
            'des_conf' => 'CANTIDAD DECIMALES PARA GAVETAS VACIAS - INGRESOS',
            'ele_conf' => 'CANT_DEC_GV',
            'val_conf' => '0',
            'est_conf' => 0,
        ]);

        DB::table('configuracion')->insert([
            'mod_conf' => 'EGRESOS', 
            'des_conf' => 'CANTIDAD DECIMALES PARA GAVETAS VACIAS - EGRESOS',
            'ele_conf' => 'CANT_DEC_GV',
            'val_conf' => '0',
            'est_conf' => 0,
        ]);


        DB::table('configuracion')->insert([
            'mod_conf' => 'INGRESOS', 
            'des_conf' => 'CANTIDAD DECIMALES PARA PESO BRUTO - INGRESOS',
            'ele_conf' => 'CANT_DEC_PB',
            'val_conf' => '0',
            'est_conf' => 0,
        ]);

        DB::table('configuracion')->insert([
            'mod_conf' => 'EGRESOS', 
            'des_conf' => 'CANTIDAD DECIMALES PARA PESO NETO - INGRESOS',
            'ele_conf' => 'CANT_DEC_PB',
            'val_conf' => '0',
            'est_conf' => 0,
        ]);

        DB::table('configuracion')->insert([
            'mod_conf' => 'ENTREGAS', 
            'des_conf' => 'CANTIDAD DECIMALES PARA PESO  BRUTO - ENTREGAS',
            'ele_conf' => 'CANT_DEC_PB',
            'val_conf' => '0',
            'est_conf' => 0,
        ]);

        // TABLA USUARIOS
        DB::table('users')->truncate();
        
        DB::table('users')->insert([
            'rol_id' => 1,
            'username' => 'superadmin',
            'name' => 'Súper',
            'last_name' => 'Administrador',
            'email' => 'admin@pollovencedor.com',
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

        DB::table('users')->insert([
            'rol_id' => 2,
            'username' => 'rzambrano',
            'name' => 'Ramon',
            'last_name' => 'Zambrano',
            'email' => 'rzambrano@pollovencedor.com',
            'password' => Hash::make('rzambrano123'),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
            'active' => 1,
        ]);


        DB::table('users')->insert([
            'rol_id' => 2,
            'username' => 'jmarcillo',
            'name' => 'Jhonnatan',
            'last_name' => 'Marcillo',
            'email' => 'jmarcillo@pollovencedor.com',
            'password' => Hash::make('jmarcillo123'),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
            'active' => 1,
        ]);

        DB::table('users')->insert([
            'rol_id' => 2,
            'username' => 'dconforme',
            'name' => 'Daniel',
            'last_name' => 'Conforme',
            'email' => 'dconforme@pollovencedor.com',
            'password' => Hash::make('dconforme123'),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
            'active' => 1,
        ]);


        DB::table('users')->insert([
            'rol_id' => 2,
            'username' => 'scayo',
            'name' => 'Sidney',
            'last_name' => 'Cayo',
            'email' => 'scayo@pollovencedor.com',
            'password' => Hash::make('scayo123'),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
            'active' => 1,
        ]);

        DB::table('users')->insert([
            'rol_id' => 2,
            'username' => 'razambrano',
            'name' => 'Rafael',
            'last_name' => 'Zambrano',
            'email' => 'razambrano@pollovencedor.com',
            'password' => Hash::make('razambrano123'),
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


         DB::table('clientes')->insert([
            'tipo' => 'RUC',
            'ruc_ci' => '1723325443001',
            'nombres' => 'MAYA PILATUÑA LUIS ALBERTO',
            'razon_social' => 'MAYA PILATUÑA LUIS ALBERTO',
            'direccion' => Str::random(10),
            'telefono' => '0000000000',
            'movil' => '0000000000',
            'email' => Str::random(10).'@gmail.com',
            'provincia' => 'SANTO DOMINGO',
            'ciudad' => 'SANTO DOMINGO',
            'parroquia' => 'SANTO DOMINGO',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

         DB::table('clientes')->insert([
            'tipo' => 'RUC',
            'ruc_ci' => '1722280441001',
            'nombres' => 'MAYA PILATUÑA MONICA YADIRA',
            'razon_social' => 'MAYA PILATUÑA MONICA YADIRA',
            'direccion' => Str::random(10),
            'telefono' => '0000000000',
            'movil' => '0000000000',
            'email' => Str::random(10).'@gmail.com',
            'provincia' => 'SANTO DOMINGO',
            'ciudad' => 'SANTO DOMINGO',
            'parroquia' => 'SANTO DOMINGO',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

         DB::table('clientes')->insert([
            'tipo' => 'CI',
            'ruc_ci' => '1716095490',
            'nombres' => 'PEREZ CAYANCELA PATRICIA PILAR',
            'razon_social' => 'PEREZ CAYANCELA PATRICIA PILAR',
            'direccion' => Str::random(10),
            'telefono' => '0000000000',
            'movil' => '0000000000',
            'email' => Str::random(10).'@gmail.com',
            'provincia' => 'SANTO DOMINGO',
            'ciudad' => 'SANTO DOMINGO',
            'parroquia' => 'SANTO DOMINGO',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

         DB::table('clientes')->insert([
            'tipo' => 'CI',
            'ruc_ci' => '1720319803',
            'nombres' => 'CARRASCO CARRASCO DARWIN JAVIER',
            'razon_social' => 'CARRASCO CARRASCO DARWIN JAVIER',
            'direccion' => Str::random(10),
            'telefono' => '0000000000',
            'movil' => '0000000000',
            'email' => Str::random(10).'@gmail.com',
            'provincia' => 'SANTO DOMINGO',
            'ciudad' => 'SANTO DOMINGO',
            'parroquia' => 'SANTO DOMINGO',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

         DB::table('clientes')->insert([
            'tipo' => 'CI',
            'ruc_ci' => '1304951146',
            'nombres' => 'VICTORES CHOEZ MARCIANO JHONNY',
            'razon_social' => 'VICTORES CHOEZ MARCIANO JHONNY',
            'direccion' => Str::random(10),
            'telefono' => '0000000000',
            'movil' => '0000000000',
            'email' => Str::random(10).'@gmail.com',
            'provincia' => 'SANTO DOMINGO',
            'ciudad' => 'SANTO DOMINGO',
            'parroquia' => 'SANTO DOMINGO',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

         DB::table('clientes')->insert([
            'tipo' => 'CI',
            'ruc_ci' => '0704469071',
            'nombres' => 'VELEZ PALADINES CARLOS RENE',
            'razon_social' => 'VELEZ PALADINES CARLOS RENE',
            'direccion' => Str::random(10),
            'telefono' => '0000000000',
            'movil' => '0000000000',
            'email' => Str::random(10).'@gmail.com',
            'provincia' => 'SANTO DOMINGO',
            'ciudad' => 'SANTO DOMINGO',
            'parroquia' => 'SANTO DOMINGO',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);


         DB::table('clientes')->insert([
            'tipo' => 'CI',
            'ruc_ci' => '1718800301',
            'nombres' => 'MERIZALDE PAREDES ERIKA JOSSELYN',
            'razon_social' => 'MERIZALDE PAREDES ERIKA JOSSELYN',
            'direccion' => Str::random(10),
            'telefono' => '0000000000',
            'movil' => '0000000000',
            'email' => Str::random(10).'@gmail.com',
            'provincia' => 'SANTO DOMINGO',
            'ciudad' => 'SANTO DOMINGO',
            'parroquia' => 'SANTO DOMINGO',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

            DB::table('clientes')->insert([
            'tipo' => 'CI',
            'ruc_ci' => '2300375777',
            'nombres' => 'BRAVO DAVILA STEVEN JOVANNY',
            'razon_social' => 'BRAVO DAVILA STEVEN JOVANNY',
            'direccion' => Str::random(10),
            'telefono' => '0000000000',
            'movil' => '0000000000',
            'email' => Str::random(10).'@gmail.com',
            'provincia' => 'SANTO DOMINGO',
            'ciudad' => 'SANTO DOMINGO',
            'parroquia' => 'SANTO DOMINGO',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('clientes')->insert([
            'tipo' => 'CI',
            'ruc_ci' => '1713397360',
            'nombres' => 'CASTRO RODRIGUEZ JUANA MAGALY',
            'razon_social' => 'CASTRO RODRIGUEZ JUANA MAGALY',
            'direccion' => Str::random(10),
            'telefono' => '0000000000',
            'movil' => '0000000000',
            'email' => Str::random(10).'@gmail.com',
            'provincia' => 'SANTO DOMINGO',
            'ciudad' => 'SANTO DOMINGO',
            'parroquia' => 'SANTO DOMINGO',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        DB::table('clientes')->insert([
            'tipo' => 'CI',
            'ruc_ci' => '1715103345',
            'nombres' => 'CASTRO RODRIGUEZ ROLANDO MARCELO',
            'razon_social' => 'CASTRO RODRIGUEZ ROLANDO MARCELO',
            'direccion' => Str::random(10),
            'telefono' => '0000000000',
            'movil' => '0000000000',
            'email' => Str::random(10).'@gmail.com',
            'provincia' => 'SANTO DOMINGO',
            'ciudad' => 'SANTO DOMINGO',
            'parroquia' => 'SANTO DOMINGO',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);



        // TABLA LOTES
        DB::table('lotes')->truncate();

        // TABLA REGISTROS
        DB::table('registros')->truncate();
    }
}
