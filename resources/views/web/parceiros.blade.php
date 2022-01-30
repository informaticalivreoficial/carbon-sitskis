@extends('web.master.master')


@section('content')

<h1 class="sr-only">Partners</h1>

<header id="header" class="site-header">

    @include('web.include.menu-topo')	

    <section class="row page-cover" data-slide="{{$configuracoes->gettopodosite()}}">
	    <div class="container">
	        <h2 class="this-title">Partners</h2>
	        <ol class="breadcrumb">
	            <li><a href="{{route('web.home')}}">Home</a></li>
                <li class="active">Partners</li>
	        </ol>
	    </div>
	</section>
		
</header>

@if (!empty($parceiros && $parceiros->count() > 0))
<section class="row client-logos" style="margin-top: 30px;">
    <div class="container">            
        <div class="row section-title text-center">
            <h2>Partners</h2>
        </div>
        <div class="row">
            @foreach ($parceiros as $parceiro)
                <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3 client-logo"><a href="{{route('web.parceiro',$parceiro->slug)}}" data-toggle="tooltip" data-placement="top" title="{{$parceiro->name}}"><img src="{{$parceiro->nocover()}}" alt="{{$parceiro->name}}"></a></div>                            
            @endforeach
        </div>            
    </div>
</section> 

 @endif

@endsection