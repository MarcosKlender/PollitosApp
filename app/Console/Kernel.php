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


      $rucs = json_decode(collect(DB::table('proveedores')->get('ruc_ci')),true); //obtiene el valor de ruc_ci de la tabla proveedores
        $url='http://192.168.0.106:85/ws_sheyla/ws.php?opcion=get_cli&token='.$jwt;//url para hacer la petición a la ws enviando el token
        $cli=json_decode(file_get_contents($url),true);//obtiene los datos desde la WS

        foreach ($cli as $key => $value) 
        {
            
            $c=0; // se usa para saber si hubo una coincidencia
            $ruc=strval($cli[$key]['ruc_ci']); 
            
            foreach ($rucs as $key1 => $value1) 
            {
                if ($rucs[$key1]['ruc_ci']==$ruc) //compara los valores de la WS con los de ruc_ci de la BDD y si son iguales procede a actualizar los datos de proveedores con los de la WS
                {
                   
                   $c=1; //si hay coincidencia cambia a 1

                    DB::table('proveedores')
                    ->where('ruc_ci', $ruc)
                    ->update(array( 'tipo' => "aa",
                                    'nombres'   => $cli[$key]['nom_cliente'],
                                    'razon_social'=> "Pollitos",
                                    'direccion' => $cli[$key]['dir_cliente'],
                                    'telefono' => $cli[$key]['tele_cliente'],   
                                    'movil' => $cli[$key]['tele_cliente'], 
                                    'email' => $cli[$key]['email_cliente'],
                                    'provincia' => "Santo Domingo",
                                    'ciudad' => "Santo Domingo",
                                    'parroquia' => "Santo Domingo",
                                    'created_at' => "12/12/12",
                                    'updated_at' => "20/12/22"));
                }
            }

            if ($c==0) //si no hubo coincidencia se crea un nuevo proveedor
            {
                $local = new Proveedores();

                $local->tipo = "aa";
                $local->ruc_ci = $cli[$key]['tele_cliente'];
                $local->nombres = $cli[$key]['nom_cliente'];
                $local->razon_social = "Pollitos";
                $local->direccion = $cli[$key]['dir_cliente'];
                $local->telefono = $cli[$key]['tele_cliente'];   
                $local->movil = $cli[$key]['tele_cliente']; 
                $local->email = $cli[$key]['email_cliente'];
                $local->provincia = "Santo Domingo";
                $local->ciudad = "Santo Domingo";
                $local->parroquia = "Santo Domingo";
                $local->created_at = "12/12/12";
                $local->updated_at = "20/12/22"; 

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
