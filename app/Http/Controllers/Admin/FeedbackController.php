<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index(Request $request)
    {
        $query = Feedback::with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $feedbacks = $query->latest()->paginate(20);

        return view('admin.feedback.index', compact('feedbacks'));
    }

    public function show(Feedback $feedback)
    {
        if ($feedback->status === 'pending') {
            $feedback->update([
                'status' => 'dibaca',
                'read_at' => now(),
            ]);
        }

        return view('admin.feedback.show', compact('feedback'));
    }

    public function update(Request $request, Feedback $feedback)
    {
        $validated = $request->validate([
            'reply' => 'nullable|string|max:2000',
            'status' => 'required|in:pending,dibaca,ditindaklanjuti',
        ]);

        $feedback->update([
            'reply' => $validated['reply'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.feedback.index')
            ->with('success', 'Feedback berhasil diperbarui.');
    }

    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        return redirect()->route('admin.feedback.index')
            ->with('success', 'Feedback berhasil dihapus.');
    }
}
