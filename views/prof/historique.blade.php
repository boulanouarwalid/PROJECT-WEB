@extends('layouts.app')
@section ('title', 'Historique')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Historique des Affectations</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('prof.dash') }}">Tableau de Bord</a></li>
        <li class="breadcrumb-item active">Historique</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Historique des Modules (5 Dernières Années)
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Année Universitaire</th>
                        <th>Code UE</th>
                        <th>Nom UE</th>
                        <th>Volume Horaire</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                   
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection