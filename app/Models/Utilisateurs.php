<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Utilisateurs extends Authenticatable
{
    use HasFactory ,Notifiable;
    protected $table = 'utilisateurs';
    protected $fillable = ['id' ,'firstName' , 'lastName' , 'data_nissance' , 'email' ,'role','ville','password' , 'deparetement' , 'specialite' ,'Numeroteliphone', 'CIN' , 'emailPersonelle' , 'created_at'];



    public function responsabilites()
    {
        return $this->hasMany(responsabilite::class, 'idProf');
    }




  public function wishes()
  {
      return $this->hasMany(wishe::class, 'user_id');
  }
  // Get current active roles


  // Check if user has a specific role


  // Get primary role (highest privilege)

public function currentCoordinatedFiliere()
{
    $responsabilite = $this->responsabilites()
        ->whereIn('Responsabilite', ['Cordinateur','profiseur'])
        ->with('filieres')
        ->first();
    return $responsabilite ? $responsabilite->filieres : null;
}


 public function currentCoordinatedDepartement()
{
    $responsabilite = $this->responsabilites()
        ->whereIn('Responsabilite', ['chef de departement','Cordinateur','profiseur'])
        ->with('departement')
        ->first();
        
        
    
    return $responsabilite ? $responsabilite->departement : null;
}
public function contraintesEnseignant()
{
    return $this->hasMany(ContrainteEnseignant::class, 'enseignant_id');
}

/**
 * Check if teacher is available at given time
 */
public function isAvailable($jour, $heureDebut, $heureFin, $ignoreId = null)
{
    // Check against scheduled sessions
    $conflict = $this->emploisDuTemps()
        ->where('jour', $jour)
        ->where(function($query) use ($heureDebut, $heureFin) {
            $query->whereBetween('heure_debut', [$heureDebut, $heureFin])
                ->orWhereBetween('heure_fin', [$heureDebut, $heureFin])
                ->orWhere(function($q) use ($heureDebut, $heureFin) {
                    $q->where('heure_debut', '<=', $heureDebut)
                      ->where('heure_fin', '>=', $heureFin);
                });
        });

    if ($ignoreId) {
        $conflict->where('id', '!=', $ignoreId);
    }

    // Check against teacher constraints
    $constraintConflict = $this->contraintesEnseignant()
        ->where('jour', $jour)
        ->where(function($query) use ($heureDebut, $heureFin) {
            $query->whereBetween('heure_debut', [$heureDebut, $heureFin])
                ->orWhereBetween('heure_fin', [$heureDebut, $heureFin])
                ->orWhere(function($q) use ($heureDebut, $heureFin) {
                    $q->where('heure_debut', '<=', $heureDebut)
                      ->where('heure_fin', '>=', $heureFin);
                });
        });

    return !$conflict->exists() && !$constraintConflict->exists();
}
public function ues()
{
    // Use 'prof_id' instead of 'user_id' to match your affectations table
    return $this->belongsToMany(ues::class, 'affectations', 'prof_id', 'ue_id')
                ->withTimestamps();
    }

    /**
     * Get the department name for this user
     */
    public function getDepartmentName()
    {
        return $this->deparetement;
    }

    /**
     * Get the department model instance for this user
     */
    public function departement()
    {
        return $this->belongsTo(Departement::class, 'deparetement', 'nom');
    }

    /**
     * Scope to filter users by department name
     */
    public function scopeByDepartment($query, $departmentName)
    {
        return $query->where('deparetement', $departmentName);
    }

    /**
     * Scope to filter users by department and roles
     */
    public function scopeByDepartmentAndRoles($query, $departmentName, $roles = ['profiseur', 'vacataire'])
    {
        // Ensure $roles is an array
        if (is_string($roles)) {
            $roles = [$roles];
        }

        return $query->where('deparetement', $departmentName)
                    ->whereIn('role', $roles);
    }

    /**
     * Static method to get professors and vacataires by department
     */
    public static function getProfessorsAndVacatairesByDepartment($departmentName)
    {
        return self::byDepartmentAndRoles($departmentName)->get();
    }

    /**
     * Static method to get professors and vacataires by department object
     */
    public static function getProfessorsAndVacatairesByDepartmentObject($departement)
    {
        return self::byDepartmentAndRoles($departement->nom)->get();
    }

    /**
     * Check if user belongs to a specific department
     */
    public function belongsToDepartment($departmentName)
    {
        return $this->deparetement === $departmentName;
    }

    /**
     * Get all professors and vacataires from the same department as this user
     */
    public function getColleaguesInSameDepartment()
    {
        return self::byDepartmentAndRoles($this->deparetement)
                   ->where('id', '!=', $this->id)
                   ->get();
    }

    /**
     * Alternative method using direct query (more explicit)
     */
    public static function getTeachersByDepartment($departmentName, $roles = ['profiseur', 'vacataire'])
    {
        // Ensure $roles is an array
        if (is_string($roles)) {
            $roles = [$roles];
        }

        return self::where('deparetement', $departmentName)
                   ->whereIn('role', $roles)
                   ->get();
    }

    /**
     * Check if user is a professor or vacataire
     */
    public function isTeacher()
    {
        return in_array($this->role, ['profiseur', 'vacataire']);
    }

    /**
     * Check if user is a professor
     */
    public function isProfessor()
    {
        return $this->role === 'profiseur';
    }

    /**
     * Check if user is a vacataire
     */
    public function isVacataire()
    {
        return $this->role === 'vacataire';
    }


}


