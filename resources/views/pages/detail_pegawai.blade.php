@extends('template.main')
@section('title', 'Detail Pegawai')
@section('konten')

 <div class="container justify-content-center mt-5">
    <div class="card">
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                    <p>Nama: {{ $pegawai->nama }}</p>
                    <p>Alamat: {{ $pegawai->alamat }}</p>   
                    <p>Jenis Kelamin: {{ $pegawai->gender }}</p>
                    <p><a  href="/" type="button" class="btn btn-info btn-sm text-white">Kembali</a></p>
                    </div>
                </div>
            </div>
        </div>
      </div>
 </div>


@endsection
