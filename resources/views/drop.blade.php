@extends('layout.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Dashboard')
@section('content')

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Dokumen Pendukung (KTP dan lain-lain)</h5>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Nama Pegawai</label>
                            <div class="col-sm-10">
                                <select name="employe_id">
                                    <option value="">Pilih Employe</option>
                                    @foreach ($employes as $employe)
                                        <option value="{{ $employe->id }}">{{ $employe->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Link Pendukung</label>
                            <div class="col-sm-10">
                                <form action="{{ route('dropzone.store') }}" method="post" enctype="multipart/form-data"
                                    id="image-upload" class="dropzone">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

@endsection
<script type="text/javascript">
    var dropzone = new Dropzone('#image-upload', {
        thumbnailWidth: 200,
        maxFilesize: 1,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
    });
</script>
