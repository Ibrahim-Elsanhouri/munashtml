@extends('layouts.master')

@section('title',trans('app.centers.centers'))
@section('content')
    <section class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="side-box">
                    <h2>{{trans('app.centers.search_centers')}}</h2>
                    <div class="feildcont">
                        <form  method="get" action="/centerss">
                            <div class="form-group clearfix">
                                <div class="search-bar">
                                    <div class="icon-addon">
                                        @if($q)
                                            <input name="name" type="text"
                                                   placeholder="{{trans('app.centers.search_query')}}..."
                                                   class="form-control" value="{{$q}}">
                                        @else
                                            <input name="name" type="text"
                                                   placeholder="{{trans('app.centers.search_query')}}..."
                                                   class="form-control">
                                        @endif
                                        <div class="searh-icn" rel="tooltip"><i class="fa fa-search"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xs-12 col-md-3"> {{trans('app.sectors.sector')}}</label>
                                <div class="col-xs-12 col-md-9 new-f-group">
                                    <div class="form-group clearfix">
                                        <select type="text" class="effect-9 form-control" name="sector_id">
                                        
                                      
                                            <option value="">{{  trans('app.sectors.choose_sector')}}</option>
                                            @foreach ($sectors  as $sector )
                                        <option value="{{ $sector->id }}">{{ $sector->name }}</option>

                                            @endforeach
                                 {{-- 
                                 
                                 @foreach($sectors as $sector)
                                                @if($sector_id == $sector->id)
                                                    <option value="{{$sector->id}}"
                                                            selected="selected">{{$sector->name}}</option>
                                                @else
                                                    <option value="{{$sector->id}}">{{$sector->name}}</option>
                                                @endif
                                            @endforeach
                                 
                                 
                                  --}}           
                                        </select>
                                        <span class="focus-border"><i></i></span>
                                    </div>
                                </div>
                            </div>
                     
                            <div class="form-group text-center">
                                <button type="submit"
                                        class="uperc padding-md fbutcenter"> {{trans('app.search')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8 content">
                @if(count($centers)==0)
                    <p class="col-md-12 not-found">{{trans('app.centers.not_found')}}</p>
                @else
            <a  href="center/create" style="margin:10px;" class="fbutcenter">اضافة مركز اعمال</a>
                      <a  href="/admin/rfqs45/add?return_url=http%3A%2F%2Fmunagasatcomdev.live%2Fadmin%2Frfqs45&parent_id=&parent_field=" target="_blank"  style="margin:10px;"  class="fbutcenter">طلب تسعيرة من مورد</a>
            <br> <br>
                    <h2>{{trans('app.centers.centers')}}</h2>
                @endif
            
         
                @foreach($centers as $center)
                    <div class="card row markaz">
                        <div class="col-md-9">
                            <div class="item clearfix">
                                <div class="one_small title-small">{{trans('app.centers.center_name')}}</div>
                                <div class="one_larg">
                                    <a href="/centers/{{$center[id]}}"> {{  $center[name]}}</a>
                                  {{-- 
                                  @if($center->can_edit && !$center->approved)
                                        <a href="{{route('centers.update', ['id' => $center->company_id, 'center_id' => $center->id])}}"><button class="btn btn-primary small"><i class="fa fa-edit"></i></button></a>
                                    @endif
                                  
                                  
                                   --}}  
                                </div>

                            </div>
                            <div class="item clearfix">
                                <div class="one_small title-small"> رقم التواصل </div>
                                <div class="one_larg">
0{{  $center[mobile]}}
                                </div>
                            </div>
                             <div class="item clearfix">
                                <div class="one_small title-small"> العنوان  </div>
                                <div class="one_larg">
{{  $center[address]}}

                                </div>
                            </div>
                       
                        </div>
                        <div class="col-md-3">
                            <div class="card-img"><a href="{{$center->path}}">
                                    <img src="/uploads/{{ $center[image] }}"
                                         alt="{{$center[name] }}">
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
     
                <!---->
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            $(function () {
                {{--$('#search').on('submit', function (e) {--}}
                {{--e.preventDefault();--}}
                {{--var search_q = $('[name="search_q"]').val();--}}
                {{--var service_id = $('[name="service_id"]').val();--}}
                {{--var sector_id = $('[name="sector_id"]').val();--}}
                {{--var url = "{{route("centers")}}" + "?";--}}
                {{--url += search_q == !search_q || search_q.length === 0 ||--}}
                {{--search_q === "" || !/[^\s]/.test(search_q) ||--}}
                {{--/^\s*$/.test(search_q) || search_q.replace(/\s/g, "") === "" ? "" : "q=" + search_q + "&";--}}
                {{--url += sector_id == 0 ? "" : "sector_id=" + sector_id + "&";--}}
                {{--url += service_id == 0 ? "" : "service_id=" + service_id;--}}

                {{--if (url != "{{route('centers')}}" + "?")--}}
                {{--window.location.href = url;--}}

                {{--})--}}
            });
            $(".example").asRange({
                range: true,
                limit: false,
                // tip: {
                //    active: 'onMove'
                //    },
                namespace: 'asRange',
                max: 10000,
                min: 100,
                value: true,
                step: 10,
                direction: 'h', // 'v' or 'h'
                keyboard: true,
                replaceFirst: true, // false, 'inherit', {'inherit': 'default'}
                scale: true,
                format(value) {
                    return value;
                }
            });
            $(document).ready(function () {
                $('[data-toggle="popover"]').popover({trigger: "hover | focus", html: "true"});
            });
        </script>
    @endpush
@endsection
