<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div>
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form role="form" method="POST" action="{{ route('csv-upload.upload') }}" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="file">File</label>
            <input type="file" name="file" id="file">
        </div>

        <button type="submit">Submit</button>
    </form>
</div>
</body>
</html>
