<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivityForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        // Optional: batasi akses jika bukan user
        if ($user->role !== 'user') {
            abort(403, 'Akses ditolak.');
        }

        // Ambil semua activity milik user yang login
        $activities = $user->role === 'admin'
            ? Activity::with('activityForm', 'user')->latest()->get()
            : Activity::with('activityForm')->where('user_id', $user->id)->latest()->get();

        return view('activities.index', compact('activities'));
    }

    /**
     * Tampilkan form untuk mengisi aktivitas berdasarkan form kegiatan.
     */
    public function create()
    {
        $activityForms = ActivityForm::all();
        return view('activities.create', compact('activityForms'));
    }


    /**
     * Simpan aktivitas baru yang diisi oleh user.
     */
    public function store(Request $request)
    {
        $request->validate([
            'activity_form_id' => 'required|exists:activity_forms,id',
            'title' => 'nullable|string',
            'description' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        Activity::create([
            'user_id' => Auth::id(),
            'activity_form_id' => $request->activity_form_id,
            // 'title' => $request->title,
            'description' => $request->description,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => 'menunggu',
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('user.activities.index')->with('success', 'Aktivitas berhasil dikirim!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Ambil data aktivitas berdasarkan ID
        $activity = Activity::findOrFail($id);

        // Ambil semua form aktivitas untuk dropdown judul
        $activityForms = ActivityForm::all();

        return view('activities.edit', compact('activity', 'activityForms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input dari form
        $request->validate([
            'activity_form_id' => 'required|exists:activity_forms,id',
            'description' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        // Cari dan update aktivitas
        $activity = Activity::findOrFail($id);
        $activity->update([
            'activity_form_id' => $request->activity_form_id,
            'description' => $request->description,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);

        return redirect()->route('user.activities.index')
            ->with('success', 'Aktivitas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();

        return redirect()->route('user.activities.index')
            ->with('success', 'Aktivitas berhasil dihapus.');
    }
}
