@extends('pemain.layouts.contest', ['pageActive' => 'pemain.contest', 'pageTitle' => 'Team Contest', 'contestType' => 'Multiple Choice'])

@section('content')
<div class='mc-container mb-2'>
    <div class="card mc-number">
        <div class="card-header d-flex justify-content-center">
            <span>Navigate</span>
        </div>
        <div class="card-body">
            <div class="card-text">
                <div class="inline-spacing">
                    <div class="mc-list-number">
                        @foreach($questions as $question)
                        @php
                        if($question->nomor == $nomor) $classWarna = 'bg-primary text-white';
                        else if(isset($question->teams()->where('team_id', '=', Auth::user()->team->id)->first()->pivot->jawaban)) {
                        if($question->teams()->where('team_id', '=', Auth::user()->team->id)->first()->pivot->keyakinan == "1") $classWarna = 'badge-light-info';
                        else $classWarna = 'badge-light-warning';
                        }
                        else $classWarna = 'badge-light-secondary';
                        @endphp
                        <button form="submit_submission" style='border: none;' name="tujuan" value='{{ $question->nomor }}' class="badge rounded-pill{{ " $classWarna" }}">{{ $question->nomor }}</button>
                        @endforeach
                    </div>
                </div>
            </div>
            <br>
            @if (!is_null($previous))
            <button form="submit_submission" name="tujuan" value='{{ $previous }}' class="btn btn-icon rounded-circle" style='float: left;'><span class='badge rounded-pill badge-light-secondary'><i data-feather='arrow-left'></i></span></button>
            @endif
            @if ($nomor != $nomor_terakhir)
            <button form="submit_submission" name="tujuan" value='{{ $next }}' class="btn btn-icon rounded-circle" style='float: right;'><span class='badge rounded-pill badge-light-secondary'><i data-feather='arrow-right'></i></span></button>
            @endif
        </div>


    </div>
    <div class="mc-content">
        <div class="card">
            <div class="card-header" style='background-color: #5c657a'>
                <h4 class="card-title text-white">Nomor {{ $nomor }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('pemain.contest.mc.submit') }}" method='POST' id='submit_submission'>
                    @csrf
                    <input type="hidden" name="question_id" value="{{ $questionNow->id }}">
                    <div class="card-text">
                        <br>
                        <p class="soal">
                            {!! $questionNow->isi !!}
                        </p>
                        <hr>
                        <div class="pilihan">
                            @foreach ($questionNow->mcChoices as $choice)
                            <br>
                            <div class="row">
                                <div class="col-auto">
                                    <input class="form-check-input mb-1" type="radio" id='pilihan_{{ $choice->id }}' name="jawaban" value="{{ Str::upper($choice->abjad) }}" {{ !is_null($currentSubmission) ? (Str::upper($currentSubmission->pivot->jawaban) == Str::upper($choice->abjad) ? "checked" : "") : "" }}>
                                </div>
                                <div class='col-auto'><label for='pilihan_{{ $choice->id }}'>{{ $choice->abjad }}.</label></div>
                                <div class="col-10">
                                    <label for='pilihan_{{ $choice->id }}'>{{ $choice->isi }}</label>

                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer keyakinan mt-3">
                        <p>Keyakinan:</p>
                        <div class='form-check form-check-info mb-1'>
                            <input class="form-check-input mb-1" type="radio" id='keyakinan1' name="keyakinan" value="1" {{ !is_null($currentSubmission) ? (Str::upper($currentSubmission->pivot->keyakinan) == "1" ? "checked" : "") : "" }}>
                            <label class="form-check-label" for="keyakinan1">&nbsp;Yakin</label>
                        </div>
                        <div class='form-check form-check-warning'>
                            <input class="form-check-input mb-1" type="radio" id='keyakinan0' name="keyakinan" value="0" {{ !is_null($currentSubmission) ? (Str::upper($currentSubmission->pivot->keyakinan) == "0" ? "checked" : "") : "" }}>
                            <label class="form-check-label" for="keyakinan0">&nbsp;Tidak Yakin</label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div>
            @if (!is_null($previous))
            <button type='submit' form="submit_submission" name="tujuan" value='{{ $previous }}' class="btn btn-secondary" style='float: left;'>Back</button>
            @endif
            @if ($nomor == $nomor_terakhir)
            <button type='button' data-bs-toggle="modal" data-bs-target="#finishAttemptModal" class="btn btn-danger" style='float: right;'>Finish Attempt</button>
            @else
            <button type='submit' form="submit_submission" name="tujuan" value='{{ $next }}'  class="btn btn-primary" style='float: right;'>Next</button>
            @endif
        </div>
    </div>
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
                <form method="POST" action="{{ route('pemain.contest.prg.finishAttempt') }}" id="finishAttempt">
                    @csrf
                    <p>Submit All and Finish?</p>
                </form>
            </div>
            <div class="modal-footer">
                <button class='btn btn-secondary' data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                <button type='submit' form="submit_submission" name="tujuan" value='end' class="btn btn-danger" data-bs-dismiss="modal">Submit</button>
            </div>
        </div>
    </div>
</div>
{{-- END OF MODAL FINISH ATTEMPT --}}
@endsection