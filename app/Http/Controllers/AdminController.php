<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Admin::all();
        return view('users.admin.index', compact('data'));
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
    public function store(Request $request)
    {
        Log::info('Incoming request data:', $request->all());
        dump($request->all());

        try {
            $validated = $request->validate([
                'nama' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:admins,email'],
                'no_telp' => ['nullable', 'digits_between:10,15', 'unique:admins,no_telp'],
                'password' => ['required', 'string', 'min:8'],
                'role' => ['required', 'integer'],
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error:', $e->errors());
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        dump($validated);
        Log::info('Hasil validasi', $validated);
        // Validation errors are automatically handled by Laravel, so this block is unnecessary.

        try {
            Admin::create([
                'nama' => $validated['nama'],
                'email' => $validated['email'],
                'no_telp' => $validated['no_telp'],
                'password' => bcrypt($validated['password']),
                'role' => $validated['role'],
            ]);
            return redirect()->route('kelola-admin')->with('success', 'Admin berhasil dibuat');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $data = Admin::findOrFail($id); // Fetch only ONE admin

        if (!$data) {
            return response()->json(['error' => 'Admin not found'], 404);
        }

        $data->makeHidden('password');
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $id)
    {
        $adminId = $request->input('id-admin');
        $admin = Admin::findOrFail($adminId);

        try {
            $validated = $request->validate([
                'nama' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('admins', 'email')->ignore($admin->id)],
                'no_telp' => ['nullable', 'digits_between:10,15', Rule::unique('admins', 'no_telp')->ignore($admin->id)],
                'password' => ['nullable', 'string', 'min:8'],
                'role' => ['required', 'integer'],
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error:', $e->errors());
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        try {
            $admin->update([
                'nama' => $validated['nama'],
                'email' => $validated['email'],
                'no_telp' => $validated['no_telp'],
                'password' => $request->password ? bcrypt($request->password) : $id->password,
                'role' => $validated['role'],
            ]);
            return redirect()->route('kelola-admin')->with('success', 'Admin berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        dump($request->all());
        $adminId = $request->id;
        dump($adminId);
        $admin = Admin::find($adminId);
        if (!$admin) {
            return response()->json(['message' => 'Admin tidak ditemukan'], 404);
        }
        
        $admin->delete();
        return response()->json(['message' => 'Admin berhasil dihapus'], 200);
    }
}
