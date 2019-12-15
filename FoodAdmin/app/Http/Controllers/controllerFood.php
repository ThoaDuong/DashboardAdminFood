<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FOOD;
use App\FOODCATEGORY;
use App\IMAGE;
use File;

class controllerFood extends Controller
{
    public function getFoodList(){
        
        $arrFood = FOOD::join('FOODCATEGORY', 'FOOD.IDCategory', '=', 'FOODCATEGORY.ID' )
            ->join('IMAGE', 'IMAGE.ID', '=', 'FOOD.IDImage')
            ->select('FOOD.ID AS IDFood', 'FOOD.Name as NameFood', 'Price', 'FOODCATEGORY.Name as NameCategory', 'IMAGE.Data as Image')
            ->get();
        return view('body_food_list', compact('arrFood'));
    }
    public function getFoodAdd(){
        $arrFoodCategory = FOODCATEGORY::all();
        return view('body_food_add', compact('arrFoodCategory'));
    }
    public function postFoodAddControl(Request $request){
        if(isset($_POST['submit-cancel'])){
			$arrFoodCategory = FOODCATEGORY::all();
            return view('body_food_add', compact('arrFoodCategory'));
		}
		if(isset($_POST['submit-add'])){
            $image = $request->file('Image');
            $imageEncode = base64_encode(file_get_contents($image));
            IMAGE::insert(
            [
                'Data' => $imageEncode,
            ]);
            $imgFood = IMAGE::all()->last();
            FOOD::insert(
            [
                'ID' => $request->IDFood,
                'Name' => $request->NameFood,
                'Price' => $request->Price,
                'IDCategory' => $request->IDCategory,
                'IDImage' => $imgFood->ID
            ]);
            $arrFood = FOOD::join('FOODCATEGORY', 'FOOD.IDCategory', '=', 'FOODCATEGORY.ID' )
                ->join('IMAGE', 'IMAGE.ID', '=', 'FOOD.IDImage')
                ->select('FOOD.ID AS IDFood', 'FOOD.Name as NameFood', 'Price', 'FOODCATEGORY.Name as NameCategory', 'IMAGE.Data as Image')
                ->get();
            return view('body_food_list', compact('arrFood'));
        } 
    }
    public function postFoodControlEdit(Request $request, $IDFood){
        if(isset($_POST['submit-cancel'])){
			$arrFood = FOOD::join('FOODCATEGORY', 'FOOD.IDCategory', '=', 'FOODCATEGORY.ID' )
            ->join('IMAGE', 'IMAGE.ID', '=', 'FOOD.IDImage')
            ->select('FOOD.ID AS IDFood', 'FOOD.Name as NameFood', 'Price', 'FOODCATEGORY.Name as NameCategory', 'IMAGE.Data as Image')
            ->get();
            return view('body_food_list', compact('arrFood'));
		}
		if(isset($_POST['submit-edit'])){
            if($request->Image != null){   
                $image = $request->file('Image');
                $imageEncode = base64_encode(file_get_contents($image));
                $imageFood = FOOD::where('ID', $IDFood)->first();
                IMAGE::where('ID', $imageFood->IDImage)->update(
                    [
                    'Data' => $imageEncode,
                ]);  
            }
            FOOD::where('ID', $IDFood)->update(
                [
                    'ID' => $request->IDFood,
                    'Name' => $request->NameFood,
                    'Price' => $request->Price,
                    'IDCategory' => $request->IDCategory
                ]);
            $arrFood = FOOD::join('FOODCATEGORY', 'FOOD.IDCategory', '=', 'FOODCATEGORY.ID' )
                ->join('IMAGE', 'IMAGE.ID', '=', 'FOOD.IDImage')
                ->select('FOOD.ID AS IDFood', 'FOOD.Name as NameFood', 'Price', 'FOODCATEGORY.Name as NameCategory', 'IMAGE.Data as Image')
                ->get();
            return view('body_food_list', compact('arrFood'));   
        }
    }
    public function getFoodEdit(Request $request, $IDFood){
        $food = FOOD::join('IMAGE', 'IMAGE.ID', '=', 'FOOD.IDImage')
            ->select('FOOD.ID AS ID', 'Name', 'Price', 'Data', 'IDCategory')
            ->where('FOOD.ID', '=', $IDFood)
            ->first();
        $categoryFood = FOODCATEGORY::find($food->IDCategory);
        $arrFoodCategory = FOODCATEGORY::where('ID', '<>', $food->IDCategory)->get();
        return view('body_food_edit', compact('food', 'categoryFood', 'arrFoodCategory'));
    }
    public function getFoodDelete(Request $request, $IDFood){
        FOOD::where('ID', $IDFood)->delete();
		$message = "Success deleted";
		echo "<script type='text/javascript'>alert('$message');</script>";
		$arrFood = FOOD::join('FOODCATEGORY', 'FOOD.IDCategory', '=', 'FOODCATEGORY.ID' )
            ->join('IMAGE', 'IMAGE.ID', '=', 'FOOD.IDImage')
            ->select('FOOD.ID AS IDFood', 'FOOD.Name as NameFood', 'Price', 'FOODCATEGORY.Name as NameCategory', 'IMAGE.Data as Image')
            ->get();
        return view('body_food_list', compact('arrFood'));
    }
    public function getFoodSearchAjax(Request $request){
        if($request->ajax()){
            $output = '';
            $arrFood = FOOD::join('FOODCATEGORY', 'FOOD.IDCategory', '=', 'FOODCATEGORY.ID' )
            ->join('IMAGE', 'IMAGE.ID', '=', 'FOOD.IDImage')
            ->select('FOOD.ID AS IDFood', 'FOOD.Name as NameFood', 'Price', 'FOODCATEGORY.Name as NameCategory', 'IMAGE.Data as Image')
            ->orWhere('FOOD.Name', 'like', '%'.$request->search.'%')
            ->orWhere('FOODCATEGORY.Name', 'like', '%'.$request->search.'%')
            ->get();
            if($arrFood){
                foreach ($arrFood as $food) {
                    $output .= '
                    <tr>
                        <td>'.$food->IDFood.' </td>
                        <td>'.$food->NameFood.'</td>
                        <td><img class="img-food" src="data:image/jpg;base64,'.$food->Image.'" /></td>
                        <td>'.$food->NameCategory.'</td>
                        <td>'.$food->Price.' $</td>
                        <td>
                        <form action="food-edit-'.$food->IDFood.'" method="post">
                            '.csrf_field().'
                            <button type="submit" class="btn btn-outline-success"><i class="fa fa-edit icon-edit-food"></i></button>
                            
                        </form>
                        <form action="food-delete-'.$food->IDFood.'" method="post">
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
