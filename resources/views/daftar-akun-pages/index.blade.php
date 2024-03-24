@extends('layouts.main')

@section('title', $title)

@section('container')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Kelola Akun</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Kelola Akun</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <!-- Default Card -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><span class="d-none d-lg-block">Dibuat oleh <a href="#">Tim
                                        Kerja Praktik</a></span>
                                <hr>
                            </h5>
                            <div class="mb-3">
                                @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="bi bi-check-circle me-1"></i>
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                                @endif
                            </div>
                            <h1>
                                Daftar Akun
                            </h1>
                            <div class="position-relative">
                                <a href="{{ route('user.create') }}">
                                    <button type="button" class="btn btn-primary mt-2">Tambah</button>
                                </a>
                            </div>

                            <!-- Table with stripped rows -->
                            <div class="table-responsive">
                                <table class="table table-responsive datatable">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>NIP/NISN</th>
                                            <th>Nama</th>
                                            <th>Peran</th>
                                            <th colspan="2">Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i = 1;
                                        @endphp
                                        @forelse ($data_user as $user)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $user->nip }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>
                                                @if($user->role === 'guru')
                                                <span class="btn btn-primary btn-sm">Guru</span>
                                                @elseif($user->role === 'siswa')
                                                <span class="btn btn-success btn-sm">Siswa</span>
                                                @else
                                                <span class="btn btn-secondary btn-sm">{{ $user->role }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('user.destroy', $user->id) }}" method="post">
                                                    <a href="{{ route('user.edit', $user->id) }}">
                                                        <button type="button" class="btn btn-warning btn-sm"><i
                                                                class="bi bi-pencil-fill"></i></button>
                                                    </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Yakin ingin menghapus akun {{ $user->name }}?')"><i
                                                            class="bi bi-trash-fill"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak Ada Data</td>
                                        </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div><!-- End Default Card -->

                </div>
            </div><!-- End Left side columns -->

        </div>
    </section>

</main><!-- End #main -->

@endsection
