@extends('template.main')
@section('title', 'Home')
@section('konten')

 <div class="container justify-content-center mt-5 mb-5">
    <div class="card">
        <div class="card-body">
          
          @if (session('Pesan'))
         <div class="alert alert-success" role="alert">
             {{ session('Pesan') }}.
          </div>  
         @endif
            <h5 class="card-title">Aplikasi Pegawai</h5>
            <div class="row">
              <div class="col">
                <a href="/tambah" type="button" class="btn btn-primary btn-sm">Tambah Data +</a>
                <a href="/downloadpdf" type="button" class="btn btn-danger text-white btn-sm">Download PDF <i class="bi bi-file-earmark-arrow-down"></i></a>
              </div>
            </div>
           

            <div class="table-responsive mt-4">
            <table id="tabel-data" class="table table-bordered" id="dataTable" width="100%" >
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Gender</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>

                  <?php $no = 1; ?>          
                  @foreach($data_pegawai as $row)
                               <tr>
                                   <td>{{ $no++ }}</td>
                                   <td>{{ $row->nama }}</td>
                                   <td>{{ $row->alamat }}</td>
                                   <td>{{ $row->gender }}</td>
                                   <td>
                                       <a href="/edit/{{ $row->id }}" type="button" class="btn btn-info text-white btn-sm mt-2">Ubah</a>
                                       <a href="/detail/{{ $row->id }}" type="button" class="btn btn-warning text-white btn-sm mt-2">detail</a>
                                       <a href="/hapus/{{ $row->id }}" type="button" class="btn btn-danger btn-sm mt-2" onclick = "return confirm('Yakin Data Akan Dihapus');">Hapus</a>
                                   </td>
                               </tr>
                @endforeach

                </tbody>
              </table>
              
        </div>
        </div>
      </div>
 </div>


@endsection
