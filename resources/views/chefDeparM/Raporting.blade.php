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
                                foreach($dataarchive as $archive)
                                <tr>
                                    <td>{{$archive->Nomfile}}</td>
                                    <td>{{$archive->type}}</td>
                                    <td>{{$archive->tail}} MB</td>
                                    <td>{{$archive->created_at}}</td>
                                    <td>
                                        <button class="download-btn dwl">
                                            <i class="fas fa-download dow"></i>
                                        </button>
                                        <button class="download-btn del">
                                            <i class="fa-solid fa-trash del"></i>
                                        </button>

                                    </td>
                                </tr>
                                @endforeach
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
                    <form action="{{ route('uploderfile') }}" method="POST" enctype="multipart/form-data" id="fileForm">
                        @csrf

                        <div class="form-group">
                            <label for="fileName">Nom du fichier</label>
                            <input name="objectif" type="text" id="fileName" placeholder="Objectif ..." required>
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
                            <input name="file" type="file" id="fileUpload" required>
                        </div>
                        <button type="submit" class="submit-btn">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/visual.js') }}"></script>
</section>
@endsection



