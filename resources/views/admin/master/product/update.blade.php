@extends('admin.master')

@section('judul')
Edit Produk
@endsection

@section('css')
   
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="text-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/admin/product">Master Produk</a></li>
                        <li class="breadcrumb-item active">Form Tambah Produk</li>
                    </ol>
                </div>
                
                <form method="post" action="/admin/product/update" enctype="multipart/form-data">
                
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Form Edit Produk</h3>
                        
                    </div>
                    <div class="card-body">
                            {{ csrf_field() }}
                    <input type="hidden" name="oldkdProduk" value="{{$product->kdProduct}}">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Kode Produk </label>
                                    <input type="text" class="form-control @error('kdProduk') is-invalid @enderror" placeholder="kode Produk" id="kdProduk" name="kdProduk" value="{{ old('kdProduk', $product->kdProduct)}}">
                                        @error('kdProduk')
                                            <span class="msg invalid-feedback" role="alert">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Nama Produk</label>
                                        <input type="text" class="form-control @error('namaProduk') is-invalid @enderror" placeholder="Nama Produk" id="namaProduk" name="namaProduk" value="{{ old('namaProduk', $product->namaProduct)}}">
                                        @error('namaProduk')
                                            <span class="msg invalid-feedback" role="alert">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Kategori</label>
                                        <select class="form-control" id="kategori" name="kategori">
                                            @foreach ($kategori as $item)
                                                <option value="{{ $item->kdKategori }}" 
                                                    {{ old('kategori') == $item->kdKategori ? 'selected="selected"' :
                                                     $product->kdKategori == $item->kdKategori ? 'selected="selected"' : '' }}>
                                                     {{ $item->namaKategori }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Satuan</label>
                                        <select class="form-control" id="satuan" name="satuan">
                                            @foreach ($satuan as $item)
                                                <option value="{{ $item->kdSatuan }}"
                                                    {{ old('satuan') == $item->kdSatuan ? 'selected="selected"' :
                                                     $product->kdSatuan == $item->kdSatuan ? 'selected="selected"' : '' }}>
                                                    {{ $item->namaSatuan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Harga Produk (Rp.)</label>
                                        <input type="number" class="form-control @error('hargaProduk') is-invalid @enderror" placeholder="Harga Produk" id="hargaProduk" name="hargaProduk" value="{{ old('hargaProduk',  $product->hargaJual)}}" >
                                        @error('hargaProduk')
                                            <span class="msg invalid-feedback" role="alert">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Diskon (%)</label>
                                        <input type="number" class="form-control @error('diskon') is-invalid @enderror" placeholder="Diskon" id="diskon" name="diskon" value="{{ old('diskon', $product->diskon)}}">
                                        @error('diskon')
                                            <span class="msg invalid-feedback" role="alert">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Stok</label>
                                        <input type="number" class="form-control @error('stok') is-invalid @enderror" placeholder="Stok" id="stok" name="stok" value="{{ old('stok', $product->qty)}}">
                                        @error('stok')
                                            <span class="msg invalid-feedback" role="alert">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label id="labelKetSnack">Deskripsi Produk </label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" rows="3" id="deskripsi" name="deskripsi">{{ old('deskripsi', $product->deskripsi)}}</textarea>
                                @error('deskripsi')
                                    <span class="msg invalid-feedback" role="alert">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                        
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Status Promo</label>
                                        <select class="form-control" id="promo" name="promo">
                                            <option value="Y" {{ old('promo') == $item->promo ? 'selected="selected"' :
                                                     $product->promo == $item->promo ? 'selected="selected"' : '' }}>Ya</option>
                                            <option value="T" {{ old('promo') == $item->promo ? 'selected="selected"' :
                                                     $product->promo == $item->promo ? 'selected="selected"' : '' }}>Tidak</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label id="labelGambarSnack">Gambar Produk </label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="gambar" name="gambar" accept="image/*">
                                            <label class="custom-file-label" for="gambar">Pilih file</label>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-right">
                            <button type="submit" id="btnSimpan" class="btn btn-primary"><i id="iconbtn" class="fa  fa-check-circle" aria-hidden="true"></i>&nbsp;Simpan</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
       
    </div>
@endsection

@section('script')
    <script>
            $('#gambar').on('change',function(){
                var fileName = $(this).val().split("\\").pop();
                $(this).next('.custom-file-label').html(fileName);
            });
    </script>
@endsection

