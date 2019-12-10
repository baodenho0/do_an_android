<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        img{
            width: 100%;
        }
        iframe{
        	width: 100%;
        }
        .logo-small{
        	width: auto;
        }
        .width-80{
        	width: 80%;
        }
        body{
        	margin-bottom: 10em;
        }
    </style>
</head>

<body   @isset($dark) style="background: {{$dark['background']}};color: {{$dark['color']}}" @endisset>
    <div>
        {!!$news->content!!}
    </div>
    <div>
    	<select name="rating" id="rating">
    		<option > -Rating- </option>
    		<option {{$rating == "1" ? "selected" : ""}} value="1">1 star</option>
    		<option {{$rating == "2" ? "selected" : ""}} value="2">2 star</option>
    		<option {{$rating == "3" ? "selected" : ""}} value="3">3 star</option>
    		<option {{$rating == "4" ? "selected" : ""}} value="4">4 star</option>
    		<option {{$rating == "5" ? "selected" : ""}} value="5">5 star</option>
    	</select>
    	<label id="message-rating"></label>
    </div>
    <br>
    <div >
        <form action="" method="post" id="form-comment">
            <input class="width-80" type="text" name="content" placeholder="comment...">
            <input type="submit" value="Post">
        </form>
    </div>
    <div id="list-comment">
       {{--  <p>
            <b>hieu</b> sdfsdfsdf
        </p>
        <p>
            <b>hieu</b> sdfsdfsdf
        </p>
        <p>
            <b>hieu</b> sdfsdfsdf
        </p>
        <p>
            <b>hieu</b> sdfsdfsdf
        </p> --}}
    </div>
    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
    <script>

    function loadComment(newsId, token) {
        $.ajax({
            url: "{{ route('getCommentByNewsId') }}",
            method: "get",
            dataType: "json",
            data: {
                newsId,
                token: token,
            },
            success: function(data) {
                if (data.status) {
                    var html = "";


                    for (var i = 0; i < data.data.length; i++) {

                        html += "<div class=\"form-group-flex\">" +
                            "<div class=\"comment-content\">" +
                            "<p><b>" + data.data[i].name + "</b> </p>" +
                            data.data[i].content +
                            "</div>";
                    }
                    $("#list-comment").html(html);
                }
            }
        });

    }

    function saveComment(formData) {
        var result = null;
        $.ajax({
            url: "{{ route('saveComment') }}",
            async: false,
            method: "post",
            dataType: "json",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.status) {
                    result = 1;
                }
            }
        });
        return result;

    }

    function updateRating(token, rating, newsId){
    	$.ajax({
            url: "{{ route('updateRating') }}",
            method: "post",
            dataType: "json",
            data: {
                rating,
                newsId,
                token: token,
                __token:"{{csrf_token()}}"
            },
            success: function(data) {
                if (data.status) {
                    var html = "updated successfully";
                    
                    $("#message-rating").html(html);
                }
            }
        });
    }

    $(document).ready(function() {
    	var newsId = "{{$newsId}}";
        var token = "{{$token}}";


    	loadComment(newsId, token);

        $("#form-comment").on("submit", function(e) {
            e.preventDefault();
            var form = $(this)[0];
            var formData = new FormData(form);
            formData.append("token", token);
            formData.append("newsId", newsId);
            var checkSave = saveComment(formData);
            if (checkSave == 1) {
                loadComment(newsId, token);
            }
            $(this)[0].reset();
        });

        $("#rating").on("change",function(){
        	var rate = $(this).find("option:selected").val();
        	// console.log(rate);
        	updateRating(token, rate, newsId);
        });


    });

    </script>
</body>

</html>
