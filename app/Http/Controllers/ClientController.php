<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::latest()->get();
        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'client_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        $data = [
            'name' => $validated['name'],
        ];

        if ($request->hasFile('client_logo')) {
            $data['client_logo'] = $request->file('client_logo')->store('clients', 'public');
        }

        Client::create($data);

        return redirect()->route('admin.clients.index')->with('success', 'Client created successfully.');
    }

    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'client_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        $data = [
            'name' => $validated['name'],
        ];

        if ($request->hasFile('client_logo')) {
            if ($client->client_logo) {
                Storage::disk('public')->delete($client->client_logo);
            }
            $data['client_logo'] = $request->file('client_logo')->store('clients', 'public');
        }

        $client->update($data);

        return redirect()->route('admin.clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy(Client $client)
    {
        $client->update(['status' => !$client->status]);
        $status = $client->status ? 'activated' : 'deactivated';
        return redirect()->route('admin.clients.index')->with('success', "Client {$status} successfully.");
    }
}
