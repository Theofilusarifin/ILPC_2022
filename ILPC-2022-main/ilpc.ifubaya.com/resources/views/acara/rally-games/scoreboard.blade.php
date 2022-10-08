@extends('soal.layouts.app', ['pageActive' => 'acara.rally.scoreboard', 'pageTitle' => 'Scoreboard Rally Games'])

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Rally</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Rally Games</li> 
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-body"></div>
    <!-- Kick start -->
    <div class="card">
        <div class="content-body">
            <!-- Kick start -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Introduction</h4>
                </div>
                <div class="card-body">
                    <div class="card-text">
                        <p>
                            Hi, {{ auth()->user()->username }}! <br>
                            Di sini, anda dapat mengecek scoreboard team. <br>
                            Apabila anda ingin mendownload tabel scoeboard, anda dapat menekan tombol download as csv.<br>
                            <br>
                            <br><br>
                            Love,
                            <br><br>
                            Tim SI
                        </p>
                        {{-- <div class="alert alert-primary" role="alert">
                            <div class="alert-body">
                                <strong>Hai {{ auth()->user()->username }}!</strong> Semoga harimu menyenangkan :)
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <!--/ Kick start -->
        </div>
    </div>
        
    <div class="card">
        {{-- List Score Start --}}
        <div class="card-header">
            <h4 class="card-title">Scoreboard</h4>
            <button class="btn btn-primary" onclick="download_table_as_csv('summerize-scoreboard-table');">Download as csv</button>
        </div>
        <div class="card-body">
        @include('layouts.alert')
        </div>
        <table id="summerize-scoreboard-table" class="table mb-4">
            <thead>
            <tr>
                <th class="text-center" width="10%">Rank</th>
                <th width="45%">Team</th>
                <th class="text-center" width="15%">Poin Rally</th>
                <th class="text-center" width="15%">Poin Gamebes</th>
                <th class="text-center" width="15%">Total Poin</th>
            </tr>
        </thead>
        <tbody>
            @php 
                $rank = 1;
                $index = 0;
            @endphp
            @if(isset($scoreboards))
            @foreach ($scoreboards as $scoreboard)
                <tr>
                    <td class="text-center">{{ $rank }}</td>
                    <td>{{ $scoreboard['nama'] }}</td>
                    <td class="text-center">{{ $scoreboard['poin_rally'] }}</td>
                    <td class="text-center">{{ $scoreboard['poin_gambes'] }}</td>
                    <td class="text-center">{{ $scoreboard['total_poin']}}</td>
                    {{-- <td  class="text-center">{{ $scoreboard->total_score?$scoreboard->total_score:0}}</td> --}}
                </tr>
                @php 
                $rank++;
                $index++;
                @endphp
            @endforeach
            @endif
        </tbody>
        </table>
    </div>
</div>
        
@endsection
        
@section('script')

<script>
    function getRallyGameDelete(id){
        $("#acaraRallyGameDelete").attr("action", "{{ route('acara.rg.index') }}/rally-games/destroy/"+id)
    }
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
