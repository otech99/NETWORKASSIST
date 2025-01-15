<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <script type="text/javascript" src="{{ URL::asset('js/functions.js') }}"></script>
    <link rel="icon" type="image/x-icon" href="/images/file.png">
    <title>Networksassist | @yield('title', 'Catalogo')</title>
</head>
<body>
    <div class="flex flex-col min-h-screen">
        <!-- end #header -->
        <div id="menu">
            @include('layouts/navigation')
        </div>

        <!-- end #menu -->
        <div id="page" class="flex-grow">
            <div id="page-bgtop">
                <div id="page-bgbtm">
                    @yield('content')
                    <div style="clear: both;">&nbsp;</div>
                </div>
            </div>
        </div>

        <!-- end #content -->
        <div id="footer">
            <div class="footer-section">
            @if(!(Auth::check() && (Auth::user()->tipo_account === 'admin' || Auth::user()->tipo_account === 'staff')))
                <h3>Chi Siamo</h3>
                <p>NetWorks Assist è un'azienda specializzata nel fornire supporto tecnico per dispositivi di rete. La nostra missione è garantire una connettività affidabile e continua per i nostri clienti.</p>
            </div>
            <div class="footer-section">
                <li><a href="{{ route('where') }}" title="Dove trovarci">Dove Siamo</a></li>
                @endif
                <p>&copy; 2024 NetWorks Assist. Tutti i diritti riservati.</p>
            </div>
        </div>
        <!-- end #footer -->
    </div>
    
</body>
</html>
