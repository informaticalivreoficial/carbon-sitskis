<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Analytics;
use Spatie\Analytics\Period;
use App\Models\{
    CatPost,
    Parceiro,
    User,
    Post,
    Produto
};
use Spatie\Analytics\Analytics as AnalyticsAnalytics;

class AdminController extends Controller
{
    public function home()
    {
        //Users
        $time = User::where('admin', 1)->orWhere('editor', 1)->count();
        $usersAvailable = User::where('client', 1)->available()->count();
        $usersUnavailable = User::where('client', 1)->unavailable()->count();
        $parceirosAvailable = Parceiro::available()->count();
        $parceirosUnavailable = Parceiro::unavailable()->count();
        $produtosAvailable = Produto::available()->count();
        $produtosUnavailable = Produto::unavailable()->count();
        $paginasPostson = Post::where('tipo', 'pagina')->postson()->count();
        $paginasPostsoff = Post::where('tipo', 'pagina')->postsoff()->count();
        //Artigos
        $postsArtigos = Post::where('tipo', 'artigo')->count();
        $postsNoticias = Post::where('tipo', 'noticia')->count();
        $postsPaginas = Post::where('tipo', 'pagina')->count();
        $produtosTop = Produto::where(DB::raw('YEAR(created_at)'), '=', date('Y'))
                ->limit(6)
                ->available()
                ->get()
                ->sortByDesc('views');
        $totalViewsProdutos = Produto::selectRaw('SUM(views) AS VIEWS')
                ->available()
                ->where( DB::raw('YEAR(created_at)'), '=', date('Y') )
                ->first();
        $paginasTop = Post::where(DB::raw('YEAR(created_at)'), '=', date('Y'))
                ->where('tipo', 'pagina')
                ->limit(6)
                ->postson()
                ->get()
                ->sortByDesc('views');
        $totalViewsPaginas = Post::selectRaw('SUM(views) AS VIEWS')
                ->where('tipo', 'pagina')
                ->postson()
                ->where( DB::raw('YEAR(created_at)'), '=', date('Y') )
                ->first();        

        //Analitcs
        $visitasHoje = Analytics::fetchMostVisitedPages(Period::days(1));
        $visitas365 = Analytics::fetchTotalVisitorsAndPageViews(Period::months(5));
        $top_browser = Analytics::fetchTopBrowsers(Period::months(5));

        $analyticsData = Analytics::performQuery(
            Period::months(5),
               'ga:sessions',
               [
                   'metrics' => 'ga:sessions, ga:visitors, ga:pageviews',
                   'dimensions' => 'ga:yearMonth'
               ]
         );     
         
        return view('admin.dashboard',[
            'time' => $time,
            'usersAvailable' => $usersAvailable,
            'usersUnavailable' => $usersUnavailable,
            'parceirosAvailable' => $parceirosAvailable,
            'parceirosUnavailable' => $parceirosUnavailable,
            'produtosAvailable' => $produtosAvailable,
            'produtosUnavailable' => $produtosUnavailable,
            'paginasPostson' => $paginasPostson,
            'paginasPostsoff' => $paginasPostsoff,
            //Artigos
            'postsArtigos' => $postsArtigos,
            'postsNoticias' => $postsNoticias,
            'postsPaginas' => $postsPaginas,
            //Produtos
            'produtosTop' => $produtosTop,
            'produtostotalviews' => $totalViewsProdutos->VIEWS,
            'paginasTop' => $paginasTop,
            'paginastotalviews' => $totalViewsPaginas->VIEWS,            
            //Analytics
            'visitasHoje' => $visitasHoje,
            //'visitas365' => $visitas365,
            'analyticsData' => $analyticsData,
            'top_browser' => $top_browser
        ]);
    }
}
