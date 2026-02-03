<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Presensi;
use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PresensiController extends Controller
{
    /**
     * Store attendance from QR Code
     */
    public function storeFromQr(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'status' => 'required|in:masuk,keluar',
        ]);

        $token = $request->token;
        $status = $request->status;
        $user = auth()->user();

        // 1. Validate Token from Cache
        if (!Cache::has('qr_token_' . $token)) {
            return response()->json([
                'success' => false,
                'message' => 'Token QR Code tidak valid atau sudah kadaluarsa.'
            ], 422);
        }

        // 2. Identify User & Work Schedule
        $jadwal = $user->employe->jadwal ?? Jadwal::first();
        if (!$jadwal) {
            return response()->json([
                'success' => false,
                'message' => 'Jadwal kerja Anda belum diatur.'
            ], 422);
        }

        $now = Carbon::now('Asia/Jakarta');
        $tanggal = $now->toDateString();

        // 3. Logic for Night Shift Check-out
        if ($status === 'keluar') {
            $isNightShift = $jadwal->jam_keluar < $jadwal->jam_masuk;
            if ($isNightShift && $now->hour < 12) {
                $tanggal = $now->copy()->subDay()->toDateString();
            }

            // Must have check-in for the same date
            $hasCheckIn = Presensi::where('user_id', $user->id)
                ->where('tanggal', $tanggal)
                ->where('status', 'masuk')
                ->exists();

            if (!$hasCheckIn) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda belum melakukan absen masuk.'
                ], 422);
            }
        }

        // 4. Check for Duplicate
        $exists = Presensi::where('user_id', $user->id)
            ->where('tanggal', $tanggal)
            ->where('status', $status)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah melakukan absen ' . $status . ' hari ini.'
            ], 422);
        }

        // 5. Create Attendance Record
        $presensi = Presensi::create([
            'user_id' => $user->id,
            'jadwal_id' => $jadwal->id,
            'status' => $status,
            'jam' => $now->toTimeString(),
            'tanggal' => $tanggal,
        ]);

        // 6. Optional: Burn token after use to prevent replay
        // Cache::forget('qr_token_' . $token);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil absen ' . $status . '.',
            'data' => [
                'jam' => $presensi->jam,
                'tanggal' => $presensi->tanggal,
                'status' => $presensi->status
            ]
        ]);
    }
    /**
     * Get attendance history for current user
     */
    public function history()
    {
        $history = Presensi::with('jadwal')
            ->where('user_id', auth()->id())
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam', 'desc')
            ->limit(30)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $history
        ]);
    }
}
