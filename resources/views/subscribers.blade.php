<!DOCTYPE html>
<html>
<head>
    <title>Laravel Ajax CRUD Tutorial Example - Subscribers List</title>
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
    <h1>Laravel Ajax CRUD Tutorial Example - Subscribers List</h1>
    <a class="btn btn-success" style="margin-bottom: 10px" href="javascript:void(0)" id="createNewSubscriber"> Create New Subscriber</a>
    <table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>name</th>
                <th>username</th>
                <th>email</th>
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
                <form id="subscriberForm" name="subscriberForm" class="form-horizontal">
                   <input type="hidden" name="subscriber_id" id="subscriber_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group email">
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-12">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="" maxlength="90" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-12">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" value="" maxlength="50" required="">
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
        ajax: "{{ route('sub.index') }}",
        columns: [

            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'username', name: 'username'},
            {data: 'email', name: 'email'},
            {data: 'password', name: 'password'},
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
    $('#createNewSubscriber').click(function () {
        $('#saveBtn').val("create-Subscriber");
        $('#subscriber_id').val('');
        $('#subscriberForm').trigger("reset");
        $('#modelHeading').html("Create New Subscriber");
        $('#ajaxModel').modal('show');
    });
/*------------------------------------------
    --------------------------------------------
    Click to Edit Button
    --------------------------------------------
    --------------------------------------------*/
    $('body').on('click', '.editSubscriber', function () {
      var subscriber_id = $(this).data('id');
      $.get("{{ route('sub.index') }}" +'/' + subscriber_id +'/edit', function (data) {
          $('#modelHeading').html("Edit Subscriber");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#subscriber_id').val(data.id);
          $('#name').val(data.name);
          $('#username').val(data.username);
          $('#email').val(data.email);
          $('.email').hide();
          $('#password').val(data.password);
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
          data: $('#subscriberForm').serialize(),
          url: "{{ route('sub.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {

              $('#subscriberForm').trigger("reset");
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
    $('body').on('click', '.deleteSubscriber', function () {

        var subscriber_id = $(this).data("id");
        confirm("Are You sure want to delete !");

        $.ajax({
            type: "DELETE",
            url: "{{ route('sub.store') }}"+'/'+subscriber_id,
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
