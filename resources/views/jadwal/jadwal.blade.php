@extends('layouts.main')

@section('title', $title)

@section('container')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Scan QR</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Qr Scan</li>
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
                            <h5 class="card-title"><span class="d-none d-lg-block"></span>
                                <hr>
                            </h5>
                            <h1>
                                Jadwal Pelajaran Kelas ....
                            </h1>

                            <!-- Table with stripped rows -->
                            <div class="table-responsive">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Waktu</th>
                                            <th>SENIN</th>
                                            <th>SELASA</th>
                                            <th>RABU</th>
                                            <th>KAMIS</th>
                                            <th>JUMAT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>07.00 - 08.00</td>
                                            <td>Upacara</td>
                                            <td>Matematika</td>
                                            <td>Bahasa Inggris</td>
                                            <td>Fisika</td>
                                            <td>Kimia</td>
                                        </tr>
                                        <tr>
                                            <td>08.00 - 09.00</td>
                                            <td>Matematika</td>
                                            <td>Fisika</td>
                                            <td>Informatika</td>
                                            <td>Kimia</td>
                                            <td>Bahasa Inggris</td>
                                        </tr>
                                        <tr>
                                            <td>9.00 - 10.00</td>
                                            <td>Bahasa Inggris</td>
                                            <td>Informatika</td>
                                            <td>Matematika</td>
                                            <td>Kimia</td>
                                            <td>Fisika</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Table with stripped rows -->


                        </div>
                    </div><!-- End Default Card -->

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><span class="d-none d-lg-block"></span>
                                <hr>
                            </h5>
                            <h1>
                                Jadwal Pelajaran Kelas ....
                            </h1>

                            <!-- Table with stripped rows -->
                            <div class="table-responsive">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Waktu</th>
                                            <th>SENIN</th>
                                            <th>SELASA</th>
                                            <th>RABU</th>
                                            <th>KAMIS</th>
                                            <th>JUMAT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>07.00 - 08.00</td>
                                            <td>Upacara</td>
                                            <td>Matematika</td>
                                            <td>Bahasa Inggris</td>
                                            <td>Fisika</td>
                                            <td>Kimia</td>
                                        </tr>
                                        <tr>
                                            <td>08.00 - 09.00</td>
                                            <td>Matematika</td>
                                            <td>Fisika</td>
                                            <td>Informatika</td>
                                            <td>Kimia</td>
                                            <td>Bahasa Inggris</td>
                                        </tr>
                                        <tr>
                                            <td>9.00 - 10.00</td>
                                            <td>Bahasa Inggris</td>
                                            <td>Informatika</td>
                                            <td>Matematika</td>
                                            <td>Kimia</td>
                                            <td>Fisika</td>
                                        </tr>
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