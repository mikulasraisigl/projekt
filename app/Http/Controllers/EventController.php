<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Načtení všech událostí pro aktuálního uživatele.
     */
    public function index(Request $request)
    {
        $events = Event::forUser(Auth::id())->get();
        return view('plantreninku', compact('events'));

    }

    /**
     * Uložení nové události.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'repeat' => 'nullable|string|max:100',
        ]);

        Event::create([
            'title' => $validated['title'],
            'start' => $validated['start'],
            'repeat' => $validated['repeat'] ?? null,
            'completed' => false,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Trénink byl úspěšně vytvořen.');




    }

    /**
     * Aktualizace existující události.
     */
    public function update(Request $request, Event $event)
    {


        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'repeat' => 'nullable|string|max:100',
            'completed' => 'boolean',
        ]);

        $event->update($validated);

        return redirect()->back()->with('success', 'Trénink byl úspěšně aktualizován.');
    }


    /**
     * Smazání události.
     */
    public function destroy(Event $event)
    {


        $event->delete();

        return redirect()->back()->with('success', 'Trénink byl úspěšně smazán.');
    }

}
