<?php

namespace App\Http\Controllers;

use App\Models\Ues;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Http\Controllers\Auth ;

class VacataireNoteController extends Controller
{
     public function index()
    {
        $user = auth()->user();
        $ues = $user->ues()
               ->with(['notes' => function($query) {
                   $query->where('academic_year', $this->currentAcademicYear());
               }])
               ->get();

        $normalSessionUEs = $ues->filter(fn($ue) => !$ue->notes()->where('session_type', 'normal')->exists());
        $retakeSessionUEs = $ues->filter(fn($ue) => !$ue->notes()->where('session_type', 'rattrapage')->exists());

        return view('vacataire.notes', compact('normalSessionUEs', 'retakeSessionUEs', 'ues'));
    }

    public function upload(Request $request, Ues $ue)
    {
        if (!auth()->user()->ues->contains($ue)) {
            abort(403);
        }

        $request->validate([
            'session_type' => 'required|in:normal,rattrapage',
            'file' => 'required|file|mimes:xlsx,xls,csv|max:2048'
        ]);

        $filename = "{$ue->code}_{$request->session_type}_".$this->currentAcademicYear().'.'.$request->file->extension();
        $path = $request->file->storeAs('notes/'.$this->currentAcademicYear(), $filename);

        Note::updateOrCreate(
            [
                'ue_id' => $ue->id,
                'session_type' => $request->session_type,
                'academic_year' => $this->currentAcademicYear()
            ],
            [
                'file_path' => $path,
                'professor_id' => auth()->id(),
                'status' => 'pending',
                'uploaded_at' => now()
            ]
        );

        return back()->with('success', 'Notes uploadées avec succès!');
    }

    public function view(Ues $ue, $session_type)
    {
        if (!auth()->user()->ues->contains($ue)) {
            abort(403);
        }

        $notes = $ue->notes()
                   ->where('session_type', $session_type)
                   ->where('academic_year', $this->currentAcademicYear())
                   ->with('etudiant')
                   ->get();

        return view('vacataire.notes-view', [
            'ue' => $ue,
            'session_type' => $session_type,
            'notes' => $notes,
            'stats' => $this->calculateStats($notes)
        ]);
    }

    protected function calculateStats($notes)
    {
        return [
            'average' => $notes->avg('valeur'),
            'max' => $notes->max('valeur'),
            'min' => $notes->min('valeur'),
            'count' => $notes->count()
        ];
    }

    protected function currentAcademicYear(): string
    {
        $now = Carbon::now();
        return $now->month >= 9
            ? $now->year . '-' . ($now->year + 1)
            : ($now->year - 1) . '-' . $now->year;
    }
}
