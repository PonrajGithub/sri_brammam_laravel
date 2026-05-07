<?php

namespace App\Http\Controllers;

use App\Models\Reporter;
use Illuminate\Http\Request;

class ReporterController extends Controller
{
    public function index()
    {
        $reporters = Reporter::latest()->get();
        return view('admin.reporters.index', compact('reporters'));
    }

    public function create()
    {
        return view('admin.reporters.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Reporter::create($validated);

        return redirect()->route('admin.reporters.index')->with('success', 'Reporter created successfully.');
    }

    public function edit(Reporter $reporter)
    {
        return view('admin.reporters.edit', compact('reporter'));
    }

    public function update(Request $request, Reporter $reporter)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $reporter->update($validated);

        return redirect()->route('admin.reporters.index')->with('success', 'Reporter updated successfully.');
    }

    public function destroy(Reporter $reporter)
    {
        $reporter->update(['status' => !$reporter->status]);
        $status = $reporter->status ? 'activated' : 'deactivated';
        return redirect()->route('admin.reporters.index')->with('success', "Reporter {$status} successfully.");
    }
}
