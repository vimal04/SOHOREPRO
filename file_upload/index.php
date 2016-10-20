<!doctype html>
<head>
    <title>File Upload Progress Demo #1</title>
    <style>
        body { padding: 30px }
        form { display: block; margin: 20px auto; background: #eee; border-radius: 10px; padding: 15px }

        .progress { position:relative; width:400px; border: 1px solid #ddd; padding: 1px; border-radius: 3px; }
        .bar { background-color: #F99B3E; width:0%; height:20px; border-radius: 3px; }
        .percent { position:absolute; display:inline-block; top:3px; left:48%; }
    </style>
</head>
<body>    
    <form action="new_upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="uploadedfile"><br>
        <input type="submit" value="Upload File to Server">
    </form>

    <div class="progress">
        <div class="bar"></div >
        <div class="percent">0%</div >
    </div>

    <div id="status"></div>

    <script src="jquery.js"></script>
    <script src="jquery.form.js"></script>
    <script>
        (function() {

            var bar = $('.bar');
            var percent = $('.percent');
            var status = $('#status');

            $('form').ajaxForm({
                beforeSend: function() {
                    status.empty();
                    var percentVal = '0%';
                    bar.width(percentVal)
                    percent.html(percentVal);
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    var percentVal = percentComplete + '%';
                    bar.width(percentVal)
                    percent.html(percentVal);
                },
                complete: function(xhr) {
                    bar.width("100%");
                    percent.html("100%");
                    status.html(xhr.responseText);
                }
            });

        })();
    </script>

</body>
</html>