<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FOODCATEGORY;

class controllerCategory extends Controller
{
    public function getCategoryList(){
        $arrCategory = FOODCATEGORY::all();
        return view('body_category_list', compact('arrCategory'));
    }
    public function getCategoryAdd(){
        return view('body_category_add');
    }
    public function postCategoryAddControl(Request $request){
        if(isset($_POST['submit-cancel'])){
			$arrCategory = FOODCATEGORY::all();
            return view('body_category_add');
		}
		if(isset($_POST['submit-add'])){
            FOODCATEGORY::insert(
            [
                'ID' => $request->ID,
                'Name' => $request->Name
            ]);
            $arrCategory = FOODCATEGORY::all();
            return view('body_category_list', compact('arrCategory'));
        }
    }
    public function getCategoryEdit($ID){
        $category = FOODCATEGORY::find($ID);
        return view('body_category_edit', compact('category'));
    }
    public function postCategoryControlEdit(Request $request, $ID){
        if(isset($_POST['submit-cancel'])){
			$arrCategory = FOODCATEGORY::all();
            return view('body_category_list', compact('arrCategory'));
		}
		if(isset($_POST['submit-edit'])){
            FOODCATEGORY::where('ID', $ID)->update(
            [
                'ID' => $request->ID,
                'Name' => $request->Name
            ]);
            $arrCategory = FOODCATEGORY::all();
            return view('body_category_list', compact('arrCategory'));
        }
    }
    public function getCategoryDelete($ID){
        FOODCATEGORY::where('ID', $ID)->delete();
		$message = "Success deleted";
        echo "<script type='text/javascript'>alert('$message');</script>";
        $arrCategory = FOODCATEGORY::all();
        return view('body_category_list', compact('arrCategory'));
    }
    public function getCategorySearchAjax(Request $request){
        if($request->ajax()){
            $output = '';
            $arrCategory = FOODCATEGORY::Where('Name', 'like', '%'.$request->search.'%')->get();
            if($arrCategory){
                foreach ($arrCategory as $category) {
                    $output .= '
                    <tr>
                        <td>'.$category->ID.'</td>
                        <td>'.$category->Name.'</td>
                        <td>
                            <form action="category-edit-'.$category->ID.'" method="post">
                                '.csrf_field().'
                                <button type="submit" class="btn btn-outline-success"><i class="fa fa-edit icon-edit-food"></i></button>
                                
                            </form>
                            <form action="category-delete-'.$category->ID.'" method="post">
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
