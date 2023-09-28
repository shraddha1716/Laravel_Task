<!DOCTYPE html>
<html>
<head>
    <title>Dynamic Rows</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</head>
<body>

@if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
 @endif

 
 @if(session('delete_msg'))
<div class="alert alert-danger">
    {{ session('delete_msg') }}
</div>
@endif


@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

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
                <div class="row pt-5">
                    <div class="col-lg-8"></div>
                    <div class="col-lg-4">
                        <button type="button" class="btn btn-info" id="add-row">Add Row</button>
                    </div>
                </div>
                <form method="POST" action="{{ route('store-data') }}" >
                    @csrf
                        <div class="form-group" id="dynamic-form">
                            <div class="row">
                                <div class="col-lg-8">
                                    <label for="name">Name:</label>
                                    <input type="text" name="name[]" class="form-control" id="name">
                                </div>
                                <div class="col-lg-4">
                                    <button type="button" class="remove-row btn btn-danger m-4 p-2">Remove</button>
                                </div>  
                            </div>
                        </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
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

            <!-- Add more table headers for your data -->
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal{{ $item->id }}">
                        Edit
                </button>
                
                <form action="{{ route('delete-data', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>

        <div class="modal fade" id="editModal{{ $item->id }}">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Data</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('update-data', $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <!-- Input fields for editing data -->
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ $item->name }}">
                            </div>
                            <!-- Add more input fields here as needed -->
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @endforeach
    </tbody>
</table>
</div>


<script>
        $(document).ready(function () {
            // Add row
            $("#add-row").on("click", function () {
                $("#dynamic-form").append('<div class="row">'+
                                '<div class="col-lg-8">'+
                                    '<label for="name">Name:</label>'+
                                    '<input type="text" name="name[]" class="form-control" id="name">'+
                                '</div>'+
                                '<div class="col-lg-4">'+
                                    '<button type="button" class="remove-row btn btn-danger m-4 p-2">Remove</button>'+
                                '</div>'+  
                            '</div>');
              
            });

            // Remove row
            $("#dynamic-form").on("click", ".remove-row", function () {
                 $(this).closest('.row').remove();
            });
        });
    </script>

</body>
</html>
