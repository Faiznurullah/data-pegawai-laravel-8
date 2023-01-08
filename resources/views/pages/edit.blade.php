@extends('template.main')
@section('title', 'Edit Data')
@section('konten')

 <div class="container justify-content-center mt-5">
    <div class="card">
        <div class="card-body">

           <form action="/update/{{ $pegawai->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

              <div class="container">
                  <div class="row">
                      <div class="col-md-6">
                          <label for="exampleFormControlInput1" class="form-label">Nama Pegawai</label>
                          <input type="text" value="{{ $pegawai->nama }}" class="form-control  @error('nama_pegawai') is-invalid @enderror is-valid" name="nama_pegawai" id="exampleFormControlInput1" placeholder="Nama Pegawai">
                          <div class="valid-feedback">
                            @error('nama_pegawai')
                 <div class="alert alert-danger">{{ $message }}</div>
                         @enderror
                          </div>
                        </div>
                      <div class="col-md-6">
                        <label for="exampleFormControlInput1" class="form-label">Jenis Kelamin</label>
                        <select class="form-select @error('gender') is-invalid @enderror is-valid" value="{{ old('gender') }}" name="gender" aria-label="Default select example" required>
                          <option selected>Jenis Kelamin</option>
                          <option value="laki-laki">Laki-laki</option>
                          <option value="perempuan">Perempuan</option>
                        </select>
                        <div class="valid-feedback">
                          @error('gender')
              <div class="alert alert-danger">{{ $message }}</div>
                       @enderror
                        </div>
                      </div>
                  </div>
               <div class="row mt-5">
                <div class="col-md-6">
                    <label for="floatingTextarea2">ALamat</label>
                    <textarea class="form-control @error('alamat') is-invalid @enderror is-valid" value="{{ $pegawai->alamat }}" name="alamat" placeholder="Alamat Pegawai" id="floatingTextarea2" style="height: 100px"></textarea>
                    <div class="valid-feedback">
                      @error('alamat')
          <div class="alert alert-danger">{{ $message }}</div>
                   @enderror
                    </div>
                  </div>
                
                <div class="col-md-6 mt-5">
                  <button type="submit" class="btn btn-primary">Kirim</button>
                  <a href="/" type="button" class="btn btn-danger">Kembali</a>
                </div>
              </div>
                   </div>
               </div>
           </form>

        </div>
      </div>
 </div>


@endsection
