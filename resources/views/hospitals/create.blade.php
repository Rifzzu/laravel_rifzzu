@extends('layouts.app')

@section('content')
<h5>Tambah Rumah Sakit</h5>
<form method="POST" action="{{ route('hospitals.store') }}" class="mt-3">
    @csrf
    <div class="mb-3">
        <label class="form-label">Nama Rumah Sakit</label>
        <input type="text" name="nama_rumah_sakit" value="{{ old('nama_rumah_sakit') }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Alamat</label>
        <input type="text" name="alamat" value="{{ old('alamat') }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Telepon</label>
        <input type="text" name="telepon" value="{{ old('telepon') }}" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('hospitals.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection