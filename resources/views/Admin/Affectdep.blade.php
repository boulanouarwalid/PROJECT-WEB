@extends('layouts.dash')

@section('main')

<section class="container-fluid px-4 py-4">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex align-items-center gap-2">
            <h2 class="mb-0 fw-bold text-primary">Choisir un chef de département</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('Afectation', $idD) }}" method="POST">
                @csrf
                <div class="mb-4 d-flex justify-content-between align-items-center">
                    <span class="fw-semibold">Sélectionnez un enseignant à affecter comme chef de département :</span>
                    <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                        <i class="bi bi-share"></i> Enregistrer
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Sélection</th>
                                <th>Enseignant</th>
                                <th>Nom complet</th>
                                <th>Département</th>
                                <th>Identifiant</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($EnsinatDep as $Ensignant)
                                <tr>
                                    <td>
                                        <input type="radio" name="ensignantId" value="{{ $Ensignant->id }}" required>
                                    </td>
                                    <td>
                                        <img src="{{ asset('assets/images/profp.jpg')}}" class="rounded-circle" width="40" height="40" alt="Avatar">
                                    </td>
                                    <td>{{ $Ensignant->lastName }} {{ $Ensignant->firstName }}</td>
                                    <td>{{ $Ensignant->deparetement }}</td>
                                    <td>{{ $Ensignant->CIN }}</td>
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
