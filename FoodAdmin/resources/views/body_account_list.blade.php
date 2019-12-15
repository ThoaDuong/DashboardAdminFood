@extends('index')
@section('body_category_list')

<section id="main-content">
	<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      ACCOUNT
    </div>
    <div class="row w3-res-tb">
    <div class="col-sm-5">
            <input id="search" name="search" type="text" class="form-control search" placeholder=" Search">
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>User name</th>
            <th>Display name</th>
            <th>Image</th>
            <th>Sex</th>
            <th>Address</th>
            <th>Phone number</th>
            <th>Birthday</th>
            <th>Account type</th>
            <th style="width:30px;">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach($arrAccount as $account)
            <tr>
                <td>{{$account->Username}}</td>
                <td>{{$account->DisplayName}}</td>
                <td><img class="img-account" src="data:image/jpg;base64,{{$account->Data}}" /></td>
                <td>{{$account->Sex}}</td>
                <td>{{$account->Address}}</td>
                <td>{{$account->PhoneNumber}}</td>
                <td>{{$account->BirthDay}}</td>
                <td>{{$account->Name}}</td>
                <td>
                    <form action="account-edit-{{$account->Username}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-outline-success"><i class="fa fa-edit icon-edit-food"></i></button>
                        
                    </form>
                    <form action="account-delete-{{$account->Username}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-outline-success"><i class="fa fa-trash icon-delete-food"></i></button>
                    </form>
                    </td>
            </tr>
            @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
</section>
<script type="text/javascript">
       
    $("#search").on('keyup',function(){
        $search =  $(this).val();
        $.ajax({
            type:'get',
            url:"{{URL::to('account-search-ajax')}}",
            data:{'search':$search},
            dataType:"text",//dữ liệu trả về
            success:function(data){
                $('tbody').html(data); 
            }
        });
    });

    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
@stop