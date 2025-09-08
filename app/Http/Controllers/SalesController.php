<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;

class SalesController extends Controller
{
    public function index()
    {
        // $sales = Sales::all();
        return view('sales.index');    
    }
    public function create(Sales $sales)
    {
        // $sales = Sales::all();
        return view('sales.create-sales', compact('sales'));    
    }
    public function show()
    {
        // $sales = Sales::all();
    }
    public function edit()
    {
        // $sales = Sales::all();
        return view('sales.edit-sales');    
    }
}
