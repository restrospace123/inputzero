<?php

namespace App\Helpers;

class Helper{

    public static function build($data){
        return json_encode($data);
    }

    public static function success($data){
        return Helper::build(
            array(
                'status' => 'success',
                'data'   => $data
            )
        );
    }

    public static function error($message){
        return Helper::build(
            array(
                'status'  => 'error',
                'message' => $message
            )
        );
    }

    public static function refractor($data){
       return trim(implode(',', $data), ','); 
    }
}