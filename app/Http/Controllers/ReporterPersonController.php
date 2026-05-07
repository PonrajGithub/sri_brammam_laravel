<?php

namespace App\Http\Controllers;

use App\Models\ReporterPerson;
use App\Models\Reporter;
use Illuminate\Http\Request;

class ReporterPersonController extends Controller
{
    public function index()
    {
        $persons = ReporterPerson::with('reporter')->latest()->get();
        return view('admin.reporter_persons.index', compact('persons'));
    }

    public function create()
    {
        $reporters = Reporter::all();
        return view('admin.reporter_persons.create', compact('reporters'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'reporter_id' => 'required|exists:reporters,id',
            'name' => 'required|string|max:255',
            'describe_role' => 'nullable|string',
            'address' => 'nullable|string',
            'pincode' => 'nullable|string|max:10',
            'mobile' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        ReporterPerson::create($validated);

        return redirect()->route('admin.reporter-persons.index')->with('success', 'Reporter Person created successfully.');
    }

    public function edit(ReporterPerson $reporterPerson)
    {
        $reporters = Reporter::all();
        return view('admin.reporter_persons.edit', compact('reporterPerson', 'reporters'));
    }

    public function update(Request $request, ReporterPerson $reporterPerson)
    {
        $validated = $request->validate([
            'reporter_id' => 'required|exists:reporters,id',
            'name' => 'required|string|max:255',
            'describe_role' => 'nullable|string',
            'address' => 'nullable|string',
            'pincode' => 'nullable|string|max:10',
            'mobile' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        $reporterPerson->update($validated);

        return redirect()->route('admin.reporter-persons.index')->with('success', 'Reporter Person updated successfully.');
    }

    public function destroy(ReporterPerson $reporterPerson)
    {
        $reporterPerson->update(['status' => !$reporterPerson->status]);
        $status = $reporterPerson->status ? 'activated' : 'deactivated';
        return redirect()->route('admin.reporter-persons.index')->with('success', "Reporter Person {$status} successfully.");
    }
}
