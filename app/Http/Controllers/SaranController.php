<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Saran;

class SaranController extends Controller
{
     // Tampilkan semua saran (untuk admin)
     public function index()
     {
         $sarans = Saran::latest()->paginate(10);
         return view('admin.saran.index', compact('sarans'));
     }

    // Simpan saran dari form
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'saran' => 'required|string',
        ]);

        Saran::create($request->all());

        return redirect()->to(url()->previous() . '#saran-section')
                 ->with('success', 'Terima kasih atas saran Anda!');

    }


}
