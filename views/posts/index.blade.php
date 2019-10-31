@extends('layouts.master')

@section('title')

@section('content')
    <section class="container">
        @if($posts->count() == 0)
        <div class="alert alert-primary" role="alert">
 لا توجد مقالات حاليا 
</div>
        
        
    @endif 
        @foreach($posts as $post)
        <div class="res-box">
            <div class="about">
               <a href="posts/{{ $post->id }}"><h2>{{$post->title }} </h2></a> 


<p dir="RTL">                        {{str_limit(strip_tags($post->body), 50 )  }}
                    <a class="btn btn-primary btn-xs" href="/posts/{{$post->id}}">اقرا اكثر </a>

</p>



            </div>
        </div>
       @endforeach
       <div class="container">
           
                              {{ $posts->links() }}

           
       </div>

    </section>
@endsection