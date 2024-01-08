@extends('layouts.template')

@section('content')
    <div class="card bg-light mt-5 p-5">
        <form action="{{ route('order.search') }}" method="GET">
        <input type="date" name="search">
        <button type="submit" class="btn btn-primary">Cari</button>
        <a href="{{ route('order.index')}}" class="btn btn-primary">Clear</a>
        <div class="d-flex justify-content-end">
            <a href="{{ route('order.create') }}" class="btn btn-primary">Tambah Pengguna</a>
        </div>
        <table class="table mt-5 table-striped table-bordered table-hovered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pembeli</th>
                    <th>Pesanan</th>
                    <th>Total Bayar</th>
                    <th>Kasir</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($orders as $order)
            <tr>
                {{-- currentpage : ambil posisi ada di page keberapa - 1 (misal uda klik next lagi ada di page 2 berarti jadi 2-1 = 1), perpage : mengambil jumlah data yang ditampilkan perpagenya berapa (ada di controller bagian paginatenya /simplePaginate, misal 5), loop->index : mengambil indes dari array (muali dari 0)+1  --}}
                <td>{{ ($orders->currentpage()-1) * $orders->perpage() + $loop->index + 1}}</td>
                <td>{{ $order->name_customer }}</td>
                {{-- nested loop : looping di dalam looping --}}
                {{-- karna column medicines pada table orders tipe datanya json, jadi untuk aksesnya perlu looping --}}
                <td>
                    <ol>
                        @foreach ($order['medicines'] as $medicine)
                            <li>{{ $medicine['name_medicine'] }} <small>Rp. {{ number_format($medicine['price'], 0, ',', '.') }} <b>(qty : {{ $medicine['qty'] }})</b></small> = Rp. {{ number_format($medicine['price_after_qty'], 0, ',', '.') }}</li>
                        @endforeach
                    </ol>
                </td>
                @php
                    $ppn = $order['total_price'] * 0.1;
                @endphp
                <td>Rp. {{ number_format(($order['total_price']+$ppn), 0, '.', ',') }}</td>
                {{-- mengambil column dari relasi, $variable['namaFucntionDimodel'] --}}
                <td>{{ $order['user']['name'] }} <a href="">({{ $order['user']['email'] }})</a> </td>
                @php
                    setLocale(LC_ALL, 'IND');
                @endphp
                <td>{{ Carbon\Carbon::parse($order['created_at'])->formatLocalized('%d %B %Y') }}</td>
                <td><a href="{{ route('order.download-pdf', $order['id']) }}" class="btn btn-success">Cetak</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        @if ($orders->count())
            {{ $orders->links() }}
        @endif
    </div>
</form>
    </div>
@endsection