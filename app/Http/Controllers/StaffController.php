<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffRequest;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->string('q')->trim();

        $staff = Staff::query()
            ->when($q->isNotEmpty(), fn ($query) => $query->where(fn ($w) => $w
                ->where('name', 'like', "%{$q}%")
                ->orWhere('email', 'like', "%{$q}%")
                ->orWhere('role', 'like', "%{$q}%")))
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('staff.index', compact('staff'));
    }

    public function create()
    {
        return view('staff.create');
    }

    public function store(StaffRequest $request)
    {
        $member = Staff::create($request->validated());

        return redirect()->route('staff.show', $member)->with('status', 'Staff member created.');
    }

    public function show(Staff $staff)
    {
        $staff->loadCount(['borrowings', 'computerSessions']);

        return view('staff.show', compact('staff'));
    }

    public function edit(Staff $staff)
    {
        return view('staff.edit', compact('staff'));
    }

    public function update(StaffRequest $request, Staff $staff)
    {
        $staff->update($request->validated());

        return redirect()->route('staff.show', $staff)->with('status', 'Staff member updated.');
    }

    public function destroy(Staff $staff)
    {
        // Cascade would delete their loans/sessions and corrupt stock and computer status
        if ($staff->borrowings()->active()->exists() || $staff->computerSessions()->active()->exists()) {
            return back()->with('error', 'This staff member has active loans or sessions.');
        }

        $staff->delete();

        return redirect()->route('staff.index')->with('status', 'Staff member deleted.');
    }
}
