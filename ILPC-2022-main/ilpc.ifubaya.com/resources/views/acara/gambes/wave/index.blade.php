@extends('soal.layouts.app', ['pageActive' => 'acara.gambes.wave.index', 'pageTitle' => 'Game Besar'])

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Semifinal</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Game Besar</li>
                        <li class="breadcrumb-item active">List of Waves</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
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
                            Di sini, anda dapat menambah dan melakukan pengaturan terhadap  Game Besar. <br>
                            Untuk membuat Wave Gambes baru, anda dapat menekan tombol <i class="text-success" data-feather="plus-square"></i> di ujung kanan pada tabel.<br>
                            Untuk melakukan edit Wave Gambes, anda dapat menekan tombol <i class="text-warning" data-feather="edit"></i> pada wave yang diinginkan.<br>
                            Untuk menghapus Wave Gambes, anda dapat menekan tombol <i class="text-danger" data-feather="trash-2"></i> pada wave yang diinginkan.
                            <br>
                            <div class="badge badge-light-primary">
                                Teliti kembali setiap Wave Gambes yang telah anda buat atau ubah.
                            </div>
                            <br><br>
                            Love,
                            <br><br>
                            Tim SI
                        </p>
                    </div>
                </div>
            </div>
            <!--/ Kick start -->
        </div>
    </div>
        
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List of Wave Gambes</h4>
                </div>
                <div class="card-body">
                    @include('layouts.alert')
                </div>
        
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-2">
                        <tr>
                            <th width="5%">ID</th>
                            <th width="30%">Nomor Wave</th>
                            <th width="20">Jadwal Preparasi</th>
                            <th width="20">Jadwal Mulai</th>
                            <th width="20">Jadwal Selesai</th>
                            <th width="5%" class="text-center">
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal" style="max-width:100%;">
                                    <i data-feather="plus-square"></i>
                                </button>
                            </th>
                        </tr>
                        @foreach ($waves as $wave)
                        <tr>
                            <td>{{ $wave->id }}</td>
                            <td>{{ $wave->nomor }}</td>
                            <td>{{ $wave->jadwal_preparasi }}</td>
                            <td>{{ $wave->jadwal_mulai }}</td>
                            <td>{{ $wave->jadwal_selesai }}</td>
                            <td width="5%" class="text-center">
                                <button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editModal_{{ $wave->id }}" onclick="getWaveUpdate({{ $wave->id }})" style="max-width:100%;">
                                    <i data-feather="edit"></i></button>
                                <button class="btn btn-outline-danger mt-1" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="getWaveDelete({{ $wave->id }})" style="max-width:100%;">
                                    <i data-feather="trash-2"></i></button>
                            </td>
                        </tr>

                        {{-- MODAL EDIT--}}
                        <div class="modal fade" id="editModal_{{ $wave->id }}" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Wave</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ route('acara.gambes.wave.update', $wave->id) }}" id="acaraWaveUpdate_{{ $wave->id }}">
                                            @csrf
                        
                                            {{-- Nomor --}}
                                            <div class="mb-1">
                                                <label for="edit_nomor_{{ $wave->id }}" class="form-label">Nomor Wave</label>
                                                <input type="number" class="form-control" name="nomor" id="edit_nomor_{{ $wave->id }}" placeholder="Nomor Wave" aria-describedby="name" tabindex="1" autofocus value="{{ old('nomor') ?? $wave->nomor }}" />
                                            </div>
                
                                            {{-- Jadwal Preparasi --}}
                                            <div class="mb-1">
                                                <label class="form-label" for="edit_jadwal_preparasi_{{ $wave->id }}">Jadwal Preparasi</label>
                                                <input type="text" id="edit_jadwal_preparasi_{{ $wave->id }}" name="jadwal_preparasi" class="form-control flatpickr-date-time flatpickr-input" placeholder="YYYY-MM-DD HH:MM" autofocus value="{{ old('nomor') ?? $wave->jadwal_preparasi }}" />
                                            </div>
                
                                            {{-- Jadwal Mulai --}}
                                            <div class="mb-1">
                                                <label class="form-label" for="edit_jadwal_mulai_{{ $wave->id }}">Jadwal Mulai</label>
                                                <input type="text" id="edit_jadwal_mulai_{{ $wave->id }}" name="jadwal_mulai" class="form-control flatpickr-date-time flatpickr-input" placeholder="YYYY-MM-DD HH:MM" autofocus value="{{ old('nomor') ?? $wave->jadwal_mulai}}" />
                                            </div>
                
                                            {{-- Jadwal Selesai --}}
                                            <div class="mb-1">
                                                <label class="form-label" for="edit_jadwal_selesai_{{ $wave->id }}">Jadwal Selesai</label>
                                                <input type="text" id="edit_jadwal_selesai_{{ $wave->id }}" name="jadwal_selesai" class="form-control flatpickr-date-time" placeholder="YYYY-MM-DD HH:MM" autofocus  autofocus value="{{ old('nomor') ?? $wave->jadwal_selesai}}"/>
                                            </div>
                
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button form="acaraWaveUpdate_{{ $wave->id }}" type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- END OF MODAL EDIT --}}
                        @endforeach
                    </table>
                </div>
                </div>
            </div>

        
        </div>
        
        {{-- MODAL ADD --}}
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Wave</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('acara.gambes.wave.store') }}" id="acaraRallyGamesStore">
                            @csrf
        
                            {{-- Nomor --}}
                            <div class="mb-1">
                                <label for="nama" class="form-label">Nomor Wave</label>
                                <input type="number" class="form-control" name="nomor" id="add_name" placeholder="Nomor Wave" aria-describedby="name" tabindex="1" autofocus />
                            </div>

                            {{-- Jadwal Preparasi --}}
                            <div class="mb-1">
                                <label class="form-label" for="add_jadwal_preparasi">Jadwal Preparasi</label>
                                <input type="text" id="add_jadwal_preparasi" name="jadwal_preparasi" class="form-control flatpickr-date-time flatpickr-input" placeholder="YYYY-MM-DD HH:MM" />
                            </div>

                            {{-- Jadwal Mulai --}}
                            <div class="mb-1">
                                <label class="form-label" for="add_jadwal_mulai">Jadwal Mulai</label>
                                <input type="text" id="add_jadwal_mulai" name="jadwal_mulai" class="form-control flatpickr-date-time flatpickr-input" placeholder="YYYY-MM-DD HH:MM" />
                            </div>

                            {{-- Jadwal Selesai --}}
                            <div class="mb-1">
                                <label class="form-label" for="add_jadwal_selesai">Jadwal Selesai</label>
                                <input type="text" id="add_jadwal_selesai" name="jadwal_selesai" class="form-control flatpickr-date-time" placeholder="YYYY-MM-DD HH:MM" />
                            </div>
        
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button form="acaraRallyGamesStore" type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- END OF MODAL ADD --}}
        
        {{-- MODAL DELETE --}}
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Wave</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="" id="acaraWaveDelete">
                            @csrf
                            <p>Apakah anda yakin untuk menghapus Wave ini?</p>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button form="acaraWaveDelete" type="submit" class="btn btn-primary" data-bs-dismiss="modal">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- END OF MODAL DELETE --}}
        

        @endsection
        
        @section('script')
        
        <script>

            function getWaveDelete(id){
                $("#acaraWaveDelete").attr("action", "{{ route('acara.gambes.wave.index') }}/destroy/"+id)
            }

        </script>          
@endsection