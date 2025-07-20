@extends('kerangka.master')
@section('title', 'Laporan') <!-- Title Page -->
@section('content')


<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="m-0 font-weight-bold text-primary">Laporan Keuangan</h5>

            <!-- Export to Excel Button -->
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle rounded-pill" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Export Laporan
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <form action="{{ route('laporan.export.pdf') }}" method="POST">
                            @csrf
                            <input type="hidden" name="tanggal_awal" value="{{ $tanggal_awal }}">
                            <input type="hidden" name="tanggal_akhir" value="{{ $tanggal_akhir }}">
                            <button type="submit" class="dropdown-item text-danger">Export to PDF</button>
                        </form>
                    </li>
                    <li>
                        <form action="/laporan/export" method="POST">
                            @csrf
                            <input type="hidden" name="tanggal_awal" value="{{ $tanggal_awal }}">
                            <input type="hidden" name="tanggal_akhir" value="{{ $tanggal_akhir }}">
                            <button type="submit" class="dropdown-item text-primary">Export to Excel</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-body">

            <!-- Filter Form -->
                <div class="col-12 col-md-6">
                    <form action="/laporan" method="GET"
                          class="d-flex flex-wrap align-items-center justify-content-between">
                        <div class="form-group mb-2 flex-fill me-2">
                            <input type="date" name="tanggal_awal" class="form-control"
                                   value="{{ $tanggal_awal ?? '' }}" required>
                        </div>
                        <div class="form-group mb-2 flex-fill me-2">
                            <input type="date" name="tanggal_akhir" class="form-control"
                                   value="{{ $tanggal_akhir ?? '' }}" required>
                        </div>
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary me-2 mb-2">Filter</button>
                            <a href="{{ route('laporan.index') }}" class="btn btn-secondary mb-2">Reset</a>
                        </div>
                    </form>
                </div>

            <!-- Table for Laporan -->
            <div class="table-responsive text-nowrap mt-4">
                <table class="table table-sm" >
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Pemasukan</th>
                            <th>Pengeluaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>{{ $item->tipe == 'Pemasukan' ? rupiah($item->jumlah) : '-' }}</td>
                            <td>{{ $item->tipe == 'Pengeluaran' ? rupiah($item->jumlah) : '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-success">
                        <tr>
                            <th colspan="3" class="text-end">Total</th>
                            <th>{{ rupiah($totalPemasukan) }}</th>
                            <th>{{ rupiah($totalPengeluaran) }}</th>
                        </tr>
                        <tr>
                            <th colspan="3" class="text-end">Profit</th>
                            <th colspan="2">{{ rupiah($profit) }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>
</div>
</div>

@endsection
