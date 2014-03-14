@extends('layout')
@section('content')
<!-- Main component for a primary marketing message or call to action -->

<div class="panel panel-default">
    <div class="panel-heading">
        <h2>{{$nomor}}
            <small>/ {{count($all_soal_ids)}}</small>

            <div id="countdown" class="pull-right btn-danger btn popover-hover" href="#"
                 data-content="Sisa Waktu Mengerjakan"></div>
            <div id="until" class="hide">{{$max_time}}</div>
        </h2>
    </div>
    <div class="panel-body">

        @if (Session::has('messages'))
        @foreach (Session::get('messages') as $message)
        @if ($message[0] == 'error')
        <div class="alert alert-danger">{{$message[1]}}</div>
        @elseif ($message[0] == 'success')
        <div class="alert alert-success">{{$message[1]}}</div>
        @endif
        @endforeach
        @endif

        <div class="clearfix"></div>

        {{ Form::open(array('method' => 'put', 'role' => 'form', 'class' => 'form-horizontal', 'action' => array(
        'SoalujiansController@update', $userjawablembar->id, $soal->id )) ) }}
        <blockquote>
            {{$soal->pertanyaan}}
        </blockquote>

        <div class="list-group">
            <a class="list-group-item well-lg">
                {{Form::radio('jawaban', $soal->jawaban[0]->id)}}
                &nbsp;
                <strong>A.</strong> {{$soal->jawaban[0]->jawaban}}
            </a>
            <a class="list-group-item well-lg">
                {{Form::radio('jawaban', $soal->jawaban[1]->id)}}
                &nbsp;
                <strong>B.</strong> {{$soal->jawaban[1]->jawaban}}
            </a>
            <a class="list-group-item well-lg">
                {{Form::radio('jawaban', $soal->jawaban[2]->id)}}
                &nbsp;
                <strong>C.</strong> {{$soal->jawaban[2]->jawaban}}
            </a>


            <a class="list-group-item well-lg">
                {{Form::radio('jawaban', $soal->jawaban[3]->id)}}
                &nbsp;
                <strong>D.</strong> {{$soal->jawaban[3]->jawaban}}

            </a>
        </div>


        <div class="pull-right clearfix">
            @if (!$is_last_soal)
            <a href="{{action('SoalujiansController@show', array($userjawablembar->id, $next_soal))}}"
               class="btn btn-default btn-sm">Lewati</a>
            @endif
            {{Form::submit($is_last_soal ? 'Lihat Hasil' : 'Lanjut', array('class' => 'btn btn-success btn-lg'))}}
        </div>

        {{ Form::close()}}

    </div>
</div>
@stop