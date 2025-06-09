@extends('layouts.dash_depar')

@section('main')
<section class="sectionR py-4">
    <div class="container-fluid">
        <div class="content">
            <div class="cards-container">
                <!-- Stats Card -->
                <div class="stats-cardd">
                    <h2>Statistiques des Fichiers</h2>
                    <div class="chart-container">
                        <div class="grapheR" id="grapheR"></div>
                    </div>
                </div>
                <!-- Files Card -->
                <div class="files-card">
                    <div class="files-header">
                        <h2>Gestion des Fichiers</h2>
                        <button class="add-file-btn" id="openModalBtn">
                            <i class="fas fa-plus"></i> Ajouter Fichier
                        </button>
                    </div>
                    <div class="tablecontainer">
                        <table class="tblfile">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Type</th>
                                    <th>Taille</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Rapport_2023.pdf</td>
                                    <td>PDF</td>
                                    <td>2.4 MB</td>
                                    <td>15/01/2023</td>
                                    <td>
                                        <button class="download-btn">
                                            <i class="fas fa-download"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Add File Modal -->
            <div class="modal" id="addFileModal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Ajouter un Fichier</h2>
                        <button class="close-btn" id="closeModalBtn">&times;</button>
                    </div>
                    <form id="fileForm">
                        <div class="form-group">
                            <label for="fileName">Nom du fichier</label>
                            <input type="text" id="fileName" required>
                        </div>
                        <div class="form-group">
                            <label for="fileType">Type de fichier</label>
                            <select id="fileType" required>
                                <option value="">Sélectionner un type</option>
                                <option value="PDF">PDF</option>
                                <option value="Word">Word</option>
                                <option value="Excel">Excel</option>
                                <option value="PowerPoint">PowerPoint</option>
                                <option value="Image">Image</option>
                                <option value="Autre">Autre</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fileUpload">Sélectionner un fichier</label>
                            <input type="file" id="fileUpload" required>
                        </div>
                        <button type="submit" class="submit-btn">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection



