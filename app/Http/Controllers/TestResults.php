<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Session;
use App\QuestionsModel;
use App\HeadersModel;
use Sessions;
use App\HeaderSelectedModel;
use App\AutoUserModel;
use App\TestsModel;

class TestResults extends Controller
{
    //

    public static function index(Request $r,$testId){

        //$testId=$r->input('testId');
        $headers=HeadersModel::getListHeaders($testId);


        $custom_text=null;
        //$res[]=null;




        foreach ($headers as $key=>$val){

            $s=Session::get('h['.$val->id.']');
            $sd=Session::get('test_start_time');
            $user_name=Session::get('user_name');
            //$header=HeadersModel::getHeader($testId,$val->order_index);
            $select=HeaderSelectedModel::getSelectedById($s[$val->id]);

            //echo $val->name; //header_name


  
            $q_sum=0;
            $arrQ=null;
            //echo '<br>';
            //echo $select[0]->name; // select_name
            //echo '|'.$select[0]->valid; //true select integer for header
                if ($select[0]->is_custom_text==1) $custom_text=$s['custom_text'];
                if ($select[0]->is_questions==1 && !empty($s['questions'])){

                    foreach($s['questions'] as $key1=>$val1){

                        $arrQ[]=array('name'=>QuestionsModel::getQuestionById($key1));

                        $autouser= new AutoUserModel;
                        //echo $key1.'<br>'.$sd;
                        $q_sum=$q_sum+$val1;
                        $autouser->test_id=$testId;
                        $autouser->header_id=$val->id;
                        $autouser->selected_id=$select[0]->header_selected_id;
                        $autouser->questions_id=$key1;
                        $autouser->test_start_time=$sd;
                        $autouser->valid=$select[0]->valid;
                        $autouser->fio=$user_name;
                        $autouser->save();
                    }

                    //echo '|qsum='.$q_sum;
                }
            else {
                $autouser= new AutoUserModel;
                $autouser->test_id=$testId;
                $autouser->header_id=$val->id;
                $autouser->selected_id=$select[0]->header_selected_id;
                $autouser->valid=$select[0]->valid;
                $autouser->test_start_time=$sd;
                $autouser->custom_text=$custom_text;
                $autouser->fio=$user_name;
                 $autouser->save();
            }

            $true=$select[0]->is_questions==1?$q_sum:$select[0]->true_value;
            $result_text=$true>=$select[0]->valid?$select[0]->positive_text:$select[0]->negative_text;

            $arrHeaderName[]=array(
                'header_name'=>$val->name
                ,'selected_name'=>$select[0]->name
                ,'is_questions'=>$select[0]->is_questions
                ,'header_valid'=>$select[0]->valid
                ,'custom_text'=>$select[0]->is_custom_text==1?$custom_text=$s['custom_text']:null
                ,'q_sum'=>$q_sum
                ,'true'=>$select[0]->is_questions==1?$q_sum:$select[0]->true_value
                ,'result_text'=>$result_text
                ,'Q'=>$arrQ
            );
           //echo '<br><br>';




                        //echo $val->id."=".nl2br($s['custom_text']);
        }


        $res[]=array(
            'test_name'=>TestsModel::getTestName($testId)
            ,'header'=>$arrHeaderName
        );
       //exit;
          //  return view('results',['res'=>$res]);
                Session::put('res',$res);

                return redirect('/tests/'.$testId.'/results/view');

        //return redirect('results',[
        //    'res'=>$res
        //]);

    }

    public static function view(){


        //$res=array();
        $res=Session::get('res');
        return view('results',['res'=>$res]);
    }

}
