<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserServerRequest;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class APIController extends Controller
{
    /**
     *  SEARCH FOR FUNCTION
     */
    public function index(Request $request)
    {
        $data = $request->search;
            $fp = fsockopen($data, 80 , $errno , $errstr , 30 );
            if($fp){
                $searchDomain = DB::table("apache_service_dbs")->where("name_url",$data)->exists();
                $ap_serv_bd = array();
                if($searchDomain)
                {
                $ap_serv_bd["status"] = true;
                $ap_serv_bd["time_search"]= new DateTime();
                $ap_serv_bd["updated_at"]= new DateTime();
                $searchDomain = DB::table("apache_service_dbs")->where("name_url",$data)
                ->update($ap_serv_bd);
                }else{
                    $ap_serv_bd["name_url"]= $data;
                    $ap_serv_bd["status"] = true;
                    $ap_serv_bd["time_search"]= new DateTime();
                    $ap_serv_bd["created_at"]= new DateTime();
                    $ap_serv_bd["updated_at"]= new DateTime();
                    $searchDomain = DB::table("apache_service_dbs")->where("name_url",$data)
                    ->insert($ap_serv_bd);
                }
                return response()->json(["message"=>"Site online"],200);
            } else {
                $searchDomain = DB::table("apache_service_dbs")->where("name_url",$data)->exists();
                if($searchDomain)
                {
                $ap_serv_bd["status"] = false;
                $ap_serv_bd["time_search"]= new DateTime();
                $ap_serv_bd["updated_at"]= new DateTime();
                $searchDomain = DB::table("apache_service_dbs")->where("name_url",$data)
                ->update($ap_serv_bd);
                }else
                {
                    $ap_serv_bd["name_url"]= $data;
                    $ap_serv_bd["status"] = false;
                    $ap_serv_bd["time_search"]= new DateTime();
                    $ap_serv_bd["created_at"]= new DateTime();
                    $ap_serv_bd["updated_at"]= new DateTime();
                    $searchDomain = DB::table("apache_service_dbs")->where("name_url",$data)
                    ->insert($ap_serv_bd);
                }
                return response()->json(["message"=>"Site offline"],200);
            }
        }
        function fs($name)
        {
            $fp = fsockopen($name, 80 , $errno , $errstr , 30 );
            if($fp)
            {
                return true;
            }else
            {
                return false;
            }
        }
    /**
     * GET ALL DOMAINS AS SEARCH FUNCTION
     */
    public function apache_service_dbs(){
        $ap_serv_bd = DB::table("apache_service_dbs")->orderByDesc("time_search")->limit(10)->get();
        if($ap_serv_bd)
        {
            foreach($ap_serv_bd as $value)
            {
                /*if( fsockopen( $value->name_url , 80 , $errno , $errstr , 30 ) ){
                    //insere no banco de dados a actualizacao o status positivo
                } else {
                    //insere no banco de dados a actualizacao e o status negativo
                }  */
            }
            return response()->json(["data"=>$ap_serv_bd],200);
        }
        else
        {
            return response()->json(["message"=>"Nenhum dado encontrado"]);
        }
    }
    /**
     * CREATE AN ALERT FUNCTION
     */
    public function createAlert($id,Request $request)
    {
        $data = array();
        $data['url_name'] =$request->url_name;
        $data['user_id'] = $id;
        if(DB::table('user_server_dbs')->where("url_name",$data['url_name'])
        ->where("user_id",$data['user_id'])->exists())
        {
            return response()->json(["message"=>"Esse site ja existe no nosso banco"],500);
        }else
        $fp = fsockopen($data['url_name'], 80 , $errno , $errstr , 30 );
        if($fp)
        {
            $data['status'] = true;
            $data['date_time_reset'] = new DateTime();
            $tb = DB::table('user_server_dbs')->insert($data);
            return response()->json(["message"=>"Enviado com sucesso e esta online"]);
        }else
        {
            $data['status'] = false;
            $data['date_down'] = new DateTime();
            $data['date_time_reset'] = new DateTime();
            $tb = DB::table('user_server_dbs')->insert($data);
            return response()->json(["message"=>"Enviado com sucesso e o site esta offline"]);
        }
    }
    public function editAlert($id,UserServerRequest $request)
    {
        $data = array();
        $data['url_name'] = $request->url_name;
        $alertDomain = DB::table('user_server_dbs')->where("id",$id)->first();
        if($alertDomain)
        {
            $site = $this->fs($data["url_name"]);
            if($site)
            {
                $data['status'] = 1;
                DB::table('user_server_dbs')->where("id",$id)->update($data);
                return response()->json("Site up");
            }else
            {
                $data['status'] = 0;
                DB::table('user_server_dbs')->where("id",$id)->update($data);
                return response()->json("Site down");
            }
        }else
        {
            return response()->json("erro",500);
        }
    }
    public function deleteAlert($id)
    {
        $alertDomain = DB::table('user_server_dbs')->where("id",$id)->first();
        if($alertDomain)
        {
            DB::table('user_server_dbs')->where("id",$id)->delete();
            return response()->json("removido com sucesso",200);
        }else
        {
            return response()->json("O site nao exite",500);
        }
    }
    public function allAlert($id)
    {
        $user = User::find($id);
       // $userId =$user->id;
        $userData = DB::table('user_server_dbs')->where("user_id",$user->id)
        ->orderByDesc("id")->get();
        return response()->json(["data"=>$userData]);
    }
}
