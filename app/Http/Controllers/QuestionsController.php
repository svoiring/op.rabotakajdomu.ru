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

class QuestionsController extends Controller
{
    //

    public function index($testId,$index){
         $user_name =Session::get('user_name');



         if (empty($user_name)){
             return redirect('/tests'); // <<--- надо потом переправить на страницу которая информирует что не заполненно user_name  или флеш послать
         }

        $selectedList=array();
        $headerId=HeadersModel::getHeaderIdByIndex($testId,$index);

        // тут мы сопаствляем сипосок вопросов темы с  подвыбром в зависимости от вопроса
        foreach(HeaderSelectedModel::getSelected($headerId) as $key =>$val){
            $q=QuestionsModel::getQuestionsSelected($val->header_selected_id);
            $selectedList[]=array('selected_list'=>$val,'questions_list'=>$q);
        }


        return view('questions',[
                'currentIndex'=>$index
                ,'headerName'=>HeadersModel::getHeaderName($testId,$index)
                ,'lastIndex'=>HeadersModel::getLastOrder($testId)
                ,'header'=>HeadersModel::getHeader($testId,$index)
                ,'selectedList'=>$selectedList
                //,'questionsList'=>QuestionsModel::getQuestionsSelected($selectedId)
                ,'testId'=>$testId
                ,'headerId'=>$headerId
        ]);
    }


    public function post(Request $r,$testId,$index){



        //exit;


        $headerId=HeadersModel::getHeaderIdByIndex($testId,$index);
        $lastIndex=HeadersModel::getLastOrder($testId);

        $h=$r->input('h'); // список ответов на выпросы темы

        // обработать если пользователь не выпбрал ни один ответ, это ошибка!
        if (!isset($h)) {
            Session::flash('alert-no-selected','1');
            return redirect('/tests/'.$testId.'/h/'.$index);
        }

        $h['questions']=$r->input('q');
        $h['custom_text']=$r->input('ht');

        Session::put('h['.$headerId.']',$h);
        //print_r($h);


        //echo '<br>';


        //exit;
        //Session::put('t'.$testId.'i'.$index,$r->input('qselect'));
        if ($lastIndex==$index) {



            return redirect()->action('TestResults@index', ['testId' => $testId]);
        }


        $index++;
        return redirect('/tests/'.$testId.'/h/'.$index);

    }

}
