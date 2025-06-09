<?php

namespace App\Exports;

use App\Models\ues;
use App\Models\utilisateurs;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UnitesExport implements FromQuery, WithHeadings, WithMapping, WithStyles
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function query()
    {
        $filiere = auth()->user()->currentCoordinatedFiliere();

        $query = ues::where('filiere_id', $filiere->id );

        

        if (!empty($this->filters['date_from']) && !empty($this->filters['date_to'])) {
            $query->whereBetween('created_at', [
                $this->filters['date_from'],
                $this->filters['date_to']
            ]);
        }

        return $query->orderBy('nom');
    }

    public function headings(): array
    {
        return [
            'id',
            'nom',
            'code',
            'heures_cm',
            'heures_td',
            'heures_tp',
            'semestre', 
            'annee_universitaire',
            'est_vacant',
            'groupes_td',
            'groupes_tp'
        ];
    }

    public function map($ue): array
    {
        return [
            'VAC-' . $ue->id,
            $ue->nom,
            $ue->code,
            $ue->heures_cm,
            $ue->heures_tp,
            $ue->heures_td,
            $ue->semestre,
            $ue->annee_universitaire,
            $ue->groupes_td,
            $ue->groupes_tp,
            ucfirst($ue->est_vacant),
            $ue->created_at->format('d/m/Y')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text
            1 => ['font' => ['bold' => true]],
            
            // Set auto-size for columns
            'A:H' => ['autoSize' => true],
        ];
    }
}