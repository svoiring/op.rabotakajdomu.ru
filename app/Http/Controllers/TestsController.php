<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\TestsModel;
use App\HeadersModel;
use Session;


class TestsController extends Controller
{
    //


    public function index(){
	
        return view('tests',['listTests'=>TestsModel::getListTests()]);


    }



    function start($testId){
        return view('test_start',[
                'testId'=>$testId,
                'testName'=>TestsModel::getTestName($testId),
                'lastIndex'=>HeadersModel::getLastOrder($testId)

        ]);
    }



    // Этот метод редеректин на выбор вариантов ответа вопроса  т.е. на сам опросник
    public function enter(Request $r,$testId){
        Session::put('user_name',$r->input('user_name'));



        // вот тут нужно получить  правильный стартоый headerId путём запрашивания первого элемента по index_order полю
        // fix: и последний.

        //$headerId=HeadersModel::getHeaderIdByIndex($testId,1);
        $session_time_start=date('Y-m-d H:i:s');
        Session::put('test_start_time',$session_time_start);
        $index=1;
        return redirect('/tests/'.$testId.'/h/'.$index); // goto QuestionController
        //return redirect()->route('questions',['test'=>$testId]);
    }

}
