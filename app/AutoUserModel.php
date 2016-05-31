<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AutoUserModel extends Model
{
    //

    protected $table='autouser';
    // header_id - это заголовок вопроса теста
    // selected_id -это варианты выбора на вопросы заголовка
    // question_id - это варианты подвопросов выбора
    protected $fillable = ['fio','login','test_id','header_id','selected_id','questions_id','test_start_time','valid','key','custom_text'];

}
