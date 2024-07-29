<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;

class DataController extends Controller
{


    public function index(){
        return view('home');
    }
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'guests' => 'required|integer',
            'email' => 'required|email|max:255',
            'harga' => 'required|integer',
            'checkintime' => 'string|max:255', // Format tanggal sesuai dengan input
            'checkouttime' => 'string|max:255', // Format tanggal sesuai dengan input
        ]);
    
        // Insert data ke database
        $data = Data::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'guests' => $request->guests,
            'email' => $request->email,
            'harga' => $request->harga,
            'status' => 'Unpaid',
            'checkintime' => $request->checkintime,
            'checkouttime' => $request->checkouttime,
        ]);
    
            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = 'SB-Mid-server-sVg-yyXFgY20l_ris0_Zr9IE';
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;
    
            $params = array(
                'transaction_details' => array(
                    'order_id' => rand(),
                    'gross_amount' => $request->harga,
                ),
                'customer_details' => array(
                    'email' => $request->email,
                    'phone' => $request->phone
                ),
            );
    
            $snapToken = \Midtrans\Snap::getSnapToken($params);
        // Response sukses
                // Response sukses
                return response()->json([
                    'message' => 'Data inserted successfully',
                    'data' => $data,
                    'snap_token' => $snapToken,
                ], 201);
    }
    
}
