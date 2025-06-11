@extends('layouts.dash')
@section('main')

<section >
    <div >
        <div class="headere">
            <h2 class="pagetitlee">
                <i class="fas fa-file-pdf"></i>
                <span>Annonces PDF</span>
            </h2>
            <!-- Bouton pour ouvrir la modale -->
            <button id="openModaleee" class="add--button">
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

        <div class="pdflist">
            @foreach ($DataAnonces as $doc)
            <div class="pdfcard">
                <div class="pdf-preview d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-file-pdf pdf-icon"></i>
                </div>
                <div class="pdf-info">
                    <h5 class="pdf-title">{{ $doc->name }}</h5>
                    <div class="pdf-meta">
                        <span>{{ $doc->tail }} MB</span>
                        <span>{{ $doc->created_at }}</span>
                    </div>
                    <div class="pdf-actions">
                        <a href="{{ route('supresionAnonces' , $doc->id) }}" class="pdf-btn view-btnn">
                            <i class="fa-solid fa-trash"></i>
                            <span>Supprimer</span>
                        </a>
                        <a href="{{ asset('storage/'.$doc->file) }}" class="pdf-btn download-btn" download>
                            <i class="fas fa-download"></i>
                            <span>Télécharger</span>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Modal (centré et caché par défaut) -->
        <div id="pdfModaleee" class="modaleee" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="pdfModalLabel">
                        <i class="fas fa-file-upload"></i>
                        <span>Ajouter un PDF</span>
                    </h2>
                    <button type="button" class="close-button" id="closeModalBtn" aria-label="Fermer">&times;</button>
                </div>
                <form id="pdfForm" action="{{ route('uplodefil') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="formggroup">
                            <label for="pdfTitle">Titre du document</label>
                            <input name="titre" type="text" id="pdfTitle" class="form-control" placeholder="Ex: Annonce ..." required>
                        </div>
                        <div class="formggroup">
                            <label for="pdfDescription">Description</label>
                            <textarea name="Description" id="pdfDescription" class="form-control" rows="3" placeholder="Décrivez le contenu du document..."></textarea>
                        </div>
                        <div class="formggroup">
                            <label>Téléverser le fichier PDF</label>
                            <label class="file-upload">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <span>Cliquez ou glissez-déposez votre PDF ici</span>
                                <input name="file" type="file" id="pdfFile" required>
                            </label>
                            <small class="text-muted">Format accepté: PDF (max. 10MB)</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="submit-button" id="cancelBtn" style="background:#ccc;color:#222;">
                            Annuler
                        </button>
                        <button type="submit" class="submit-button">
                            <i class="fas fa-upload"></i>
                            <span>Publier le document</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Fin Modal -->
    </div>
</section>

<script>
    // Sélecteurs
    const modal = document.getElementById('pdfModaleee');
    const openModalBtn = document.getElementById('openModaleee');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const cancelBtn = document.getElementById('cancelBtn');

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
