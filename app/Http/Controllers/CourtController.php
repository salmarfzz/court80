<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use Illuminate\Http\Request;

class CourtController extends Controller
{
    // READ (Tampil & Filter Data)
    public function index(Request $request)
    {
        $search = $request->query('search', '');
        $sport  = $request->query('sport', '');
        $status = $request->query('status', '');

        $query = Coach::query();

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('license', 'LIKE', "%{$search}%");
            });
        }

        if (!empty($sport)) {
            $query->where('sport', $sport);
        }

        if (!empty($status)) {
            $query->where('status', $status);
        }

        $coaches = $query->orderBy('id', 'desc')->get();

        $totalCoach     = $coaches->count();
        $activeCoach    = $coaches->whereIn('status', ['Aktif', 'Active'])->count();
        $certifiedCoach = $coaches->whereNotNull('license')->count();

        return view('index', compact('coaches', 'search', 'sport', 'status', 'totalCoach', 'activeCoach', 'certifiedCoach'));
    }
// CREATE (Tambah Coach Baru)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'sport'   => 'required|string|max:50',
            'license' => 'nullable|string|max:100',
            'exp'     => 'required|numeric|min:0',
            'rate'    => 'required|numeric|min:0',
            'avatar'  => 'nullable|string',
            'status'  => 'required|string',
        ]);

        // Potong teks otomatis jika terlalu panjang agar MySQL tidak error
        // Potong teks otomatis jika terlalu panjang agar MySQL tidak error
        $validated['sport'] = substr($request->input('sport'), 0, 50);
        if (!empty($request->input('avatar'))) {
            $validated['avatar'] = substr($request->input('avatar'), 0, 255);
        }
        Coach::create($validated);

        return redirect()->route('coaches.index')->with('success', 'Coach berhasil ditambahkan!');
    }
    // UPDATE (Edit Coach)
    public function update(Request $request, $id)
    {
        $coach = Coach::findOrFail($id);

        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'sport'   => 'required|string',
            'license' => 'nullable|string|max:100',
            'status'  => 'required|string',
        ]);

        $coach->update($validated);

        return redirect()->route('coaches.index')->with('success', 'Data Coach berhasil diperbarui!');
    }

    // DELETE (Hapus coach)
    public function destroy($id)
    {
        // Cek apakah yang login adalah admin
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action. Anda bukan Admin.');
        }

        $coach = Coach::findOrFail($id);
        $coach->delete();

        return redirect('/coaches')->with('success', 'Data berhasil dihapus.');
    }
}