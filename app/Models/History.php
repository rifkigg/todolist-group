<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class History extends Model
{
    use HasFactory;

    protected $fillable = ['task_name', 'start', 'paused', 'finish'];

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_name', 'name'); // Asumsi 'task_name' di History merujuk ke 'name' di Task
    }

    public static function calculateTotalTime($taskName)
    {
        $totalTime = 0; // Inisialisasi total waktu sebagai angka 0
        $elapsedTime = 0; // Inisialisasi elapsed_time

        // Ambil semua record dari tabel History berdasarkan task name
        $histories = self::where('task_name', $taskName)->orderBy('created_at')->get();

        $startTime = null; // Menyimpan waktu mulai sementara

        foreach ($histories as $history) {
            // Tambahkan logika untuk memeriksa nilai start dan paused
            if (empty($history->start)) {
                $history->start = 0; // Set start menjadi 0 jika kosong
            }
            if (empty($history->paused)) {
                $history->paused = 0; // Set paused menjadi 0 jika kosong
            }

            if ($history->start) {
                $startTime = Carbon::parse($history->start); // Set waktu mulai jika ada
            } elseif ($history->paused && $startTime) {
                $pauseTime = Carbon::parse($history->paused);
                
                // Validasi untuk memastikan tidak ada nilai negatif
                if ($pauseTime->greaterThan($startTime)) {
                    $selisih = $startTime->diffInSeconds($pauseTime); // Selisih dalam detik
                    $totalTime += $selisih; // Tambahkan selisih ke total
                }
                $startTime = null; // Reset waktu mulai setelah dihitung
            }
        }

        // Hitung elapsed_time jika tugas sedang berjalan
        if ($startTime) {
            $elapsedTime = $startTime->diffInSeconds(Carbon::now()); // Menghitung waktu yang telah berlalu
            // $elapsedTime = $elapsedTimeBefore + $totalTime; // Menambahkan selisih ke elapsed_time
        }

        // Kembalikan total waktu dan elapsed_time sebagai array
        return [
            'totalTime' => $totalTime,
            'elapsedTime' => $elapsedTime,
        ];
    }
    
}