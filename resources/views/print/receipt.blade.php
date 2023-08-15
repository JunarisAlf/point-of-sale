<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>POS Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .receipt {
            width: 300px;
            margin: 20px auto;
            border: 1px solid #000;
            padding: 10px;
        }

        .header h1 {
            text-align: center;
            margin: 0;
        }

        .header p {
            margin: 5px 0;
        }

        .item {
            border-top: 1px dashed #000;
            padding: 5px 0;
        }

        .totals {
            margin-top: 10px;
            border-top: 2px solid #000;
            padding-top: 10px;
        }

        .strong {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="header">
            <h1 class="font-bold text-xl mb-2">{{App\Models\KeyValue::where('key', 'toko_name')->first()->value}}</h1>
            <span class="block w-full text-center text-sm">{{$trx->invoice_id}}</span>
            <p>Tanggal: <span>{{Carbon\Carbon::parse($trx->date)->format('d-m-y H:i:s')}}</span></p>
            <p>Kasir: <span id="address">#{{$trx->user->id}}</span></p>
            <p>Pelanggan: <span id="address">{{$trx->customer?->name === null ? "-" : $trx->customer?->name}}</span></p>
        </div>
        <div class="items">
            <div class="item">
                @foreach ($trx->details as $detail)
                    <table style="width: 100%; margin-top: 4px">
                        <tr>
                            <td>+ {{$detail->item->name}}</td>
                            <td style="text-align: center">{{$detail->quantity}}</td>
                            <td style="text-align: end">{{number_format($detail->price, 0, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;&nbsp;    {{number_format($detail->price * $detail->quantity , 0, ',', '.')}}
                            {{ $detail->discount !== 0 ? "- Disc. " . number_format($detail->discount, 0, ',', '.') : ""}}</td>
                            <td style="text-align: end">{{number_format($detail->grand_price, 0, ',', '.')}}</td>
                        </tr>
                    </table>
                @endforeach
            </div>
        </div>
        <div class="totals">
            <table class="w-full">
                <tr>
                    <td>
                        <strong>Sub Total: </strong>
                    </td>
                    <td class="">
                        <p>Rp. {{number_format($trx->sub_total, 0, ',', '.')}}</p>
                    </td>
                </tr>

                <tr>
                    <td>
                        <strong>Total Discount: </strong>
                    </td>
                    <td class="">
                        <p>Rp. {{number_format($trx->total_discount, 0, ',', '.')}}</p>
                    </td>
                </tr>

                <tr>
                    <td>
                        <strong>Grand Total: </strong>
                    </td>
                    <td class="">
                        <p>Rp. {{number_format($trx->total, 0, ',', '.')}}</p>
                    </td>
                </tr>

                <tr>
                    <td>
                        <strong>Bayar: </strong>
                    </td>
                    <td class="">
                        <p>Rp. {{number_format($trx->total_pay, 0, ',', '.')}}</p>
                    </td>
                </tr>

                <tr>
                    <td>
                        <strong>Kembalian: </strong>
                    </td>
                    <td class="">
                        <p>Rp. {{number_format($trx->total_pay - $trx->total, 0, ',', '.')}}</p>
                    </td>
                </tr>
            </table>
    </div>
</body>
</html>
