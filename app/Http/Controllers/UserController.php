<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\StudentFile;
use Illuminate\Http\Request;
use App\Models\CivitasProfile;
use App\Models\StudentProfile;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPages = $request->get('perPage') ?? 5;
        $roles = Role::all();

        if ($perPages == 'all') {
            $users = User::with('roles')->get();
        } else {
            $perPage = intval($perPages);
            $users = User::with('roles')->latest()->paginate($perPage);
        }

        return view('cms.pages.user.index', compact(['users', 'roles']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
            'role' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $role = Role::findById($request->role);

        if ($role->name == 'wargabelajar') {
            $active = 0;
        } else {
            $active = 1;
        }

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_active' => $active
        ]);

        $user->assignRole($request->role);

        if ($role->name == 'wargabelajar') {
            StudentProfile::create([
                'user_id' => $user->id,
                'name' => $request->name,
            ]);

            StudentFile::create([
                'user_id' => $user->id,
            ]);
        } else {
            CivitasProfile::create([
                'user_id' => $user->id,
                'name' => $request->name,
            ]);
        }

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditambahkan!');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['sometimes', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'role' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $role = Role::findById($request->role);
        $civitas = CivitasProfile::where('user_id', $user->id)->first();
        $student = StudentProfile::where('user_id', $user->id)->first();

        if ($role->name == 'wargabelajar') {
            if ($student) {
                $student->update(['name' => $request->name]);
            } else {
                if ($civitas) {
                    $civitas->delete();
                }

                StudentProfile::create([
                    'user_id' => $user->id,
                    'name' => $request->name,
                ]);
            }
        } else {
            if ($civitas) {
                $civitas->update(['name' => $request->name]);
            } else {
                if ($student) {
                    $student->delete();
                }

                CivitasProfile::create([
                    'user_id' => $user->id,
                    'name' => $request->name,
                ]);
            }
        }

        // $user = User::findOrFail($id);

        $user->email = $request->email;
        $user->username = $request->username;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $user->syncRoles($request->role);

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = User::findOrFail($request->user_id);

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus!');
    }
}
