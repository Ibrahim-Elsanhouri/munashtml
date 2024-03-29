@extends('layouts.master')
@section('content')
<style>



.glyphicon { margin-right:5px; }
.thumbnail
{
    margin-bottom: 20px;
    padding: 0px;
    -webkit-border-radius: 0px;
    -moz-border-radius: 0px;
    border-radius: 0px;
}

.item.list-group-item
{
    float: none;
    width: 100%;
    background-color: #fff;
    margin-bottom: 10px;
}
.item.list-group-item:nth-of-type(odd):hover,.item.list-group-item:hover
{
    background: #428bca;
}

.item.list-group-item .list-group-image
{
    margin-right: 10px;
}
.item.list-group-item .thumbnail
{
    margin-bottom: 0px;
}
.item.list-group-item .caption
{
    padding: 9px 9px 0px 9px;
}
.item.list-group-item:nth-of-type(odd)
{
    background: #eeeeee;
}

.item.list-group-item:before, .item.list-group-item:after
{
    display: table;
    content: " ";
}

.item.list-group-item img
{
    float: left;
}
.item.list-group-item:after
{
    clear: both;
}
.list-group-item-text
{
    margin: 0 0 11px;
}





</style>
<div class="container">

    

    <div id="products" class="row list-group">
   @foreach ($subs as $s )
        <div class="item  col-xs-4 col-lg-4">
            
 
            <div class="thumbnail">
                <img class="group list-group-image" src="http://placehold.it/400x250/000/fff" alt="" />

                <div class="caption">
                    <h4 class="group inner list-group-item-heading">
{{ $s->type }}
 </h4>
                    <p class="group inner list-group-item-text">
                       {{ str_limit($s->note) }}
                       </p>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <p class="lead">
{{ $s->price_after }}
</p>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <a class="btn btn-primary" href="{{ route('subs.show' , $s->id) }}">  تفاصيل اكثر   </a>
                        </div>
                    </div>
                </div>
                
    

            </div>
   
        </div>
    
       @endforeach
   

     
    </div>

</div>








  
       
@endsection
