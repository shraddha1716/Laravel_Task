<!DOCTYPE html>
<html>
<head>
    <title>Dynamic Rows</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container  pt-5">
        <h4 class="text-success text-center">Add and Remove Rows Dynamically</h4>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
        <div class="row pt-5">
            <div class="col-lg-8"></div>
            <div class="col-lg-2">
                <button type="button" class="btn btn-info" id="add-row">Add Row</button>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form  action="{{ route('upload.image') }}" method="POST" enctype="multipart/form-data" id="dynamic-table-form">
                    @csrf
                    <div class=" d-flex justify-content-center align-items-center">
                        <table class="tabel text-center mt-3" id="dynamic-table">
                            <thead>
                                <tr>
                                    <th>Image Name</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" class="form-control" name="image_name[]" /></td>
                                    <td><input type="file" class="form-control m-3" name="image[]" /></td>
                                    <td><button type="button" class="remove-row btn btn-danger m-3">Remove</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="d-flex justify-content-center align-items-center">
                        <button type="submit" class="btn btn-success mt-3">Save Images</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container mt-3">
        <table class="table">
            <thead>
                <tr>
                    <th>Image Name</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($images as $image)
                <tr>
                    <td>{{ $image->image_name }}</td>
                    <td>
                        <img src="data:image/jpeg;base64,{{ $image->image_data }}" alt="{{ $image->image_name }}" class="img-thumbnail" width="200" height="300">
                    </td>
                    <td>
                        <a href="{{ route('edit.image', $image->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('delete.image', $image->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                   
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function () {
            // Add row
            $("#add-row").on("click", function () {
                $("#dynamic-table tbody").append(
                    '<tr>' +
                    '<td><input type="text" class="form-control" name="image_name[]" /></td>' +
                    '<td><input type="file" class="form-control m-3" name="image[]" /></td>' +
                    '<td><button type="button" class="remove-row btn btn-danger m-3">Remove</button></td>' +
                    '</tr>'
                );
            });

            // Remove row
            $("#dynamic-table").on("click", ".remove-row", function () {
                $(this).closest("tr").remove();
            });
        });
    </script>
</body>
</html>
