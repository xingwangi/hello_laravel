<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function __construct()
    {
//        只让未登录用户访问登录页面
        $this->middleware('guest', [
            'only'=>'create'
        ]);
    }

    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);
        if (\Auth::attempt($credentials,$request->has('remember'))) {
            // 登录成功后的相关操作
            session()->flash('success', '欢迎回来！');
            $fallback = route('users.show', \Auth::user());
            return redirect()->intended($fallback);

        } else {
            // 登录失败后的相关操作
            session()->flash('danger', '很抱歉，你的邮箱或者密码错误');
            return redirect()->back()->withInput();
        }
    }

    public function destroy()
    {
        \Auth::logout();
        session()->flash('success', '你也成功退出！');
        return redirect('login');
    }
}
