<?php

namespace App\Http\Controllers;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class PagesController extends Controller
{
    
     
    public function index(Request $request) {

        if ($request->ajax()) {
            $data = Pegawai::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                         $url_edit = url('edit/'.$row->id);
                         $url_detail = url('detail/'.$row->id);
                         $url_hapus = url('hapus/'.$row->id);

                    $actionBtn = '<a href="'.$url_edit.'" class="edit btn btn-success btn-sm">Edit</a>
                    <a href="'.$url_detail.'" class="edit btn btn-info text-white btn-sm">detail</a>
                    <a href="'.$url_hapus.'" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    
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
     
        return redirect('/')->with('Pesan', 'Data Sukses Dikirim');
     
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


        return redirect('/')->with('Pesan', 'Data Sukses Diedit');
    }


         public function hapus($id){

            $x = Pegawai::find($id);
            $x->delete();
            return redirect('/')->with('Pesan', 'Data Sukses Dihapus');

         }



}
