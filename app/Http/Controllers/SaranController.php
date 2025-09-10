<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Saran;

class SaranController extends Controller
{
     // Tampilkan semua saran (untuk admin)
     public function index(Request $request)
     {
         $query = Saran::query();

         // Filter pencarian
         if ($request->filled('search')) {
             $search = $request->search;
             $query->where(function ($q) use ($search) {
                 $q->where('nama', 'like', "%{$search}%")
                   ->orWhere('email', 'like', "%{$search}%")
                   ->orWhere('saran', 'like', "%{$search}%");
             });
         }

         // Filter tanggal
         if ($request->filled('start_date')) {
             $query->whereDate('created_at', '>=', $request->start_date);
         }

         if ($request->filled('end_date')) {
             $query->whereDate('created_at', '<=', $request->end_date);
         }

         // Tentukan jumlah per halaman (default 10)
         $perPage = $request->get('per_page', 10);

         $sarans = $query->latest()->paginate($perPage)->appends($request->query());

         return view('admin.saran.index', compact('sarans'));
     }
     public function show(Saran $saran)
     {
         return view('admin.saran.show', compact('saran'));
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
