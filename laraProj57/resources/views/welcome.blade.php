@extends('layouts.public')
@section('title', 'Home')
@section('content')
<div class="img-container">
    <img src="{{ asset('images/Pag-Servizi_AssistenzaTecnica.jpg') }}" alt="Assistenza Tecnica">
    </div>
    <div class="section services">
	<h2>I Nostri Servizi</h2>
	<img src= https://img.icons8.com/000000/ios11/2x/services--v1.png>
        <p>Riparazione Router, Configurazione Rete, Supporto Tecnico</p>
        <li><a href="{{asset('images/Documentazione.pdf')}}"><strong>Documentazione sito</strong></a></li>
    </div>
    <div class="section contact">
        <h2>Contattaci</h2>
        <p>Email: supporto@networksassist.com | Telefono: 123-456-7890</p>
        <li><a href="mailto:supporto@networksassist.com" title="Mandaci un messaggio">Contattaci</a></li>
    </div>
@endsection
