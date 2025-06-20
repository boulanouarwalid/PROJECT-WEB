@extends('layouts.dash')

@section('main')

<!-- Link to your custom CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/specialite.css') }}">

<section class="container-fluid px-4 py-4 ">
    <div class="card border-0 shadow-sm ">
        <div class="card-body">
            <div class="headeerr mb-4">
                <h1 class="fw-bold text-primary mb-0">Gestion des Spécialités</h1>
                <!-- Button to trigger modal -->
                <button class="spe_btn d-flex align-items-center gap-2" id="ouvert">
                    <i class="bi bi-plus"></i> Ajouter
                </button>
            </div>
            @if(Session()->has('messageCreat'))
                <div id="messageDiv" class="alert alert-success d-flex align-items-center gap-2 mb-3" role="alert">
                    <i class="bi bi-check-circle-fill"></i> {{ session('messageCreat') }}
                </div>
            @endif
            @if(Session()->has('messageSupe'))
                <div id="messageDiv" class="alert alert-success d-flex align-items-center gap-2 mb-3" style="color:green;" role="alert">
                    <i class="bi bi-check-circle-fill"></i> {{ session('messageSupe') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="spe table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nom</th>
                            <th>Département</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="specialites-table">
                        @foreach($specielite as $spe)
                        <tr>
                            <td>{{ $spe->Nom }}</td>
                            <td>{{ $spe->Nomdepartement }}</td>
                            <td>{{ $spe->description }}</td>
                            <td>
                                <form action="{{ route('delete_spe', $spe->id) }}" method="POST" class="d-inline">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger ds" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modal for Adding Specialité (centered and hidden by default) -->
            <div class="form-overlaay" id="formModal">
                <div class="formme-ccontainer">
                    <span class="closee-btn" id="closeModal">&times;</span>
                    <h2 class="modal-title fs-5 d-flex align-items-center gap-2 mb-4" id="formModalLabel">
                        <i class="bi bi-award-fill text-primary"></i>
                        Nouvelle Spécialité
                    </h2>
                    <form class="spef" action="{{ route('create_spe') }}" method="POST">
                        @csrf
                        <div class="formme-group">
                            <label class="form-label fw-semibold text-primary">Nom</label>
                            <input type="text" name="Nom" id="nom" class="form-control" placeholder="Nom diplôme ..." required>
                        </div>
                        <div class="formme-group">
                            <label class="form-label fw-semibold text-primary">Département</label>
                            <select name="idDepartement" id="departement" class="form-select" required>
                                @foreach($departement as $dep)
                                    <option value="{{ $dep->id }}">{{ $dep->Nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="formme-group">
                            <label class="form-label fw-semibold text-primary">Description</label>
                            <textarea name="description" id="description" class="form-control" placeholder="Entrer description ..." rows="3"></textarea>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-light" id="cancelModal">Annuler</button>
                            <button type="submit" class="btnEnreg d-flex align-items-center gap-2 px-4">
                                <i class="bi bi-check-circle"></i> Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Modal -->
        </div>
    </div>
</section>


<script>


    document.addEventListener('DOMContentLoaded', function() {
        const ouvertButton = document.getElementById('ouvert');
        const formModal = new bootstrap.Modal(document.getElementById('formModal'));

        ouvertButton.addEventListener('click', function() {
            formModal.show();
        });


    });

    let anulebtn = document.getElementById('cancelModal');
    anulebtn.addEventListener('click', function() {
        document.getElementById('formModal').style.display = 'none';
    });

</script>
<style>
    /* Modern modal for specialité */
    .specialite-modal-content {
        border-radius: 18px;
        box-shadow: 0 8px 32px rgba(44, 62, 80, 0.18);
        border: none;
        background: #fff;
        padding: 0;
        overflow: hidden;
        animation: modalPop .25s cubic-bezier(.4,2,.6,1) both;
    }
    @keyframes modalPop {
        0% { transform: scale(.95); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }
    .modal-header {
        background: #f8f9fa;
        color: #2563eb;
        border-bottom: none;
        padding: 1.5rem 2rem 0.5rem 2rem;
    }
    .modal-title {
        font-size: 1.25rem;
        font-weight: 600;
        letter-spacing: .5px;
    }
    .modal-body {
        padding: 1.5rem 2rem 1rem 2rem;
        color: #333;
        font-size: 1.08rem;
    }
    .modal-footer {
        border-top: none;
        padding: 1rem 2rem 1.5rem 2rem;
        background: #f8fafc;
        display: flex;
        justify-content: flex-end;
        gap: 0.5rem;
    }
    .form-label {
        font-weight: 600;
        color: #2563eb;
        margin-bottom: 6px;
    }
    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #d1d5db;
        transition: border 0.2s;
        font-size: 1rem;
        background: #fff;
    }
    .form-control:focus, .form-select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 0.15rem rgba(37,99,235,.15);
    }
    .btn-primary {
        border-radius: 30px;
        font-weight: 600;
        letter-spacing: .5px;
        background: linear-gradient(90deg, #2563eb 0%, #3f51b5 100%);
        border: none;
        transition: background .2s;
    }
    .btn-primary:hover {
        background: linear-gradient(90deg, #3f51b5 0%, #2563eb 100%);
    }
</style>

@endsection
