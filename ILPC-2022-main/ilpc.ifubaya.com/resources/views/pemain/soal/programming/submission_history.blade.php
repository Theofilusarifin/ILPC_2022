@extends('pemain.layouts.contest', ['pageActive' => 'pemain.contest', 'pageTitle' => 'Team Submission History', 'contestType' => 'Programming'])

@section('content')
<style>
    th,
    td {
        padding: 7px;
    }
</style>

<div class="content-body">
    <!-- Submission History  -->
    <div class="row match-height" id="table-head">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header mb-3" style='background-color: #5c657a'>
                    <h4 class="card-title text-white">Submission History Of {{ $contest->nama }}</h4>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th width="5%">No</th>
                                <th width="12%">Submit Time</th>
                                <th width="5%">Question</th>
                                <th width="5%">Language</th>
                                <th width="8%">Verdict</th>
                            <tr>
                        </thead>
                        {{-- Code Disini --}}
                        <tbody>
                        @foreach ($submissions as $submission)
                            <tr class="text-center">
                                <td width="5%">{{ $loop->iteration }}</td>
                                <td width="12%">{{ $submission->waktu_submit }}</td>
                                <td width="15%">{{ $submission->judul }}</td>
                                <td width="5%">{{ $submission->bahasa }}</td>
                                @php($style = "badge badge-light-danger")
                                @if ($submission->status == "Accepted")
                                    @php($style = "badge badge-light-success")
                                @elseif ($submission->status == "Pending")
                                    @php($style = "badge badge-light-warning")
                                @endif
                                <td width="8%">
                                    <label class="{{ $style }}">{{ $submission->status }}</label>
                                </td>
                            <tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /Submission History   -->

</div>
@endsection

@section('script')
<script>

</script>
@endsection