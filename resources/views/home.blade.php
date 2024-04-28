@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Header -->
    <div class="row mb-4 fixed-top bg-dark p-3">
        <div class="col-md-6">
            <h1 class="text-white">{{ config('app.name', 'Expense Tracker') }}</h1>
        </div>
        <div class="col-md-6 d-flex justify-content-end align-items-center"> <!-- Menempatkan tombol logout dan nama user di posisi paling kanan -->
            @guest
                <a class="btn btn-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
            @else
                <span class="text-white" style="margin-right:10px">{{ Auth::user()->name }}</span> <!-- Menampilkan nama user -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger"><i class="fas fa-power-off text-white"></i></button> <!-- Tombol logout dengan ikon shutdown laptop -->
                </form>
            @endguest
        </div>
    </div>

    <!-- About Section -->
    <div class="row mt-5 mb-4">
        <div class="col-md-12">
            <h2>Catatan Pengeluaran Harian</h2>
            <p>Web ini dibuat untuk membantu anda mengelola pengeluaran harian anda. Dengan Web ini, Anda dapat dengan mudah mencatat, melihat, memperbarui, dan menghapus pengeluaran Anda.</p>
            <p>Web dibuat oleh :</p>
            <ul>
                <li>M. Sultonun Naim</li>
                <li>Dion Danianto</li>
                <li>M. Ilham al Faridsi</li>
            </ul>
        </div>
    </div>

    <!-- Filter Berdasarkan Tanggal -->
<div class="row mb-4">
    <div class="col-md-12">
        <h2>Filter Berdasarkan Tanggal</h2>
        <form action="{{ route('expenses.filter') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <label for="start_date">Mulai Tanggal:</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="end_date">Akhir Tanggal:</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary mt-4">Filter</button>
                </div>
                <!-- Tambahkan tombol Tampilkan Semua -->
                <div class="col-md-2">
                    <a href="{{ route('expenses.index') }}" class="btn btn-secondary mt-4">Tampilkan Semua</a>
                </div>
            </div>
        </form>
    </div>
</div>


    <!-- Daftar Catatan Pengeluaran -->
<div class="row mb-4">
    <div class="col-md-12">
        <h2>
            Daftar Catatan Pengeluaran
        </h2>
        <table class="table table-primary"> <!-- Menggunakan kelas table-primary untuk warna biru pada tabel -->
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Total</th>
                    <th>Tanggal</th>
                    <th>Deskripsi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($expenses as $expense)
                    <tr>
                        <td>{{ $expense->title }}</td>
                        <td> Rp {{ $expense->amount }}</td>
                        <td>{{ $expense->date }}</td>
                        <td>{{ $expense->description }}</td>
                        <td>
                            <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


    <!-- Tombol Tambah Catatan Pengeluaran -->
    <div class="row mb-4">
        <div class="col-md-12">
            <a href="{{ route('expenses.create') }}" class="btn btn-primary">{{ __('Add Expense') }}</a>
        </div>
    </div>

    <!-- Ringkasan Total Pengeluaran -->
    <div class="row mb-4">
        <div class="col-md-12">
            <h2>Total Pengeluaran</h2>
            <p>Total Pengeluaran: Rp {{ $totalExpenses }}</p>
        </div>
    </div>

    <!-- Notifikasi atau Pesan Penting -->
    <div class="row mb-4">
        <div class="col-md-12">
            <!-- Tambahkan notifikasi atau pesan penting di sini -->
        </div>
    </div>

    <!-- Opsi atau Tautan Tambahan -->
    <div class="row mb-4">
        <div class="col-md-12">
            <!-- Tambahkan opsi atau tautan tambahan di sini -->
        </div>
    </div>

    <!-- Grafik atau Diagram (Opsional) -->
    <div class="row">
        <div class="col-md-12">
            <!-- Tambahkan grafik atau diagram di sini -->
        </div>
    </div>
</div>
@endsection
