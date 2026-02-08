<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        @page {
            size: 21cm 10cm;
            margin: 0.5cm;
        }

        body {
            font-family: Arial, sans-serif;
            width: 21cm;
            height: 10cm;
            margin: 0;
            padding: 0.5cm;
            font-size: 13px;
            border: 1px solid #000;
            box-sizing: border-box;
        }

        .title {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            vertical-align: top;
            padding: 4px 0;
        }

        .label {
            width: 10%;
        }

        .amount {
            width: 30%;
            text-align: right;
        }

        .amount-box {
            border: 2px solid #000;
            padding: 6px 10px;
            font-weight: bold;
            font-size: 15px;
            display: inline-block;
            min-width: 150px;
            text-align: center;
        }

        .signature {
            margin-top: 30px;
            width: 100%;
        }

        .line {
            border-bottom: 1px solid #000;
            display: inline-block;
            width: 220px;
        }
    </style>
</head>
<body>

<div class="title">BON DE RÉCEPTION</div>

<table>
    <tr>
        <td class="label">
            <strong>Montant:</strong>
        </td>
        <td class="amount">
            <div class="amount-box">
                {{ number_format($tranche->montant,2) }}  DA
            </div>
        </td>
    </tr>

    <tr>
        <td colspan="2">
            <strong>Montant (lettres) :</strong>
            quarante million de centime
        </td>
    </tr>

    <tr>
        <td colspan="2">
            <strong>Reçu par :</strong>
            {{ $tranche->client->name }}
        </td>
    </tr>

    <tr>
        <td colspan="2">
            <strong>Date :</strong>
           {{ $tranche->date_reglement }}
        </td>
    </tr>
</table>

<div class="signature">
    <strong>Signature :</strong>
    <span class="line"></span>
</div>

</body>
</html>
