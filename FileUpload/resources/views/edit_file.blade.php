<!DOCTYPE html>
<html>
<head>
    <title>Edit Image</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Edit Image</h1>
        <form action="{{ route('update.image', $fileModel->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="image_name">Image Name:</label>
                <input type="text" class="form-control" id="image_name" name="image_name" value="{{ $fileModel->name }}">
            </div>
            <div class="form-group">
            <img src="{{ asset('storage/' . $fileModel->path) }}" alt="Uploaded Image">
                <label for="image">Image:</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</body>
</html>
