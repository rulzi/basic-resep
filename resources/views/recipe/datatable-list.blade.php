<ul>
    @foreach($recipe->details as $detail)
        <li>{{ $detail->ingredient->name }} {{ $detail->amount }}</li>
    @endforeach
</ul>