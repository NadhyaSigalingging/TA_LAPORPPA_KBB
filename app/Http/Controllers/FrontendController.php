<?php

namespace App\Http\Controllers;

use App\Models\Society;
use App\Models\Complaint;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Date;



class FrontendController extends Controller
{

    public function login()
    {
        return view('frontend.login.login');
    }


    public function register()
    {
        return view('frontend.register.index');
    }


    public function save(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|digits:16|unique:society,nik',
            'name' => 'required|min:2|max:50',
            'username' => 'required|min:2|max:20|unique:society,username',
            'email' => 'required|email|unique:society,email',
            'password' => 'required|min:6|max:20|confirmed',
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus tepat 16 digit angka.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'name.required' => 'Nama lengkap wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah dipakai, pilih yang lain.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $society = new Society();
        $society->nik = $validated['nik'];
        $society->name = $validated['name'];
        $society->username = $validated['username'];
        $society->email = $validated['email'];
        $society->password = Hash::make($validated['password']);
        $society->photo = 'default.png';

        $society->save();

        return redirect()->route('user_login')
            ->with('success', 'Registrasi berhasil! Silakan login.');
    }


    public function postlogin(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ], [
            'login.required' => 'Username atau email wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Cek apakah input berupa email atau username
        $loginField = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $society = Society::where($loginField, $request->login)->first();

        if ($society && Hash::check($request->password, $society->password)) {
            Session::put([
                'society_id' => $society->id,
                'nik' => $society->nik,
                'name' => $society->name,
                'username' => $society->username,
                'email' => $society->email,
                'photo' => $society->photo,
                // Data tambahan (nullable, dari profil)
                'phone_number' => $society->phone_number,
                'address' => $society->address,
                'birth_date' => $society->birth_date,
                'gender' => $society->gender,
            ]);

            return redirect()->route('user_home')
                ->with('success', 'Login berhasil! Selamat datang, ' . $society->name . '.');
        }

        return back()
            ->with('error', 'Username/email atau password salah.')
            ->withInput($request->only('login'));
    }

    public function publicHome()
    {
        return view('frontend.home.index');
    }


    public function home()
    {
        if (!Session::has('society_id')) {
            return redirect()->route('user_login');
        }

        $count_complaint = Complaint::where('society_id', Session::get('society_id'))->count();

        return view('frontend.complaint.index', compact('count_complaint'));
    }

    public function chooseVictim()
    {
        if (!Session::has('society_id')) {
            return redirect()->route('user_login');
        }

        return view('frontend.complaint.choose_victim');
    }

    public function add_complaint()
    {
        if (!Session::has('society_id')) {
            return redirect()->route('user_login');
        }

        $victimType = request('victim_type', 'self');

        // Ambil data profil terbaru dari database
        $society = Society::findOrFail(Session::get('society_id'));

        return view('frontend.complaint.add', compact('victimType', 'society'));
    }

