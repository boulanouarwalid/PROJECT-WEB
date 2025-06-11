@extends('layouts.dash')
@section('main')

<section >
    <!-- Graphiques -->
    <div class="grid-container mb-4">
        <div class="chart-box">
            <div class="chart-header">
                <h3><i class="fa-solid fa-chart-pie"></i> Ensignant Departement :</h3>
            </div>
            <div class="chart-placeholder" id="enseignant-dept-chart"></div>
        </div>
        <div class="chart-box">
            <div class="chart-header">
                <h3><i class="fas fa-chart-line"></i> Administration :</h3>
            </div>
            <div class="chart-placeholder" id="admin-chart"></div>
        </div>
    </div>

    <!-- Tableaux -->
    <div class="card">
        <div class="card-header">
            <h3>Posts Administration :</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Post</th>
                            <th>Departement</th>
                            <th>Filière</th>
                            <th>Responsable</th>
                            <th>CIN</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Responsabilite as $resp)
                        <tr>
                            <td>{{ $resp->Responsabilite }}</td>
                            <td>{{ $resp->nomd }}</td>
                            <td>{{ $resp->nomf }}</td>
                            <td>{{ $resp->Nomprof }}</td>
                            <td>{{ $resp->CIN }}</td>
                            <td>
                                <a href="{{ route('delet_resp', $resp->id) }}" class="btn btn-sm btn-outline-danger" title="Supprimer">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // on fait de retourner donnes laravel serveur en format json javascript :
        window.chartdata = {
            informatique: @json($sta_Dinfo),
            physique: @json($sta_Dphysique),
            totalProf: @json($totale_Prof)
        };
    </script>
    <script src="{{ asset('assets/js/statDepAdmin.js') }}"></script>
</section>

@endsection
