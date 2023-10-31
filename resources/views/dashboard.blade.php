<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <h1 class="text-3xl font-semibold text-center mb-6 bg-gray-200 py-2">DAFTAR BUKU</h1>
    <div class="mt-4 mb-4 p-4 bg-white shadow-md flex items-center justify-between">
        <form action="{{ route('buku.search') }}" method="GET" class="flex items-center">
            @csrf
            <input type="text" name="kata" class="border rounded-l py-2 px-3 w-full" placeholder="Cari judul atau penulis...">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white rounded-r px-4 py-2">Cari</button>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Harga</th>
                    <th>Tanggal Terbit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if(Session::has('pesan'))
                <div class="alert alert-success">{{ Session::get('pesan') }}</div>
                @endif
                @foreach($data_buku as $b)
                <tr>
                    <td>{{ $b->id }}</td>
                    <td>{{ $b->judul }}</td>
                    <td>{{ $b->penulis }}</td>
                    <td>{{ 'Rp'.number_format($b->harga, 2, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($b->tgl_terbit)->format('D/m/Y') }}</td>
                    <td>
                        <form action="{{ route('buku.edit', $b->id) }}">
                            <button class="btn btn-primary" onclick="return confirm('Yakin mau diedit?')">Edit</button>
                        </form>
                        <form action="{{ route('buku.destroy', $b->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Yakin mau dihapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $data_buku->links() }}
    </div>
    <div>
        <p><a href="{{ route('buku.create') }}">
            <button class="btn btn-success">Tambah Buku</button>
        </a></p>
        <p class="text-lg">Jumlah data buku : {{ $jumlah_buku }}</p>
        <p class="text-lg">Jumlah harga semua buku adalah : Rp {{ number_format($total_harga, 2, ',', '.') }}</p>
    </div>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</x-app-layout>
