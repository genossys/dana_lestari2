@extends('umum.layout')

@section('content')
<!-- form kredit -->
<section style="padding-top: 100px" class="pb-4 deposito">
    <div class="container card pt-4 pb-4 cardBerhasilDeposito">

        <div class="row suksesKredit">
            <div class="div-md-6 offset-md-6 mt-3">
                <p style="--times: 1s;font-size: 25px;color: #ed6e53" class="formpenting animIn">Terima Kasih</p>
                <p style="--times:1.5s" class="animIn">permintaan deposito anda sudah kami terima</p>
                <p style="--times:2s" class="animIn">untuk info lebih lanjut silahkan hubungi:</p>
                <table style="z-index: 12">
                    <tr style="--times:2.5s" class="animIn">
                        <td valign="top">
                            <i class="fa fa-phone  mr-2 formpenting" aria-hidden="true"> </i></td>
                        <td valign="top">
                            <a href="tel:+62271710033">
                                <p class="formpenting">(0271) 710033</p>
                            </a>
                        </td>
                    </tr>

                    <tr style="--times:3s" class="animIn">
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

@section('script')
<script src="{{ asset('/js/genosstyle.js') }}"></script>
@endsection
