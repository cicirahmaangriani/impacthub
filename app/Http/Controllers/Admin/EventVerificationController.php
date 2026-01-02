<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;

class EventVerificationController extends Controller
{
    public function approve(Event $event)
    {
        $event->update(['status' => 'published']);
        return back()->with('success', 'Event berhasil di-approve (published).');
    }

    public function reject(Event $event)
    {
        $event->update(['status' => 'draft']);
        return back()->with('success', 'Event berhasil di-reject (draft).');
    }
}
