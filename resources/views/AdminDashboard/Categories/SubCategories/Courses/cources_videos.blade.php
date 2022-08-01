
@foreach ($courses as $course)

<iframe width="560" height="315" src="{{str_replace('watch?v=', 'embed/', $course->source)}}" frameborder="0" allowfullscreen></iframe>

@endforeach