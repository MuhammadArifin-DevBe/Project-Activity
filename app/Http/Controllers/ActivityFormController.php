<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Barryvdh\DomPDF\PDF;
use App\Models\ActivityForm;
use Illuminate\Http\Request;
use App\Exports\ActivityFormsExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;


class ActivityFormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // app/Http/Controllers/ActivityController.php

    public function index()
    {
        // untuk halaman kegiatan
        $activities = ActivityForm::latest()->paginate(10);
        return view('activity_forms.index', compact('activities'));
    }

    public function pengajuan()
    {
        $activities = Activity::with('user', 'activityForm')->latest()->get();
        return view('admin.status.pengajuan', compact('activities'));
    }


    public function approve(Activity $activity)
    {
        $activity->update(['status' => 'disetujui']);
        return redirect()->back()->with('success', 'Pengajuan disetujui.');
    }

    public function reject(Activity $activity)
    {
        $activity->update(['status' => 'ditolak']);
        return redirect()->back()->with('success', 'Pengajuan ditolak.');
    }


    public function exportPdf()
    {
        $activities = ActivityForm::all();

        $pdf = app('dompdf.wrapper')->loadView('activity_forms.pdf', compact('activities'));
        return $pdf->download('activity-forms.pdf');
    }



    public function exportExcel()
    {
        return Excel::download(new ActivityFormsExport, 'activity_forms.xlsx');
    }

    public function exportCsv()
    {
        return Excel::download(new ActivityFormsExport, 'activity_forms.csv');
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('activity_forms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:225',
            'description' => 'required|string',
        ]);

        ActivityForm::create([
            'title' => $request->title,
            'description' => $request->description,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('admin.forms.index')->with('success', 'Activity Form created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $activity = ActivityForm::findOrFail($id);
        return view('activity_forms.show', compact('activity'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $activity = ActivityForm::findOrFail($id);
        return view('activity_forms.edit', compact('activity'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:225',
            'description' => 'required|string',
        ]);
        $activity = ActivityForm::findorFail($id);
        $activity->update($request->all());
        return redirect()->route('admin.forms.index')->with('success', 'Activity updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $activity = ActivityForm::findorFail($id);
        $activity->delete();
        return redirect()->route('admin.forms.index')->with('success', 'Activity deleted successfully');
    }
}
