<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    "accepted"         => ":attribute harus diterima.",
    "active_url"       => ":attribute bukan URL yang valid.",
    "after"            => ":attribute harus setelah :date.",
    "alpha"            => ":attribute hanya boleh terdiri dari huruf.",
    "alpha_dash"       => ":attribute hanya boleh terdiri dari huruf, angka dan _.",
    "alpha_num"        => ":attribute hanya boleh terdiri dari huruf dan angka.",
    "array"            => ":attribute harus berupa array.",
    "before"           => ":attribute harus sebelum :date.",
    "between"          => array(
        "numeric" => ":attribute harus diantara :min dan :max.",
        "file"    => ":attribute harus diantara :min and :max kilobytes.",
        "string"  => ":attribute harus diantara :min and :max karakter.",
        "array"   => ":attribute harus diantara :min and :max buah.",
    ),
    "confirmed"        => "Konfirmasi :attribute tidak sama.",
    "date"             => ":attribute bukan tanggal yang valid",
    "date_format"      => ":attribute tidak sesuai dengan format :format.",
    "different"        => ":attribute dan :other harus berbeda.",
    "digits"           => ":attribute harus terdiri :digits digit.",
    "digits_between"   => ":attribute harus diantara :min and :max digit.",
    "email"            => "format :attribute tidak valid.",
    "exists"           => ":attribute yang terpilih tidak valid.",
    "image"            => ":attribute harus berupa gambar.",
    "in"               => ":attribute yang dipilih tidak sesuai.",
    "integer"          => ":attribute harus berupa angka.",
    "ip"               => ":attribute bukan alamat IP yang valid.",
    "max"              => array(
        "numeric" => ":attribute tidak boleh lebih besar dari :max.",
        "file"    => ":attribute tidak boleh lebih besar dari :max kilobytes.",
        "string"  => ":attribute tidak boleh lebih besar dari :max karakter.",
        "array"   => ":attribute tidak boleh lebih dari :max buah.",
    ),
    "mimes"            => ":attribute harus berupa berkas dengan tipe: :values.",
    "min"              => array(
        "numeric" => ":attribute minimal :min.",
        "file"    => ":attribute minimal :min kilobytes.",
        "string"  => ":attribute minimal :min karakter.",
        "array"   => ":attribute minimal :min buah.",
    ),
    "not_in"           => ":attribute yang dipilih tidak valid.",
    "numeric"          => ":attribute harus berupa angka.",
    "regex"            => "format :attribute tidak valid.",
    "required"         => ":attribute harus terisi.",
    "required_if"      => ":attribute harus diisi jika :other adalah :value.",
    "required_with"    => ":attribute harus diisi jika :values tersedia.",
    "required_without" => ":attribute harus diisi jika :values tidak tersedia.",
    "same"             => ":attribute dan :other harus sama.",
    "size"             => array(
        "numeric" => ":attribute harus berukuran :size.",
        "file"    => ":attribute harus berukuran :size kilobytes.",
        "string"  => ":attribute harus berukuran :size characters.",
        "array"   => ":attribute harus terdiri dari :size buah.",
    ),
    "unique"           => ":attribute sudah dipilih  / diambil.",
    "url"              => "format :attribute tidak valid.",

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom'           => array(),

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes'       => array(),

);
