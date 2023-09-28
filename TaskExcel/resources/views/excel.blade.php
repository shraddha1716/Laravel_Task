<!DOCTYPE html>
<html>
<head>
    <title>Upload Excel File</title>
</head>
<body>

@if(session('success'))
    <div style="color: green;">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div style="color: red;">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('upload.excel') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="excel_file">Choose Excel File:</label>
    <input type="file" name="excel_file" accept=".xls,.xlsx">
    <br>
    <button type="submit">Upload</button>
</form>

</body>
</html>
