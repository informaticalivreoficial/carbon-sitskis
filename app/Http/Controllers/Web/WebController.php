<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\Web\Atendimento;
use App\Mail\Web\AtendimentoRetorno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\{
    Configuracoes,
    Parceiro,
    Post,
    Produto,
    Slide
};

class WebController extends Controller
{
    public function home()
    {
        $Configuracoes = Configuracoes::where('id', '1')->first();
        $servicos = Post::where('tipo', 'pagina')->where('categoria', 7)->postson()->limit(6)->get();
        $post = Post::where('id', '1')->first();
        $slides = Slide::orderBy('created_at', 'DESC')->available()->get();
        $produtos = Produto::orderBy('created_at', 'DESC')->available()->limit(8)->get();

        $head = $this->seo->render($Configuracoes->nomedosite ?? 'Informática Livre',
            $Configuracoes->descricao ?? 'Falha',
            route('web.home'),
            Storage::url($Configuracoes->metaimg ?? 'https://informaticalivre.com/media/metaimg.jpg')
        ); 

        return view('web.home',[
            'head' => $head,
            'produtos' => $produtos,
            'post' => $post,
            'slides' => $slides,
            'servicos' => $servicos
        ]);
    }

    public function produtos()
    {
        $Configuracoes = Configuracoes::where('id', '1')->first();
        $produtos = Produto::orderBy('created_at', 'DESC')->available()->paginate(12);
        $head = $this->seo->render('Products - ' . $Configuracoes->nomedosite,
            $Configuracoes->descricao,
            route('web.produtos'),
            Storage::url($Configuracoes->metaimg ?? 'https://informaticalivre.com/media/metaimg.jpg')
        ); 
        return view('web.produtos',[
            'head' => $head,
            'produtos' => $produtos
        ]);
    }

    public function produto($slug)
    {
        $Configuracoes = Configuracoes::where('id', '1')->first();
        $produto = Produto::where('slug', $slug)->available()->first();
        $produtos = Produto::orderBy('created_at', 'DESC')->where('id', '!=', $produto->id)->available()->limit(3)->get();

        $produto->views = $produto->views + 1;
        $produto->save();

        $head = $this->seo->render($produto->name ?? $Configuracoes->nomedosite,
            $produto->name ?? $Configuracoes->descricao,
            route('web.produto', ['slug' => $slug]),
            $produto->cover() ?? 'https://informaticalivre.com/media/metaimg.jpg'
        ); 
        return view('web.produto',[
            'head' => $head,
            'produto' => $produto,
            'produtos' => $produtos
        ]);
    }

    public function pagina($slug)
    {
        $parceiros = Parceiro::orderBy('created_at', 'DESC')->available()->limit(6)->get();
        $post = Post::where('slug', $slug)->postson()->first();

        $post->views = $post->views + 1;
        $post->save();

        $Configuracoes = Configuracoes::where('id', '1')->first();
        $head = $this->seo->render($post->titulo ?? $Configuracoes->nomedosite,
            $post->titulo ?? $Configuracoes->descricao,
            route('web.pagina', $slug),
            $post->cover() ?? 'https://informaticalivre.com/media/metaimg.jpg'
        );      

        return view('web.pagina',[
            'head' => $head,
            'post' => $post,
            'parceiros' => $parceiros
        ]);
    }

    public function politica()
    {
        $Configuracoes = Configuracoes::where('id', '1')->first();
        
        $head = $this->seo->render('Política de Privacidade - ' . $Configuracoes->nomedosite ?? 'Informática Livre',
            ' Política de Privacidade - ' . $Configuracoes->nomedosite,
            route('web.politica'),
            Storage::url($Configuracoes->metaimg)
        );

        return view('web.politica',[
            'head' => $head
        ]);
    }

    public function parceiros()
    {
        $Configuracoes = Configuracoes::where('id', '1')->first();
        $parceiros = Parceiro::orderBy('created_at', 'DESC')->available()->paginate(16);
        
        $head = $this->seo->render('Parceiros - ' . $Configuracoes->nomedosite ?? 'Informática Livre',
            'Parceiros - ' . $Configuracoes->nomedosite,
            route('web.parceiros'),
            Storage::url($Configuracoes->metaimg)
        );

        return view('web.parceiros',[
            'head' => $head,
            'parceiros' => $parceiros
        ]);
    }

    public function parceiro($slug)
    {
        $Configuracoes = Configuracoes::where('id', '1')->first();
        $parceiro = Parceiro::where('slug', $slug)->available()->first();

        $parceiro->views = $parceiro->views + 1;
        $parceiro->save();
        
        $head = $this->seo->render($parceiro->name . ' - ' . $Configuracoes->nomedosite ?? 'Informática Livre',
            $parceiro->name . ' - ' . $Configuracoes->nomedosite,
            route('web.parceiro',['slug' => $parceiro->slug]),
            $parceiro->metaimg() ?? Storage::url($Configuracoes->metaimg)
        );

        return view('web.parceiro',[
            'head' => $head,
            'parceiro' => $parceiro
        ]);
    }    

    public function atendimento()
    {
        $Configuracoes = Configuracoes::where('id', '1')->first();
        $head = $this->seo->render('Atendimento',
            'Nossa equipe está pronta para melhor atender as demandas de nossos clientes!',
            route('web.atendimento'),
            Storage::url($Configuracoes->metaimg ?? 'https://informaticalivre.com/media/metaimg.jpg')
        );        

        return view('web.atendimento.fale', [
            'head' => $head,
            'Configuracoes' => $Configuracoes            
        ]);
    }

}