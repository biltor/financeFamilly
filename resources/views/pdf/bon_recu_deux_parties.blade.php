<!DOCTYPE html>
<html>
<head>
    <title>Bon de Reçu - Tranche #{{ $tranche->id }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 20px;
            font-size: 14px;
        }
        .container {
            width: 100%;
            border: 2px solid #007baf;
            padding: 20px;
            box-sizing: border-box;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header .title {
            text-align: center;
            border: 2px solid #007baf;
            padding: 5px 20px;
            font-size: 18px;
            font-weight: bold;
        }
        .content {
            margin-top: 20px;
        }
        .content p {
            margin: 5px 0;
        }
        .parties {
            margin-top: 15px;
        }
        .signature {
            margin-top: 60px;
            display: flex;
            justify-content: space-between;
        }
        .signature div {
            width: 30%;
            text-align: center;
            border-top: 1px solid #000;
            padding-top: 5px;
        }
        .bold { font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div>
                <strong>Date :</strong> {{ $tranche->date_reglement }}
            </div>
            <div class="title">BON DE REÇU</div>
            <div style="right: auto;">
                <strong>Tranche #:</strong> {{ $tranche->id }}
            </div>
        </div>

        <!-- Parties -->
        <div class="parties">
            <p><span class="bold">Payé par :</span> {{ $tranche->caisse->name }}</p>
            <p><span class="bold">Reçu par (propriétaire de la caisse) :</span> {{ $tranche->client->name }}</p>
        </div>

        <!-- Content -->
        <div class="content">
            <p>Nous confirmons avoir reçu la somme de :</p>
            <p style="font-weight:bold; font-size:16px;">{{ number_format($tranche->montant,2) }} {{ $tranche->devise }}</p>
            <p>Pour le projet : <strong>{{ $tranche->project->title }}</strong></p>
            <p>Description : {{ $tranche->description ?? '-' }}</p>
        </div>

        <!-- Signature -->
        <div class="signature">
            <div>Payeur</div>
            <div></div>
            <div>Récepteur / Signature</div>
        </div>
    </div>
</body>
</html>
