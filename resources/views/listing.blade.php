<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8|7 Datatables Tutorial</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Laravel 8 Yajra Datatables Example</h2>
    <a class="btn btn-success" href="javascript:void(0)" id="createNewBlog"> Create New Blog</a>
    {{-- <a id="create-blog" href="{{route('blog.create')}}" class="btn btn-primary" style="margin-bottom: 10px">Create New Blog</a> --}}
    {{-- <button id="create-blog"  class="btn btn-primary" style="margin-bottom: 10px">Create New Blog</button> --}}
    <table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>id</th>
                <th>image</th>
                <th>title</th>
                <th>publish date</th>
                <th>status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
{{-- another thing --}}
{{-- <div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="productForm" name="productForm" class="form-horizontal">
                   <input type="hidden" name="product_id" id="product_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Details</label>
                        <div class="col-sm-12">
                            <textarea id="detail" name="detail" required="" placeholder="Enter Details" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>


<script type="text/javascript">

  $(function () {
    /*------------------------------------------
     --------------------------------------------
     Pass Header Token
     --------------------------------------------
     --------------------------------------------*/
     $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    /*------------------------------------------
    --------------------------------------------
    Render DataTable
    --------------------------------------------
    --------------------------------------------*/

    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('blog.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'image', name: 'image'},
            {data: 'title', name: 'title'},
            {data: 'publish_date', name: 'publish_date'},
            {data: 'status', name: 'status'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ]
    });
///////////////////
/*------------------------------------------
    --------------------------------------------
    Click to Button
    --------------------------------------------
    --------------------------------------------*/
    // $('#createNewProduct').click(function () {
    //     $('#saveBtn').val("create-product");
    //     $('#product_id').val('');
    //     $('#productForm').trigger("reset");
    //     $('#modelHeading').html("Create New Product");
    //     $('#ajaxModel').modal('show');
    // });

    /*------------------------------------------
    --------------------------------------------
    Click to Edit Button
    --------------------------------------------
    --------------------------------------------*/
    // $('body').on('click', '.editProduct', function () {
    //   var product_id = $(this).data('id');
    //   $.get("{{ route('products-ajax-crud.index') }}" +'/' + product_id +'/edit', function (data) {
    //       $('#modelHeading').html("Edit Product");
    //       $('#saveBtn').val("edit-user");
    //       $('#ajaxModel').modal('show');
    //       $('#product_id').val(data.id);
    //       $('#name').val(data.name);
    //       $('#detail').val(data.detail);
    //   })
    // });

    /*------------------------------------------
    --------------------------------------------
    Create Product Code
    --------------------------------------------
    --------------------------------------------*/
    // $('#saveBtn').click(function (e) {
    //     e.preventDefault();
    //     $(this).html('Sending..');

    //     $.ajax({
    //       data: $('#productForm').serialize(),
    //       url: "{{ route('products-ajax-crud.store') }}",
    //       type: "POST",
    //       dataType: 'json',
    //       success: function (data) {

    //           $('#productForm').trigger("reset");
    //           $('#ajaxModel').modal('hide');
    //           table.draw();

    //       },
    //       error: function (data) {
    //           console.log('Error:', data);
    //           $('#saveBtn').html('Save Changes');
    //       }
    //   });
    // });

    /*------------------------------------------
    --------------------------------------------
    Delete Product Code
    --------------------------------------------
    --------------------------------------------*/
    // $('body').on('click', '.deleteProduct', function () {

    //     var product_id = $(this).data("id");
    //     confirm("Are You sure want to delete !");

    //     $.ajax({
    //         type: "DELETE",
    //         url: "{{ route('products-ajax-crud.store') }}"+'/'+product_id,
    //         success: function (data) {
    //             table.draw();
    //         },
    //         error: function (data) {
    //             console.log('Error:', data);
    //         }
    //     });
    // });

//////////////
  });

</script>
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous">
</html>
