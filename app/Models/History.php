<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class History extends Model
{
    use HasFactory;

    protected $fillable = ['task_name', 'start', 'paused', 'finish'];


    public static function calculateTotalTime($taskName)
    {
        $totalTime = 0; // Inisialisasi total waktu sebagai angka 0
    
        // Ambil semua record dari tabel History berdasarkan task name
        $histories = self::where('task_name', $taskName)->orderBy('created_at')->get();
    
        $startTime = null; // Menyimpan waktu mulai sementara
    
        foreach ($histories as $history) {
            if ($history->start) {
                $startTime = Carbon::parse($history->start); // Set waktu mulai jika ada
            } elseif ($history->paused && $startTime) {
                $pauseTime = Carbon::parse($history->paused);
                $totalTime += $pauseTime->diffInSeconds($startTime); // Tambahkan selisih waktu ke total
                $startTime = null; // Reset waktu mulai setelah dihitung
            }
        }
    
        // Kembalikan total waktu sebagai angka (dalam detik)
        return $totalTime;
    }
    
}