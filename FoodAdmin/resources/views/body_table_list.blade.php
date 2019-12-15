@extends('index')
@section('body_category_list')

<section id="main-content">
	<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      TABLE
    </div>
    <div class="row w3-res-tb">
    <div class="col-sm-5">
            <input id="search"  type="text" class="form-control search" placeholder="Search">
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Status</th>
            <th style="width:30px;">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach($arrTable as $table)
            <tr>
                <td>{{$table->ID}}</td>
                <td>{{$table->Name}}</td>
                <td>{{$table->Status}}</td>
                <td>
                    <form action="table-edit-{{$table->ID}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-outline-success"><i class="fa fa-edit icon-edit-food"></i></button>
                        
                    </form>
                    <form action="table-delete-{{$table->ID}}" method="post">
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
            url:"{{URL::to('table-search-ajax')}}",
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