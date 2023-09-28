<!DOCTYPE html>
<html>
<head>
    <title>Blog PDF</title>
    <!-- Include CSS styles for PDF layout here -->
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            margin: 20px;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Blog Details</h1>
        <table>
            <tr>
                <th>Title:</th>
                <td>{{ $blog->title }}</td>
            </tr>
            <tr>
                <th>Description:</th>
                <td>{{ $blog->description }}</td>
            </tr>
            <tr>
            @php
                    $date=$blog->created_at;
                    $formattedDate = $date->format('d F Y');
             @endphp
                <th>Date:</th>
                <td>{{ $formattedDate }}</td>
            </tr>
            <!-- <tr>
                <th>Image:</th>
                <td><img src="{{ asset('storage/' . $blog->image_path) }}"  alt="Blog Image"></td>
            </tr> -->
        </table>
    </div>
</body>
</html>
