@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                </div>
            </div>
        </div>
    </div>
</div>
{{-- show all cards --}}
<div class="container" style="margin-top: 15px">
    <div class="row">

             {{--  --}}
             @foreach ($blogs as $blog)
             <div class="col-md-4">
                <div class="card" style="width: 18rem; margin:10px">
                    <img class="card-img-top" src="..." alt="Card image cap">
                    <input type="text" hidden id="blog_id" value="{{$blog->id}}">
                    <div class="card-body">
                    <h5 class="card-title">{{$blog->title}}</h5>
                    <p class="card-text">{{$blog->content}}</p>
                    <a href="{{route('blog.show',$blog->id)}}" class="btn btn-primary view">View Details</a>
                    {{-- <button  class="btn btn-primary view">View Details</button> --}}
                    </div>
                </div>
                </div>
            @endforeach
    {{--  --}}

    </div>
</div>

@endsection
<script src="../../public/js/anees.js"></script>
<script>
    $(function(){
        $('.btn').click(function () {
            alert{'here we are '}
        })
    })


</script>

