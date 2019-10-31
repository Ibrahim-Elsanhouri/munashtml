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
                <h2><span>{{trans('app.tenders.details')}} 
                
                
                </span></h2>

                <div class="card-details">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-3">
                            <div class="card-img">
                                   <img  src="/{{  $tender->org->image}}"  alt="{{  $tender->org->name }}"  >
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="details-item ">
                                    <ul>
                                            <li class="clearfix">
                                            <div class="one_xsmall title">{{trans('app.tenders.name')}}</div>
                                            <div class="one_xlarg">{{$tender->name}}</div>
                                        </li>
                                        
                                        <li class="clearfix">
                                            <div class="one_xsmall title">{{trans('app.tenders.id')}}</div>
                                            <div class="one_xlarg"> {{$tender->tnumber}}</div>
                                        </li>
                               
                                
                                        <li class="clearfix">
                                            <div class="one_xsmall title">{{trans('app.tenders.objective')}}</div>
                                            <div class="one_xlarg">{{$tender->goal}}</div>
                                        </li>
                                        <li class="clearfix">
                                            <div class="one_xsmall title">{{trans('app.tenders.org')}}</div>
                                            <div class="one_xlarg">{{  $tender->org->name}}</div>
                                        </li>
                                        
                                                <li class="clearfix">
                                            <div class="one_xsmall title">{{trans('app.tenders.tender_activity')}}</div>
                                            <div class="one_xlarg">
                                            @foreach ( $tender->activities  as $activity  )
                                                {{ $activity->name }} </br>
                                            @endforeach
                                         </div>
                                        </li>
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-price clearfix">
                        <div class="one_half"><em>*</em> {{trans('app.tenders.cb_real_price')}}
                            <span> {{  $tender->real_value }}  {{  trans('app.$')}} </span>
                        </div>
                        <div class="one_half"><em>*</em> {{trans('app.tenders.cb_downloaded_price')}}
                            <span> {{ $tender->download_value}} {{  trans('app.$')}} </span>
                        </div>
                    </div>

                        <div class="card-cont">
                            <div class="row">
                                <div class="col-md-5 padt"> {{trans('app.tenders.remaining_hours')}}</div>
                                <div class="col-md-6">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar"
                                     
                                             aria-valuenow=   "{{  $tender->remaining_days(date('d-m-Y', strtotime($tender->receive_date))) }}"
                                             aria-valuemin="0"
                                             aria-valuemax="100" style="">
                                    <span class="popOver" data-toggle="tooltip" data-placement="top"
                                          title=" {{  $tender->remaining_days(date('d-m-Y', strtotime($tender->receive_date))) }} {{trans('app.day')}}"> </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
        

                    <div class="card-date clearfix">
                        <h3 class="text-center"><span>{{trans('app.tenders.dates')}}</span></h3>
                        <div class="item one_four">
                            <p>{{trans('app.tenders.files_opened_at')}}</p>
                            <p><i class="fa fa-calendar"></i> <span
                                        class="text-grey">{{ $tender->open_date}}</span>

                            </p>
    <b class="text-grey block">{{ $tender->hijri(date('d-m-Y', strtotime( $tender->open_date)))->format('d-m-Y') }}</b>

                        </div>
                        <div class="item one_four">
                            <p>{{trans('app.tenders.last_get_offer_at')}}</p>
                            <p><i class="fa fa-calendar"></i>
                             <span class="text-grey">{{  $tender->receive_date }}</span>

                            </p>
    <b class="text-grey block">{{ $tender->hijri(date('d-m-Y', strtotime( $tender->receive_date)))->format('d-m-Y') }}</b>

                        </div>

                        <div class="item one_four">
                            <p>{{trans('app.tenders.created')}}</p>
                            <p><i class="fa fa-calendar"></i>
                             <span
                                        class="text-grey">{{  ($tender->publish_date)}} </span>

                                <br>
    <b class="text-grey block">{{ $tender->hijri(date('d-m-Y', strtotime( $tender->publish_date)))->format('d-m-Y') }}</b>
                            </p>
                        </div>
                        @if($tender->request_date)
                        <div class="item one_four">
                            <p>{{trans('app.tenders.last_queries_at')}}</p>
                            <p><i class="fa fa-calendar"></i> <span
                                        class="text-grey">{{ ($tender->request_date)}}</span>
                                <br>
    <b class="text-grey block">{{ $tender->hijri(date('d-m-Y', strtotime( $tender->request_date)))->format('d-m-Y') }}</b>
                            </p>
                        </div>
                        @endif
                        
                        
                    </div>

                    <div class="details-box">
                        <div class="details-item ">
                            <ul>
                                <li class="clearfix">
                                    <div class="one_xsmall title"> {{trans('app.tenders.address_files_open')}}</div>
                                    <div class="one_xlarg">{{  $tender->open_place or '--'}} </div>
                                </li>
                                <li class="clearfix">
                                    <div class="one_xsmall title"> {{trans('app.tenders.address_execute')}}</div>
                                    <div class="one_xlarg">{{$tender->done_place or '--'}}</div>
                                </li>
                                <li class="clearfix">
                                    <div class="one_xsmall title">{{trans('app.tenders.address_get_offer')}}</div>
                                    <div class="one_xlarg">{{$tender->offer_place or '--'}}</div>
                                </li>
                                <li class="clearfix">
                                    <div class="one_xsmall title">{{trans('app.tenders.places')}}</div>
                                    <div class="one_xlarg area">
                                        <ul>
                                       @foreach($tender->places as $place)
                                                <li>{{$place->name}}</li>
                                            @endforeach   
                                        </ul>
                                    </div>
                                </li>
                            </ul>
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
                        <h3 class="text-center"><span>{{trans('app.tenders.download')}}</span></h3>
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
{{--  
 <style>
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
                   @php
                        $user=fauth()->user()->in_company?fauth()->user()->company[0]:fauth()->user();
                        $points=tax($tender->points,false);
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">{{ trans('app.cb_price') }}
                                :  {{ $tender->points }} {{  trans('app.point')}}</div>

                            <div class="col-md-6">{{ trans('app.tax') }}
                                : {{ ($tender->points) }} {{trans('app.point')}}</div>
                        </div>
                        <hr>
                        <p>{{ trans('app.current_points') }}
                            : {{ $user->points }} {{trans('app.point')}}</p>
                        <hr>
                        <p class="{{$user->points - $tender->points<=0?'text-danger':''}}"> {{ trans('app.points_after_buy') }}
                            : {{ $user->points - $tender->points }} {{trans('app.point')}}</p>
                        <hr>
                        @if($user->points - $points>=0)
                            <p class="fieldset" style="margin: 0;">
                                <input type="checkbox" name="terms" id="accept-terms">
                                <label for="accept-terms">{{  trans('app.accept_with')}} <a target="_blank"
                                                                                          href="{{  route('page.show', ['slug' => 'الشروط والأحكام'])}}"
                                                                                          class="text-primary">{{  trans('app.terms')}}</a></label>
                            </p>
                        @endif
                        <a href="{{route('user.recharge')}}"
                           class="text-danger">{{$user->points - $points<0?trans('app.please_recharge'):''}}</a>
                    </div>
                    <div class="modal-footer">
                        <form action="{{route('tenders.buy',['id'=>$tender->id,'lang'=>app()->getLocale()])}}"
                              method="post">
                            {{csrf_field()}}
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

                        @endif

                        @endif




--}}


                           {{-- 
                           
                           
                           
                           
                           
                           
                           
                           
                           
                           
                             <div class="row">
                                <div class="col" style="text-align: center">
                                    @if($tender->is_bought)
                                        <a type="button"
                                           href="{{route('tenders.download', ['id' => $tender->id, 'lang' => app()->getLocale()])}}"
                                           class="btn btn-default">
                                            trans('app.tenders.download')}}
                                        </a>
                                    @else
                           
                           
                           
                            
                                    @if(fauth()->user()->can_buy)  
                                       
                                           <a type="button" class="btn btn-primary" data-toggle="modal"
                                               data-target="#buycb">
                                                {{ trans('app.tenders.buy')
</a> }}
                                       
                                       
                                       }} 
                                        
                                      {{ }}
                                       @else
                                            <div class="alert alert-warning">
                                                {{trans('app.you_cannot_buy')}}
                                            </div>
                                        @endif
                                    @endif
                                      
                                      }} 
                           
                           
                            --}}
                          
                                </div>
                            </div>
                        
                    </div>
                </div>

            </div>
        </div>

    </section>
  {{-- @if(fauth()->check()&&!$tender->is_bought)
        <style>
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
                 {{--   @php
                        $user=fauth()->user()->in_company?fauth()->user()->company[0]:fauth()->user();
                        $points=tax($tender->points,false);
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">{{ trans('app.cb_price') }}
                                :  {{ $tender->points }} {{  }}trans('app.point')}}</div>

                            <div class="col-md-6">{{ trans('app.tax') }}
                                : {{ tax($tender->points) }} {{trans('app.point')}}</div>
                        </div>
                        <hr>
                        <p>{{ trans('app.current_points') }}
                            : {{ $user->points }} {{trans('app.point')}}</p>
                        <hr>
                        <p class="{{$user->points - $tender->points<=0?'text-danger':''}}"> {{ trans('app.points_after_buy') }}
                            : {{ $user->points - $tender->points }} {{trans('app.point')}}</p>
                        <hr>
                        @if($user->points - $points>=0)
                            <p class="fieldset" style="margin: 0;">
                                <input type="checkbox" name="terms" id="accept-terms">
                                <label for="accept-terms">{{  }}trans('app.accept_with')}} <a target="_blank"
                                                                                          href="{{route('page.show', ['slug' => 'الشروط والأحكام'])}}"
                                                                                          class="text-primary">{{trans('app.terms')}}</a></label>
                            </p>
                        @endif
                        <a href="{{route('user.recharge')}}"
                           class="text-danger">{{$user->points - $points<0?trans('app.please_recharge'):''}}</a>
                    </div>
                    <div class="modal-footer">
                        <form action="{{route('tenders.buy',['id'=>$tender->id,'lang'=>app()->getLocale()])}}"
                              method="post">
                            {{csrf_field()}}
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
    @endif --}} 
