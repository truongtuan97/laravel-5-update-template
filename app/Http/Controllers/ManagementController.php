<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\AccountInfo;
use App\PromotionConfiguration;
use App\CardChargeInfoLog;
use App\AccountInfoLog;
use App\ChargeValue;
use App\ConfigKhuyenMaiValue;
use App\AccountMoneyTracking;

class ManagementController extends Controller
{
    const MOMO = "momo";
    const ZING = "zing";
    const BANK = "bank";
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function __construct() {
        $this->middleware('auth');
    }

    public function listUser() {
        $accountName = request('accountName');
        if (request('accountName')) {            
            $users = AccountInfo::whereRaw("cAccName like ?", ["%".request('accountName')."%"])->get();            
        } else {
            $users = [];
        }
        return view('admin.list_user', compact(['users', 'accountName']));
    }

    public function userDetail($cAccName) {
        $user = AccountInfo::where('cAccName', $cAccName)->firstOrFail();
        return view('admin.user.show', compact('user'));
    }

    public function userEdit($cAccName) {
        $user = AccountInfo::where('cAccName', $cAccName)->firstOrFail();
        return view('admin.user.edit', compact('user'));
    }

    public function userUpdate(AccountInfo $user) {
        $this->validate(request(), [
            // 'email' => 'nullable|max:255|email|unique:account_info,email,'.$user->id,
            'email' => 'nullable|max:255|email',
            'phone' => ['nullable', 'numeric', 'min:11'],
            'password1' => ['nullable', 'string', 'min:8', 'confirmed'],
            'password2' => ['nullable', 'string', 'min:8', 'confirmed']
        ]);

        $admin = auth()->user();
        
        if (request('email')) {
            $user->email = request('email');
        }

        if (request('phone')) {
            $user->phone = request('phone');
        }

        if (request('password1')) {
            $user->plainpassword = request('password1');            
            $user->cPassWord = strtoupper(md5(request('password1')));
        }
        if (request('password2')) {
            $user->plainpassword2 = request('password2');
            $user->cSecPassWord = strtoupper(md5(request('password2')));
        }        
        try {
            $user->save();

            $accInfoLog = new AccountInfoLog();
            $accInfoLog->adminAccount = $admin->cAccName;
            $accInfoLog->userAccount = $user->cAccName;
            $accInfoLog->dateUpdate = Carbon::Now();
            $accInfoLog->save();

            return redirect()->back()->with('alert', 'success');
        } catch (Exception $e) {
            return redirect()->back()->with('alert', 'failed');
        }        
    }

    public function chkmList() {
        $chkms = PromotionConfiguration::all();
        return view('admin.chkm.list', compact('chkms'));
    }

    public function chkmEdit($id) {
        $chkm = PromotionConfiguration::where('id', $id)->first();
        $configKhuyenMaiValues = ConfigKhuyenMaiValue::all();

        return view('admin.chkm.edit', compact(['chkm', 'configKhuyenMaiValues']));
    }

    public function chkmUpdate(PromotionConfiguration $chkm) {
        $this->validate(request(), [
            'ngay_bat_dau' => ['required', 'date'],
            'ngay_ket_thuc' => ['required', 'date'],
            'khuyenmai' => ['required']
        ]);
        try {
            $chkm->ngay_bat_dau = request('ngay_bat_dau');
            $chkm->ngay_ket_thuc = request('ngay_ket_thuc');
            $chkm->khuyenmai = request('khuyenmai');
            $chkm->save();

            return redirect()->back()->with('alert', 'success');
        } catch (Exception $e) {
            return redirect()->back()->with('alert', 'failed');
        }

    }

    public function userNapcardEdit($cAccName) {
        $user = AccountInfo::where('cAccName', $cAccName)->firstOrFail();
        $chargeValues = ChargeValue::get();
        return view('admin.user.napcard', compact(['user', 'chargeValues']));
    }

