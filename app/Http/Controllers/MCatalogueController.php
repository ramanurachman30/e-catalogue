<?php

namespace App\Http\Controllers;

use App\Models\MCatalogue;
use App\Models\MCategories;
use App\Models\MStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $categories = MCategories::all();
        $statuses = MStatus::all();
        return view('mcatalogue.create', compact('categories', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:m_categories,id',
            'status_id' => 'required|exists:m_status,id',
        ]);

        if ($request->hasFile('img')) {
            $validated['img'] = $request->file('img')->store('catalogue', 'public');
        }

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
        $categories = MCategories::all();
        $statuses = MStatus::all();
        return view('mcatalogue.edit', compact('getId', 'categories', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:m_categories,id',
            'status_id' => 'required|exists:m_status,id',
        ]);

        $getId = MCatalogue::findOrFail($id);

        if ($request->hasFile('img')) {
            if ($getId->img) {
                Storage::disk('public')->delete($getId->img);
            }
            $validated['img'] = $request->file('img')->store('catalogue', 'public');
        }

        $getId->update($validated);
        return redirect()->route('mcatalogue.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $getId = MCatalogue::findOrFail($id);
        if ($getId->img) {
            Storage::disk('public')->delete($getId->img);
        }
        $getId->delete();
        return redirect()->route('mcatalogue.index');
    }
}
