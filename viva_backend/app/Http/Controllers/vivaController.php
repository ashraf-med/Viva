<?php

namespace App\Http\Controllers;
use App\Mail\VivaMail;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\models\Viva;
use Illuminate\Support\Facades\Mail;

class vivaController extends Controller
{

    public function add(Request $req){
        $this->validate($req,[
            'pname'=>'required','year'=>'required','prname'=>'required','prmark'=>'required','sname'=>'required','smark'=>'required',
            'ename'=>'required','emark'=>'required','s1name'=>'required','s2name','s3name'
        ]);
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

        while (true){
            $cod=substr(str_shuffle($str_result),
               0, 10);

            $viva=Viva::where('code',$cod)->first();

           if(!$viva){
                $userid=$req->user()['id'];
                $userEmail=$req->user()['email'];
                $nviva=Viva::create(['user_id'=>$userid,'pname'=>$req['pname'],'year'=>$req['year'],'prname'=>$req['prname']
                    ,'prmark'=>(double)$req['prmark'],'sname'=>$req['sname'],'smark'=>(double)$req['smark'],'ename'=>$req['ename'],'emark'=>(double)$req['emark']
                    ,'s1name'=>$req['s1name'],'s2name'=>$req['s2name'],'s3name'=>$req['s3name'],'code'=>$cod]);
                $mailData = [
                    'pname'=>$req['pname'],'year'=>$req['year'],'prname'=>$req['prname']
                    ,'prmark'=>(double)$req['prmark'],'sname'=>$req['sname'],'smark'=>(double)$req['smark'],'ename'=>$req['ename'],'emark'=>(double)$req['emark']
                    ,'s1name'=>$req['s1name'],'s2name'=>$req['s2name'],'s3name'=>$req['s3name'],'fmark'=>(0.3*(double)$req['smark']+0.3*(double)$req['prmark']+0.4*(double)$req['emark'])

                ];

                Mail::to($userEmail)->send(new VivaMail($mailData));
                return response(['vivacode'=>$nviva['code']],200);
            }
           }}


    public function user(Request $req){
        return  $req->user()['id'];
    }


    public function getViva($code){
        $viva=Viva::where('code',$code)->first();
        if(!$viva){
            return response(['error'=>'viva not found'],404);
        }
        $vivaData = [
            'pname'=>$viva['pname'],'year'=>$viva['year'],'prname'=>$viva['prname']
            ,'prmark'=>(double)$viva['prmark'],'sname'=>$viva['sname'],'smark'=>(double)$viva['smark'],'ename'=>$viva['ename'],'emark'=>(double)$viva['emark']
            ,'s1name'=>$viva['s1name'],'s2name'=>$viva['s2name'],'s3name'=>$viva['s3name'],'fmark'=>(0.3*(double)$viva['smark']+0.3*(double)$viva['prmark']+0.4*(double)$viva['emark']),'code'=>$viva['code']

        ];

        return response($vivaData,200);
    }


    public function userViva(Request $req){
        $userid=$req->user()['id'];
        $vivas=Viva::where('user_id','=',$userid)->get();
        

        return response($vivas,200);
    }
}
