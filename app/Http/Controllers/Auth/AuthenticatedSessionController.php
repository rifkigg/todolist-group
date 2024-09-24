<?php

namespace App\Http\Controllers\Auth;

use App\Models\Task;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\TaskController;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Log;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('project.index', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Ambil task berdasarkan user yang sedang login
        $tasks = app(TaskController::class)->getTasksByUser(auth()->id());

        // Filter task yang belum di-pause
        $tasksNotPaused = $tasks->whereNotIn('timer_status', ['paused', 'finished'])->count();

        // Validasi jika ada task yang belum di-pause
        if ($tasksNotPaused > 0) {
            // Jika ada task yang belum di-pause, munculkan alert
            return redirect()->back()->with('alert', 'Pastikan semua task sudah di-pause sebelum logout.');
        }

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
