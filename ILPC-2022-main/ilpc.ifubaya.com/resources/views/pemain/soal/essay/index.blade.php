@extends('pemain.layouts.contest', ['pageActive' => 'pemain.contest', 'pageTitle' => 'Team Contest', 'contestType' => 'Essay'])

@section('style')
<style>
    input[type=file] {
        text-indent: -100px;
    }

    
</style>
@endsection

@section('content')
<div class="content-body">
    <!-- Kick start -->
    <div class="row match-height">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header" style='background-color: #5c657a'>
                    <h4 class="card-title text-white" >Essay ILPC 2022 🏆</h4>
                </div>
                <div class="card-body">
                    <div class="card-text mt-2">
                        <p>
                            Jawab seluruh pertanyaan yang ada di bawah ini dengan melakukan 
                            <b>upload jawaban dalam bentuk 
                                <span class="text-danger">(.pdf) <img src="{{ asset('vuexy') }}/app-assets/images/icons/pdf.png" alt="file-icon" height="25"></span> 
                                pada bagian akhir pertanyaan.</b>
                        </p>
                        <div class="badge badge-light-danger">
                            <strong>Pastikan anda sudah melakukan submit untuk menyimpan jawaban sebelum waktu berakhir.</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Kick start -->

    <!-- Question -->
    <div class="row match-height">
        <div class="col-lg-12 col-md-12 col-sm-12">
            {{-- @foreach ($question as $question)
            <div class="card">
                <div class="card-header" style='background-color: #E8E9EA'>
                    <h4 class="card-title ">Nomor {{ $question->nomor }}</h4>
                </div>
                <div class="card-body">
                    <p> {!! $question->isi !!}</p> 
                </div>
            </div>
            @endforeach --}}
            <div class="card">
                <div class="card-header" style='background-color: #5c657a'> 
                    <h4 class="card-title text-white">Soal</h4>
                </div>
                <div class="card-body">
                    @include('layouts.alert')
                    <table class="table">
                        @foreach ($question as $question)
                            <tr>
                                <td class="pt-2">
                                    {{-- <span class="fw-bolder">
                                        Nomor {{  $question->nomor  }}
                                    </span>  --}}
                                    <div class="badge badge-light-primary">
                                        {{  $question->nomor  }}
                                    </div>
                                    <br>
                                    <br>
                                        {!! $question->isi !!}
                                </td>   
                                
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Question -->

    <!-- Upload Answer -->
    <div class="row match-height">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-primary">Upload Answer</h4>
                </div>
                <div class="card-body">
                    <div class="badge badge-light-danger mb-2" style="text-align:left">
                        <strong>Pastikan anda sudah melakukan submit untuk menyimpan jawaban sebelum waktu berakhir.</strong>
                    </div>
                    
                    <form method="post" id='submit_submission' action="{{ route('pemain.contest.essay.upload', $contest->slug) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-control mb-2">
                            <label for="answer_file" class="form-label mb-1"><b>Pastikan file diupload dalam bentuk (.pdf) dan maksimal ukuran file 5 mb</b></label>
                            <br>
                            <a class="btn btn-outline-primary waves-effect">
                                <input type="file" accept="application/pdf,application/vnd.ms-excel"  name="answer_file" id="answer_file">
                            </a>
                            @error("answer_file")
                            <p class="text-danger mt-1" role="alert">
                                <strong><small>{{ $message }}</small></strong>
                            </p>
                            @enderror
                        </div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#finishAttemptModal">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Upload Answer -->
</div>

{{-- MODAL FINISH ATTEMPT --}}
<div class="modal fade" id="finishAttemptModal" tabindex="-1" aria-labelledby="finishAttemptModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Finish Attempt</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                    <p>Submit All and Finish?</p>
            </div>
            <div class="modal-footer">
                <button class='btn btn-secondary' data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                <button type='submit' form="submit_submission" class="btn btn-danger" data-bs-dismiss="modal">Submit</button>
            </div>
        </div>
    </div>
</div>
{{-- END OF MODAL FINISH ATTEMPT --}}
@endsection