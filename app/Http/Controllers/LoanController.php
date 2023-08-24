<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Loan;
use App\Models\Company;
use App\Models\LoanHistory;
use Illuminate\Http\Request;
use App\Models\PaymentReceive;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::orderBy('id','DESC')->get();
        return view('loan.index', compact('loans'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('loan.create',compact('companies'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->except("_token");
            if($data['check_or_cash'] == 'Cash'){
                $payment_receive = PaymentReceive::where('check_or_cash','Cash')->orderBy('id','DESC')->first();
                // dd($payment_receive);
                if($payment_receive){
                    $payment_receive->total_cash_amount = $data['amount'] + $payment_receive->total_cash_amount;
                }else{
                    $payment_receive->total_cash_amount = $data['amount']; 
                }
                $payment_receive->update();
            }else{
                $payment_receive = PaymentReceive::where('check_or_cash','Check')->orderBy('id','DESC')->first();
                if($payment_receive){
                    $payment_receive->total_check_amount = $data['amount'] + $payment_receive->total_check_amount;
                }else{
                    $payment_receive->total_check_amount   = $data['amount']; 
                }  
                $payment_receive->update();
            }
            
            Loan::create($data);
            return redirect()->route('loan.index')->withMessage('Successfully added !');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function edit($id)
    {
        $loan = Loan::where('id', $id)->first();
        return view('loan.edit', compact('loan'));
    }
    public function paid($id)
    {
        $loan = Loan::where('id', $id)->first();
        return view('loan.paid', compact('loan'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $data = $request->except('_token','paid');
            
            $old_loan = Loan::findOrFail($id);
            $old_loan_amount = $old_loan->amount;
            $old_amount_type = $old_loan->check_or_cash;
            if($old_amount_type == 'Cash'){
                $payment_receive = PaymentReceive::where('check_or_cash','Cash')->orderBy('id','DESC')->first();
                $payment_receive->total_cash_amount = $payment_receive->total_cash_amount - $old_loan_amount;
                $payment_receive->update();
            }else{
                $payment_receive = PaymentReceive::where('check_or_cash','Check')->orderBy('id','DESC')->first();
                $payment_receive->total_check_amount = $payment_receive->total_check_amount - $old_loan_amount;
                $payment_receive->update(); 
            }

            if($data['check_or_cash'] == 'Cash'){
                $payment_receive = PaymentReceive::where('check_or_cash','Cash')->orderBy('id','DESC')->first();
                $spend_money = json_decode($payment_receive->spend_money,true);
                $spend_money[date('d-m-Y-h-i-s')] = 'Cheque Loan Received';
                if($payment_receive){
                    $payment_receive->total_cash_amount = $data['amount'] + $payment_receive->total_cash_amount;
                }else{
                    $payment_receive->total_cash_amount = $data['amount']; 
                }
                $payment_receive->spend_money = json_encode($spend_money);
                $payment_receive->update();
            }else{
                $payment_receive = PaymentReceive::where('check_or_cash','Check')->orderBy('id','DESC')->first();
                $spend_money = json_decode($payment_receive->spend_money,true);
                $spend_money[date('d-m-Y-h-i-s')] = 'Cheque Loan Received';
                if($payment_receive){
                    $payment_receive->total_check_amount = $data['amount'] + $payment_receive->total_check_amount;
                }else{
                    $payment_receive->total_check_amount   = $data['amount']; 
                }
                $payment_receive->spend_money = json_encode($spend_money);  
                $payment_receive->update();
            }
            $loan = Loan::where('id', $id)->update($data);

            if($request->has('paid')){
                $loan_history = new LoanHistory();
                $loan_history->loan_id = $id;
                $loan_history->amount = $old_loan_amount - $request->amount ;
                $loan_history->name = auth()->user()->name;
                $loan_history->save();
            }
            DB::commit();
            return redirect()->route('loan.index')->withMessage('Successfully Updated !');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    public function paidUpdate(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $data = $request->except('_token','paid');
       

            if($data['check_or_cash'] == 'Cash'){
                $payment_receive = PaymentReceive::where('check_or_cash','Cash')->orderBy('id','DESC')->first();
                $spend_money = json_decode($payment_receive->spend_money,true);
                $spend_money[date('d-m-Y-h-i-s')] = 'Cheque Loan Received';
                if($payment_receive){
                    $payment_receive->total_cash_amount =  $payment_receive->total_cash_amount - $data['amount'];
                }else{
                    $payment_receive->total_cash_amount = $data['amount']; 
                }
                $payment_receive->spend_money = json_encode($spend_money);
                $payment_receive->update();
            }else{
                $payment_receive = PaymentReceive::where('check_or_cash','Check')->orderBy('id','DESC')->first();
                $spend_money = json_decode($payment_receive->spend_money,true);
                $spend_money[date('d-m-Y-h-i-s')] = 'Cheque Loan Received';
                if($payment_receive){
                    $payment_receive->total_check_amount =  $payment_receive->total_check_amount - $data['amount'];
                }else{
                    $payment_receive->total_check_amount   = $data['amount']; 
                }
                $payment_receive->spend_money = json_encode($spend_money);  
                $payment_receive->update();
            }
            $old_loan = Loan::findOrFail($id);
            $old_loan_amount = $old_loan->amount;
            $amount = $old_loan_amount - $request->amount;
            $data['amount'] = $amount;
            
            $loan = Loan::where('id', $id)->update($data);

            if($request->has('paid')){
                $loan_history = new LoanHistory();
                $loan_history->loan_id = $id;
                $loan_history->amount = $request->amount ;
                $loan_history->name = auth()->user()->name;
                $loan_history->check_or_cash = $data['check_or_cash'];
                $loan_history->save();
            }
            DB::commit();
            return redirect()->route('loan.index')->withMessage('Successfully Updated !');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            Loan::where('id', $id)->delete();
            return redirect()->route('loan.index')->withMessage('Successfully Deleted !');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }


    public function history($id)
    {
        $histories = LoanHistory::where('loan_id',$id)->get();
        return view('loan.history', compact('histories'));
    }



}
