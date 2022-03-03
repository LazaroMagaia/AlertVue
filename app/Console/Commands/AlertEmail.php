<?php

namespace App\Console\Commands;

use App\Mail\serverDown;
use App\Mail\serverUp;
use App\Models\DownUpServer;
use App\Models\staticServer;
use DateTime;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use stdClass;
class AlertEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alert:email';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'verificar se o site esta offilne ou nao';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    private $static,$downup;
    public function __construct(DownUpServer $downup,staticServer $static)
    {
        $this->downup = $downup;
        $this->static = $static;
        parent::__construct();
    }
    /**
     * SEE IF SITE IS ONLINE OR NOT
     */
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
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = DB::table("users")->get();
        $data = [];
        foreach($users as $user)
        {
            /**
             * Peguei os id dos usuarios para depois verificar se tem ou nao sites
             */
            $data[$user->id] = $users->toArray();
        }
        $i = 0;
        $total = count($data);
        foreach($data as $dataId =>$value)
        {
            /**
             * OBTER TODOS SITES DE CADA USER
             */
            $sites = DB::table("user_server_dbs")->where("user_id",$value[$i]->id)->get();
            /**
             * CICLO PARA FAZER O ENVIO DE EMAILS
             */
            $i++;
            if($i == $total)
            {
                $i=0;
            }
            foreach($sites as $site)
            {
                $data = array();
                $fs = $this->fs($site->url_name);
                $user = DB::table("users")->where("id",$site->user_id)->first();
                $dbs = DB::table("user_server_dbs")->where("id",$site->id)->first();
                if($fs)
                {
                    /**
                     * NO BANCO DE DADOS ENTRA STATUS  POSITIVO
                     */
                    if($dbs->date_down != null)
                    {
                        $verification=true;
                        $data["date_up"] = new DateTime();
                        $data["date_down"] = null;
                        $data["date_time_reset"] = new DateTime();
                        $insert =DB::table('user_server_dbs')->where("id",$site->id)->update($data);
                        /**
                         * SEND EMAIL MESSAGE
                         */
                        $this->sendUp($user,$dbs);
                        $this->staticServer($site->id,$verification);
                        $this->downAndUp($site->id,$verification);
                    }else
                    {
                        $data["date_time_reset"] = new DateTime();
                        $insert =DB::table('user_server_dbs')->update($data);
                    }
                }else
                {
                    $verification=false;
                    /**
                     * NO BANCO DE DADOS ENTRA STATUS  NEGATIVO E ENVIA UMA MENSAGEM AO USUARIO
                     */
                    $data["date_up"] = null;
                    $data["date_down"] = new DateTime();
                    $data["date_time_reset"] = new DateTime();
                    $insert =DB::table('user_server_dbs')->update($data);
                    /**
                     * SEND EMAIL MESSAGE
                     */
                    $this->sendDown($user,$dbs);
                    $this->staticServer($site->id,$verification);
                    $this->downAndUp($site->id,$verification);
                }
            }
        }
        //para cada usuario tenho de verificar quantos sites estao
        //la e testar se estao ou nao activos
        //depois tenho de enviar um email
    }
    public function sendDown($user,$site){
        Mail::to($user->email)->send(new serverDown($user,$site));
    }
    public function sendUp($user,$site){
        Mail::to($user->email)->send(new serverUp($user,$site));
    }
    public function staticServer($site,$verification)
    {
        $data =[];
        if($verification)
        {
            $verSite = DB::table("static_servers")->where("site_id",$site)->first();
            /**
             * Quer dizer que servidor voltou ao ar
             */
            $data["site_id"] = $site;
            if($verSite)
            {
                $data["up_count"] = $verSite->down_count + 1;
                $verSite = DB::table("static_servers")->where("site_id",$site)->update($data);
            }else
            {
                $data["up_count"] = 1;
                $verSite = DB::table("static_servers")->insert($data);
            }
        }else
        {
            $verSite = DB::table("static_servers")->where("site_id",$site)->first();
            /**
             * Quer dizer que servidor voltou ao ar
             */
            $data["site_id"] = $site;
            if($verSite)
            {
                $data["down_count"] = $verSite->down_count + 1;
                $update = DB::table("static_servers")->where("site_id",$site)->update($data);
            }else
            {
                $data["down_count"] = 1;
                $verSite = DB::table("static_servers")->insert($data);
            }
        }
    }
    public function downAndUp($site,$verification)
    {
        if($verification)
        {

            $data["site_id"] = $site;
            $data["up_server"] = new DateTime();
            //$data["down_count"] = new DateTime();
            $verSite = DB::table("down_up_servers")->insert($data);
        }else
        {
            $data["site_id"] = $site;
            //$data["up_count"] = new DateTime();
            $data["down_server"] = new DateTime();
            $verSite = DB::table("down_up_servers")->insert($data);
        }
    }
}
