<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SidebarController extends Controller
{
    public function toggle(Request $request)
    {
        $isCollapsed = $request->input('collapsed', false);
        session(['sidebar_collapsed' => $isCollapsed]);

        return response()->json(['success' => true, 'collapsed' => $isCollapsed]);
    }
}
