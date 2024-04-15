<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Hut;
use App\Models\Booking;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Models\HutBookedDate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Stripe;

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

    public function CheckoutStore(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'country' => 'required',
            'phone' => 'required',
            'adress' => 'required',
            'state' => 'required',
            'zip_code' => 'required',
            'payment_method' => 'required',
        ]);

        $book_data = Session::get('book_date');
        $toDate = Carbon::parse($book_data['check_in']);
        $fromDate = Carbon::parse($book_data['check_out']);
        $total_nights = $toDate->diffInDays($fromDate);

        $hut = Hut::find($book_data['hut_id']);
        $subtotal = $hut->price * $total_nights * $book_data['number_of_huts'];
        $discount = ($hut->discount / 100) * $subtotal;
        $total_price = $subtotal - $discount;
        $code = rand(000000000, 999999999);


        if ($request->payment_method == 'Stripe') {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $s_pay = Stripe\Charge::create([
                "amount" => $total_price * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Payment For Booking. Booking No " . $code,

            ]);

            if ($s_pay['status'] == 'succeeded') {
                $payment_status = 1;
                $transation_id = $s_pay->id;
            } else {

                $notification = array(
                    'message' => 'Sorry Payment Field',
                    'alert-type' => 'error'
                );
                return redirect('/')->with($notification);
            }
        } else {
            $payment_status = 0;
            $transation_id = '';
        }


        $data = new Booking();
        $data->huts_id = $hut->id;
        $data->user_id = Auth::user()->id;
        $data->check_in = date('Y-m-d', strtotime($book_data['check_in']));
        $data->check_out = date('Y-m-d', strtotime($book_data['check_out']));
        $data->person = $book_data['person'];
        $data->number_of_huts = $book_data['number_of_huts'];
        $data->total_night = $total_nights;

        $data->actual_price = $hut->price;
        $data->subtotal = $subtotal;
        $data->discount = $discount;
        $data->total_price = $total_price;
        $data->payment_method = $request->payment_method;
        $data->transation_id = '';
        $data->payment_status = 0;

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->country = $request->country;
        $data->state = $request->state;
        $data->zip_code = $request->zip_code;
        $data->adress = $request->adress;

        $data->code = $code;
        $data->status = 0;
        $data->created_at = Carbon::now();
        $data->save();

        $sdate = date('Y-m-d', strtotime($book_data['check_in']));
        $edate = date('Y-m-d', strtotime($book_data['check_out']));
        $eldate = Carbon::create($edate)->subDay();
        $d_period = CarbonPeriod::create($sdate, $eldate);
        foreach ($d_period as $period) {
            $booked_dates = new HutBookedDate();
            $booked_dates->booking_id = $data->id;
            $booked_dates->hut_id = $hut->id;
            $booked_dates->book_date = date('Y-m-d', strtotime($period));
            $booked_dates->save();
        }

        Session::forget('book_date');

        $notification = array(
            'message' => 'Booking Added Successfully',
            'alert-type' => 'success'
        );
        return redirect('/')->with($notification);
    }


    public function BookingList()
    {

        $allData = Booking::orderBy('id', 'desc')->get();
        return view('backend.booking.booking_list', compact('allData'));
    }

    public function EditBooking($id)
    {

        $editData = Booking::with('hut')->find($id); //to avoid the N + 1 query problem
        return view('backend.booking.edit_booking', compact('editData'));
    }

    public function UpdateBookingStatus(Request $request, $id)
    {

        $booking = Booking::find($id);
        $booking->payment_status = $request->payment_status;
        $booking->status = $request->status;
        $booking->save();

        $notification = array(
            'message' => 'Information Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
