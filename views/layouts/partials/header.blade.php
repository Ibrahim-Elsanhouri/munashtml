<!--Begin:navbar-->
<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><img src="{{asset('/assets')}}/images/logo.jpg"
                                                                              alt="{{trans('app.name')}}"></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="navbar-form navbar-left nav navbar-nav menu">
        <!--         <li><a href="/"> {{  trans('app.home')}}<span class="sr-only">(current)</span></a></li> -->
                <li>
                    <a href="/aboutus"> {{trans('app.about_website')}}</a>
                </li>
                <li>
                    <a href="/policy">{{trans('app.terms_conditions')}}</a>
                </li>
                <li><a href="/contact">{{trans('app.contact_us')}}</a></li>
         <li><a href="/posts">المدونة</a></li>                
            </ul>

            <ul class="nav navbar-nav navbar-right">
                   

                           @if(!CRUDBooster::myId())
 <ul class="nav navbar-nav navbar-right">

                                 <li>
                      <a href="/login">      <button class="fbutcenter" type="button"
                                    onclick="location.href = '';">تسجيل دخول</button>
                        </a></li>
                      
                        </ul>
                    </li>
            </ul>
@else
<nav>
 
 <ul class="nav navbar-nav navbar-right">

                                 <li>
                      <a href="/admin" target="_blank" class="fbutcenter"  >    
                     <!-- <button class="fbutcenter" type="button"
                                    onclick="location.href = '';">     </button> -->   
                                 لوحة التحكم
                                        <br/>
                            {{  CRUDBooster::myName() }}
                             
                                    @if(CRUDBooster::myNoty() > 0 ) 
                                     {{ CRUDBooster::myNoty() }}   
                               @endif
                                 
                        </a>
                        
                        </li>
                      
                        </ul>
                    </li>
                    <form id="logout-form" action="" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
            </ul>
      </li>
  
</nav>
            @endif
        </div>
    </div>
</nav>

<header>
    <div class="header">
        <div class="container">
            <ul class="nav nav-pills nav-justified tab">
                <li class="{{\Request::route()->getName()=="index"?'active':''}}"><a
                            href="/">{{trans('app.government_tenders')}}</a>
                </li>
                <li class="{{\Request::route()->getName()=="centers"?'active':''}}"><a
                            href="/centers">{{trans('app.service_centers')}}</a></li>
                <li class="{{\Request::route()->getName()=="chances"?'active':''}}"><a
                            href="/chances">{{trans('app.investment_opportunities')}}</a></li>
            </ul>
        </div>
    </div>
</header>
