<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ImportHistory;
use App\Imports\VacatairesImport;
use App\Imports\UnitesImport;
use App\Imports\AffectationsImport;
use App\Imports\EmploisImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function process(Request $request)
    {
        $request->validate([
            'type' => 'required|in:unites,vacataires,affectations,emplois',
            'file' => 'required|file|mimes:xlsx,csv'
        ]);

        try {
            $file = $request->file('file');
            $importType = $request->type;
            $overwrite = $request->boolean('overwrite', false);

            // Record import start
            $importHistory = ImportHistory::create([
                'user_id' => auth()->id(),
                'type' => $importType,
                'file_name' => $file->getClientOriginalName(),
                'status' => 'processing',
                'total_count' => 0,
                'success_count' => 0
            ]);

            // Dispatch import based on type
            switch ($importType) {
                case 'vacataires':
                    $import = new VacatairesImport($importHistory, $overwrite);
                    break;
                case 'unites':
                    $import = new UnitesImport($importHistory, $overwrite);
                    break;
                case 'affectations':
                    $import = new AffectationsImport($importHistory, $overwrite);
                    break;
                case 'emplois':
                    $import = new EmploisImport($importHistory, $overwrite);
                    break;
            }

            Excel::import($import, $file);

            return back()->with('success', 'Importation terminée avec succès!');

        } catch (\Exception $e) {
            $importHistory->update([
                'status' => 'failed',
                'error_message' => $e->getMessage()
            ]);
            
            return back()->with('error', 'Erreur lors de l\'importation: '.$e->getMessage());
        }
    }
}