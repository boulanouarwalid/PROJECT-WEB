<?php

namespace App\Exports;

use App\Models\Utilisateurs;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class VacatairesExport implements FromQuery, WithHeadings, WithMapping, WithStyles
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function query()
    {
        $query = Utilisateurs::where('role', 'vacataire');

        if (!empty($this->filters['status'])) {
            $query->where('status', $this->filters['status']);
        }

        if (!empty($this->filters['specialite'])) {
            $query->where('specialite', $this->filters['specialite']);
        }

        if (!empty($this->filters['date_from']) && !empty($this->filters['date_to'])) {
            $query->whereBetween('created_at', [
                $this->filters['date_from'],
                $this->filters['date_to']
            ]);
        }

        return $query->orderBy('lastName')->orderBy('firstName');
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nom',
            'Prénom',
            'Email',
            'Téléphone',
            'Spécialité',
            'Statut',
            'Date de création'
        ];
    }

    public function map($vacataire): array
    {
        return [
            'VAC-' . $vacataire->id,
            $vacataire->lastName,
            $vacataire->firstName,
            $vacataire->email,
            $vacataire->Numerotelephone,
            $vacataire->specialite,
            ucfirst($vacataire->status),
            $vacataire->created_at->format('d/m/Y')
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