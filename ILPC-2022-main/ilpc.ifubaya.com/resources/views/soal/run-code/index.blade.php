@extends('soal.layouts.app', ['pageActive' => 'soal.run.code', 'pageTitle' => 'Soal Run Code'])

@section('style')
<style>
    input[type=file] {
        text-indent: -100px;
    }
</style>
@endsection

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Soal</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('soal.index')}}">Soal</a></li>
                        <li class="breadcrumb-item active">Run Code</li>
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
            <h4 class="card-title">Introduction</h4>
        </div>
        <div class="card-body">
            <div class="card-text">
                <p>
                    Anda dapat mengetes code di sini.
                </p>
            </div>
        </div>
    </div>
    <!--/ Kick start -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Execution Output</h4>
        </div>
        <div class="card-body">
            <div class="card-text">
                <p>Hasil : {{ session('result') ?? '-' }}</p>
                <p>Runtime : {{ session('runtime') ?? '-' }}</p>
                @if (file_exists(public_path('/storage/prg/runcode/result.out')))
                <a href="{{ asset('/storage/prg/runcode/result.out') }}" target="_blank" download="" class="btn btn-outline-primary waves-effect"><i data-feather='download'></i> Download Result File</a>
                @else
                <button class="btn btn-outline-secondary waves-effect" disabled><i data-feather='x'></i> Result File Not Available</button>
                @endif
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Run Code</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
            @php
            session()->flash("error", "Mohon pilih data dengan benar");
            @endphp
            @endif
            @include('layouts.alert')
            {{-- RADIO BUTTON START --}}
            <p class="card-text mb-0">Pilih bahasa</p>

            <form method="POST" action="{{ route('soal.run.code.execute') }}" enctype="multipart/form-data">
                @csrf
                <div class="demo-inline-spacing">
                    {{-- JAVA --}}
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="bahasa" id="radioJava" value="java" checked />
                        <label class="form-check-label" for="radioJava">Java</label>
                    </div>

                    {{-- PASCAL --}}
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="bahasa" id="radioPascal" value="pascal" />
                        <label class="form-check-label" for="radioPascal">Pascal</label>
                    </div>

                    {{-- PYTHON --}}
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="bahasa" id="radioPython" value="python" />
                        <label class="form-check-label" for="radioPython">Python</label>
                    </div>

                    {{-- C++ --}}
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="bahasa" id="radioCplus" value="cpp" />
                        <label class="form-check-label" for="radioCplus">C++</label>
                    </div>
                </div>
                {{-- RADIO BUTTON END --}}

                <div class="row my-2 px-1">
                    Masukkan input file dan source code file Anda
                    <div class="form-control mt-2 mb-1">
                        <label for="program_file" class="form-label">Upload Program File</label>
                        <br>
                        <label for="program_file" class="btn btn-outline-primary waves-effect">
                            <input type="file" name="program_file" id="program_file">
                        </label>
                    </div>

                    <div class="form-control mb-1">
                        <label for="input_file" class="form-label">Upload Input File</label>
                        <br>
                        <label for="input_file" class="btn btn-outline-primary waves-effect">
                            <input type="file" name="input_file" id="input_file">
                        </label>
                    </div>

                    <div class="form-control mb-1">
                        <label for="output_file" class="form-label">Upload Output File</label>
                        <br>
                        <label for="output_file" class="btn btn-outline-primary waves-effect">
                            <input type="file" name="output_file" id="output_file">
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Run Code</button>
            </form>
        </div>
    </div>
</div>
@endsection