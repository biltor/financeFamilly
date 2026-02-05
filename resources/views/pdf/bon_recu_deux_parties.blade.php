<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            border: 1px dashed #000;
            padding: 20px;
            width: 750px;
            margin: auto;
            font-size: 16px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .title {
            font-weight: bold;
            font-size: 24px;
        }

        .amount-box {
            border: 2px solid #000;
            padding: 10px 20px;
            font-size: 18px;
            font-weight: bold;
            min-width: 150px;
            text-align: center;
        }

        .row {
            margin: 20px 0;
        }

        .line {
            border-bottom: 1px solid #000;
            display: inline-block;
            min-width: 420px;
            padding-bottom: 3px;
        }

        .footer {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .footer .block {
            width: 45%;
        }

        .signature-line {
            border-bottom: 1px solid #000;
            width: 200px;
            margin-top: 40px;
        }
    </style>
</head>
<body>

<!-- HEADER -->
<div class="header">


    <div class="amount-box">
        {{ number_format($tranche->montant, 2) }} DA
    </div>
</div>

<div>
        <div class="title">
        REÇU DE M {{ $tranche->client->name }}
    </div>
</div>

<!-- CONTENT -->
<div class="row">

    La somme de :
    <span class="line">
        {{ $montantEnLettres ?? '................................................' }}
    </span>
</div>

<div class="row">
    Pour :
    <span class="line">
        {{ $tranche->project->title }}
    </span>
</div>

<!-- FOOTER -->
<div class="footer">
    <div class="block">
        Le :
        <span class="line" style="min-width: 200px;">
            {{ $tranche->date_reglement }}
        </span>

        <div style="margin-top: 30px;">
            Signature :
            <div class="signature-line"></div>
        </div>
    </div>
</div>

</body>
</html>
