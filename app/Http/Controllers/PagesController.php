<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use Illuminate\Support\Facades\DB;


class PagesController extends Controller
{
    
    
    
    public function index() {

      
          return view('pages.home', [
            'data_pegawai' => Pegawai::all()
           ]);

         }


         public function detail($id)
         {

            $x = Pegawai::find($id);
     
             if(!$x){
     
                 abort(404);
     
             }
     
             $detail = [
                 'pegawai' => $x,
             ];
     
             return view('pages.detail_pegawai', $detail);
     
         }



         public function tambah()
         {
            return view('pages.tambah');
         }

         public function insert(Request $request)
         {
             
            Request()->validate([
                'nama_pegawai' => 'required',
                'alamat' => 'required',
                'gender' => 'required',
            ],[
                'nama_pegawai.required' => 'Nama Wajib Diisi !!!',
                'alamat.required' => 'Alamat Wajib Diisi !!!',
                'gender.required' => 'Gender Wajib Diisi !!!',
            ]);
    
     
     
            Pegawai::create([
                'nama' => request('nama_pegawai'),
                'alamat' => request('alamat'),
                'gender' => request('gender')
            ]);
     
        return redirect('/home')->with('Pesan', 'Data Sukses Dikirim');
     
         }



         public function edit($id)
    {

        $x = DB::table('pegawai')->where('id', $id)->first();


        if(!$x){

        abort(404);

        }

        $data = [
            'pegawai' => $x,
        ];

        return view('pages.edit', $data);
        
    }



    public function update($id, Request $request)
    {
        
        Request()->validate([
            'nama_pegawai' => 'required',
            'alamat' => 'required',
            'gender' => 'required',
        ],[
            'nama_pegawai.required' => 'Nama Wajib Diisi !!!',
            'alamat.required' => 'Alamat Wajib Diisi !!!',
            'gender.required' => 'Gender Wajib Diisi !!!',
        ]);


        $santri = Pegawai::where('id', $id)
             ->update([
                    'nama' => $request->nama_pegawai,
                    'alamat' => $request->alamat,
                    'gender' => $request->gender
             ]);


        return redirect('/home')->with('Pesan', 'Data Sukses Diedit');
    }


         public function hapus($id){

            $x = Pegawai::find($id);
            $x->delete();
            return redirect('/')->with('Pesan', 'Data Sukses Dihapus');

         }



}
