@extends('layout')
@section('content')
<!-- Main component for a primary marketing message or call to action -->

<div class="panel panel-default">
    <div class="panel-heading">
        <h2>Edit Kuis
            <small>{{$lembar->nama}}</small>
            <a href="{{action('LembarsController@show', $lembar->id)}}" class="btn btn-default btn-sm">
                <span class="glyphicon glyphicon-eye-open"></span> Lihat Kuis
            </a>
            <a href="{{action('LembarsController@index')}}" class="btn btn-default btn-xs">
                <span class="glyphicon glyphicon-th-list"></span> Daftar Kuis
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


        {{ Form::open(array('method' => 'put', 'role' => 'form', 'class' => 'form-horizontal', 'action' => array(
        'lembars.update', $lembar->id)) ) }}


        <div class="form-group">
            {{Form::label('Judul', 'Judul', array('class' => 'col-sm-2 control-label'));}}
            <div class="col-sm-10">
                {{Form::text('Judul', Input::old('Judul') ? Input::old('Judul') : $lembar->nama, array('class' =>
                'form-control'))}}
            </div>
        </div>


        <div class="form-group">
            {{Form::label('Keterangan', 'Keterangan', array('class' => 'col-sm-2 control-label'));}}
            <div class="col-sm-10">
                {{Form::textarea('Keterangan', Input::old('Keterangan') ? Input::old('Keterangan') : $lembar->keterangan
                , array('class' => 'form-control wys-textarea'
                ))}}
            </div>
        </div>

        {{-- kategori --}}
        <div class="form-group">
            {{Form::label('Kategori', 'Kategori', array('class' => 'col-sm-2 control-label'));}}
            <div class="col-sm-10">
                {{Form::select('Kategori', $kategoriselect, Input::old('Kategori') ? Input::old('Kategori') :
                $lembar->kategori_id, array('class' => 'form-control' ))}}
            </div>
        </div>

        {{-- limit --}}
        <div class="form-group">
            <label class="col-sm-2 control-label" for="Jumlah_Soal">
                Jumlah Soal <span class="glyphicon glyphicon-question-sign popover-hover"
                                  data-content="Jumlah soal yang akan ditampilkan pada <b>kuis</b>."></span>
            </label>

            <div class="col-sm-1">
                {{Form::text('Jumlah_Soal', Input::old('Jumlah_Soal') ? Input::old('Jumlah_Soal') : $lembar->limit,
                array('class' =>
                'form-control', 'style' => ''))}}
            </div>
        </div>

        {{-- batas waktu --}}
        <div class="form-group">
            <label class="col-sm-2 control-label" for="Jumlah_Soal">
                Batas Waktu <span class="glyphicon glyphicon-question-sign popover-hover"
                                  data-content="Batas Waktu penyelesaian <b>kuis</b> dalam satuan <b>menit</b>."></span>
            </label>

            <div class="col-sm-1">
                {{Form::text('Batas_Waktu', Input::old('Batas_Waktu') ? Input::old('Batas_Waktu') :
                $lembar->batas_waktu, array('class' =>
                'form-control', 'style' => ''))}}
            </div>
        </div>

        {{-- random --}}
        <div class="form-group">
            <label class="col-sm-2 control-label" for="Acak_Soal">
                Acak Soal <span class="glyphicon glyphicon-question-sign popover-hover"
                                data-content="Preferensi urutan soal yang akan ditampilkan pada <b>kuis</b>. <br/>Jika <em>dicentang</em> maka sistem akan menampilkan soal pada kuis secara <b>acak</b>."></span>
            </label>

            <div class="col-sm-10">
                {{Form::checkbox('Acak_Soal', 1, Input::old('Acak_Soal') ? Input::old('Acak_Soal') : $lembar->is_random,
                array('id' => 'Acak_Soal'))}}
            </div>
        </div>


        <div class="pull-right clearfix">
            <a href="{{action('LembarsController@show', $lembar->id)}}" class="btn btn-default btn-sm">Batal</a>
            {{Form::submit('Simpan', array('class' => 'btn btn-success btn-lg'))}}
        </div>

        {{ Form::close()}}
    </div>
</div>
@stop