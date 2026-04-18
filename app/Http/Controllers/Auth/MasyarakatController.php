<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Society;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class MasyarakatController extends Controller
{
    public function index()
    {
        // ================= MASYARAKAT =================
        $masyarakat = Society::all();

        // ================= KORBAN (TIDAK DOUBLE + LENGKAP) =================
        $korban = DB::table('complaint')
            ->select(
                'nik_korban',
                'nama_korban',
                'nomor_korban',
                'alamat_korban_tinggal'
            )
            ->whereNotNull('nik_korban')
            ->distinct() // 🔥 anti double
            ->get();

        return view('auth.admin.masyarakat.index', compact('masyarakat', 'korban'));
    }

    public function create()
    {
        return view('auth.admin.masyarakat.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|min:2|max:20|unique:society,nik',
            'username' => 'required|min:2|max:20|unique:society,username',
            'email' => 'required|email|unique:society,email',
            'name' => 'required|min:2|max:20',
            'password' => 'required|min:5|max:20',
            'phone_number' => 'required',
            'address' => 'required',
            'photo' => 'required|image',
        ]);

        $masyarakat = new Society();
        $masyarakat->nik = $request->nik;
        $masyarakat->username = $request->username;
        $masyarakat->email = $request->email;
        $masyarakat->name = $request->name;
        $masyarakat->phone_number = $request->phone_number;
        $masyarakat->address = $request->address;
        $masyarakat->password = Hash::make($request->password);

        // upload foto
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $namaFoto = time() . "_" . $photo->getClientOriginalName();
            $photo->move(public_path('avatar_masyarakat'), $namaFoto);
            $masyarakat->photo = $namaFoto;
        }

        $masyarakat->save();

        return redirect()->route('auth.admin.masyarakat.index')
            ->with('success', 'Data masyarakat berhasil disimpan');
    }

    public function edit($id)
    {
        $data['masyarakat'] = Society::findOrFail($id);
        return view('auth.admin.masyarakat.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nik' => 'required|min:2|max:20|unique:society,nik,' . $id,
            'username' => 'required|min:2|max:20|unique:society,username,' . $id,
            'email' => 'required|email|unique:society,email,' . $id,
            'name' => 'required|min:2|max:20',
            'phone_number' => 'required',
            'address' => 'required',
        ]);

        $masyarakat = Society::findOrFail($id);

        $masyarakat->nik = $request->nik;
        $masyarakat->username = $request->username;
        $masyarakat->email = $request->email;
        $masyarakat->name = $request->name;
        $masyarakat->phone_number = $request->phone_number;
        $masyarakat->address = $request->address;

        if ($request->filled('password')) {
            $masyarakat->password = Hash::make($request->password);
        }

        // update foto
        if ($request->hasFile('photo')) {

            // hapus lama
            if ($masyarakat->photo && File::exists(public_path('avatar_masyarakat/' . $masyarakat->photo))) {
                File::delete(public_path('avatar_masyarakat/' . $masyarakat->photo));
            }

            $photo = $request->file('photo');
            $namaFoto = time() . "_" . $photo->getClientOriginalName();
            $photo->move(public_path('avatar_masyarakat'), $namaFoto);
            $masyarakat->photo = $namaFoto;
        }

        $masyarakat->save();

        return redirect()->route('auth.admin.masyarakat.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $masyarakat = Society::findOrFail($id);

        // hapus foto
        if ($masyarakat->photo && File::exists(public_path('avatar_masyarakat/' . $masyarakat->photo))) {
            File::delete(public_path('avatar_masyarakat/' . $masyarakat->photo));
        }

        $masyarakat->delete();

        return redirect()->back()
            ->with('success', 'Data berhasil dihapus');
    }
}