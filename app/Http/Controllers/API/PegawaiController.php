<?php

namespace App\Http\Controllers\API;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PegawaiRequest;

class PegawaiController extends Controller
{

    function get($id = null)
    {
        if (isset($id)) {
            $pegawai = Pegawai::findOrFail($id);
            return response()->json(['msg' => 'Data retrieved', 'data' => $pegawai], 200);
        } else {
            $pegawai = Pegawai::get();
            return response()->json(['msg' => 'Data retrieved', 'data' => $pegawai], 200);
        }
    }

    function store(PegawaiRequest $request)
    {
        $pegawai = Pegawai::create($request->all());
        return response()->json(['msg' => 'Data created', 'data' => $pegawai], 201);
    }

    function update($id, PegawaiRequest $request)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->update($request->all());
        return response()->json(['msg' => 'Data updated', 'data' => $pegawai], 200);
    }

    function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();
        return response()->json(['msg' => 'Data deleted'], 200);
    }



    
}