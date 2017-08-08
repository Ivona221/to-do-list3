<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="css/image.css">
</head>
<body>

<form method="POST" action="/avatars" enctype="multipart/form-data">
    {{csrf_field()}}

    <input type="file" name="avatar"/>

    <button type="submit">Save image</button>

</form>

</body>
</html>