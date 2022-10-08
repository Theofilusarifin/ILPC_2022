@extends('sekretariat.layouts.app', ['pageActive' => 'sekretariat.index', 'pageTitle' => 'Sekretariat Dashboard'])

@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Sekretariat</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Sekretariat</a></li>
                            <li class="breadcrumb-item active">Home</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- Kick start -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Selamat datang di Dashboard Sekretariat 🚀</h4>
            </div>
            <div class="card-body">
                <div class="card-text">
                    <p>
                        Anda dapat memulai perjalanan sekretariat anda dengan memilih salah satu menu pada bagian
                        navigation di kiri.
                    </p>
                    <div class="alert alert-primary" role="alert">
                        <div class="alert-body">
                            <strong>Hai {{ auth()->user()->username }}!</strong> Semoga harimu menyenangkan :)
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Kick start -->

    </div>
@endsection