    public function userNapcardUpdate(AccountInfo $user) {
        $this->validate(request(), [
            'cardType' => ['required', 'string'],
            'soTien' => ['required', 'numeric']
        ]);

        try {
            $admin = auth()->user();

            $chkm = PromotionConfiguration::all()->first();

            $cardType = request('cardType');
            $value = request('soTien');
            $realValue = 0;

            if ($cardType == 'zing') {
                $realValue = ( $value + ($value*0.0) + ($value* $chkm->khuyenmai) );
            } else if ($cardType == 'momo' || $cardType == 'bank') {
                $realValue = ( $value+($value*0.1) + ($value* $chkm->khuyenmai) );
            } else {
                $realValue = $value + ($value * $chkm->khuyenmai);
            }
            $user->nExtPoint1 += $realValue;
            $user->save();
           
            $khuyenmai =  ((($realValue - $value) / $value) * 100)."%";

            $cardChargeLog = new CardChargeInfoLog;
            $cardChargeLog->adminAccount = $admin->cAccName;
            $cardChargeLog->userAccount = $user->cAccName;
            $cardChargeLog->cardType = $cardType;
            $cardChargeLog->value = $value;
            $cardChargeLog->realValue = $realValue;
            $cardChargeLog->khuyenmai = $khuyenmai;
            $cardChargeLog->dateUpdate = Carbon::Now();
            $cardChargeLog->save();

            return redirect()->back()->with('alert', 'success');
        } catch (Exception $e) {
            return redirect()->back()->with('alert', 'failed');
        }
    }

    public function thongKeNap() {
        
        $fromDate = request('fromDate');
        $toDate = request('toDate');

        $cardChargeLogs = CardChargeInfoLog::whereRaw(
            "(dateUpdate >= ? AND dateUpdate <= ?)",
            [request('fromDate')." 00:00:00", request('toDate')." 23:59:59"]
          )->orderBy('cardType')->get();
        $momo = $bank = $zing = 0;

        foreach ($cardChargeLogs as $cLog) {
            switch ($cLog->cardType) {
                case self::MOMO:
                    $momo += $cLog->value;
                break;
                case self::ZING:
                    $zing += $cLog->value;
                break;
                case self::BANK:
                    $bank += $cLog->value;
                break;
            }
        }
        return view('admin.thongkenap', compact(['cardChargeLogs', 'momo', 'zing', 'bank', 'fromDate', 'toDate']));        
    }

    public function logNapTien() {
        $cardChargeLogs = [];
        $fromDate = request('fromDate');
        $toDate = request('toDate');

        if (request('fromDate') && request('toDate')) {
            $cardChargeLogs = CardChargeInfoLog::whereRaw(
                "(dateUpdate >= ? AND dateUpdate <= ?)",
                [request('fromDate')." 00:00:00", request('toDate')." 23:59:59"]
              )->orderBy('cardType')->get();
        }         
        return view('admin.lognaptien', compact(['cardChargeLogs', 'fromDate', 'toDate']));
    }

    public function logQuanLyTaiKhoan() {
        $accountInfoLogs = [];
        $fromDate = request('fromDate');
        $toDate = request('toDate');

        if (request('fromDate') && request('toDate')) {
            $accountInfoLogs = AccountInfoLog::whereRaw(
                "(dateUpdate >= ? AND dateUpdate <= ?)",
                [request('fromDate')." 00:00:00", request('toDate')." 23:59:59"]
              )->get();
        }        
        return view('admin.logquanlytaikhoan', compact(['accountInfoLogs', 'fromDate', 'toDate']));
    }

    public function lichsuruttien() {        
        $accMoneyTracking = new AccountMoneyTracking;
        $accMoneyTracking->setConnection('sqlsrv2');

        $fromDate = request('fromDate');
        $toDate = request('toDate');
        $accountName = request('accountName');
                
        $userMoneyTakenLogs = $accMoneyTracking->whereRaw(
            "((dateUpdate >= ? AND dateUpdate <= ?) AND (AccountName like ? ))",
            [request('fromDate')." 00:00:00", request('toDate')." 23:59:59", "%".request('accountName')."%"]
          )->get();

        return view('admin.lichsuruttien', compact([ 'userMoneyTakenLogs', 'fromDate', 'toDate', 'accountName' ]));
    }
}