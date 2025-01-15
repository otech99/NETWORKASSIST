@extends('layouts.public')
@section('title', 'Centri Assistenza')
@section('content')
<div class="form-container">
    <h1>Modifica Centro di Assistenza</h1>

    <form action="{{ route('centriAss.update', $centro->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div >
            <label for="indirizzo" >Indirizzo</label>
            <input type="text" name="indirizzo" id="indirizzo" value="{{ $centro->indirizzo}}" required>
        </div>
        
        <div >
            <label for="citta" >Città</label>
            <input type="text" name="citta" id="citta" value="{{  $centro->citta }}" required>
        </div>
        
        <div >
            <label for="telefono" >Telefono</label>
            <input type="text" name="telefono" id="telefono" value="{{ $centro->telefono }}" required>
            @error('telefono')
        <div style="color: red;">{{ $message }}</div>
    @enderror
        </div>

        <button type="submit" class="submit-btn">Salva</button>
        <a href="{{ route('centriAss.index') }}">Annulla</a>
    </form>
</div>
@endsection
