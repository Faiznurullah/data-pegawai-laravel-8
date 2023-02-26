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
            <table id="tabel-data" class="table table-bordered yajra-datatable"  width="100%">
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

                  

                </tbody>
              </table>
              
        </div>
        </div>
      </div>
 </div>


 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(function () {
          
          var table = $('.yajra-datatable').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('index') }}",
              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data: 'nama', name: 'nama'},
                  {data: 'alamat', name: 'alamat'},
                  {data: 'gender', name: 'gender'}, 
                  {
                      data: 'action', 
                      name: 'action', 
                      orderable: true, 
                      searchable: true
                  },
              ]
          });
          
        });
    </script>

@endsection
