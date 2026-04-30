<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $series = Series::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->paginate(10);

        return view('admin.series.index', compact('series'));
    }

    public function create()
    {
        return view('admin.series.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Series::create($validated);

        return redirect()->route('series.index')->with('status', 'Series created successfully!');
    }

    public function edit(Series $series)
    {
        return view('admin.series.edit', compact('series'));
    }

    public function update(Request $request, Series $series)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $series->update($validated);

        return redirect()->route('series.index')->with('status', 'Series updated successfully!');
    }

    public function destroy(Series $series)
    {
        $series->delete();

        return redirect()->route('series.index')->with('status', 'Series deleted successfully!');
    }
}
