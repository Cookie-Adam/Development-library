<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComputerRequest;
use App\Models\Computer;
use Illuminate\Http\Request;

class ComputerController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->string('q')->trim();

        $computers = Computer::query()
            ->when($q->isNotEmpty(), fn ($query) => $query
                ->where('name', 'like', "%{$q}%")
                ->orWhere('status', 'like', "%{$q}%"))
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('computers.index', compact('computers'));
    }

    public function create()
    {
        return view('computers.create');
    }

    public function store(ComputerRequest $request)
    {
        $computer = Computer::create($request->validated());

        return redirect()->route('computers.show', $computer)->with('status', 'Computer created.');
    }

    public function show(Computer $computer)
    {
        $computer->load('sessions.client');

        return view('computers.show', compact('computer'));
    }

    public function edit(Computer $computer)
    {
        return view('computers.edit', compact('computer'));
    }

    public function update(ComputerRequest $request, Computer $computer)
    {
        $computer->update($request->validated());

        return redirect()->route('computers.show', $computer)->with('status', 'Computer updated.');
    }

    public function destroy(Computer $computer)
    {
        if ($computer->sessions()->active()->exists()) {
            return back()->with('error', 'This computer has an active session.');
        }

        $computer->delete();

        return redirect()->route('computers.index')->with('status', 'Computer deleted.');
    }
}
