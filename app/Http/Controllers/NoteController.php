<?php
namespace App\Http\Controllers;

use App\Models\ues;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class NoteController extends Controller
{
    public function index()
    {
        $ues = ues::where('responsable_id', auth()->id())
               ->orWhereHas('affectations', function($q) {
                   $q->where('prof_id', auth()->id());
               })
               ->with(['notes' => function($query) {
                   $query->where('academic_year', $this->currentAcademicYear());
               }])
               ->get();

        return view('prof.notes.index', compact('ues'));
    }

public function upload(Request $request, $ue)
{
    // First try to find the UE
    $ue = Ues::findOrFail($ue);

    $request->validate([
        'session_type' => 'required|in:normal,retake',
        'file' => 'required|file|mimes:xlsx,xls'
    ]);

    // Store with better filename
    $filename = "{$ue->code}_{$request->session_type}_".$this->currentAcademicYear().'.'.$request->file->extension();
    $path = $request->file->storeAs('notes', $filename);

    Note::create([
        'ue_id' => $ue->id,
        'session_type' => $request->session_type,
        'academic_year' => $this->currentAcademicYear(),
        'file_path' => $path,
        'professor_id' => auth()->id(),
        'status' => 'pending'
    ]);

    return back()->with('success', 'Fichier Excel uploadé avec succès');
}

    public function download(Note $note)
    {
        return Storage::download($note->file_path);
    }

    public function downloadTemplate()
    {
        return response()->download(
            storage_path('templates/prof_notes_template.xlsx'),
            'template_notes.xlsx'
        );
    }

    protected function currentAcademicYear(): string
    {
        $now = Carbon::now();
        return $now->month >= 9
            ? $now->year . '-' . ($now->year + 1)
            : ($now->year - 1) . '-' . $now->year;
    }

    // List all pending notes for the coordinateur's filière
    public function coordinateurPendingNotes()
    {
        $user = auth()->user();
        $filiere = $user->currentCoordinatedFiliere();
        $pendingNotes = Note::whereHas('ue', function($q) use ($filiere) {
                $q->where('filiere_id', $filiere->id);
            })
            ->where('status', 'pending')
            ->with('ue')
            ->get();
        return view('coordinateur.notes.pending', compact('pendingNotes'));
    }

    // Publish (approve) a note
    public function publish($noteId)
    {
        $note = Note::findOrFail($noteId);
        $note->status = 'published';
        $note->save();
        return back()->with('success', 'Note publiée avec succès.');
    }
}
