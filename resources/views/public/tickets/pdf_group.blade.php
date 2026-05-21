<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Vstupenky na představení</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #0f172a;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
        }

        .ticket-strip {
            max-width: 600px;
            margin: 0 auto;
            padding: 5px 10px;
            border-bottom: 1px dashed #94a3b8;
            background-color: #f8fafc;
        }

        .ticket-strip:last-child {
            border-bottom: none;
        }

        .ticket-table {
            width: 100%;
            border-collapse: collapse;
        }

        .ticket-table td {
            vertical-align: middle;
            padding: 0;
        }

        .cinema-name {
            text-transform: uppercase;
            font-size: 9px;
            color: #64748b;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        .movie-title {
            font-size: 16px;
            font-weight: bold;
            color: #0f172a;
            margin: 2px 0 6px 0;
        }

        .datetime-box {
            font-size: 11px;
            color: #334155;
            line-height: 1.4;
            margin-bottom: 8px;
        }

        .seat-text {
            font-size: 13px;
            font-weight: bold;
            color: #ffffff;
            background-color: #0f172a;
            padding: 4px 8px;
            border-radius: 4px;
            display: inline-block;
        }

        .ticket-meta {
            margin-top: 8px;
            font-size: 10px;
            color: #94a3b8;
        }

        .price-text {
            font-weight: bold;
            color: #b45309;
        }

        .qr-container {
            text-align: right;
            width: 90px;
        }

        .qr-container img {
            width: 85px;
            height: 85px;
            display: block;
            margin-left: auto;
        }
    </style>
</head>
<body>

@foreach($tickets as $ticket)
    <div class="ticket-strip">
        <table class="ticket-table">
            <tr>
                <td>
                    <div class="cinema-name">Městské Kino • Místenka</div>
                    <div class="movie-title">{{ $play->movie->name }}</div>

                    <div class="datetime-box">
                        <b>Datum: </b> {{ \Carbon\Carbon::parse($play->start_date)->format('d.m.Y') }}<br>
                        <b>Začátek v: </b> {{ \Carbon\Carbon::parse($play->start_time)->format('H:i') }}
                    </div>

                    <div class="seat-text">
                        Řada {{ $ticket->seat->row }}, Místo {{ $ticket->seat->column }}
                    </div>

                    <div class="ticket-meta">
                        Kód: {{ $ticket->id }} |
                        <span class="price-text">{{ number_format($ticket->price_paid, 0, ',', ' ') }} Kč</span>
                    </div>
                </td>

                <td class="qr-container">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $ticket->id }}" alt="QR">
                </td>
            </tr>
        </table>
    </div>
@endforeach

</body>
</html>
