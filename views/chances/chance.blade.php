@extends('layouts.master')

@section('title',trans('app.chances.chances')." | ".$chance->slug)
@section('content')
    <section class="container">
        <div class="row">
            <div class="col-md-12 content-details">
                <h2><span>{{trans('app.chances.chance_details')}}</span></h2>
                <div class="card-details">
                    <div class="details-border">
                        <div class="row">
                            @if(($chance->image || $chance->progress<100))
                                <div class="col-md-4">
                                    <div class="light-white">
                                        @if($chance->image)
                                            <div class="card-img">
                                                <img src="{{thumbnail($chance->image->path, 'single_center')}}"
                                                     alt="{{$chance->name}}">
                                            </div>
                                        @endif
                                        @if($chance->progress<100)
                                            <div class="padt">الايام المتبقية</div>
                                            <div class="progress ">
                                                <div class="progress-bar" role="progressbar"
                                                     aria-valuenow="{{  $chance->remaining_days(date('d-m-Y', strtotime($chance->close_date))) }}"
                                                     aria-valuemin="0" aria-valuemax="100" style="">
                                            <span class="popOver" data-toggle="tooltip" data-placement="top"
                                                  title="{{  $chance->remaining_days(date('d-m-Y', strtotime($chance->close_date))) }} {{trans('app.day')}}"> </span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            <div class="{{($chance->image || $chance->progress<100)?'col-md-8':'col-md-12'}} ">
                                <div class="details-item">
                                    <ul>
                                        <li class="clearfix">
                                            <div class="one_xsmall title">صاحب التسعيرة</div>
                                            <div class="one_xlarg">{{$chance->user->name}}</div>
                                        </li>
                                        <li class="clearfix">
                                            <div class="one_xsmall title">{{trans('app.chances.chance_name')}}</div>
                                            <div class="one_xlarg">{{$chance->name}}</div>
                                        </li>
                                       
                                        <li class="clearfix">
                                            <div class="one_xsmall title">{{trans('app.chances.closing_date')}}</div>
                                            <div class="one_xlarg">{{$chance->close_date}}</div>
                                        </li>
                                        <li class="clearfix">
                                            <div class="one_xsmall title">{{trans('app.chances.sectors')}}</div>
                                            <div class="one_xlarg">
                {{ $chance->sector->name }}
                                            </div>
                                        </li>
                                        {{-- <li class="clearfix">
                                             <div class="one_xsmall title">{{trans('app.chances.chance_value')}}</div>
                                             <div class="one_xlarg">{{$chance->value}}</div>
                                         </li>--}}
                                        <li class="clearfix">
                                            <div class="one_xsmall title">{{trans('app.chances.rules_book')}}</div>
                                            <div class="one_xlarg"><a class="btn btn-default" target="_blank"
                                                                      href="{{ $chance->file }}"> {{trans('app.chances.rules_book_download')}}</a>
                                            </div>
                                        </li>
                                            <li class="clearfix">
                                            <div class="one_xsmall title">عنوان الاستلام</div>
                                                    <div class="one_xlarg">
                {{ $chance->address }}
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- part 2-->
                    <div class="details-border">
                        <div class="unit-table pad">
                            <table class="table table-striped">
                                <thead>
  
                                <tr>
                                    <th scope="col">{{trans('app.sectors.sector_name')}}</th>
                                    <th scope="col">{{trans('app.units.unit')}}</th>
                                    <th scope="col"> {{trans('app.quantity')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                                              @foreach ($chance->products  as $product )
                                      <tr>
                                        <td>
{{ $product->name }}                                        </td>
                                        <td>
{{ $product->unit->name }}
                                        </td>
                                        <td>{{ $product->qty }}</td>
                                    </tr>

                                @endforeach
                                  
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="text-center">
                    <a class="uperc padding-md fbutcenter" href="/admin">التقديم للفرص و ادارتها</a>
                            
                    </div>
                </div>

            </div>
        </div>
    </section>
    <style>
        .progress {
            overflow: visible;
            height: 5px;
            margin: 40px 5px 6px;
        }
    </style>
@endsection
@push('scripts')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip({trigger: 'manual'}).tooltip('show');
        });
        $(document).ready(function () {
            $(".btn-mas").click(function () {
                $("#myModal").modal('show');
            });
        });
        $(".progress-bar").each(function () {
            each_bar_width = $(this).attr('aria-valuenow');
            $(this).width(each_bar_width + '%');
        });
        $(".range-example").asRange({
            range: true,
            limit: false,
            tip: true,
            max: 10000,
            min: 100,
            value: true,
            step: 10,
            keyboard: true,
            replaceFirst: true,
            scale: true,
            format(value) {
                return value;
            }
        });

        $(function () {
            $('#upload').on('submit', function (e) {
                e.preventDefault();
                $('#formApply').hide();
                var form = $(this);
                var file = $('[name="file"]');
                var formData = new FormData();
                formData.append('file', file[0].files[0]);
                formData.append('chance_id', "{{$chance->id}}")
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "post",
                    url: "",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if (data.success) {
                            $("#myModal").modal('hide');
                            $('#formApply').show();
                            $("#SuccessModal").modal('show');
                        } else {
                            $('.alert-danger').html(data.errors);
                            $('.alert-danger').show();
                            $('#formApply').show();
                        }
                    },
                    error: function () {
                        $('#formApply').show();
                        alert("Internal Server Error")
                    }
                })
            })
        })
    </script>

@endpush
