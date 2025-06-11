@extends('layouts.dash_depar')
@section('main')
<section id="contenteee" class="py-4">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="header">
                    <div class="header-actions">
                        <form action="{{ route('searchModule') }}" method="POST">
                            @csrf
                            @if(Session()->has('messagecreat'))
                                <div id="validationMessage" class="validation-message">
                                    <span>✔ {{ session('messagecreat') }} </span>
                                </div>
                            @endif
                            @if(Session()->has('messageupdate'))
                                <div id="validationMessage" class="validation-message">
                                    <span>✔ {{ session('messageupdate') }} </span>
                                </div>
                            @endif
                            @if(Session()->has('supresion'))
                                <div id="validationMessage" class="validation-message">
                                    <span><i class="fa-solid fa-trash" style="color: white;"></i> {{ session('supresion') }} </span>
                                </div>
                            @endif
                            @if(Session()->has('Maff'))
                                <div id="validationMessage" class="validation-message">
                                    <span>✔ {{ session('Maff') }} </span>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
                <div class="table-container">

                        <div class="table-header">
                            <div class="table-title">

                            </div>

                            <div class="table-actions">



                            </div>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>code </th>
                                    <th>Ensinemant</th>
                                    <th>Cin </th>
                                    <th>Ensinant</th>
                                    <th>Semestre</th>
                                    <th>heurs</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($collectionData as $modules)
                                    <tr>
                                        <td>{{$modules->code}}</td>
                                        <td>{{$modules->nom}}</td>
                                        <td>{{$modules->cinprof}}</td>
                                        <td>{{$modules->nomprof}}</td>
                                        <td>{{$modules->semestre}}</td>
                                        <td >
                                            {{$modules->heures_cm}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
