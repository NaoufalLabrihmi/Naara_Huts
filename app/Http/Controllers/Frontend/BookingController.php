<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Hut;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class BookingController extends Controller
{
    public function Checkout()
    {
        if (Session::has('book_date')) {
            $book_data = Session::get('book_date');
            $hut = Hut::find($book_data['hut_id']);

            $toDate = Carbon::parse($book_data['check_in']);
            $fromDate = Carbon::parse($book_data['check_out']);
            $nights = $toDate->diffInDays($fromDate);

            return view('frontend.checkout.checkout', compact('book_data', 'hut', 'nights'));
        } else {

            $notification = array(
                'message' => 'Something want to wrong!',
                'alert-type' => 'error'
            );
            return redirect('/')->with($notification);
        }
    }
    public function BookingStore(Request $request)
    {
        $validateData = $request->validate([
            'check_in' => 'required',
            'check_out' => 'required',
            'person' => 'required',
            'number_of_huts' => 'required',
        ]);
        if ($request->available_hut < $request->number_of_huts) {
            $notification = array(
                'message' => 'Something want to wrong!!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        Session::forget('book_date');

        $data = array();
        $data['number_of_huts'] = $request->number_of_huts;
        $data['available_hut'] = $request->available_hut;
        $data['person'] = $request->person;
        $data['check_in'] = date('Y-m-d', strtotime($request->check_in));
        $data['check_out'] = date('Y-m-d', strtotime($request->check_out));
        $data['hut_id'] = $request->hut_id;

        Session::put('book_date', $data);

        return redirect()->route('checkout');
    }
}
