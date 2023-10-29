@extends('admin.layout.APP_PANEL')
@section('page_title', 'Transaksi | Invoice Piutang')

@section('HTML_Main')
    <div class="print:mt-[-100px]">
        <img src="{{ asset('storage/images/' . App\Models\KeyValue::where('key', 'toko_logo')->first()->value) }} "
            alt="" class="m-auto w-[100px]">
        <h1 class="mb-2 text-center text-xl font-bold">INVOICE PEMBELIAN</h1>
        <h1 class="mb-2 text-center text-xl font-bold">{{ App\Models\KeyValue::where('key', 'toko_name')->first()->value }}
        </h1>
        <span
            class="block w-full text-center text-sm">{{ App\Models\KeyValue::where('key', 'toko_address')->first()->value }}</span>
        <span class="block w-full text-center text-sm font-bold">Tlp & WA:
            {{ App\Models\KeyValue::where('key', 'toko_wa')->first()->value }}</span>

        <table class="w-full mt-[20px]">
            <tr>
                <td class="text-center font-bold border-[1px]">TANGGAL TRANSAKSI</td>
                <td class="text-center font-bold border-[1px]">HUTANG</td>
                <td class="text-center font-bold border-[1px]">PEMBAYARAN</td>
                <td class="text-center font-bold border-[1px]">STATUS</td>
            </tr>
            <tr>
                <td class="text-center border-[1px]">{{Carbon\Carbon::parse($piutang->date)->format('d-m-y H:i:s')}}</td>
                <td class="text-center border-[1px]">
                    @if (!$piutang->is_paid)
                        Rp. {{number_format($piutang->total)}}
                    @else
                        -
                    @endif
                </td>
                <td class="text-center border-[1px]">
                    @if ($piutang->is_paid)
                        Rp. {{number_format($piutang->total)}}
                    @else
                        -
                    @endif
                </td>
                <td class="text-center border-[1px]">
                    @if ($piutang->is_paid)
                        LUNAS
                    @else
                        TERHUTANG
                    @endif
                </td>
            </tr>
            <tr>
                <td rowspan="6" colspan="2" class="text-center border-[1px]">
                    <table class="w-full">
                        <tr>
                            <td class="w-1/2 text-center">Tanda Terima</td>
                            <td class="w-1/2 text-center">Hormat Kami</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="h-[40px]"></td>
                        </tr>
                        <tr>
                            <td class="w-1/2 text-center">. . . . . . . . . . . . . . . . . . . .</td>
                            <td class="w-1/2 text-center">. . . . . . . . . . . . . . . . . . . .</td>
                        </tr>
                        <tr>
                            <td class="w-1/2 text-center">Stempel/Tanda Tangan</td>
                            <td class="w-1/2 text-center">Stempel/Tanda Tangan</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="pl-2 border-[1px]">SUB TOTAL</td>
                <td class="pl-2 border-[1px]">Rp. {{number_format($piutang->sub_total)}}</td>
            </tr>
            <tr>
                <td class="pl-2 border-[1px]">POTONGAN</td>
                <td class="pl-2 border-[1px]">Rp. {{number_format($piutang->total_discount)}}</td>

            </tr>
            <tr>
                <td class="pl-2 border-[1px]">TOTAL</td>
                <td class="pl-2 border-[1px]">Rp. {{number_format($piutang->total)}}</td>

            </tr>
            <tr>
                <td class="pl-2 border-[1px]">BAYAR</td>
                <td class="pl-2 border-[1px]">Rp. {{number_format($piutang->total_pay)}}</td>

            </tr>
            <tr>
                <td class="pl-2 border-[1px]">KEMBALIAN</td>
                @if($piutang->is_paid)
                    <td class="pl-2 border-[1px]">Rp. {{ number_format( $piutang->total_pay - $piutang->total)}}</td>
                @else
                    <td class="pl-2 border-[1px]">Rp. 0</td>
                @endif
            </tr>
        </table>
    </div>

@endsection
@section('page_css')
@endsection

@section('page_script')
    <script>
        window.onload = window.print()
    </script>
@endsection
