@extends('web.master.master')


@section('content')
<div class="pagehding-sec" style="background-image: url({{$configuracoes->gettopodosite()}});">
    <div class="pagehding-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-heading">
                    <h1>Parceiros e Fornecedores</h1>
                    <ul>
                        <li><a href="{{route('web.home')}}">Início</a></li>
                        <li><a href="{{route('web.fornecedores')}}">Parceiros e Fornecedores</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="contact-page-sec pt-100 pb-100">
  <div class="container">
      <div class="row">
          <div class="col-md-8">
            <div class="row">
                <div class="col-12">
                    @if($errors->all())
                        @foreach($errors->all() as $error)
                            @message(['color' => 'danger'])
                            {!! $error !!}
                            @endmessage
                        @endforeach
                    @endif    
                    
                    @if(session()->exists('message'))
                        @message(['color' => session()->get('color')])
                        {!! session()->get('message') !!}
                        @endmessage
                    @endif
                </div>            
            </div>
              <form method="post" action="" class="j_formsubmit" autocomplete="off">
                @csrf
                <div id="js-contact-result"></div>              
                <!-- HONEYPOT -->
                <input type="hidden" class="noclear" name="bairro" value="" />
                <input type="text" class="noclear" style="display: none;" name="cidade1" value="" />
                <div class="contact-field form_hide">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="single-input-field">
                            <input placeholder="Nome do Representante" name="nome" type="text" value="{{old('nome')}}">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="single-input-field">
                            <input inputmode="email" placeholder="Seu Email" name="email" type="text" value="{{old('email')}}">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="single-input-field">
                            <input inputmode="tel" placeholder="Seu Telefone" name="telefone" type="text" value="{{old('telefone')}}">
                        </div>
                    </div> 
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="single-input-field">
                            <input placeholder="Empresa" name="empresa" type="text" value="{{old('empresa')}}">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="single-input-field">
                            <input placeholder="Cidade" name="cidade" type="text" value="{{old('cidade')}}">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="single-input-field">
                            <input placeholder="Ramo de atividade" name="atividade" type="text" value="{{old('atividade')}}">
                        </div>
                    </div>                                     
                    <div class="col-md-12" style="margin-top: 20px;">
                        <div class="single-input-field">
                            <textarea placeholder="Descreva seus serviços ou produtos" name="mensagem"></textarea>
                        </div>
                        <div class="single-input-fieldsbtn">
                            <input value="Cadastrar" id="js-contact-btn" type="submit">
                        </div>
                    </div>
                    
                </div>
              </form>
          </div>
          <div class="col-md-4">
              <div class="contact-info form_hide" style="margin-top: 30px;">
                  <div class="contact-info-item">
                      <div class="contact-info-text">
                          <h2>Atendimento</h2>
                          <p>
                            Preencha o formulário para que possamos avaliar a viabilidade de uma parceria empresarial
                          </p>
                      </div>
                  </div> 
              </div>  
          </div>
      </div>
  </div>
</div>
@endsection

@section('css')
    
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
                url: "{{ route('web.sendEmailFornecedor') }}",
                data: dataString,
                type: 'GET',
                dataType: 'JSON',
                beforeSend: function(){
                    form.find("#js-contact-btn").attr("disabled", true);
                    form.find('#js-contact-btn').val("Carregando...");                
                    form.find('.alert').fadeOut(500, function(){
                        $(this).remove();
                    });
                },
                success: function(resposta){
                    $('html, body').animate({scrollTop:$('#js-contact-result').offset().top-290}, 'slow');
                    if(resposta.error){
                        form.find('#js-contact-result').html('<div class="alert alert-danger error-msg">'+ resposta.error +'</div>');
                        form.find('.error-msg').fadeIn();                    
                    }else{
                        form.find('#js-contact-result').html('<div class="alert alert-success error-msg">'+ resposta.sucess +'</div>');
                        form.find('.error-msg').fadeIn();                    
                        form.find('input[class!="noclear"]').val('');
                        form.find('textarea[class!="noclear"]').val('');
                        form.find('.form_hide').fadeOut(500);
                    }
                },
                complete: function(resposta){
                    form.find("#js-contact-btn").attr("disabled", false);
                    form.find('#js-contact-btn').val("Cadastrar");                                
                }

            });

            return false;
        });

    });
</script>
@endsection
  
  