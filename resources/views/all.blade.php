<!DOCTYPE html>
<html>
<head>
    <title>Laravel Ajax CRUD Tutorial Example - It</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>

<div class="container">
    <h1>Laravel Ajax CRUD Tutorial Example - It</h1>
    <a class="btn btn-success" style="margin-bottom: 10px" href="javascript:void(0)" id="createNewBlog"> Create New Blog</a>
    <table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>image</th>
                <th>title</th>
                <th>content</th>
                <th>publish date</th>
                <th>status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="blogForm" name="blogForm" class="form-horizontal">
                   <input type="hidden" name="blog_id" id="blog_id">
                    <div class="form-group">
                        <label for="image" class="col-sm-2 control-label">Image</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="image" name="image" placeholder="Enter Url for Image" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Content</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="content" name="content" placeholder="Enter Content" value="" maxlength="90" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Publish Date</label>
                        <div class="col-sm-12">
                            <input type="date" class="form-control" id="publish_date" name="publish_date" placeholder="Enter Publish Date" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="status" name="status" placeholder="Enter Status" value="" maxlength="50" required="">
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
</div>

</body>

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
            {data: 'content', name: 'content'},
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
/*------------------------------------------
    --------------------------------------------
    Click to Button
    --------------------------------------------
    --------------------------------------------*/
    $('#createNewBlog').click(function () {
        $('#saveBtn').val("create-Blog");
        $('#Blog_id').val('');
        $('#blogForm').trigger("reset");
        $('#modelHeading').html("Create New Blog");
        $('#ajaxModel').modal('show');
    });
/*------------------------------------------
    --------------------------------------------
    Click to Edit Button
    --------------------------------------------
    --------------------------------------------*/
    $('body').on('click', '.editBlog', function () {
      var blog_id = $(this).data('id');
      $.get("{{ route('blog.index') }}" +'/' + blog_id +'/edit', function (data) {
          $('#modelHeading').html("Edit Blog");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#blog_id').val(data.id);
          $('#image').val(data.image);
          $('#title').val(data.title);
          $('#content').val(data.content);
          $('#publish-date').val(data.publish_date);
          $('#status').val(data.status);
      })
    });
/*------------------------------------------
    --------------------------------------------
    Create Blog Code
    --------------------------------------------
    --------------------------------------------*/
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');

        $.ajax({
          data: $('#blogForm').serialize(),
          url: "{{ route('blog.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {

              $('#blogForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();

          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
    });
    /*------------------------------------------
    --------------------------------------------
    Delete Product Code
    --------------------------------------------
    --------------------------------------------*/
    $('body').on('click', '.deleteBlog', function () {

        var blog_id = $(this).data("id");
        confirm("Are You sure want to delete !");

        $.ajax({
            type: "DELETE",
            url: "{{ route('blog.store') }}"+'/'+blog_id,
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
  });
</script>
</html>
