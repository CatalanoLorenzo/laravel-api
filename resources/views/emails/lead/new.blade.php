<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New lead</title>
</head>
<body>
    <h1>prova email</h1>
    <p>bla bla bla nuovo messaggio bla bla bla </p>
    <p>
        nome:{{$lead->name}} <br>
        Email:{{$lead->email}} <br>
    </p>
    <p>
        {{$lead->message}}
    </p>
</body>
</html>