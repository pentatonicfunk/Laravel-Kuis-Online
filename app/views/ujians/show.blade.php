@extends('layout')
@section('content')
<!-- Main component for a primary marketing message or call to action -->

<div class="panel panel-default">
    <div class="panel-heading">
        <h2>Detail Pengambilan Kuis
            <small>{{$lembar->nama}}</small>
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


        <div class="btn-default btn-lg pull-right popover-hover" data-content="Nilai Akhir">
            @if (!$userjawablembar->wkt_selesai)
            <h1><span class="glyphicon glyphicon-play"></span></h1>
            @else
            <h1><span class="glyphicon glyphicon-ok"></span> {{$userjawablembar->score}}</h1>
            @endif
        </div>

        <blockquote class="pull-right">
            <div class="btn-default btn-xs pull-right popover-hover" data-content="pengambil kuis">
                <span class="glyphicon glyphicon-user"></span> {{$userjawablembar->user->email}}
            </div>
            <div class="clearfix"></div>
            <div class="btn-default btn-xs pull-right popover-hover" data-content="diambil pada">
                <span class="glyphicon glyphicon-time"></span> {{ date("d F Y
                H:i:s",strtotime($userjawablembar->wkt_mulai)) }}
            </div>
            <div class="clearfix"></div>
            <div class="btn-default btn-xs pull-right popover-hover" data-content="selesai pada">
                <span class="glyphicon glyphicon-time"></span> {{ date("d F Y
                H:i:s",strtotime($userjawablembar->wkt_selesai)) }}
            </div>
            <div class="clearfix"></div>
            <div class="btn-default btn-xs pull-right popover-hover" data-content="waktu penyelesaian">
                <span class="glyphicon glyphicon-time"></span> {{$interval}}
            </div>
        </blockquote>

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


        @if ($userjawablembar->wkt_selesai)
        <hr/>
        <!-- Jawaban group-->
        <blockquote>
            <p>Riwayat Jawaban</p>
        </blockquote>

        <div class="panel-group" id="accordion">
            @foreach ($userJawab as $key => $jawab)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="popover-hover" data-toggle="collapse" data-parent="#accordion" href="#{{$jawab->id}}"
                           data-content="{{$jawab->is_kosong ? 'Jawaban Kosong' : ($jawab->is_benar ? 'Jawaban Benar' : 'Jawaban Salah') }}">
                            @if ($jawab->is_kosong)
                            <span class="glyphicon glyphicon-minus"></span>
                            @elseif ($jawab->is_benar)
                            <span class="glyphicon glyphicon-ok"></span>
                            @else
                            <span class="glyphicon glyphicon-remove"></span>
                            @endif
                            Soal #{{$key + 1}}
                        </a>
                    </h4>
                </div>
                <div id="{{$jawab->id}}" class="panel-collapse collapse">
                    <div class="panel-body">
                        <blockquote>
                            {{$jawab->soal->pertanyaan}}
                        </blockquote>

                        <div class="list-group">
                            <a class="list-group-item well-lg">
                                @if($jawab->soal->jawaban[0]->is_benar)
                                <span class="glyphicon glyphicon-ok"></span>
                                @else
                                @endif
                                <strong>A.</strong> {{$jawab->soal->jawaban[0]->jawaban}}
                                @if($jawab->soal->jawaban[0]->id == $jawab->jawaban_id)
                                <span class="badge pull-right popover-hover" data-content="Jawaban Anda">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </span>
                                @endif
                            </a>
                            <a class="list-group-item well-lg">
                                @if($jawab->soal->jawaban[1]->is_benar)
                                <span class="glyphicon glyphicon-ok"></span>
                                @else
                                @endif
                                <strong>B.</strong> {{$jawab->soal->jawaban[1]->jawaban}}
                                @if($jawab->soal->jawaban[1]->id == $jawab->jawaban_id)
                                <span class="badge pull-right popover-hover" data-content="Jawaban Anda">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </span>
                                @endif
                            </a>
                            <a class="list-group-item well-lg">
                                @if($jawab->soal->jawaban[2]->is_benar)
                                <span class="glyphicon glyphicon-ok"></span>
                                @else
                                @endif
                                <strong>C.</strong> {{$jawab->soal->jawaban[2]->jawaban}}
                                @if($jawab->soal->jawaban[2]->id == $jawab->jawaban_id)
                                <span class="badge pull-right popover-hover" data-content="Jawaban Anda">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </span>
                                @endif
                            </a>
                            <a class="list-group-item well-lg">
                                @if($jawab->soal->jawaban[3]->is_benar)
                                <span class="glyphicon glyphicon-ok"></span>
                                @else
                                @endif
                                <strong>D.</strong> {{$jawab->soal->jawaban[3]->jawaban}}
                                @if($jawab->soal->jawaban[3]->id == $jawab->jawaban_id)
                                <span class="badge pull-right popover-hover" data-content="Jawaban Anda">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </span>
                                @endif

                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <br/>
        <br/>
        @endif

        @if (!$userjawablembar->wkt_selesai)
        <a href="{{action('SoalujiansController@show', array($userjawablembar->id, 0))}}"
           class="btn btn-info pull-right">
            <span class="glyphicon glyphicon-play"></span> Lanjut Mengerjakan
        </a>
        @else
        <a href="{{action('UserjawablembarsController@show', array($userjawablembar->lembar->id))}}"
           class="btn btn-success pull-right">
            <span class="glyphicon glyphicon-align-left"></span> Lihat Ranking
        </a>
        @endif

        {{-- todo lihat ranking --}}

    </div>
</div>
@stop