@extends('layouts.master')
@push('head')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"/>
@endpush
@section('title',trans('app.centers.centers').' | '.$center->name)
@section('content')
    <section class="container">
        <div class="row">
            <div class="col-md-12 content-details">
                <h2><span> تفاصيل فرع مركز الاعمال</span></h2>

                  
                                     
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- 
                    
                    
                    
                    
                           <!-- part 2-->
                    <div class="details-border">
                        <div class="unit-table pad">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col" style="min-width: 100px;">{{trans('app.services.name')}}</th>
                                    <th scope="col">{{trans('app.details')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                    
                    
                    
                    
                    
                    
                     --}}
             
                          {{-- 
                          
                           @foreach($center->services as $service)
                                    <tr>
                                        <td style="    min-width: 100px;"><h3>{{$service->name}}</h3></td>
                                        <td>
                                            <p class="break">  Service Details </p>
                                        </td>
                                    </tr>
                                @endforeach
                           --}}     

{{-- 
        <tr>
                                        <td style="    min-width: 100px;"><h3> service->name</h3></td>
                                        <td>
                                            <p class="break">  Service Details </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>






 --}}
                            
                    <!-- part 3-->
                    <div class="details-border">
                        <div class="details-item">
                            <ul>
                                <li class="clearfix">
                                    <div class="one_xsmall title">الايميل الالكتروني</div>
                                    <div class="one_xlarg tel"> {{ $branch->email }}</div>
                                </li>
                                <li class="clearfix">
                                    <div class="one_xsmall title">{{trans('app.mobile_number')}}</div>
                                    <div class="one_xlarg tel">  {{ $branch->mobile }}  </div>
                                </li>
                                <li class="clearfix">
                                    <div class="one_xsmall title"> {{trans('app.address')}}</div>
                                    <div class="one_xlarg"> {{ $branch->address }} </div>
                                </li>
                                <li class="clearfix">
                                            <div class="one_xsmall title">{{trans('app.centers.name')}}</div>
                                            <div class="one_xlarg">{{$branch->name}} </div>
                                        </li>
                                           
                                        <li class="clearfix">
                                            <div class="one_xsmall title">  الشخص المسؤول </div>
                                            <div class="one_xlarg">
    {{ $branch->person }}                                     </div>
                                        </li>
                                               <li class="clearfix">
                                            <div class="one_xsmall title">الفرع الرئيسي</div>
                                            <div class="one_xlarg tab-marakz">
                                                <ul>
                                                    
                                         
                                                   
                                <li>
                            <a href="{{ route('centers.show' , $branch->center->id) }}">   {{ $branch->center->name }} </a>  
                                </li>
            
                                     
                                 

                                                   
                                                    
                                                </ul>
                        </div>
                    </div>
              
                    <!-- 
                    
                          <div class="map_container">
                        <div id="map" style="height: 500px"></div>
                    </div>
                    
                    
                    
                    part 4-->
                    
                </div>

            </div>

        </div>
    </section>
    @push('scripts')
        <style>
            .break {

                word-break: break-all;

            }
        </style>
        <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"></script>

        <script>
            $(function () {
                $('#contact').on('submit', function (e) {
                    e.preventDefault();
                    $('.form-errors').fadeOut(300).html(' ').fadeIn(300)
                    var $html=$('#submit-button').html();
                    $('#submit-button').html('<i class="fa fa-spinner fa-spin"></i>')
                    $('#submit-button').attr('disabled',true);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "post",
                        url: "",
                        data: {message: $('#your_message').val(), email: $('#email').val(), name: $('#name').val()},
                        success: function (res) {
                            $('#submit-button').removeAttr('disabled',true);
                            if (res.status) {
                                $('#contact').fadeOut();
                                $('#message_sent').fadeIn(300)
                            } else {
                                $('#submit-button').html($html);
                                $('.form-errors').html('<div class="alert alert-danger"><ul>' + res.errors.map(function (error) {
                                    return '<li>' + error + '</li>';
                                }).join('') + '</ul></div>')
                            }

                        },
                        error: function () {
                            alert("Internal server error");
                        }
                    })
                    return false;
                })
            })
            var lat = "{{$branch->lat}}";
            var lng = "{{$branch->lng}}";
            var map = L.map('map').setView(L.latLng(lat, lng), 10);
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
                    var address = '';
                    if (data.address.road) {
                        address = data.address.road + ', ';
                    }
                    address += data.address.city + ', ' + data.address.country;
                    $("input[name='location']").val(address);
                });
            });
        </script>
    @endpush
@endsection
