@extends('pemain.layouts.contest', ['pageActive' => 'pemain.contest', 'pageTitle' => 'Team Contest', 'contestType' => 'Programming'])

@section('content')
<style>
    th,
    td {
        padding: 7px;
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

    <!-- Kick start -->
    <div class="row match-height">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header" style='background-color: #5c657a'>
                    <h4 class="card-title text-white">Programming ILPC 2022 🏆</h4>
                </div>
                <div class="card-body mt-2">
                    @include('layouts.alert')
                    <div class="card-text">
                        <p>
                            Di bawah ini adalah daftar soal yang terdapat pada contest programming ini.
                            <br>Anda dapat menekan tombol <b>Open</b> untuk melihat detail soal dan mengumpulkan jawaban.
                        </p>
                        <div class="badge badge-light-primary">
                            Untuk mengupdate Verdict, mohon melakukan refresh.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Kick start -->

    <!-- Prg Question -->
    <div class="row match-height">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header" style='background-color: #5c657a'>
                    <h4 class="card-title text-white">List of Programming Question</h4>
                </div>
                <div table-responsive>
                    <table class="table mt-3 mb-3 table-striped">
                        <thead style="vertical-align: center">
                            <tr>
                                <th width="8%">Nomor</th>
                                <th width="60%">Nama Soal</th>
                                <th class="text-center" width="20%">
                                    Verdict
                                </th>
                                <th class="text-center" width="20%">Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $question)
                            <tr>
                                <td width="8%" class="text-center">{{ $question->nomor }}</td>
                                <td width="60%">{{ $question->judul }}</td>
                                @php ($style = "badge badge-light-danger")
                                @if(!isset($question->submission))
                                @php($style = "badge badge-light-secondary")
                                @elseif(isset($question->submission) && $question->submission->status == "Accepted")
                                @php($style = "badge badge-light-success")
                                @elseif (isset($question->submission) && $question->submission->status == "Pending")
                                @php($style = "badge badge-light-warning")
                                @endif
                                <td width="20%" class="text-center"><label class="{{ $style }}">{{isset($question->submission) ? $question->submission->status : 'No Submission' }}</label></td>
                                <td width="20%" class="text-center">
                                    <a class="btn btn-outline-primary waves-effect" href="{{ route('pemain.contest.prg.question', ['contest' => $contest->slug, 'question' => $question->id]) }}">Open</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <div class="inline-spacing-center mb-3 mt-3">
                        {{-- UNCOMMENT INI UNTUK FINAL ! --}}
                        <div class="form-check form-check-inline">
                            <a href="{{ route('pemain.contest.prg.scoreboard', $contest->slug) }}" class="btn btn-outline-primary waves-effect ms-1 " style="width:100%;">
                                <i data-feather="award"></i> <span>Realtime Scoreboard</span>
                            </a>
                        </div>
                        <div class="form-check form-check-inline">
                            <a href="{{ route('pemain.contest.prg.submission', $contest->slug) }}" class="btn btn-outline-primary waves-effect ms-1" style="width:100%;">
                                <i data-feather="clock"></i> <span>Submission History</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        {{-- btn finish --}}
        <div class='mb-2'>
            <button type='button' class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#finishAttemptModal" onclick="getPrgDataToDelete({{ $contest->id }})" style='float: right;'>Finish Attempt</button>
        </div>

        </div>
    </div>
    <!-- /Prg Question -->
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
                    <input type="hidden" name="contest_id" value='{{ $contest->id }}'>
                    <p>Submit All and Finish?</p>
                </form>
            </div>
            <div class="modal-footer">
                <button class='btn btn-secondary' data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                <button form="finishAttempt" type="submit" class="btn btn-danger" data-bs-dismiss="modal">Submit</button>
            </div>
        </div>
    </div>
</div>
{{-- END OF MODAL FINISH ATTEMPT --}}
@endsection

@section('script')
<script>

</script>
@endsection