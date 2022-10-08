@extends('soal.layouts.app', ['pageActive' => 'acara.gambes.item.index', 'pageTitle' => 'Game Besar'])

@section('content')
<style>
    input[type=file] {
        text-indent: -100px;
    }
</style>

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Semifinal</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Game Besar</li>
                        <li class="breadcrumb-item active">List of Items</li>
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
                            Di sini, anda dapat menambah dan melakukan pengaturan item pada Game Besar. <br>
                            Untuk membuat Item Gambes baru, anda dapat menekan tombol <i class="text-success" data-feather="plus-square"></i> di ujung kanan pada tabel.<br>
                            Untuk melakukan edit Item Gambes, anda dapat menekan tombol <i class="text-warning" data-feather="edit"></i> pada Item yang diinginkan.<br>
                            Untuk menghapus Item Gambes, anda dapat menekan tombol <i class="text-danger" data-feather="trash-2"></i> pada Item yang diinginkan.
                            <br>
                            <div class="badge badge-light-primary">
                                Teliti kembali setiap Item Gambes yang telah anda buat atau ubah.
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
            {{-- List of Items --}}
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List of Items</h4>
                </div>
                <div class="card-body">
                    @include('layouts.alert')
                </div>
        
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-2">
                        <tr>
                            <th width="20%">Image</th>
                            <th width="15%">Type</th>
                            <th width="20">Name</th>
                            <th width="20">Price</th>
                            <th width="10">Heal</th>
                            <th width="10">Attack</th>
                            <th width="5">Durability</th>
                            <th width="5%" class="text-center">
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal" style="max-width:100%;">
                                    <i data-feather="plus-square"></i>
                                </button>
                            </th>
                        </tr>
                        @if($items)
                        @foreach ($items as $item)
                        <tr>
                            <td>
                                <img class="img-fluid rounded" style="max-height:100px" role="button" src="{{ asset('/').$item->image_path }}">                  
                            </td>
                            <td>{{ $item->type }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->price }}</td>
                            <td>{{ $item->heal }}</td>
                            <td>{{ $item->attack }}</td>
                            <td>{{ $item->durability }}</td>
                            <td width="5%" class="text-center">
                                <button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editItemModal_{{ $item->id }}" onclick="getItemUpdate({{ $item->id }})" style="max-width:100%;">
                                    <i data-feather="edit"></i></button>
                                <button class="btn btn-outline-danger mt-1" data-bs-toggle="modal" data-bs-target="#deleteItemModal" onclick="getItemDelete({{ $item->id }})" style="max-width:100%;">
                                    <i data-feather="trash-2"></i></button>
                            </td>
                        </tr>
                        {{-- MODAL EDIT --}}
                        <div class="modal fade" id="editItemModal_{{ $item->id }}" tabindex="-1" aria-labelledby="editItemModal" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Item</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{ route('acara.gambes.item.update', $item->id) }}" id="acaraItemUpdate_{{ $item->id }}" enctype="multipart/form-data">
                                            @csrf
                        
                                            {{-- Type --}}
                                            <div class="mb-1">
                                                <label for="edit_type_{{ $item->id }}" class="form-label">Type</label>
                                                <select id="edit_type_{{ $item->id }}" class="form-select" tabindex="-1" aria-hidden="true" name="type">
                                                    <option value="weapon" {{ $item->type == 'weapon' ? 'selected' : "" }}>Weapon</option>
                                                    <option value="potion" {{ $item->type == 'potion' ? 'selected' : "" }}>Potion</option>
                                                    <option value="attribute" {{ $item->type == 'attribute' ? 'selected' : "" }}>Attribute</option>
                                                    <option value="shield" {{ $item->type == 'shield' ? 'selected' : "" }}>Shield</option>
                                                </select>
                                            </div>
                
                                            {{-- Name --}}
                                            <div class="mb-1">
                                                <label class="form-label" for="edit_name_{{ $item->id }}">Name</label>
                                                <input type="text" id="edit_name_{{ $item->id }}" name="name" class="form-control" placeholder="Name" value="{{ old('name') ?? $item->name }}"/>
                                            </div>
                
                                            {{-- Price --}}
                                            <div class="mb-1">
                                                <label class="form-label" for="edit_price_{{ $item->id }}">Price</label>
                                                <input type="text" id="edit_price_{{ $item->id }}" name="price" class="form-control" placeholder="Price" value="{{ old('price') ?? $item->price }}" />
                                            </div>
                
                                            {{-- Health --}}
                                            <div class="mb-1">
                                                <label class="form-label" for="edit_heal_{{ $item->id }}">Heal</label>
                                                <input type="text" id="edit_heal_{{ $item->id }}" name="heal" class="form-control" placeholder="Heal" value="{{ old('heal') ?? $item->heal }}" />
                                            </div>
                
                                            {{-- Attack --}}
                                            <div class="mb-1">
                                                <label class="form-label" for="edit_attack_{{ $item->id }}">Attack</label>
                                                <input type="text" id="edit_attack_{{ $item->id }}" name="attack" class="form-control" placeholder="Attack" value="{{ old('attack') ?? $item->attack }}" />
                                            </div>
                
                                            {{-- Jadwal Durability --}}
                                            <div class="mb-1">
                                                <label class="form-label" for="edit_durability_{{ $item->id }}">Durability</label>
                                                <input type="text" id="edit_durability_{{ $item->id }}" name="durability" class="form-control" placeholder="Durability" value="{{ old('durability') ?? $item->durability }}" />
                                            </div>
                
                                            {{-- Upload Image --}}
                                            <div class="form-control mb-1">
                                                <label for="file_{{ $item->id }}" class="form-label">Upload Image</label>
                                                <br>
                                                <a for="file_{{ $item->id }}" class="btn btn-outline-primary waves-effect">
                                                    <input type="file" name="file" id="file_{{ $item->id }}">
                                                </a>
                                            </div>
                        
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button form="acaraItemUpdate_{{ $item->id }}" type="submit" class="btn btn-primary" data-bs-dismiss="modal">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- END OF MODAL EDIT --}}
                        @endforeach
                        @endif
                    </table>
                </div>
                </div>
            </div>
        </div>

        {{-- MODAL ADD --}}
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addItemModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Item</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('acara.gambes.item.store') }}" id="acaraItemStore" enctype="multipart/form-data">
                            @csrf
        
                            {{-- Type --}}
                            <div class="mb-1">
                                <label for="add_type" class="form-label">Type</label>
                                <select id="add_type" class="select2 form-select" tabindex="-1" aria-hidden="true" name="type">
                                    <option value="weapon">Weapon</option>
                                    <option value="potion">Potion</option>
                                    <option value="attribute">Attribute</option> {{-- -1 --}}
                                    <option value="shield">Shield</option>
                                </select>
                            </div>

                            {{-- Name --}}
                            <div class="mb-1">
                                <label class="form-label" for="add_name">Name</label>
                                <input type="text" id="add_name" name="name" class="form-control" placeholder="Name" />
                            </div>

                            {{-- Price --}}
                            <div class="mb-1">
                                <label class="form-label" for="add_price">Price</label>
                                <input type="text" id="add_price" name="price" class="form-control" placeholder="Price" />
                            </div>

                            {{-- Health --}}
                            <div class="mb-1">
                                <label class="form-label" for="add_heal">Heal</label>
                                <input type="text" id="add_heal" name="heal" class="form-control" placeholder="Heal" />
                            </div>

                            {{-- Attack --}}
                            <div class="mb-1">
                                <label class="form-label" for="add_attack">Attack</label>
                                <input type="text" id="add_attack" name="attack" class="form-control" placeholder="Attack" />
                            </div>

                            {{-- Jadwal Durability --}}
                            <div class="mb-1">
                                <label class="form-label" for="add_durability">Durability</label>
                                <input type="text" id="add_durability" name="durability" class="form-control" placeholder="Durability" />
                            </div>

                            {{-- Upload Image --}}
                            <div class="form-control mb-1">
                                <label for="file" class="form-label">Upload Image</label>
                                <br>
                                <a for="file" class="btn btn-outline-primary waves-effect">
                                    <input type="file" name="file" id="file">
                                </a>
                            </div>
        
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button form="acaraItemStore" type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- END OF MODAL ADD --}}

        {{-- MODAL DELETE --}}
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteItemModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Item</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="" id="acaraItemDelete">
                            @csrf
                            <p>Apakah anda yakin untuk menghapus Item ini?</p>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button form="acaraItemDelete" type="submit" class="btn btn-primary" data-bs-dismiss="modal">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- END OF MODAL DELETE --}}

        @endsection
        
        @section('script')
        
        <script>

            function getItemDelete(id){
                $("#acaraItemDelete").attr("action", "{{ route('acara.gambes.item.index') }}/destroy/"+id)
            }
        </script>          
@endsection