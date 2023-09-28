<!DOCTYPE html>
<html>
<head>
    <title>Dynamic Rows</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>



</head>
<body>

<div class="message m-3">

</div>

<button type="button" class="btn btn-primary m-3" data-toggle="modal" data-target="#myModal">
    Open Modal
</button>

<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Data</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form>
                    @csrf
                    <!-- Input fields for your data -->
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" class="form-control" id="name">
                    </div>
                    <!-- Add more input fields here as needed -->
                    <button type="button"  id="add_data" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container">
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="t_body">
        @php
        $id=0;
        @endphp
        <div class="modal fade" id="editModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Data</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                            <div class="form-group">
                                <label>Name:</label>
                                <input type="text" name="name" class="form-control" id="edit_name">
                            </div>
                            <button type="button" class="btn btn-primary"  id="update_data">Update</button>
                    </div>
                </div>
            </div>
        </div>

    </tbody>
</table>
</div>

<script>
            $('#add_data').click(function() {
                var name = $('#name').val();
                $.ajax({
                    url: 'store-data-ajax', 
                    type: 'POST',
                    data: {
                        name: name,
                        _token: '{{ csrf_token() }}'
                        },
                    dataType:'json',
                    success: function(response)
                     {
                        var dataLength = response.data.length;
                        $('#name').val('');
                        $('#myModal').modal('hide');

                        $('.message').html('<div class="alert alert-success">' + response.message + '</div>');
                        var data =response.data;
                        var numberOfRows = $('#t_body').find('tr').length;
                        numberOfRows++;
                        $('#t_body').append('<tr data-id="'+data.id+'"><td>' +numberOfRows + '</td><td>' +data.name + '</td><td><button class="btn btn-info edit_data" data-row="' + numberOfRows + '" data-id="' + data.id + '">Edit</button><button class="btn btn-danger m-3 delete_data" data-id="'+data.id+'">Delete</button></td></tr>');
                        
                    }
                 });
            });
 

            $(document).on('click', '.edit_data', function() {
            var id = $(this).data('id');
            var id_row = $(this).data('row');

            
                $.ajax({
                    url: '/get-data-ajax/' + id, // Replace with the appropriate URL on your server
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.message) {
                            var data = response.data;
                            $('#edit_name').val(data.name);
                            $('#update_data').data('id',id);
                            $('#update_data').data('row',id_row);
                            $('#editModal').modal('show'); 
                        } else {
                            alert('Failed to fetch data for editing.');
                        }
                    }
                });
            });    

            $('#update_data').click(function() {
                var name = $('#edit_name').val();
                var id = $(this).data('id');
                var id_row = $(this).data('row');

                $.ajax({
                    url: '/update-data-ajax/' + id, 
                    type: 'PUT',
                    data: {
                        name: name,
                        _token: '{{ csrf_token() }}'
                        },
                    dataType:'json',
                    success: function(response)
                     {
                        $('#name').val('');
                        $('#editModal').modal('hide');
                        $('.message').html('<div class="alert alert-success">' + response.message + '</div>');
                        var data =response.data;
                        var numberOfRows = $('#t_body').find('tr').length;
                        numberOfRows++;
                        var updatedRow = '<tr data-id="'+data.id+'"><td>' +id_row + '</td><td>' +data.name + '</td><td><button class="btn btn-info edit_data" data-id="' + data.id + '">Edit</button><button class="btn btn-danger m-3 delete_data" data-id="'+data.id+'">Delete</button></td></tr>';
                        $('#t_body tr[data-id="'+id+'"]').replaceWith(updatedRow);
                        $('#update_data').removeAttr('data-id');

                    }
                 });
            });    

        $(document).on('click', '.delete_data', function() {
            var id = $(this).data('id');
            var row = $(this).closest('tr'); 
            if (confirm('Are you sure you want to delete this product?')) {
                $.ajax({
                    url: '/delete-data-ajax/' + id, 
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    }, 
                    success: function(response) {
                        row.remove(); 
                        $('.message').html('<div class="alert alert-danger">' + response.message + '</div>');
                    }
                }); 
            }
        });
</script>   

</body>
</html>
