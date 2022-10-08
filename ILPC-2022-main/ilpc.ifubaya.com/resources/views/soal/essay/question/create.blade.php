@extends('soal.layouts.app', ['pageActive' => 'soal.essay.index', 'pageTitle' => 'Essay Questions'])

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Soal</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('soal.index')}}">Soal</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('soal.essay.index') }}">Essay</a>
                        </li>
                        <li class="breadcrumb-item active"><a href="{{ route('soal.essay.show',$contest->id) }}">{{ $contest->nama }}</a>
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

            <form method="post" action="{{ route('soal.essay.question.store', $contest->id) }}">
                @csrf
                <div class="form-control mb-1">
                    <label for="nomor" class="form-label">Nomor</label>
                    <div class="input-group input-group-lg bootstrap-touchspin">
                        <input id="nomor" name="nomor" type="number" class="touchspin form-control" value="1">
                    </div>
                </div>
                <div class="form-control mb-1">
                    <label for="soal" class="form-label">Isi</label>
                    <textarea id="soal" name="isi"></textarea>
                </div>
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
            paste_data_images: true
        });
</script>
@endsection