@extends('layouts.dash')
@section('main')

<section class="container-fluid px-4 py-4">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h2 class="mb-0 fw-bold text-primary">{{$Nom_departement}} :</h2>
            <button type="submit" form="affect-form" class="btn btn-primary d-flex align-items-center gap-2">
                <i class="bi bi-save"></i> Enregistrer
            </button>
        </div>
        <div class="card-body">
            <form id="affect-form" action="{{ route('create_responsabilite' , ['idD' => $idD]) }}" method="POST">
                @csrf
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th></th>
                                <th>Nom & Prénom</th>
                                <th>Département</th>
                                <th>CIN</th>
                                <th>Email</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($UserData as $user)
                                <tr>
                                    <td>
                                        <input type="radio" name="id" value="{{ $user->id }}|{{$idFeliere}}">
                                    </td>
                                    <td>{{ $user->lastName }} {{ $user->firstName }}</td>
                                    <td>{{ $user->deparetement }}</td>
                                    <td>{{ $user->CIN }}</td>
                                    <td>{{ $user->Email }}</td>
                                    <td>
                                        <span class="badge bg-success">Actif</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection
