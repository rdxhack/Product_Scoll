<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        /* Style for column */
        .col {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 10px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }

        /* Style for post */
        .post {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
        }

        /* Style for post title */
        .post-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        /* Style for post content */
        .post-content {
            font-size: 14px;
        }
    </style>
    <!-- jQuery via Google Hosted Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
</head>

<body>
   
   
    <div class="container text-center " style="margin-top:20px; ">
        <div class="row">
            @foreach($posts as $post)
            <div class="col-6">
                <div class="post">
                    <a href="{{ route('post.details', ['id' => $post['id']]) }}" style="text-decoration: none;">
                        <div class="post-title" style="color: black; font-size :20px;">{{$post['title']}}</div>
                        <div class="post-content" style="color: grey; font-size :15px;">
                            {{$post['body']}}
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="loader" style="display: none;">Loading...</div>
    </div>



    <script>
        let page = 1;
        let isLoading = false;

        // Function to check if user has scrolled to the bottom of the page
        function isBottom() {
            return $(window).scrollTop() + $(window).height() >= $(document).height();
        }

        // Function to load more posts
        function loadMorePosts() {
            if (isLoading || !isBottom()) {
                return;
            }

            isLoading = true;
            $('.loader').show();

            $.ajax({
                url: '{{ route("index.list") }}?page=' + (page + 1), 
                method: 'GET',
                success: function(response) {
                    $('.loader').hide();
                    isLoading = false;
                    page++;
                    $('.row').append(response);
                },
                error: function() {
                    $('.loader').hide();
                    isLoading = false;
                    console.error('Error loading more posts.');
                }
            });
        }
        $(window).scroll(function() {
            if (isBottom()) {
                loadMorePosts();
            }
        });
        $(document).ready(function() {
            loadMorePosts();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>