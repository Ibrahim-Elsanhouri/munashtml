
@extends('layouts.master')

@section('title')

@section('content')
<div class="container">
    
        <h1>{{ $post->title }} </h1>

    <div class="row">
        <div class="col-md-12 posts">
            <div style="margin-bottom: 20px">
                <img src="/{{ $post->image }}" class="center-block" width="50%" height="200px"/>
            </div>
            {!! $post->body !!}

 

            <hr />


            
          

        </div>

        
    </div><!-- Row -->
    
</div>



@endsection