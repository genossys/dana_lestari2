@extends('umum.layout')

@section('content')
<!-- form kredit -->
<section class="deposito pb-4">
    <div class="container card pt-4 pb-4">
        <p class="judulForm text-center">
            Form Deposito
        </p>

        <div class="row">
            <div class="col-md-6">
                <form action="/ajukandeposito" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="font-weight-bold">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Nama" id="nama" name="nama" value="{{old('nama')}}" required>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">No. Telp <span class="text-danger">*</span><small>&nbsp; ex. 6287750505xxx</small></label>
                        <input type="number" class="form-control" placeholder="No. Telp" id="telp" name="telp" value="{{old('telp')}}" required>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" placeholder="Email" id="email" name="email" value="{{old('email')}}" required>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Lokasi Domisili <span class="text-danger">*</span></label>
                        <select class="form-control" id="domisili" name="domisili">

                            @foreach ($kota as $item)
                            <option value="{{$item['name']}}">{{$item['name']}}</option>
                            @endforeach
                        </select>
                    </div>



                    <div class="butuhBantuan">
                        <p class="font-weight-bold mt-5 mb-0">Syarat dan ketentuan <span class="text-danger">*</span></p>

                        <p class="small text-justify">1. Program ini berlaku bagi seluruh masyarakat WNI dan WNA yang bertempat tinggal di sekitar JATENG dan melakukan penempatan deposito melalui aplikasi online danalestari.com</p>
                        <p class="small text-justify">2. Program ini ditujukan hanya untuk transaksi pembukaan rekening deposito dengan pilihan jangka waktu sesuai dengan kebutuhan (1, 3, 6 atau 12 bulan)</p>
                        <p class="small text-justify">3. Minimum penempatan deposito mulai dari Rp 10.000.000,-</p>
                        <p class="small text-justify">4. Suku bunga deposito adalah LPS Bank Perkreditan Rakyat yang berlaku saat penempatan deposito</p>
                        <p class="small text-justify">5. Dalam hal terdapat perubahan suku bunga LPS Bank Perkreditan Rakyat maka akan secara tertulis dikirimkan account statement setiap tanggal jatuh tempo bilyet deposito</p>
                        <p class="small text-justify">6. Syarat dan ketentuan umum ini merupakan satu kesatuan yang tidak terpisahkan dari syarat dan ketentuan umum rekening dan fasilitas atau layanan perbankan PT BPR Lestari Jateng</p>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Setuju dengan syarat dan ketentuan</label>
                        </div>

                    </div>
                    <button type="submit" class="btn tombolAjukan">Ajukan Sekarang</button>
                </form>
            </div>

            <div class="col-md-5 pr-5 butuhBantuan offset-1">
                <p class="formbold">Butuh Bantuan?</p>
                <p>Kami akan sangat senang bila bisa membantu anda. Hubungi kami:</p>

                <a href="tel:+62271710003"><img src="{{asset('images/tanya lestari.png')}}" alt="{{asset('images/tanya lestari.png')}}"></a>
            </div>
        </div>

    </div>
</section>
@endsection
