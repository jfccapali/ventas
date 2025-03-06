<?php

namespace App\Http\Servicios;

class Service
{
    public function send_success($data,$message)
    {
        return response()->json(['data'=>$data,'message'=>$message],200);
    }

    public function send_error($errors,$message,$status)
    {
        return response()->json(['erros'=>$errors,'message'=>$message],$status);
    }

}
