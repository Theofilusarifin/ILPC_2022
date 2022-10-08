<div class="divider my-2">
    <div class="divider-text">Data {{ str_replace("_", " ", ucfirst($status)) }}</div>
</div>
<div class="row mb-1">
    <!-- Nama -->
    <div class="col-9 pe-0">
        <label for="{{ $status }}_nama" class="form-label">Nama {{ str_replace("_", " ", ucfirst($status)) }}</label>
        <input type="text" class="form-control @error($status.'_nama') is-invalid @enderror" name="{{ $status }}_nama"
            value="{{ old($status.'_nama') }}" id="{{ $status }}_nama" placeholder="Nama {{ str_replace(" _", " " ,
            ucfirst($status)) }}" aria-describedby="{{ $status }}_nama" tabindex="1" autofocus />
        @error("${status}_nama")
        <span class="text-danger" role="alert">
            <small>{{ "This field is required" }}</small>
        </span>
        @enderror
    </div>
    <!-- Kelas -->
    <div class="col-3">
        <label for="{{ $status }}_kelas" class="form-label">Kelas</label>
        <select name="{{ $status }}_kelas" class="form-select" @error($status.'_kelas') is-invalid @enderror
            tabindex="-1" aria-hidden="true">
            <option selected value="X">X</option>
            <option value="XI">XI</option>
            <option value="XII">XII</option>
        </select>

        @error("${status}_kelas")
        <span class="text-danger" role="alert">
            <small>{{ "This field is required" }}</small>
        </span>
        @enderror
    </div>
</div>

<div class="row mb-2">
    <!-- Nomor Telp -->
    <div class="col-5">
        <label for="{{ $status }}_telp" class="form-label">Nomor HP</label>
        <input type="text" class="form-control @error($status.'_telp')) is-invalid @enderror"
            name="{{ $status }}_telp" value="{{ old($status.'_telp') }}" id="{{ $status }}_telp" placeholder="Nomor HP"
            aria-describedby="{{ $status }}_telp" tabindex="1" autofocus />
        @error("${status}_telp")
        <span class="text-danger" role="alert">
            <small>{{ "This field is required" }}</small>
        </span>
        @enderror
    </div>
    <!-- Email -->
    <div class="col-7 ps-0">
        <label for="{{ $status }}_email" class="form-label">Email</label>
        <input type="text" class="form-control @error($status.'_email')) is-invalid @enderror"
            name="{{ $status }}_email" value="{{ old($status.'_email') }}" id="{{ $status }}_email" placeholder="Email"
            aria-describedby="{{ $status }}_email" tabindex="1" autofocus />
        @error("${status}_email")
        <span class="text-danger" role="alert">
            <small>{{ "This field is required" }}</small>
        </span>
        @enderror
    </div>
</div>

<div>
    <label for="{{ $status }}_email" class="form-label">Foto Kartu Pelajar (max: 10mb, type: png/jpeg/jpg)</label>
    <input type="file" id="{{ $status }}_foto_upload" name="{{ $status }}_foto_upload"
        style="display: none;" onchange="loadFile('{{ $status }}_image', event)">
    <label for="{{ $status }}_foto_upload" class="btn btn-outline-primary mb-1 waves-effect dz-clickable"
        style="cursor: pointer; width: 100%;">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-file">
            <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
            <polyline points="13 2 13 9 20 9"></polyline>
        </svg> Foto/Scan Kartu Pelajar
    </label>
    @error("${status}_foto_upload")
    <p class="text-danger" role="alert">
        <small>{{ $message }}</small>
    </p>
    @enderror
    <p class="py-0 my-0"><img id="{{ $status }}_image" width="100%" /></p>
</div>