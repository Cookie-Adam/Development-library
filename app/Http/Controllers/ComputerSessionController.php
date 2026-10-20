<?php

namespace App\Http\Controllers;

use App\Http\Requests\StartSessionRequest;
use App\Models\Client;
use App\Models\Computer;
use App\Models\ComputerSession;
use App\Models\Staff;
use Illuminate\Support\Facades\DB;

class ComputerSessionController extends Controller
{
    public function index()
    {
        // Active sessions first, then most recent
        $sessions = ComputerSession::with(['client', 'computer', 'staff'])
            ->orderByRaw('ended_at is not null')
            ->latest('started_at')
            ->paginate(15);

        return view('sessions.index', compact('sessions'));
    }

    public function create()
    {
        return view('sessions.create', [
            'clients' => Client::orderBy('name')->get(),
            'computers' => Computer::where('status', 'available')->orderBy('name')->get(),
            'staff' => Staff::orderBy('name')->get(),
        ]);
    }

    public function store(StartSessionRequest $request)
    {
        $data = $request->validated();

        $error = DB::transaction(function () use ($data) {
            $computer = Computer::lockForUpdate()->findOrFail($data['computer_id']);

            if ($computer->status !== 'available') {
                return 'That computer is not available.';
            }

            ComputerSession::create($data + ['started_at' => now()]);
            $computer->update(['status' => 'in_use']);

            return null;
        });

        if ($error) {
            return back()->withInput()->withErrors(['computer_id' => $error]);
        }

        return redirect()->route('sessions.index')->with('status', 'Session started.');
    }

    public function end(ComputerSession $session)
    {
        $ended = DB::transaction(function () use ($session) {
            $session = ComputerSession::lockForUpdate()->find($session->id);

            if ($session->ended_at) {
                return false;
            }

            $session->update(['ended_at' => now()]);
            $session->computer()->update(['status' => 'available']);

            return true;
        });

        return redirect()->route('sessions.index')->with(
            $ended ? 'status' : 'error',
            $ended ? 'Session ended.' : 'This session already ended.'
        );
    }
}
