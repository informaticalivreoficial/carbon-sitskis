<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="language" content="pt-br" />  
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="author" content="Informática Livre"/>
    <meta name="url" content="{{$configuracoes->dominio}}" />
    <meta name="keywords" content="{{$configuracoes->metatags}}">
    <meta name="description" content="{{$configuracoes->descricao}}"/>
    <meta name="rating" content="general">
    <meta name="distribution" content="local">
    <meta name="date" content="Dec 26">

    {!! $head ?? '' !!}

    <!-- FAVICON -->
    <link rel="shortcut icon" href="{{$configuracoes->getfaveicon()}}"/>
    <link rel="apple-touch-icon" href="{{$configuracoes->getfaveicon()}}"/>
    <link rel="apple-touch-icon" sizes="72x72" href="{{$configuracoes->getfaveicon()}}"/>
    <link rel="apple-touch-icon" sizes="114x114" href="{{$configuracoes->getfaveicon()}}"/>

    <meta name="csrf-token" content="{{ csrf_token() }}">    
        
    <!-- CSS -->
    <link rel="stylesheet" href="{{url(asset('frontend/assets/bootstrap/css/bootstrap.min.css'))}}">
	<link rel="stylesheet" href="{{url(asset('frontend/vendors/fontawesome/css/font-awesome.min.css'))}}">
	<link rel="stylesheet" href="{{url(asset('frontend/vendors/owl/owl.carousel.css'))}}">
    <link rel="stylesheet" href="{{url(asset('frontend/assets/css/styles.css'))}}">
    
    <!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

    @hasSection('css')
        @yield('css')
    @endif 
    
  </head>
  <body>    

    <div id="page" class="site row">
    
    <header id="header" class="site-header">	
        @include('web.include.menu-topo')	
    </header>

    <main id="contents" class="site-contnts">    
        @yield('content') 
    </main>

    <footer id="footer" class="site-footer">   
        <section class="row site-footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 widget-footer">
                        <h4 class="widget-title">Quick Links</h4>
                        <div class="row widget-content">
                            <ul class="menu">
                                <li><a href="{{route('web.home')}}">Home</a></li>
                                <li><a href="https://localhost/Carbon-Sit/public/pagina/about-us">About Us</a></li>
                                <li><a href="{{route('web.parceiros')}}">Partners</a></li>
                                <li><a href="{{route('web.produtos')}}">Products</a></li>
                                <li><a href="{{route('web.atendimento')}}">Contact</a></li>
                                <li><a href="{{route('web.politica')}}">Privacy Policy</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 widget-footer">
                        <h4 class="widget-title">{{$configuracoes->nomedosite}}</h4>
                        <div class="row widget-content">
                            <p>{{$configuracoes->descricao}}</p>
                            <ul class="list-unstyled fsocial">
                                @if ($configuracoes->facebook)
                                    <li><a target="_blank" href="{{$configuracoes->facebook}}"><i class="fa fa-facebook"></i></a></li>
                                @endif
                                @if ($configuracoes->twitter)
                                    <li><a target="_blank" href="{{$configuracoes->twitter}}"><i class="fa fa-twitter"></i></a></li>
                                @endif
                                @if ($configuracoes->instagram)
                                    <li><a target="_blank" href="{{$configuracoes->instagram}}"><i class="fa fa-instagram"></i></a></li>
                                @endif
                                @if ($configuracoes->linkedin)
                                    <li><a target="_blank" href="{{$configuracoes->linkedin}}"><i class="fa fa-linkedin"></i></a></li>
                                @endif
                                @if ($configuracoes->youtube)
                                    <li><a target="_blank" href="{{$configuracoes->youtube}}"><i class="fa fa-youtube"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-5 widget-footer">
                        <h4 class="widget-title">Sign Up for Our Newsletter</h4>
                        <div class="row widget-content">
                            <p>subscribe and follow our news and products</p>
                            <form method="post" action="" class="input-group footer-subscribe-form j_submitnewsletter">
                                @csrf
                                <div id="js-newsletter-result"></div>
                                <!-- HONEYPOT -->
                                <input type="hidden" class="noclear" name="bairro" value="" />
                                <input type="text" class="noclear" style="display: none;" name="cidade" value="" />
                                <input type="hidden" class="noclear" name="categoria" value="1" />
                                <input type="hidden" class="noclear" name="status" value="1" />
                                <input type="hidden" class="noclear" name="nome" value="Cadastrado pelo site" />
                                <input type="email" name="email" class="form-control form_hide">
                                <span class="input-group-addon form_hide">
                                    <button type="submit" class="btn btn-primary" id="js-subscribe-btn">subscribe</button>
                                </span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="row site-footer-top">
            <div class="container">
                <div class="row">
                    <div class="media">                    
                        <div class="col-12 media-body">
                            <p>&copy; Copyright {{$configuracoes->ano_de_inicio}} {{$configuracoes->nomedosite}} - all rights reserved. Done with <i style="color:red;" class="fa fa-heart"></i> by <a style="color:#fff;" target="_blank" href="{{env('DESENVOLVEDOR_URL')}}">{{env('DESENVOLVEDOR')}}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </footer>

    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{url(asset('frontend/vendors/jquery-2.2.0.min.js'))}}"></script>
    <script src="{{url(asset('frontend/assets/bootstrap/js/bootstrap.min.js'))}}"></script>
    <script src="{{url(asset('frontend/vendors/owl/owl.carousel.min.js'))}}"></script>
    <script src="{{url(asset('frontend/vendors/mcustomscrollbar/jquery.mCustomScrollbar.concat.min.js'))}}"></script>
    <script src="{{url(asset('frontend/vendors/isotope.pkgd.min.js'))}}"></script>
    <script src="{{url(asset('frontend/vendors/imagesloaded.pkgd.min.js'))}}"></script>
    <!--Theme JS-->
    <script src="{{url(asset('frontend/assets/js/hostpro.js'))}}"></script>

    @hasSection('js')
        @yield('js')
    @endif

    <script>
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Seletor, Evento/efeitos, CallBack, Ação
            $('.j_submitnewsletter').submit(function (){
                var form = $(this);
                var dataString = $(form).serialize();

                $.ajax({
                    url: "{{ route('web.sendNewsletter') }}",
                    data: dataString,
                    type: 'GET',
                    dataType: 'JSON',
                    beforeSend: function(){
                        form.find("#js-subscribe-btn").attr("disabled", true);
                        form.find('#js-subscribe-btn').html("Loading...");                
                        form.find('.alert').fadeOut(500, function(){
                            $(this).remove();
                        });
                    },
                    success: function(response){
                        $('html, body').animate({scrollTop:$('#js-newsletter-result').offset().top-40}, 'slow');
                        if(response.error){
                            form.find('#js-newsletter-result').html('<div class="alert alert-warning alert-dismissible fade in">'+ response.error +'</div>');
                            form.find('.error-msg').fadeIn();                    
                        }else{
                            form.find('#js-newsletter-result').html('<div class="alert alert-success alert-dismissible fade in">'+ response.sucess +'</div>');
                            form.find('.error-msg').fadeIn();                    
                            form.find('input[class!="noclear"]').val('');
                            form.find('.form_hide').fadeOut(500);
                        }
                    },
                    complete: function(response){
                        form.find("#js-subscribe-btn").attr("disabled", false);
                        form.find('#js-subscribe-btn').html("subscribe");                                
                    }

                });

                return false;
            });

        });
    </script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-J9WERQ5F68"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-J9WERQ5F68');
    </script>
    
</body>
</html>