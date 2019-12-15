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
                        TABLE EDIT
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form role="form" method="POST" action="table-control-edit-{{$table->ID}}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="">ID Table</label>
                                    <input type="text" class="form-control" value="{{$table->ID}}" name="ID" placeholder="Enter ID table">
                                    <p class="help-block"><i>Nếu không nhập ID sẽ nhận giá trị tự động tăng.</i></p>
                                </div>
                                <div class="form-group">
                                    <label for="">Name Table</label>
                                    <input type="text" class="form-control" value="{{$table->Name}}" name="Name" placeholder="Enter name table">
                                </div>
                                <div class="form-group">
                                    <label for="">Status Table</label>
                                    <select name="Status" id="Status">
                                        <option value="{{$table->Status}}">{{$table->Status}}</option>
                                        <option value="{{$status}}">{{$status}}</option>
                                    </select>
                                    <!-- <input type="number" class="form-control" name="Status" placeholder="Enter name table"> -->
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