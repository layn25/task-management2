<?php

namespace App\Http\Controllers;

use App\Models\ApprovalPetugas;

class ApprovalTugasController extends Controller
{
    public function index()
    {
        $data = ApprovalPetugas::all();
        return view('pages.approval_tugas.index', compact('data'));
    }
}
