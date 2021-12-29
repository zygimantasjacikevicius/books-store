<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$outfit->type}}</title>
    <style>
        @font-face {
      font-family: 'Montserrat';
      src: url({{asset('fonts/Montserrat-Regular.ttf')}});
      font-weight: normal;
    }
    @font-face {
      font-family: 'Montserrat';
      src: url({{asset('fonts/Montserrat-Bold.ttf')}});
      font-weight: bold;
    }
    body {
        font-family: 'Montserrat';
    }
    </style>
</head>
<body>
    
                <span>Type:</span><div>{{$outfit->type}}</div>
            
                <span>Color:</span><div>{{$outfit->color}}</div>
            
                <span>Price:</span><div>{{$outfit->price}}</div>
            
                <span>Discount:</span><div>{{$outfit->discount}}</div>
            
</body>
</html>