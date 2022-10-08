@extends('soal.layouts.app', ['pageActive' => 'soal.mc.index', 'pageTitle' => 'Multiple Choice Questions'])

@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">Soal</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('soal.index')}}">Soal</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('soal.mc.index') }}">Multiple Choice</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('soal.mc.show', $contest->id) }}">{{ $contest->nama }}</a></li>
                        <li class="breadcrumb-item active">Edit Question</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <div class="card">
        <div class="card-body">
            <p>Edit soal untuk {{ $contest->nama }} nomor {{ $question->nomor }}</p>

            <form method="post" action="{{ route('soal.mc.question.update', ['contest' => $contest->id, 'question' => $question->id]) }}">
                @csrf
                <div class="form-control mb-1">
                    <label for="nomor" class="form-label">Nomor</label>
                    <div class="input-group input-group-lg bootstrap-touchspin">
                        <input id="nomor" name="nomor" type="number" class="touchspin form-control" value={{ $question->nomor }}>
                    </div>
                </div>
                <div class="form-control mb-1">
                    <label for="soal" class="form-label">Isi</label>
                    <textarea id="soal" name="isi">{!! $question->isi !!}</textarea>
                </div>
                <div class="form-control mb-1">
                    <label for="jawaban_benar" class="form-label">Jawaban Benar</label>
                    <select class="select form-select" tabindex="-1" aria-hidden="true" name="jawaban_benar" id="jawaban_benar" style="width: 20%">
                        <option selected disabled>-- Pilih Jawaban Benar --</option>
                        <option value="a" data-select2-id="a" {{ $question->jawaban_benar =="a" ? 'selected' :''}}>A</option>
                        <option value="b" data-select2-id="b" {{ $question->jawaban_benar =="b" ? 'selected' :''}}>B</option>
                        <option value="c" data-select2-id="c" {{ $question->jawaban_benar =="c" ? 'selected' :''}}>C</option>
                        <option value="d" data-select2-id="d" {{ $question->jawaban_benar =="d" ? 'selected' :''}}>D</option>
                        <option value="e" data-select2-id="e" {{ $question->jawaban_benar =="e" ? 'selected' :''}}>E</option>
                    </select>
                </div>
                @foreach ($choices as $choice)
                    <div class="input-group input-group-merge mb-1">
                        <span class="input-group-text" style='background: #6e6b7b ;'><label for="isi_{{ $choice->abjad }}" class='text-white'>{{ $choice->abjad }}</label></span>
                        <input value="{{ $choice->isi }}" type="text" class="form-control ps-2" id='isi_{{ $choice->abjad }}' name='isi_{{ $choice->abjad }}'>
                    </div>
                @endforeach
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