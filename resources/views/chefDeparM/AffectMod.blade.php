@extends('layouts.dash_depar')
@section('main')

<section class="content py-4">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <form action="{{ route('store_af', $id) }}" method="POST">
                    @csrf
                    <div class="heeader d-flex align-items-center gap-3 mb-3">
                        <div class="custom-select">
                            <select name="type" id="type_cours">
                                <option value="cour">Cours</option>
                                <option value="tp">Travaux Pratiques</option>
                                <option value="td">Travaux Dirigés</option>
                            </select>
                        </div>
                        <button type="submit" class="Eng-button"><i class="fa-solid fa-floppy-disk"></i> Affecter</button>
                    </div>
                    <div class="table-responsive">
                        <table class="teachers-table table table-hover align-middle">
                            <thead>
                            </thead>
                            <tbody>
                                @foreach($DataProf as $user)
                                    <tr>
                                        <td><input type="radio" name="prof_id" value="{{ $user->id }}" ></td>
                                        <td class="img"><img src="{{ asset('assets/images/profp.jpg') }}" alt=""> </td>
                                        <td>{{$user->lastName}} {{$user->firstName}} </td>
                                        <td>{{$user->specialite}}</td>
                                        <td>{{$user->CIN}}</td>
                                        <td>{{$user->Email}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
