@extends('mahasiswa.layout')

@section('content')
<div class="row">
  <div class="col-lg-12 margin-tb">
    <div class="pull-left mt-2">
      <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
      <h2>KARTU HASIL STUDI (KHS)</h2>
    </div>
    <div class="float-right my-2">
      <a class="btn btn-success" href="{{ route('mahasiswa.create') }}"> Input Mahasiswa</a>
    </div>
  </div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif
@if ($message = Session::get('error'))
<div class="alert alert-error">
  <p>{{ $message }}</p>
</div>
@endif

Nama    : Aida Millati Mardiana
NIM     : 2041720071
Kelas   : TI 2H

<table class="table table-bordered">
  <tr>
    <th>Mata Kuliah</th>
    <th>SKS</th>
    <th>Semester</th>
    <th>Nilai</th>
    <th width="280px">Action</th>
  </tr>
  @if(!empty($paginate) && $paginate->count())
    @foreach($paginate as $mhs)
      <tr>
        <td>{{ $mhs->mata_kuliah }}</td>
        <td>{{ $mhs->sks }}</td>
        <td>{{ $mhs->semester }}</td>
        <td>{{ $mhs->nilai }}</td>
      </tr>
    @endforeach
  @else
    <tr>
      <td colspan="10">There are no data.</td>
    </tr>
  @endif
</table>

{!! $paginate->links() !!}

@endsection