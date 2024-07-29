<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>pembelian</h1>

    <div class="container">
        <form action="/checkout" method="POST">
            @csrf
            <label for="">nama</label>
            <input type="text" name="name" id="">
            <label for="phone">phone</label>
            <input type="text" name="phone" id="">
            <button type="submit">Submit</button>
        </form>
    </div>
    
</body>
</html>