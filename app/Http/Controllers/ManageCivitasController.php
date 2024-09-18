<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\CivitasProfile;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class ManageCivitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPages = $request->get('perPage') ?? 5;
        $roles = Role::where('name', '!=', 'wargabelajar');

        if (Auth::user()->roles->pluck('name')->intersect(['admin', 'ketua'])->isNotEmpty()) {
            $roles = $roles->where('name', '!=', 'superadmin');
        }

        $roles = $roles->get();

        if ($perPages == 'all') {
            $users = User::with('roles')->whereHas('roles', function ($query) {
                $query->whereIn('name', ['superadmin', 'ketua', 'admin', 'tutor']);
            })->get();
        } else {
            $perPage = intval($perPages);
            $users = User::with('roles')->whereHas('roles', function ($query) {
                $query->whereIn('name', ['superadmin', 'ketua', 'admin', 'tutor']);
            })->latest()->paginate($perPage);
        }

        return view('cms.pages.user.civitas.index', compact(['users', 'roles']));
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

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_active' => true
        ]);

        $user->assignRole($request->role);

        CivitasProfile::create([
            'user_id' => $user->id,
            'name' => $request->name,
        ]);

        return redirect()->route('civitas.index')->with('success', 'Civitas berhasil ditambahkan!');
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

            $civitas = CivitasProfile::where('user_id', $id)->firstOrFail();
            if ($request->input('name') !== $civitas->name) {
                $civitas->name = $request->input('name');
            }
            $civitas->save();

            DB::commit();

            return redirect()->route('civitas.index')->with('success', 'Civitas berhasil diperbarui!');
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

        return redirect()->route('civitas.index')->with('success', 'Civitas berhasil dihapus!');
    }
}
