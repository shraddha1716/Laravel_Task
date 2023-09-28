<!DOCTYPE html>
<html>
<head>
    <title>File Upload Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h2>All Images:</h2>
    @if ($files)
        <ul>
            @foreach ($files as $file)
                <li>
                    <img src="{{ asset('storage/' . $file->path) }}" alt="Uploaded Image">
                </li>
                <li>
                    <a href="{{ route('edit.image', $file->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('delete.image', $file->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @else
        <p>No images found.</p>
    @endif


    <form action="{{ route('file.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file">
        <button type="submit">Upload File</button>
    </form>
</body>
</html>