@endsection



@push('scripts')
    <script>
        $(function () {
            @if(session('download'))
            setTimeout(function () {
                window.location.href = "{{session('download')}}";
            })
            @endif
            $('[data-toggle="tooltip"]').tooltip({trigger: 'manual'}).tooltip('show');
        });

        $('#accept-terms').change(function (e) {
            var $base = $('#can-buy');
            if ($base.length && e.target.checked) {
                $base.removeAttr('disabled')
            } else {
                $base.attr('disabled', true)
            }
        });
        $(".progress-bar").each(function () {
            each_bar_width = $(this).attr('aria-valuenow');
            $(this).width(each_bar_width + '%');
        });
        $(document).ready(function () {
            $(".share").hideshare({
                link: "",           // Link to URL defaults to document.URL
                title: "",          // Title for social post defaults to document.title
                media: "",          // Link to image file defaults to null
                facebook: true,     // Turns on Facebook sharing
                twitter: true,      // Turns on Twitter sharing
                pinterest: true,    // Turns on Pinterest sharing
                googleplus: false,   // Turns on Google Plus sharing
                linkedin: false,     // Turns on LinkedIn sharing
                position: "right", // Options: Top, Bottom, Left, Right
                speed: 150           // Speed of transition
            });
        });
    </script>


@endpush