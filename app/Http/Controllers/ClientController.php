<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->string('q')->trim();

        $clients = Client::query()
            ->when($q->isNotEmpty(), fn ($query) => $query->where(fn ($w) => $w
                ->where('name', 'like', "%{$q}%")
                ->orWhere('email', 'like', "%{$q}%")
                ->orWhere('card_number', 'like', "%{$q}%")))
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(ClientRequest $request)
    {
        $client = Client::create($request->validated());

        return redirect()->route('clients.show', $client)->with('status', 'Client created.');
    }

    public function show(Client $client)
    {
        $client->load(['borrowings.book', 'computerSessions.computer']);

        return view('clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(ClientRequest $request, Client $client)
    {
        $client->update($request->validated());

        return redirect()->route('clients.show', $client)->with('status', 'Client updated.');
    }

    public function destroy(Client $client)
    {
        // Deleting would silently drop active loans and break book stock
        if ($client->borrowings()->active()->exists()) {
            return back()->with('error', 'This client still has books out.');
        }

        $client->delete();

        return redirect()->route('clients.index')->with('status', 'Client deleted.');
    }
}
