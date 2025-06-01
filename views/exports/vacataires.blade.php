<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Liste des Vacataires</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .title { font-size: 18px; font-weight: bold; }
        .date { font-size: 12px; color: #555; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background-color: #f2f2f2; text-align: left; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        .footer { margin-top: 20px; text-align: right; font-size: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Liste des Vacataires</div>
        <div class="date">Généré le: {{ now()->format('d/m/Y H:i') }}</div>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Spécialité</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vacataires as $vacataire)
            <tr>
                <td>VAC-{{ $vacataire->id }}</td>
                <td>{{ $vacataire->lastName }}</td>
                <td>{{ $vacataire->firstName }}</td>
                <td>{{ $vacataire->email }}</td>
                <td>{{ $vacataire->Numerotelephone }}</td>
                <td>{{ $vacataire->specialite }}</td>
                <td>{{ ucfirst($vacataire->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="footer">
        Système de Gestion des Vacataires - {{ config('app.name') }}
    </div>
</body>
</html>