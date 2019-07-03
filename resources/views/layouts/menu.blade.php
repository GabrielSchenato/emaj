<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">        
        <a class="navbar-brand" href="{{ route('institucional.home') }}">
            <img src="/images/logo_emaj_uniplac_branco.png" height="95" width="260" alt="Universidade do Planalto Catarinense - UNIPLAC e Escritório Modelo de Assistência Jurídica – EMAJ" id="logo_emaj_uniplac" class="navbar-brand">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ request()->routeIs('institucional.home') ? 'active' : '' }}">
                    <a href="{{ route('institucional.home') }}" class="nav-link">
                        Início
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('institucional.sobre') ? 'active' : '' }}">
                    <a href="{{ route('institucional.sobre') }}" class="nav-link">
                        Sobre
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('institucional.como_funciona') ? 'active' : '' }}">
                    <a href="{{ route('institucional.como_funciona') }}" class="nav-link">
                        Como Funciona
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('institucional.contato') ? 'active' : '' }}">
                    <a href="{{ route('institucional.contato') }}" class="nav-link">
                        Contato
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('portal.home') }}/" class="nav-link">
                        Login
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>