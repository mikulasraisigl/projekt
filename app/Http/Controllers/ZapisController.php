<?php

namespace App\Http\Controllers;



use App\Models\Zapis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ZapisController extends Controller
{
    public function ulozitZapis(Request $request)
    {
        $request->validate([
            'den' => 'required|date',
            'obsah' => 'required|string',
        ]);

        Zapis::create([
            'user_id' => Auth::id(), // ID přihlášeného uživatele
            'den' => $request->den,
            'obsah' => $request->obsah,
        ]);

        return response()->json(['message' => 'Zápis byl úspěšně uložen!']);
    }
}

