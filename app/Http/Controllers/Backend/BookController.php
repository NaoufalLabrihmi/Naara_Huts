<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookArea;

class BookController extends Controller
{
    public function BookArea()
    {
        $book = BookArea::find(1);
        return view('backend.bookarea.book_area', compact('book'));
    }
}
