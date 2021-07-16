<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\User as UserModel;
use App\Models\Meeting as MeetingModel;
use Illuminate\Support\Facades\Validator;

class MeetingController extends Controller
{
    public function init()
    {
        // User::truncate();
        UserModel::where('userId', '=', 'admin')->delete();
        MeetingModel::truncate();
        UserModel::create(['userId' => 'admin', 'userName' => '관리자', 'userPwd' => bcrypt('1234'), 'gender' => '', 'age' => '0', 'student' => '']);

        $data = [
            ["페인트", "페인트.jpg", "이희영", "초등학생", "20190419", "월요일", "11:00~13:00"],
            ["체리새우", "체리새우.jpg", "황영미", "초등학생", "20190128", "화요일", "13:00~15:00"],
            ["시간을 파는 상점", "시간을 파는 상점.jpg", "김선영", "초등학생", "20120410", "수요일", "15:00~17:00"],
            ["아몬드", "아몬드.jpg", "손원평", "초등학생", "20170331", "목요일", "10:00~12:00"],
            ["완득이", "완득이.jpg", "김려령", "초등학생", "20080317", "금요일", "14:00~16:00"],
            ["단편소설 베스트35", "단편소설 베스트35.jpg", "김형주", "중학생", "20150713", "월요일", "11:00~13:00"],
            ["그들도 아이였다", "그들도 아이였다.jpg", "김은우", "중학생", "20180325", "화요일", "13:00~15:00"],
            ["십대를 위한 실패수업", "십대를 위한 실패수업.jpg", "정화진", "중학생", "20190612", "수요일", "15:00~17:00"],
            ["중학국어 비문학 독해 한권으로 끝내기", "중학국어 비문학 독해 한권으로 끝내기.jpg", "정문경", "중학생", "20190605", "목요일", "10:00~12:00"],
            ["바다소", "바다소.jpg", "양태은", "중학생", "20180610", "금요일", "14:00~16:00"],
            ["선생님과 함께 읽는 우리 소설", "선생님과 함께 읽는 우리 소설.jpg", "권순긍", "고등학생", "20110503", "월요일", "11:00~13:00"],
            ["스프링벅", "스프링벅.jpg", "배유안", "고등학생", "20081013", "화요일", "13:00~15:00"],
            ["생각한다는것", "생각한다는것.jpg", "고병권", "고등학생", "20100331", "수요일", "15:00~17:00"],
            ["개똥 세개", "개똥 세개.jpg", "강수돌", "고등학생", "20130730", "목요일", "10:00~12:00"],
            ["아이는 사춘기 엄마는 성장기", "아이는 사춘기 엄마는 성장기.jpg", "이윤정", "고등학생", "20100326", "금요일", "14:00~16:00"],
        ];

        foreach ($data as $item) {
            MeetingModel::create(['book_name' => $item[0], 'book_image' => $item[1], 'writer_name' => $item[2], 'target' => $item[3], 'create_date' => $item[4], 'meeting_week' => $item[5], 'meeting_time' => $item[6]]);
        }
    }

    public function meetingPage()
    {
        if (!session()->has('loginData')) return back()->with('flash_message', '로그인 후 사용가능합니다.');

        $year = isset($_GET['year']) ? $_GET['year'] : date("Y");
        $month = isset($_GET['month']) ? $_GET['month'] : date("m");
        $day = isset($_GET['day']) ? $_GET['day'] : 1;

        $firstDay = strtotime("$year-$month-1");
        $lastDay = strtotime("-1 Day", strtotime("+1 Month", $firstDay));

        $prev = strtotime("-1 Month", $firstDay);
        $next = strtotime("+1 Month", $firstDay);

        $meeting = MeetingModel::get();

        return view('meeting')->with(['meeting' => $meeting, 'year' => $year, 'month' => $month, 'day' => $day, 'firstDay' => $firstDay, 'lastDay' => $lastDay, 'prev' => $prev, 'next' => $next]);
    }

    public function meetingCon(Request $request)
    {
        if (!session()->has('loginData')) return back()->with('flash_message', '로그인 후 사용가능합니다.');

        $writer = $request->input('writer');
        $time = $request->input('time');
        $userId = $request->input('userId');
        $name = $request->input('name');
        $student = $request->input('student');
        $age = $request->input('age');
        $gender = $request->input('gender');
        $want = $request->input('want');
        $date = $request->input('date');

        $rules = [
            'writer' => ['required'],
            'time' => ['required'],
            'userId' => ['required'],
            'name' => ['required'],
            'student' => ['required'],
            'age' => ['required'],
            'gender' => ['required'],
            'want' => ['required'],
            'date' => ['required']
        ];

        $messages = [
            'writer.required' => '.',
            'time.required' => '.',
            'userId.required' => '.',
            'name.required' => '.',
            'student.required' => '.',
            'age.required' => '.',
            'gender.required' => '.',
            'want.required' => '.',
            'date.required' => '.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) return back()->with('flash_message', '누락 항목이 있습니다.');

        $id = UserModel::select('id')->where('userId', '=', $userId)->first();
        if ($id) {
            $meeting = Reservation::create(['user_id' => $id->id, 'user_name' => $name, 'writer' => $writer, 'mdate' => $date, 'mtime' => $time, 'content' => $want, 'state' => "0"]);
            if (!$meeting) return back()->with('flash_message', '오류로 인하여 예약에 실패하였습니다.');
        } else return back()->with('flash_message', '존재하지 않는 유저 입니다.');

        return redirect('/meeting/check')->with('flash_message', '예약신청이 완료되었습니다.');
    }

    public function meetingCheckPage()
    {
        if (!session()->has('loginData')) return back()->with('flash_message', '로그인 후 사용가능합니다.');

        $id = session('loginData')->id;
        $meeting = [];
        $meeting = Reservation::select('*')->where('user_id', '=', $id)->get();

        return view('meetingCheck')->with(['meeting' => $meeting]);
    }

    public function meetingDelete(Request $request, $bid)
    {
        $loginUser = session('loginData');
        if (!$loginUser) response()->json(array('success' => false, 'msg' => '로그인 후 사용가능합니다.'));

        $reservation = Reservation::find($bid);
        if (!$reservation) response()->json(array('success' => false, 'msg' => '해당 예약은 없습니다.'));

        if ($reservation->user_id != $loginUser->id) response()->json(array('success' => false, 'msg' => '해당 예약을 취소할 권한이 없습니다.'));

        $reservation->delete();

        return response()->json(array('success' => true, 'msg' => '예약이 정상적으로 취소 되었습니다.'));
    }
}
