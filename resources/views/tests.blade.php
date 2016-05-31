@extends('layouts.master')

<div>
    <ul>
        @foreach( $listTests as $i =>$obj )
         <li type="1"><a href="/tests/{{ $obj->id }}/start"> {{ $obj->name }}</a></li>
        @endforeach
    </ul>



</div>