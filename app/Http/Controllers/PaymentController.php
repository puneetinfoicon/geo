<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function payment_status(Request $request)
    {
        $userDetails = getProductPrice();
        $sessionVal = Session()->get('sessionData');

        $payment = new Payment;
        $payment->customerNo = $userDetails[1]->CustomerNo;
        $payment->orderid = $request->orderid;
        $payment->txnid = $request->txnid;
        $payment->reference = $request->reference;
        $payment->amount = $request->amount;
        $payment->currency = $request->currency;
        $payment->feeid = $request->feeid;
        $payment->txnfee = $request->txnfee;
        $payment->paymenttype = $request->paymenttype;
        $payment->hash = $request->hash;
        $payment->orderReference = $sessionVal['Ordrereference'];
        $payment->details = $sessionVal['details'];
        if ($payment->save()) {
            deleteCookie('cart');
            Session::forget('sessionData');
            return redirect('/home');
        }
    }
}
