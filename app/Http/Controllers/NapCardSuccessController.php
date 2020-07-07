<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use BaoKimSDK\BaoKim;

use App\Customer;
use App\AccountInfo;
use App\CardChargeInfoLog;
use App\AccountMoneyTracking;
use App\CardInfo;
use App\CardType;
use App\CardHistory;
use App\PromotionConfiguration;

use Carbon\Carbon;

class NapCardSuccessController extends Controller
{    
    public function __construct() {
        //$this->middleware('auth');
    }

    public function napcard_success(Request $request) {        
        
        $data = json_decode($request->getContent());
        
        try {
            if (empty($data)){
                return;
            }  
            $transaction = $data->txn;
            
            if ($transaction->stat == 2) {
                if (!is_null($data->order->mrc_order_id && !is_null($data->txn->id))) {                    
                    $cardHistory = CardHistory::where('orderID', $data->order->mrc_order_id)->first();
                                        
                    if (!empty($cardHistory->username)) {
                        $accountInfo = AccountInfo::where('cAccName', $cardHistory->username)->first();                        
                        $accountInfo->nExtPoint1 += $cardHistory->ingame_amount;
                        $accountInfo->save();
                        
                        $cardHistory->baokim_txn_id = $data->txn->id;
                        $cardHistory->card_fee_amount = $transaction->fee_amount;
                        $cardHistory->status = $transaction->stat;
                        $cardHistory->success = 1;                        
                        $cardHistory->updated_at = Carbon::Now();
                        $cardHistory->save();
                        
                    }
                    
                    $responseValue = new \stdClass();
                    $responseValue->err_code = 0;
                    $responseValue->message = "Nap card thanh cong";
                    return response()->json($responseValue);
                }
            }            
        }
        catch (Exception $ex) {
            Log::info($ex->getMessage());
        }
    }
}