<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class QuestionsModel extends Model
{
    protected $table='header_questions';
    protected $fillable = ['question_id','valid'];

    //


    // DEPRICATTED ?
    public static function getQuestions($testHeaderId=0,$testId){


        $data =DB::table('header_questions')
            ->join('questions','header_questions.question_id','=','questions.id')
            ->join('test_headers','header_questions.test_header_id','=','test_headers.id')
            ->select(
                'header_questions.id as header_question_id'
                ,'questions.id as question_id'
                ,'questions.name'
                ,'header_questions.valid'
            )
            ->where('header_questions.test_header_id','=',$testHeaderId)
            ->where('test_headers.test_id','=',$testId)
            ->get();
        return $data;

    }

    public static function getQuestionById($id){
        $data=DB::table('questions')
            ->select(
                'questions.id as question_id'
                ,'questions.name'
                ,'questions.order_index'
                ,'questions.valid'
                ,'questions.code'
            )
            ->where('questions.id','=',$id)
            ->get();
        return $data;
    }
    public static function getQuestionsSelected($selectedId=0){
        $data =DB::table('header_questions')
            ->join('questions','header_questions.question_id','=','questions.id')
            ->join('test_headers','header_questions.test_header_id','=','test_headers.id')
            ->select(
                'header_questions.id as header_question_id'
                ,'questions.id as question_id'
                ,'questions.name'
                ,'header_questions.valid'
            )
            ->where('header_questions.header_select_id','=',$selectedId)
            ->orderBy('header_questions.order_index','asc')
            ->get();
        return $data;
    }


}
