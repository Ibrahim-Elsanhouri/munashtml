@extends('layouts.master')
@push("head")
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"/>
@endpush
@section('title',trans('app.tenders.tenders'))
@section('content')
    <!--Begin:content-->
    <section class="container">
        <div class="row">
                <div class="col-md-4" id="filter-search">
                <div class="side-box">
                    <h2>{{trans('app.tenders.search')}}</h2>
                    <div class="feildcont">
                        <form method="get" action="/tenders">
                            <div class="form-group clearfix">
                                <label class="col-xs-12 col-md-3">{{trans('app._search')}}</label>
                                <div class="col-xs-12 col-md-9 new-f-group">
                                    <div class="form-group  clearfix">
                                        <input type="search" class="form-control" placeholder="{{trans('app._search')}}"
                                               name="q" value="{{\Request::get('q')}}">
                                        <span class="focus-border"><i></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <label class="col-xs-12 col-md-3">{{trans('app.tenders.activity')}}</label>
                                <div class="col-xs-12 col-md-9 new-f-group">
                                    <div class="form-group clearfix">
                                        <select name="activity_id[]" class="effect-9 form-control select2">
                                            <option>{{trans('app.tenders.choose_activity')}}</option>
                                            @foreach(\App\Activity::all() as $activtiy)
                                                <option value="{{$activtiy->name}}" {{old('activity_id',Request::get('activity_id'))==$activtiy->id?' selected ':''}}>{{$activtiy->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="focus-border"><i></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <label class="col-xs-12 col-md-3">{{trans('app.tenders.places')}}</label>
                                <div class="col-xs-12 col-md-9 new-f-group">
                                    <div class="form-group clearfix">

                                        <select name="place_id" class="effect-9 form-control">
                                            <option value>{{trans('app.tenders.choose_place')}}</option>
                                            @foreach(\App\Place::all() as $place)
                                                <option value="{{$place->name}}" {{old('place_id',Request::get('place_id'))==$place->id?' selected ':''}}>{{($place->name)}}</option>
                                            @endforeach
                                        </select><span class="focus-border"><i></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <label class="col-xs-12 col-md-3">{{trans('app.tenders.org')}}</label>
                                <div class="col-xs-12 col-md-9 new-f-group">
                                    <div class="form-group clearfix">
                                        <select name="org_id" class="effect-9 form-control">
                                            <option value>{{trans('app.tenders.choose_org')}}</option>
                                            @foreach(\App\Org::all() as $org)
                                                <option value="{{$org->name}}" {{old('org_id',Request::get('org_id'))==$org->id?' selected ':''}}>{{$org->name}}</option>
                                            @endforeach
                                        </select>
                                        <span class="focus-border"><i></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group-lg clearfix">
                                <label>
                                    {{  trans('app.tenders.expired_at')}}
                                    <input type="checkbox" value="1"
                                           {{Request::get('show_expired')==1?'checked':''}} name="show_expired">
                                </label>
                            </div>

                            <div class="form-group-lg clearfix">
                                <label class="col-xs-12 col-md-12">{{trans('app.tenders.cb_downloaded_price')}} </label>
                                <div class="col-xs-12 col-md-12">
                                    <div class="range">
                                        <input class="range-example" type="text" min="1"
                                               max="50000"
                                               value="{{Request::get('cb_downloaded_price')}}"
                                               name="cb_downloaded_price"
                                               step="500">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <label class="col-xs-12 col-md-12"> {{trans('app.tenders.offers_expired')}} </label>
                                <div class="col-xs-12 col-md-12">
                                    <div class="form-group clearfix">
                                        <div class="input-append date" id="dp3" data-date="{{date('m-d-Y')}}"
                                             autocomplete="false"
                                             data-date-format="dd-mm-yyyy">
                                            <input class="effect-9 form-control" placeholder="mm/dd/yyyy"
                                                   type="text" name="receive_date"
                                                   value="{{old('receive_date',Request::get('receive_date'))}}">
                                            <span class="add-on"><i class="fa  fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group-lg text-center">
                                <button type="submit"
                                        class="uperc padding-md fbutcenter"> {{trans('app.search')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8 content">

                @if(count($tenders) == 0)
                                    <h2>{{trans('app.tenders.tenders')}}</h2>

                    <p>{{trans('app.tenders.not_found')}}</p>
                @endif
                
                @if(count($tenders)>0 )
                    <h2>{{trans('app.tenders.tenders')}}</h2>
                    @foreach($tenders as $tender)
                    @if( $tender->remaining_days(date('d-m-Y', strtotime( $tender->receive_date))) > 0   ) 
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="card-img"><a href="">
                                     <img src="{{ $tender->org->image }}"
                                     alt="{{ $tender->org->name }}"></a>
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="title">
                                            <a href="tenders/{{ $tender->id }}" title="">
                                                <h2>{{$tender->name}} </h2>
                                            </a>
                                            
                                            <p style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 500px;">
                                                {{$tender->goal}}
                                               {{  $tender->remaining_days(date('d-m-Y', strtotime( $tender->receive_date))) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-share">
                                    <a class="share" data-title="{{ $tender->name}}" data-desc="{{$tender->receive_date}}"
                                       data-link="" href="{{ route('tenders.show' , $tender->id) }}"><i
                                                class="fa fa-share-alt"></i></a>
                                </div>
                            </div>
                            <div class="card-date clearfix">
                                <div class="item one_thrd">
                                    <p>{{  trans('app.tenders.files_opened_at')}}</p>
                                    <p><i class="fa  fa-calendar"></i>
                                        <span class="text-grey"> {{  date('d-m-Y', strtotime($tender->open_date)) }} </span><br><br>
                                        <b class="text-grey"> {{   $tender->hijri(date('d-m-Y', strtotime( $tender->open_date)))->format('d-m-Y') }} </b>
                                    </p>
                                </div>
                                <div class="item one_thrd">
                                    <p>{{trans('app.tenders.last_get_offer_at')}}</p>
                                    <p><i class="fa  fa-calendar"></i> <span
                                                class="text-grey">{{ date('d-m-Y', strtotime( $tender->receive_date)) }}</span><br><br>
                                        <b class="text-grey">{{  $tender->hijri(date('d-m-Y', strtotime( $tender->receive_date)))->format('d-m-Y') }}</b>
                                    </p>
                                </div>
                                
                                <div class="item one_thrd">
                                    <p>{{trans('app.tenders.created')}}</p>
                                    <p><i class="fa  fa-calendar"></i>
                                        <span class="text-grey">{{   date('d-m-Y', strtotime( $tender->publish_date)) }}</span><br><br>
                                    <b class="text-grey">{{ $tender->hijri(date('d-m-Y', strtotime( $tender->publish_date)))->format('d-m-Y') }}</b>

                                    </p>

                                </div>

                            </div>
@if($tender->remaining_days(date('d-m-Y', strtotime( $tender->receive_date)))<100)
                                <div class="card-cont row">
                                    <div class="col-md-4 padt">{{trans('app.tenders.remaining_hours')}}</div>
                                    <div class="col-md-8">
                                         <div class="progress">
                                        <div class="progress-bar" role="progressbar"
                                     
                                             aria-valuenow=   "{{  $tender->remaining_days(date('d-m-Y', strtotime($tender->receive_date))) }}"
                                             aria-valuemin="0"
                                             aria-valuemax="100">
                                    <span class="popOver" data-toggle="tooltip" data-placement="top"
                                          title=" {{  $tender->remaining_days(date('d-m-Y', strtotime($tender->receive_date))) }} {{trans('app.day')}}"> </span>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            @endif
                            <div class="card-price clearfix">
                                <div class="priceshadow one_thrd"> {{trans('app.tenders.cb')}}<br> <span
                                            class="text-blue"><p>{{$tender->real_value}} {{trans('app.$')}} </p></span>
                                </div>
                                <div class="priceshadow one_thrd" style="background-color:#315d90
;"> {{trans('app.tenders.cb_downloaded_price')}}

                                    
                                    @if($tender->download_value!=0)
                                        <span class="text-red">
                                            <p style="color:#ffffff;">{{ $tender->download_value}} {{trans('app.$')}}</p> </span>
                                    @else
                                        <span class="text-blue"><p style="color:#ffffff;">{{trans('app.free')}}</p></span>
                                    @endif
                                </div>
                                <div class="light-white one_thrd">{{trans('app.tenders.id')}} <br><span
                                            class="text-blue">{{$tender->tnumber}}</span>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                @endif
                <div class="text-center">
{{  $tenders->links()  }}
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')

    <script>
        $(function () {
            $('.select2').select2({
                placeholder: "{{trans('app.services.choose_services')}}",
            });
            $('#accept-terms').change(function (e) {
                var $base = $('#can-buy');
                if ($base.length && e.target.checked) {
                    $base.removeAttr('disabled')
                } else {
                    $base.attr('disabled', true)
                }
            });
        });</script>
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip({trigger: 'manual'}).tooltip('show');
            $(".progress-bar").each(function () {
               each_bar_width = $(this).attr('aria-valuenow');
               $(this).width(each_bar_width + '%');
            });
            var date = new Date();
            // date.setDate(date.getDate());

            $('#dp3',).datepicker({
                minDate: date,
            });
            $('#date',).datepicker({
                minDate: date,
            });
            $(".range-example").asRange({
                range: true,
                limit: false,
                //tip: {
//    active: 'onMove'
//    },
                tip: true,
                min: 100,
                value: true,
                keyboard: true,
                replaceFirst: true, // false, 'inherit', {'inherit': 'default'}
                scale: true,
                format(value) {
                    return value;
                }
            });
            $(".share").hideshare({
                link: "",           // Link to URL defaults to document.URL
                title: "",          // Title for social post defaults to document.title
                media: "",          // Link to image file defaults to null
                facebook: true,     // Turns on Facebook sharing
                twitter: true,      // Turns on Twitter sharing
                pinterest: false,    // Turns on Pinterest sharing
                googleplus: false,   // Turns on Google Plus sharing
                linkedin: false,     // Turns on LinkedIn sharing
                position: "right", // Options: Top, Bottom, Left, Right
                speed: 150           // Speed of transition
            });

            if (screen.width >= 991) {
                var cardClass='.content .card';
                var listCardClass='.content';
                $('#filter-search > div').width($('#filter-search').width());
                $(window).scroll(function (e) {
                    var $list = $(listCardClass);
                    var $filterSearch = $('#filter-search');
                    if ($list.length == 0 || $(cardClass).last().length == 0) {
                        return;
                    }
                    if (($(this).scrollTop() + 70) > $list.offset().top) {
                        if (!$filterSearch.hasClass('static-filter')) {
                            $filterSearch.addClass('static-filter')
                        }
                        if ((($(this).scrollTop()+$(cardClass).last().height()) >= $(cardClass).last().offset().top+10)) {
                            $('.static-filter > div').css({
                                'position': 'absolute',
                                'top': $(cardClass).last().offset().top - ($('.static-filter > div').height()-28 ) + 'px'
                            })
                        } else {
                            $('.static-filter > div').css({
                                'position': 'fixed',
                                'top': '62px'
                            })
                        }
                    } else {
                        $('.static-filter > div').css({
                            'position': 'inherit',
                            'top': 'unset'
                        })
                        if ($filterSearch.hasClass('static-filter')) {
                            $filterSearch.removeClass('static-filter')
                        }
                    }

                });
            }

        });
    </script>


    <script src="{{asset('/js/select2.min.js')}}" defer></script>
    <link href="{{asset('')}}/css/select2.min.css" rel="stylesheet">
    <style>
        .select2 {
            width: 100%;
        }
    </style>

    <script>
        $(function () {
            $('.select2').select2({
                placeholder: "{{trans('app.services.choose_services')}}",
            });
            $('#accept-terms').change(function (e) {
                var $base = $('#can-buy');
                if ($base.length && e.target.checked) {
                    $base.removeAttr('disabled')
                } else {
                    $base.attr('disabled', true)
                }
            });
        });</script>
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"></script>
    <script>

        $(document).ready(function () {
            UnoDropZone.init();
        });
        var lat = "{{ @Request::old('lat',30)  }}";
        var lng = "{{ @Request::old('lng',31)   }}";
        var map = L.map('map').setView(L.latLng(lat, lng), 13);

        var marker = L.marker(L.latLng(lat, lng)).addTo(map);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        navigator.geolocation.getCurrentPosition(function (location) {
            var latlng = new L.LatLng(location.coords.latitude, location.coords.longitude);
            if (marker) {
                map.removeLayer(marker);
            }
            marker = L.marker(latlng).addTo(map);
            $("input[name='lat']").val(latlng.lat);
            $("input[name='lng']").val(latlng.lng)
            map.setView(latlng);
            $.get('https://nominatim.openstreetmap.org/reverse?accept-language={{app()->getLocale()}}&format=jsonv2&lat=' + latlng.lat + '&lon=' + latlng.lng, function (data) {
                $("input[name='address']").val(data.display_name);
            });
        });
        map.on('click',
            function (e) {
                $("input[name='lat']").val(e.latlng.lat);
                $("input[name='lng']").val(e.latlng.lng);
                $.get('https://nominatim.openstreetmap.org/reverse?accept-language={{app()->getLocale()}}&format=jsonv2&lat=' + e.latlng.lat + '&lon=' + e.latlng.lng, function (data) {
                    $("input[name='address']").val(data.display_name);
                });
                if (marker) {
                    map.removeLayer(marker);
                }
                marker = L.marker(e.latlng).addTo(map);
            });
    </script>
@endpush

