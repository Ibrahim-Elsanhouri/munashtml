<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>فاتورة شركة مناقصاتكم المحدودة</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet" />
	  <!-- CUSTOM STYLE  -->
    <link href="{{ asset('assets/css/custom-style.css') }}" rel="stylesheet" />
    <!-- GOOGLE FONTS -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/droid-arabic-kufi" type="text/css"/>

</head>
<body>
 <div class="container">
     
      <div class="row pad-top-botm ">
         <div class="col-lg-6 col-md-6 col-sm-6 ">
            <img src="{{asset('/assets')}}/images/logo.jpg" style="padding-bottom:20px;" /> 
         </div>
          <div class="col-lg-6 col-md-6 col-sm-6">
            
               <strong>   شركة مناقصاتكم المحدودة</strong>
              <br />
                  <i> </i> طريق الامير محمد بن عبدالرحمن 
              <br />
الرياض               <br />
المملكة العربية السعودية              
         </div>
     </div>
     <div  class="row text-center contact-info">
         <div class="col-lg-12 col-md-12 col-sm-12">
             <hr />
             <span>
                 <strong>info@munagasatcom.com </strong>  
             </span>
             <span>
                 <strong> 920008769 </strong> 
             </span>
              <span>
                 <strong> {{$order->id + 100}} فاتورة رقم   </strong> 
             </span>
             <hr />
         </div>
     </div>
     <div  class="row pad-top-botm client-info">
         <div class="col-lg-6 col-md-6 col-sm-6">
         <h4>  <strong>معلومات السداد</strong></h4>
            <b>  {{ $order->order_date }} :    تاريخ الشراء 
        </b>
             <br />
                            <b>حالة السداد  :   نقاط مدفوعة  </b>

              <br />

         </div>
          <div class="col-lg-6 col-md-6 col-sm-6">
            
               <h4>  <strong>معلومات العميل </strong></h4>
            <b>{{ $order->user->name }}</b>
              <br />
                       <b>{{ $order->user->mobile }}</b> 
              <br />
             <b>{{ $order->user->email }}</b> 
              <br />
         </div>
     </div>
     <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-12">
           <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>المجموع</th>
                                    <th>الرسوم الادارية </th>
                                     <th>النقاط </th>
                                   <th>اسم المناقصة</th>

                                         <th>رقم التسلسل</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                                                    <td>{{ $order->total }}</td>

                                    <td>{{ $order->vat }}</td>
                                     <td>{{ $order->points }}</td>
                                 <td>{{ $order->tender->name }}</td>
                                    <td>1</td>
                                   
                               
                                </tr>
                   
                                
                            </tbody>
                        </table>
               </div>
             <hr />
             <div class="ttl-amts">
               <h4><strong> {{ $order->total  }} : اجمالي النقاط </strong></h5>
             </div>
             <hr />
              <div class="ttl-amts">
                  <h4><strong>       {{ $order->vat  }} :  رسوم ادارية  </strong> </h5>
             </div>
             <hr />
              <div class="ttl-amts">
                  <h4> <strong>{{  $order->total }} : الاجمالي</strong> </h4>
             </div>
         </div>
     </div>
   
      <div class="row pad-top-botm">
         <div class="col-lg-12 col-md-12 col-sm-12">
             <hr />
             <a href="#" onclick="print()" class="btn btn-primary btn-lg" >Print Invoice</a>
             &nbsp;&nbsp;&nbsp;
              <a href="#"  onclick="print()" class="btn btn-success btn-lg" >Download In Pdf</a>

             </div>
         </div>
 </div>

</body>
</html>
