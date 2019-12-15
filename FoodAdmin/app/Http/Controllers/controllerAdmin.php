<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FOOD;
use App\FOODCATEGORY;
use App\BILL;
use App\BILLINFO;
use App\ACCOUNT;
use App\ACCOUNTTYPE;
use App\TABLE;
use App\IMAGE;
use Carbon;
use Hash;

class controllerAdmin extends Controller
{
    public function getDashboard(){
        //Sum of every month
        $arrPrice = array();
        for($i=1; $i<=12; $i++){
            $month = BILL::whereYear('DateCheckOut', '2019')
            ->whereMonth('DateCheckOut', $i)
            ->sum('TotalPrice');
            $arrPrice[] = $month;
        }
        //Sum of year
        $TotalPrice = BILL::whereYear('DateCheckOut', '2019')->sum('TotalPrice');
        //Most month
        $max = $arrPrice[0];
        $maxM = 1;
        for ($i = 0; $i < 12; $i++)
            if ($max < $arrPrice[$i]){
                $max = $arrPrice[$i];
                $maxM = $i+1;
            }
        //Least month
        $min = $arrPrice[0];
        $minM = 1;
        for ($i = 0; $i < 12; $i++)
            if ($min > $arrPrice[$i]){
                $min = $arrPrice[$i];
                $minM = $i+1;
            }
        return view('body_dashboard', compact('arrPrice', 'TotalPrice', 'max', 'maxM', 'min', 'minM'));
    }
    public function getDashboardYear(Request $request){
        //Sum of every month
        $arrPrice = array();
        for($i=1; $i<=12; $i++){
            $month = BILL::whereYear('DateCheckOut', $request->year)
            ->whereMonth('DateCheckOut', $i)
            ->sum('TotalPrice');
            $arrPrice[] = $month;
        }
        //Sum of year
        $TotalPrice = BILL::whereYear('DateCheckOut', $request->year)->sum('TotalPrice');
        //Most month
        $max = $arrPrice[0];
        $maxM = 1;
        for ($i = 0; $i < 12; $i++)
            if ($max < $arrPrice[$i]){
                $max = $arrPrice[$i];
                $maxM = $i+1;
            }
        //Least month
        $min = $arrPrice[0];
        $minM = 1;
        for ($i = 0; $i < 12; $i++)
            if ($min > $arrPrice[$i]){
                $min = $arrPrice[$i];
                $minM = $i+1;
            }
        return view('body_dashboard', compact('arrPrice', 'TotalPrice', 'max', 'maxM', 'min', 'minM'));
    }
    public function getLogin(){
        return view('login');
    }
    public function getLoginApp(Request $request){
        $username = $request->Username;
        $password = $request->Password;
        $account = ACCOUNT::where('Username', $username)->first();
        if($account != null){
            if(Hash::check($password,$account->Password)) {
                if($account->IDAccountType == 1){
                    //Sum of every month
                    $arrPrice = array();
                    for($i=1; $i<=12; $i++){
                        $month = BILL::whereYear('DateCheckOut', '2019')
                        ->whereMonth('DateCheckOut', $i)
                        ->sum('TotalPrice');
                        $arrPrice[] = $month;
                    }
                    //Sum of year
                    $TotalPrice = BILL::whereYear('DateCheckOut', '2019')->sum('TotalPrice');
                    //Most month
                    $max = $arrPrice[0];
                    $maxM = 1;
                    for ($i = 0; $i < 12; $i++)
                        if ($max < $arrPrice[$i]){
                            $max = $arrPrice[$i];
                            $maxM = $i+1;
                        }
                    //Least month
                    $min = $arrPrice[0];
                    $minM = 1;
                    for ($i = 0; $i < 12; $i++)
                        if ($min > $arrPrice[$i]){
                            $min = $arrPrice[$i];
                            $minM = $i+1;
                        }
                    return view('body_dashboard', compact('arrPrice', 'TotalPrice', 'max', 'maxM', 'min', 'minM'));
                }else{
                    $message = "Permission denied";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                    return view('login');
                }
            } else {
                $message = "Wrong password";
                echo "<script type='text/javascript'>alert('$message');</script>";
                return view('login');
            }
        }else{
            $message = "Wrong username";
            echo "<script type='text/javascript'>alert('$message');</script>";
            return view('login');
        }
        
    }


    




    public function getIndex(){
        return view('index');
    }
    public function getRegister(){
        return view('register');
    }
    public function getBasicTable(){
        return view('body_basic_table');
    }
    
    public function getDropzone(){
        return view('body_dropzone');
    }
    public function getChartjs(){
        return view('body_chartjs');
    }
    public function getFlotChart(){
        return view('body_flot_chart');
    }

    public function postTest(){
        return view('test');
    }

    

}
