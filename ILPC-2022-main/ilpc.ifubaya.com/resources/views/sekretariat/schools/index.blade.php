@extends('sekretariat.layouts.app', ['pageActive' => 'sekretariat.schools.index', 'pageTitle' => 'Sekretariat - Data
Sekolah'])

@section('header')
<style>
    ul {
        margin: 0;
    }
    @media only screen and (max-width: 800px) {
        th:nth-child(3),
        th:nth-child(4),
        td:nth-child(3),
        td:nth-child(4) {
            display: none;
        }
    }
</style>
@endsection

@section('content')

<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Data Sekolah</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Sekretariat</a>
                        </li>
                        <li class="breadcrumb-item active">Sekolah
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
        <div class="mb-1 breadcrumb-right">
            <div class="dropdown">
                <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                        data-feather="grid"></i></button>
                <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#"><i class="me-1"
                            data-feather="check-square"></i><span class="align-middle">Todo</span></a><a
                        class="dropdown-item" href="#"><i class="me-1" data-feather="message-square"></i><span
                            class="align-middle">Chat</span></a><a class="dropdown-item" href="#"><i class="me-1"
                            data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item"
                        href="#"><i class="me-1" data-feather="calendar"></i><span
                            class="align-middle">Calendar</span></a></div>
            </div>
        </div>
    </div> --}}
</div>
<div class="content-body">

    <div class="card">
        <div class="card-body">
            @include('layouts.alert')
            <h4 class="card-title mt-2">Search &amp; Filter</h4>
            <form method="get" action="{{ route('sekretariat.schools.search') }}">
                <div class="row">
                    <div class="col-md-6 mb-1">
                        <label for="team_nama" class="form-label">Search by</label>
                        <div class="input-group">
                            <select id="searchBy" name="searchBy" class="form-select text-capitalize">
                                <option value="schools.nama" class="text-capitalize">Nama</option>
                                <option value="alamat" class="text-capitalize">Alamat</option>
                                <option value="regencies.nama" class="text-capitalize">Kabupaten</option>
                            </select>
                            <input type="text" class="form-control" placeholder="Keyword" name="keyword"
                                value="{{ session(" keyword") ?? "" }}">
                            <button class="btn btn-outline-primary waves-effect" type="submit"><i
                                    data-feather="search"></i></button>
                        </div>
                    </div>
                </div>
            </form>

        </div>

        <div class="card-body">
            <div class="divider mb-4    ">
                <div class="divider-text">
                    {{ $schools->onEachSide(1)->withQueryString()->links() }}
                </div>
            </div>
            
            <table class="table">
                <tr>
                    <th width="10%">ID</th>
                    <th width="20%">Nama</th>
                    <th width="45%">Alamat</th>
                    <th width="20%">Kabupaten</th>
                    <th width="5%">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal"
                            style="width:100%;">
                            <i data-feather="plus-square"></i>
                        </button>
                    </th>
                </tr>
                @foreach ($schools as $school)
                <tr>
                    <td>{{ $school->id }}</td>
                    <td>{{ $school->nama }}</td>
                    <td>{{ $school->alamat }}</td>
                    <td>{{ $school->regency->nama }}</td>
                    <td width="8%">
                        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal"
                            onclick="getSchoolDataToEdit({{ $school->id }})" style="width:100%;">
                            <i data-feather="edit"></i></button>
                        @if ($school->teachers->isEmpty())
                        <button class="btn btn-outline-danger mt-1" data-bs-toggle="modal" data-bs-target="#deleteModal"
                            onclick="getSchoolDataToDelete({{ $school->id }})" style="width:100%;">
                            <i data-feather="trash-2"></i></button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>


