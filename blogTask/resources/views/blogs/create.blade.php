<html>

<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">

        <br><h3 class="text-center text-info text-primary m-3">Create Blog</h3><br><br>
    <form method="POST" action="{{ route('blogs.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="row">
        <div class="col-lg-3">
            </div>
            <div class="col-lg-3">
            <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
            </div>
           
            <div class="col-lg-3">
            <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">

            </div>
            <div class="col-lg-6">
            <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
            </div>
        </div>
        <div class="text-center">

        <button type="submit" class="btn btn-primary">Create Blog</button>

        </div>
        
        
        
    </form>
</div>
</body>

</html>