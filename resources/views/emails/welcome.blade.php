<!DOCTYPE html>
<html>
<head>
    <title>Vos identifiants académiques</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #f8f9fa; padding: 15px; text-align: center; }
        .content { padding: 20px; }
        .credentials { background-color: #f1f1f1; padding: 15px; border-radius: 5px; }
        .footer { margin-top: 20px; font-size: 0.9em; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Academiq - Vos identifiants</h2>
        </div>
        
        <div class="content">
            <p>Bonjour {{ $data['name'] }},</p>
            
            <p>Votre compte vacataire a été créé avec succès dans le département <strong>{{ $data['department'] }}</strong>.</p>
            
            <div class="credentials">
                <p><strong>Email :</strong> {{ $data['email'] }}</p>
                <p><strong>Mot de passe temporaire :</strong> {{ $data['password'] }}</p>
            </div>
            
            <p>Pour votre sécurité, nous vous recommandons de :</p>
            <ol>
                <li