@foreach ($articles as $a)
<div class="col-sm-10 col-sm-offset-1" >
	<h2>{{$a->title}}</h2>
	<img style="display: block;max-width: 100%;height: auto;" src="/storage/images/{{ $a->image }}"/>
	<small>Updated at: {{$a->updated_at}}, Author: {{$a->user->name}}</small>
	<p> {{$a->description}} </p>
	<div style="font-size: 20px;">
		<a href="{{route('article.show',$a->id)}}" style="text-decoration: underline;">Read more</a>
		&nbsp;
		<a href="{{route('article.show',$a->id)}}"  style="text-decoration: underline;">{{count($a->comment)}} comments</a>
	</div>
</div>
@endforeach