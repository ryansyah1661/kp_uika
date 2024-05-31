<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Auth::user()->is_admin 
            ? Donation::orderBy('created_at', 'desc')->get() 
            : Auth::user()->donations()->orderBy('created_at', 'desc')->get();

        return view('donations.index', compact('donations'));
    }


    public function create()
    {
        return view('donations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
        ]);

        $image = $request->file('image');
    $image->storeAs('public/blogs', $image->hashName());

        Donation::create([
            'user_id' => Auth::id(),
            'image_path' => $image->hashName(),
        ]);

        return redirect()->route('donations.index')->with('success', 'Donation submitted successfully.');
    }

    public function approve(Donation $donation)
    {
        $donation->update(['status' => 'approved']);
        return redirect()->route('donations.index')->with('success', 'Donation approved.');
    }
}
