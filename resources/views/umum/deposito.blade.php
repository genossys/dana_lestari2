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

                    <p class="font-weight-bold mt-5 mb-0">Syarat dan ketentuan <span class="text-danger">*</span></p>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Setuju dengan syarat dan ketentuan</label>
                    </div>
                    <p class="small text-justify">Dengan mengisi form ini, Saya menyetujui Syarat dan Ketentuan dan bersedia untuk dihubungi oleh BPR Lestari Jateng. Saya memberi kuasa kepada BPR Lestari Jateng untuk memeriksa informasi yang Saya berikan dan menghubungi sumber informasi yang layak seperti SLIK, biro kredit atau sejenisnya.</p>

                    <button class="btn tombolAjukan">Ajukan Sekarang</button>
                </form>
            </div>

            <div class="col-md-5 p-2">
                <p class="formbold">Butuh Bantuan?</p>
                <p>Kami akan sangat senang bila bisa membantu anda. Hubungi kami:</p>

                <table style="z-index: 12">
                    <tr>
                        <td valign="top">
                            <i class="fa fa-phone  mr-2 formpenting" aria-hidden="true"> </i></td>
                        <td valign="top">
                            <p class="formpenting">(0271) 710033</p>
                        </td>
                    </tr>

                    <tr>
                        <td valign="top">
                            <i class="fa fa-envelope mr-2 formpenting" aria-hidden="true"></i>
                        </td>
                        <td>
                            <p class="formpenting"> danalestari@gmail.com</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

    </div>
</section>
@endsection
