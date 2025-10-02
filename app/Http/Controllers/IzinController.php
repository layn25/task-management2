<?php

namespace App\Http\Controllers;

use App\Models\Izin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Throwable;

class IzinController extends Controller
{
    public function index()
    {
        $data = Izin::all();
        return view('pages.izin.index', compact('data'));    
    }

    public function create()
    {
        $users = User::all();
        return view('pages.izin.create', compact('users'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
                'deskripsi' => 'nullable|string',
                'bukti' => 'required|file',
            ]);

            $linkBukti = $request->file('bukti')->store('bukti_izin', 'public');

            $data = new Izin();
            $data->user_id = Auth::user()->id;  
            $data->deskripsi = $request->deskripsi;
            $data->tanggal_mulai = Carbon::parse($request->tanggal_mulai)->format('Y-m-d H:i:s');
            $data->tanggal_selesai = Carbon::parse($request->tanggal_selesai)->format('Y-m-d H:i:s');
            $data->bukti = $linkBukti;  
            $data->save();
            

            return redirect()->back()->with('success', 'Izin berhasil ditambahkan!');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function diterima($id)
    {
        try {

            $izin = Izin::findOrFail($id);
            $izin->status = 'diterima';
            $izin->save();

            return redirect()->back()->with('success', "Izin berhasil diterima.");
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function ditolak($id)
    {
        try {

            $izin = Izin::findOrFail($id);
            $izin->status = 'ditolak';
            $izin->save();

            return redirect()->back()->with('success', "Izin berhasil ditolak.");
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function delete($id)
    {
        $izin = Izin::findOrFail($id);

        // Hapus file bukti jika ada
        if ($izin->bukti && Storage::disk('public')->exists($izin->bukti)) {
            Storage::disk('public')->delete($izin->bukti);
        }

        // Hapus data izin
        $izin->delete();

        return redirect()->back()->with('success', 'Izin berhasil dihapus beserta buktinya!');
    }
}
