@extends('web.master.master')

@section('content')

<h1 class="sr-only">Product</h1>

<header id="header" class="site-header">

    @include('web.include.menu-topo')	
	
	<section class="row page-cover" data-slide="{{$configuracoes->gettopodosite()}}">
	    <div class="container">
	        <h2 class="this-title">{{$produto->name}}</h2>
	        <ol class="breadcrumb">
	            <li><a href="{{route('web.home')}}">Home</a></li>
	            <li><a href="{{route('web.produtos')}}">Products</a></li>
                <li class="active">{{$produto->name}}</li>
	        </ol>
	    </div>
	</section>	
</header>

<section class="row products-row">
    <div class="container">
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-12 col-lg-8">
                <div class="media product-details" style="margin-bottom: 10px;">
                    <div class="product-image media-left">
                        <a href="#" class="media-object">
                            <img src="{{$produto->cover()}}" alt="{{$produto->name}}" class="img-responsive">  
                            <span class="prod-badge">{{$produto->thumb_legenda}}</span>                          
                        </a>
                    </div>
                    <div class="product-info media-body">
                        <h2 class="prod-title">{{$produto->name}}</h2>
                        @if (!empty($produto->valor) && $produto->exibivalores == 1)
                            <h3 class="prod-price" style="margin-bottom: 5px;">
                            @if (!empty($produto->valor_vista))                                    
                                <del><sup>R$</sup>{{$produto->valor}}</del>  
                            @else                            
                                @if (!empty($produto->valor_promocional))
                                    <del><sup>R$</sup>{{$produto->valor}}</del> - <sup>R$</sup>{{$produto->valor_promocional}}
                                @else
                                    <sup>R$</sup>{{$produto->valor}}
                                @endif                                        
                            @endif
                            </h3>
                            @if (!empty($produto->valor_vista))
                                <p style="font-size: 16px;margin: 0px;margin-bottom:5px;height: auto;"><sup>R$</sup>{{$produto->valor_vista}} cash price</p>
                            @endif                                    
                        @endif
                        {!!$produto->content!!}
                    </div>
                </div>
                @if($produto->images()->get()->count())
                    <div class="row" style="margin-bottom: 20px;"> 
                        @foreach($produto->images()->get() as $image)
                            <div class="col-xs-6 col-sm-4 col-md-4 col-lg-3" style="padding-bottom: 10px;"> 
                                <a class="thumbnail-rayen" href="{{ $image->getUrlImageAttribute() }}" data-toggle="lightbox" data-gallery="property-gallery" data-type="image">                       
                                    <img class="img-responsive" src="{{ $image->url_cropped }}" alt="{{ $image->url_cropped }}" title="{{ $produto->name }}">
                                </a>                        
                            </div>                                                
                        @endforeach
                    </div>
                @endif
                <div id="exampleTab" class="row m0 product-tab">
                    <ul class="nav nav-tabs exampleTabNav" role="tablist">
                        <li role="presentation" class="active"><a href="#exTab1" aria-controls="exTab1" role="tab" data-toggle="tab">Description</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content exampleTab_content">
                        <div role="tabpanel" class="tab-pane active" id="exTab1">
                            <h2 class="hp-h4 tab-title">Product Description</h2>
                            {!!$produto->content!!}
                            <div style="margin-top: 20px;">
                                {!!$produto->notas!!}
                            </div>                            
                        </div> 
                    </div>
                </div>                
            </div> 
            <div class="col-12 col-lg-4">
                <h2 class="hp-h4 tab-title">Quick Contact</h2>
                <form role="form" method="post" id="register-form" name="register-form" class="j_formsubmit" >
                    @csrf
                    <div id="js-contact-result" style="margin-bottom: 10px;"></div>
                    <input type="hidden" class="noclear" name="produto_id" value="{{$produto->id}}" />
                    <!-- HONEYPOT -->
                    <input type="hidden" class="noclear" name="bairro" value="" />
                    <input type="text" class="noclear" style="display: none;" name="cidade" value="" />
                    <div class="form-group form_hide">
                        <label for="name">Name</label>
                        <input name="produto_id" value="{{$produto->id}}" type="hidden"/>
                        <input type="text"id="usr" name="nome" placeholder="Full Name" class="form-control">
                    </div>
                    <div class="form-group form_hide">
                        <label for="email">Email</label>
                        <input type="text" name="email" placeholder="Email address" class="form-control">
                    </div>
                    <div class="form-group form_hide">
                        <label for="email">Phone Number</label>
                        <input type="text" name="telefone" placeholder="Phone Number" class="form-control">
                    </div>
                    <div class="form-group form_hide">
                        <label for="message">Message</label>
                        <textarea id="comment" name="mensagem" rows="8" class="form-control" placeholder="Enter text here">I would like more information about this product: {{$produto->name}}</textarea>
                    </div>
                    <input type="submit" id="js-contact-btn" name="submit" value="Submit" class="btn btn-primary form_hide">
                </form>
            </div>           
        </div>
        
        @if (!empty($produtos) && $produtos->count() > 0)
            <h3 class="rsp-title">Related Products</h3>
            <div class="row related-products">
                @foreach ($produtos as $produto)
                    <div class="col-sm-4 product">
                        <div class="product-image row">
                            <img src="{{$produto->cover()}}" alt="{{$produto->name}}">                        
                        </div>
                        <div class="row product-info">
                            <h2 class="prod-title">{{$produto->name}}</h2>
                            @if (!empty($produto->valor) && $produto->exibivalores == 1)
                                <h3 class="prod-price" style="margin-bottom: 5px;">
                                @if (!empty($produto->valor_vista))                                    
                                    <del><sup>R$</sup>{{$produto->valor}}</del>  
                                @else
                                    @if (!empty($produto->valor_promocional))
                                        <del><sup>R$</sup>{{$produto->valor}}</del> - <sup>R$</sup>{{$produto->valor_promocional}}
                                    @else
                                        <sup>R$</sup>{{$produto->valor}}
                                    @endif                                        
                                @endif
                                </h3>
                                @if (!empty($produto->valor_vista))
                                    <p style="font-size: 16px;margin: 0px;margin-bottom:5px;height: auto;"><sup>R$</sup>{{$produto->valor_vista}} cash price</p>
                                @endif                                    
                            @endif
                            <div class="row btns">
                                <a href="{{route('web.produto',['slug' => $produto->slug])}}" class="btn btn-primary">View Details</a>                             
                            </div>
                        </div>
                    </div>
                @endforeach                
            </div>
        @endif        
    </div>
</section>

@endsection

@section('css')
<!-- Ekko Lightbox -->
<link rel="stylesheet" href="{{url(asset('backend/plugins/ekko-lightbox/ekko-lightbox.css'))}}"/>
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
                url: "{{ route('web.sendEmailProduto') }}",
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
@endsection