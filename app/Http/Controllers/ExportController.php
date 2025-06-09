<?php

namespace App\Http\Controllers;

use App\Models\utilisateurs;
use App\Exports\VacatairesExport;
use App\Models\ues;
use App\Exports\UnitesExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Services\ImportExportLogger;

class ExportController extends Controller
{
   
    public function unitesExcel(Request $request)
    {
        $filters = [
            'date_from' => $request->input('date_from'),
            'date_to' => $request->input('date_to')
        ];

        return Excel::download(new UnitesExport($filters), 'unites_enseignement.xlsx');
    }

    /**
     * Export Unités d'Enseignement to CSV format
     */
    public function unitesCSV(Request $request)
    {
         $user = Auth::guard('Cordinateur')->user(); 
        $filiere = $user->currentCoordinatedFiliere();
       
        $query = Ues::where('filiere_id', $filiere->id);

        // Apply filters if present
        if ($request->has('date_from') && $request->has('date_to')) {
            $query->whereBetween('created_at', [$request->date_from, $request->date_to]);
        }

        $ues = $query->orderBy('nom')->get();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=unites_enseignement_" . date('Y-m-d') . ".csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function() use ($ues) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for UTF-8
            fwrite($file, "\xEF\xBB\xBF");
            
            // Add headers
            fputcsv($file, [
                'ID',
                'Nom',
                'Code',
                'Heures CM',
                'Heures TD',
                'Heures TP',
                'Semestre',
                'Année Universitaire',
                'Groupes TD',
                'Groupes TP',
                'Est Vacant',
                'Date de création'
            ]);
            
            
            // Add data
            foreach ($ues as $ue) {
                fputcsv($file, [
                    'UE-' . $ue->id,
                    $ue->nom,
                    $ue->code,
                    $ue->heures_cm,
                    $ue->heures_td,
                    $ue->heures_tp,
                    $ue->semestre,
                    $ue->annee_universitaire,
                    $ue->groupes_td,
                    $ue->groupes_tp,
                    $ue->est_vacant ? 'Oui' : 'Non',
                    $ue->created_at->format('d/m/Y')
                ]);
            }
            
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    /**
     * Export Unités d'Enseignement to PDF format
     */
    public function unitesPDF(Request $request)
    {
      
        $user = Auth::guard('Cordinateur')->user(); 
        $filiere = $user->currentCoordinatedFiliere();
        $query = ues::where('filiere_id', $filiere->id);

        // Apply filters if present
        if ($request->has('date_from') && $request->has('date_to')) {
            $query->whereBetween('created_at', [$request->date_from, $request->date_to]);
        }

        $ues = $query->orderBy('nom')->get();
        
        $pdf = PDF::loadView('exports.unites', [
            'ues' => $ues,
            'filters' => $request->all()
        ]);
        
        return $pdf->setPaper('a4', 'landscape')
                  ->download('unites_enseignement_' . date('Y-m-d') . '.pdf');
    }

    /**
     * Process export form submissions
     */
    public function processExport(Request $request)
    {
        $request->validate([
            'type' => 'required|in:unites,vacataires,affectations,emplois',
            'format' => 'required|in:xlsx,csv,pdf'
        ]);

        $type = $request->type;
        $format = $request->format;

        // Dispatch appropriate export based on type and format
        switch ($type) {
            case 'vacataires':
                return $this->handleVacatairesExport($format, $request);
            
            case 'unites':
                return $this->handleUnitesExport($format, $request);
            
            // Add cases for other types as needed
            default:
                return back()->with('error', 'Type d\'export non supporté');
        }
    }

    /**
     * Handle Unités d'Enseignement exports
     */
    protected function handleUnitesExport($format, $request)
    {
        switch ($format) {
            case 'csv':
                return $this->unitesCSV($request);
            case 'pdf':
                return $this->unitesPDF($request);
            default:
                return back()->with('error', 'Format d\'export non supporté');
        }
    }














    /**
     * Export vacataires to CSV format
     */
    public function vacatairesCSV(Request $request)
    {
        $query = Utilisateurs::where('role', 'vacataire');

        // Apply filters if present
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('specialite')) {
            $query->where('specialite', $request->specialite);
        }

        if ($request->has('date_from') && $request->has('date_to')) {
            $query->whereBetween('created_at', [$request->date_from, $request->date_to]);
        }

        $vacataires = $query->get();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=vacataires_" . date('Y-m-d') . ".csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function() use ($vacataires) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for UTF-8
            fwrite($file, "\xEF\xBB\xBF");
            
            // Add headers
            fputcsv($file, [
                'ID', 
                'Nom', 
                'Prénom', 
                'Email', 
                'Téléphone', 
                'Spécialité', 
                'Statut',
                'Date de création'
            ]);
            
            // Add data
            foreach ($vacataires as $vacataire) {
                fputcsv($file, [
                    'VAC-' . $vacataire->id,
                    $vacataire->lastName,
                    $vacataire->firstName,
                    $vacataire->email,
                    $vacataire->Numerotelephone,
                    $vacataire->specialite,
                    ucfirst($vacataire->status),
                    $vacataire->created_at->format('d/m/Y')
                ]);
            }
            
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }

