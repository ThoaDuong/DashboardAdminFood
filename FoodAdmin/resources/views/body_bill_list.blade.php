@extends('index')
@section('body_bill_list')

<section id="main-content">
	<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      BILL
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
      <form action="bill-search" method="post">
      @csrf
            <div class="input-group">
            <input type="text" name="Search" class="input-sm form-control" placeholder="Search">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-sm btn-default" type="button">Search</button>
            </span>
            </div>
        </form>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>ID</th>
            <th>Table</th>
            <th>Date check in</th>
            <th>Date check out</th>
            <th>Discount</th>
            <th>Status</th>
            <th>Detail</th>
            <th>Total price</th>
            <th style="width:30px;">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach($arrBill as $bill)
            <tr>
                <td>{{$bill->IDofBill}}</td>
                <td>{{$bill->NameTable}}</td>
                <td>{{$bill->DateCheckIn}}</td>
                <td>{{$bill->DateCheckOut}}</td>
                <td>{{$bill->Discount}}</td>
                <td>{{$bill->StatusBill}}</td>
                <td>
                    <table width="auto">
                        <tbody>
                        <tr>
                            <td>Name</td>
                            <td>Price</td>
                            <td>Quantity</td>
                        </tr>
                            @foreach($arrBillInfo as $info)
                                @if($info->IDBill == $bill->IDofBill)
                                <tr>
                                    <td>{{$info->Name}}</td>
                                    <td>{{$info->Price}}$</td>
                                    <td>{{$info->Quantity}} </td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
					</table>
                </td>
                <td>{{$bill->TotalPrice}}$</td>
                <td>
                <form action="bill-delete-{{$bill->IDofBill}}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-outline-success btnDelete"><i class="fa fa-trash icon-delete-food"></i></button>
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
<script>
    $(document).ready(function(){
      $(".btnDelete").click(function(){
        conform('hi');
      }
    });
</script>
@stop