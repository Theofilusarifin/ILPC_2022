@extends('pemain.layouts.contest', ['pageActive' => 'pemain.contest', 'pageTitle' => 'Team Contest', 'contestType' => 'Programming > Question'])

@section('content')
<style>
    th,
    td {
        padding: 7px;
    }

    input[type=file] {
        text-indent: -100px;
    }
</style>

<div class="content-body">
    {{-- Alert --}}
    {{-- <div class="col-8 d-none" id="alert">
        <div class="alert alert-success alert-dismissible" role="alert">
            <div class="alert-body">
                Anda berhasil tergabung dalam kontes
                <button type="button" class="btn-close" data-bs-dismiss="alert">
                </button>
            </div>
        </div>
    </div> --}}

    <!-- Question -->
    <div class="row match-height">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header" style='background-color: #5c657a'>
                    <h4 class="card-title text-white">{{ $question->judul }}</h4>
                </div>
                <div class="card-body">
                    <div>
                        <p class="mt-2">Time Limit: <label class="badge badge-light-primary">
                                {{ $question->time_limit }} second</label></p>
                        <p class="mt-1">Memory Limit: 5MB.</p>
                    </div>
                    <hr>
                    <div>{!! $question->isi !!}</div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Question -->

    <!-- Submit -->
    <div class="row match-height">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-primary">Submit Source Code</h4>
                </div>
                <div class="card-body">
                    @include('layouts.alert')

                    <p class="card-text">
                        Pastikan file source code anda memiliki eksistensi yang sesuai seperti di bawah ini.
                    </p>
                    <div class="inline-spacing-center mb-2">
                        <div class="form-check form-check-inline">
                            <label class="badge badge-light-danger">C++ (*.cpp)</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="badge badge-light-warning">Java (*.java)</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="badge badge-light-primary">Pascal (*.pas)</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="badge badge-light-info">Python (*.py)</label>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('pemain.contest.prg.question.submission', ['contest' => $contest->slug, 'question' => $question->id]) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-control mb-1">
                            <label for="answer_file" class="mb-1">Upload Answer</label>
                            <br>
                            <label for="answer_file">
                            <a class="btn btn-outline-primary waves-effect">
                                <input type="file" name="answer_file" id="answer_file">
                            </a>
                            </label>
                            @error("answer_file")
                            <p class="text-danger mt-1" role="alert">
                                <strong><small>{{ $message }}</small></strong>
                            </p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary my-1" data-bs-dismiss="modal">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Submit -->
</div>
@endsection

@section('script')
<script>

</script>
@endsection