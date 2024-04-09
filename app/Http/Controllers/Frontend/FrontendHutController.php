<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Hut;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\MultiImage;

class FrontendHutController extends Controller
{
    public function AllFrontendHutList()
    {
        $huts = Hut::latest()->get();
        return view('frontend.hut.all_huts', compact('huts'));
    }

    public function HutDetailsPage($id)
    {
        $hutdetails = Hut::find($id);
        $multiImage = MultiImage::where('huts_id', $id)->get();
        $facility = Facility::where('huts_id', $id)->get();
        $otherHuts = Hut::where('id', '!=', $id)->orderBy('id', 'DESC')->limit(2)->get();
        return view('frontend.hut.hut_details', compact('hutdetails', 'multiImage', 'facility', 'otherHuts'));
    }
}
