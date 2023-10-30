@extends('admin.layout.APP_PANEL')
@section('page_title', 'Cash | Setoran Detail')

@section('HTML_Main')
    <div class="print:mt-[-100px]">
        <h1 class="text-center font-bold text-xl">Laporan Setoran Cabang {{$setoran->cabang->name}}</h1>
        <h2 class="text-center font-bold text-lg">{{Carbon\Carbon::parse($setoran->created_at)->format('d-m-Y')}}</h2>

        <table class="w-full mt-4">
            <tr>
                <td class="text-center font-bold border-[1px]">No.</td>
                <td class="text-center font-bold border-[1px]">Waktu</td>
                <td class="text-center font-bold border-[1px]">Keterangan</td>
                <td class="text-center font-bold border-[1px]">Masuk</td>
                <td class="text-center font-bold border-[1px]">Keluar</td>
            </tr>
            @php
                $no = 1;
                $totalIn = 0;
                $totalOut = 0;
            @endphp
            @foreach ($details as $detail)
                <tr>
                    <td class="text-center border-[1px]">{{$no++}}</td>
                    <td class="text-center border-[1px]">{{Carbon\Carbon::parse($detail->created_at)->format('d-m-Y H:i')}}</td>
                    <td class="pl-1 border-[1px]">{{$detail->name}}</td>
                    @if ($detail->flow == 'in')
                        <td class="pl-1 border-[1px]">Rp. {{number_format($detail->total)}}</td>
                        <td class="pl-1 border-[1px]"></td>
                        @php
                            $totalIn += $detail->total;
                        @endphp
                    @elseif ($detail->flow == 'out')
                        <td class="pl-1 border-[1px]"></td>
                        <td class="pl-1 border-[1px]">Rp. {{number_format($detail->total)}}</td>
                        @php
                            $totalOut += $detail->total;
                        @endphp
                    @endif

                </tr>
            @endforeach
            <tr>
                <td colspan="3" class="text-center font-bold border-[1px]">TOTAL</td>
                <td class="text-center font-bold border-[1px]">Rp. {{number_format($totalIn)}}</td>
                <td class="text-center font-bold border-[1px]">Rp. {{number_format($totalOut)}}</td>
            </tr>
            <tr>
                <td colspan="3" class="text-center font-bold border-[1px]">JUMLAH</td>
                <td colspan="2" class="text-center font-bold border-[1px]">Rp. {{number_format($totalIn - $totalOut)}}</td>
            </tr>
            <tr>
                <td colspan="3" class="text-center font-bold border-[1px]">TOTAL YANG DI SETOR</td>
                <td colspan="2" class="text-center font-bold border-[1px]">Rp. {{number_format($setoran->total)}}</td>
            </tr>
            <tr>
                <td colspan="3" class="text-center font-bold border-[1px]">SELISIH</td>
                <td colspan="2" class="text-center font-bold border-[1px]">Rp. {{number_format( $setoran->total - ($totalIn - $totalOut))}}</td>
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