    /**
     * Export vacataires to PDF format
     */
    public function vacatairesPDF(Request $request)
    {
        $query = utilisateurs::where('role', 'vacataire');

        // Apply filters if present
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('specialite')) {
            $query->where('specialite', $request->specialite);
        }

        if ($request->has('date_from') && $request->has('date_to')) {
            $query->whereBetween('created_at', [$request->date_from, $request->date_to]);
        }

        $vacataires = $query->get();
        
        $pdf = PDF::loadView('exports.vacataires', [
            'vacataires' => $vacataires,
            'filters' => $request->all()
        ]);
        
        return $pdf->setPaper('a4', 'landscape')
                  ->download('vacataires_' . date('Y-m-d') . '.pdf');
    }


   

    /**
     * Handle vacataires-specific exports
     */
    protected function handleVacatairesExport($format, $request)
    {
        switch ($format) {
            case 'csv':
                return $this->vacatairesCSV($request);
            case 'pdf':
                return $this->vacatairesPDF($request);
            default:
                return back()->with('error', 'Format d\'export non supporté');
        }
    }

    /**
     * Custom export with selected columns
     */
    public function customExport(Request $request)
    {
        $request->validate([
            'type' => 'required|in:unites,vacataires,affectations,emplois',
            'format' => 'required|in:csv,pdf',
            'columns' => 'required|array'
        ]);

        // Implement your custom export logic here
        // This would typically use the same methods as above
        // but only include the selected columns
        
        return response()->json(['success' => true]);
    }





    // historique 
    


    public function export(Request $request)
    {
        $request->validate([
            'model_type' => 'required|in:model1,model2,model3,model4',
            // Add other filters as needed
        ]);
        
        // Map model types to their export classes
        $exportClasses = [
            'Unites expo' => UnitesExport::class,
            'Vacataires expo' => VacatairesExport::class,
           // 'model3' => Model3Export::class,
           // 'model4' => Model4Export::class,
        ];
        
        // Map model types to their actual model classes
        $modelClasses = [
            'vacataires' => \App\Models\utilisateurs::class,
            'ues' => \App\Models\Ues::class,
        ];
        
        $modelType = $request->input('model_type');
        $exportClass = $exportClasses[$modelType];
        $modelClass = $modelClasses[$modelType];
        
        // Create the export instance with request filters
        $export = new $exportClass($request->all());
        
        $fileName = 'export-' . $modelType . '-' . now()->format('Y-m-d-H-i-s') . '.xlsx';
        $filePath = 'exports/' . $fileName;
        
        // Store the file
        Excel::store($export, $filePath, 'public');
        
        // Log the export
        ImportExportLogger::log(
            'export',
            $fileName,
            $filePath,
            $modelClass,
            $export->getRowCount(),
            [
                'filters' => $request->except(['_token', 'model_type'])
            ]
        );
        
        return back()->with('success', ucfirst($modelType) . ' export completed successfully');
    }
}