<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Liste des unites d'Enseignement</title>
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
        <div class="title">Liste des unites d'Enseignement </div>
        <div class="date">Généré le: {{ now()->format('d/m/Y H:i') }}</div>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>code</th>
                <th>heures cours</th>
                <th>heures td</th>
                <th>heures tp</th>
                <th>semestre</th>
                <th>annee universitaire</th>
                <th>est vacant</th>
                <th>groupes td</th>
                <th>groupes tp</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ues as $ue)
            <tr>
                <td>VAC-{{ $ue->id }}</td>
                <td>{{  $ue->nom }}</td>
                <td>{{ $ue->code }}</td>
                <td>{{ $ue->heures_cm }}</td>
                <td>{{  $ue->heures_tp }}</td>
                <td>{{ $ue->heures_td }}</td>
                <td>{{  $ue->annee_universitaire }}</td>
                <td>{{ $ue->semestre }}</td>
                <td>{{ $ue->groupes_tp }}</td>
                <td>{{  $ue->groupes_td }}</td>
                <td>{{ ucfirst($ue->est_vacant) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="footer">
        Système de Gestion des ues - {{ config('app.name') }}
    </div>
</body>
</html>