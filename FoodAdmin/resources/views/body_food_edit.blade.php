@extends('index')
@section('body_food_edit')

<section id="main-content">
	<section class="wrapper">
	<div class="form-w3layouts">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Food Insert
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form role="form" method="POST" action="food-control-edit-{{$food->ID}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="">ID Food</label>
                                    <input type="text" class="form-control" name="IDFood" value="{{$food->ID}}" placeholder="Enter ID food">
                                    <p class="help-block"><i>Nếu không nhập ID sẽ nhận giá trị tự động tăng.</i></p>
                                </div>
                                <div class="form-group">
                                    <label for="">Name Food</label>
                                    <input type="text" class="form-control" name="NameFood" value="{{$food->Name}} " placeholder="Enter name food">
                                </div>
                                <div class="form-group">
                                    <label for="">Price</label>
                                    <input type="number" class="form-control" name="Price" value="{{$food->Price}}" placeholder="Enter price">
                                </div>
                                <div class="form-group">
                                    <label for="">Category</label>
                                    <select class="form-control" name="IDCategory">
                                    <option value="{{$categoryFood->ID}}">{{$categoryFood->Name}} </option>
                                        @foreach($arrFoodCategory as $fc)
                                        <option value="{{$fc->ID}}">{{$fc->Name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Image</label>
                                    <input type="file" accept="image/*" name="Image" id="img-input-food">
                                </div>
                                <div class="form-group">
                                    <div class="div-img-food">
                                        <img id="img-food" class="img-food" src="data:image/jpg;base64,{{$food->Data}}" alt="No image choose">
                                    </div>
                                </div>
                                
                                <button type="submit" name="submit-cancel" class="btn btn-danger">Cancel</button>
                                <button type="submit" name="submit-edit" class="btn btn-success">Edit</button>
                                
                            </form>
                        </div>

                    </div>
                </section>
            </div>
        <!-- page end-->
        </div>
<script type="text/javascript">
    function readURL(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();

            reader.onload = function(e){
                $('#img-food').attr('src',e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $('#img-input-food').change(function(){
        readURL(this);
    });
</script>
@stop