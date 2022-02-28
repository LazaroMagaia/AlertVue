<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <!--<link rel="stylesheet" href="{{asset('/css/admin.css')}}">-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
         crossorigin="anonymous">
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
        <title>llmagaia</title>
    </head>
    <body class="antialiased">
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <meta name="csrf-token" content="{{csrf_token()}}">
            <link href="{{ asset('css/app.css') }}" rel="stylesheet">
            <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
            <script src="{{ asset('js/app.js') }}" defer></script>
            <link rel="stylesheet" href="{{asset('/Mazer/vendors/iconly/bold.css')}}">
            <link rel="stylesheet" href="{{asset('/Mazer/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
            <link rel="stylesheet" href="{{asset('/Mazer/vendors/bootstrap-icons/bootstrap-icons.css')}}">
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300&display=swap" rel="stylesheet">
            <title>llmagaia</title>
        </head>
        <body>
                <div id="app">
                    <home-component></home-component>
                </div>

        <div class="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="contact-first">
                                <h2>Contacto</h2>
                                <a href="">contacto@llmagaia.site</a>
                                <p>Moçambique,maputo, coop, casa nº488</p>
                                <a href="">politica de privacidade</a>
                            </div>
                        </div><!--col-md-4-->
                        <div class="col-md-4">
                            <h2>Social</h2>
                            <div class="contact-social">
                                <a href="">Facebook</a>
                                <a href="">Instagram</a>
                                <a href="">whatsapp</a>
                                <a href="">Youtube</a>
                            </div>
                        </div><!--col-md-4-->
                        <div class="col-md-4">
                            <div class="login">
                                <a href="/login"><i class="bi bi-box-arrow-in-right"></i></a>
                            </div>
                        </div><!--col-md-4-->
                    </div><!--row-->
                </div><!--container--->
        </div><!---->


        <script src="{{asset("js/app.js")}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    </body>
</html>
