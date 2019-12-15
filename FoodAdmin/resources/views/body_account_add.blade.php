@extends('index')
@section('body_account_add')

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
                            <form role="form" method="POST" action="account-add-control" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" class="form-control" name="Username">
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="text" class="form-control" name="Password">
                                </div>
                                <div class="form-group">
                                    <label for="">Display Name</label>
                                    <input type="text" class="form-control" name="DisplayName">
                                </div>
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <input type="text" class="form-control" name="Address">
                                </div>
                                <div class="form-group">
                                    <label for="">Phone number</label>
                                    <input type="text" class="form-control" name="PhoneNumber">
                                </div>
                                <div class="form-group">
                                    <label for="">Birthday</label>
                                    <input type="date" class="form-control" name="BirthDay">
                                </div>
                                <div class="form-group">
                                    <label for="">Sex</label>
                                    <select name="Sex" id="Sex">
                                        <option value="1">Male</option>
                                        <option value="0">Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Account type</label>
                                    <select name="IDAccountType" id="IDAccountType">
                                    @foreach($arrAccountType as $type)
                                        <option value="{{$type->ID}}">{{$type->Name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Image</label>
                                    <input type="file" accept="image/*" name="Image" id="img-input-food">
                                </div>
                                <div class="form-group">
                                    <div class="div-img-food">
                                        <img id="img-food" class="img-food" src="" alt="No image choose">
                                    </div>
                                </div>
                                
                                <button type="submit" name="submit-cancel" class="btn btn-danger">Cancel</button>
                                <button type="submit" name="submit-add" class="btn btn-success">Add</button>
                                
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