<table class="table">
    <thead>
        <tr>
        @foreach ($columns as $col)
            @if ($col['visible'])
            <th>{{ $col['name'] }}</th>
            @endif
        @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
            <tr>
            @foreach ($columns as $col)
                @if ($col['visible'])
                    <th>{{ $row[$col['field']] }}</th>
                @endif
            @endforeach
            </tr>
        @endforeach
    </tbody>
</table>

