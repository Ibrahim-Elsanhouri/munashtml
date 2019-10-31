@extends('crudbooster::admin_template')
@section('content')
<table class='table table-striped table-bordered'>
  <thead>
      <tr>
        <th> اسم المناقصة</th>
        <th>المكتبة</th>
      
       </tr>
  </thead>
  <tbody>
  
    @foreach($result as $row)
      <tr>
        <td>{{$row->tender->name}}</td>
                <td>
                @if($row->sent == 'active')
                <a href="/{{ $row->tender->file }}" class="btn btn-primary" download>  تحميل الكراسة</a>
                @else
                <button class="btn btn-danger">سوف يتم ارسالها قريبا</button>
                @endif
                </td>
                        <td>
                @if($row->sent == 'active')
                <a href="{{ route('invoice.print' ,  $row->id) }}" class="btn btn-primary" target="_blank">  طباعة الفاتورة </a>
         @else
                         <button class="btn btn-danger">جاري الفوترة</button>
@endif
                </td>
     {{--  <td>
          <!-- To make sure we have read access, wee need to validate the privilege -->
          @if(CRUDBooster::isUpdate() && $button_edit)
          <a class='btn btn-success btn-sm' href='{{CRUDBooster::mainpath("edit/$row->id")}}'>Edit</a>
          @endif
          
          @if(CRUDBooster::isDelete() && $button_edit)
          <a class='btn btn-success btn-sm' href='{{CRUDBooster::mainpath("delete/$row->id")}}'>Delete</a>
          @endif
        </td> --}}  
       </tr>
    @endforeach
  </tbody>
</table>
@endsection