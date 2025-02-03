<?php

namespace App\Http\Controllers;
use App\Models\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class ActionController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->user()) {
            return redirect()->route('login'); // Přesměrování na přihlášení
        }

        $userId = $request->user()->id;
        $actions = Action::where('user_id', $userId)->get();

        return view('blog', ['actions' => $actions]);
    }


    public function store(Request $request)
    {
        // Validace dat
        Action::create([
            'action' => $request->input('action'),
            'date' => $request->input('date'),
            'user_id' => Auth::id(), // <-- Přidáno user_id
        ]);




        // Přesměrování zpět na seznam záznamů s úspěšnou zprávou
        return redirect()->route('actions.index')->with('success', 'Záznam byl úspěšně uložen.');
    }
    public function edit(Action $action)
    {
        return view('blog', compact('action'));
    }

    public function update(Request $request, Action $action)
    {
        $request->validate([
            'action' => 'required',
            'date' => 'required|date',
        ]);

        $action->update($request->all());

        return redirect()->route('actions.index'); // Upravte dle potřeby
    }

    public function destroy(Action $action)
    {
        $action->delete();

        return redirect()->route('actions.index'); // Upravte dle potřeby
    }





}
