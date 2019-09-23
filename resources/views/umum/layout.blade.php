<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BPR Lestari Jateng</title>

    <!-- LOGO -->
    <link rel="icon" type="image/x-icon" href="{{asset('images/bprTitleLogo.ico')}}" />
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700,900&display=swap" rel="stylesheet">

    <!-- Style -->

    <!-- Font Awesome -->

    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}"  />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/genosstyle.css') }}"  />
    <link rel="stylesheet" href="{{ asset('/adminlte/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/sweetalert/sweetalert2.min.css')}}">


    @yield('css')
</head>

<body>
    <!-- navbar -->
    <div class="container-fluid">


        <nav class="navbar navbar-expand-md navbar-dark fixed-top" style="background-color: #09839B;">
            <a class="navbar-brand" href="/">
                <img src="/images/logoputih.png" height="30px" class="d-inline-block align-top" alt="/images/logoputih.png">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav ml-auto " style="margin-right: 20px">
                    <li class="nav-item ">
                        <a class="nav-link mr-3 text-light" href="/">Beranda <span class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link mr-3 text-light" href="/formKredit">Kredit <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link text-light" href="/formDeposito">Deposito</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    @yield('content')

    <!-- chat wa -->
    <a href="https://wa.me/6281226841406" target='_blank'><img class="mb-3 mr-3 floatButton" src="{{asset('images/logowa.png')}}" alt="{{asset('images/logowa.png')}}"></a>
    <div style="clear: both;"></div>
    <!-- produk -->
    <div class="footerLestari">
        <div class="container pt-3 pb-5">
            <div class="row">
                <div class="col-sm-4">
                    <p class="text-font-weight-bold pt-5 text-light" style="font-weight: 700">Kontak Kami</p>
                    <table>
                        <tr>
                            <td valign="top">
                                <i class="fa fa-location-arrow text-light mr-2 " aria-hidden="true"></i></td>
                            <td valign="top">
                                <p class="text-light">Center Point Solo, Jl. Slamet Riyadi No.371, Sondakan, Kec. Laweyan, Kota Surakarta, Jawa Tengah 57147</p>
                            </td>
                        </tr>

                        <tr>
                            <td valign="top">
                                <i class="fa fa-phone text-light mr-2" aria-hidden="true"> </i>
                            </td>
                            <td>
                                <p class="text-light"> (0271) 710033</p>
                            </td>
                        </tr>

                        <tr>
                            <td valign="top">
                                <i class="fa fa-envelope text-light mr-2" aria-hidden="true"></i>
                            </td>
                            <td>
                                <p class="text-light"> lestarijtg@gmail.com</p>
                            </td>
                        </tr>



                    </table>
                </div>

                <div class="col-sm-4 text-center">
                    <p class="text-font-weight-bold pt-5 text-light" style="font-weight: 700">Follow Us</p>
                    <a href="https://www.facebook.com/BankBPRLestariJateng/" class="text-light mr-2" style="font-size: 30px"> <i class="fab fa-facebook-square" aria-hidden="true"></i></a>
                    <a href="#" class="text-light mr-2" style="font-size: 30px"> <i class="fab fa-twitter-square" aria-hidden="true"></i></a>
                    <a href="http://instagram.com/bpr_lestarijateng/" class="text-light mr-2" style="font-size: 30px"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                </div>

                <div class="col-sm-4 pt-2">
                    <img class="pt-5" src="{{asset('images/diawasiOjk.png')}}" alt="{{asset('images/ojk.png')}}">
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <script type="text/javascript" src="{{asset ('fontawesome/js/all.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="{{asset ('/adminlte/js/adminlte.js')}}"></script>

    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
<script src="{{ asset('js/sweetalert/sweetalert.min.js') }}"></script>
    @include('sweet::alert')
    @yield('script')
</body>

</html>
