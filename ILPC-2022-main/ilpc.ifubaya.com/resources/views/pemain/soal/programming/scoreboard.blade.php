@extends('pemain.layouts.contest', ['pageActive' => 'pemain.contest', 'pageTitle' => 'Team Scoreboard Contest', 'contestType' => 'Programming > Scoreboard'])

@section('content')
<style>
    th,
    td {
        padding: 7px;
    }
</style>

<div class="content-body">
    <div class="card">
        <div class="card-header" style='background-color: #5c657a'>
            <h4 id='contest_id' content='{{$contest->id}}' class="card-title text-white">Scoreboard {{ $contest->nama }}</h4>
        </div>
        <div class="table-responsive">
            <table id='tablePemain' class="table mt-3 table-bordered">
                <thead>
                @include('layouts.alert')
                    <tr class="text-center">
                        <th width="5%">Rank</th>
                        <th width="12%">Team</th>
                        <th width="5%">Solved</th>
                        <th width="5%">Time</th>
                        @foreach ($questions as $question)
                        <th width="5%">{{ $question->nomor }}</th>
                        @endforeach
                        <th width="8%">Attempt/Solved</th>
                    </tr>
                </thead>
                <tbody>
                    @php($rank = 1)
                    @foreach ($teams as $team)
                    <tr class="text-center align-top">
                        <td>{{ $rank }}</td>
                        <td>{{ $team->nama_tim }}</td>
                        <td>{{ $team->JB }}</td>
                        <td>{{ $team->total_penalti }}</td>
                        @foreach ($team->question as $question)
                        @php($total_penalti = "-")
                        @if($question->total_penalti != -1)
                        @php($total_penalti = $question->total_penalti)
                        @endif

                        @if ($question->status == NULL)
                        <td>
                            <label>0/{{ $total_penalti }}</label>
                        </td>
                        @elseif ($question->status == "Accepted" || $question->status == "Solved")
                        <td>
                            <label class="badge badge-light-success">{{ $question->attempt }}/{{ $total_penalti }}</label>
                        </td>
                        @elseif ($question->status == "Pending" || $question->status == "Judging")
                        <td>
                            <label class="badge badge-light-warning ">{{ $question->attempt }}/{{ $total_penalti }}</label>
                        </td>
                        @else
                        <td>
                            <label class="badge badge-light-danger">{{ $question->attempt }}/{{ $total_penalti }}</label>
                        </td>
                        @endif
                        @endforeach

                        <td>{{ $team->total_attempt[0]->total_attempt }}/{{ $team->total_JB[0]->total_JB }}</td>

                        @php($rank+=1)
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="text-center align-top">
                        <td colspan="4"><b>TOTAL (ATTEMPT/SOLVED)</b></td>
                        @foreach ($total as $total)
                        <td>{{ $total->total_attempt }}/{{ $total->total_JB }}</td>
                        @endforeach
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js/app.js') }}"></script>
@endsection