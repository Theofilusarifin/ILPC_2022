@extends('soal.layouts.app', ['pageActive' => 'soal.prg.index', 'pageTitle' => 'Programming Questions'])

@section('style')
<style>
    input[type=file] {
        text-indent: -100px;
    }
</style>
@endsection

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Soal</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('soal.index')}}">Soal</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('soal.prg.index') }}">Programming</a>
                        </li>
                        <li class="breadcrumb-item active"><a href="{{ route('soal.prg.show',$contest->id) }}">{{ $contest->nama }}</a>
                        </li>
                        <li class="breadcrumb-item active">Question</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <div class="card">
        <div class="card-body">
            <p>Tambah soal untuk {{ $contest->nama }}</p>

            <form method="post" action="{{ route('soal.prg.question.store', $contest->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="form-control mb-1">
                    <label for="nomor" class="form-label">Nomor</label>
                    <div class="input-group input-group-lg bootstrap-touchspin">
                        <input id="nomor" name="nomor" type="number" class="touchspin form-control" value="1">
                    </div>
                </div>

                <div class="form-control mb-1">
                    <label for="judul" class="form-label">Judul</label>
                    <input type='text' id="judul" class='form-control' name="judul" />
                </div>

                <div class="form-control mb-1">
                    <label for="time_limit" class="form-label">Time Limit</label>
                    <div class="input-group input-group-lg bootstrap-touchspin">
                        <input id="time_limit" name="time_limit" type="number" class="touchspin form-control" value="1" data-bts-step="1" data-bts-decimals="0">
                    </div>
                </div>

                <div class="form-control mb-1">
                    <label for="soal" class="form-label">Isi</label>
                    <textarea id="soal" name="isi"></textarea>
                </div>


                <div class="form-control mb-1">
                    <label for="input_file" class="form-label">Upload Input File (.in)</label>
                    <br>
                    <a class="btn btn-outline-primary waves-effect">
                        <input type="file" name="input_file" id="input_file">
                    </a>
                </div>

                <div class="form-control mb-1">
                    <label for="output_file" class="form-label">Upload Output File (.out)</label>
                    <br>
                    <a class="btn btn-outline-primary waves-effect">
                        <input type="file" name="output_file" id="output_file">
                    </a>
                </div>

                {{-- <div class="form-control mb-1">
                    <a id="clear-dropzone" class="btn btn-outline-primary mb-1 waves-effect">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash me-25"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                        <span class="align-middle">Clear All Files</span>
                    </a>

                    <div action="#" class="dropzone dropzone-area dz-clickable mb-3" id="dpz-remove-all-thumb">
                        <div class="dz-message">Drop Input File (.out) here or click to upload.</div>
                    </div>

                    <div action="#" class="dropzone dropzone-area dz-clickable" id="dpz-remove-thumb">
                        <div class="dz-message">Drop Ouput File (.out) here or click to upload.</div>
                    </div>
                </div> --}}

                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('js') }}/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({
            selector: '#soal',
            toolbar1: 'newdocument | undo | redo | bold | italic | underline | strikethrough | alignleft | aligncenter | alignright | alignjustify |  fontselect | fontsizeselect ',
            toolbar2: 'cut | copy | paste | bullist | numlist | outdent | indent | blockquote | removeformat | subscript | superscript',
            relative_urls : false,
            document_base_url : '{{ asset('.') }}',
            paste_data_images: true,
            plugins: 'autoresize'
        });
</script>
@endsection