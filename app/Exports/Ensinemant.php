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

    public function map($profiseur): array
    {
        return [
            'prof-' . $vacataire->id,
            $profiseur->lastName,
            $profiseur->firstName,
            $profiseur->email,
            $profiseur->Numerotelephone,
            $profiseur->specialite,
            ucfirst($vacataire->status),
            $profiseur->created_at->format('d/m/Y')
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
