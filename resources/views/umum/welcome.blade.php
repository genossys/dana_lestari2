@extends('umum.layout')

@section('content')
<!-- slide -->
<div class="multiple-items" style="width: 100%;padding-top: 45px">
    <div class="slide1 align-top" style="padding-top: 45px">
        <div class="isiSlide">

            <p class="judulsl1">
                KREDIT
            </p>

            <p class="judulsl2">
                MODAL KERJA
            </p>

            <a href="/formKredit" class="btn btn-lg tombol" >Kredit Sekarang</a>
        </div>
    </div>

    <div class="slide2 align-top" style="padding-top: 45px">
        <div class="isiSlide">
            <p class="judulsl1">
                DEPOSITO
            </p>

            <p class="judulsl2">
                LESTARI
            </p>

            <a href="/formDeposito" class="btn btn-lg tombol">Deposit Sekarang</a>
        </div>
    </div>
</div>

<!-- produk -->
<section class="ProdukKami container">
    <p class="title text-center">Produk Lestari</p>
    <div class="text-right">
        <div class="row">
            <div class="gambarMultiguna col-md-6 text-center">
                <img class="gambarproduk w-100" src="{{asset('/images/kreditmultiguna.webp')}}" alt="{{asset('/images/kreditmultiguna.webp')}}">
            </div>

            <div class="textMultiguna col-md-6">
                <p class='produktitleisi text-left'>Kredit Multiguna</p>
                <p class="produkisi text-justify">Kredit Multiguna diperuntukkan bagi para individual yang bekerja sebagai karyawan, profesional dan wiraswasta, untuk memenuhi investasi konsumtif ataupun pengembangan usaha yang sudah berjalan.</p>

                <p class="keunggulantitle text-left">Keunggulan:</p>
                <li class="produkisi text-left">Proses cepat 3 hari kerja (Setelah data dinyatakan lengkap).</li>
                <li class="produkisi text-left">Persyaratan mudah.</li>
                <li class="produkisi text-left">Perlindungan asuransi.</li>
                <li class="produkisi text-left">Bebas biaya pinalti untuk pelunasan sewaktu-waktu.</li>
                <li class="produkisi text-left">Bisa Takeover dari bank lain.</li>
            </div>
        </div>
    </div>

    <div class="text-right" style="padding-top: 100px">
        <div class="row">

            <div class="textModalKerja col-md-6">
                <p class='produktitleisi text-left'>Kredit Modal Kerja</p>
                <p class="produkisi text-justify">Fasilitas pinjaman diperuntukan bagi para wirausahawan dan korporasi untuk membiayai keperluan usaha, penambahan modal usaha dan pengembangan usaha yang sudah berjalan dengan perhitungan hanya pembayaran bunga pinjaman setiap bulannya.</p>

                <p class="keunggulantitle text-left">Keunggulan:</p>
                <li class="produkisi text-left">Plafon hingga 15 milyar.</li>
                <li class="produkisi text-left">Proses cepat 3 hari kerja (Setelah data dinyatakan lengkap).</li>
                <li class="produkisi text-left">Persyaratan mudah.</li>
                <li class="produkisi text-left">Perlindungan asuransi.</li>
                <li class="produkisi text-left">Bebas biaya pinalti untuk pelunasan sewaktu-waktu.</li>
            </div>

            <div class="gambarModalKerja col-md-6 text-center">
                <img class="gambarproduk w-100" src="{{asset('/images/kreditmodalkerja.webp')}}" alt="{{asset('/images/kreditmultiguna.webp')}}">
            </div>

        </div>
    </div>

    <!-- <div class="text-right" style="padding-top: 100px">
        <div class="row">
            <div class="gambarBLoan col-md-6 text-center">
                <img class="gambarproduk w-100" src="{{asset('/images/BLoan.webp')}}" alt="{{asset('/images/BLoan.webp')}}">
            </div>

            <div class="textBLoan col-md-6">
                <p class='produktitleisi text-left'>Bridging Loan</p>
                <p class="produkisi text-justify">Fasilitas pinjaman diperuntukan bagi para wirausahawan dan korporasi untuk memenuhi kebutuhan cashflow guna menunjang keperluan usaha, penambahan modal usaha dan pengembangan usaha yang sudah berjalan.</p>

                <p class="keunggulantitle text-left">Keunggulan:</p>
                <li class="produkisi text-left">Plafon hingga 15 Milyar.</li>
                <li class="produkisi text-left">Proses cepat 3 hari kerja (Setelah data dinyatakan lengkap).</li>
                <li class="produkisi text-left">Bebas biaya administrasi dan provisi 3 bulan pertama.</li>
                <li class="produkisi text-left">Bebas biaya pinalti untuk pelunasan sewaktu-waktu.</li>
                <li class="produkisi text-left">Syarat mudah.</li>
            </div>
        </div>
    </div> -->
</section>

@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
@endsection

@section('script')
<script src="{{ asset('/js/genosstyle.js') }}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.multiple-items').slick({
            dots: false,
            infinite: true,
            speed: 1500,
            fade: true,
            arrows: false,
            autoplay: true,
            autoplaySpeed: 4000,
            cssEase: 'linear',
            pauseOnHover: false,

        });
    });
</script>
@endsection
