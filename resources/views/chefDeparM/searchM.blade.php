@extends('layouts.dash_depar')
@section('main')

<section id="contenteee" class="py-4">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="table-container">
                    <div class="table-header">
                        <div class="table-title">
                            <h3>Liste des Modules/class : </h3>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>id module </th>
                                    <th>Module</th>
                                    <th>Ensignant</th>
                                    <th>Félier</th>
                                    <th>Niveaux</th>
                                    <th>Nombre Heurs</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataFeliere as $module)
                                    <tr>
                                        <td>{{$module->id}}</td>
                                        <td>{{$module->NomModule}}</td>
                                        <td>{{$module->Nomprof}}</td>
                                        <td>{{$module->feliere}}</td>
                                        <td>{{$module->niveaux}}</td>
                                        <td><span class="badge bg-success">{{$module->NombreHeurs}}H</span></td>
                                        <td class="btnact">
                                            <button class="actionn-btn edite" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('deletemodele',$module->id) }}" method="POST" >
                                                @csrf
                                                @method('DELETE')
                                                <button class="actionn-btn deletee" title="Supprimer">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
