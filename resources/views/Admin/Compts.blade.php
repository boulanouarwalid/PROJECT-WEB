@extends('layouts.dash')
@section('main')

<section  style="font-family: var(--poppins), var(--lato), sans-serif;">
    <!-- Title & Messages -->
    <div class="title">
        <h2>Utilisateurs</h2>
        <p><span>Département</span> / Enseignant</p>
    </div>
    <div>
        @if(Session()->has('messagesupresion'))
            <div id="messageDiv" class="message-box d-flex align-items-center gap-2 mb-2" role="alert">
                <i class="bi bi-check-circle-fill"></i> {{ session('messagesupresion') }}
            </div>
        @endif
        @if(Session()->has('ajouterCompt'))
            <div id="message" class="message-box d-flex align-items-center gap-2 mb-2" role="alert">
                <i class="bi bi-check-circle-fill"></i> {{ session('ajouterCompt') }}
            </div>
        @endif
        @if(Session()->has('messageUpdate'))
            <div id="messageDiv" class="message-box d-flex align-items-center gap-2 mb-2" role="alert">
                <i class="bi bi-check-circle-fill"></i> {{ session('messageUpdate') }}
            </div>
        @endif
    </div>

    <!-- Search Form -->
    <div class="search-container">
        <form action="{{ route('searchName') }}" method="POST">
            @csrf
            <div class="search-item">
                <label for="search-id" class="form-label">ID</label>
                <input type="text" id="search-id" class="search-bar" name="searchid" placeholder="Rechercher par ID...">
            </div>
            <div class="search-item">
                <label for="search-email" class="form-label">Email</label>
                <input type="email" id="search-email" class="search-bar" name="emailsearch" placeholder="Rechercher par Email...">
            </div>
            <div class="search-item">
                <label for="search-name" class="form-label">Nom</label>
                <input type="text" id="search-name" class="search-bar" name="namesearch" placeholder="Rechercher par Nom...">
            </div>
            <button type="submit" class="search-btn d-flex align-items-center">
                <i class="bi bi-search"></i> Rechercher
            </button>
        </form>
    </div>

    <!-- Table & Actions -->
    <div class="table-container">
        <div class="eleme">
            <div class="section-title d-flex align-items-center gap-2">
                <i class="bi bi-person-badge"></i>
                <span>Enseignants</span>
            </div>
            <div class="btn">
                <a href="{{ route('create') }}" style="color:#fff;" class="btnadd d-flex align-items-center gap-2">
                    <i class="bi bi-person-plus"></i> Ajouter
                </a>
                <a href="{{ route('exportEns') }}" class="btndw d-flex align-items-center gap-2">
                    <i class="bi bi-download"></i> Télécharger
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="t-compts">
                <thead>
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
                            <button onclick="window.location.href='{{ route('edit', $compts->id) }}'" class="action-btn edit-btn" title="Modifier">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <!-- Delete Button triggers modal -->
                            <button type="button" class="action-btn delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $compts->id }}" title="Supprimer">
                                <i class="bi bi-trash"></i>
                            </button>
                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal-{{ $compts->id }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $compts->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content con_del">
                                        <div class="iconsup">
                                            <i class="bi bi-exclamation-triangle-fill"></i>
                                        </div>
                                        <div class="mess">
                                            <h4>Supprimer le compte</h4>
                                            <p>La suppression sera définitive. Voulez-vous continuer ?</p>
                                        </div>
                                        <div class="btns">
                                            <button type="button" class="anuler" data-bs-dismiss="modal">Annuler</button>
                                            <form action="{{ route('delete', $compts->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="supr">Supprimer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
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
</section>

@endsection
