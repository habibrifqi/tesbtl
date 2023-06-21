<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>poke</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>base_experience</th>
                <th>weight</th>
                <th>start_count</th>
                <th>image_url</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($poke as $pok)
                <tr>
                    <td>{{ $pok->name }}</td>
                    <td>{{ $pok->base_experience }}</td>
                    <td>{{ $pok->weight }}</td>
                    <td><img src="{{ $pok->image_url }}" alt="" srcset=""></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
</body>
</html>