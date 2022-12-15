<!DOCTYPE html>
<html>
<head>
    <title>Create Blog</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
        <h2>Create New Blog In Our Blogger</h2>
             {{-- begin of form --}}
             <form action="" id="offerForm"  method="POST">
                @csrf

                <div class="form-group">
                    <label for="">Image</label>
                    <input type="text" class="form-control" id="image" name="image"  placeholder="url for image">
                </div>
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" class="form-control" id="title" name="title"  placeholder="Title of Blog">
                </div>
                <div class="form-group">
                    <label for="">Content</label>
                    <input type="text" class="form-control" id="content" name="content"  placeholder="Content of Blog">
                </div>
                <div class="form-group">
                    <label for="">Publish Date</label>
                    <input type="date" class="form-control" id="publish-date" name="publish-date"  placeholder="Publish Date">
                </div>

                <div class="alert alert-success" style="display: none"></div>
                <button id="back" class="btn btn-dark">Back</button>
                <button id="ajaxSubmit" class="btn btn-primary">Create Blog</button>
            </form>
             {{--end of form --}}

    </div>
    </div>
    </div>
</div>

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous">
    {{-- jQuery cdn --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    {{-- <script src="//code.jquery.com/jquery-1.11.0.min.js"></script> --}}
    <script src="{{ asset('js/anees.js') }}"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
            jQuery('#back').click(function(e){
               e.preventDefault();

               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               jQuery.ajax({
                    type: 'get',
                    url: "{{ route('blog.listing') }}",

                    });
               });
            });



</script>
</html>
