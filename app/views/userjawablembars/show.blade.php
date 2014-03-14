@extends('layout')
@section('content')
<!-- Main component for a primary marketing message or call to action -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h2>Peringkat Kuis
            <small>{{$userJawabLembars->first()->lembar->nama}}</small>
        </h2>
    </div>

    <div class="panel-body">


        <div class="">

            @if (Session::has('messages'))
            @foreach (Session::get('messages') as $message)
            @if ($message[0] == 'error')
            <div class="alert alert-danger">{{$message[1]}}</div>
            @elseif ($message[0] == 'success')
            <div class="alert alert-success">{{$message[1]}}</div>
            @endif
            @endforeach
            @endif


            <div class="btn-default btn-lg pull-right popover-hover" data-content="Jumlah Pengambilan">
                <h1><span class="glyphicon glyphicon-align-left"></span> {{count($userJawabLembars)}}</h1>
            </div>

            <div class="clearfix"></div>
            <dl class="dl-horizontal">
                <dt>Keterangan</dt>
                <dd>{{$lembar->keterangan}}</dd>
                <dt>Kategori</dt>
                <dd>{{$lembar->kategori->nama}}</dd>
                <dt>Jumlah Soal</dt>
                <dd>{{$lembar->limit}}</dd>
                <dt>Batas Waktu</dt>
                <dd>{{$lembar->batas_waktu}} Menit</dd>
                <dt>Acak Soal</dt>
                <dd>{{$lembar->is_random ? 'Ya' : 'Tidak'}}</dd>

            </dl>


            @if ($userJawabLembars->isEmpty())
            <div class="">
                @if(!is_array($userJawabLembars))
                <div class="alert alert-warning"><strong>Maaf</strong> daftar pengambilan kuis tidak ditemukan</div>
                @endif
            </div>
            @endif

            @if (!$userJawabLembars->isEmpty())

            <table class="table table-hover table-responsive">
                <thead>
                <th>Peringkat</th>
                <th>Pengambil</th>
                <th>Waktu Pengambilan</th>
                <th>Nilai Akhir</th>
                <th>Waktu Penyelesaian</th>
                <th>Aksi</th>
                </thead>
                <tbody>
                @foreach($userJawabLembars as $key => $userJawabLembar)
                <tr class="{{$userJawabLembar->user->id == Sentry::getUser()->id ? 'success' : ''}}">
                    <td>
                        #{{$key + 1}}
                    </td>
                    <td>
                        {{$userJawabLembar->user->email}}
                    </td>
                    <td>
                        {{ date("d F Y H:i:s",strtotime($userJawabLembar->wkt_mulai)) }}
                    </td>
                    <td>
                        {{$userJawabLembar->wkt_selesai ? $userJawabLembar->score : 'Belum Selesai'}}
                    </td>
                    <td>
                        {{$userJawabLembar->interval}}
                    </td>
                    <td>


                        {{ Form::open(array('method' => 'DELETE', 'action' => array('UjiansController@destroy',
                        $userJawabLembar->id) ))
                        }}

                        @if ($userJawabLembar->user->id == Sentry::getUser()->id ||
                        Sentry::getUser()->hasAccess('admin'))
                        <a href="{{action('UjiansController@show', array($userJawabLembar->id))}}"
                           class="btn btn-primary btn-xs">
                            <span class="glyphicon glyphicon-eye-open"></span> Lihat
                        </a>
                        @endif


                        @if (Sentry::getUser()->hasAccess('admin'))
                        <button type="submit" class="btn btn-danger btn-xs"><span
                                class="glyphicon glyphicon-remove"></span>
                            Hapus
                        </button>
                        {{ Form::close() }}
                        @endif


                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            @endif


        </div>
    </div>
    @stop