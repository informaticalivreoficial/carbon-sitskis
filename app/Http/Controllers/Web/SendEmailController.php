<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Web\ParceiroSend;
use App\Mail\Web\Atendimento;
use App\Mail\Web\AtendimentoRetorno;
use App\Mail\Web\Cotacao;
use App\Mail\Web\CotacaoRetorno;
use App\Mail\Web\ProdutoSend;
use App\Mail\Web\Trabalhe;
use App\Mail\Web\TrabalheRetorno;
use App\Models\Configuracoes;
use App\Models\Newsletter;
use App\Models\Parceiro;
use App\Models\Produto;
use Error;
use Illuminate\Support\Facades\Validator;

class SendEmailController extends Controller
{
    public function sendEmailParceiro(Request $request)
    {
        $Configuracoes = Configuracoes::where('id', '1')->first();
        $parceiro = Parceiro::where('id', $request->parceiro_id)->first();
        if($request->nome == ''){
            $json = "Please fill in the <strong>Name</strong> field";
            return response()->json(['error' => $json]);
        }
        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            $json = "The <strong>Email</strong> field is empty or does not have a valid format!";
            return response()->json(['error' => $json]);
        }
        if($request->mensagem == ''){
            $json = "Please fill in your <strong>Message</strong>";
            return response()->json(['error' => $json]);
        }
        if(!empty($request->bairro) || !empty($request->cidade)){
            $json = "<strong>ERROR</strong> you are practicing SPAM!"; 
            return response()->json(['error' => $json]);
        }else{

            $data = [
                'sitename' => $parceiro->name,
                'siteemail' => $parceiro->email,
                'reply_name' => $request->nome,
                'reply_email' => $request->email,
                'mensagem' => $request->mensagem,
                'config_site_name' => $Configuracoes->nomedosite
            ];

            $parceiro->email_send_count = $parceiro->email_send_count + 1;
            $parceiro->save();
            
            Mail::send(new ParceiroSend($data));
            
            $json = 'Thank you '.getPrimeiroNome($request->nome).', your message has been sent to our <b>'.$parceiro->name.'</b> partner successfully!'; 
            return response()->json(['sucess' => $json]);
        }
    }

    public function sendEmailProduto(Request $request)
    {
        $Configuracoes = Configuracoes::where('id', '1')->first();
        $produto = Produto::where('id', $request->produto_id)->first();
        if($request->nome == ''){
            $json = "Please fill in the <strong>Name</strong> field";
            return response()->json(['error' => $json]);
        }
        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            $json = "The <strong>Email</strong> field is empty or does not have a valid format!";
            return response()->json(['error' => $json]);
        }
        if($request->mensagem == ''){
            $json = "Please fill in your <strong>Message</strong>";
            return response()->json(['error' => $json]);
        }
        if(!empty($request->bairro) || !empty($request->cidade)){
            $json = "<strong>ERROR</strong> you are practicing SPAM!"; 
            return response()->json(['error' => $json]);
        }else{
            $data = [
                'sitename' => $Configuracoes->nomedosite,
                'siteemail' => $Configuracoes->email,
                'reply_name' => $request->nome,
                'reply_email' => $request->email,
                'telefone' => $request->telefone,
                'produto_link' => $produto->slug,
                'produto_nome' => $produto->name,
                'mensagem' => $request->mensagem
            ];
            
            Mail::send(new ProdutoSend($data));
            
            $json = "Thank you {$request->nome}, your message was sent successfully!"; 
            return response()->json(['sucess' => $json]);
        }
    }

    public function sendEmail(Request $request)
    {
        $Configuracoes = Configuracoes::where('id', '1')->first();
        if($request->nome == ''){
            $json = "Please fill in the <strong>Name</strong> field";
            return response()->json(['error' => $json]);
        }
        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            $json = "The <strong>Email</strong> field is empty or does not have a valid format!";
            return response()->json(['error' => $json]);
        }
        if($request->mensagem == ''){
            $json = "Please fill in your <strong>Message</strong>";
            return response()->json(['error' => $json]);
        }
        if(!empty($request->bairro) || !empty($request->cidade)){
            $json = "<strong>ERROR</strong> you are practicing SPAM!"; 
            return response()->json(['error' => $json]);
        }else{
            $data = [
                'sitename' => $Configuracoes->nomedosite,
                'siteemail' => $Configuracoes->email,
                'reply_name' => $request->nome,
                'reply_email' => $request->email,
                'mensagem' => $request->mensagem
            ];

            $retorno = [
                'sitename' => $Configuracoes->nomedosite,
                'siteemail' => $Configuracoes->email,
                'reply_name' => $request->nome,
                'reply_email' => $request->email
            ];
            
            Mail::send(new Atendimento($data));
            Mail::send(new AtendimentoRetorno($retorno));
            
            $json = "Thank you {$request->nome}, your message was sent successfully!"; 
            return response()->json(['sucess' => $json]);
        }
    }

    public function sendNewsletter(Request $request)
    {
        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            $json = "The <strong>Email</strong> field is empty or does not have a valid format!";
            return response()->json(['error' => $json]);
        }
        if(!empty($request->bairro) || !empty($request->cidade)){
            $json = "<strong>ERROR</strong> you are practicing SPAM!"; 
            return response()->json(['error' => $json]);
        }else{   
            $validaNews = Newsletter::where('email', $request->email)->first();            
            if(!empty($validaNews)){
                Newsletter::where('email', $request->email)->update(['status' => 1]);
                $json = "Your email is already registered!"; 
                return response()->json(['sucess' => $json]);
            }else{
                $NewsletterCreate = Newsletter::create($request->all());
                $NewsletterCreate->save();
                $json = "Thank you Successfully registered!"; 
                return response()->json(['sucess' => $json]);
            }            
        }
    }
}
