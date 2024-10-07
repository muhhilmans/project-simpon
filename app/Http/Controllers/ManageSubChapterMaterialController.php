<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ChapterMaterial;
use App\Models\SubChapterMaterial;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ManageSubChapterMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPages = $request->get('perPage', 5);
        $user = auth()->user();

        if ($user->roles->pluck('name')->contains('tutor')) {
            // Ambil semua mata pelajaran yang dimiliki tutor
            $subjects = Subject::where('user_id', $user->id)->get();

            // Ambil semua ChapterMaterial berdasarkan mata pelajaran yang dimiliki tutor
            $chapters = ChapterMaterial::whereIn('subject_id', $subjects->pluck('id'))->get();

            // Jika ada ChapterMaterial, ambil data SubChapterMaterial sesuai chapter tersebut
            if ($chapters->isNotEmpty()) {
                $datas = SubChapterMaterial::whereIn('chapter_material_id', $chapters->pluck('id'))->paginate($perPages);
            } else {
                $datas = collect(); // Jika tidak ada bab, return data kosong
            }
        } else {
            // Untuk admin atau user selain tutor, ambil semua mata pelajaran dan bab materi
            $subjects = Subject::all();
            $chapters = ChapterMaterial::whereIn('subject_id', $subjects->pluck('id'))->get();
            $datas = SubChapterMaterial::paginate($perPages);
        }

        return view('cms.pages.sub-chapter.index', compact('datas', 'subjects', 'chapters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'subject_id' => ['required', 'exists:subjects,id'],
            'chapter_id' => ['required', 'exists:chapter_materials,id'],
            'title' => ['required', 'string', 'max:255'],
            'format' => ['required', 'in:file,url'],
            'pdf_file' => ['required_if:format,file', 'nullable', 'file', 'mimes:pdf', 'max:5120'],
            'youtube_url' => ['required_if:format,url', 'nullable', 'url', 'max:255'],
            'description' => ['nullable', 'string']
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->errors());
        }

        try {
            DB::transaction(function () use ($request, &$store) {
                $subChapterData = [
                    'subject_id' => $request->subject_id,
                    'chapter_material_id' => $request->chapter_id,
                    'title' => $request->title,
                    'description' => $request->description,
                    'format' => $request->format,
                ];

                if ($request->format == 'file' && $request->hasFile('pdf_file')) {
                    $folderPath = 'chapter';

                    if (!Storage::exists('public/' . $folderPath)) {
                        Storage::makeDirectory('public/' . $folderPath);
                    }

                    $fileName = Str::slug($request->title) . '.pdf';

                    $pdfPath = $request->file('pdf_file')->storeAs('public/' . $folderPath, $fileName);

                    $subChapterData['file_path'] = str_replace('public/', '', $pdfPath);
                    $subChapterData['url'] = null;
                }

                if ($request->format == 'url') {
                    $subChapterData['url'] = $request->youtube_url;
                    $subChapterData['file_path'] = null;
                }

                $store = SubChapterMaterial::create($subChapterData);
            });

            if ($store) {
                return redirect()->route('sub-chapter.index')->with('success', 'Sub Bab Materi berhasil ditambahkan!');
            } else {
                return back()->with('error', 'Sub Bab Materi gagal ditambahkan!');
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
            'subject_id' => ['required', 'exists:subjects,id'],
            'chapter_id' => ['required', 'exists:chapter_materials,id'],
            'title' => ['required', 'string', 'max:255'],
            'format' => ['required', 'in:file,url'],
            'pdf_file' => ['nullable', 'file', 'mimes:pdf', 'max:5120'],
            'youtube_url' => ['nullable', 'url', 'max:255'],
            'description' => ['nullable', 'string']
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $subChapter = SubChapterMaterial::findOrFail($id);
            $update = false;

            DB::transaction(function () use ($request, $subChapter, &$update) {
                $hasChanges = false;

                $subChapterData = [
                    'chapter_material_id' => $request->chapter_id,
                    'title' => $request->title,
                    'description' => $request->description,
                    'format' => $request->format,
                ];

                if ($request->format === 'file') {
                    if ($request->hasFile('pdf_file')) {
                        if ($subChapter->file_path) {
                            Storage::delete($subChapter->file_path);
                        }

                        $fileName = Str::slug($request->title) . '.pdf';
                        $filePath = $request->file('pdf_file')->storeAs('public/chapter', $fileName);
                        $subChapterData['file_path'] =  str_replace('public/', '', $filePath);;
                        $hasChanges = true;
                    }
                    $subChapterData['url'] = null;
                    $hasChanges = true;
                } elseif ($request->format === 'url') {
                    $subChapterData['url'] = $request->youtube_url;
                    $hasChanges = true;
                    if ($subChapter->file_path) {
                        if (Storage::disk('public')->exists($subChapter->file_path)) {
                            Storage::disk('public')->delete($subChapter->file_path);
                        }
                        $subChapterData['file_path'] = null;
                        $hasChanges = true;
                    }
                }
                
                if ($hasChanges || $subChapter->isDirty($subChapterData)) {
                    $update = $subChapter->update($subChapterData);
                }
            });

            if ($update) {
                return redirect()->route('sub-chapter.index')->with('success', 'Sub Bab Materi berhasil diperbarui!');
            } else {
                return back()->with('error', 'Sub Bab Materi gagal diperbarui!');
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
            $subChapter = SubChapterMaterial::findOrFail($id);

            DB::transaction(function () use ($subChapter, &$delete) {
                if ($subChapter->file_path && Storage::disk('public')->exists($subChapter->file_path)) {
                    Storage::disk('public')->delete($subChapter->file_path);
                }
                $delete = $subChapter->delete();
            });

            if ($delete) {
                return redirect()->route('sub-chapter.index')->with('success', 'Sub Bab Materi berhasil dihapus!');
            } else {
                return back()->with('error', 'Sub Bab Materi gagal dihapus!');
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
