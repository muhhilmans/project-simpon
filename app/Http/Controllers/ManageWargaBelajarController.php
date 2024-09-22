<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Role;
use App\Models\User;
use App\Models\StudentFile;
use Illuminate\Http\Request;
use App\Models\StudentProfile;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class ManageWargaBelajarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPages = $request->get('perPage') ?? 5;
        $roles = Role::all();

        if ($perPages == 'all') {
            $users = User::with('roles')->whereHas('roles', function ($query) {
                $query->where('name', 'wargabelajar');
            })->get();
        } else {
            $perPage = intval($perPages);
            $users = User::with('roles')->whereHas('roles', function ($query) {
                $query->where('name', 'wargabelajar');
            })->latest()->paginate($perPage);
        }

        return view('cms.pages.user.wargabelajar.index', compact(['users', 'roles']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_active' => false,
        ]);

        StudentProfile::create([
            'user_id' => $user->id,
            'name' => $request->name,
        ]);

        StudentFile::create([
            'user_id' => $user->id,
        ]);

        $role = Role::findByName('wargabelajar', 'web');
        $user->assignRole($role);

        return redirect()->route('wargabelajar.index')->with('success', 'Warga Belajar berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        return view('cms.pages.user.wargabelajar.detail', compact('user'));
    }

    public function changeStatus(Request $request, User $user)
    {

        $user->is_active = ($user->is_active == 1 ? 0 : 1);
        $user->save();

        // if ($user->active == 1) {
        //     Mail::to($user->email)->send(new NotificationApproveUser);
        // }

        if ($user->is_active == 1) {
            return redirect()->route('wargabelajar.index')->with('success', 'Warga Belajar berhasil diaktifkan');
        }

        return redirect()->route('wargabelajar.index')->with('success', 'Warga Belajar berhasil dinonaktifkan');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $user = User::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255',
                'username' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('users')->ignore($user->id),
                ],
                'email' => [
                    'required',
                    'email',
                    'max:255',
                    Rule::unique('users')->ignore($user->id),
                ],
            ]);

            if ($request->input('username') !== $user->username) {
                $user->username = $request->input('username');
            }
            if ($request->input('email') !== $user->email) {
                $user->email = $request->input('email');
            }
            $user->save();

            $studentProfile = StudentProfile::where('user_id', $id)->firstOrFail();
            if ($request->input('name') !== $studentProfile->name) {
                $studentProfile->name = $request->input('name');
            }
            $studentProfile->save();

            DB::commit();

            return redirect()->route('wargabelajar.index')->with('success', 'Warga Belajar berhasil diperbarui!');
        } catch (Exception $e) {
            DB::rollBack();
            
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = User::findOrFail($request->user_id);

        $user->delete();

        return redirect()->route('wargabelajar.index')->with('success', 'Warga Belajar berhasil dihapus!');
    }
}
