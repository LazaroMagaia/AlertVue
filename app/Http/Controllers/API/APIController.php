<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Apache_service_db;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class APIController extends Controller
{
    private $ap_serv_dbs;
    public function __construct(Apache_service_db $ap_serv_dbs)
    {
        $this->ap_serv_dbs = $ap_serv_dbs;
    }

    /**
     *  SEARCH FOR FUNCTION
     */
    public function index($id)
    {
            $fp = fsockopen($id, 80 , $errno , $errstr , 30 );
            if($fp){
                $searchDomain = DB::table("apache_service_dbs")->where("name_url",$id)->exists();
                $ap_serv_bd = array();
                if($searchDomain)
                {
                $ap_serv_bd["status"] = true;
                $ap_serv_bd["time_search"]= new DateTime();
                $ap_serv_bd["updated_at"]= new DateTime();
                $searchDomain = DB::table("apache_service_dbs")->where("name_url",$id)
                ->update($ap_serv_bd);
                }else{
                    $ap_serv_bd["name_url"]= $id;
                    $ap_serv_bd["status"] = true;
                    $ap_serv_bd["time_search"]= new DateTime();
                    $ap_serv_bd["created_at"]= new DateTime();
                    $ap_serv_bd["updated_at"]= new DateTime();
                    $searchDomain = DB::table("apache_service_dbs")->where("name_url",$id)
                    ->insert($ap_serv_bd);
                }
                return response()->json(["message"=>"Site online"],200);
            } else {
                $searchDomain = DB::table("apache_service_dbs")->where("name_url",$id)->exists();
                if($searchDomain)
                {
                $ap_serv_bd["status"] = false;
                $ap_serv_bd["time_search"]= new DateTime();
                $ap_serv_bd["updated_at"]= new DateTime();
                $searchDomain = DB::table("apache_service_dbs")->where("name_url",$id)
                ->update($ap_serv_bd);
                }else
                {
                    $ap_serv_bd["name_url"]= $id;
                    $ap_serv_bd["status"] = false;
                    $ap_serv_bd["time_search"]= new DateTime();
                    $ap_serv_bd["created_at"]= new DateTime();
                    $ap_serv_bd["updated_at"]= new DateTime();
                    $searchDomain = DB::table("apache_service_dbs")->where("name_url",$id)
                    ->insert($ap_serv_bd);
                }
                return response()->json(["message"=>"Site offline"],200);
            }
        }
    /**
     * GET ALL DOMAINS AS SEARCH FUNCTION
     */
    public function apache_service_dbs(){
        $ap_serv_bd = DB::table("apache_service_dbs")->orderByDesc("time_search")->get();
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
    public function createAlert($id)
    {
        $data = array();
        $data['url_name'] = $id;
        echo  $data['url_name'];
        $data['user_id'] = 1;
        $fp = fsockopen($data['url_name'], 80 , $errno , $errstr , 30 );
        if($fp)
        {
            $data['status'] = true;
            $data['date_time_reset'] = new DateTime();
            $tb = DB::table('user_server_dbs')->insert($data);
            return response()->json(["message"=>"Enviado com sucesso"]);
        }else
        {
            $data['status'] = false;
            $data['date_down'] = new DateTime();
            $data['date_time_reset'] = new DateTime();
            $tb = DB::table('user_server_dbs')->insert($data);
            return response()->json(["message"=>"Enviado com sucesso e o site esta offline"]);
        }
    }
}
