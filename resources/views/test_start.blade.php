@extends('layouts.master')

<div>
   <h2>{{ $testName }}</h2>
    <div>Представтесь:</div>
    <div>

        <form action="{{ URL::current() }}" method="post">
            <div>
                <div style="float:left;">Ваше имя:</div><div style="float:left;"><input name="user_name" style="font-family: 'Open Sans'" type="text" value="{{ old('user_name') }}"></div>
                <div style="clear: both"></div>
            </div>
            <div>
                <input style="font-family: 'Open Sans'"  type="submit" value="Старт!">
            </div>
            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
        </form>
    </div>
</div>

Всего вопросов: {{ $lastIndex }}