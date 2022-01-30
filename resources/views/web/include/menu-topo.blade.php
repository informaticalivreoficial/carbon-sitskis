<nav class="navbar navbar-defatult navbar-fixed-top fluid-navbar navbar-style1">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="{{route('web.home')}}" class="navbar-brand">
                <img src="{{$configuracoes->getLogomarca()}}" alt="{{$configuracoes->nomedosite}}" class="logo-img">
            </a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav" aria-expanded="false">
                <span class="sr-only">Nav Opener</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="main-nav">            
            <ul class="navbar-nav nav navbar-right">
                <li class="active"><a href="{{route('web.home')}}">Home</a></li>
                <li><a href="https://localhost/Carbon-Sit/public/pagina/about-us">About Us</a></li>
                <li><a href="{{route('web.produtos')}}">Products</a></li>
                <li><a href="{{route('web.atendimento')}}">Contact</a></li>                
            </ul>
        </div>          
    </div>
</nav>