<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class HeadersModel extends Model
{
    //

    protected $table='test_headers';
    protected $fillable = ['name','order_index'];

    /* this method return all serivice logon people */
    public static function getListHeaders($testId=0){


        $data =DB::table('test_headers')
            ->select(
                'test_headers.id'
                ,'test_headers.name'
                ,'test_headers.order_index'
                ,'test_headers.valid'
            )
            ->where('test_headers.test_id','=',$testId)
            ->orderBy('order_index','asc')
            ->get();
        return $data;

    }

    public static function getHeaderName($testId=0,$index=0){


        $data =DB::table('test_headers')
            ->select(
                'test_headers.id'
                ,'test_headers.name'
            )
            ->where('test_headers.order_index','=',$index)
            ->where('test_headers.test_id','=',$testId)
            ->get();

        return isset($data[0]->name)?$data[0]->name:'NaN';

    }

    public static function getHeader($testId=0,$index=0){


        $data =DB::table('test_headers')
            ->select(
                'test_headers.id'
                ,'test_headers.name'
                ,'test_headers.order_index'
                ,'test_headers.valid'
            )
            ->where('test_headers.order_index','=',$index)
            ->where('test_headers.test_id','=',$testId)
             ->get();

        return $data;

    }


    // Возвращает поседний тему в  тесте (нужно для оприделения конца теста и переход на подсчёт)
    public static  function getLastOrder($testId=0){

        $data =DB::table('test_headers')

            ->where('test_headers.test_id','=',$testId)
            ->max('order_index')
            ;//->get();

        return isset($data)?$data:'NaN';


    }

    // возвращает отсортированный список тем по индексу
    public static function getIndexHeaders($testId=0){

        $data =DB::table('test_headers')
            ->select('test_headers.id'
                    ,'test_headers.order_index'
            )
            ->where('test_headers.test_id','=',$testId)
            ->orderBy('test_headers.order_index','asc')
            ->get();

        return isset($data)?$data:'NaN';


    }

    // Возвращает PK ID темы по его индексу
    public static  function getHeaderIdByIndex($testId,$index){
        $data =DB::table('test_headers')
            ->select(
                'test_headers.id'
            )
            ->where('test_headers.test_id','=',$testId)
            ->where('test_headers.order_index','=',$index)
            ->get();

        return isset($data[0]->id)?$data[0]->id:'NaN';
    }


}
