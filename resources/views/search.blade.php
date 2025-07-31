<form method="GET" action="{{ route('search') }}">
    <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}" required>
    <button type="submit">Search</button>
</form>

@if(request('search'))
    @if($results->isNotEmpty())
        <h2>Top Matches:</h2>
        <ul>
            @foreach($results as $result)
                <li>{{ $result['category']->name }} (Score: {{ number_format($result['score'], 2) }})</li>
            @endforeach
        </ul>
    @else
        <p>No results found for "<strong>{{ request('search') }}</strong>".</p>
    @endif
@endif
