@extends('layouts.app')

@section('content')
<h5>Edit Pasien</h5>
<form method="POST" action="{{ route('patients.update', $patient) }}" class="mt-3">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">Nama Pasien</label>
        <input type="text" name="nama_pasien" value="{{ old('nama_pasien', $patient->nama_pasien) }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Alamat</label>
        <input type="text" name="alamat" value="{{ old('alamat', $patient->alamat) }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">No Telepon</label>
        <input type="text" name="no_telepon" value="{{ old('no_telepon', $patient->no_telepon) }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Rumah Sakit</label>
        <select name="hospital_id" class="form-select" required>
            @foreach($hospitals as $rs)
                <option value="{{ $rs->id }}" @selected(old('hospital_id', $patient->hospital_id) == $rs->id)>{{ $rs->nama_rumah_sakit }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('patients.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection