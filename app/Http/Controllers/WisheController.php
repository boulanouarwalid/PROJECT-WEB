<?php

namespace App\Http\Controllers;

use App\Models\wishe;
use App\Models\ues;
use App\Notifications\NewWishNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Log;

class WisheController extends Controller
{
    public function store(Request $request)
    {
        Log::info('Store method called', $request->all());

        $validated = $request->validate([
            'ue_id' => 'required|exists:ues,id',
            'wish_type' => 'required|in:Responsable,Intervenant,Supplementaire,Autre',
            'message' => 'nullable|string|max:500'
        ]);

        Log::info('Validation passed', $validated);

        $ue = ues::findOrFail($validated['ue_id']);

        $wish = auth()->user()->wishes()->create([
            'ue_id' => $validated['ue_id'],
            'type' => $validated['wish_type'],
            'message' => $validated['message'] ?? null,
            'status' => 'en attent'
        ]);

        Log::info('Wish created', ['wish_id' => $wish->id]);

        // Notify coordinator (example)
        // $coordinator = $ue->department->coordinator;
        // Notification::send($coordinator, new NewWishNotification($wish));

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'ue_name' => $ue->nom,
                'wish_type' => $validated['wish_type']
            ]);
        }

        return redirect()->route('wishes.index')
            ->with([
                'success' => true,
                'ue_name' => $ue->nom,
                'wish_type' => $validated['wish_type']
            ]);
    }
        public function destroy($id)
{
    \Log::info("Tentative de suppression - ID: $id - User: ".auth()->id());
    
    try {
        $wish = wishe::findOrFail($id);
        \Log::debug("Demande trouvée", [$wish->toArray()]);

        if ($wish->user_id !== auth()->id()) {
            \Log::warning("Tentative non autorisée", [
                'user_id' => auth()->id(),
                'wish_user_id' => $wish->user_id
            ]);
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        \Log::debug("Statut de la demande: ".$wish->status);
        if (!in_array($wish->status, ['en attent', 'pending'])) {
            \Log::warning("Statut invalide pour suppression", [
                'status' => $wish->status
            ]);
            return response()->json(['error' => 'Seules les demandes en attente peuvent être supprimées'], 422);
        }
        
        $wish->delete();
        \Log::info("Demande supprimée avec succès - ID: $id");
        
        return response()->json(['success' => true]);
        
    } catch (\Exception $e) {
        \Log::error("Erreur de suppression", [
            'id' => $id,
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
}