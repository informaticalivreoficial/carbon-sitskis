@extends('web.master.master')

@section('content')

<header id="header" class="site-header">

    @include('web.include.menu-topo')
	
	<section class="row page-cover" data-slide="{{$configuracoes->gettopodosite()}}">
	    <div class="container">
	        <h2 class="this-title">Privacy Policy</h2>
	        <ol class="breadcrumb">
	            <li><a href="{{route('web.home')}}">Home</a></li>
	            <li class="active">Privacy Policy</li>
	        </ol>
	    </div>
	</section>	
</header>

<section class="row about-us1">
    <div class="container">
        <div class="row">
            <div class="col-12" style="padding: 10px;">
                {!! $configuracoes->politicas_de_privacidade !!}
            </div>                
        </div>        
    </div>
</section>

@endsection