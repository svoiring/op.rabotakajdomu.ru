@extends('layouts.master')

<div>

    {{ Session::get('user_name') }}

<br>
    <h3>{{ $headerName }}</h3>

</div>

@if(Session::get('alert-no-selected')==1)
    <div style="color: red">
        Не выбран ответ, пожалуйста выберите один из вариантов!
    </div>
@endif
<div>
<form id="form" action="{{ URL::current() }}" method="post">
    <div>
        <ul type="none" style="font-weight: bold;" >
            @foreach($selectedList as $index =>$q)
                <li type="a">
                    <input  name="h[{{ $headerId }}]" type="radio" value="{{ $q['selected_list']->header_selected_id }}">
                    {{ $q['selected_list']->name }}

                    @if($q['selected_list']->is_custom_text==1)
                      <ul>   <li type="none">
                                <textarea name="ht" cols="60" rows="5" placeholder="Свой вариант"></textarea>
                             </li>
                      </ul>
                    @endif
                    @if($q['selected_list']->is_questions==1)
                            <ul type="none" style="font-weight: normal;" >
                                @foreach($q['questions_list'] as $index1 =>$q1)
                                    <li type="1">
                                        <input name="q[{{ $q1->question_id }}]" type="checkbox" value="{{ $q1->valid }}">
                                         {{ $q1->name }}
                                    </li>
                                @endforeach
                            </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
    <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
    @if ($currentIndex==$lastIndex)
        <a href="#" onclick="document.getElementById('form').submit();return false;">Результат</a>
    @else
        <a href="#" onclick="document.getElementById('form').submit();return false;">Далее &rightarrow;</a>
    @endif
</form>
</div>
<div>
<?php
    //$k=Session::get('t'.$testId.'i'.$currentIndex);
    //    print_r($k);
    ?>
</div>
