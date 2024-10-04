<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\ChapterMaterial;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ManageChapterMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPages = $request->get('perPage', 5);
        $user = auth()->user();

        if ($user->roles->pluck('name')->contains('tutor')) {
            $subjects = Subject::where('user_id', $user->id)->get();

            if ($subjects->isNotEmpty()) {
                $datas = ChapterMaterial::whereIn('subject_id', $subjects->pluck('id'))->paginate($perPages);
            } else {
                $datas = collect();
            }
        } else {
            $subjects = Subject::all();
            $datas = ChapterMaterial::paginate($perPages);
        }

        return view('cms.pages.chapter.index', compact('datas', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'subject_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->errors());
        }

        try {
            DB::transaction(function () use ($request, &$store) {
                $store = ChapterMaterial::create([
                    'name' => $request->name,
                    'subject_id' => $request->subject_id,
                ]);
            });
            if ($store) {
                return redirect()->route('chapter.index')->with('success', 'Bab Materi berhasil ditambahkan!');
            } else {
                return back()->with('error', 'Bab Materi gagal ditambahkan!');
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
    public function update(Request $request, string $id): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'subject_id' => ['required', 'exists:subjects,id'],
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->errors());
        }

        try {
            DB::transaction(function () use ($request, $id, &$update) {
                $chapterMaterial = ChapterMaterial::findOrFail($id);

                $update = $chapterMaterial->update([
                    'name' => $request->name,
                    'subject_id' => $request->subject_id,
                ]);
            });
            if ($update) {
                return redirect()->route('chapter.index')->with('success', 'Bab Materi berhasil diperbarui!');
            } else {
                return back()->with('error', 'Bab Materi gagal diperbarui!');
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
    public function destroy(Request $request, string $id)
    {
        try {
            $chapterMaterial = ChapterMaterial::findOrFail($id);
            
            DB::transaction(function () use ($chapterMaterial, &$delete) {
                if ($chapterMaterial->subChapterMaterial()->count() == 0) {
                    $delete = $chapterMaterial->delete();
                }
            });
            
            if ($delete) {
                return redirect()->route('chapter.index')->with('success', 'Bab Materi berhasil dihapus!');
            } else {
                return back()->with('error', 'Masih ada sub materi yang menggunakan bab materi ini!');
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
