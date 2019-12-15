<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ACCOUNT;
use App\ACCOUNTTYPE ;
use App\IMAGE;
use File;

class controllerAccount extends Controller
{
    public function getAccountList(){
        $arrAccount = ACCOUNT::join('ACCOUNTTYPE', 'ACCOUNTTYPE.ID', '=', 'ACCOUNT.IDAccountType')
        ->join('IMAGE', 'IMAGE.ID', '=', 'ACCOUNT.IDImage')
        ->get();
        return view('body_account_list', compact('arrAccount'));
    }
    public function getAccountAdd(){
        $arrAccountType = ACCOUNTTYPE::all();
        return view('body_account_add', compact('arrAccountType'));
    }
    public function getAccountAddControl(Request $request){
        if(isset($_POST['submit-cancel'])){
            $arrAccountType = ACCOUNTTYPE::all();
            return view('body_account_add', compact('arrAccountType'));
		}
		if(isset($_POST['submit-add'])){
            $image = $request->file('Image');
            $imageEncode = base64_encode(file_get_contents($image));
            IMAGE::insert(
            [
                'Data' => $imageEncode,
            ]);
            $imgFood = IMAGE::all()->last();
            ACCOUNT::insert(
            [
                'Username' => $request->Username,
                'Password' => bcrypt($request->Password),
                'DisplayName' => $request->DisplayName,
                'Sex' => $request->Sex,
                'Address' => $request->Address,
                'PhoneNumber' => $request->PhoneNumber,
                'BirthDay' => $request->BirthDay,
                'IDAccountType' => $request->IDAccountType,
                'IDImage' => $imgFood->ID
            ]);
            $arrAccount = ACCOUNT::join('ACCOUNTTYPE', 'ACCOUNTTYPE.ID', '=', 'ACCOUNT.IDAccountType')
            ->join('IMAGE', 'IMAGE.ID', '=', 'ACCOUNT.IDImage')
            ->get();
            return view('body_account_list', compact('arrAccount'));
        }
    }
    public function getAccountEdit($Username){
        $account = ACCOUNT::join('IMAGE', 'IMAGE.ID', '=', 'ACCOUNT.IDImage')
        ->where('Username', '=', $Username)
        ->first();
        $accountType = ACCOUNTTYPE::find($account->IDAccountType);
        if($account->Sex == 1){
            $sex = 0;
        }else{
            $sex = 1;
        }
        if($accountType->ID == 1){
            $type = 10;
        }
        else{
            $type = 1;
        }
        return view('body_account_edit', compact('account', 'sex', 'accountType', 'type'));
    }
    public function postAccountControlEdit(Request $request, $Username){
        if(isset($_POST['submit-cancel'])){
			$arrAccount = ACCOUNT::join('ACCOUNTTYPE', 'ACCOUNTTYPE.ID', '=', 'ACCOUNT.IDAccountType')->get();
            return view('body_account_list', compact('arrAccount'));
		}
		if(isset($_POST['submit-edit'])){
            if($request->Image != null){   
                $image = $request->file('Image');
                $imageEncode = base64_encode(file_get_contents($image));
                $imageAccount = ACCOUNT::where('Username', $Username)->first();
                IMAGE::where('ID', $imageAccount->IDImage)->update(
                    [
                    'Data' => $imageEncode,
                ]);  
            }
            $account = ACCOUNT::where('Username', '=', $Username)->first();
            if($request->BirthDay != null){
                ACCOUNT::where('Username', $Username)->update(
                    [
                        'BirthDay' => $request->BirthDay,
                    ]);
            }
            ACCOUNT::where('Username', $Username)->update(
                [
                    'Username' => $request->Username,
                    'Password' => bcrypt($request->Password),
                    'DisplayName' => $request->DisplayName,
                    'Sex' => $request->Sex,
                    'Address' => $request->Address,
                    'PhoneNumber' => $request->PhoneNumber,
                    'IDAccountType' => $request->IDAccountType
                ]);
            $arrAccount = ACCOUNT::join('ACCOUNTTYPE', 'ACCOUNTTYPE.ID', '=', 'ACCOUNT.IDAccountType')
            ->join('IMAGE', 'IMAGE.ID', '=', 'ACCOUNT.IDImage')
            ->get();
            return view('body_account_list', compact('arrAccount'));
        }
    }
    public function getAccountDelete(Request $request, $Username){
        ACCOUNT::where('Username', $Username)->delete();
		$message = "Success deleted";
		echo "<script type='text/javascript'>alert('$message');</script>";
		$arrAccount = ACCOUNT::join('ACCOUNTTYPE', 'ACCOUNTTYPE.ID', '=', 'ACCOUNT.IDAccountType')->get();
        return view('body_account_list', compact('arrAccount'));
    }
    public function getAccountSearchAjax(Request $request){
        if($request->ajax()){
            $output = '';
            $arrAccount = ACCOUNT::join('ACCOUNTTYPE', 'ACCOUNTTYPE.ID', '=', 'ACCOUNT.IDAccountType')
            ->join('IMAGE', 'IMAGE.ID', '=', 'ACCOUNT.IDImage')
            ->orWhere('Username', 'like', '%'.$request->search.'%')
            ->orWhere('DisplayName', 'like', '%'.$request->search.'%')
            ->orWhere('PhoneNumber', 'like', '%'.$request->search.'%')
            ->get();
            if($arrAccount){
                foreach ($arrAccount as $account) {
                    $output .= '
                    <tr>
                        <td>'.$account->Username.'</td>
                        <td>'.$account->DisplayName.'</td>
                        <td><img class="img-account" src="data:image/jpg;base64,'.$account->Data.'" /></td>
                        <td>'.$account->Sex.'</td>
                        <td>'.$account->Address.'</td>
                        <td>'.$account->PhoneNumber.'</td>
                        <td>'.$account->BirthDay.'</td>
                        <td>'.$account->Name.'</td>
                        <td>
                            <form action="account-edit-'.$account->Username.'" method="post">
                            '.csrf_field().'
                                <button type="submit" class="btn btn-outline-success"><i class="fa fa-edit icon-edit-food"></i></button>
                                
                            </form>
                            <form action="account-delete-'.$account->Username.'" method="post">
                            '.csrf_field().'
                                <button type="submit" class="btn btn-outline-success"><i class="fa fa-trash icon-delete-food"></i></button>
                            </form>
                            </td>
                    </tr>
                    ';
                }
            }
        }
        return Response($output);
    }
}
