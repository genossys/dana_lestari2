@extends('umum.layout')

@section('content')
<!-- form kredit -->
<section style="padding-top: 70px" class="container">
    <p class="judulForm text-center">
        Form Deposito
    </p>

    <p>
        Silahkan isi form dibawah ini
    </p>

    <form action="#" method="post">
        <div class="form-group">
            <label class="font-weight-bold">Nama <span class="text-danger">*</span></label>
            <input type="text" class="form-control" placeholder="Nama" id="nama" name="nama">
        </div>

        <div class="form-group">
            <label class="font-weight-bold">No. Telp <span class="text-danger">*</span></label>
            <input type="number" class="form-control" placeholder="No. Telp" id="noTelp" name="noTelp">
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" placeholder="Email" id="email" name="email">
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Lokasi Domisili <span class="text-danger">*</span></label>
            <select class="form-control" id="domisili" name="domisili">
                <option value="Surakarta">Surakarta</option>
                <option value="Semarang">Semarang</option>
                <option value="Klaten">Klaten</option>
                <option value="Karanganyar">Karanganyar</option>
                <option value="Boyolali">Boyolali</option>
            </select>
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Pekerjaan <span class="text-danger">*</span></label>
            <select class="form-control" id="pekerjaan" name="pekerjaan">
                <option value="Karyawan">Karyawan</option>
                <option value="Wirausaha">Wirausaha</option>
                <option value="Profesional">Profesional</option>
                <option value="Perusahaan">Perusahaan</option>
                <option value="Pekerjaan Lain">Pekerjaan Lain</option>
            </select>
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Jumlah penghasilan <span class="text-danger">*</span></label>
            <input type="number" class="form-control" placeholder="Jumlah Penghasilan" id="penghasilan" name="penghasilan">
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Jenis jaminan <span class="text-danger">*</span></label>
            <select class="form-control" id="jaminan" name="jaminan">
                <option value="Rumah">Rumah</option>
                <option value="Ruko">Ruko</option>
                <option value="Tanah">Tanah</option>
                <option value="Gudang">Gudang</option>
                <option value="Pabrik">Pabrik</option>
            </select>
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Jumlah Pinjaman <span class="text-danger">*</span></label>
            <input type="number" class="form-control" placeholder="Jumlah Pinjaman" id="pinjaman" name="pinjaman">
        </div>

        <p class="font-weight-bold">Syarat dan ketentuan <span class="text-danger">*</span></p>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Setuju dengan syarat dan ketentuan</label>
        </div>
        <p class="small">Dengan mengisi form ini, Saya menyetujui Syarat dan Ketentuan dan bersedia untuk dihubungi oleh BPR Lestari Jakarta. Saya memberi kuasa kepada BPR Lestari Jakarta untuk memeriksa informasi yang Saya berikan dan menghubungi sumber informasi yang layak seperti SLIK, biro kredit atau sejenisnya.</p>

        <button class="btn tombolAjukan">Ajukan Sekarang</button>
    </form>
</section>
@endsection
