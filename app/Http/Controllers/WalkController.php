<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WalkController extends Controller
{
    public function end(Request $request)
    {
        session()->flash('status', 'Wandeling beëindigd — goed gedaan!');
        return redirect()->back();
    }
}
