<!DOCTYPE html>
<html>

<head>
    <title>Search Categories</title>
    <style>
        body {
            font-family: Arial;
            margin: 20px;
        }

        .result {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <h1>Search Categories</h1>

    <form method="GET" action="{{ route('search') }}">
        <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}" required>
        <button type="submit">Search</button>
    </form>

    @if (request('search'))
        @if ($results->isNotEmpty())
            <h2>Search Result:</h2>
            <ul>
                @foreach ($results as $result)
                    <li>{{ $result['category']->name }} (Score: {{ number_format($result['score'], 2) }})</li>
                @endforeach
            </ul>
        @else
            <p>No results found for "<strong>{{ request('search') }}</strong>".</p>
        @endif
    @endif
</body>

</html>
