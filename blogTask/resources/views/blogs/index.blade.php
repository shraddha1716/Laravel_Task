<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <!DOCTYPE html>
    <html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            * {
                box-sizing: border-box;
            }

            body {
                font-family: Arial;
                padding: 20px;
                background: #f1f1f1;
            }

            .header {
                padding: 30px;
                font-size: 40px;
                text-align: center;
                background: white;
            }

            .leftcolumn {
                float: left;
                width: 75%;
            }

            .rightcolumn {
                float: left;
                width: 25%;
                padding-left: 20px;
            }

            .fakeimg {
                background-color: #d0e4eb;
                width: 100%;
                padding: 20px;
            }

            .card {
                background-color: white;
                padding: 20px;
                margin-top: 20px;
            }

            .row:after {
                content: "";
                display: table;
                clear: both;
            }

            .footer {
                padding: 20px;
                text-align: center;
                background: #ddd;
                margin-top: 20px;
            }


            @media screen and (max-width: 800px) {

                .leftcolumn,
                .rightcolumn {
                    width: 100%;
                    padding: 0;
                }
            }

            button a {
                text-decoration: none;
                color: inherit;
                background: none;
                border: none;
                padding: 0;
            }
        </style>
    </head>

    <body>
@php
$blogarray= $blogs;
@endphp
        <div class="header">
            <div class="row">
                <div class="col-lg-11">
                </div>
                <div class="col-lg-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger ml-2">Logout</button>
                    </form>
                </div>

            </div>
            @if(session('success'))
            <div style="padding:10px;font-size:17px" class="alert alert-success p-3">
                {{ session('success') }}
            </div>
            @endif
            <h2>Blog</h2>
            <div class="d-flex btn-group">
                <button class="btn btn-warning"><a href="{{ route('blogs.create') }}" class="btn btn-secondary"><b>Create Blog</b></a></button>
                <button class="btn btn-primary"><a href="{{ route('blogs.pdf') }}" class="btn btn-secondary">Download PDF</a></button>
            </div>
        </div>
        <div class="row">
            @foreach($blogs as $blog)
            <div class="col-lg-4">
                <div class="card">
                    <h2 class="text-success">{{ $blog->title }}</h2>
                    @php
                    $date=$blog->created_at;
                    $formattedDate = $date->format('d F Y');
                    @endphp
                    <h5 class="text-info">{{ $formattedDate }}</h5>
                    <div class="fakeimg" style="height: 200px; width: 435px; overflow: hidden;">
                        <img src="{{ asset('storage/' . $blog->image_path) }}"  alt="Blog Image" style="max-width: 100%; max-height: 100%; object-fit: cover;">
                    </div>
                    <p class="justify-content-center">{{ $blog->description }}.</p>
                    <div>
                        <form method="POST" action="{{ route('blogs.destroy', $blog->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form><span>
                            <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-primary">Edit</a></span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </body>
    </html>