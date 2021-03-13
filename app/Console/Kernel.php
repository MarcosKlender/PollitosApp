<?php

namespace App\Console;

require_once 'vendor/autoload.php';
use App\Proveedores;    
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Firebase\JWT\JWT;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
    // the call method
    $schedule->call(function () {
      
      $time = time();
      $key = '12345'; //contraseña para crear el token

      $token = array( //se almacenan los datos del token
        'iat'=>$time,
        'exp'=>$time + 60, //deja de funcionar en un minuto
        'data'=>[//datos del usuario
          'id'=>1,
          'name'=>'rene'
        ]
      );
      $jwt = JWT::encode($token, $key); //codifica el token
      //dd($jwt);
      $rucs = json_decode(collect(DB::table('proveedores')->get('pro_ruc')),true); //obtiene el valor de ruc_ci de la tabla proveedores;
      $url='http://bf68bf4d3bc9.ngrok.io/WS_PROVEEDORES_SHEYLA/ws.php?opcion=get_cli&token='.$jwt;
      $data=file_get_contents($url);
      //dd($data);
      $cli = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $data), true);
      //dd($data);

        foreach ($cli as $key => $value) 
        {
            
            $c=0; // se usa para saber si hubo una coincidencia
            $ruc=strval($cli[$key]['pro_ruc']); 
            
            foreach ($rucs as $key1 => $value1) 
            {
                if ($rucs[$key1]['pro_ruc']==$ruc) //compara los valores de la WS con los de pro_ruc de la BDD y si son iguales procede a actualizar los datos de proveedores con los de la WS
                {
                   
                   $c=1; //si hay coincidencia cambia a 1

                    DB::table('proveedores')
                    ->where('pro_ruc', $ruc)
                    ->update(array( 'pro_nombre' => $cli[$key]['pro_nombre'],
                                    'pro_nombre_comercial' => $cli[$key]['pro_nombre_comercial'],
                                    'pro_telefonos' => $cli[$key]['pro_telefonos'],   
                                    'pro_email' => $cli[$key]['pro_email'], 
                                    'pro_direccion' => $cli[$key]['pro_direccion'],));
                }
            }

            if ($c==0) //si no hubo coincidencia se crea un nuevo proveedor
            {
                $local = new Proveedores();

                //$local->id = $cli[$key]['pro_id'];
                $local->pro_ruc = $cli[$key]['pro_ruc'];
                $local->pro_nombre = $cli[$key]['pro_nombre'];
                $local->pro_nombre_comercial = $cli[$key]['pro_nombre_comercial'];
                $local->pro_telefonos = $cli[$key]['pro_telefonos'];   
                $local->pro_email = $cli[$key]['pro_email']; 
                $local->pro_direccion = $cli[$key]['pro_direccion'];
                //$local->created_at = Carbon::now()->toDateTimeString();
                //$local->updated_at = Carbon::now()->toDateTimeString();
            
                $local->save();
            }
        }
    })->everyMinute();
  }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}