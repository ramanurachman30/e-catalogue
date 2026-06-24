<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Events;
use App\Models\MCatalogue;
use App\Models\MCategories;
use App\Models\MSosmed;
use App\Models\MVissionMission;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $catalogues = MCatalogue::with(['category', 'status'])->latest()->take(4)->get();
        $sosmeds = MSosmed::all();
        $whatsapp = MSosmed::where('name', 'like', '%whatsapp%')->first();
        $about = AboutUs::first();
        return view('landing_pages.home', compact('catalogues', 'sosmeds', 'whatsapp', 'about'));
    }

    public function about()
    {
        $about = AboutUs::first();
        $vissions = MVissionMission::all();
        $sosmeds = MSosmed::all();
        return view('landing_pages.about', compact('about', 'vissions', 'sosmeds'));
    }

    public function gallery(Request $request)
    {
        $categories = MCategories::all();
        $query = MCatalogue::with(['category', 'status']);

        if ($request->filled('category') && $request->category != 'all') {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('name', $request->category);
            });
        }

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('author', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $catalogues = $query->latest()->paginate(12);
        $sosmeds = MSosmed::all();
        $whatsapp = MSosmed::where('name', 'like', '%whatsapp%')->first();

        return view('landing_pages.gallery', compact('catalogues', 'categories', 'sosmeds', 'whatsapp'));
    }

    public function event()
    {
        $events = Events::latest()->get();
        $upcomingEvent = Events::where('end_date', '>=', now()->toDateString())->orderBy('start_date', 'asc')->first();
        $sosmeds = MSosmed::all();
        return view('landing_pages.event', compact('events', 'upcomingEvent', 'sosmeds'));
    }

    public function eventDetail($id)
    {
        $event = Events::findOrFail($id);
        $otherEvents = Events::where('id', '!=', $id)->latest()->take(3)->get();
        $sosmeds = MSosmed::all();
        return view('landing_pages.event_detail', compact('event', 'otherEvents', 'sosmeds'));
    }

    public function catalogueDetail($id)
    {
        $catalogue = MCatalogue::with(['category', 'status'])->findOrFail($id);
        $relatedCatalogues = MCatalogue::with(['category', 'status'])
            ->where('id', '!=', $id)
            ->where('category_id', $catalogue->category_id)
            ->latest()
            ->take(4)
            ->get();
        $sosmeds = MSosmed::all();
        $whatsapp = MSosmed::where('name', 'like', '%whatsapp%')->first();
        return view('landing_pages.catalogue_detail', compact('catalogue', 'relatedCatalogues', 'sosmeds', 'whatsapp'));
    }
}
