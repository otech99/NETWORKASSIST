<nav class="navbar">
    <div class="navbar-left">
        <h1>NetWorks Assist</h1>    
    </div>
    <div class="navbar-center">
        <!-- Logo del sito -->
        <a href="{{ route('welcome') }}">
            <img src="{{ asset('images/file.png') }}" alt="Logo del sito">
        </a>
    </div>
    <div class="navbar-right">
        
        <a href="{{ route('catalogo') }}" class="nav-button">Catalogo</a>
        <a href="{{ route('centriAss.index') }}" class="nav-button">Centri Assistenza</a>
        @auth
        <!-- Mostra il pulsante Dashboard se l'utente è loggato -->
        <a href="{{ route('dashboard') }}" class="nav-button">Dashboard</a>

        <form method="POST" action="{{ route('logout') }}" style="display: none;" id="logout-form">
                @csrf
            </form>
            <a href="#" class="logout-button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
    @else
        <!-- Mostra il pulsante Login se l'utente non è loggato -->
        <a href="{{ route('login') }}" class="nav-button">Login</a>
    @endauth
    </div>
    
</nav>
