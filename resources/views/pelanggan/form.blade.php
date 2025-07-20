@extends('kerangka.master')
@section('title')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-6">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 font-weight-bold text-primary">{{ isset($pelanggan) ? 'Form Edit Pelanggan' : 'Form Tambah Pelanggan' }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ isset($pelanggan) ? route('pelanggan.update', $pelanggan->id_pelanggan) : route('pelanggan.tambah.simpan') }}" method="post">
                        @csrf
                        @if(isset($pelanggan))
                            @method('PUT') {{-- Use PUT for update --}}
                        @endif

                        <div class="mb-6">
                            <label class="form-label" for="id_pelanggan">ID Pelanggan</label>
                            <input type="text" class="form-control" id="id_pelanggan" name="id_pelanggan" value="{{ $id_pelanggan ?? '' }}" readonly>
                        </div>
                        <div class="mb-6">
                            <label class="form-label" for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Contoh:Adam" value="{{ isset($pelanggan) ? $pelanggan->nama : '' }}">
                        </div>
                        <div class="mb-6">
                            <label class="form-label" for="alamat">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Contoh:Desa Mangunrekso" value="{{ isset($pelanggan) ? $pelanggan->alamat : '' }}">
                        </div>
                        <div class="mb-6">
                            <label class="form-label" for="whatsapp">WhatsApp</label>
                            <input type="text" class="form-control" id="whatsapp" name="whatsapp" placeholder="Masukkan Nomor WhatsApp Pelanggan" value="{{ isset($pelanggan) ? $pelanggan->whatsapp : '' }}">
                        </div>
                        @error('whatsapp')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
			            <!-- Tampilkan Email dan Password hanya saat Edit -->
                        @isset($pelanggan)
                            <div class="mb-6">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Contoh: user@email.com"
                                    value="{{ $pelanggan->email }}">
                            </div>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                            <div class="mb-6">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Kosongkan jika tidak ingin mengubah password">
                            </div>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                            <div class="mb-6">
                                <label class="form-label" for="status">Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="aktif" {{ $pelanggan->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="nonaktif" {{ $pelanggan->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                            </div>
                        @endisset
                        <div class="mb-6">
                            <label class="form-label" for="id_paket">Paket</label>
                            <select name="id_paket" id="id_paket" class="form-select">
                                <option value="" selected disabled hidden>-- Pilih Paket --</option>
                                @foreach ($paket as $row)
                                    <option value="{{ $row->id_paket }}" {{ isset($pelanggan) && $pelanggan->id_paket == $row->id_paket ? 'selected' : '' }}>
                                        {{ $row->paket }} | {{ $row->tarif }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-6">
                            <label class="form-label" for="jatuh_tempo">Jatuh Tempo</label>
                            <input type="text" class="form-control" id="jatuh_tempo" name="jatuh_tempo" placeholder="Contoh:Tanggal 20" value="{{ isset($pelanggan) ? $pelanggan->jatuh_tempo : '' }}">
                        </div>
                        <div class="mb-6">
                            <label class="form-label" for="tanggal_pasang">Tanggal Pasang</label>
                            <input type="date" class="form-control" id="tanggal_pasang" name="tanggal_pasang" value="{{ isset($pelanggan) ? $pelanggan->tanggal_pasang : '' }}">
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('pelanggan') }}" class="btn btn-warning">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
