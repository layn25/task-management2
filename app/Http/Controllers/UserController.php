<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Throwable;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('pages.users.index', compact('users'));
    }

    public function create()
    {
        return view('pages.users.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama'=> 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password'=> 'required|string|min:8|max:12',
            ]);

            $data = new User();
            $data->nama = $request->nama;  
            $data->email = $request->email;
            $data->password = $request->password;
            $data->save();

            return redirect()->back()->with('success', 'User berhasil ditambahkan!');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage())->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $data = User::findOrFail($id);
        return view('pages.users.edit', compact('data'));
    }

    public function edit(Request $request, $id)
    {
        try {
            $data = User::findOrFail($id);
            if ($request->email === $data->email) {
                $request->validate([
                    'nama' => 'required|string|max:255',
                    'email' => 'required|email',
                    'password' => 'nullable|string|min:8|max:12',
                ]);
            } else {
                $request->validate([
                    'nama' => 'required|string|max:255',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'nullable|string|min:8|max:12',
                ]);
            }

            $data->nama = $request->nama;
            $data->email = $request->email;


            if ($request->filled('password')) {
                $data->password = $request->password;
            }

            $data->save();

            return redirect()->route('users.index')->with('success', 'User berhasil diperbarui!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage())->withInput();
        }
    }
    public function delete($id)
    {
        $data = User::findOrFail($id);
        $data->delete();

        return redirect()->back()->with('success', 'user berhasil dihapus!');
    }

}
