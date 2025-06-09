document.addEventListener("DOMContentLoaded", function() {
    console.log("Script loaded"); // Debug check
    
    // Sidebar toggle functionality
    const sidebarToggle = document.getElementById('sidebarToggle');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            if (sidebar) {
                sidebar.classList.toggle('collapsed');
                localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
            }
        });
        
        // Initialize from localStorage
        const sidebar = document.getElementById('sidebar');
        if (sidebar && localStorage.getItem('sidebarCollapsed') === 'true') {
            sidebar.classList.add('collapsed');
        }
    }

    // Theme switcher
    const themeSwitch = document.getElementById("theme-switch");
    if (themeSwitch) {
        const body = document.body;
        const moonIcon = themeSwitch.querySelector(".bi-moon-fill");
        const sunIcon = themeSwitch.querySelector(".bi-sun-fill");

        if (localStorage.getItem("darkMode") === "enabled") {
            body.classList.add("dark");
            if (sunIcon) sunIcon.classList.remove("d-none");
            if (moonIcon) moonIcon.classList.add("d-none");
        }

        themeSwitch.addEventListener("click", function() {
            body.classList.toggle("dark");
            if (body.classList.contains("dark")) {
                localStorage.setItem("darkMode", "enabled");
                if (sunIcon) sunIcon.classList.remove("d-none");
                if (moonIcon) moonIcon.classList.add("d-none");
            } else {
                localStorage.setItem("darkMode", "disabled");
                if (sunIcon) sunIcon.classList.add("d-none");
                if (moonIcon) moonIcon.classList.remove("d-none");
            }
        });
    }

    // Specialité/Niveaux functionality
    const specialiteSelect = document.getElementById('specialite');
    if (specialiteSelect) {
        const niveauxContainer = document.getElementById('niveaux-container');
        const niveauxParSpecialite = {
            informatique: ["L1", "L2", "L3", "M1", "M2"],
            mathematiques: ["L1", "L2", "L3"],
            physique: ["L1", "L2", "L3", "M1"],
            chimie: ["L2", "L3", "M1", "M2"]
        };

        specialiteSelect.addEventListener('change', function() {
            const specialite = this.value;
            niveauxContainer.innerHTML = '';
            
            if (specialite && niveauxParSpecialite[specialite]) {
                const row = document.createElement('div');
                row.className = 'row g-2';
                
                niveauxParSpecialite[specialite].forEach(niveau => {
                    const col = document.createElement('div');
                    col.className = 'col-md-4';
                    
                    const div = document.createElement('div');
                    div.className = 'form-check';
                    
                    const input = document.createElement('input');
                    input.className = 'form-check-input';
                    input.type = 'checkbox';
                    input.id = `niveau-${niveau}`;
                    input.name = 'niveaux';
                    input.value = niveau;
                    
                    const label = document.createElement('label');
                    label.className = 'form-check-label';
                    label.htmlFor = `niveau-${niveau}`;
                    label.textContent = niveau;
                    
                    div.appendChild(input);
                    div.appendChild(label);
                    col.appendChild(div);
                    row.appendChild(col);
                });
                
                niveauxContainer.appendChild(row);
            } else {
                niveauxContainer.innerHTML = '<p class="text-muted mb-0">Veuillez d\'abord sélectionner une spécialité</p>';
            }
        });

        const vacataireForm = document.getElementById('vacataireForm');
        if (vacataireForm) {
            vacataireForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Collecter les données du formulaire
                const selectedNiveaux = Array.from(document.querySelectorAll('#niveaux-container input:checked'))
                    .map(checkbox => checkbox.value);
                
                const formData = {
                    nom: document.getElementById('nom').value,
                    prenom: document.getElementById('prenom').value,
                    email: document.getElementById('email').value,
                    telephone: document.getElementById('telephone').value,
                    specialite: specialiteSelect.value,
                    niveaux: selectedNiveaux,
                    sendCredentials: document.getElementById('sendCredentials').checked
                };
                
                console.log('Données à envoyer:', formData);
                // Ici vous ajouteriez l'appel AJAX à votre API backend
                
                // Afficher un message de succès (temporaire)
                alert('Vacataire enregistré avec succès!');
                this.reset();
                niveauxContainer.innerHTML = '<p class="text-muted mb-0">Veuillez d\'abord sélectionner une spécialité</p>';
            });
        }
    }

    // Delete confirmation with SweetAlert2
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.getAttribute('data-url');
            const name = this.getAttribute('data-name');
            
            Swal.fire({
                title: 'Confirmer la suppression',
                html: `Êtes-vous sûr de vouloir supprimer l'UE <strong>${name}</strong> ?<br><small class="text-danger">Cette action est irréversible.</small>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, supprimer!',
                cancelButtonText: 'Annuler',
                customClass: {
                    popup: 'rounded-0'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Create and submit form
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;
                    form.style.display = 'none';
                    
                    // Add CSRF token
                    const csrf = document.createElement('input');
                    csrf.type = 'hidden';
                    csrf.name = '_token';
                    csrf.value = document.querySelector('meta[name="csrf-token"]').content;
                    form.appendChild(csrf);
                    
                    // Add method spoofing
                    const method = document.createElement('input');
                    method.type = 'hidden';
                    method.name = '_method';
                    method.value = 'DELETE';
                    form.appendChild(method);
                    
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    });

    // Initialize tooltips
    if (typeof $ != 'undefined') {
        $('[data-toggle="tooltip"]').tooltip();
    }
});

$(document).ready(function() {
    // Status Change Handler (jQuery)
    $('.status-change').click(function(e) {
        e.preventDefault();
        const vacataireId = $(this).data('id');
        const newStatus = $(this).data('status');
        
        Swal.fire({
            title: 'Confirmer la modification',
            text: `Voulez-vous vraiment changer le statut de ce vacataire à "${newStatus}"?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Oui, modifier',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/vacataire/${vacataireId}/status`,
                    method: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: newStatus
                    },
                    success: function(response) {
                        Swal.fire(
                            'Succès!',
                            'Le statut a été mis à jour.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    },
                    error: function() {
                        Swal.fire(
                            'Erreur!',
                            'Une erreur est survenue.',
                            'error'
                        );
                    }
                });
            }
        });
    });

    // Delete Handler (using jQuery for consistency)
    $(document).ready(function() {
    // Initialize modal and toast
    const deleteModal = new bootstrap.Modal('#deleteVacataireModal');
    const toast = new bootstrap.Toast('#deleteSuccessToast');

    // Delete button click handler
    $(document).on('click', '.delete-vacataire', function() {
        const id = $(this).data('id');
        const name = $(this).data('name');
        const url = $(this).data('url');
        
        $('#vacataire-name').text(name);
        $('#deleteVacataireForm').attr('action', url);
    });

    // Form submission handler
    $('#deleteVacataireForm').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);
        const submitBtn = $('#confirmDeleteBtn');
        
        // Show loading state
        submitBtn.html('<span class="spinner-border spinner-border-sm"></span> Suppression...');
        submitBtn.prop('disabled', true);
        
        // AJAX request
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                if (response.success) {
                    // Hide modal
                    deleteModal.hide();
                    
                    // Show success toast
                    $('#toastMessage').text(response.message);
                    toast.show();
                    
                    // Remove table row
                    $(`[data-id="${response.id}"]`).closest('tr').fadeOut(300, function() {
                        $(this).remove();
                    });
                } else {
                    // Show error message from response
                    alert(response.message);
                }
            },
            error: function(xhr) {
                // Handle HTTP errors
                let errorMessage = 'Une erreur est survenue';
                
                if (xhr.status === 403) {
                    errorMessage = 'Action non autorisée';
                } else if (xhr.status === 404) {
                    errorMessage = 'Vacataire non trouvé';
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                
                alert(errorMessage);
            },
            complete: function() {
                // Reset button state
                submitBtn.html('<i class="bi bi-trash-fill me-1"></i> Supprimer définitivement');
                submitBtn.prop('disabled', false);
            }
        });
    });
});
});




 $(document).ready(function() {
    // Handle export form submission
   $('#exportForm').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);
        const type = $('#exportDataType').val();
        const format = $('#exportFormat').val();
        
        // Show loading modal for all export types
        Swal.fire({
            title: 'Préparation de l\'export',
            text: `Préparation du fichier ${type} en format ${format}...`,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // For PDF, use a different approach
        if (format === 'pdf') {
            // Create a temporary form for PDF export
            const tempForm = document.createElement('form');
            tempForm.action = form.attr('action');
            tempForm.method = 'POST';
            tempForm.style.display = 'none';
            
            // Add all form data
            $(form).find('input, select, textarea').each(function() {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = $(this).attr('name');
                input.value = $(this).val();
                tempForm.appendChild(input);
            });
            
            // Add CSRF token
            const tokenInput = document.createElement('input');
            tokenInput.type = 'hidden';
            tokenInput.name = '_token';
            tokenInput.value = $('meta[name="csrf-token"]').attr('content');
            tempForm.appendChild(tokenInput);
            
            document.body.appendChild(tempForm);
            
            // Submit the temporary form
            tempForm.submit();
            
            // Close the loading modal after a short delay
            setTimeout(() => {
                Swal.close();
            }, 2000);
            
            // Remove the temporary form
            setTimeout(() => {
                document.body.removeChild(tempForm);
            }, 5000);
            
            return;
        }
        
        // For Excel/CSV, use AJAX as before
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            xhrFields: {
                responseType: 'blob'
            },
            success: function(data) {
                Swal.close();
                
                const blob = new Blob([data]);
                const link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
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
    
    // Quick export buttons with confirmation
    $('[href*="export/vacataires"]').on('click', function(e) {
        e.preventDefault();
        const url = $(this).attr('href');
        const format = url.includes('excel') ? 'Excel' : 
                      url.includes('csv') ? 'CSV' : 'PDF';
        
        Swal.fire({
            title: 'Confirmer l\'export',
            text: `Voulez-vous exporter la liste des vacataires en format ${format}?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Oui, exporter',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });
    
    // Custom export handler
    $('#confirmCustomExport').on('click', function() {
        const selectedColumns = [];
        $('[id^="col-"]:checked').each(function() {
            selectedColumns.push($(this).attr('id').replace('col-', ''));
        });
        
        const format = $('#customExportFormat').val();
        
        if (selectedColumns.length === 0) {
            Swal.fire('Attention!', 'Veuillez sélectionner au moins une colonne.', 'warning');
            return;
        }
        
        $('#customExportModal').modal('hide');
        
        // Here you would typically make an AJAX call to your export endpoint
        // with the selected columns and format
        console.log('Exporting with columns:', selectedColumns, 'Format:', format);
        
        Swal.fire(
            'Export personnalisé',
            `Votre export avec ${selectedColumns.length} colonnes en format ${format.toUpperCase()} sera préparé.`,
            'success'
        );
    });
}); 
$(document).ready(function() {
    // Delete record
    $('.delete-record').click(function() {
        const recordId = $(this).data('id');
        if (confirm('Êtes-vous sûr de vouloir supprimer cet enregistrement?')) {
            $.ajax({
                url: `/import-export/history/${recordId}`,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    location.reload();
                }
            });
        }
    });
});



///emploi de temps 
document.addEventListener('DOMContentLoaded', function() {
    const generateBtn = document.getElementById('generateBtn');
    const submitBtn = document.getElementById('submitBtn');
    const ueSection = document.getElementById('ueSection');
    const ueList = document.getElementById('ueList');
    
    generateBtn.addEventListener('click', function() {
        const filiereId = document.getElementById('filiere_id').value;
        const niveau = document.getElementById('niveau').value;
        const week = document.getElementById('week').value;
        
        if (!filiereId || !niveau || !week) {
            alert('Veuillez sélectionner une filière, un niveau et une semaine');
            return;
        }
        
        // Show loading state
        generateBtn.disabled = true;
        generateBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Chargement...';
        
        // Fetch data using your controller methods
        fetch(`/timetables/get-ues?filiere_id=${filiereId}&niveau=${niveau}`)
            .then(response => response.json())
            .then(data => {
                displayUesWithRooms(data.ues, data.rooms);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Une erreur est survenue');
            })
            .finally(() => {
                generateBtn.disabled = false;
                generateBtn.textContent = 'Générer l\'aperçu';
            });
    });
    
    function displayUesWithRooms(ues, rooms) {
        ueList.innerHTML = '';
        
        if (ues.length === 0) {
            ueList.innerHTML = `
                <div class="col-12">
                    <div class="alert alert-warning">
                        Aucune UE trouvée pour cette filière et niveau
                    </div>
                </div>
            `;
            submitBtn.disabled = true;
            return;
        }
        
        ues.forEach(ue => {
            const ueCard = document.createElement('div');
            ueCard.className = 'col-md-6 mb-3';
            ueCard.innerHTML = `
                <div class="card h-100">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">${ue.nom} (${ue.code})</h6>
                        <small class="text-muted">${ue.credit} crédits</small>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Salle:</label>
                            <select name="slots[${ue.id}][room_id]" class="form-select" required>
                                <option value="" selected disabled>Choisir une salle</option>
                                ${rooms.map(room => 
                                    `<option value="${room.id}">${room.nom} (${room.capacité} places)</option>`
                                ).join('')}
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Jour:</label>
                                <select name="slots[${ue.id}][day]" class="form-select" required>
                                    <option value="1">Lundi</option>
                                    <option value="2">Mardi</option>
                                    <option value="3">Mercredi</option>
                                    <option value="4">Jeudi</option>
                                    <option value="5">Vendredi</option>
                                    <option value="6">Samedi</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Heure début:</label>
                                <input type="time" name="slots[${ue.id}][start_time]" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Heure fin:</label>
                                <input type="time" name="slots[${ue.id}][end_time]" class="form-control" required>
                            </div>
                        </div>
                        <input type="hidden" name="slots[${ue.id}][ue_id]" value="${ue.id}">
                    </div>
                </div>
            `;
            ueList.appendChild(ueCard);
        });
        
        ueSection.style.display = 'block';
        submitBtn.disabled = false;
    }
});
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Sélectionnez une option",
        allowClear: true
    });
});
$(document).ready(function() {
    $('#responsable_id').change(function() {
        if ($(this).val()) {
            $('#type_enseignement_container').show();
            $('#type_enseignement').prop('disabled', false);
        } else {
            $('#type_enseignement_container').hide();
            $('#type_enseignement').prop('disabled', true);
            $('#type_enseignement').val('').trigger('change');
        }
    });
});
////////////////////////////////////////// coordinateur emploi de temps 
$(document).ready(function() {
    // Load timetable when filters are submitted
    $('#filterForm').submit(function(e) {
        e.preventDefault();
        loadTimetable();
    });
    
    // Load form data when type or semester changes
    $('#createTimetableModal #type_seance, #createTimetableModal #semestre').change(function() {
        const typeSeance = $('#createTimetableModal #type_seance').val();
        const semestre = $('#createTimetableModal #semestre').val();
        
        if (typeSeance && semestre) {
            loadCreateFormData(typeSeance, semestre);
        }
    });
    
    // Show/hide group field based on session type
    $('#createTimetableModal #type_seance').change(function() {
        const typeSeance = $(this).val();
        if (typeSeance === 'td' || typeSeance === 'tp') {
            $('#groupeField').show();
            $('#groupe').prop('required', true);
            
            // Load groups based on selected UE
            if ($('#ue_id').val()) {
                loadGroups($('#ue_id').val(), typeSeance);
            }
        } else {
            $('#groupeField').hide();
            $('#groupe').prop('required', false);
        }
    });
    
    // Load groups when UE changes
    $('#ue_id').change(function() {
        const ueId = $(this).val();
        const typeSeance = $('#type_seance').val();
        
        if (ueId && typeSeance && (typeSeance === 'td' || typeSeance === 'tp')) {
            loadGroups(ueId, typeSeance);
        }
    });
    
    // Handle timetable form submission
    $('#createTimetableForm').submit(function(e) {
        e.preventDefault();
        saveTimetable();
    });
    
    // Force save when conflicts exist
    $('#forceSaveBtn').click(function() {
        saveTimetable(true);
    });
    
    // Initialize current academic year
    const currentYear = new Date().getFullYear();
    const nextYear = currentYear + 1;
    $('#annee_universitaire').val(`${currentYear}-${nextYear}`);
});

function loadTimetable() {
    const formData = $('#filterForm').serialize();
    
    $.ajax({
        url: '{{ route("emploi-du-temps.getTimetableData") }}',
        type: 'GET',
        data: formData,
        success: function(response) {
            renderTimetable(response);
        },
        error: function(xhr) {
            toastr.error('Erreur lors du chargement de l\'emploi du temps');
        }
    });
}

function renderTimetable(data) {
    const days = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];
    const timeSlots = generateTimeSlots();
    
    let html = '<table class="timetable table-bordered">';
    html += '<thead><tr><th class="time-col">Heure</th>';
    
    // Add day headers
    days.forEach(day => {
        html += `<th>${day.charAt(0).toUpperCase() + day.slice(1)}</th>`;
    });
    
    html += '</tr></thead><tbody>';
    
    // Add time slots
    timeSlots.forEach(timeSlot => {
        html += `<tr><td class="time-col">${timeSlot}</td>`;
        
        days.forEach(day => {
            const sessions = data[day] ? data[day].filter(session => {
                return session.heure_debut <= timeSlot && session.heure_fin > timeSlot;
            }) : [];
            
            html += `<td class="timetable-cell">`;
            
            if (sessions.length > 0) {
                const session = sessions[0]; // Only show the first session if there are overlaps
                const sessionTypeClass = `session-${session.type_seance}`;
                const groupInfo = session.groupe ? `Groupe ${session.groupe}` : '';
                
                html += `<div class="session-card ${sessionTypeClass}" data-id="${session.id}" data-bs-toggle="modal" data-bs-target="#viewTimetableModal">
                    <strong>${session.ue.nom}</strong><br>
                    ${session.enseignant.nom}<br>
                    ${session.salle.nom}<br>
                    ${groupInfo}
                </div>`;
            }
            
            html += `</td>`;
        });
        
        html += '</tr>';
    });
    
    html += '</tbody></table>';
    
    $('#timetableContainer').html(html);
    
    // Add click event for session cards
    $('.session-card').click(function() {
        const sessionId = $(this).data('id');
        loadSessionDetails(sessionId);
    });
}

function generateTimeSlots() {
    const slots = [];
    for (let hour = 8; hour <= 18; hour++) {
        slots.push(`${hour.toString().padStart(2, '0')}:00`);
        if (hour < 18) {
            slots.push(`${hour.toString().padStart(2, '0')}:30`);
        }
    }
    return slots;
}

function loadCreateFormData(typeSeance, semestre) {
    $.ajax({
        url: '{{ route("emploi-du-temps.getCreateFormData") }}',
        type: 'GET',
        data: {
            type_seance: typeSeance,
            semestre: semestre
        },
        success: function(response) {
            // Populate UE dropdown
            let ueOptions = '<option value="">Sélectionner une UE</option>';
            response.ues.forEach(ue => {
                ueOptions += `<option value="${ue.id}">${ue.code} - ${ue.nom}</option>`;
            });
            $('#ue_id').html(ueOptions).prop('disabled', false);
            
            // Populate teacher dropdown
            let teacherOptions = '<option value="">Sélectionner un enseignant</option>';
            response.enseignants.forEach(teacher => {
                teacherOptions += `<option value="${teacher.id}">${teacher.nom}</option>`;
            });
            $('#enseignant_id').html(teacherOptions).prop('disabled', false);
            
            // Populate room dropdown
            let roomOptions = '<option value="">Sélectionner une salle</option>';
            response.salles.forEach(room => {
                roomOptions += `<option value="${room.id}">${room.nom} (Capacité: ${room.capacite})</option>`;
            });
            $('#salle_id').html(roomOptions).prop('disabled', false);
        },
        error: function(xhr) {
            toastr.error('Erreur lors du chargement des données du formulaire');
        }
    });
}

function loadGroups(ueId, typeSeance) {
    $.ajax({
        url: '/ues/' + ueId,
        type: 'GET',
        success: function(ue) {
            const groupField = $('#groupe');
            groupField.empty().append('<option value="">Sélectionner un groupe</option>');
            
            let groupCount = 0;
            if (typeSeance === 'td') {
                groupCount = ue.groupes_td;
            } else if (typeSeance === 'tp') {
                groupCount = ue.groupes_tp;
            }
            
            for (let i = 1; i <= groupCount; i++) {
                groupField.append(`<option value="${i}">Groupe ${i}</option>`);
            }
        },
        error: function(xhr) {
            toastr.error('Erreur lors du chargement des groupes');
        }
    });
}

function saveTimetable(force = false) {
    const formData = $('#createTimetableForm').serialize() + (force ? '&force=true' : '');
    
    $.ajax({
        url: '{{ route("emploi-du-temps.store") }}',
        type: 'POST',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                toastr.success('Séance enregistrée avec succès');
                $('#createTimetableModal').modal('hide');
                loadTimetable();
            }
        },
        error: function(xhr) {
            if (xhr.status === 422 && xhr.responseJSON.conflicts) {
                showConflicts(xhr.responseJSON.conflicts);
            } else {
                toastr.error('Erreur lors de l\'enregistrement de la séance');
            }
        }
    });
}

function showConflicts(conflicts) {
    let html = '<h6>Les conflits suivants ont été détectés :</h6>';
    
    conflicts.forEach(conflict => {
        if (conflict.type === 'salle') {
            html += '<div class="conflict-item room-conflict">';
            html += '<h6><i class="bi bi-building me-2"></i>Conflit de salle</h6>';
            conflict.data.forEach(item => {
                html += `<p>${item.ue.nom} avec ${item.enseignant.nom} (${item.heure_debut} - ${item.heure_fin})</p>`;
            });
            html += '</div>';
        } else if (conflict.type === 'enseignant') {
            html += '<div class="conflict-item teacher-conflict">';
            html += '<h6><i class="bi bi-person me-2"></i>Conflit d\'enseignant</h6>';
            conflict.data.forEach(item => {
                html += `<p>${item.ue.nom} en ${item.salle.nom} (${item.heure_debut} - ${item.heure_fin})</p>`;
            });
            html += '</div>';
        } else if (conflict.type === 'contrainte_enseignant') {
            html += '<div class="conflict-item constraint-conflict">';
            html += '<h6><i class="bi bi-exclamation-triangle me-2"></i>Contrainte d\'enseignant</h6>';
            conflict.data.forEach(item => {
                html += `<p>${item.raison} (${item.heure_debut} - ${item.heure_fin})</p>`;
            });
            html += '</div>';
        } else if (conflict.type === 'contrainte_salle') {
            html += '<div class="conflict-item constraint-conflict">';
            html += '<h6><i class="bi bi-exclamation-triangle me-2"></i>Contrainte de salle</h6>';
            conflict.data.forEach(item => {
                html += `<p>${item.raison} (${item.heure_debut} - ${item.heure_fin})</p>`;
            });
            html += '</div>';
        }
    });
    
    $('#conflictDetails').html(html);
    $('#conflictModal').modal('show');
}

function loadSessionDetails(sessionId) {
    $.ajax({
        url: '/emploi-du-temps/' + sessionId,
        type: 'GET',
        success: function(response) {
            let html = `
                <div class="mb-3">
                    <h5>${response.ue.nom} (${response.ue.code})</h5>
                    <p class="mb-1"><strong>Type:</strong> ${response.type_seance.toUpperCase()}</p>
                    ${response.groupe ? `<p class="mb-1"><strong>Groupe:</strong> ${response.groupe}</p>` : ''}
                    <p class="mb-1"><strong>Enseignant:</strong> ${response.enseignant.nom}</p>
                    <p class="mb-1"><strong>Salle:</strong> ${response.salle.nom}</p>
                    <p class="mb-1"><strong>Jour:</strong> ${response.jour.charAt(0).toUpperCase() + response.jour.slice(1)}</p>
                    <p class="mb-1"><strong>Heure:</strong> ${response.heure_debut} - ${response.heure_fin}</p>
                    <p class="mb-1"><strong>Semestre:</strong> ${response.semestre}</p>
                    <p class="mb-1"><strong>Année Universitaire:</strong> ${response.annee_universitaire}</p>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-danger btn-sm me-2" onclick="deleteSession(${response.id})">
                        <i class="bi bi-trash me-1"></i> Supprimer
                    </button>
                </div>
            `;
            
            $('#timetableDetails').html(html);
        },
        error: function(xhr) {
            toastr.error('Erreur lors du chargement des détails de la séance');
        }
    });
}

function deleteSession(sessionId) {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette séance ?')) {
        $.ajax({
            url: '/emploi-du-temps/' + sessionId,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    toastr.success('Séance supprimée avec succès');
                    $('#viewTimetableModal').modal('hide');
                    loadTimetable();
                }
            },
            error: function(xhr) {
                toastr.error('Erreur lors de la suppression de la séance');
            }
        });
    }
}


///////////// prof ues 

document.addEventListener('DOMContentLoaded', function() {
    const wishModal = new bootstrap.Modal(document.getElementById('wishModal'));
    const confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
    const wishForm = document.getElementById('wishForm');

    // Set up wish modal data
    document.querySelectorAll('.wish-btn').forEach(button => {
        button.addEventListener('click', function() {
            // Reset form but preserve hidden input
            wishForm.reset();
            wishForm.classList.remove('was-validated');

            // Set hidden input and readonly field after reset
            document.getElementById('modal_ue_id').value = this.dataset.ueId;
            document.getElementById('modal_ue_name').value = this.dataset.ueName;
        });
    });

    // Handle form submission with AJAX
    wishForm.addEventListener('submit', function(e) {
        e.preventDefault();

        if (!this.checkValidity()) {
            this.classList.add('was-validated');
            return;
        }

        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Envoi en cours...';

        const formData = new FormData(this);

        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Hide wish modal
            wishModal.hide();

            // Show confirmation modal
            document.getElementById('confirmed_ue_name').textContent = data.ue_name || document.getElementById('modal_ue_name').value;
            document.getElementById('confirmed_wish_type').textContent = data.wish_type || document.getElementById('wish_type').options[document.getElementById('wish_type').selectedIndex].text;
            confirmationModal.show();

            // Refresh the page after closing confirmation modal to update sidebar
            document.getElementById('confirmationModal').addEventListener('hidden.bs.modal', function() {
                window.location.reload();
            }, { once: true });
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Une erreur s\'est produite lors de l\'envoi de la demande. Veuillez réessayer.');
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="bi bi-send-check me-1"></i> Envoyer';
        });
    });
});


document.addEventListener('DOMContentLoaded', function() {
    const deleteModal = new bootstrap.Modal('#deleteConfirmationModal');
    let wishIdToDelete = null;
    
    // Gestion des clics sur le bouton de suppression
    document.querySelectorAll('.delete-wish').forEach(button => {
        button.addEventListener('click', function() {
            wishIdToDelete = this.dataset.wishId;
            deleteModal.show();
        });
    });
    
    // Confirmation de suppression
    document.getElementById('confirmDelete').addEventListener('click', async function() {
        if (!wishIdToDelete) return;
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        
        try {
            const response = await fetch(`/wishes/${wishIdToDelete}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.error || 'Erreur lors de la suppression');
            }

            deleteModal.hide();
            
            // Afficher un message de succès
            const toast = new bootstrap.Toast(document.getElementById('deleteToast'));
            document.getElementById('toastMessage').textContent = 'Demande supprimée avec succès';
            toast.show();
            
            // Recharger après un délai
            setTimeout(() => window.location.reload(), 1500);
            
        } catch (error) {
            console.error('Error:', error);
            alert(error.message || 'Une erreur est survenue lors de la suppression');
        }
    });
});
document.getElementById('confirmDelete').addEventListener('click', async function() {
    if (!wishIdToDelete) {
        console.error('Aucun ID de demande sélectionné');
        alert('Aucune demande sélectionnée');
        return;
    }

    console.log('Tentative de suppression - ID:', wishIdToDelete);
    
    try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        console.log('CSRF Token:', csrfToken ? 'Present' : 'Missing');
        
        const startTime = performance.now();
        const response = await fetch(`/wishes/${wishIdToDelete}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        });
        const duration = performance.now() - startTime;
        
        console.log(`Réponse reçue en ${duration.toFixed(2)}ms`, response);
        
        let data;
        try {
            data = await response.json();
            console.log('Données de réponse:', data);
        } catch (e) {
            console.error('Erreur parsing JSON:', e);
            throw new Error('Réponse serveur invalide');
        }

        if (!response.ok) {
            console.error('Erreur serveur:', {
                status: response.status,
                statusText: response.statusText,
                data: data
            });
            throw new Error(data.error || `Erreur serveur (${response.status})`);
        }

        deleteModal.hide();
        showSuccessToast('Demande supprimée avec succès');
        setTimeout(() => window.location.reload(), 1500);
        
    } catch (error) {
        console.error('Erreur complète:', {
            name: error.name,
            message: error.message,
            stack: error.stack
        });
        
        showErrorToast(`Échec de la suppression: ${error.message}`);
    }
});

function showSuccessToast(message) {
    const toastEl = document.getElementById('deleteToast');
    toastEl.querySelector('.toast-header').className = 'toast-header bg-success text-white';
    document.getElementById('toastMessage').textContent = message;
    bootstrap.Toast.getOrCreateInstance(toastEl).show();
}

function showErrorToast(message) {
    const toastEl = document.getElementById('deleteToast');
    toastEl.querySelector('.toast-header').className = 'toast-header bg-danger text-white';
    document.getElementById('toastMessage').textContent = message;
    bootstrap.Toast.getOrCreateInstance(toastEl).show();
}
////////
// Dans resources/js/charge-horaire.js
document.addEventListener('DOMContentLoaded', function() {
    // Calcul automatique de la semaine à partir de la date
    const dateInput = document.getElementById('date_seance');
    const semaineInput = document.getElementById('semaine');
    
    if (dateInput && semaineInput) {
        dateInput.addEventListener('change', function() {
            const date = new Date(this.value);
            if (!isNaN(date.getTime())) {
                // Calcul simple de la semaine (pourrait être amélioré)
                const startOfYear = new Date(date.getFullYear(), 0, 1);
                const diff = date - startOfYear;
                const week = Math.ceil(diff / (1000 * 60 * 60 * 24 * 7));
                semaineInput.value = week > 52 ? 52 : week;
            }
        });
    }
    
    // Notification pour charge minimale
    const alerteCharge = document.querySelector('.alert-warning');
    if (alerteCharge) {
        // Optionnel: Ajouter une notification toast
        const toast = new bootstrap.Toast(document.getElementById('chargeToast'));
        toast.show();
    }
});
//////////////// affectation 



document.addEventListener('DOMContentLoaded', function() {
    const filterForm = document.getElementById('filterForm');
    const affectationForm = document.getElementById('affectationForm');
    const affectationModal = new bootstrap.Modal(document.getElementById('affectationModal'));

    // Check if required elements exist
    if (!filterForm || !affectationForm || !affectationModal) {
        console.error('Required elements missing:', {
            filterForm: !!filterForm,
            affectationForm: !!affectationForm,
            affectationModal: !!affectationModal
        });
        return;
    }

    // Load initial hours summary
    loadHoursSummary();

    // Handle filter form submission
    filterForm.addEventListener('submit', function(e) {
        e.preventDefault();
        loadUes();
        loadHoursSummary();
    });

    // Set up affect modal data
    document.querySelectorAll('.affect-btn').forEach(button => {
        button.addEventListener('click', function() {
            const ueId = this.dataset.ueId;
            const ueName = this.dataset.ueName || 'N/A';
            const coursHours = parseFloat(this.dataset.coursHours) || 0;
            const tdHours = parseFloat(this.dataset.tdHours) || 0;
            const tpHours = parseFloat(this.dataset.tpHours) || 0;

            console.log('Affect button clicked:', { ueId, ueName, coursHours, tdHours, tpHours });

            // Reset form but preserve hidden inputs
            affectationForm.reset();
            affectationForm.classList.remove('was-validated');

            // Set hidden input and readonly field after reset
            const modalUeId = document.getElementById('modal_ue_id');
            const modalUeName = document.getElementById('modal_ue_name');
            const coursInput = document.getElementById('cours_hours');
            const tdInput = document.getElementById('td_hours');
            const tpInput = document.getElementById('tp_hours');

            if (!modalUeId || !modalUeName || !coursInput || !tdInput || !tpInput) {
                console.error('Modal inputs missing:', {
                    modalUeId: !!modalUeId,
                    modalUeName: !!modalUeName,
                    coursInput: !!coursInput,
                    tdInput: !!tdInput,
                    tpInput: !!tpInput
                });
                return;
            }

            modalUeId.value = ueId || '';
            modalUeName.value = ueName;
            coursInput.max = coursHours;
            coursInput.value = coursHours;
            tdInput.max = tdHours;
            tdInput.value = tdHours;
            tpInput.max = tpHours;
            tpInput.value = tpHours;
        });
    });

    // Handle affectation form submission with AJAX
    affectationForm.addEventListener('submit', function(e) {
        e.preventDefault();

        if (!this.checkValidity()) {
            this.classList.add('was-validated');
            return;
        }

        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Enregistrement en cours...';

        const formData = new FormData(this);
        console.log('Submitting form with data:', Object.fromEntries(formData));

        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(errorData => {
                    throw new Error(JSON.stringify(errorData));
                });
            }
            return response.json();
        })
        .then(data => {
            affectationModal.hide();
            updateUeRow(data.ue_id, data.responsable, data.cours_hours, data.td_hours, data.tp_hours);
            loadHoursSummary();
            alert('Affectation enregistrée avec succès !');
        })
        .catch(error => {
            console.error('Submission error:', error);
            let errorMessage = 'Une erreur s\'est produite lors de l\'enregistrement.';
            try {
                const errorData = JSON.parse(error.message);
                if (errorData.errors) {
                    errorMessage = Object.values(errorData.errors).flat().join('\n');
                } else if (errorData.error) {
                    errorMessage = errorData.error;
                }
            } catch (e) {
                // Use default error message
            }
            alert(errorMessage);
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="bi bi-check-circle me-1"></i> Enregistrer';
        });
    });

    function loadUes() {
        const formData = new FormData(filterForm);
        fetch("{{ route('affectations.index') }}?" + new URLSearchParams(formData), {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log('Loaded UEs:', data.ues);
            const tbody = document.querySelector('#ueTable tbody');
            tbody.innerHTML = '';
            data.ues.forEach(ue => {
                const row = document.createElement('tr');
                row.dataset.ueId = ue.id;
                row.innerHTML = `
                    <td>${ue.code || 'N/A'}</td>
                    <td>${ue.nom || 'N/A'}</td>
                    <td>S${ue.semestre || 'N/A'}</td>
                    <td>
                        ${ue.responsable ? 
                            `${ue.responsable.firstName} ${ue.responsable.lastName}` : 
                            '<span class="text-muted">Non affecté</span>'}
                    </td>
                    <td>${ue.heures_cm ? ue.heures_cm + 'h' : '0h'}</td>
                    <td>${ue.heures_td ? ue.heures_td + 'h' : '0h'}</td>
                    <td>${ue.heures_tp ? ue.heures_tp + 'h' : '0h'}</td>
                    <td>
                        <button class="btn btn-sm btn-primary affect-btn"
                                data-bs-toggle="modal"
                                data-bs-target="#affectationModal"
                                data-ue-id="${ue.id}"
                                data-ue-name="${ue.nom || 'N/A'}"
                                data-cours-hours="${ue.heures_cm || 0}"
                                data-td-hours="${ue.heures_td || 0}"
                                data-tp-hours="${ue.heures_tp || 0}">
                            <i class="bi bi-person-plus me-1"></i> Affecter
                        </button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Error loading UEs:', error);
            alert('Erreur lors du chargement des UE.');
        });
    }

    function loadHoursSummary() {
        const formData = new FormData(filterForm);
        fetch("{{ route('affectations.hours_summary') }}?" + new URLSearchParams(formData), {
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log('Hours summary:', data);
            document.getElementById('coursHours').textContent = `${data.cours_hours || 0}h`;
            document.getElementById('tdHours').textContent = `${data.td_hours || 0}h`;
            document.getElementById('tpHours').textContent = `${data.tp_hours || 0}h`;
        })
        .catch(error => {
            console.error('Error loading hours summary:', error);
            document.getElementById('coursHours').textContent = '0h';
            document.getElementById('tdHours').textContent = '0h';
            document.getElementById('tpHours').textContent = '0h';
        });
    }

    function updateUeRow(ueId, responsable, coursHours, tdHours, tpHours) {
        const row = document.querySelector(`tr[data-ue-id="${ueId}"]`);
        if (row) {
            const cells = row.querySelectorAll('td');
            cells[3].innerHTML = responsable ? 
                `${responsable.firstName} ${responsable.lastName}` : 
                '<span class="text-muted">Non affecté</span>';
            cells[4].textContent = `${coursHours || 0}h`;
            cells[5].textContent = `${tdHours || 0}h`;
            cells[6].textContent = `${tpHours || 0}h`;
        }
    }
});
///////////////////module prof 
////////////////////prof note
document.addEventListener('DOMContentLoaded', function() {
    const uploadModal = document.getElementById('uploadModal');
    uploadModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const ueId = button.getAttribute('data-ue-id');
        const ueName = button.getAttribute('data-ue-name');
        
        document.getElementById('modalUeId').value = ueId;
        document.getElementById('modalUeName').textContent = ueName;
        
        // Use the named route properly
        document.getElementById('uploadForm').action = `/notes/${ueId}/upload`;
    });
});
