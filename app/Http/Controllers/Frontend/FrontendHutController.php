<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Hut;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendHutController extends Controller
{
    public function AllFrontendHutList()
    {
        $huts = Hut::latest()->get();
        return view('frontend.hut.all_huts', compact('huts'));
    }
}
