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

    <!-- Daftar Catatan Pengeluaran -->
    <div class="row mb-4">
        <div class="col-md-12">
            <h2>Daftar Catatan Pengeluaran</h2>
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

    <!-- Tombol Tambah Catatan Pengeluaran -->
    <div class="row mb-4">
        <div class="col-md-12">
            <a href="{{ route('expenses.create') }}" class="btn btn-primary">{{ __('Add Expense') }}</a>
        </div>
    </div>

    <!-- Total Pengeluaran -->
    <div class="row mb-4">
        <div class="col-md-12">
            <h2 style="font-size: 1.5rem;">Total Pengeluaran</h2>
            <p>Total Pengeluaran: Rp {{ $totalExpenses }}</p>
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

    <!-- Web dibuat oleh -->
    <div class="row mb-4">
        <div class="col-md-12">
            <p style="font-size: 0.8rem;">Web dibuat oleh :</p>
            <ul>
                <li style="font-size: 0.8rem;">M. Sultonun Naim</li>
                <li style="font-size: 0.8rem;">Dion Danianto</li>
                <li style="font-size: 0.8rem;">M. Ilham al Faridsi</li>
            </ul>
        </div>
    </div>
</div>
@endsection