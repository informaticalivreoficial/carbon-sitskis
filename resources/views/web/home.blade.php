@extends('web.master.master')

@section('content')

@if (!empty($slides) && $slides->count() > 0)
    <div class="home-slider">
        @foreach ($slides as $slide)
            <div class="item" data-slide="{{$slide->getUrlImagemAttribute()}}">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-11 col-md-8 col-lg-7">
                            <h2 class="slide-title">customized carbon fiber sitskis built and tailored for maximal lightness, confort and safety</h2>
                            <a href="index.php?v=produtos" class="btn btn-primary">view products</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach            
    </div>
@endif

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
            </div>            
        </div>
    </div>
</section>
@endif

@endsection