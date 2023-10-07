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
            /* border: 1px solid #000; */
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
<body onload="window.print()">
    <div class="receipt border-2 print:border-0">
        <div class="header">
            <img src="{{asset('storage/images/' . App\Models\KeyValue::where('key', 'toko_logo')->first()->value) }} " alt="" class="w-1/2 m-auto">
            <h1 class="font-bold text-md mb-2 ">TOKO</h1>
            <h1 class="font-bold text-xl mb-2">{{App\Models\KeyValue::where('key', 'toko_name')->first()->value}}</h1>
            <span class="block w-full text-center text-sm">{{App\Models\KeyValue::where('key', 'toko_address')->first()->value}}</span>
            <span class="block w-full text-center font-bold text-sm">Tlp & WA: {{App\Models\KeyValue::where('key', 'toko_wa')->first()->value}}</span>

            <p class="totals"><span class="font-bold">Tanggal: </span> <span>{{Carbon\Carbon::parse($trx->date)->format('d-m-y H:i:s')}}</span></p>
            <p><span class="font-bold">Kasur: </span> <span id="address">#{{$trx->user->id}} {{$trx->user->full_name}}</span></p>
            <p><span class="font-bold">Pelanggan: </span> <span id="address">{{$trx->customer?->name === null ? "-" : $trx->customer?->name}}</span></p>
        </div>
        <div class="items ">
            <div class="item" style="font-size: 14px">
                @foreach ($trx->details as $detail)
                    <table style="width: 100%; margin-top: 4px">
                        <tr>
                            <td colspan="2">+ {{$detail->item->name}}</td>
                            {{-- <td style="text-align: center">{{$detail->quantity}}</td> --}}
                            <td style="text-align: end">{{number_format($detail->price, 0, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;&nbsp;  {{$detail->quantity}} {{$detail->satuan->name}} ({{$detail->qty_satuan}}) X  {{number_format($detail->price * $detail->quantity , 0, ',', '.')}}
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
        <hr class="my-2">
        <div class="mb-4">
            <span class="font-bold text-md text-center block">== Terimakasi ==</span>
            <span class="italic text-center block text-xs">Barang yang sudah dibeli tidak dapat ditukar kecuali sudah ada perjanjian</span>
        </div>
    </div>
</body>
</html>
