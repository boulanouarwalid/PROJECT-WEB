@extends('layouts.dash')
@section('main')

<section class="container-fluid px-4 py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4 headee">
                        <h2 class="fw-bold text-primary mb-0 ">
                            <i class="fas fa-file-pdf"></i>
                            <span>Annonces PDF</span>
                        </h2>
                        <!-- Bouton pour ouvrir la modale -->
                        <button id="openModaleee" class="add--button d-flex align-items-center gap-2">
                            <i class="fas fa-plus"></i>
                            <span>Ajouter un PDF</span>
                        </button>
                    </div>

                    @if(Session()->has('uplodsucces'))
                        <div id="messageDiv" class="alert alert-success d-flex align-items-center gap-2 mb-3" role="alert">
                            <i class="fa-solid fa-circle-check"></i> {{session('uplodsucces')}}
                        </div>
                    @endif
                    @if(Session()->has('supresionfile'))
                        <div id="messageDiv" class="alert alert-success d-flex align-items-center gap-2 mb-3" role="alert">
                            <i class="fa-solid fa-circle-check"></i> {{session('supresionfile')}}
                        </div>
                    @endif

                    <div class="pdflist row g-3">
                        @foreach ($DataAnonces as $doc)
                        <div class="col-md-4">
                            <div class="pdfcard card h-100 border-0 shadow-sm">
                                <div class="card-body d-flex flex-column align-items-center">
                                    <i class="fas fa-file-pdf pdf-icon mb-3"></i>
                                    <h5 class="pdf-title card-title text-center">{{ $doc->name }}</h5>
                                    <div class="pdf-meta mb-2 text-muted small">
                                        <span>{{ $doc->tail }} MB</span> &middot; <span>{{ $doc->created_at }}</span>
                                    </div>
                                    <div class="pdf-actions d-flex justify-content-center gap-2 mt-auto">
                                        <a href="{{ route('supresionAnonces' , $doc->id) }}" class="pdf-btn btn btn-sm btn-outline-danger d-flex align-items-center gap-1">
                                            <i class="fa-solid fa-trash"></i>
                                            <span>Supprimer</span>
                                        </a>
                                        <a href="{{ asset('storage/'.$doc->file) }}" class="pdf-btn btn btn-sm btn-outline-primary d-flex align-items-center gap-1" download>
                                            <i class="fas fa-download"></i>
                                            <span>Télécharger</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Modal (centré et caché par défaut) -->
                    <div id="pdfModaleee" class="modaleee fade" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title fs-5 d-flex align-items-center gap-2" id="pdfModalLabel">
                                        <i class="fas fa-file-upload"></i>
                                        <span>Ajouter un PDF</span>
                                    </h2>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                </div>
                                <form id="pdfForm" action="{{ route('uplodefil') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="formggroup mb-3">
                                            <label for="pdfTitle" class="form-label">Titre du document</label>
                                            <input name="titre" type="text" id="pdfTitle" class="form-control" placeholder="Ex: Annonce ..." required>
                                        </div>
                                        <div class="formggroup mb-3">
                                            <label for="pdfDescription" class="form-label">Description</label>
                                            <textarea name="Description" id="pdfDescription" class="form-control" rows="3" placeholder="Décrivez le contenu du document..."></textarea>
                                        </div>
                                        <div class="formggroup mb-3">
                                            <label class="form-label">Téléverser le fichier PDF</label>
                                            <div class="file-upload">
                                                <i class="fas fa-cloud-upload-alt"></i>
                                                <span>Cliquez ou glissez-déposez votre PDF ici</span>
                                                <input name="file" type="file" id="pdfFile" accept=".pdf" required>
                                            </div>
                                            <small class="text-muted">Format accepté: PDF (max. 10MB)</small>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        <button type="submit" class="submit-button">
                                            <i class="fas fa-upload"></i>
                                            <span>Publier le document</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Fin Modal -->
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Sélecteurs
    const modal = document.getElementById('pdfModaleee');
    const openModalBtn = document.getElementById('openModaleee');
    const closeModalBtn = modal.querySelector('.btn-close');
    const cancelBtn = modal.querySelector('button.btn.btn-secondary');

    // Ouvrir la modale
    openModalBtn.addEventListener('click', () => {
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    });

    // Fermer la modale
    function closeModal() {
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }

    closeModalBtn.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);

    // Fermer si clic en dehors du contenu modal
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeModal();
        }
    });

    // Fermer avec touche Échap
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal.style.display === 'flex') {
            closeModal();
        }
    });
</script>

@endsection
