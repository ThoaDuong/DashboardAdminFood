<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BILL;
use App\BILLINFO;
use App\TABLE;
use App\FOOD;

class controllerBill extends Controller
{
    public function getBillList(){
        $arrBill = BILL::join('TABLE', 'TABLE.ID', '=', 'BILL.IDTable')
        ->select('BILL.ID AS IDofBill', 'TABLE.Name AS NameTable', 'DateCheckIn', 'DateCheckOut', 'Discount', 'TotalPrice', 'BILL.Status AS StatusBill')
        ->get();
        $arrBillInfo = BILLINFO::join('FOOD', 'FOOD.ID', '=', 'BILLINFO.IDFood')->get();                    

        return view('body_bill_list', compact('arrBill', 'arrBillInfo'));
    }
    public function getBillDelete($ID){
        
        BILLINFO::where('IDBill', $ID)->delete();
        BILL::where('ID', $ID)->delete();

        $arrBill = BILL::join('TABLE', 'TABLE.ID', '=', 'BILL.IDTable')
        ->select('BILL.ID AS IDofBill', 'TABLE.Name AS NameTable', 'DateCheckIn', 'DateCheckOut', 'Discount', 'TotalPrice', 'BILL.Status AS StatusBill')
        ->get();
        $arrBillInfo = BILLINFO::join('FOOD', 'FOOD.ID', '=', 'BILLINFO.IDFood')->get(); 
        return view('body_bill_list', compact('arrBill', 'arrBillInfo'));
    }
    public function getBillSearch(Request $request){
        $arrBill = BILL::join('TABLE', 'TABLE.ID', '=', 'BILL.IDTable')
        ->select('BILL.ID AS IDofBill', 'TABLE.Name AS NameTable', 'DateCheckIn', 'DateCheckOut', 'Discount', 'TotalPrice', 'BILL.Status AS StatusBill')
        ->orWhere('TABLE.Name', 'like', '%'.$request->Search.'%')
        ->orWhere('DateCheckIn', 'like', '%'.$request->Search.'%')
        ->orWhere('DateCheckOut', 'like', '%'.$request->Search.'%')
        ->orWhere('TotalPrice', 'like', '%'.$request->Search.'%')
        ->orWhere('Discount', 'like', '%'.$request->Search.'%')
        ->orWhere('BILL.Status', 'like', '%'.$request->Search.'%')
        ->get();
        $arrBillInfo = BILLINFO::join('FOOD', 'FOOD.ID', '=', 'BILLINFO.IDFood')->get();                    
        return view('body_bill_list', compact('arrBill', 'arrBillInfo'));
    }
}
