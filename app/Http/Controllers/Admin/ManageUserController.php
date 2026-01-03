<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class ManageUserController extends Controller
{
    public function index()
    {
        // Sesuaikan kalau kolom role kamu beda
        $users = User::query()
            ->latest()
            ->paginate(10);

        return view('admin.manage-users.index', compact('users'));
    }
}
