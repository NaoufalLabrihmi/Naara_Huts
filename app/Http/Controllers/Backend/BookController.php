<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Booking;
use App\Models\BookArea;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Intervention\Image\Laravel\Facades\Image;

class BookController extends Controller
{
    public function BookArea()
    {
        $book = BookArea::find(1);
        return view('backend.bookarea.book_area', compact('book'));
    }

    public function BookAreaUpdate(Request $request)
    {
        $book_id = $request->id;
        $team = BookArea::findOrFail($book_id);

        if ($request->hasFile('image')) {
            // Handle new image upload
            $image = $request->file('image'); // Get the image file from the request
            $save_url = $this->handleImage($image); // Pass the image file to handleImage function

            // Delete the old image file if it exists
            if ($team->image && file_exists(public_path($team->image))) {
                unlink(public_path($team->image));
            }

            $team->update([
                'short_title' => $request->short_title,
                'main_title' => $request->main_title,
                'short_desc' => $request->short_desc,
                'link_url' => $request->link_url,
                'image' => $save_url,
            ]);
        } else {
            $team->update([
                'short_title' => $request->short_title,
                'main_title' => $request->main_title,
                'short_desc' => $request->short_desc,
                'link_url' => $request->link_url,
            ]);
        }

        $notification = array(
            'message' => 'Book Area Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    private function handleImage($image)
    {
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $save_url = 'upload/team/' . $name_gen;
        Image::read($image)->resize(550, 670)->save($save_url);
        return $save_url;
    }
}
