@extends('web.master.master')

@section('content')

<header id="header" class="site-header">

    @include('web.include.menu-topo')
	
	<section class="row page-cover" data-slide="{{$configuracoes->gettopodosite()}}">
	    <div class="container">
	        <h2 class="this-title">{{$post->titulo}}</h2>
	        <ol class="breadcrumb">
	            <li><a href="{{route('web.home')}}">Home</a></li>
	            <li class="active">{{$post->titulo}}</li>
	        </ol>
	    </div>
	</section>	
</header>

<section class="row about-us1">
    <div class="container">
        <div class="row">
            <div class="col-12" style="padding: 10px;">
                <h3 class="au-title">{{$post->titulo}}</h3>
                {!!$post->content!!}
            </div>                
        </div>
        @if($post->images()->get()->count())
            <div class="row" style="margin-top: 30px;"> 
                @foreach($post->images()->get() as $image)
                    <div class="col-xs-6 col-sm-4 col-md-4 col-lg-3" style="padding-bottom: 10px;"> 
                        <a class="thumbnail-rayen" href="{{ $image->getUrlImageAttribute() }}" data-toggle="lightbox" data-gallery="property-gallery" data-type="image">                       
                            <img class="img-responsive" src="{{ $image->url_cropped }}" alt="{{ $image->url_cropped }}" title="{{ $post->titulo }}">
                        </a>                        
                    </div>                                                
                @endforeach
            </div>
        @endif
    </div>
</section>


@if (!empty($parceiros) && $parceiros->count() > 0)
    <section class="row client-logos" style="margin-top: 30px;">
        <div class="container">            
            <div class="row section-title text-center">
                <h2>Partners</h2>
            </div>
            <div class="row">
                @foreach ($parceiros as $parceiro)
                    <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2 client-logo"><a href="{{route('web.parceiro',$parceiro->slug)}}" data-toggle="tooltip" data-placement="top" title="{{$parceiro->name}}"><img src="{{$parceiro->nocover()}}" alt="{{$parceiro->name}}"></a></div>                            
                @endforeach
            </div>            
        </div>
    </section>       
@endif

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

        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
            alwaysShowClose: true
            });
        });

    });
</script>
@endsection