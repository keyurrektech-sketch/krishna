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

    public function editIndex(Request $request)
    {
        $data = Sales::latest()->paginate(5);

        return view('sales.edit-index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
        
    }

    public function create(Sales $sales)
    {
        return view('sales.create-sales', compact('sales'));    
    }

    public function store(Request $request)
    { 
        $request->validate([
            ''
        ]);
        Sales::create($request->all());
        return redirect()->route('sales.index')
            ->with('success', 'Sales created successfully.');
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
