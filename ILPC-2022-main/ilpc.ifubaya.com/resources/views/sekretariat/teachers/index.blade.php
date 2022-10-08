@extends('sekretariat.layouts.app', ['pageActive' => 'sekretariat.teachers.index', 'pageTitle' => 'Sekretariat - Data
Guru'])

@section('header')
<style>
    ul {
        margin: 0;
    }


    @media only screen and (max-width: 1300px) {

        th:nth-child(3),
        td:nth-child(3) {
            display: none;
        }
    }

    @media only screen and (max-width: 940px) {

        th:nth-child(1),
        td:nth-child(1),
        th:nth-child(3),
        td:nth-child(3),
        th:nth-child(4),
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
                <h2 class="content-header-title float-start mb-0">Data Guru</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Sekretariat</a>
                        </li>
                        <li class="breadcrumb-item active">Guru
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
            <form method="get" action="{{ route('sekretariat.teachers.search') }}">
                <div class="row">
                    <div class="col-md-6 mb-1">
                        <label for="team_nama" class="form-label">Search by</label>
                        <div class="input-group">
                            <select id="searchBy" name="searchBy" class="form-select text-capitalize">
                                <option value="teachers.nama" class="text-capitalize">Nama</option>
                                <option value="teachers.telp" class="text-capitalize">Telp</option>
                                <option value="teachers.email" class="text-capitalize">Email</option>
                                <option value="schools.nama" class="text-capitalize">Sekolah</option>
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
            <div class="divider mb-4">
                <div class="divider-text">
                    {{ $teachers->onEachSide(1)->withQueryString()->links() }}</div>
            </div>

            <table class="table">
                <tr>
                    <th width="10%">ID</th>
                    <th width="20%">Nama</th>
                    <th width="20%">Telp</th>
                    <th width="25%">Email</th>
                    <th width="20%">Sekolah</th>
                    <th width="5%">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal"
                            style="width:100%;">
                            <i data-feather="plus-square"></i>
                        </button>
                    </th>
                </tr>
                @foreach ($teachers as $teacher)
                <tr>
                    <td>{{ $teacher->id }}</td>
                    <td>{{ $teacher->nama }}</td>
                    <td>{{ $teacher->telp }}</td>
                    <td>{{ $teacher->email }}</td>
                    <td>{{ $teacher->school->nama }}</td>
                    <td width="8%">
                        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal"
                            onclick="getTeacherDataToEdit({{ $teacher->id }})" style="width:100%;">
                            <i data-feather="edit"></i></button>
                        @if ($teacher->teams->isEmpty())
                        <button class="btn btn-outline-danger mt-1" data-bs-toggle="modal" data-bs-target="#deleteModal"
                            onclick="getTeacherDataToDelete({{ $teacher->id }})" style="width:100%;">
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
                <h4 class="modal-title">Add Guru</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('sekretariat.teachers.store') }}" id="sekretariatTeachersStore">
                    @csrf

                    <div class="mb-1">
                        <label for="add_teacher_nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="teacher_nama" id="add_teacher_nama"
                            placeholder="Nama" aria-describedby="teacher_nama" tabindex="1" autofocus />
                    </div>

                    <div class="mb-1">
                        <label for="add_teacher_telp" class="form-label">Telp</label>
                        <input type="text" class="form-control" name="teacher_telp" id="add_teacher_telp"
                            placeholder="Telp" aria-describedby="telp" tabindex="1" autofocus />
                    </div>

                    <div class="mb-1">
                        <label for="add_teacher_email" class="form-label">Email</label>
                        <input type="text" class="form-control" name="teacher_email" id="add_teacher_email"
                            placeholder="Email" aria-describedby="email" tabindex="1" autofocus />
                    </div>

                    <div class="mb-1">
                        <label for="add_teacher_alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" name="teacher_alamat" id="add_teacher_alamat"
                            placeholder="Alamat" aria-describedby="teacher_alamat" tabindex="1" autofocus />
                    </div>

                    <div class="mb-1">
                        <label for="add_teacher_alergi" class="form-label">Alergi</label>
                        <input type="text" class="form-control" name="teacher_alergi" id="add_teacher_alergi"
                            placeholder="Alergi" aria-describedby="teacher_alergi" tabindex="1" value="-" readonly/> <!-- TODO OFFLINE -->
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="add_teacher_vegetarian">Vegetarian</label>
                        <select id="add_teacher_vegetarian" class="form-select" tabindex="-1" aria-hidden="true"
                            name="teacher_vegetarian"> <!-- TODO OFFLINE -->
                            <option value='tidak'>Tidak</option>
                            <option value='ya'>Ya</option>
                        </select>
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="school_id">Sekolah</label>
                        <select id="add_school_id" class="select2 form-select" tabindex="-1" aria-hidden="true"
                            name="school_id">
                            @foreach ($schools as $school)
                            <option value='{{$school->id}}'>{{$school->nama}}</option>
                            @endforeach
                        </select>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button form="sekretariatTeachersStore" type="submit" class="btn btn-primary"
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
                <h4 class="modal-title">Edit Guru</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="" id="sekretariatTeachersUpdate">
                    @method('patch')
                    @csrf

                    <div class="mb-1">
                        <label for="edit_teacher_nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="teacher_nama" id="edit_teacher_nama"
                            placeholder="Nama" aria-describedby="teacher_nama" tabindex="1" autofocus />
                    </div>

                    <div class="mb-1">
                        <label for="edit_teacher_telp" class="form-label">Telp</label>
                        <input type="text" class="form-control" name="teacher_telp" id="edit_teacher_telp"
                            placeholder="Telp" aria-describedby="telp" tabindex="1" autofocus />
                    </div>

                    <div class="mb-1">
                        <label for="edit_teacher_email" class="form-label">Email</label>
                        <input type="text" class="form-control" name="teacher_email" id="edit_teacher_email"
                            placeholder="Email" aria-describedby="email" tabindex="1" autofocus />
                    </div>

                    <div class="mb-1">
                        <label for="edit_teacher_alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" name="teacher_alamat" id="edit_teacher_alamat"
                            placeholder="Alamat" aria-describedby="teacher_alamat" tabindex="1" autofocus />
                    </div>

                    <div class="mb-1">
                        <label for="edit_teacher_alergi" class="form-label">Alergi</label>
                        <input type="text" class="form-control" name="teacher_alergi" id="edit_teacher_alergi"
                            placeholder="Alergi" aria-describedby="teacher_alergi" tabindex="1" autofocus readonly /> <!-- TODO OFFLINE -->
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="edit_teacher_vegetarian">Vegetarian</label>
                        <select id="edit_teacher_vegetarian" class="form-select" tabindex="-1" aria-hidden="true"
                            name="teacher_vegetarian">  <!-- TODO OFFLINE -->
                        </select>
                    </div>

                    <div class="mb-1">
                        <label class="form-label" for="school_id">Sekolah</label>
                        <select id="edit_school_id" class="select2 form-select" tabindex="-1" aria-hidden="true"
                            name="school_id">
                        </select>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button form="sekretariatTeachersUpdate" type="submit" class="btn btn-primary"
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
                <h4 class="modal-title">Delete Guru</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="" id="sekretariatTeacherDelete">
                    @method('delete')
                    @csrf
                    <p>Apakah anda yakin untuk delete guru ini?</p>
                </form>
            </div>
            <div class="modal-footer">
                <button form="sekretariatTeacherDelete" type="submit" class="btn btn-primary"
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
        $("#add_school_id").select2({
            dropdownParent: $("#addModal")
        });
        $("#edit_school_id").select2({
            dropdownParent: $("#editModal")
        });
});

    function getTeacherDataToDelete(id){
        $("#sekretariatTeacherDelete").attr("action", "{{ route('sekretariat.teachers.index') }}/"+id)
    }

    // To fill the EDIT data
    function getTeacherDataToEdit(id) {
            $.ajax({
                type: 'POST',
                url: "{{ route('sekretariat.getTeacherDataToEdit') }}",
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'teacher_id': id,
                },
                success: function(data) {
                    $("#sekretariatTeachersUpdate").attr("action", "{{ route('sekretariat.teachers.index') }}/"+id)
                    $("#edit_teacher_nama").val(data.teacher[0]["nama"]);
                    $("#edit_teacher_telp").val(data.teacher[0]["telp"]);
                    $("#edit_teacher_email").val(data.teacher[0]["email"]);
                    $("#edit_teacher_alamat").val(data.teacher[0]["alamat"]);
                    $("#edit_teacher_alergi").val(data.teacher[0]["alergi"]);

                    $("#edit_teacher_vegetarian").html("");
                    var vegeYesSelected = "";
                    var vegeNoSelected = "";
                    if (data.teacher[0]["vegetarian"] == "ya") vegeYesSelected = " selected";
                    else vegeNoSelected = " selected";
                    $("#edit_teacher_vegetarian").append("<option value='ya'" +vegeYesSelected + ">Ya</option>");
                    $("#edit_teacher_vegetarian").append("<option value='tidak'" +vegeNoSelected + ">Tidak</option>");

                    $("#edit_school_id").html('');
                    var temp = "";
                    $.each(data.schools, function(key, value) {
                        if (data.schools[key].id == data.teacher[0]["school_id"])
                            temp += "<option selected value='" +
                            data.schools[key].id + "'>" +
                            data.schools[key].nama + "</option>"
                        else
                            temp += "<option value='" +
                            data.schools[key].id + "'>" +
                            data.schools[key].nama + "</option>"
                    })
                    $("#edit_school_id").html(temp)
                }
            });
        }
</script>
@endsection