{{-- MODAL ADD --}}
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Sekolah</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('sekretariat.schools.store') }}" id="sekretariatSchoolsStore">
                    @csrf

                    <div class="mb-1">
                        <label for="school_nama" class="form-label">Nama Sekolah</label>
                        <input type="text" class="form-control" name="school_nama" id="add_school_nama"
                            placeholder="Nama Sekolah" aria-describedby="school_nama" tabindex="1" autofocus />
                    </div>

                    <div class="mb-1">
                        <label for="school_alamat" class="form-label">Alamat Sekolah</label>
                        <input type="text" class="form-control" name="school_alamat" id="add_school_alamat"
                            placeholder="Alamat Sekolah" aria-describedby="school_alamat" tabindex="1" autofocus />
                    </div>


                    <div class="mb-1" data-select2-id="46">
                        <label class="form-label" for="regency_id">Kabupaten/Kota</label>
                        <select id="add_regency_id" class="select2 form-select" tabindex="-1" aria-hidden="true"
                            name="regency_id">
                            @foreach ($regencies as $regency)
                            <option value='{{$regency->id}}'>{{$regency->nama}}</option>
                            @endforeach
                        </select>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button form="sekretariatSchoolsStore" type="submit" class="btn btn-primary"
                    data-bs-dismiss="modal">Submit</button>
            </div>
        </div>
    </div>
</div>
{{-- END OF MODAL ADD --}}


{{-- MODAL EDIT --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Sekolah</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="" id="sekretariatSchoolsUpdate">
                    @method('patch')
                    @csrf

                    <div class="mb-1">
                        <label for="school_nama" class="form-label">Nama Sekolah</label>
                        <input type="text" class="form-control" name="school_nama" id="edit_school_nama"
                            placeholder="Nama Sekolah" aria-describedby="school_nama" tabindex="1" autofocus />
                    </div>

                    <div class="mb-1">
                        <label for="school_alamat" class="form-label">Alamat Sekolah</label>
                        <input type="text" class="form-control" name="school_alamat" id="edit_school_alamat"
                            placeholder="Alamat Sekolah" aria-describedby="school_alamat" tabindex="1" autofocus />
                    </div>


                    <div class="mb-1" data-select2-id="46">
                        <label class="form-label" for="select2-basic">Kabupaten/Kota</label>
                        <select id="edit_regency_id" class="select2 form-select" tabindex="-1" aria-hidden="true"
                            name="regency_id">
                        </select>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button form="sekretariatSchoolsUpdate" type="submit" class="btn btn-primary"
                    data-bs-dismiss="modal">Edit</button>
            </div>
        </div>
    </div>
</div>
{{-- END OF MODAL EDIT --}}

{{-- MODAL DELETE --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Sekolah</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="" id="sekretariatSchoolsDelete">
                    @method('delete')
                    @csrf
                    <p>Apakah anda yakin untuk delete sekolah ini?</p>
                </form>
            </div>
            <div class="modal-footer">
                <button form="sekretariatSchoolsDelete" type="submit" class="btn btn-primary"
                    data-bs-dismiss="modal">Delete</button>
            </div>
        </div>
    </div>
</div>
{{-- END OF MODAL DELETE --}}



@endsection

@section('script')
<script>
    // So that Select2 would work on Modal
    $(document).ready(function() {
        $("#add_regency_id").select2({
            dropdownParent: $("#addModal")
        });
        $("#edit_regency_id").select2({
            dropdownParent: $("#editModal")
        });
});

    function getSchoolDataToDelete(id){
        $("#sekretariatSchoolsDelete").attr("action", "{{ route('sekretariat.schools.index') }}/"+id)
    }

    // To fill the EDIT data
    function getSchoolDataToEdit(id) {
            $.ajax({
                type: 'POST',
                url: "{{ route('sekretariat.getSchoolDataToEdit') }}",
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'school_id': id,
                },
                success: function(data) {
                    $("#sekretariatSchoolsUpdate").attr("action", "{{ route('sekretariat.schools.index') }}/"+id)
                    $("#edit_school_nama").val(data.school[0]["nama"]);
                    $("#edit_school_alamat").val(data.school[0]["alamat"]);

                    $("#edit_regency_id").html('');
                    var temp = "";
                    $.each(data.regencies, function(key, value) {
                        if (data.regencies[key].id == data.school[0]["regency_id"])
                            temp += "<option selected value='" +
                            data.regencies[key].id + "'>" +
                            data.regencies[key].nama + "</option>"
                        else
                            temp += "<option value='" +
                            data.regencies[key].id + "'>" +
                            data.regencies[key].nama + "</option>"

                    })
                    $("#edit_regency_id").html(temp)
                }
            });
        }
</script>
@endsection