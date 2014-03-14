@extends('layout')
@section('content')
<!-- Main component for a primary marketing message or call to action -->

<div class="panel panel-default">
    <div class="panel-heading">
        <h2>Detail Soal
            <small>{{$soal->id}}</small>
            <a href="{{action('SoalsController@index')}}" class="btn btn-default btn-xs">
                <span class="glyphicon glyphicon-th-list"></span> Daftar Soal
            </a>
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

        {{ Form::open(array('method' => 'DELETE', 'action' => array('SoalsController@destroy', $soal->id), 'class' =>
        'pull-right' )) }}
        <a href="{{action('SoalsController@edit', array($soal->id))}}" class="btn btn-warning btn-xs">
            <span class="glyphicon glyphicon-pencil"></span> Edit
        </a>
        <button type="submit" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> Hapus
        </button>
        {{ Form::close() }}

        <br/>
        <br/>


        <blockquote class="pull-right">
            <div class="btn-default btn-xs pull-right popover-hover" data-content="dibuat oleh">
                <span class="glyphicon glyphicon-user"></span> {{$soal->user->email}}
            </div>
            <div class="clearfix"></div>
            <div class="btn-default btn-xs pull-right popover-hover" data-content="dibuat pada">
                <span class="glyphicon glyphicon-plus"></span> {{ date("d F Y H:i",strtotime($soal->created_at)) }}
            </div>
            <div class="clearfix"></div>
            <div class="btn-default btn-xs pull-right popover-hover" data-content="diperbaharui pada">
                <span class="glyphicon glyphicon-pencil"></span> {{ date("d F Y H:i",strtotime($soal->updated_at)) }}
            </div>
        </blockquote>

        <div class="clearfix"></div>

        <blockquote>
            {{$soal->pertanyaan}}
        </blockquote>

        <div class="list-group">
            <a class="list-group-item well-lg">
                @if($soal->jawaban[0]->is_benar)
                <span class="glyphicon glyphicon-ok"></span>
                @else
                <span class="glyphicon glyphicon-remove"></span>
                @endif
                <strong>A.</strong> {{$soal->jawaban[0]->jawaban}}
                <span class="badge">{{$soal->jawaban[0]->poin}}</span>
            </a>
            <a class="list-group-item well-lg">
                @if($soal->jawaban[1]->is_benar)
                <span class="glyphicon glyphicon-ok"></span>
                @else
                <span class="glyphicon glyphicon-remove"></span>
                @endif
                <strong>B.</strong> {{$soal->jawaban[1]->jawaban}}
                <span class="badge">{{$soal->jawaban[1]->poin}}</span>
            </a>
            <a class="list-group-item well-lg">
                @if($soal->jawaban[2]->is_benar)
                <span class="glyphicon glyphicon-ok"></span>
                @else
                <span class="glyphicon glyphicon-remove"></span>
                @endif
                <strong>C.</strong> {{$soal->jawaban[2]->jawaban}}
                <span class="badge">{{$soal->jawaban[2]->poin}}</span>
            </a>


            <a class="list-group-item well-lg">
                @if($soal->jawaban[3]->is_benar)
                <span class="glyphicon glyphicon-ok"></span>
                @else
                <span class="glyphicon glyphicon-remove"></span>
                @endif
                <span class="badge">{{$soal->jawaban[3]->poin}}</span>
                <strong>D.</strong> {{$soal->jawaban[3]->jawaban}}

            </a>
        </div>

    </div>
</div>
@stop