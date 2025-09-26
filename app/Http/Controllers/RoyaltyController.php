<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Royalty;

class RoyaltyController extends Controller
{
    public function index(Request $request)
    {
        $royalties = Royalty::latest()->paginate(5);
        return view('royalty.index', compact('royalties'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('royalty.add-edit');
    }
    
    public function store(Request $request)
    {
        $royalty = $request->validate([
            'name' => 'required|string|max:255',
        ],[
            'name.required' => 'Royalty name is required',
        ]);
        Royalty::create($royalty);
        return redirect()->route('royalty.index')->with('success', 'Royalty added successfully');
    }

    public function edit($id)
    {
        $royalty = Royalty::findOrFail($id);
        return view('royalty.add-edit', compact('royalty'));
    }


    public function update(Request $request, $id)
    {
        $royalty = $request->validate([
            'name' => 'required|string|max:255',
        ],[
            'name.required' => 'Place name is required',
        ]);
        Royalty::find($id)->update($royalty);
        return redirect()->route('royalty.editIndex')->with('success', 'Royalty updated successfully');
    }
    
    public function show($id)
    {
        $royalties = Royalty::find($id);
        return view('royalty.show', compact('royalties'));
    }

    public function editIndex(Request $request)
    {
        $royalties = Royalty::latest()->paginate(5);
        return view('royalty.edit-index', compact('royalties'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
}

