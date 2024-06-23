@extends('_layouts.main')
@section('content')
    {{-- Header --}}
    <header class="masthead text-center text-white">
        <div class="masthead-content">
            <div class="container px-5">
                <h1 class="masthead-heading mb-0">Data Pegawai</h1>
                <h2 class="masthead-subheading mb-0"></h2>
            </div>
        </div>
        <div class="bg-circle-1 bg-circle"></div>
        <div class="bg-circle-2 bg-circle"></div>
        <div class="bg-circle-3 bg-circle"></div>
        <div class="bg-circle-4 bg-circle"></div>
    </header>

    <section class="jumbotron text-center">
        <div class="container" id="about">
            <h1 class="jumbotron-heading">About</h1>
            <p class="lead text-muted">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolor et ab in ipsam optio,
                quos distinctio animi sit facilis! Doloremque hic aliquid modi dolorem placeat ea repellat et, dignissimos
                commodi?</p>
        </div>
    </section>

    {{-- Chart Section --}}
    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pengguna</h3>
                    </div>
                    <div class="card-body">
                        {!! $chart->container() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    {{ $chart->script() }}
@endsection
