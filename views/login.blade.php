@extends('layouts.master')

@section('title',trans('app.register'))

@section('content')
    <section class="container">
        <div class="signin row">
            <div class="signin-img">
                <i class="fa fa-5x fa-fw fa-user-circle"></i>
            </div>
            <div class="feildcont">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="post" action="{{ route('postLogin') }}" autocomplete="off">
                    {{csrf_field()}}
                    <div class="form-group-lg row">
                        <label class="col-xs-12 col-md-3">{{trans('app.fields.email')}} </label>
                        <div class="col-xs-12 col-md-9">
                            <div class="new-f-group">
                                <div class="form-group clearfix">
                                    <span class="icony"><i class="fa fa-user"></i></span>
                                    <input name="email" type="email" class="effect-9 form-control"
                                           placeholder="{{trans('app.fields.email')}}" autocomplete="off">
                                    <span class="focus-border"><i></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group-lg row">
                        <label class="col-xs-12 col-md-3">{{trans('app.fields.password')}}</label>
                        <div class="new-f-group col-xs-12 col-md-9">
                            <div class="form-group">
                                <span class="icony"><i class="fa fa-fw field-icon toggle-password fa-eye"
                                                       toggle="#password-field"></i></span>
                                <input name="password" type="password" class="effect-9 form-control" id="password-field"
                                       placeholder="{{trans('app.fields.repassword')}}" autocomplete="off">
                                <span class="focus-border"><i></i></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input type="checkbox" name="remember_me" value="1" class="form-check-input" id="remember_me">
                                    <label class="form-check-label"  style="padding: 0;" for="remember_me">{{trans('app.remember_me')}}</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-center" style="cursor: pointer">
                                    <a href="{{ route('getForgot') }}">{{trans('app.forget_password')}}</a>
                                </div>
                            </div>

                        </div>
                    </div>


                @if($errors->any())
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group-lg text-center">
                        <button type="submit" class="padding-md fbutcenter width"> {{trans('app.enter')}}</button>
                        <br>
                        <br>
                        <button type="button" onclick="window.location.href='/register'" class="padding-md fbutcenter width"> {{trans('app.register')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            $(".toggle-password").click(function () {
                $(this).toggleClass("fa-eye fa-eye-slash");
                var input = $($(this).attr("toggle"));
                if (input.attr("type") == "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
        </script>
    @endpush
@endsection

 