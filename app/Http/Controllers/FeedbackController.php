<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function create()
    {
        return view('feedback.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|in:saran,kritik,masukan,laporan,lainnya',
            'message' => 'required|string|min:10|max:2000',
        ]);

        Feedback::create([
            'user_id' => auth()->id(),
            'category' => $validated['category'],
            'message' => $validated['message'],
        ]);

        return redirect()->route('feedback.create')
            ->with('success', 'Terima kasih! Masukan Anda telah kami terima.');
    }
}
