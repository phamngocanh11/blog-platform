<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $posts = $user->posts()->latest()->get();
        $totalLikes = (int) $posts->sum('likes');

        return view('user.profile.index', compact('user', 'posts', 'totalLikes'));
    }

    public function update(Request $request): RedirectResponse
    {
        $user = auth()->user();

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->update($validatedData);

        return redirect()->route('profile.edit')->with('success', 'Cập nhật thông tin thành công.');
    }

    public function changePassword(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = auth()->user();

        if (!Hash::check($validatedData['current_password'], $user->password)) {
            return redirect()->route('profile.edit')->with('error', 'Mật khẩu hiện tại không chính xác.');
        }

        $user->update([
            'password' => Hash::make($validatedData['new_password']),
        ]);

        return redirect()->route('profile.edit')->with('success', 'Đổi mật khẩu thành công.');
    }

    public function updateAvatar(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'avatar' => ['required', 'image', 'max:2048'],
        ]);

        $avatarPath = $validatedData['avatar']->store('avatars', 'public');

        auth()->user()->update([
            'avatar' => '/storage/'.$avatarPath,
        ]);

        return redirect()->route('profile.edit')->with('success', 'Cập nhật avatar thành công.');
    }
}
