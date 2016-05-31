@extends('layouts.master')

<h1>Результат</h1>


    <h3><span>{{ $res[0]['test_name']  }}</span></h3>
    <ul type="none">
        @foreach($res[0]['header'] as $key=>$val)
            <li type="1"><strong>{{ $val['header_name'] }}</strong>
                <ul type="none">
                    <li > <span style="color: {{  $val['true']>=$val['header_valid']?'green':'red' }}" >{{$val['selected_name'] }} <span> (  {{ $val['result_text'] }} )</span> </span></li>
                    @if(!empty($val['Q']))
                        <ul type="circle">

                            @foreach($val['Q'] as $key1=>$val1)
                            <li>
                                {{ $val1['name'][0]->name }}
                            </li>
                            @endforeach
                        </ul>
                    @endif
                    @if(!empty($val['custom_text']))
                        <ul type="none">
                            <li type="none">
                               <?php echo nl2br($val['custom_text']) ?>
                            </li>
                        </ul>
                    @endif
                </ul>
            </li>
        @endforeach
    </ul>
