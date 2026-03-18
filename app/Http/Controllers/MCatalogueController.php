<?php

namespace App\Http\Controllers;

use App\Models\MCatalogue;
use Illuminate\Http\Request;

class MCatalogueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = MCatalogue::with('category', 'status')->latest()->paginate(10);
        return view('mcatalogue.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mcatalogue.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:mcategories,id',
            'status_id' => 'required|exists:mstatuses,id',
        ]);

        MCatalogue::create($validated);
        return redirect()->route('mcatalogue.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $getId = MCatalogue::findOrFail($id);
        return view('mcatalogue.edit', compact('getId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:mcategories,id',
            'status_id' => 'required|exists:mstatuses,id',
        ]);

        $getId = MCatalogue::findOrFail($id);
        $getId->update($validated);
        return redirect()->route('mcatalogue.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $getId = MCatalogue::findOrFail($id);
        $getId->delete();
        return redirect()->route('mcatalogue.index');
    }
}
