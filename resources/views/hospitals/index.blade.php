@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5>Data Rumah Sakit</h5>
    <a class="btn btn-primary" href="{{ route('hospitals.create') }}">Tambah</a>
 </div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Rumah Sakit</th>
            <th>Alamat</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody id="hospital-table-body">
    @foreach($hospitals as $h)
        <tr data-id="{{ $h->id }}">
            <td>{{ $h->id }}</td>
            <td>{{ $h->nama_rumah_sakit }}</td>
            <td>{{ $h->alamat }}</td>
            <td>{{ $h->email }}</td>
            <td>{{ $h->telepon }}</td>
            <td>
                <a class="btn btn-sm btn-warning" href="{{ route('hospitals.edit', $h) }}">Edit</a>
                <button class="btn btn-sm btn-danger btn-delete" data-url="{{ route('hospitals.destroy', $h) }}">Hapus</button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $hospitals->links() }}
@endsection

@push('scripts')
<script>
$(function(){
    $('#hospital-table-body').on('click','.btn-delete',function(){
        const url = $(this).data('url');
        const row = $(this).closest('tr');
        $.ajax({
            url: url,
            type: 'POST',
            data: { _method: 'DELETE' },
            success: function(){ row.remove(); },
        });
    });
});
</script>
@endpush