    public function save_complaint(Request $request)
    {
        $rules = [
            'victim_type' => 'required|in:self,other',
            'jenis_kekerasan' => 'required|in:fisik,psikis,seksual,ekonomi,penelantaran',
            'nama_korban' => 'required|min:3|max:100',
            'tgl_lahir_korban' => 'required|date|before:today',
            'jenis_kelamin_korban' => 'required|in:perempuan,laki-laki',
            'alamat_korban_tinggal' => 'required|min:5|max:500',
            'nomor_korban' => 'required|min:10|max:13',
            'alamat_korban' => 'required|min:5|max:500',
            'waktu_kejadian' => 'required|date_format:Y-m-d\TH:i|before_or_equal:now',
            'contents_of_the_report' => 'required|min:10|max:5000',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50000',
            // NIK korban: opsional untuk semua (self sudah dari session, other tidak wajib)
            'nik_korban' => 'nullable|digits:16',
        ];

        $request->validate($rules, [
            'tgl_lahir_korban.required' => 'Tanggal lahir korban wajib diisi.',
            'tgl_lahir_korban.date' => 'Format tanggal lahir tidak valid.',
            'tgl_lahir_korban.before' => 'Tanggal lahir tidak boleh hari ini atau masa depan.',
            'nik_korban.digits' => 'NIK korban harus tepat 16 digit angka.',
            'nomor_korban.required' => 'Nomor telepon korban wajib diisi.',
            'nomor_korban.min' => 'Nomor telepon minimal 10 digit.',
        ]);

        // Cek NIK korban tidak boleh sama dengan NIK pelapor (jika diisi)
        if (
            $request->victim_type === 'other' &&
            $request->nik_korban &&
            $request->nik_korban === Session::get('nik')
        ) {
            return back()
                ->withErrors(['nik_korban' => 'NIK korban tidak boleh sama dengan NIK Anda sebagai pelapor.'])
                ->withInput();
        }

        try {
            // Generate kode unik: RPT-TAHUN-XXXXX (contoh: RPT-2026-A1B2C)
            do {
                $uniqueCode = 'RPT-' . date('Y') . '-' . strtoupper(substr(uniqid(), -5));
            } while (Complaint::where('unique_code', $uniqueCode)->exists());

            $complaint = new Complaint();
            $complaint->unique_code = $uniqueCode;
            $complaint->victim_type = $request->victim_type;
            $complaint->jenis_kekerasan = $request->jenis_kekerasan;
            $complaint->nama_korban = $request->nama_korban;
            $complaint->tgl_lahir_korban = $request->tgl_lahir_korban;
            $complaint->jenis_kelamin_korban = $request->jenis_kelamin_korban;
            $complaint->alamat_korban_tinggal = $request->alamat_korban_tinggal;
            $complaint->alamat_korban = $request->alamat_korban;
            $complaint->waktu_kejadian = $request->waktu_kejadian;
            $complaint->nomor_korban = $request->nomor_korban;
            $complaint->contents_of_the_report = $request->contents_of_the_report;
            $complaint->status = '0';
            $complaint->nik = Session::get('nik');
            $complaint->society_id = Session::get('society_id');
            $complaint->date_complaint = Date::now()->format('Y-m-d');

            // NIK korban
            if ($request->victim_type === 'self') {
                $complaint->nik_korban = Session::get('nik');
            } else {
                // Opsional untuk orang lain
                $complaint->nik_korban = $request->nik_korban ?: null;
            }

            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $photoName = time() . '_' . $photo->getClientOriginalName();
                $photo->move(public_path('avatar_complaint'), $photoName);
                $complaint->photo = $photoName;
            }

            $complaint->save();



            return redirect()->route('complaint')
                ->with('success', 'Pengaduan berhasil dikirim! Kode laporan Anda: <strong>' . $uniqueCode . '</strong>. Simpan kode ini untuk melacak laporan.');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('user_login')
            ->with('success', 'Logout berhasil.');
    }

    public function complaint()
    {
        if (!Session::has('nik')) {
            return redirect('/');
        }

        $complaint = Complaint::where('nik', Session::get('nik'))->get();
        return view('frontend.complaint.index1', compact('complaint'));
    }

    public function detail_complaint($id)
    {
        if (!Session::has('nik')) {
            return redirect('/');
        }

        $complaint = Complaint::findOrFail($id);
        return view('frontend.complaint.detail', compact('complaint'));
    }

    public function track_complaint()
    {
        return view('frontend.complaint.track');
    }

    public function search_complaint(Request $request)
    {
        $request->validate([
            'unique_code' => 'required|min:3|max:20',
        ], [
            'unique_code.required' => 'Kode laporan wajib diisi.',
            'unique_code.min' => 'Kode laporan minimal 3 karakter.',
        ]);

        // Cari berdasarkan kode unik (case-insensitive)
        $complaint = Complaint::where(
            \Illuminate\Support\Facades\DB::raw('UPPER(unique_code)'),
            strtoupper(trim($request->unique_code))
        )->first();

        if (!$complaint) {
            return view('frontend.complaint.track', [
                'not_found' => true,
                'unique_code' => $request->unique_code,
            ]);
        }

        return view('frontend.complaint.track_result', compact('complaint'));
    }

