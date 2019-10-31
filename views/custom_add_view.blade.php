<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
  <!-- Your html goes here -->
  <div class='panel panel-default'>
    <div class='panel-heading'>Add Form</div>
    <div class='panel-body'>
      <form method='post' enctype='multipart/form-data' action='/qty'>
{{csrf_field()}}
<div class='form-group'>
          <input type='hidden' name='rfqs_id' value="{{ $rfqs_id }}" required class='form-control'/>
        </div>
           <div class='form-group'>
          <input type='hidden' name='branches_id' value="{{ $branches_id }}" required class='form-control'/>
        </div>
         <div class='form-group'>
          <label>مدة التنفيذ بالايام</label>
          <input type='number' name='period'  required class='form-control'/>
        </div>
           <div class='form-group'>
          <label>التكلفة بالريال </label>
          <input type='number' name='cost' required class='form-control'/>
        </div>
          
           <div class='form-group'>
          <label>ملاحظات</label>
          <input type='textarea' name='overview' required class='form-control'/>
        </div>
           <div class='form-group'>
          <label>ملف العرض</label>
          <input type='file' name='file'  required class='form-control'/>
        </div>
         <div class='form-group'>
       
   <input type='submit' class='btn btn-primary' value='ارسال تسعيرة'/>        </div>
        <!-- etc .... -->
        
      </form>
    </div>
    <div class='panel-footer'>
      <input type='submit' class='btn btn-primary' value=' تسعيرة'/>
    </div>
  </div>
@endsection