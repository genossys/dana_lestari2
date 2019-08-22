<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dana Lestari</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,900&display=swap" rel="stylesheet">

    <!-- Style -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="{{ asset('/css/genosstyle.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="{{asset ('adminlte/plugins/font-awesome/css/font-awesome.min.css')}}">


    @yield('css')
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top" style="background-color: #09839B;">
        <a class="navbar-brand" href="/">
            <img src="/images/logoputih.png" height="30px" class="d-inline-block align-top" alt="/images/logoputih.png" style="margin-left: 20px">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse " id="navbarNav" style="100%">
            <ul class="navbar-nav ml-auto " style="margin-right: 20px">
                <li class="nav-item ">
                    <a class="nav-link mr-3" href="/formKredit">Kredit <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="/formDeposito">Deposito</a>
                </li>
            </ul>
        </div>
    </nav>

    @yield('content')

    <!-- produk -->
    <div class="footerLestari">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <p class="text-font-weight-bold pt-4 text-light">Kontak Kami</p>
                    <p class="text-light m-0"><i class="fa fa-location-arrow" aria-hidden="true">&nbsp; Jl. Slamet Riyadi,....</i></p>
                    <p class="text-light m-0"> <i class="fa fa-phone" aria-hidden="true">&nbsp; 081 321 319 321</i></p>
                    <p class="text-light m-0"> <i class="fa fa-envelope" aria-hidden="true">&nbsp; danalestari@gmail.com</i></p>
                </div>

                <div class="col-sm-4" >
                    <p class="text-font-weight-bold pt-4 text-light">Sosial Media</p>
                    <a href="#" class="text-light mr-2" style="font-size: 30px"> <i class="fa fa-facebook" aria-hidden="true"></i></a>
                    <a href="#" class="text-light mr-2" style="font-size: 30px"> <i class="fa fa-twitter" aria-hidden="true"></i></a>
                    <a href="#" class="text-light mr-2" style="font-size: 30px"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </div>

                <div class="col-sm-4">

                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
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

            });
        });
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    @yield('script')
</body>

</html>
