@extends('web.master.master')

@section('content')

<h1 class="sr-only">Product</h1>

<header id="header" class="site-header">

    @include('web.include.menu-topo')	

    <section class="row page-cover" data-slide="{{$configuracoes->gettopodosite()}}">
	    <div class="container">
	        <h2 class="this-title">Product Listing</h2>
	        <ol class="breadcrumb">
	            <li><a href="{{route('web.home')}}">Home</a></li>
                <li class="active">Product Listing</li>
	        </ol>
	    </div>
	</section>
		
</header>

@if (!empty($produtos) && $produtos->count() > 0)
<section class="row products-row">
    <div class="container">
        <div class="row">
            <div class="col-12"> 
                <div class="row product-loop">
                    @foreach ($produtos as $produto)
                        <div class="col-12 col-xs-12 col-sm-6 col-md-4 col-lg-3 product">
                            <div class="product-image row">
                                <img src="{{$produto->nocover()}}" alt="{{$produto->name}}">                           
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
                
                <nav class="pagination blog-pagination product-pagination">
                    {{ $produtos->links() }}
                </nav>
            </div>                
        </div>
    </div>
</section>    
@endif

@endsection