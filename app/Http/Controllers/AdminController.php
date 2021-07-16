<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Reservation;
use App\Models\User as UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function eventList()
    {
        if (!session()->has('loginData') || session('loginData')->userId != "admin") return back()->with('flash_message', '관리자만 사용가능합니다.');

        $meeting = Meeting::get();

        return view('eventList')->with(['meeting' => $meeting]);
    }

    public function eventReg()
    {
        if (!session()->has('loginData') || session('loginData')->userId != "admin") return back()->with('flash_message', '관리자만 사용가능합니다.');

        return view('eventReg');
    }

    public function eventRegProcess(Request $request)
    {
        if (!session()->has('loginData') || session('loginData')->userId != "admin") return back()->with('flash_message', '관리자만 사용가능합니다.');

        $book_name = $request->input('book_name');
        $book_image = $request->input('book_image');
        $writer_name = $request->input('writer_name');
        $target = $request->input('target');
        $create_date = $request->input('create_date');
        $week = $request->input('week');
        $start_time = $request->input('start_time');
        $end_time = $request->input('end_time');

        $rules = [
            'book_name' => ['required'],
            'book_image' => ['required'],
            'writer_name' => ['required'],
            'target' => ['required'],
            'create_date' => ['required'],
            'week' => ['required'],
            'start_time' => ['required'],
            'end_time' => ['required']
        ];

        $messages = [
            'book_name.required' => '.',
            'book_image.required' => '.',
            'writer_name.required' => '.',
            'target.required' => '.',
            'create_date.required' => '.',
            'week.required' => '.',
            'start_time.required' => '.',
            'end_time.required' => '.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) return back()->with('flash_message', '누락 항목이 있습니다.');

        $meeting = null;
        $upimg = $request->file('book_image');
        if ($upimg) $book_image = $upimg->getClientOriginalName();

        try {
            if ($upimg) $upimg->storeAs('imgs', $upimg->getClientOriginalName());
        } catch (\Exception $e) {
            return back()->with('flash_message', '첨부파일 저장 에러 발생');
        }

        if ($target == "es") $target = "초등학생";
        if ($target == "ms") $target = "중학생";
        if ($target == "hs") $target = "고등학생";

        $time = $start_time . "~" . $end_time;

        $meeting = Meeting::create([
            'book_name' => $book_name,
            'book_image' => $book_image,
            'writer_name' => $writer_name,
            'target' => $target,
            'create_date' => $create_date,
            'meeting_week' => $week,
            'meeting_time' => $time
        ]);

        if (!$meeting) return back()->with('flash_message', '오류로 인하여 행사 추가에 실패하였습니다.');

        return redirect('/event/list')->with('flash_message', '행사가 추가 되었습니다.');
    }

    public function eventUpdate(Request $request)
    {
        if (!session()->has('loginData') || session('loginData')->userId != "admin") return back()->with('flash_message', '관리자만 사용가능합니다.');

        $id = $request->get('id');

        $meeting = Meeting::find($id);
        if (!$meeting) return back()->with('flash_message', '해당 행사는 존재하지 않습니다.');

        return view('eventUpdate')->with(['meeting' => $meeting]);
    }

    public function eventUpdateProcess(Request $request)
    {
        if (!session()->has('loginData') || session('loginData')->userId != "admin") return back()->with('flash_message', '관리자만 사용가능합니다.');

        $book_name = $request->input('book_name');
        $book_image = $request->input('book_image');
        $writer_name = $request->input('writer_name');
        $target = $request->input('target');
        $create_date = $request->input('create_date');
        $week = $request->input('week');
        $start_time = $request->input('start_time');
        $end_time = $request->input('end_time');

        $rules = [
            'book_name' => ['required'],
            'writer_name' => ['required'],
            'target' => ['required'],
            'create_date' => ['required'],
            'week' => ['required'],
            'start_time' => ['required'],
            'end_time' => ['required']
        ];

        $messages = [
            'book_name.required' => '.',
            'writer_name.required' => '.',
            'target.required' => '.',
            'create_date.required' => '.',
            'week.required' => '.',
            'start_time.required' => '.',
            'end_time.required' => '.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) return back()->with('flash_message', '누락 항목이 있습니다.');

        $meeting = Meeting::find($request->input('id'));
        if (!$meeting) return back()->with('flash_message', '해당 행사는 존재하지 않습니다.');

        $upimg = $request->file('book_image');
        if ($upimg) $book_image = $upimg->getClientOriginalName();

        try {
            if ($upimg) $upimg->storeAs('imgs', $upimg->getClientOriginalName());
        } catch (\Exception $e) {
            return back()->with('flash_message', '첨부파일 저장 에러 발생');
        }

        if ($target == "es") $target = "초등학생";
        if ($target == "ms") $target = "중학생";
        if ($target == "hs") $target = "고등학생";

        $time = $start_time . "~" . $end_time;

        $book_image = $book_image == null ? $meeting->book_image : $book_image;

        $meeting->update([
            'book_name' => $book_name,
            'book_image' => $book_image,
            'writer_name' => $writer_name,
            'target' => $target,
            'create_date' => $create_date,
            'meeting_week' => $week,
            'meeting_time' => $time
        ]);

        if (!$meeting) return back()->with('flash_message', '오류로 인하여 행사 추가에 실패하였습니다.');

        return redirect('/event/list')->with('flash_message', '행사가 수정 되었습니다.');
    }

    public function eventDelete(Request $request, $bid)
    {
        if (!session()->has('loginData') || session('loginData')->userId != "admin") response()->json(array('success' => false, 'msg' => '관리자만 사용가능합니다.'));

        $meeting = Meeting::find($bid);
        if (!$meeting) response()->json(array('success' => false, 'msg' => '해당 행사는 없습니다.'));

        $meeting->delete();

        return response()->json(array('success' => true, 'msg' => '행사가 정상적으로 삭제 되었습니다.'));
    }

    public function meetingCheckAdmin(Request $request)
    {
        if (!session()->has('loginData') || session('loginData')->userId != "admin") return back()->with('flash_message', '관리자만 사용가능합니다.');

        $meeting = null;
        $searchData = $request->input('data');

        if ($request->get('category') == "user_name") $meeting = Reservation::select()->where('user_name', '=', $searchData)->get();
        else if ($request->get('category') == "writer_name") $meeting = Reservation::select()->where('writer', '=', $searchData)->get();
        else $meeting = Reservation::get();

        $arr = array();
        foreach ($meeting as $mt) {
            if ($mt->state == 0) continue;
            array_push($arr, ['writer' => $mt->writer, 'cnt' => Reservation::select('writer')->where('writer', '=', $mt->writer)->where('state', '>', '0')->count()]);
        }
        $arr = array_map("unserialize", array_unique(array_map("serialize", $arr)));

        $sarr = [['st' => '고등학생', 'cnt' => 0], ['st' => '중학생', 'cnt' => 0], ['st' => '초등학생', 'cnt' => 0]];
        foreach ($meeting as $mt) {
            if ($mt->state == 0) continue;
            $st = UserModel::select('student')->where('id', '=', $mt->user_id)->first();
            if ($st->student == '고등학생') $sarr[0]['cnt']++;
            if ($st->student == '중학생') $sarr[1]['cnt']++;
            if ($st->student == '초등학생') $sarr[2]['cnt']++;
        }

        $users = UserModel::get();

        return view('eventAdmin')->with(['meeting' => $meeting, 'users' => $users, 'graphArr' => $arr, 'sArr' => $sarr]);
    }

    public function stateUpdate(Request $request, $id)
    {
        if (!session()->has('loginData') || session('loginData')->userId != "admin") return back()->with('flash_message', '관리자만 사용가능합니다.');

        $reservation = Reservation::select('id')->where('id', '=', $id)->first();

        if ($reservation) $reservation->update(['state' => '1']);

        if (!$reservation) return back()->with('flash_message', '오류로 인하여 예약 승인에 실패하였습니다.');

        return redirect('/meeting/check/admin')->with('flash_message', '예약이 승인 되었습니다.');
    }
}
