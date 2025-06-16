<?php
namespace App\repository\Finance;

use App\interfaces\Finance\ReceiptRepositoryInterface;
use App\Models\FundAccount;
use App\Models\Patient;
use App\Models\PatientAccounnt;
use App\Models\ReceiptAccount;
use Exception;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

Class ReceiptRepository implements ReceiptRepositoryInterface
{

    public function index()
    {
        $receipts=ReceiptAccount::all();
 return view('Dashboard.Receipt.index',compact('receipts'));
    }

//add
public function store($request)
{
    Db::beginTransaction();
 try {
    ## first off all we store receipt_accounts
    $receipt_accouts = new ReceiptAccount();
    $receipt_accouts->date =date('y-m-d');
    $receipt_accouts->patient_id =$request->patient_id;
    $receipt_accouts->amount =$request->Debit;
    $receipt_accouts->description =$request->description;
    $receipt_accouts->save();
    ## secound store in fundaccounts
    $fund_accounts =new FundAccount();
    $fund_accounts->date =date('y-m-d');
    $fund_accounts->receipt_id = $receipt_accouts->id;
    $fund_accounts->Debit = $request->Debit;
    $fund_accounts->credit =0.00;
    $fund_accounts->save();

    #third store in patient account
    $patient_accounts= new PatientAccounnt();
    $patient_accounts->date=date('y-m-d');
    $patient_accounts->patient_id=$request->patient_id;
    $patient_accounts->receipt_id=$receipt_accouts->id;
    $patient_accounts->Debit=0.00;
    $patient_accounts->credit=$request->Debit;
    // we stored the many that the patient pay it for now and sotre it to compare in any time how much the patient have payd
    $patient_accounts->save();

    Db::commit();
    session()->flash('add');
    return redirect()->route('Receipt.create');

    } 
   catch (Exception $e) 
   {
    DB::rollBack();
    return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
   }


  }

//edit
public function update($request)
{
    
    DB::beginTransaction();

    try{
        // store receipt_accounts
        $receipt_accounts = ReceiptAccount::findorfail($request->id);
        $receipt_accounts->date =date('y-m-d');
        $receipt_accounts->patient_id = $request->patient_id;
        $receipt_accounts->amount = $request->Debit;
        $receipt_accounts->description = $request->description;
        $receipt_accounts->save();
        // store fund_accounts
        $fund_accounts = FundAccount::where('receipt_id',$request->id)->first();
        $fund_accounts->date =date('y-m-d');
        $fund_accounts->receipt_id = $receipt_accounts->id;
        $fund_accounts->Debit = $request->Debit;
        $fund_accounts->credit = 0.00;
        $fund_accounts->save();
        // store patient_accounts
        $patient_accounts = PatientAccounnt::where('receipt_id',$request->id)->first();
        $patient_accounts->date =date('y-m-d');
        $patient_accounts->patient_id = $request->patient_id;
        $patient_accounts->receipt_id = $receipt_accounts->id;
        $patient_accounts->Debit = 0.00;
        $patient_accounts->credit =$request->Debit;
        $patient_accounts->save();


        DB::commit();
        session()->flash('edit');
        return redirect()->route('Receipt.index');
    }

    catch (\Exception $e) {
        DB::rollback();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }

}


//delete
public function destroy($request)
{
try {
    ReceiptAccount::destroy($request->id);
    session()->flash('delete');
    return redirect()->back();
} catch (\Exception $e) {
  return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
}
}
// create
public function create()
{
 $Patients=Patient::all();
 return view('Dashboard.Receipt.add',compact('Patients'));
}

// 
public function edit($id)
{
    $receipt_accounts = ReceiptAccount::findorfail($id);
    $Patients = Patient::all();
    return view('Dashboard.Receipt.edit',compact('receipt_accounts','Patients'));
}
public function show($id)
{
    $receipt = ReceiptAccount::findorfail($id);
    return view('Dashboard.Receipt.print',compact('receipt'));
}

}
