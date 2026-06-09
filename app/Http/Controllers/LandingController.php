<?php

namespace App\Http\Controllers;

use App\Models\AttendanceDetail;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    public function kehadiranHariIni(): JsonResponse
    {
        $today = now()->toDateString();

        $details = AttendanceDetail::whereHas('attendance', function ($q) use ($today) {
            $q->whereDate('tanggal', $today);
        })
            ->with(['student.kelas'])
            ->latest('id')
            ->take(6)
            ->get();

        $records = $details->map(function ($d) {
            $initial = strtoupper(substr($d->student->nama ?? '?', 0, 1) . substr(explode(' ', $d->student->nama ?? ' ')[1] ?? '', 0, 1));
            return [
                'id'         => $d->id,
                'nama'       => $d->student->nama ?? 'Unknown',
                'inisial'    => $initial ?: '?',
                'kelas'      => $d->student->kelas->nama_kelas ?? '-',
                'status'     => ucfirst($d->status),
                'waktu'      => $d->created_at->format('H:i'),
                'created_at' => $d->created_at,
            ];
        });

        $counts = AttendanceDetail::whereHas('attendance', function ($q) use ($today) {
            $q->whereDate('tanggal', $today);
        })
            ->select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status');

        $total = $counts->sum();
        $summary = [
            'hadir' => $total > 0 ? round(($counts->get('hadir', 0) / $total) * 100) : 0,
            'telat' => $total > 0 ? round(($counts->get('telat', 0) / $total) * 100) : 0,
            'alfa'  => $total > 0 ? round(($counts->get('alfa', 0) / $total) * 100) : 0,
            'sakit' => $total > 0 ? round(($counts->get('sakit', 0) / $total) * 100) : 0,
            'izin'  => $total > 0 ? round(($counts->get('izin', 0) / $total) * 100) : 0,
        ];

        return response()->json([
            'records' => $records,
            'summary' => $summary,
            'total'   => $total,
        ]);
    }
}
