@extends('umum.layout')

@section('content')
<!-- form kredit -->
<section  class="deposito pb-4">
    <div class="container card pt-4 pb-4">
        <p class="judulForm text-center">
            Form Deposito
        </p>

        <div class="row">
            <div class="col-md-7">
                <form action="/ajukandeposito" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="font-weight-bold">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Nama" id="nama" name="nama" value="{{old('nama')}}" required>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">No. Telp <span class="text-danger">*</span></label>
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

                    <p class="font-weight-bold mt-5 mb-0">Syarat dan ketentuan <span class="text-danger">*</span></p>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Setuju dengan syarat dan ketentuan</label>
                    </div>
                    <p class="small text-justify">Dengan mengisi form ini, Saya menyetujui Syarat dan Ketentuan dan bersedia untuk dihubungi oleh BPR Lestari Jateng. Saya memberi kuasa kepada BPR Lestari Jateng untuk memeriksa informasi yang Saya berikan dan menghubungi sumber informasi yang layak seperti SLIK, biro kredit atau sejenisnya.</p>

                    <button type="submit" class="btn tombolAjukan">Ajukan Sekarang</button>
                </form>
            </div>

            <div class="col-md-5 p-2">
                <p class="formbold">Butuh Bantuan?</p>
                <p>Kami akan sangat senang bila bisa membantu anda. Hubungi kami:</p>

                <img src="{{asset('images/tanya lestari.png')}}" alt="{{asset('images/tanya lestari.png')}}">
            </div>
        </div>

    </div>
</section>
@endsection
