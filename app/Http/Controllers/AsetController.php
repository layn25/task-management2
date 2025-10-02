<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\OpnameAset;
use Illuminate\Http\Request;
use Throwable;

class AsetController extends Controller
{
    public function index()
    {
        $data = Aset::all();
        return view('pages.aset.index', compact('data'));
    }
    public function create()
    {
        return view('pages.aset.create');
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama'=> 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'kondisi'=> 'required|in:baik,rusakRingan,rusakBerat',
                'deskripsi_kondisi' => 'string',
            ]);

            $data = new Aset();
            $data->nama = $request->nama;  
            $data->deskripsi = $request->deskripsi;
            $data->kondisi = $request->kondisi;
            $data->save();

            $opname = new OpnameAset();
            $opname->aset_id = $data->id;
            $opname->kondisi = $request->kondisi;
            $opname->deskripsi = $request->deskripsi_kondisi;
            $opname->kondisi = $request->kondisi;
            $opname->tanggal = now();
            $opname->save();


            return redirect()->back()->with('success', 'Aset berhasil ditambahkan!');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage())->withInput();
        }
    }
    public function detail($id)
    {
        $aset = Aset::findOrFail($id);
        return view('pages.aset.detail', compact('aset'));
    }
}
