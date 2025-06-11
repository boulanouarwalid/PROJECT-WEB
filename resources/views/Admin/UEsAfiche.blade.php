@extends('layouts.dash')
@section('main')

<section >
    <div class="table-Container">
        <h3 style="color:#205781;font-weight:bold;margin-bottom:18px;">Liste des UEs</h3>
        <table class="uestable">
            <thead>
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
                <tr class="filiere-header">
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
</section>

@endsection
