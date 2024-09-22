<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Level;
use App\Models\Classroom;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use App\Models\ClassroomUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ManageClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPages = $request->get('perPage') ?? 5;
        $levels = Level::all();
        $schoolYear = SchoolYear::where('is_active', true)->get();

        if ($perPages == 'all') {
            $datas = Classroom::all();
        } else {
            $perPage = intval($perPages);
            $datas = Classroom::orderBy('name', 'asc')->paginate($perPage);
        }

        return view('cms.pages.classroom.index', compact(['datas', 'levels', 'schoolYear']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'level_id' => ['required'],
            'school_year_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->errors());
        }

        try {
            DB::transaction(function () use ($request, &$store) {
                $store = Classroom::create([
                    'name' => $request->name,
                    'level_id' => $request->level_id,
                    'school_year_id' => $request->school_year_id,
                ]);
            });
            if ($store) {
                return redirect()->route('classroom.index')->with('success', 'Rombongan Belajar berhasil ditambahkan!');
            } else {
                return back()->with('error', 'Rombongan Belajar gagal ditambahkan!');
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
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        if ($classroom) {
            $allStudents = User::role('wargabelajar')->where('is_active', true)->get();
            $classroomStudents = ClassroomUser::where('classroom_id', $classroom->id)->get();
            $studentsInAnyClassroom = ClassroomUser::pluck('user_id')->toArray();

            $availableStudents = $allStudents->filter(function ($student) use ($studentsInAnyClassroom) {
                return !in_array($student->id, $studentsInAnyClassroom);
            });

            return view('cms.pages.classroom.detail', [
                'classroom' => $classroom,
                'classroomStudents' => $classroomStudents,
                'students' => $availableStudents
            ]);
        } else {
            return Redirect::route('classroom.index')->with('error', 'Detail Rombongan Belajar tidak ditemukan!');
        }
    }

    public function addStudent(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $classroom = Classroom::find($id);

        if (!$classroom) {
            return Redirect::route('classroom.index')->with('error', 'Kelas tidak ditemukan!');
        }

        try {
            DB::transaction(function () use ($request, &$store, $id) {
                $store = ClassroomUser::create([
                    'classroom_id' => $id,
                    'user_id' => $request->input('user_id'),
                ]);
            });
            if ($store) {
                return redirect()->route('classroom.show', $id)->with('success', 'Warga Belajar berhasil ditambahkan!');
            } else {
                return back()->with('error', 'Warga Belajar gagal ditambahkan!');
            }
        } catch (\Throwable $th) {
            $data = [
                'message' => $th->getMessage(),
                'status' => 400
            ];

            return view('error', compact('data'));
        }
    }

    public function removeStudent(Request $request)
    {
        $student = ClassroomUser::findOrFail($request->data_id);

        try {
            DB::transaction(function () use ($student, &$delete) {
                $delete = $student->delete();
            });
            if ($delete) {
                return redirect()->back()->with('success', 'Warga Belajar berhasil dihapus!');
            } else {
                return back()->with('error', 'Warga Belajar gagal dihapus!');
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'level_id' => ['required'],
            'school_year_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->errors());
        }

        try {
            DB::transaction(function () use ($request, $classroom, &$update) {
                $update = $classroom->update([
                    'name' => $request->name,
                    'level_id' => $request->level_id,
                    'school_year_id' => $request->school_year_id,
                ]);
            });
            if ($update) {
                return redirect()->route('classroom.index')->with('success', 'Rombongan Belajar berhasil diperbarui!');
            } else {
                return back()->with('error', 'Rombongan Belajar gagal diperbarui!');
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
    public function destroy(Classroom $classroom): RedirectResponse
    {
        try {
            DB::transaction(function () use ($classroom, &$delete) {
                $delete = $classroom->delete();
            });
            if ($delete) {
                return redirect()->route('classroom.index')->with('success', 'Rombongan Belajar berhasil dihapus!');
            } else {
                return back()->with('error', 'Rombongan Belajar gagal dihapus!');
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
