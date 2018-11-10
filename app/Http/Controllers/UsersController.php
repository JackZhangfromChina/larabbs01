<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
class UsersController extends Controller
{
    public function show(User $user)
    {
//        dd($user);
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }
    public function update(UserRequest $request, User $user,ImageUploadHandler $uploader)
    {

        if ($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $user->id,362);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }
//        dd($data['avatar']);
        $user->update($data);
//        dd($user);
        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功！');
    }













}
