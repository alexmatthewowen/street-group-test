<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Street Group Tech Test</title>
    </head>
    <body class="antialiased">

    <form method="POST" action="{{ route('submit-home-owner-data') }}" enctype="multipart/form-data">
        @csrf
        <input type="file" name="home_owner_data">
        <button type="submit">Submit</button>


        @if($errors->any())
            <br><h5>Errors:</h5>

            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach

        @endif

    </form>
    </body>
</html>
