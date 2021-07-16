<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $pwd = $request->input('pwd');
        $pwdc = $request->input('pwdc');
        $age = $request->input('age');
        $gender = $request->input('gender');
        $student = $request->input('student');
        $capCheck = $request->input('capCheck');

        $rules = [
            'id' => ['required', 'regex:/[a-zA-Z]{1}[a-zA-Z0-9_]{2,12}@[a-zA-Z0-9-]+\.[a-zA-Z0-9]+(\.[a-zA-Z0-9]+)?/'],
            'name' => ['required', 'regex:/[가-힣]/'],
            'pwd' => ['required', 'regex:/[a-zA-Z0-9!@#$%^&*()]{4,}/'],
            'age' => ['required', 'regex:/[0-9]/'],
            'gender' => ['required', 'regex:/(man)|(woman)/'],
            'student' => ['required', 'regex:/(es)|(ms)|(hs)/']
        ];

        $messages = [
            'id.required' => '아이디를 입력하세요.',
            'id.regex' => '아이디는 이메일 형식이어야 합니다.',
            'name.required' => '이름을 입력하세요.',
            'name.regex' => '이름은 한글만 가능합니다.',
            'pwd.required' => '비밀번호를 입력하세요.',
            'pwd.regex' => '비밀번호는 4글자 이상 입력하여야 합니다.',
            'pwdc.required' => '비밀번호 확인을 입력하세요.',
            'age.required' => '나이를 입력하세요.',
            'age.regex' => '나이는 정수만 입력가능합니다.',
            'gender.required' => '성별을 체크하세요.',
            'gender.regex' => '성별을 올바르게 체크하세요.',
            'student.required' => '학적을 입력하세요.',
            'student.regex' => '학적을 올바르게 입력하세요.',
            'capCheck.required' => '캡챠를 입력하세요.',
        ];

        // $input = $request->all();
        // $input->validate([
        //     'id' => 'required',
        //     'name' => 'required'
        // ]);

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) return back()->with('flash_message', '올바르지 않은 값이 있습니다.');
        if ($capCheck != "on") return back()->with('flash_message', 'captcha가 일치하지 않습니다.');
        if ($pwd !== $pwdc) return back()->with('flash_message', '비밀번호와 확인이 일치하지 않습니다.');

        $user = UserModel::select('id')->where('id', '=', $id)->first();
        if ($user) return back()->with('flash_message', '해당 아이디는 이미 존재합니다.');

        $gender = $gender == 'man' ? '남' : '여';
        if ($student == 'es') $student = '초등학생';
        if ($student == 'ms') $student = '중학생';
        if ($student == 'hs') $student = '고등학생';

        $user = UserModel::create(['userId' => $id, 'userName' => $name, 'userPwd' => bcrypt($pwd), 'gender' => $gender, 'age' => $age, 'student' => $student]);

        if (!$user) return back()->with('flash_message', '오류로 인하여 가입에 실패하였습니다.');

        return redirect('/')->with('flash_message', '성공적으로 가입되었습니다.');
    }

    public function login(Request $request)
    {
        $id = $request->input('id');
        $pwd = $request->input('pwd');

        $user = UserModel::where([  ['userId', '=', $id] ])->first();

        if (!$user) return back()->with('flash_message', '아이디가 존재하지 않습니다.');
        if (!Hash::check($pwd, $user->userPwd)) return back()->with('flash_message', '비밀번호가 일치하지 않습니다.');

        $request->session()->put('loginData', $user);
        return redirect('/')->with('flash_message', "{$user->userName}님 환영합니다");
    }

    public function logout(Request $request)
    {
        if ($request->session()->has('loginData')) $request->session()->forget('loginData');
        return redirect('/')->with('flash_message', '로그아웃 되었습니다.');
    }
}
