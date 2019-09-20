@extends('umum.layout')

@section('content')
<!-- form kredit -->
<section style="padding-top: 100px" class="pb-4 deposito">
    <div class="container card pt-4 pb-4">
        <p class="judulForm text-center">
            Form Kredit
        </p>

        <div class="ml-1 mr-1 row">
            <div class="col-md-6">

                <form action="/ajukankredit" method="post">
                    @csrf
                    <div class="form-group">
                        <label class="font-weight-bold">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Nama" id="nama" name="nama" value="{{old('nama')}}" required>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">No. Telp <span class="text-danger">* <small>&nbsp; ex. 6287750505xxx</small></span></label>
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
                        <label class="font-weight-bold">Jumlah pinjaman <span class="text-danger">*<small> &nbsp; min 100 Juta</small></span></label>
                        <input type="number" class="form-control" placeholder="Jumlah Pinjaman" id="pinjaman" name="pinjaman" required>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Jenis jaminan <span class="text-danger">*</span></label>
                        <select class="form-control" id="jaminan" name="jaminan">
                            <option value="Rumah">Rumah</option>
                            <option value="Ruko">Ruko</option>
                            <option value="Tanah">Tanah</option>
                            <option value="Gudang">Gudang</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Jumlah Penghasilan <span class="text-danger">*</span></label>
                        <select class="form-control" id="penghasilan" name="penghasilan">
                            <option value="Kurang dari 10 Juta">Kurang dari 10 Juta</option>
                            <option value="10 Juta - 25 Juta">10 Juta - 25 Juta</option>
                            <option value="25 Juta - 50 Juta">25 Juta - 50 Juta</option>
                            <option value="50 Juta - 100 Juta">50 Juta - 100 Juta</option>
                            <option value="Lebih dari 100 Juta">Lebih dari 100 Juta</option>
                        </select>

                    </div>

                    <p class="font-weight-bold">Syarat dan ketentuan <span class="text-danger">*</span></p>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="cek" required>
                        <label class="form-check-label" for="exampleCheck1">Setuju dengan syarat dan ketentuan</label>
                    </div>
                    <p class="small text-justify">Dengan mengisi form ini, Saya menyetujui Syarat dan Ketentuan dan bersedia untuk dihubungi oleh BPR Lestari Jateng. Saya memberi kuasa kepada BPR Lestari Jateng untuk memeriksa informasi yang Saya berikan dan menghubungi sumber informasi yang layak seperti SLIK, biro kredit atau sejenisnya.</p>

                    <button type="submit" class="btn tombolAjukan">Ajukan Sekarang</button>
                </form>
            </div>

            <div class="col-md-5 pr-2 butuhBantuan offset-1">
                <label for="syarat">Syarat Dokumen dan Agunan</label>
                <div class="card card-default collapsed-card">
                    <div class="card-header expandViews" data-widget="collapse">
                        <h3 class="card-title">Karyawan</h3>

                        <div class="card-tools ">
                            <button type="button" class="btn btn-tool " data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body expandViewsBody">
                        <li>Copy KTP (Suami/Istri yang masih berlaku)</li>
                        <li>Copy Kartu Keluarga </li>
                        <li>Copy Rekening Koran/Tabungan 3 Bulan Terakhir</li>
                        <li>Slip Gaji Terbaru</li>
                        <li>Copy Surat Keterangan Bekerja</li>
                        <li>Copy SHM/SHGB</li>
                        <li>Copy IMB</li>
                        <li>Copy PBB</li>
                        <li>Copy Riwayat Pinjaman di bank lain (jika take over)</li>
                    </div>
                    <!-- /.card-body -->
                </div>

                <div class="card card-default collapsed-card">
                    <div class="card-header expandViews" data-widget="collapse">
                        <h3 class="card-title">Profesional</h3>

                        <div class="card-tools ">
                            <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body expandViewsBody">
                        <li>Copy KTP (Suami/Istri yang masih berlaku)</li>
                        <li>Copy Kartu Keluarga</li>
                        <li>Copy Akta Nikah dari Catatan Sipil/Cerai Dari Pengadilan/Kematian</li>
                        <li>TDP/SIUP/Surat Keterangan Usaha</li>
                        <li>Copy Catatan Keuangan</li>
                        <li>Copy Rekening Koran/Tabungan 3 Bulan Terakhir</li>
                        <li>Slip Gaji Terbaru</li>
                        <li>Copy Surat Keterangan Bekerja</li>
                        <li>Copy Surat Keputusan Pengangkatan</li>
                        <li>Copy Surat Keterangan Praktek/Ijin Praktek</li>
                        <li>Copy Keanggotaan Profesional</li>
                        <li>Surat Rekomendasi Dari Tempat Bekerja</li>
                        <li>Copy SHM/SHGB</li>
                        <li>Copy IMB</li>
                        <li>Copy PBB</li>
                        <li>Copy Riwayat Pinjaman di bank lain (jika take over)</li>
                    </div>

                    <!-- /.card-body -->
                </div>

                <div class="card card-default collapsed-card ">
                    <div class="card-header expandViews" data-widget="collapse">
                        <h3 class="card-title">Wiraswasta</h3>

                        <div class="card-tools ">
                            <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body expandViewsBody">
                        <li>Copy KTP (Suami/Istri yang masih berlaku)</li>
                        <li>Copy Kartu Keluarga</li>
                        <li>Copy Akta Nikah dari Catatan Sipil/Cerai Dari Pengadilan/Kematian</li>
                        <li>TDP/SIUP/Surat Keterangan Usaha</li>
                        <li>Neraca (Rugi/Laba)/Laporan Keungan</li>
                        <li>Copy Catatan Keuangan</li>
                        <li>Copy Rekening Koran/Tabungan 3 Bulan Terakhir</li>
                        <li>Copy SHM/SHGB</li>
                        <li>Copy IMB</li>
                        <li>Copy PBB</li>
                        <li>Copy Riwayat Pinjaman di bank lain (jika take over)</li>
                    </div>

                    <!-- /.card-body -->
                </div>

                <div class="card card-default collapsed-card ">
                    <div class="card-header expandViews" data-widget="collapse">
                        <h3 class="card-title">Perusahaan</h3>

                        <div class="card-tools ">
                            <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body expandViewsBody">
                        <li>Copy KTP Seluruh Pengurus</li>
                        <li>Akta Pendirian dan Perubahan Terbaru Jika Ada</li>
                        <li>SK Kemenkumham</li>
                        <li>NPWP Perusahaan</li>
                        <li>Tanda Daftar Perusahaan</li>
                        <li>Surat Izin Usaha</li>
                        <li>Surat Keterangan Domisili Usaha</li>
                        <li>Neraca (Rugi/Laba)/Laporan Keuangan</li>
                        <li>Copy Catatan Keuangan</li>
                        <li>Copy Rekening Koran/Tabungan 6 Bulan Terakhir</li>
                    </div>

                    <!-- /.card-body -->
                </div>
                <p class="formbold mt-5">Butuh Bantuan?</p>
                <p>Kami akan sangat senang bila bisa membantu anda. Hubungi kami:</p>

                <a href="tel:+62271710003"><img src="{{asset('images/tanya lestari.png')}}" alt="{{asset('images/tanya lestari.png')}}"></a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('css')

@endsection

@section('script')

<script>
    $('.expandViews').click(function() {
        $("i", this).toggleClass("fa fa-plus");
        $("i", this).toggleClass("fa fa-minus");
    });
</script>
@endsection
