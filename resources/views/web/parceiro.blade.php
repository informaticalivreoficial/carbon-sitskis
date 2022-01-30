@extends('web.master.master')

@section('content')

<header id="header" class="site-header">

    @include('web.include.menu-topo')
	
	<section class="row page-cover" data-slide="{{$configuracoes->gettopodosite()}}">
	    <div class="container">
	        <h2 class="this-title">{{$parceiro->name}}</h2>
	        <ol class="breadcrumb">
	            <li><a href="{{route('web.home')}}">Home</a></li>
                <li><a href="{{route('web.parceiros')}}">Partners</a></li>
	            <li class="active">{{$parceiro->name}}</li>
	        </ol>
	    </div>
	</section>	
</header>


<section class="row blog-section">
    <div class="container">
        <div class="row">
            <div class="col-md-4 sidebar">
                <aside class="row widget widet_search" style="text-align: center;">
                    <img src="{{$parceiro->nocover()}}" alt="{{$parceiro->name}}" />
                </aside>
                <aside class="row widget widget_categories">
                    <h4 class="widget-title">Contact</h4>
                    <ul class="list-unstyled postlist">
                        @if ($parceiro->link)
                             <li>WebSite: <a target="_blank" href="{{$parceiro->link}}">{{$parceiro->link}}</a></li>
                        @endif
                        @if ($parceiro->email)
                             <li>Email: <a target="_blank" href="mailto:{{$parceiro->email}}">{{$parceiro->email}}</a></li>
                        @endif
                        @if ($parceiro->telefone)
                             <li>Phone: <a target="_blank" href="tel:{{$parceiro->telefone}}">{{$parceiro->telefone}}</a></li>
                        @endif
                        @if ($parceiro->celular)
                             <li>Celular: <a target="_blank" href="tel:{{$parceiro->celular}}">{{$parceiro->celular}}</a></li>
                        @endif
                        @if ($parceiro->whatsapp)
                             <li>WhatsApp: <a target="_blank" href="tel:{{$parceiro->whatsapp}}">{{$parceiro->whatsapp}}</a></li>
                        @endif
                    </ul>
                </aside>
                <aside class="row widget widet_search">
                    {!!$parceiro->mapa_google!!}
                </aside> 
            </div>
            <div class="col-md-8">
                <article class="row loop-post single-post">
                    <h2 class="ptitle" style="margin: 22px 0 12px;">{{$parceiro->name}}</h2>                    
                    <div class="entry-content row" style="margin: 20px 0 0;">
                        <ul style="margin-bottom:20px;padding-inline-start: 0px;">
                            <div style="top:5px;" class="fb-share-button" data-href="{{url()->current()}}" data-layout="button_count" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Compartilhar</a></div>
                            <a class="btn-front" target="_blank" href="https://web.whatsapp.com/send?text={{url()->current()}}" data-action="share/whatsapp/share"><i class="fa fa-whatsapp"></i> Compartilhar</a>
                        </ul>
                        {!!$parceiro->content!!}
                    </div>
                    <div style="justify-content:space-between;display: flex!important;margin-top:30px;">
                        <p class="like-info">
                            <span class="align-middle"><i class="fa fa-eye"></i></span> {{$parceiro->views}}
                        </p>                                    
                        <ul style="list-style: outside none none;">
                             @if (!empty($parceiro->facebook))
                                 <li style="float: right;" class="mr-2"><a target="_blank" href="{{$parceiro->facebook}}"><i class="fa fa-facebook"></i></a></li>
                             @endif                                
                             @if (!empty($parceiro->twitter))
                                 <li style="float: right;" class="mr-2"><a target="_blank" href="{{$parceiro->twitter}}"><i class="fa fa-twitter"></i></a></li>
                             @endif                                
                             @if (!empty($parceiro->instagram))
                                 <li style="float: right;" class="mr-2"><a target="_blank" href="{{$parceiro->instagram}}"><i class="fa fa-instagram"></i></a></li>
                             @endif                                
                             @if (!empty($parceiro->youtube))
                                 <li style="float: right;" class="mr-2"><a target="_blank" href="{{$parceiro->youtube}}"><i class="fa fa-youtube"></i></a></li>
                             @endif                                
                             @if (!empty($parceiro->linkedin))
                                 <li style="float: right;" class="mr-2"><a target="_blank" href="{{$parceiro->linkedin}}"><i class="fa fa-linkedin"></i></a></li>
                             @endif                                
                             @if (!empty($parceiro->vimeo))
                                 <li style="float: right;" class="mr-2"><a target="_blank" href="{{$parceiro->vimeo}}"><i class="fa fa-vimeo"></i></a></li>
                             @endif                                
                             @if (!empty($parceiro->fliccr))
                                 <li style="float: right;" class="mr-2"><a target="_blank" href="{{$parceiro->fliccr}}"><i class="fa fa-flickr"></i></a></li>
                             @endif                                
                             @if (!empty($parceiro->soundclound))
                                 <li style="float: right;" class="mr-2"><a target="_blank" href="{{$parceiro->soundclound}}"><i class="fa fa-soundcloud"></i></a></li>
                             @endif                                
                             @if (!empty($parceiro->snapchat))
                                 <li style="float: right;" class="mr-2"><a target="_blank" href="{{$parceiro->snapchat}}"><i class="fa fa-snapchat"></i></a></li>
                             @endif 
                        </ul>
                    </div>
                    <p class="my-3"><b>Address: </b>
                        @if ($parceiro->rua)
                            {{$parceiro->rua}}
                        @endif
                        @if ($parceiro->rua && $parceiro->num)
                            , {{$parceiro->num}}
                        @endif
                        @if ($parceiro->rua && $parceiro->bairro)
                            , {{$parceiro->bairro}}
                        @endif
                        @if (!$parceiro->rua && $parceiro->bairro)
                            {{$parceiro->bairro}}
                        @endif
                        @if ($parceiro->bairro && $parceiro->uf)
                            - {{getCidadeNome($parceiro->cidade, 'cidades')}}
                        @endif
                        @if(!$parceiro->bairro && $parceiro->uf)
                            {{getCidadeNome($parceiro->cidade, 'cidades')}}
                        @endif
                        @if ($parceiro->cep)
                            - {{$parceiro->cep}}
                        @endif
                    </p>
                </article>

                @if($parceiro->images()->get()->count())
                    <div class="row" style="margin-top: 30px;"> 
                        @foreach($parceiro->images()->get() as $image)
                            <div class="col-xs-6 col-sm-4 col-md-4 col-lg-3" style="padding-bottom: 10px;"> 
                                <a class="thumbnail-rayen" href="{{ $image->getUrlImageAttribute() }}" data-toggle="lightbox" data-gallery="property-gallery" data-type="image">                       
                                    <img class="img-responsive" src="{{ $image->url_cropped }}" alt="{{ $image->url_cropped }}" title="{{ $parceiro->name }}">
                                </a>                        
                            </div>                                                
                        @endforeach
                    </div>
                @endif
                
                
                
                @if (!empty($parceiro->email))
                    <form action="" method="post" autocomplete="off" class="row comment-form j_formsubmit">                    
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <div id="js-contact-result"></div>
                                <input type="hidden" class="noclear" name="parceiro_id" value="{{$parceiro->id}}" />
                                <!-- HONEYPOT -->
                                <input type="hidden" class="noclear" name="bairro" value="" />
                                <input type="text" class="noclear" style="display: none;" name="cidade" value="" />
                            </div>
                            <div class="col-sm-6 form-group form_hide">
                                <label for="cname">Your Name*</label>
                                <input type="text" name="nome" class="form-control" id="cname">
                            </div>
                            <div class="col-sm-6 form-group form_hide">
                                <label for="cemail">Your Email*</label>
                                <input type="email" name="email" class="form-control" id="cemail">
                            </div>
                            <div class="col-sm-12 form-group form_hide">
                                <label for="cmessage">Message</label>
                                <textarea id="cmessage" name="mensagem" rows="10" class="form-control"></textarea>
                            </div>
                            <div class="col-sm-12 form-group form_hide">
                                <input type="submit" class="btn btn-primary btn-sm" id="js-contact-btn" value="Submit">
                            </div>
                        </div>
                    </form>
                @endif
            </div>            
        </div>
    </div>
