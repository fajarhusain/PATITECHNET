@extends('kerangka.master')
@section('title')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="m-0 font-weight-bold text-primary">Data Rekening Bank</h5>
            <a href="{{ route('banks.create') }}" class="btn btn-primary rounded-pill text-body-end"><i class="bx bx-plus me-1"></i>Rekening</a>
        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table id="example" class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('Icon') }}</th>
                            <th scope="col">{{ __('Nama Bank') }}</th>
                            <th scope="col">{{ __('Pemilik Rekening') }}</th>
                            <th scope="col">{{ __('Nomor Rekening') }}</th>
                            <th scope="col">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banks as $bank)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ $bank->url_icon }}" style="width: 100px; height: 50px;"></td>
                            <td>{{ $bank->nama_bank }}</td>
                            <td>{{ $bank->pemilik_rekening }}</td>
                            <td>{{ $bank->nomor_rekening }}</td>
                            <td>
                                <a href="{{ route('banks.edit', $bank->id) }}" class="btn btn-warning btn-sm"><i class="bx bx-edit-alt"></i></a>
                                <button onclick="confirmDelete('{{ route('banks.destroy', $bank->id) }}')" class="btn btn-danger btn-sm">
                                    <i class="bx bx-trash me-1"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @include('sweetalert::alert')
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(url) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Anda tidak akan bisa mengembalikan ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Membuat dan mengirim form secara dinamis
            var form = document.createElement('form');
            form.action = url;
            form.method = 'POST';
            form.innerHTML = `
                @csrf
                @method("DELETE")
            `;
            document.body.appendChild(form);
            form.submit();
        }
    })
}
</script>


@endsection
