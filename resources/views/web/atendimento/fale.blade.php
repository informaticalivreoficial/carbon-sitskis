@extends('web.master.master')

@section('content')

<h1 class="sr-only">Contact</h1>

<header id="header" class="site-header">
	
    @include('web.include.menu-topo')
	
	<!--Page Cover-->
	<section class="row page-cover" data-slide="{{$configuracoes->gettopodosite()}}">
	    <div class="container">
	        <h2 class="this-title">Contact</h2>
	        <ol class="breadcrumb">
	            <li><a href="{{route('web.home')}}">Home</a></li>
                <li class="active">Contact</li>
	        </ol>
	    </div>
	</section>
	
</header>

<section class="row contact-form-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 contact-form-box contact-box">
            <form method="post" id="register-form" name="register-form" class="j_formsubmit" autocomplete="off" >
                    @csrf
                    <div id="js-contact-result" style="margin-bottom: 10px;"></div>
                    <!-- HONEYPOT -->
                    <input type="hidden" class="noclear" name="bairro" value="" />
                    <input type="text" class="noclear" style="display: none;" name="cidade" value="" />    
                    <div class="form-group form_hide">
                        <label for="name">Name</label>
                        <input type="text"id="usr" name="nome" placeholder="Full Name" class="form-control">
                    </div>
                    <div class="form-group form_hide">
                        <label for="email">Email</label>
                        <input type="text" name="email" placeholder="Email address" class="form-control">
                    </div>
                    <div class="form-group form_hide">
                        <label for="message">Message</label>
                        <textarea id="comment" name="mensagem" rows="8" class="form-control" placeholder="Enter text here"></textarea>
                    </div>
                    <input type="submit" name="submit" id="js-contact-btn" value="Submit" class="btn btn-primary form_hide">
                </form>
            </div>
            <div class="col-sm-6 contact-info-box contact-box">
                <div class="row contact-ibox">
                    <h2 class="cb-title">Contact</h2>
                    <ul class="media-list contact-infolist">
                        <li class="media">
                            <div class="media-left" style="padding-right: 5px;"><i class="fa fa-map"></i></div>
                            <div class="media-body">
                                @if($configuracoes->rua)	
                                    {{$configuracoes->rua}}
                                    @if($configuracoes->num)
                                    , {{$configuracoes->num}}
                                    @endif
                                    @if($configuracoes->bairro)
                                    , {{$configuracoes->bairro}}
                                    @endif
                                    @if($configuracoes->cidade)  
                                    {{getCidadeNome($configuracoes->cidade, 'cidades')}}
                                    @endif
                                @endif
                            </div>
                        </li>                        
                        @if($configuracoes->telefone1)
                            <li class="media">
                                <div class="media-left" style="padding-right: 5px;"><i class="fa fa-phone"></i></div>
                                <div class="media-body"><a href="callto:{{$configuracoes->telefone1}}"> {{$configuracoes->telefone1}}</a></div>
                            </li>
                        @endif
                        @if($configuracoes->telefone2)
                            <li class="media">
                                <div class="media-left" style="padding-right: 5px;"><i class="fa fa-phone"></i></div>
                                <div class="media-body"><a href="callto:{{$configuracoes->telefone2}}"> {{$configuracoes->telefone2}}</a></div>
                            </li>
                        @endif
                        @if($configuracoes->telefone3)
                            <li class="media">
                                <div class="media-left" style="padding-right: 5px;"><i class="fa fa-phone"></i></div>
                                <div class="media-bodyform_hide"><a href="callto:{{$configuracoes->telefone3}}"> {{$configuracoes->telefone3}}</a></div>
                            </li>
                        @endif
                        @if($configuracoes->whatsapp)
                            <li class="media">
                                <div class="media-left" style="padding-right: 5px;"><i class="fa fa-whatsapp"></i></div>
                                <div class="media-body"><a href="{{getNumZap($configuracoes->whatsapp ,'Atendimento '.$configuracoes->nomedosite)}}"> {{$configuracoes->whatsapp}}</a></div>
                            </li>
                        @endif
                        @if($configuracoes->email)
                            <li class="media">
                                <div class="media-left" style="padding-right: 5px;"><i class="fa fa-envelope"></i></div>
                                <div class="media-body"><a href="mailto:{{$configuracoes->email}}"> {{$configuracoes->email}}</a></div>
                            </li>
                        @endif
                        @if($configuracoes->email1)
                            <li class="media">
                                <div class="media-left" style="padding-right: 5px;"><i class="fa fa-envelope"></i></div>
                                <div class="media-body"><a href="mailto:{{$configuracoes->email1}}"> {{$configuracoes->email1}}</a></div>
                            </li>
                        @endif
                    </ul>
                </div>                
            </div>
        </div>
    </div>
</section>

@endsection

@section('js')
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
                url: "{{ route('web.sendEmail') }}",
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

    });
</script>   
  @endsection
  
  