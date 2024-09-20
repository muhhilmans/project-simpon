<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Level;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class ManageSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPages = $request->get('perPage') ?? 5;
        $levels = Level::all();
        $users = User::with('roles')->whereHas('roles', function ($query) {
            $query->where('name', 'tutor');
        })->get();

        if ($perPages == 'all') {
            $datas = Subject::all();
        } else {
            $perPage = intval($perPages);
            $datas = Subject::latest()->paginate($perPage);
        }

        return view('cms.pages.subject.index', compact(['datas', 'levels', 'users']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'level_id' => ['required'],
            'user_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->errors());
        }

        try {
            DB::transaction(function () use ($request, &$store) {
                $store = Subject::create([
                    'name' => $request->name,
                    'level_id' => $request->level_id,
                    'user_id' => $request->user_id,
                ]);
            });
            if ($store) {
                return redirect()->route('subject.index')->with('success', 'Mata Pelajaran berhasil ditambahkan!');
            } else {
                return back()->with('error', 'Mata Pelajaran gagal ditambahkan!');
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
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'level_id' => ['required'],
            'user_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->errors());
        }

        try {
            DB::transaction(function () use ($request, $subject, &$update) {
                $update = $subject->update([
                    'name' => $request->name,
                    'level_id' => $request->level_id,
                    'user_id' => $request->user_id,
                ]);
            });
            if ($update) {
                return redirect()->route('subject.index')->with('success', 'Mata Pelajaran berhasil diperbarui!');
            } else {
                return back()->with('error', 'Mata Pelajaran gagal diperbarui!');
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
    public function destroy(Subject $subject): RedirectResponse
    {
        try {
            DB::transaction(function () use ($subject, &$delete) {
                $delete = $subject->delete();
            });
            if ($delete) {
                return redirect()->route('subject.index')->with('success', 'Mata Pelajaran berhasil dihapus!');
            } else {
                return back()->with('error', 'Mata Pelajaran gagal dihapus!');
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
