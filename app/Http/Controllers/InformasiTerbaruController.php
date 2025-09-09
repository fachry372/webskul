<?php
namespace App\Http\Controllers;

use App\Models\InformasiTerbaru;
use App\Models\InformasiTerbaruGambar;
use App\Models\KategoriInformasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InformasiTerbaruController extends Controller
{
    public function index(Request $request)
{
    $query = InformasiTerbaru::with('kategori');

    // Filter pencarian
    if ($request->search) {
        $query->where('judul', 'like', '%'.$request->search.'%');
    }

    // Filter kategori
    if ($request->kategori) {
        $query->where('kategori_id', $request->kategori);
    }

    // Pagination 10 data
    $informasis = $query->orderBy('tanggal_publish', 'desc')->paginate(10);

    $kategoris = KategoriInformasi::all();

    return view('admin.informasi.index', compact('informasis','kategoris'));
}




    public function create()
    {
        $kategoris = KategoriInformasi::all();
        return view('admin.informasi.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255|unique:informasi_terbaru,judul',
            'isi' => 'required|string',
            'kategori_id' => 'required|exists:kategori_informasi,id',
            'status' => 'required|in:draft,publish',
            'tanggal_publish' => 'nullable|date',
            'gambar' => 'nullable|array',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif,webp,ico,x-icon|max:2048'
        ], [
            'judul.unique' => 'Judul informasi sudah digunakan, silakan pilih judul lain.'
        ]);

        $informasi = InformasiTerbaru::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'kategori_id' => $request->kategori_id,
            'status' => $request->status,
            'tanggal_publish' => $request->tanggal_publish
        ]);

        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                if ($file && $file->isValid()) {
                    $path = $file->store('informasi', 'public');
                    InformasiTerbaruGambar::create([
                        'informasi_id' => $informasi->id,
                        'nama_file' => $path
                    ]);
                }
            }
        }

        return redirect()->route('admin.informasi.index')->with('success','Informasi berhasil dibuat.');
    }

    public function edit(InformasiTerbaru $informasi)
    {
        $kategoris = KategoriInformasi::all();
        return view('admin.informasi.edit', compact('informasi','kategoris'));
    }

    public function update(Request $request, InformasiTerbaru $informasi)
{
    $request->validate([
        'judul' => 'required|string|max:255|unique:informasi_terbaru,judul,' . $informasi->id,
        'isi' => 'required|string',
        'kategori_id' => 'required|exists:kategori_informasi,id',
        'status' => 'required|in:draft,publish',
        'tanggal_publish' => 'nullable|date',
        'gambar.*' => 'image|mimes:jpeg,png,jpg,gif,webp,ico|max:2048'
    ], [
        'judul.unique' => 'Judul informasi sudah digunakan, silakan pilih judul lain.'
    ]);

    $informasi->update([
        'judul' => $request->judul,
        'isi' => $request->isi,
        'kategori_id' => $request->kategori_id,
        'status' => $request->status,
        'tanggal_publish' => $request->tanggal_publish
    ]);

    if ($request->filled('delete_gambar')) {
        $ids = explode(',', $request->delete_gambar);
        foreach ($ids as $id) {
            $img = InformasiTerbaruGambar::find($id);
            if ($img) {
                if (\Storage::disk('public')->exists($img->nama_file)) {
                    \Storage::disk('public')->delete($img->nama_file);
                }
                $img->delete();
            }
        }
    }

    if ($request->hasFile('gambar')) {
        foreach ($request->file('gambar') as $file) {
            $path = $file->store('informasi','public');
            InformasiTerbaruGambar::create([
                'informasi_id' => $informasi->id,
                'nama_file' => $path
            ]);
        }
    }

    return redirect()->route('admin.informasi.index')->with('success','Informasi berhasil diupdate.');
}


    public function destroy(InformasiTerbaru $informasi)
    {
        foreach($informasi->gambar as $img){
            if(Storage::exists('public/'.$img->nama_file)){
                Storage::delete('public/'.$img->nama_file);
            }
        }

        $informasi->delete();
        return redirect()->route('admin.informasi.index')->with('success','Informasi berhasil dihapus.');
    }
}
