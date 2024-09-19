<?php

namespace App\Http\Controllers;

use App\Models\SchoolYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class ManageSchoolYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPages = $request->get('perPage') ?? 5;

        if ($perPages == 'all') {
            $datas = SchoolYear::all();
        } else {
            $perPage = intval($perPages);
            $datas = SchoolYear::latest()->paginate($perPage);
        }

        return view('cms.pages.school-year.index', compact('datas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'early_year' => ['required', 'integer', 'digits:4'],
            'final_year' => ['required', 'integer', 'digits:4'],
            'semester' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->errors());
        }

        try {
            DB::transaction(function () use ($request, &$store) {
                $store = SchoolYear::create([
                    'early_year' => $request->early_year,
                    'final_year' => $request->final_year,
                    'semester' => $request->semester,
                    'is_active' => false
                ]);
            });
            if ($store) {
                return redirect()->route('school-year.index')->with('success', 'Tahun Ajaran berhasil ditambahkan!');
            } else {
                return back()->with('error', 'Tahun Ajaran gagal ditambahkan!');
            }
        } catch (\Throwable $th) {
            $data = [
                'message' => $th->getMessage(),
                'status' => 400
            ];

            return view('error', compact('data'));
        }
    }

    public function changeStatus(Request $request, SchoolYear $schoolYear)
    {
        $schoolYear->is_active = ($schoolYear->is_active == 1 ? 0 : 1);
        $schoolYear->save();

        return redirect()->route('school-year.index')->with('success', 'Warga Belajar berhasil ' . ($schoolYear->active == 1 ? 'Diaktifkan' : 'Dinonaktifkan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SchoolYear $schoolYear): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'early_year' => ['required', 'integer', 'digits:4'],
            'final_year' => ['required', 'integer', 'digits:4'],
            'semester' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->errors());
        }

        try {
            DB::transaction(function () use ($request, $schoolYear, &$update) {
                $update = $schoolYear->update([
                    'early_year' => $request->early_year,
                    'final_year' => $request->final_year,
                    'semester' => $request->semester,
                    'is_active' => false
                ]);
            });
            if ($update) {
                return redirect()->route('school-year.index')->with('success', 'Tahun Ajaran berhasil diperbarui!');
            } else {
                return back()->with('error', 'Tahun Ajaran gagal diperbarui!');
            }
        } catch (\Throwable $th) {
            $data = [
                'message' => $th->getMessage(),
                'status' => 400
            ];

            return view('error', compact('data'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, SchoolYear $schoolYear): RedirectResponse
    {
        try {
            DB::transaction(function () use ($schoolYear, &$delete) {
                $delete = $schoolYear->delete();
            });
            if ($delete) {
                return redirect()->route('school-year.index')->with('success', 'Tahun Ajaran berhasil dihapus!');
            } else {
                return back()->with('error', 'Tahun Ajaran gagal dihapus!');
            }
        } catch (\Throwable $th) {
            $data = [
                'message' => $th->getMessage(),
                'status' => 400
            ];

            return view('error', compact('data'));
        }
    }
}
