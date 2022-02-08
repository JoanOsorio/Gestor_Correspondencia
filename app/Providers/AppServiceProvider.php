<?php

namespace GeCo\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use GeCo\User;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        
          $recibida = DB::table('c_recibidas')
                ->select('c_recibidas.*')
                ->where('cr_empleado','=', 'Joan')
                ->get();
        $mensaje = '';       
        foreach ($recibida as $rec) {
            $repartos = DB::table('repartos')
                    ->select('repartos.*')
                    ->where('rep_c_recibida','=', $rec->cr_id)
                    ->get();
            $var = json_decode($repartos,true);
            $var2 = count($var);

            if ($var2 == 0) {
                $mensaje = $mensaje." - Hacer el reparto para el doc. : ".$rec->cr_codigo;
            }else{
                $mensaje = $mensaje." - Reparto hecho al documento: ".$rec->cr_codigo;
            }
        }

        foreach ($recibida as $rec) {
            $acciones = DB::table('acciones')
                    ->select('acciones.*')
                    ->where('acc_c_recibida','=', $rec->cr_id)
                    ->get();
            $var = json_decode($acciones,true);
            $var2 = count($var);

            if ($var2 == 0) {
                $mensaje = $mensaje." - Hacer accion para el documento: ".$rec->cr_codigo;
            }else{
                $mensaje = $mensaje." - Accion hecha al documento:  ".$rec->cr_codigo;
            }
        }
        View::share('prueba',$mensaje);
       
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
