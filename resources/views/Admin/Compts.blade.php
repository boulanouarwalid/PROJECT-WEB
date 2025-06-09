@extends('layouts.dash')
@section('main')

<section class="container-fluid px-4 py-4" style="font-family: var(--poppins), var(--lato), sans-serif;">
    <!-- Title & Messages -->
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-2">
            <div>
                <h2 class="fw-bold text-primary mb-1">Utilisateurs</h2>
                <p class="mb-0 text-muted"><span>Département</span> / Enseignant</p>
            </div>
        </div>
        <div>
            @if(Session()->has('messagesupresion'))
                <div id="messageDiv" class="alert alert-success d-flex align-items-center gap-2 mb-2" role="alert">
                    <i class="bi bi-check-circle-fill"></i> {{ session('messagesupresion') }}
                </div>
            @endif
            @if(Session()->has('ajouterCompt'))
                <div id="message" class="alert alert-success d-flex align-items-center gap-2 mb-2" role="alert">
                    <i class="bi bi-check-circle-fill"></i> {{ session('ajouterCompt') }}
                </div>
            @endif
            @if(Session()->has('messageUpdate'))
                <div id="messageDiv" class="alert alert-success d-flex align-items-center gap-2 mb-2" role="alert">
                    <i class="bi bi-check-circle-fill"></i> {{ session('messageUpdate') }}
                </div>
            @endif
        </div>
    </div>

    <!-- Search Form -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form action="{{ route('searchName') }}" method="POST" class="search-compte mb-3">
                @csrf
                <div>
                    <label for="search-id" class="form-label">ID</label>
                    <input type="text" id="search-id" class="form-control" name="searchid" placeholder="Rechercher par ID...">
                </div>
                <div>
                    <label for="search-email" class="form-label">Email</label>
                    <input type="email" id="search-email" class="form-control" name="emailsearch" placeholder="Rechercher par Email...">
                </div>
                <div>
                    <label for="search-name" class="form-label">Nom</label>
                    <input type="text" id="search-name" class="form-control" name="namesearch" placeholder="Rechercher par Nom...">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary d-flex align-items-center gap-2">
                        <i class="bi bi-search"></i> Rechercher
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Table & Actions -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h3 class="mb-0 fw-semibold text-primary d-flex align-items-center gap-2">
                <i class="bi bi-person-badge"></i>
                Enseignants
            </h3>
            <div class="d-flex gap-2">
                <a href="{{ route('create') }}" class="btn btn-success d-flex align-items-center gap-2">
                    <i class="bi bi-person-plus"></i> Ajouter
                </a>
                <button class="btn btn-outline-primary d-flex align-items-center gap-2">
                    <a style="color:#000;" href="{{ route('exportEns') }}"><i style="color:#000;" class="bi bi-download"></i> Télécharger</a>
                </button>
            </div>
        </div>
        <div class="card-body pt-0">
            <div class="mb-2 text-end text-muted small">
                <span>Vue &gt;</span>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Département</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datacompts as $compts)
                        <tr>
                            <td>{{ $compts->id }}</td>
                            <td>{{ $compts->lastName }}</td>
                            <td>{{ $compts->firstName }}</td>
                            <td>{{ $compts->Email }}</td>
                            <td>{{ $compts->deparetement }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('edit', $compts->id) }}" class="btn btn-sm btn-outline-primary" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <!-- Delete Button triggers modal -->
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $compts->id }}" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal-{{ $compts->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $compts->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="deleteModalLabel-{{ $compts->id }}">
                                                        <i class="bi bi-exclamation-triangle-fill me-2"></i> Supprimer le compte
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>La suppression sera définitive. Voulez-vous continuer ?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                    <form action="{{ route('delete', $compts->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal -->
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $datacompts->links() }}
            </div>
        </div>
    </div>
</section>

@endsection
