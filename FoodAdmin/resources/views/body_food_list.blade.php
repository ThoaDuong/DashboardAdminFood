@extends('index')
@section('body_food_list')

<section id="main-content">
	<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      FOOD
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5">
            <input id="search"  type="text" class="form-control search" placeholder=" Search">
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Image</th>
            <th>Category</th>
            <th>Price</th>
            <th style="width:30px;">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach($arrFood as $food)
            <tr>
                <td>{{$food->IDFood}} </td>
                <td>{{$food->NameFood}}</td>
                <td><img class="img-food" src="data:image/jpg;base64,{{$food->Image}}" /></td>
                <td>{{$food->NameCategory}}</td>
                <td>{{$food->Price}} $</td>
                <td>
                <form action="food-edit-{{$food->IDFood}}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-outline-success"><i class="fa fa-edit icon-edit-food"></i></button>
                    
                </form>
                <form action="food-delete-{{$food->IDFood}}" method="post">
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
            url:"{{URL::to('food-search-ajax')}}",
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