<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'file_name' => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx', // Tambahkan validasi untuk tipe file
            'task_id' => 'required|exists:tasks,id', // Pastikan task_id valid
        ]);

        // Proses upload file
        if ($request->hasFile('file_name')) {
            $file = $request->file('file_name');
            $file_name = $file->hashName();

            // Simpan file ke storage
            $file->storeAs('public/attachments', $file_name);

            // Simpan data ke database
            Attachment::create([
                'file_name' => $file_name,
                'task_id' => $request->task_id,
            ]);

            // Redirect dengan pesan sukses
            return redirect()
                ->back()
                ->with('openModal', $request->task_id);
        } else {
            // Redirect dengan pesan error jika file tidak diunggah
            return redirect()->back()->with('error', 'File not uploaded');
        }
    }

    public function destroy($task_id, $file_name): RedirectResponse
    {
        // Cari attachment berdasarkan task_id dan file_name
        $attachment = Attachment::where('task_id', $task_id)->where('file_name', $file_name)->firstOrFail();

        // Hapus file fisik dari storage jika ada
        if (Storage::exists('public/attachments/' . $attachment->file_name)) {
            Storage::delete('public/attachments/' . $attachment->file_name);
        }

        // Hapus data dari database
        $attachment->delete();

        return redirect()->back()->with('message', 'Attachment deleted successfully');
    }
}
