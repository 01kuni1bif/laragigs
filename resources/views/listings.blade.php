<h1> {{$heading}} </h1>

@unless(count($listings)==0)

@foreach($listings as $listing)
<h2>
    <a href="/listing/{{$listing['id']}}">
        {{$listing['title']}}

    </a>
    {{$listing['title']}}
</h2>
<p>
    {{$listing['discription']}}
</p>
@endforeach

@else
<p>No listings found</p>

@endunless