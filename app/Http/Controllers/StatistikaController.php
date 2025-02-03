<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Statistika;
class StatistikaController extends Controller
{
    public function index()
    {
        $statistiky = Statistika::where('user_id', Auth::id())->get(); // Data jen pro přihlášeného uživatele
        return view('statistika', compact('statistiky'));
    }

    // Uloží data z formuláře
    public function store(Request $request)
    {
        $request->validate([
            'typ_cviceni' => 'required|string',
            'datum' => 'required|date',
            'vaha' => 'nullable|numeric',
            'opakovani' => 'nullable|integer',
            'cas' => 'nullable',
        ]);

        Statistika::create([
            'user_id' => Auth::id(),      // ID aktuálně přihlášeného uživatele
            'typ_cviceni' => $request->typ_cviceni,
            'vaha' => $request->vaha,
            'opakovani' => $request->opakovani,
            'cas' => $request->cas,
            'datum' => $request->datum,
        ]);

        return redirect()->route('statistika.index')->with('success', 'Statistika byla úspěšně přidána.');
    }

}
