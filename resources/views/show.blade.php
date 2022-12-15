@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>Blog Details</h2></div>



                </div>
            </div>
        </div>
    </div>
</div>
{{-- show all cards --}}
<div class="container" style="margin-top: 15px">
    <div class="row">

             {{--  --}}

             <div class="col-md-4">
                <div class="card" style="width: 18rem; margin:10px">
                    <img class="card-img-top" src="..." alt="Card image cap">
                    <input type="text" hidden id="blog_id" value="{{$blog->id}}">
                    <div class="card-body">
                    <h5 class="card-title">{{$blog->title}}</h5>
                    <p class="card-text">{{$blog->content}}</p>
                    <a href="{{route('home')}}" class="btn btn-primary view">Back</a>

                    </div>
                </div>
                </div>

    {{--  --}}

    </div>
</div>

@endsection
<script src="../../public/js/anees.js"></script>


