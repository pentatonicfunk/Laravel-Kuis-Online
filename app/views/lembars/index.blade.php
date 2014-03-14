@extends('layout')
@section('content')
<!-- Main component for a primary marketing message or call to action -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h2>Daftar Kuis
            <small>({{$count}})</small>
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


        <a href="{{action('LembarsController@create')}}" class="btn btn-primary btn-sm pull-right">
            <span class="glyphicon glyphicon-plus"></span> Tambah Kuis
        </a>

        <br/>
        <br/>

        @if ($lembars->isEmpty())
        <div class="">
            @if(!is_array($lembars))
            <div class="alert alert-warning"><strong>Maaf</strong> daftar kuis tidak ditemukan</div>
            @endif
        </div>
        @endif

        @if (!$lembars->isEmpty())
        <table class="table table-striped table-responsive">
            <thead>
            <th>Judul</th>
            <th>Keterangan</th>
            <th>Kategori</th>
            <th>Jumlah Soal</th>
            <th>Batas Waktu</th>
            <th>Acak Soal</th>
            <th>Persediaan Soal</th>
            <th>Oleh</th>
            <th>Aksi</th>
            </thead>
            <tbody>
            @foreach($lembars as $lembar)
            <tr>
                <td>
                    {{$lembar->nama}}
                </td>
                <td>
                    <p class="popover-hover" data-content="{{ $lembar->keterangan }}">
                        {{Str::limit(strip_tags($lembar->keterangan), 10)}}</p>
                </td>
                <td>
                    {{$lembar->kategori->nama}}
                </td>
                <td>
                    {{$lembar->limit}}
                </td>
                <td>
                    {{$lembar->batas_waktu}} Menit
                </td>
                <td>
                    {{$lembar->is_random ? 'Ya' : 'Tidak'}}
                </td>
                <td>
                    {{$lembar->SoalHasLembar->count()}}
                </td>
                <td>
                    {{$lembar->user->email}}
                </td>
                <td>
                    {{ Form::open(array('method' => 'DELETE', 'action' => array('LembarsController@destroy',
                    $lembar->id) ))
                    }}
                    <a href="{{action('LembarsController@show', array($lembar->id))}}" class="btn btn-primary btn-xs">
                        <span class="glyphicon glyphicon-eye-open"></span> Lihat
                    </a>
                    <a href="{{action('LembarsController@edit', array($lembar->id))}}" class="btn btn-warning btn-xs">
                        <span class="glyphicon glyphicon-pencil"></span> Edit
                    </a>
                    <button type="submit" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span>
                        Hapus
                    </button>
                    {{ Form::close() }}

                </td>
            </tr>
            @endforeach
            </tbody>
        </table>

        {{$lembars->links()}}
        @endif

    </div>
</div>
@stop