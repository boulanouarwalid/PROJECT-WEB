@extends('layouts.dash')
@section('main')

<section class="container-fluid px-4 py-4">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white">
            <h3 class="fw-bold text-primary mb-0">Liste des UEs</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Code UE</th>
                            <th>Nom UE</th>
                            <th>Filière</th>
                            <th>Semestre</th>
                            <th>Enseignant</th>
                            <th>Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dep as $depar)
                        <tr class="table-primary">
                            <td colspan="6"><strong>{{ $depar->nom }}</strong></td>
                        </tr>
                            @foreach($collectionData as $coldata)
                                @if($coldata->department_id == $depar->id)
                                    <tr>
                                        <td>{{ $coldata->code }}</td>
                                        <td>{{ $coldata->nom }}</td>
                                        <td>{{ $coldata->nomf }}</td>
                                        <td>{{ $coldata->semestre }}</td>
                                        <td>{{ $coldata->nomprof }}</td>
                                        <td>{{ $coldata->typeA }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@endsection
