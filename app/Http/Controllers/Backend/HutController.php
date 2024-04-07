<?php

namespace App\Http\Controllers\Backend;

use App\Models\Hut;
use App\Models\Facility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use FFI;

class HutController extends Controller
{
    public function EditHut($id)
    {
        $basic_facility = Facility::where('huts_id', $id)->get();
        $editData = Hut::find($id);
        return view('backend.allhut.huts.edit_hut', compact('editData', 'basic_facility'));
    }
}
