<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .post-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
            align-items: center;
            justify-items: center;
        }

        .post-content {
            font-size: 16px;
            line-height: 1.6;
            color: #666;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$post['title']}}</title>
</head>

<body>


    <div class="container">
        <h1 class="post-title">{{$post['title']}}</h1>
        <p class="post-content">{{$post['body']}}</p>
        <!-- You can add more details here such as author, date, etc. -->
    </div>
    <div class="container">
        <h2>Comment Section</h2>
        @foreach($paginatedcomment as $comments)
        <hr>
        <div class="row">
            <div class="col-3 post-title">Email:-</div>
            <div class="col-3">{{$comments['email']}}</div>
        </div>
        <div class="row">
            <div class="col-3 post-title">Name :-</div>
            <div class="col-3">{{$comments['email']}}</div>
        </div>
        <div class="row">
            <div class="col-3 post-title" >Comment Body :-</div>
            <div class="col-3">{{$comments['body']}}</div>
        </div>
        <hr>
        @endforeach
        <!-- You can add more details here such as author, date, etc. -->
    </div>




    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>

</html>