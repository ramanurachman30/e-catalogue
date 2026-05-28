<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutUsController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = AboutUs::latest()->get();
        return view('aboutus.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('aboutus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->uploadImage($request->file('image'), 'aboutus');
        }
        
        AboutUs::create($validated);
        return redirect()->route('aboutus.index');
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
        $getId = AboutUs::findOrFail($id);
        return view('aboutus.edit', compact('getId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        $getId = AboutUs::findOrFail($id);

        if ($request->hasFile('image')) {
            $this->deleteImage($getId->image);
            $validated['image'] = $this->uploadImage($request->file('image'), 'aboutus');
        }

        $getId->update($validated);
        return redirect()->route('aboutus.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $getId = AboutUs::findOrFail($id);
        $this->deleteImage($getId->image);
        $getId->delete();
        return redirect()->route('aboutus.index');
    }
}
