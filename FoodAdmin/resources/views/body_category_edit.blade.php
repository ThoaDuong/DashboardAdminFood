@extends('index')
@section('body_food_add')

<section id="main-content">
	<section class="wrapper">
	<div class="form-w3layouts">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        FOOD CATEGORY EDIT
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form role="form" method="POST" action="category-control-edit-{{$category->ID}}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="">ID Category</label>
                                    <input type="text" class="form-control" value="{{$category->ID}}" name="ID" placeholder="Enter ID category">
                                    <p class="help-block"><i>Nếu không nhập ID sẽ nhận giá trị tự động tăng.</i></p>
                                </div>
                                <div class="form-group">
                                    <label for="">Name Category</label>
                                    <input type="text" class="form-control" value="{{$category->Name}}" name="Name" placeholder="Enter name category">
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
</section>

@stop