@extends('sekretariat.layouts.app', ['pageActive' => 'sekretariat.admins.index', 'pageTitle' => 'Sekretariat - Data
Admin'])

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
                <h2 class="content-header-title float-start mb-0">Data Admin</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Sekretariat</a>
                        </li>
                        <li class="breadcrumb-item active">Admin
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-body">

    <div class="card">
        <div class="card-body">
            @if ($errors->any())
            @php
            session()->flash("error", "Mohon isi data dengan benar");
            @endphp
            @endif
            @include('layouts.alert')
        </div>

        <div class="card-body">
            <div class="divider mb-4    ">
                <div class="divider-text">
                    {{ $admins->onEachSide(1)->withQueryString()->links() }}</div>
            </div>

            <table class="table">
                <tr>
                    <th width="5%">ID</th>
                    <th width="20%">Nama</th>
                    <th width="20%">Username</th>
                    <th width="5%">Role</th>
                    <th width="45%">Compet.ID</th>
                    <th width="5%">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal" style="width:100%;">
                            <i data-feather="plus-square"></i>
                        </button>
                    </th>
                </tr>
                @foreach ($admins as $admin)
                <tr>
                    <td>{{ $admin->id }}</td>
                    <td>{{ $admin->nama }}</td>
                    <td>{{ $admin->user->username }}</td>
                    <td>{{ $admin->user->role }}</td>
                    <td>{{ $admin->competition->tema }} ({{$admin->competition->tahun}})</td>
                    <td width="8%">
                        @if (Auth::user()->admin->id == $admin->id)
                        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal" onclick="getAdminDataToEdit({{ $admin->id }})" style="width:100%;">
                            <i data-feather="edit"></i></button>
                        @endif
                        <button class="btn btn-outline-danger mt-1" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="getAdminDataToDelete({{ $admin->id }})" style="width:100%;">
                            <i data-feather="trash-2"></i></button>
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
                <h4 class="modal-title">Add Admin</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('sekretariat.admins.store') }}" id="sekretariatAdminsStore">
                    @csrf
                    {{-- Select Role --}}
                    <div class="mb-1" data-select2-id="46">
                        <label class="form-label" for="regency_id">Role</label>
                        <select id="add_role" class="select2 form-select" tabindex="-1" aria-hidden="true" name="role">
                            <option value="soal">soal</option>
                            <option value="sekretariat">sekretariat</option>
                            <option value="acara">acara</option>
                            <option value="penpos">penpos</option>
                        </select>
                    </div>

                    {{-- Username --}}
                    <div class="mb-1">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="add_username" placeholder="Username" aria-describedby="username" tabindex="1" autofocus />
                    </div>

                    {{-- Password --}}
                    <div class="mb-1">
                        <label for="password" class="form-label">Password (min. 8)</label>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input type="password" class="form-control form-control-merge" id="password" name="password" autocomplete="new-password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" tabindex="2" />
                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                        </div>
                    </div>
                    <div class="mb-1">
                        <label for="password-confirm" class="form-label">Confirm Password</label>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input type="password" class="form-control form-control-merge" id="password-confirm" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password-confirm" tabindex="3" autocomplete="new-password" />
                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                        </div>
                    </div>

                    {{-- Nama --}}
                    <div class="mb-1">
                        <label for="nama" class="form-label">Nama Admin</label>
                        <input type="text" class="form-control" name="nama" id="add_nama" placeholder="Nama Admin" aria-describedby="nama" tabindex="1" autofocus />
                    </div>

                    {{-- NRP_NPK --}}
                    <div class="mb-1">
                        <label for="nrp_npk" class="form-label">NRP/NPK</label>
                        <input type="text" class="form-control" name="nrp_npk" id="add_nrp_npk" placeholder="NRP/NPK" aria-describedby="nrp_npk" tabindex="1" autofocus />
                    </div>

                    {{-- Competition ID --}}
                    <div class="mb-1" data-select2-id="46">
                        <label class="form-label" for="regency_id">Role</label>
                        <select id="add_competition_id" class="select2 form-select" tabindex="-1" aria-hidden="true" name="competition_id">
                            @foreach ($competitions as $competition)
                            <option value="{{$competition->id}}">{{ $competition->tema }} ({{ $competition->tahun }})</option>
                            @endforeach
                        </select>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button form="sekretariatAdminsStore" type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
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
                <h4 class="modal-title">Edit Password</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="" id="sekretariatAdminsUpdate">
                    @method('patch')
                    @csrf

                    <div class="mb-1">
                        <label for="password" class="form-label">Password (min. 8)</label>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input type="password" class="form-control form-control-merge" id="password" name="password" autocomplete="new-password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" tabindex="2" />
                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                        </div>
                    </div>

                    <div class="mb-1">
                        <label for="password-confirm" class="form-label">Confirm Password</label>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input type="password" class="form-control form-control-merge" id="password-confirm" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password-confirm" tabindex="3" autocomplete="new-password" />
                            <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button form="sekretariatAdminsUpdate" type="submit" class="btn btn-primary" data-bs-dismiss="modal">Edit</button>
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
                <h4 class="modal-title">Delete Admin</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="" id="sekretariatAdminsDelete">
                    @method("DELETE")
                    @csrf
                    <p>Apakah anda yakin untuk delete admin ini?</p>
                </form>
            </div>
            <div class="modal-footer">
                <button form="sekretariatAdminsDelete" type="submit" class="btn btn-primary" data-bs-dismiss="modal">Delete</button>
            </div>
        </div>
    </div>
</div>
{{-- END OF MODAL DELETE --}}



@endsection

@section('script')
<script>
    function getAdminDataToDelete(id){
        $("#sekretariatAdminsDelete").attr("action", "{{ route('sekretariat.admins.index') }}/"+id)
    }

    // To fill the EDIT data
    function getAdminDataToEdit(id) {
        $("#sekretariatAdminsUpdate").attr("action", "{{ route('sekretariat.admins.index') }}/"+id)
    }
</script>
@endsection