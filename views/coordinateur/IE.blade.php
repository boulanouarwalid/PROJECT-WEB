@extends('layouts.app')

@section('title', 'Export de Données')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Export de Données</h1>
</div>

<div class="row">
    <!-- Export Section -->
    <div class="col-md-8 mx-auto mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="bi bi-download me-2"></i>Exporter des Données</h5>
            </div>
            <div class="card-body">
                <form id="exportForm" action="{{ route('export.process') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="exportDataType" class="form-label">Type de données</label>
                        <select class="form-select" name="type" id="exportDataType" required>
                            <option value="" selected disabled>Sélectionner un type</option>
                            <option value="unites">Unités d'Enseignement</option>
                            <option value="vacataires">Liste des Vacataires</option>
                            <option value="affectations">Affectations</option>
                            <option value="emplois">Emplois du Temps</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="exportFormat" class="form-label">Format</label>
                        <select class="form-select" name="format" id="exportFormat" required>
                            <option value="xlsx">Excel (.xlsx)</option>
                            <option value="csv">CSV (.csv)</option>
                            <option value="pdf">PDF (.pdf)</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Options</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="headers" id="includeHeaders" checked>
                            <label class="form-check-label" for="includeHeaders">Inclure les en-têtes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="all_data" id="exportAll" checked>
                            <label class="form-check-label" for="exportAll">Exporter toutes les données</label>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi bi-download me-1"></i> Exporter
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Templates Section -->
<div class="card shadow-sm mb-4">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0"><i class="bi bi-file-earmark-arrow-down me-2"></i>Templates de Données</h5>
    </div>
    <div class="card-body">
        <p>Téléchargez nos modèles pré-formatés pour voir la structure des données :</p>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ asset('templates/unites_template.xlsx') }}" class="btn btn-outline-primary">
                <i class="bi bi-file-earmark-excel me-1"></i> Unités d'Enseignement
            </a>
            <a href="{{ asset('templates/vacataires_template.xlsx') }}" class="btn btn-outline-primary">
                <i class="bi bi-file-earmark-excel me-1"></i> Vacataires
            </a>
            <a href="{{ asset('templates/affectations_template.xlsx') }}" class="btn btn-outline-primary">
                <i class="bi bi-file-earmark-excel me-1"></i> Affectations
            </a>
            <a href="{{ asset('templates/emplois_template.xlsx') }}" class="btn btn-outline-primary">
                <i class="bi bi-file-earmark-excel me-1"></i> Emplois du Temps
            </a>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Handle export form submission
    $('#exportForm').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);
        const type = $('#exportDataType').val();
        const format = $('#exportFormat').val();
        
        // For PDF, submit normally (no AJAX)
        if (format === 'pdf') {
            // Create a hidden iframe for PDF download
            const iframe = document.createElement('iframe');
            iframe.style.display = 'none';
            iframe.name = 'pdfExportFrame';
            document.body.appendChild(iframe);
            
            // Change form target to the iframe
            form.attr('target', 'pdfExportFrame');
            
            // Submit normally
            form.off('submit').submit();
            
            // Remove iframe after some time
            setTimeout(() => {
                document.body.removeChild(iframe);
            }, 5000);
            return;
        }
        
        // For Excel/CSV, use AJAX with loading indicator
        Swal.fire({
            title: 'Préparation de l\'export',
            text: `Préparation du fichier ${type} en format ${format}...`,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            xhrFields: {
                responseType: 'blob'
            },
            success: function(data) {
                Swal.close();
                
                // Create download link
                const blob = new Blob([data]);
                const link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                
                // Set filename based on type and format
                const extension = format === 'xlsx' ? 'xlsx' : 'csv';
                link.download = `${type}_export.${extension}`;
                link.click();
            },
            error: function(xhr) {
                Swal.fire(
                    'Erreur!',
                    'Une erreur est survenue lors de l\'export.',
                    'error'
                );
                console.error(xhr.responseText);
            }
        });
    });
});
</script>
@endsection