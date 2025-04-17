<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\PeminjamImport;
use App\Models\Peminjam;
use App\Models\TemporaryPeminjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class PeminjamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Peminjam::all();
        return view('users.peminjam.index', compact('data'));
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
        // Log::info('Incoming request data:', $request->all());
        // dump($request->all());

        try {
            $validated = $request->validate([
                'nama' => ['required', 'string', 'max:255'],
                'role' => ['required', 'integer'],
                'nis' => ['nullable', 'string', 'max:12', 'unique:peminjams,nis'],
                'nip' => ['nullable', 'string', 'max:18', 'unique:peminjams,nip'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:peminjams,email'],
                'no_telp' => ['nullable', 'digits_between:10,15', 'unique:peminjams,no_telp'],
                'password' => ['required', 'string', 'min:8'],
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log::error('Validation error:', $e->errors());
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        // dump($validated);
        // Log::info('Hasil validasi', $validated);

        try {
            Peminjam::create([
                'nama' => $validated['nama'],
                'role' => $validated['role'],
                'nis' => $validated['nis'],
                'nip' => $validated['nip'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'status' => 1,
            ]);
            return redirect()->route('kelola-peminjam')->with('success', 'Peminjam berhasil dibuat');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Peminjam gagal dibuat. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Peminjam $peminjam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $data = Peminjam::findOrFail($id);

        if (!$data) {
            return response()->json(['error' => 'Peminjam tidak ditemukan'], 404);
        }

        $data->makeHidden('password');
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peminjam $id)
    {
        // dump($request->all());
        // Log::info('incoming requests', $request->all());
        $peminjamId = $request->input('id-peminjam');
        $peminjam = Peminjam::findOrFail($peminjamId);

        try {
            $validated = $request->validate([
                'nama' => ['required', 'string', 'max:255'],
                'role' => ['required', 'integer'],
                'nis' => ['nullable', 'string', 'max:12', Rule::unique('peminjams', 'nis')->ignore($peminjam->id)],
                'nip' => ['nullable', 'string', 'max:18', Rule::unique('peminjams', 'nip')->ignore($peminjam->id)],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('peminjams', 'email')->ignore($peminjam->id)],
                'no_telp' => ['nullable', 'digits_between:10,15', Rule::unique('peminjams', 'no_telp')->ignore($peminjam->id)],
                'password' => ['nullable', 'string', 'min:8'],
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log::error('Validation error:', $e->errors());
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        // Log::info('validated', $validated);

        try {
            if ($request->role == 1) { // Siswa
                $validated['nip'] = null;
            } elseif ($request->role == 2) { // Guru
                $validated['nis'] = null;
            }

            $peminjam->update([
                'nama' => $validated['nama'],
                'role' => $validated['role'],
                'nis' => $validated['nis'],
                'nip' => $validated['nip'],
                'email' => $validated['email'],
                'no_telp' => $validated['no_telp'],
                'password' => $request->password ? Hash::make($request->password) : $id->password,
                'status' => 1,
            ]);
            return redirect()->route('kelola-peminjam')->with('success', 'Peminjam berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Peminjam gagal diperbarui. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Peminjam $peminjam)
    {
        // dump($request->all());
        $peminjamId = $request->id;
        // dump($peminjamId);
        $peminjam = Peminjam::find($peminjamId);
        if (!$peminjam) {
            return response()->json(['message' => 'Peminjam tidak ditemukan'], 404);
        }

        $peminjam->delete();
        return response()->json(['message' => 'Peminjam berhasil dihapus'], 200);
    }

    public function updateStatus(Request $request)
    {
        try {
            $peminjam = Peminjam::findOrFail($request->id);
            
            // if ($peminjam->status == $request->status) {
            //     return response()->json(['success' => true, 'new_status' => $peminjam->status]);
            // }
            
            $peminjam->status = $request->status;
            $peminjam->save();

            return response()->json(['success' => true, 'new_status' => $peminjam->status]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function importExcel(Request $request)
    {
        // dump($request->all());
        // Log::info('Incoming request data:', $request->all());
        $validated = $request->validate([
            'file' => ['required', 'file', 'mimes:xls,xlsx,xltx,xltm,csv'],
        ]);

        // Log::info('validated', $validated);

        $file = $request->file('file');
        $data['status'] = 1;
        $data['kode_import'] = Str::random(12);

        if (empty($file)) {
            return redirect()->back()->with('error', 'File tidak ditemukan');
        }

        $documentPath = 'import-peminjam/';
        $documentName = $file->getClientOriginalName();
        $file->move($documentPath, $documentName);

        // return $documentName; 

        Excel::import(new PeminjamImport($data), public_path($documentPath . $documentName));

        $kode_import = TemporaryPeminjam::where('kode_import', $data['kode_import'])->first();
        return redirect()->route('preview-excel-peminjam', $data['kode_import']);
    }

    public function previewExcel($kode_import)
    {
        $kode_import = TemporaryPeminjam::where('kode_import', $kode_import)->first();

        $data = TemporaryPeminjam::all();
        return view('users.peminjam.excel', compact('kode_import', 'data'));
    }

    public function simpanExcel(Request $request)
    {
        
        // dump($request->all());
        // Log::info('req', $request->all());
        
        TemporaryPeminjam::truncate();

        if (is_array($request->nama) && count($request->nama) > 0) {
            for ($i = 0; $i < count($request->nama); $i++) {
                try {
                    $nis = $request->nis[$i] ?? null;
                    $nip = $request->nip[$i] ?? null;

                    // priority: if nis exists, clear nip — and vice versa
                    if (!empty($nis)) {
                        $nip = null;
                    } elseif (!empty($nip)) {
                        $nis = null;
                    }

                    // avoid both being null — optional check
                    if (empty($nis) && empty($nip)) {
                        continue; // skip this row
                    }

                    Peminjam::updateOrCreate(
                        ['nis' => $nis, 'nip' => $nip], // match by nis or nip
                        [
                            'nama' => $request->nama[$i],
                            'role' => $request->role[$i],
                            'email' => $request->email[$i],
                            'no_telp' => $request->no_telp[$i],
                            'password' => Hash::make($request->password[$i]),
                            'status' => 1,
                        ]
                    );
                } catch (\Exception $e) {
                    // Log::error('Gagal simpan peminjam', ['error' => $e->getMessage()]);
                    return redirect()->back()->with('error', 'Peminjam gagal dibuat. Silakan coba lagi');
                }
                
            }
            return redirect()->route('kelola-peminjam')->with('success', 'Peminjam berhasil dibuat');
        }

        return redirect()->back()->with('error', 'Tidak ada data yang ditemukan');
    }
}
