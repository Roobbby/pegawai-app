@extends('layout.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Dashboard')
@section('content')
    <div class="pagetitle">
        <h1>Data Pegawai</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Data Pegawai</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    @include('layout.alert')

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Pegawai</h5>

                        <!-- Button Tambah Pegawai -->
                        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                            data-bs-target="#modalCreate">
                            Tambah Pegawai
                        </button>

                        <!-- Tabel Data Pegawai -->
                        <table class="table datatable table-responsive">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Foto</th>
                                    <th>Email</th>
                                    <th>Posisi</th>
                                    <th>Gender</th>
                                    <th>Telepon</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Alamat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($employes as $index => $employe)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ Str::limit($employe->name, 15, '...') }}</td>
                                        <td>
                                            @if ($employe->photo)
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#modalPhoto-{{ $employe->id }}">
                                                    <img src="images/{{ $employe->photo }}" alt="{{ $employe->name }}"
                                                        class="rounded" width="100" height="70">
                                                </a>
                                            @else
                                                Tidak Ada Foto
                                            @endif
                                        </td>
                                        <td>
                                            <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $employe->email }}"
                                                target="_blank">
                                                {{ Str::limit($employe->email, 10, '...') }}
                                            </a>
                                        </td>
                                        <td>{{ Str::limit($employe->position, 15, '...') }}</td>
                                        <td>{{ $employe->gender == '0' ? 'Laki-Laki' : 'Perempuan' }}</td>
                                        <td>{{ Str::limit($employe->phone, 15, '...') }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($employe->born)->format('d m Y') }}
                                            <br>
                                            <b>({{ \Carbon\Carbon::parse($employe->born)->diffInYears(\Carbon\Carbon::now()) }}
                                                tahun)</b>
                                        </td>
                                        <td>{{ Str::limit($employe->address, 15, '...') }}</td>
                                        <td>
                                            <div class="d-flex gap-2 justify-content-center">
                                                <button type="button" class="btn btn-info btn-sm w-100"
                                                    data-bs-toggle="modal" data-bs-target="#modalShow-{{ $employe->id }}">
                                                    Detail
                                                </button>
                                                <button type="button" class="btn btn-warning btn-sm w-100"
                                                    data-bs-toggle="modal" data-bs-target="#modalEdit-{{ $employe->id }}">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm w-100"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalDelete-{{ $employe->id }}">
                                                    Hapus
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">Data Pegawai Kosong</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table><!-- End Tabel -->
                        @foreach ($employes as $employe)
                            {{-- modal show --}}
                            <div class="modal fade" id="modalShow-{{ $employe->id }}" tabindex="-1"
                                aria-labelledby="modalShowLabel-{{ $employe->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalShowLabel-{{ $employe->id }}">Detail Pegawai
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Nama</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ $employe->name ?? 'Tidak tersedia' }}" disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    value="{{ $employe->email ?? 'Tidak tersedia' }}" disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label for="position" class="form-label">Posisi</label>
                                                <input type="text" class="form-control" id="position" name="position"
                                                    value="{{ $employe->position ?? 'Tidak tersedia' }}" disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label for="gender" class="form-label">Gender</label>
                                                <select class="form-select" id="gender" name="gender" disabled>
                                                    <option value="0"
                                                        {{ isset($employe) && $employe->gender == '0' ? 'selected' : '' }}>
                                                        Laki-Laki</option>
                                                    <option value="1"
                                                        {{ isset($employe) && $employe->gender == '1' ? 'selected' : '' }}>
                                                        Perempuan</option>
                                                    <option {{ empty($employe->gender) ? 'selected' : '' }}>Tidak tersedia
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Telepon</label>
                                                <input type="text" class="form-control" id="phone" name="phone"
                                                    value="{{ $employe->phone ?? 'Tidak tersedia' }}" disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label for="born" class="form-label">Tanggal Lahir</label>
                                                <input type="date" class="form-control" id="born" name="born"
                                                    value="{{ $employe->born ?? '' }}" disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label for="photo" class="form-label">Foto</label>
                                                @if (!empty($employe->photo) && file_exists(public_path('images/' . $employe->photo)))
                                                    <img src="images/{{ $employe->photo }}" alt="Foto Pegawai"
                                                        class="img-fluid" width="100px">
                                                @else
                                                    <p>Tidak ada foto tersedia.</p>
                                                @endif
                                            </div>

                                            <div class="mb-3">
                                                <label for="address" class="form-label">Alamat</label>
                                                <textarea class="form-control" id="address" name="address" rows="3" disabled>{{ $employe->address ?? 'Tidak tersedia' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- modal edit --}}
                            <div class="modal fade" id="modalEdit-{{ $employe->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Pegawai</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('employe.update', $employe->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Nama</label>
                                                    <input type="text" class="form-control" id="name"
                                                        name="name" value="{{ $employe->name }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email"
                                                        name="email" value="{{ $employe->email }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="position" class="form-label">Posisi</label>
                                                    <input type="text" class="form-control" id="position"
                                                        name="position" value="{{ $employe->position }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="gender" class="form-label">Gender</label>
                                                    <select class="form-select" id="gender" name="gender">
                                                        <option value="0"
                                                            {{ $employe->gender == '0' ? 'selected' : '' }}>Laki-Laki
                                                        </option>
                                                        <option value="1"
                                                            {{ $employe->gender == '1' ? 'selected' : '' }}>Perempuan
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="phone" class="form-label">Telepon</label>
                                                    <input type="text" class="form-control" id="phone"
                                                        name="phone" value="{{ $employe->phone }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="born" class="form-label">Tanggal Lahir</label>
                                                    <input type="date" class="form-control" id="born"
                                                        name="born" value="{{ $employe->born }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="photo" class="form-label">Foto</label>
                                                    <input type="file" class="form-control" id="photo"
                                                        name="photo">
                                                    @if ($employe->photo)
                                                        <img src="images/{{ $employe->photo }}" alt="current-photo"
                                                            width="100px">
                                                    @endif
                                                </div>
                                                <div class="mb-3">
                                                    <label for="address" class="form-label">Alamat</label>
                                                    <textarea class="form-control" id="address" name="address" rows="3">{{ $employe->address }}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- modal hapus --}}
                            <div class="modal fade" id="modalDelete-{{ $employe->id }}" tabindex="-1"
                                aria-labelledby="modalDeleteLabel-{{ $employe->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalDeleteLabel-{{ $employe->id }}">Konfirmasi
                                                Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus data pegawai bernama
                                            <strong>{{ $employe->name }}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('employe.destroy', $employe->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- modal foto --}}
                            <div class="modal fade" id="modalPhoto-{{ $employe->id }}" tabindex="-1"
                                aria-labelledby="modalPhotoLabel-{{ $employe->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalPhotoLabel-{{ $employe->id }}">Foto Pegawai
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="images/{{ $employe->photo }}" alt="{{ $employe->name }}"
                                                class="img-fluid">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{-- modal tambah --}}
                        <div class="modal fade" id="modalCreate" tabindex="-1">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tambah Pegawai</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('employe.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Nama</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="position" class="form-label">Posisi</label>
                                                <input type="text" class="form-control" id="position"
                                                    name="position" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="gender" class="form-label">Gender</label>
                                                <select class="form-select" id="gender" name="gender" required>
                                                    <option value="0">Laki-Laki</option>
                                                    <option value="1">Perempuan</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Telepon</label>
                                                <input type="text" class="form-control" id="phone" name="phone"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="born" class="form-label">Tanggal Lahir</label>
                                                <input type="date" class="form-control" id="born" name="born"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="photo" class="form-label">Foto</label>
                                                <input type="file" class="form-control" id="photo"
                                                    name="photo">
                                            </div>
                                            <div class="mb-3">
                                                <label for="address" class="form-label">Alamat</label>
                                                <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

