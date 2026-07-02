<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Devis</title>
    <style>
        body { font-family: DejaVu Sans; font-weight: bold; font-size: 10px; }
        .header { display: flex; justify-content: space-between; }
        .title { text-align: center; margin: 20px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 8px; text-align: left; }
        .total { text-align: right; margin-top: 20px; }
    </style>
</head>
<body>

<!-- ENTREPRISE -->
<div class="header">
    
    <div>
            <img src="{{ public_path('storage/'.$entreprise->logo) }}" style="width: 150px; height: 100px; justify-content:center" alt="Logo entreprise" class="">
    </div>

    <div>
        <p>
            <ul>
                <li>TEL: {{ $entreprise->telephone }}</li>
                <li>Email: {{ $entreprise->email }}</li>
                <li>Address: {{ $entreprise->adresse }}</li>
                <li>RIB: {{ $entreprise->rib }}</li>
                <li>Ninea: {{ $entreprise->ninea }}</li>
                <li>RCCM: {{ $entreprise->rccm }}</li>
            </ul>
        </p>
        
        
        
        <p style="text-align:right">Référence : {{ $devis->reference }}</p>
        <p style="text-align:right; color: orange;">Client : {{ $devis->client->nom ?? '-' }}</p>
    </div>
</div>
<div style="border: 2px solid #333333;">
    <p style="text-align: center;">Objet: {{ $devis->objet ?? '-' }}</p>
</div>
<div>
    <p style="color: red; text-align: center; font-size: 9px">
        NB:Ce devis est valable pour une durée d'un mois à compter de sa date d'émission
        <span style="text-align: right;">{{ $devis->date_expiration }}</span>
    </p>
</div>

<div class="title">
    <h2>DEVIS</h2>
</div>


<!-- TABLE -->
<table>
    <thead>
        <tr>
            <th>DESIGNATION</th>
            <th>QUANTITE</th>
            <th>PRIX UNITAIRE</th>
            <th>PRIX TOTAL</th>
        </tr>
    </thead>
    <tbody>
        @foreach($devis->details as $detail)
        <tr>
            <td>{{ $detail->designation ?? '-' }}</td>
            <td>{{ $detail->quantite }}</td>
            <td>{{ number_format($detail->prix_unitaire, 0, ',', ' ') }}</td>
            <td>{{ number_format($detail->total, 0, ',', ' ') }}</td>  
        </tr>
        @endforeach
    </tbody>
</table>

<!-- TOTAL -->
<table>
    <tr>
        <td>TOTAL HTVA</td>
        <td>{{ number_format($devis->total, 0, ',', ' ') }}</td>
    </tr>
</table>

<div>
    <p style="text-align: left; font-size: 12px;">
        Conditions commerciales: <br>
        Conditions de paiement : 100 % à la livraison par chèque ou espèces <br>
        Pour les paiements par chèque, les marchandises ne seront livrables qu'une fois le chèque encaissé
    </p>
    <p style="text-align: left; color: red; font-size: 8px;">NB : Les frais d'hébergement et de connectivité seront payés mensuellement à hauteur de 5 000 F/compteur</p>
</div>



</body>
</html>