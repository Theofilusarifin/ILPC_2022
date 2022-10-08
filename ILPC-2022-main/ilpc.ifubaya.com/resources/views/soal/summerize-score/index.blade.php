@extends('soal.layouts.app', ['pageActive' => 'soal.summerize.score', 'pageTitle' => 'Soal Summarize Score'])

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Soal</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('soal.index')}}">Soal</a></li>
                        <li class="breadcrumb-item active">Summarize Score</li>
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
                    Anda dapat melihat Total Score di sini.
                </p>
            </div>
        </div>
    </div>
    <!--/ Kick start -->

    {{-- Pilih Contest Start --}}
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Lihat Total Score</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
                @php
                session()->flash("error", "Mohon pilih data dengan benar");
                @endphp
            @endif
            @include('layouts.alert')
            <div class="row mb-1">
                <div class="col-4" data-select2-id="46" class="mb-1">
                    <label class="form-label" for="select2-basic">Jenis Contest</label>
                    <select class="select2 form-select" tabindex="-1" aria-hidden="true" id="jenis_contest" onchange="getContestData()">
                        <option selected disabled>-- Pilih Jenis Contest --</option>
                        <option value="mc" data-select2-id="mc">Multiple Choice</option>
                        <option value="essay" data-select2-id="essay">Essay</option>
                        <option value="prg" data-select2-id="prg">Programming</option>
                    </select>
                </div>
            </div>
            
            <div class="row mb-2" id="prog_contest">
                <div class="col-4" class="mb-1">
                    <label class="form-label" for="large-select">Nama Contest</label>
                    <select class="select2 form-select" id="nama_contest" tabindex="-1" aria-hidden="true" disabled>
                    </select>
                </div>
            </div>
            <button type="submit" onclick=seeReport() class="btn btn-primary">See Report</button>
        </div>
    </div>
    {{-- Pilih Contest End --}}
    
    {{-- List Score Start --}}
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">List of Total Score</h4>
            <button class="btn btn-primary" onclick="download_table_as_csv('summerize-score-table');">Download as csv</button>
        </div>
        <div class="card-body">
        @include('layouts.alert')
            <table id="summerize-score-table" class="table mb-4">
                <tr>
                    <th class="text-center" width="5%">Rank</th>
                    <th class="text-center" width="15%">Team</th>
                    <th class="text-center" width="15%">Sekolah</th>
                    <th class="text-center" width="15%">Kota</th>
                    <th class="text-center" width="10%">Score</th>
                </tr>
            </table>
        </div>
    </div>
    {{-- List Score End --}}
</div>
@endsection

@section('script')
<script>
    function getContestData() {
        $.ajax({
            type: 'POST',
            url: "{{ route('soal.summerize.jenisContest') }}",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'jenis_contest': $('#jenis_contest').val(),
            },
            success: function(data) {
                $("#nama_contest").attr('disabled', false);
                $("#nama_contest").html('');

                var temp = "";
                temp += '<option selected disabled>-- Pilih Nama Contest --</option>';
                $.each(data.msg, function(key, value) {
                    temp += "<option value='" +
                        data.msg[key].id + "'>" +
                        data.msg[key].nama + "</option>";
                })
                $("#nama_contest").html(temp)
                $(".select2").select2();
            }
        });
    }

    function seeReport() {
        $.ajax({
            type: 'POST',
            url: "{{ route('soal.summerize.totalScore') }}",
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'jenis_contest': $('#jenis_contest').val(),
                'id_contest': $('#nama_contest').val(),
            },
            success: function(data) {
                $("#summerize-score-table").html('');

                var temp = "";
                temp += '<tr style="margin-bottom:15px;">';
                temp += '<th class="text-center" width="5%">Rank</th>';
                temp += '<th class="text-center" width="15%">Team</th>';
                temp += '<th class="text-center" width="15%">Sekolah</th>';
                temp += '<th class="text-center" width="15%">Kota</th>';
                temp += '<th class="text-center" width="10%">Score</th>';
                temp += '</tr>';

                var rank = 1
                $.each(data.data, function(key, value) {
                    temp += '<tr style="margin-bottom:15px;">';
                    temp += '<td class="text-center">' + rank + '</td>';
                    temp += '<td class="text-center">' + data.data[key].nama_tim + '</td>';
                    temp += '<td class="text-center">' + data.data[key].sekolah + '</td>';
                    temp += '<td class="text-center">' + data.data[key].kota + '</td>';
                    temp += '<td class="text-center">' + data.data[key].total_skor + '</td>';
                    temp += '</tr>';
                    rank++;
                })

                $("#summerize-score-table").html(temp)
            }
        });
    }

    // Quick and simple export target #table_id into a csv
function download_table_as_csv(table_id, separator = ',') {
    // Select rows from table_id
    var rows = document.querySelectorAll('#' + table_id + ' tr');
    // Construct csv
    var csv = [];
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll('td, th');
        for (var j = 0; j < cols.length; j++) {
            // Clean innertext to remove multiple spaces and jumpline (break csv)
            var data = cols[j].innerText.replace(/(\r\n|\n|\r)/gm, '').replace(/(\s\s)/gm, ' ')
            // Escape double-quote with double-double-quote (see https://stackoverflow.com/questions/17808511/properly-escape-a-double-quote-in-csv)
            data = data.replace(/"/g, '""');
            // Push escaped string
            row.push('"' + data + '"');
        }
        csv.push(row.join(separator));
    }
    var csv_string = csv.join('\n');
    // Download it
    var filename = 'export_' + table_id + '_' + new Date().toLocaleDateString() + '.csv';
    var link = document.createElement('a');
    link.style.display = 'none';
    link.setAttribute('target', '_blank');
    link.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv_string));
    link.setAttribute('download', filename);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}
</script>
@endsection