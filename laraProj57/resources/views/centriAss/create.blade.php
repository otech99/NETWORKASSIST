
@extends('layouts.public')
@section('title', 'Centri Assistenza')
@section('content')

<div class="form-container">
    <h1>Crea un Nuovo Centro di Assistenza</h1>

    <form action="{{ route('centriAss.store') }}" method="POST">
        @csrf
        <div >
            <label for="indirizzo" class="form-label">Indirizzo</label>
            <input type="text" name="indirizzo" id="indirizzo" class="form-control" value="{{ old('indirizzo') }}" required>
        </div>
        
        <div >
            <label for="citta" class="form-label">Città</label>
            <input type="text" name="citta" id="citta" class="form-control" value="{{ old('citta') }}" required>
        </div>
        
        <div >
            <label for="telefono" class="form-label">Telefono</label>
            <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono') }}" required>
            @error('telefono')
           <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="submit-btn">Crea Centro</button>
        <a href="{{ route('centriAss.index') }}">Annulla</a>
    </form>
</div>
@endsection
