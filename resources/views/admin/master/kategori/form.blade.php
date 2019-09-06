@extends('admin.master')

@section('judul')
    Data Kategori
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="text-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/admin/kategori">Master Kategori</a></li>
                        <li class="breadcrumb-item active">Form Tambah Kategori</li>
                    </ol>
                </div>

                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Form Tambah Kategori</h3>
                    </div>
                    <form method="post" action="/admin/kategori/add">
                    <div class="card-body">
                        
                            @csrf
                            <div class="form-group">
                                <label>Kode Kategori</label>
                                <input type="text" class="form-control @error('kdkategori') is-invalid @enderror" placeholder="Kode Kategori" id="kdkategori" name="kdkategori" value="{{ old('kdkategori')}}">
                                @error('kdkategori')
                                    <span class="msg invalid-feedback" role="alert">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Nama Kategori</label>
                                <input type="text" class="form-control @error('namakategori') is-invalid @enderror" placeholder="Nama Kategori" id="namakategori" name="namakategori" value="{{ old('namakategori')}}">
                                    @error('namakategori')
                                        <span class="msg invalid-feedback" role="alert">
                                            {{$message}}
                                        </span>
                                    @enderror
                            </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-right">
                            <button type="submit" id="btnSimpan" class="btn btn-primary"><i id="iconbtn" class="fa  fa-check-circle" aria-hidden="true"></i>&nbsp;Simpan</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection