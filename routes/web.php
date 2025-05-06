<?php

use Illuminate\Support\Facades\Route;
use App\Models\Nonmonetary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\MonetaryDonation;

// Landing page route
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Monetary Donation route

Route::post('/donate/monetary', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'payment_method' => 'required|string',
        'amount' => 'required|numeric|min:1',
        'donor_name' => 'required|string',
        'donor_email' => 'required|email',
        'donor_phone' => 'required|string',
        'proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'message' => 'nullable|string',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    $data = $validator->validated();

    if ($request->hasFile('proof')) {
        $data['proof'] = $request->file('proof')->store('monetary_proofs', 'public');
    }

    MonetaryDonation::create($data);

    return response()->json(['success' => true, 'message' => 'Thank you for your donation!']);
})->name('monetary_donation.submit');

Route::get('/donate/monetary', function () {
    return view('monetary');
})->name('monetary_donation');


// Non-Monetary Donation route
Route::get('/donate/non-monetary', function () {
    return view('Nonmonetary');
})->name('non_monetary');

Route::post('/donate/non-monetary', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'category' => 'required|string',
        'condition' => 'required|string',
        'donor_name' => 'required|string',
        'donor_email' => 'required|email',
        'donor_phone' => 'required|string',
        'dropoff_location' => 'required|string',
        'image' => 'nullable|image|max:2048',
        'preferred_time' => 'required|date',
        'description' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422);
    }

    $data = $validator->validated();

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('donation_images', 'public');
    }

    Nonmonetary::create($data);

    return response()->json(['success' => true, 'message' => 'Thank you for your donation!']);
})->name('non_monetary.submit');



// User Calendar/Campaigns route
Route::get('/user/calendar', function () {
    return view('usercalendar');
})->name('user.calendar');

// User Campaign route
Route::get('/user/campaign', function () {
    return view('usercampaign');
})->name('user.campaign');

Route::get('/entry', function () {
    return view('entry');
})->name('entry');

Route::get('/thank-you', function () {
    return view('thank-you');
})->name('thank-you');