    public function profile()
    {
        if (!Session::has('society_id')) {
            return redirect()->route('user_login');
        }

        // Ambil data terbaru dari database (bukan dari session)
        $society = Society::findOrFail(Session::get('society_id'));

        return view('frontend.profile.index', compact('society'));
    }

    public function updateProfile(Request $request)
    {
        if (!Session::has('society_id')) {
            return redirect()->route('user_login');
        }

        $society = Society::findOrFail(Session::get('society_id'));

        $request->validate([
            'nik' => 'required|digits:16|unique:society,nik,' . $society->id,
            'name' => 'required|min:2|max:50',
            'username' => 'required|min:2|max:20|unique:society,username,' . $society->id,
            'email' => 'required|email|unique:society,email,' . $society->id,
            'birth_date' => 'nullable|date|before:today',
            'gender' => 'nullable|in:perempuan,laki-laki',
            'phone_number' => 'nullable|min:10|max:13',
            'address' => 'nullable|min:5|max:500',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus tepat 16 digit angka.',
            'nik.unique' => 'NIK sudah dipakai akun lain.',
            'name.required' => 'Nama lengkap wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah dipakai akun lain.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah dipakai akun lain.',
            'birth_date.date' => 'Format tanggal lahir tidak valid.',
            'birth_date.before' => 'Tanggal lahir tidak boleh hari ini atau masa depan.',
            'phone_number.min' => 'Nomor telepon minimal 10 digit.',
            'phone_number.max' => 'Nomor telepon maksimal 13 digit.',
            'photo.image' => 'File harus berupa gambar.',
            'photo.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        // Simpan NIK lama sebelum diubah
        $oldNik = $society->nik;
        $nikBerubah = $request->nik !== $oldNik;

        // Update data society
        $society->nik = $request->nik;
        $society->name = $request->name;
        $society->username = $request->username;
        $society->email = $request->email;
        $society->birth_date = $request->birth_date ?: null;
        $society->gender = $request->gender ?: null;
        $society->phone_number = $request->phone_number ?: null;
        $society->address = $request->address ?: null;

        // Proses upload foto jika ada
        if ($request->hasFile('photo')) {
            if ($society->photo && $society->photo !== 'default.png') {
                $oldPath = public_path('avatar_society/' . $society->photo);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            $photo = $request->file('photo');
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('avatar_society'), $photoName);
            $society->photo = $photoName;
        }

        $society->save();

        // Jika NIK berubah, sinkronkan ke semua laporan milik user ini
        if ($nikBerubah) {
            // Update NIK pelapor di semua laporan
            Complaint::where('society_id', $society->id)
                ->update(['nik' => $request->nik]);

            // Update NIK korban khusus laporan yang korbannya diri sendiri
            Complaint::where('society_id', $society->id)
                ->where('victim_type', 'self')
                ->update(['nik_korban' => $request->nik]);
        }

        // Update session dengan data terbaru
        Session::put([
            'nik' => $society->nik,
            'name' => $society->name,
            'username' => $society->username,
            'email' => $society->email,
            'photo' => $society->photo,
            'phone_number' => $society->phone_number,
            'address' => $society->address,
            'birth_date' => $society->birth_date,
            'gender' => $society->gender,
        ]);

        // Pesan sukses, beri tahu user jika NIK berubah
        $message = 'Profil berhasil diperbarui!';
        if ($nikBerubah) {
            $message .= ' NIK telah diperbarui dan disinkronkan ke semua laporan Anda.';
        }

        return redirect()->route('user_profile')
            ->with('success', $message);
    }

}