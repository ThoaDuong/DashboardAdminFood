@extends('index')
@section('body_account_edit')

<section id="main-content">
	<section class="wrapper">
	<div class="form-w3layouts">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        ACCOUNT ADD
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form role="form" method="POST" action="account-control-edit-{{$account->Username}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" class="form-control" value="{{$account->Username}}" name="Username">
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="text" class="form-control" value="{{$account->Password}}" name="Password">
                                </div>
                                <div class="form-group">
                                    <label for="">Display Name</label>
                                    <input type="text" class="form-control" value="{{$account->DisplayName}}" name="DisplayName">
                                </div>
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <input type="text" class="form-control" value="{{$account->Address}}" name="Address">
                                </div>
                                <div class="form-group">
                                    <label for="">Phone number</label>
                                    <input type="text" class="form-control" value="{{$account->PhoneNumber}}" name="PhoneNumber">
                                </div>
                                <div class="form-group">
                                    <label for="">Birthday</label>
                                    <input type="date" class="form-control" value="{{$account->BirthDay}}" name="BirthDay">
                                </div>
                                <div class="form-group">
                                    <label for="">Sex</label>
                                    <select name="Sex" id="Sex">
                                        <option value="{{$account->Sex}}">{{$account->Sex}}</option>
                                        <option value="{{$sex}}">{{$sex}}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Account type</label>
                                    <select name="IDAccountType" id="IDAccountType">
                                        <option value="{{$accountType->ID}}">{{$accountType->ID}}</option>
                                        <option value="{{$type}}">{{$type}}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Image</label>
                                    <input type="file" accept="image/*" name="Image" id="img-input-food">
                                </div>
                                <div class="form-group">
                                    <div class="div-img-food">
                                        <img id="img-food" class="img-food" src="data:image/jpg;base64,{{$account->Data}}" alt="No image choose">
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
</section>
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