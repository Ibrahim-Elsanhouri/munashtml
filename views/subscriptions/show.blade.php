@extends('layouts.master')


@section('title',$tender->name)

@section('meta')
    <meta name="title" content="{{$tender->name}}">
    <meta name="description" content="<?= str_limit($tender->excerpt, 150)?>">
    <meta property="og:locale" content="{{app()->getLocale()}}"/>
    <meta property="og:title" content="{{$tender->name}}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="{{$tender->path}}"/>
    <meta property="og:site_name" content="{{$tender->name}}"/>
    <meta property="og:description"
          content="تفخر مناقصاتكم بكونها الموقع الاول في السعودية الذي يقدم خدمة فريدة من نوعها من خلال طرح  كراسات الشروط والمناقصات للمشاريع الحكومية وفق اعلى معايير الشفافية">
    <meta property="og:image" content="{{  ($tender->org->image)}}">
    <meta name="twitter:title" content="{{$tender->name}}">
    <meta name="twitter:description"
          content="تفخر مناقصاتكم بكونها الموقع الاول في السعودية الذي يقدم خدمة فريدة من نوعها من خلال طرح  كراسات الشروط والمناقصات للمشاريع الحكومية وفق اعلى معايير الشفافية">
    <meta name="twitter:image" content="{{  $tender->org->image }}">

    <meta name="twitter:url" content="">
@endsection

@section('content')
    <section class="container">
        <div class="row">
            <div class="col-md-12 content-details">
                <h2><span>تفاصيل باقة الاشتراك
                
                
                </span></h2>

                <div class="card-details">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="details-item ">
                                    <ul>
                                            <li class="clearfix">
                                            <div class="one_xsmall title">نوع الاشتراك</div>
                                            <div class="one_xlarg">{{$sub->type}}</div>
                                        </li>
                                        
                                        <li class="clearfix">
                                            <div class="one_xsmall title">مدة الاشتراك بالايام</div>
                                            <div class="one_xlarg"> {{$sub->period}}</div>
                                        </li>
                               
                                
                                        <li class="clearfix">
                                            <div class="one_xsmall title">معلومات الاشتراك</div>
                                            <div class="one_xlarg">{{$sub->note}}</div>
                                        </li>
                                     
                                        
                                        <li class="clearfix">
                                            <div class="one_xsmall title">السعر قبل الخصم </div>
                                            <div class="one_xlarg">{{$sub->price_before}}</div>
                                        </li>
                                         <li class="clearfix">
                                            <div class="one_xsmall title"> نسبة الخصم  </div>
                                            <div class="one_xlarg"> % {{$sub->discount}} </div>
                                        </li>
                                     
                                        
                                        <li class="clearfix">
                                            <div class="one_xsmall title">السعر بعد الخصم </div>
                                            <div class="one_xlarg">{{   $sub->price_after }}</div>
                                        </li>
                                         
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-price clearfix">
                        <div class="one_half"><em>*</em> السعر قبل الخصم
                            <span> {{  $sub->price_befor }}  {{  trans('app.$')}} </span>
                        </div>
                        <div class="one_half"><em>*</em>السعر بعد الخصم 
                            <span> {{ $sub->price_after}} {{  trans('app.$')}} </span>
                        </div>
                    </div>

        
                     

                

              {{-- 
               @if(count($tender->files)>0)
                        <div class="download-box">
                            <h3 class="text-center"><span>{{trans('app.tenders.upload_files')}}</span></h3>
                            @foreach($tender->files  as $file)
                                <a href="{{uploads_url($file->path)}}" target="_blank"
                                   class="btn btn-default">{{$file->title}}.pdf</a>
                            @endforeach
                        </div>
                    @endif
              
              
               --}}     


                    <div class="download-box">
                        <h3 class="text-center"><span>الاشتراك في الباقة</span></h3>
                  @if(!CRUDBooster::myId())
                            <p>{{trans('app.register_purchase_tender')}}<a
                                        href="/register"> {{trans('app.register_now')}} </a></p>
                            <p>{{trans('app.account_register')}}<a
                                        href="/login"> {{trans('app.login')}} </a>
                            </p>
                            @endif
                         
                        @if( (CRUDBooster::myId())   && ( CRUDBooster::myPoints() >= $tender->download_value ) && (!$tender->is_bought()) )
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#buycb">

شراء كراسة الشروط
</button>  <style>
            .modal-header .close {
                margin-top: -24px;
            }
        </style>
        <div class="modal fade" id="buycb" tabindex="-1" role="dialog" aria-labelledby="buycb" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle"> {{trans('app.tenders.buy')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

            
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">{{ trans('app.cb_price') }}
                                :  {{ $tender->download_value }} {{trans('app.point')}}</div>

                            <div class="col-md-6">{{ trans('app.tax') }}
                                : {{ ($tender->vat($download_value)) }} {{trans('app.point')}}</div>
                        </div>
                        <hr>
                        <p>{{ trans('app.current_points') }}
                            : {{  CRUDBooster::myPoints() }} {{trans('app.point')}}</p>
                   
                    <p>مجموع العملية
                            : {{ $tender->total_vat($download_value) }} {{   trans('app.point') }}  </p>
<hr>     
                            <p class="fieldset" style="margin: 0;">
                                <input type="checkbox" name="terms" id="accept-terms">
                                <label for="accept-terms">{{trans('app.accept_with')}} <a target="_blank"
                                                                                          href="/policy"
                                                                                          class="text-primary">{{trans('app.terms')}}</a></label>
                            </p>
                
                    </div>
                    <div class="modal-footer">
                        <form action="{{route('tenders.buy')}}"
                              method="post">
                            {{csrf_field()}}
                            <input name="tender_id" value="{{ $tender->id }}" type="hidden" />
                          <input name="points" value="{{ $tender->download_value }}" type="hidden" />
                          <input name="vat" value="{{ $tender->vat($download_value) }}" type="hidden" />
                          <input name="total" value="{{ $tender->total_vat($download_value) }}" type="hidden" />

                            <button type="submit"
                                    class="btn btn-primary"
                                    id="{{$user->points - $points<0?'':'can-buy'}}"
                                    disabled>{{trans('app.tenders.buy')}}</button>
                            <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{trans('app.close')}}</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>



  @elseif( (CRUDBooster::myId())   && ( CRUDBooster::myPoints() <= $tender->download_value ) && (!$tender->is_bought()) )
<p>نقاطك لا تكفي لتحميل الكراسة 
, الرجاء شحن بطاقتك
 </p>
</br>

<a href="{{ route('userm.recharge') }}" >
<img border="0" title="سداد مدى" alt="مدى" src="/assets/images/mada.jpg" width="100" height="100">
</a>
<br>
<a href="{{ route('user.recharge') }}"><img alt="Credit Card Logos" title="سداد فيزا ماستر كارد "   src="http://www.credit-card-logos.com/images/visa_mastercard_credit-card-logos/visa_mastercard_new1.gif"                                width="120" height="45" border="0" /></a>





@elseif(CRUDBooster::myId())
<a href="/admin"><p> تم شراء الكراسة , الرجاء متابعة بريدك في لوحة التحكم </p></a>

@endif
                          
                                </div>
                            </div>
                        
                    </div>
                </div>

            </div>
        </div>

    </section>
@endsection






