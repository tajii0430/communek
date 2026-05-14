<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

class AnnouncementController extends Controller
{

    public function index()
    {

        $announcements = Announcement::where(
            'barangay',
            auth()->user()->barangay
        )

            ->latest()

            ->get();

        return view(
            'barangay.announcements',
            compact('announcements')
        );
    }

    public function store(Request $request)
    {

        Announcement::create([

            'user_id' => auth()->id(),

            'title' => $request->title,

            'content' => $request->content,

            'barangay' => auth()->user()->barangay
        ]);

        return back();
    }
}
