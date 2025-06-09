@extends('layouts.app')
@section('title', 'Importer des UEs')
@section('content')
<div class="container mt-5">
    <h2>Importer des UEs</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <form method="POST" action="{{ route('coordinateur.ues.import') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="ue_file" class="form-label">Fichier Excel (.xlsx, .xls)</label>
            <input type="file" class="form-control" id="ue_file" name="ue_file" required>
        </div>
        <button type="submit" class="btn btn-primary">Importer</button>
    </form>
    <div class="mt-4">
        <strong>Format attendu :</strong>
        <pre>Nom UE | Semestre | CM | TD | TP | Groupes TD | Groupes TP</pre>
        <small>Les colonnes Groupes TD et Groupes TP peuvent être vides.</small>
    </div>
</div>
@endsection
