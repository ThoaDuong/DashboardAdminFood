<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TABLE;

class controllerTable extends Controller
{
    public function getTableList(){
        $arrTable = TABLE::all();
        return view('body_table_list', compact('arrTable'));
    }
    public function getTableAdd(){
        return view('body_table_add');
    }
    public function postTableAddControl(Request $request){
        if(isset($_POST['submit-cancel'])){
			$arrCategory = TABLE::all();
            return view('body_table_add');
		}
		if(isset($_POST['submit-add'])){
            TABLE::insert(
            [
                'ID' => $request->ID,
                'Name' => $request->Name,
                'Status' => $request->Status
            ]);
            $arrTable = TABLE::all();
            return view('body_table_list', compact('arrTable'));
        }
    }

    public function getTableEdit($ID){
        $table = TABLE::find($ID);
        if($table->Status == -1){
            $status = 1;
        }else{
            $status = -1;
        }
        return view('body_table_edit', compact('table', 'status'));
    }
    public function postTableControlEdit(Request $request, $ID){
        if(isset($_POST['submit-cancel'])){
			$arrTable = TABLE::all();
            return view('body_table_list', compact('arrTable'));
		}
		if(isset($_POST['submit-edit'])){
            TABLE::where('ID', $ID)->update(
            [
                'ID' => $request->ID,
                'Name' => $request->Name,
                'Status' => $request->Status
            ]);
            $arrTable = TABLE::all();
            return view('body_table_list', compact('arrTable'));    
        }
    }
    public function getTableDelete($ID){
        TABLE::where('ID', $ID)->delete();
		$message = "Success deleted";
        echo "<script type='text/javascript'>alert('$message');</script>";
        $arrTable = TABLE::all();
        return view('body_table_list', compact('arrTable'));    
    }

    public function getTableSearchAjax(Request $request){
        if($request->ajax()){
            $output = '';
            $arrTable = TABLE::orWhere('Name', 'like', '%'.$request->search.'%')
            ->orWhere('Status', '=', $request->search)
            ->get();
            if($arrTable){
                foreach ($arrTable as $table) {
                    $output .= '
                    <tr>
                        <td>'.$table->ID.'</td>
                        <td>'.$table->Name.'</td>
                        <td>'.$table->Status.'</td>
                        <td>
                            <form action="table-edit-'.$table->ID.'" method="post">
                            '.csrf_field().'
                                <button type="submit" class="btn btn-outline-success"><i class="fa fa-edit icon-edit-food"></i></button>
                                
                            </form>
                            <form action="table-delete-'.$table->ID.'" method="post">
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
