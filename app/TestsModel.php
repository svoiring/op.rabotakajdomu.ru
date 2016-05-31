<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class TestsModel extends Model
{

   //


    protected $table='tests';
    protected $fillable = ['name'];

    /* this method return all serivice logon people */
    public static function getListTests(){
      $p=array();

        $data =DB::table('tests')
            ->select(
            'tests.id'
            ,'tests.name'
            )
            ->get();
        $p=$data;




        return $p;

    }


    public static function getTestName($id=0){
        //$p=array();

        $data =DB::table('tests')
            ->select(
                'tests.id'
                ,'tests.name'
            )->where('tests.id','=',$id)
            ->get();
        //$p=$data;

 
        return $data[0]->name;
    }
         







}
