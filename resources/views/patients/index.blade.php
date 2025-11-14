@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5>Data Pasien</h5>
    <a class="btn btn-primary" href="{{ route('patients.create') }}">Tambah</a>
 </div>

<div class="row mb-3">
    <div class="col-md-4">
        <label class="form-label">Filter Rumah Sakit</label>
        <select id="filter-hospital" class="form-select">
            <option value="">Semua</option>
            @foreach($hospitals as $rs)
                <option value="{{ $rs->id }}">{{ $rs->nama_rumah_sakit }}</option>
            @endforeach
        </select>
    </div>
 </div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Pasien</th>
            <th>Alamat</th>
            <th>No Telepon</th>
            <th>Rumah Sakit</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody id="patient-table-body">
    @foreach($patients as $p)
        <tr data-id="{{ $p->id }}">
            <td>{{ $p->id }}</td>
            <td>{{ $p->nama_pasien }}</td>
            <td>{{ $p->alamat }}</td>
            <td>{{ $p->no_telepon }}</td>
            <td>{{ $p->hospital->nama_rumah_sakit ?? '' }}</td>
            <td>
                <a class="btn btn-sm btn-warning" href="{{ route('patients.edit', $p) }}">Edit</a>
                <button class="btn btn-sm btn-danger btn-delete" data-url="{{ route('patients.destroy', $p) }}">Hapus</button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $patients->links() }}
@endsection

@push('scripts')
<script>
function renderPatients(rows){
    const tbody = $('#patient-table-body');
    tbody.empty();
    rows.forEach(function(p){
        const tr = `
            <tr data-id="${p.id}">
                <td>${p.id}</td>
                <td>${p.nama_pasien}</td>
                <td>${p.alamat}</td>
                <td>${p.no_telepon}</td>
                <td>${p.hospital ? p.hospital.nama_rumah_sakit : ''}</td>
                <td>
                    <a class="btn btn-sm btn-warning" href="/patients/${p.id}/edit">Edit</a>
                    <button class="btn btn-sm btn-danger btn-delete" data-url="/patients/${p.id}">Hapus</button>
                </td>
            </tr>
        `;
        tbody.append(tr);
    });
}

$(function(){
    $('#patient-table-body').on('click','.btn-delete',function(){
        const url = $(this).data('url');
        const row = $(this).closest('tr');
        $.ajax({
            url: url,
            type: 'POST',
            data: { _method: 'DELETE' },
            success: function(){ row.remove(); },
        });
    });

    $('#filter-hospital').on('change', function(){
        const hospitalId = $(this).val();
        $.getJSON('/patients/filter', { hospital_id: hospitalId }, function(data){
            renderPatients(data);
        });
    });
});
</script>
@endpush