<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GithubAuthController extends Controller

{

    Public function __construct() {
        $this->middleware(['guest']);
    }

    public function redirect() {
        return Socialite::driver('github')->redirect();
    }

    public function callback() {
        $user = Socialite::driver('github')->user();
        // dd($user);

        // 사용자 정보가 넘어왔을때 (login.php에서 github 버튼눌렀을때)
        // DB에 사용자 정보를 저장한다. 

        // 이미 이 사용자 정보가 DB에 저장되어 있다면 저장할 필요가 없다. (findOrCreate)
        // email] 까지 찾아보고 없으면 만들고 있으면 이후에 [pass ~ name] 검사

        // users 테이블에 문자열 24자리 랜덤으로 비번을 만들어주세요 (Hash에 Make시켜서 저장)
        // 아래 3개의 값들을 user 테이블에 넣도록 하자
        $user = User::firstOrCreate(
            ['email' => $user->getEmail()],

            ['password' => Hash::make(Str::random(24)),
            'name' => $user->getName()]
            
        );

        // 로그인 처리
        Auth::login($user);
        
        // 사용자가 원래 요청했던 페이지로 redirection 뷰를 반환
        // 대쉬보드로 가야되는데 로그인으로 redirect할 수도 있으니까 의도헀던 사이트로 이동하도록 설정
        // 만약 없다면 dashboard로 가도록 
        return redirect()->intended('/dashboard');
    }

}
