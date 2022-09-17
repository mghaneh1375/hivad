<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<body>

<script>

    $.ajax({
        url: 'http://localhost/contact-get_json_file?_=1663408382692',
        type: 'get',
        success: function(res) {
            s = JSON.parse(res);
            console.log(s);
        }
    })

</script>

</body>
</html>