</section>

@endsection

@section('css')
<!-- Ekko Lightbox -->
<link rel="stylesheet" href="{{url(asset('backend/plugins/ekko-lightbox/ekko-lightbox.css'))}}"/>
<style>
    iframe{
      height: 300px;
      width: 100%;
      display: inline-block;
      overflow: hidden"
    }
    .like-info {
        font-size: 14px;
    }
    .mr-2{
        margin-right: 10px;
    }
    .btn-front{
        background-color: #6ebf58;
        color:#fff;
        border-radius: .25rem;
        padding: 6px 8px !important;
        border:none;
    }
    .btn-front:hover, mdi:hover{
        color:#fff;
    }
</style>
@endsection

@section('js')
<!-- Ekko Lightbox -->
<script src="{{url(asset('backend/plugins/ekko-lightbox/ekko-lightbox.min.js'))}}"></script>
<script>
    $(function () {  

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });     

        // Seletor, Evento/efeitos, CallBack, Ação
        $('.j_formsubmit').submit(function (){
            var form = $(this);
            var dataString = $(form).serialize();

            $.ajax({
                url: "{{ route('web.sendEmailParceiro') }}",
                data: dataString,
                type: 'GET',
                dataType: 'JSON',
                beforeSend: function(){
                    form.find("#js-contact-btn").attr("disabled", true);
                    form.find('#js-contact-btn').val("Loading...");                
                    form.find('.alert').fadeOut(500, function(){
                        $(this).remove();
                    });
                },
                success: function(resposta){
                    $('html, body').animate({scrollTop:$('#js-contact-result').offset().top-190}, 'slow');
                    if(resposta.error){
                        form.find('#js-contact-result').html('<div class="alert alert-warning alert-dismissible fade in">'+ resposta.error +'</div>');
                        form.find('.error-msg').fadeIn();                    
                    }else{
                        form.find('#js-contact-result').html('<div class="alert alert-success alert-dismissible fade in">'+ resposta.sucess +'</div>');
                        form.find('.error-msg').fadeIn();                    
                        form.find('input[class!="noclear"]').val('');
                        form.find('textarea[class!="noclear"]').val('');
                        form.find('.form_hide').fadeOut(500);
                    }
                },
                complete: function(resposta){
                    form.find("#js-contact-btn").attr("disabled", false);
                    form.find('#js-contact-btn').val("Submit");                                
                }

            });

            return false;
        });

        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
            alwaysShowClose: true
            });
        });

    });
</script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v11.0&appId=1787040554899561&autoLogAppEvents=1" nonce="1eBNUT9J"></script>
@endsection