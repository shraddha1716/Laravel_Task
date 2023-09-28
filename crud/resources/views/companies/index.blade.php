<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laravel 9 CRUD Tutorial Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-2">
        <div class="row">
        
            <div class="col-lg-10 margin-tb">
                <div class="pull-left">
                    <h2>Laravel 9 CRUD Example Tutorial</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('companies.create') }}"> Create Company</a>
                </div>
            </div>
        </div>
        @if ($message = session('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <form class="m-3" action="">
            <div class="row">
            <div class="col-7">
            <button class="btn btn-danger" type="button" id="delete-selected">Delete Selected</button>

            </div>
              <div class="col-3">
               <input type="text" class="form-control" name="search" value="{{ $search }}" placeholder="search...">
              </div>
              <div class="col-2">
                 <button class="btn btn-success" type="submit">Search</button>
              </div>
            </div>
        </form>
       
        <table class="table table-bordered">
            <tr>
                <th>  <input type="checkbox" id="select-all"></th>
                <th>S.No</th>
                <th>Company Name</th>
                <th>Company Email</th>
                <th>Company Address</th>
                <th width="280px">Action</th>
            </tr>

            @foreach ($companies as $company)
            <tr>
                <td><input type="checkbox" class="record-checkbox" name="ids[]" value="{{ $company->id }}"></td>
                <td>{{ $company->id }}</td>
                <td>{{ $company->name }}</td>
                <td>{{ $company->email }}</td>
                <td>{{ $company->address }}</td>
                <td>
                    <form action="{{ route('companies.destroy',$company->id) }}" method="Post">
                        <a class="btn btn-primary" href="{{ route('companies.edit',$company->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        {!!$companies->appends(['search' => $search])->links()!!}

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // jQuery to handle "Select All" functionality
    $(document).ready(function() {
        $('#select-all').change(function() {
            $('.record-checkbox').prop('checked', $(this).prop('checked'));
        });

        $('#delete-selected').click(function() {
            var selectedIds = [];
            $('.record-checkbox:checked').each(function() {
                selectedIds.push($(this).val());
            });

            if (selectedIds.length > 0) {
                // Send an AJAX request to delete selected records
                $.ajax({
                    type: 'POST',
                    url: "{{ route('companies.multiple_delete') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        ids: selectedIds
                    },
                    success: function(response) {
                        console.log(response); // Check the response in the browser's console
                        if (response.success) {
                            // Update the table or perform any other necessary actions
                            // For example, you can reload the page to reflect the changes
                            location.reload();

                            // Display a success message
                            alert('Selected records deleted successfully.');
                        } else {
                            alert('Error: Unable to delete records.');
                        }
                    },
                    error: function(error) {
                        // Handle errors (e.g., show an error message)
                        alert('Error: Unable to delete records.');
                        console.error(error);
                    }
                });
            } else {
                // No records selected, show a message or take appropriate action
                alert("Please select records to delete.");
            }
        });
    });
</script>
</body>
</html> 