<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Vstupenka - {{ $ticket->play->movie->name }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #0f172a;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
        }

        .ticket-mobile-card {
            max-width: 340px;
            margin: 0 auto;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            background-color: #f8fafc;
            overflow: hidden;
            text-align: center;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05);
        }

        .ticket-header {
            background-color: #0f172a;
            color: #ffffff;
            padding: 12px;
            font-size: 11px;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 1.5px;
        }

        .ticket-body {
            padding: 24px 20px;
        }

        .movie-title {
            font-size: 22px;
            font-weight: 900;
            color: #0f172a;
            margin: 0 0 16px 0;
            line-height: 1.2;
        }

        .datetime-grid {
            border-top: 1px dashed #cbd5e1;
            border-bottom: 1px dashed #cbd5e1;
            padding: 12px 0;
            margin-bottom: 20px;
        }

        .grid-item {
            display: inline-block;
            width: 45%;
            font-size: 13px;
        }

        .grid-label {
            display: block;
            font-size: 10px;
            color: #64748b;
            text-transform: uppercase;
            font-weight: bold;
            margin-bottom: 2px;
        }

        .seat-section {
            background-color: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px;
            margin-bottom: 24px;
        }

        .seat-title {
            font-size: 24px;
            font-weight: 800;
            color: #f59e0b; /* Amber barva */
            margin-top: 2px;
        }

        .qr-section {
            background-color: #ffffff;
            padding: 16px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            display: inline-block;
            margin-bottom: 8px;
        }

        .qr-section img {
            width: 160px;
            height: 160px;
            display: block;
        }

        .ticket-id {
            font-size: 10px;
            font-family: monospace;
            color: #94a3b8;
            margin-top: 6px;
        }

        .price-tag {
            font-size: 12px;
            color: #64748b;
            margin-top: 16px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="ticket-mobile-card">
    <div class="ticket-header">
         Kino • E-Vstupenka
    </div>

    <div class="ticket-body">
        <h1 class="movie-title">{{ $ticket->play->movie->name }}</h1>

        <div class="datetime-grid">
            <div class="grid-item">
                <span class="grid-label">Datum</span>
                <strong>{{ \Carbon\Carbon::parse($ticket->play->start_date)->format('d.m.Y') }}</strong>
            </div>
            <div class="grid-item" style="border-left: 1px solid #e2e8f0;">
                <span class="grid-label">Začátek v: </span>
                <strong>{{ \Carbon\Carbon::parse($ticket->play->start_time)->format('H:i') }}</strong>
            </div>
        </div>

        <div class="seat-section">
            <div class="seat-title">
                Řada {{ $ticket->seat->row }}, Místo {{ $ticket->seat->column }}
            </div>
        </div>

        <div class="qr-section">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ $ticket->id }}" alt="QR">
            <div class="ticket-id">TICKET ID: {{ $ticket->id }}</div>
        </div>

        <div class="price-tag">
            Cena lístku: <span style="color: #0f172a;">{{ $ticket->price_paid }} Kč</span>
        </div>
    </div>
</div>

</body>
</html>
