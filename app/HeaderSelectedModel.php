<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;


class HeaderSelectedModel extends Model
{
    //

    protected $table='header_selected';
    protected $fillable = ['test_header_id','name','valid','is_custom_text','order_index'];


    public static function getSelected($testHeaderId){


        $data =DB::table('header_selected')
            //->join('questions','header_questions.question_id','=','questions.id')
            //->join('test_headers','header_questions.test_header_id','=','test_headers.id')
            ->select(
                'header_selected.id as header_selected_id'
                ,'header_selected.name'
                ,'header_selected.valid'
                ,'header_selected.is_custom_text'
                ,'header_selected.order_index'
                ,'header_selected.is_questions'
                ,'header_selected.true_value'
                ,'header_selected.positive_text'
                ,'header_selected.negative_text'
            )
            ->where('header_selected.test_header_id','=',$testHeaderId)
            //->where('test_headers.test_id','=',$testId)
                ->orderBy('header_selected.order_index','asc')
            ->get();
        return $data;

    }

    public static function getSelectedById($id){


        $data =DB::table('header_selected')
            //->join('questions','header_questions.question_id','=','questions.id')
            //->join('test_headers','header_questions.test_header_id','=','test_headers.id')
            ->select(
                'header_selected.id as header_selected_id'
                ,'header_selected.name'
                ,'header_selected.valid'
                ,'header_selected.is_custom_text'
                ,'header_selected.order_index'
                ,'header_selected.is_questions'
                ,'header_selected.true_value'
                ,'header_selected.positive_text'
                ,'header_selected.negative_text'
            )
            ->where('header_selected.id','=',$id)
            //->where('test_headers.test_id','=',$testId)
            ->orderBy('header_selected.order_index','asc')
            ->get();
        return $data;

    }


}
