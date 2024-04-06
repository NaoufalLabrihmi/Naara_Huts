<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\HutType;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use Carbon\Carbon;

class HutTypeController extends Controller
{
    public function HutTypeList()
    {
        $allData = HutType::orderBy('id', 'desc')->get();
        return view('backend.allhut.huttype.view_huttype', compact('allData'));
    }

    public function AddHutType()
    {
        return view('backend.allhut.huttype.add_huttype');
    }

    public function HutTypeStore(Request $request)
    {
        HutType::insert([
            'name' => $request->name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Hut Type Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('hut.type.list')->with($notification);
    }
}
