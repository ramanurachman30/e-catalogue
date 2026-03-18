<?php

namespace App\Http\Controllers;

use App\Models\MCategories;
use Illuminate\Http\Request;

class MCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = MCategories::latest()->paginate(10);
        return view('mcategories.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mcategories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        MCategories::create($validated);

        return redirect()->route('mcategories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = MCategories::findOrFail($id);
        return view('mcategories.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = MCategories::findOrFail($id);
        return view('mcategories.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $mcategories = MCategories::findOrFail($id);
        $mcategories->update($validated);

        return redirect()->route('mcategories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mcategories = MCategories::findOrFail($id);
        $mcategories->delete();

        return redirect()->route('mcategories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
