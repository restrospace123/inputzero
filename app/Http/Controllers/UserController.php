<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Model\User;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class UserController extends Controller
{
    protected $validate;
    protected $response;

    public function __construct()
    {
        $this->response = array();
    } 

    public function view(Request $request){

        /*
        * Validate input
        */
        $validator = FacadesValidator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return Helper::error('Id filed required or integer value expected');
        }
        
        // Collect input
        $id   = $request->input('id');
        $fmt  = $request->input('fmt');

        /*
        * If id is set
        * @user_data will contain
        * key value attribute in json formate.
        */
        $this->response['user_data'] = User::find($id);

        if(is_null($this->response['user_data'])){
            return Helper::error('No record found');
        }
            
        /*
        * If fmt is set
        * @user_data_seprated will contain
        * Coma seprated value attributes.
        */
        if(isset($fmt)){
            $this->response['user_data_seprated'] = Helper::refractor($this->response['user_data']->getAttributes());
        }
        
        /*
        * response buid
        */
        return Helper::success($this->response);

      
    }
}
