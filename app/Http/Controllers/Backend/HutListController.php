<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Hut;
use App\Models\Booking;
use App\Models\HutType;
use Carbon\CarbonPeriod;
use App\Models\HutNumber;
use Illuminate\Http\Request;
use App\Models\HutBookedDate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HutListController extends Controller
{
    public function ViewHutList()
    {
        $hut_number_list = HutNumber::with(['hut_type', 'last_booking.booking:id,check_in,check_out,status,code,name,phone'])->orderBy('hut_type_id', 'asc')
            ->leftJoin('hut_types', 'hut_types.id', 'hut_numbers.hut_type_id')
            ->leftJoin('booking_hut_lists', 'booking_hut_lists.hut_number_id', 'hut_numbers.id')
            ->leftJoin('bookings', 'bookings.id', 'booking_hut_lists.booking_id')
            ->select(
                'hut_numbers.*',
                'hut_numbers.id as id',
                'hut_types.name',
                'bookings.id as booking_id',
                'bookings.check_in',
                'bookings.check_out',
                'bookings.name as customer_name',
                'bookings.phone as customer_phone',
                'bookings.status as booking_stauts',
                'bookings.code as booking_no'
            )
            ->orderBy('hut_types.id', 'asc')
            ->orderBy('bookings.id', 'desc')
            ->get();

        return view('backend.allhut.hutlist.view_hutlist', compact('hut_number_list'));
    }

    public function AddHutList()
    {

        $huttype = HutType::all();
        return view('backend.allhut.hutlist.add_hutlist', compact('huttype'));
    }

    public function StoreHutList(Request $request)
    {

        if ($request->check_in == $request->check_out) {
            $request->flash();
            $notification = array(
                'message' => 'You Enter Same Date',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        if ($request->available_hut < $request->number_of_huts) {
            $request->flash();
            $notification = array(
                'message' => 'You Enter Maximum Number of Huts!',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        $hut = Hut::find($request['hut_id']);
        if ($hut->hut_capacity < $request->number_of_person) {
            $notification = array(
                'message' => 'You Enter Maximum Number of Guest!',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }


        $toDate = Carbon::parse($request['check_in']);
        $fromDate = Carbon::parse($request['check_out']);
        $total_nights = $toDate->diffInDays($fromDate);

        $subtotal = $hut->price * $total_nights * $request->number_of_huts;
        $discount = ($hut->discount / 100) * $subtotal;
        $total_price = $subtotal - $discount;
        $code = rand(000000000, 999999999);

        $data = new Booking();
        $data->huts_id = $hut->id;
        $data->user_id = Auth::user()->id;
        $data->check_in = date('Y-m-d', strtotime($request['check_in']));
        $data->check_out = date('Y-m-d', strtotime($request['check_out']));
        $data->person = $request->number_of_person;
        $data->number_of_huts = $request->number_of_huts;
        $data->total_night = $total_nights;

        $data->actual_price = $hut->price;
        $data->subtotal = $subtotal;
        $data->discount = $discount;
        $data->total_price = $total_price;
        $data->payment_method = 'COD';
        $data->payment_status = 0;

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->country = $request->country;
        $data->state = $request->state;
        $data->zip_code = $request->zip_code;
        $data->adress = $request->address;

        $data->code = $code;
        $data->status = 0;
        $data->created_at = Carbon::now();
        $data->save();

        $sdate = date('Y-m-d', strtotime($request['check_in']));
        $edate = date('Y-m-d', strtotime($request['check_out']));
        $eldate = Carbon::create($edate)->subDay();
        $d_period = CarbonPeriod::create($sdate, $eldate);
        foreach ($d_period as $period) {
            $booked_dates = new HutBookedDate();
            $booked_dates->booking_id = $data->id;
            $booked_dates->hut_id = $hut->id;
            $booked_dates->book_date = date('Y-m-d', strtotime($period));
            $booked_dates->save();
        }


        $notification = array(
            'message' => 'Booking Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
