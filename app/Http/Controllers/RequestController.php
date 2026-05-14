<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentRequest;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{

    public function show($id)
    {
        $requestItem = DocumentRequest::findOrFail($id);

        return view(
            'resident.view-request',
            compact('requestItem')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RESIDENT VIEW REQUESTS PAGE
    |--------------------------------------------------------------------------
    */

    public function requests()
    {
        $requests = DocumentRequest::where(
            'user_id',
            auth()->id()
        )->latest()->get();

        return view(
            'resident.requests',
            compact('requests')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RESIDENT SUBMIT DOCUMENT REQUEST
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([

            'document_type' => 'required',

            'purpose' => 'required'

        ]);

        DocumentRequest::create([

            'user_id' => auth()->id(),

            'document_type' => $request->document_type,

            'purpose' => $request->purpose,

            'status' => 'pending'
        ]);

        return back()->with(
            'success',
            'Request submitted successfully.'
        );
    }
    /*
    |--------------------------------------------------------------------------
    | BARANGAY VIEW ALL REQUESTS
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $requests = DocumentRequest::latest()->get();

        return view(
            'barangay.requests',
            compact('requests')
        );
    }
}
