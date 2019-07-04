@foreach ($articles as $a)
<div class="col-sm-10">
	<h2><strong>{{$a->title}}</strong></h2>
	<img  src="/storage/images/{{ $a->image }}" style="display: block;width: 100%;height: auto;"/>
	<small>Updated at: {{$a->updated_at}}, Author: {{$a->user->name}}</small>
	<p style="margin-bottom: 0px;"> {{$a->description}} </p>

	@foreach($a->comment->sortByDesc('updated_at')->take(2) as $cm)
	<hr>
	<img src="/storage/avatars/{{ $cm->user->avatar }}" style="width:auto;height:20px;" alt="avatar" />
	<small>{{$cm->user->name}}</small>
	<small> ({{$cm->updated_at}}) wrote:</small>
	<div style="margin-left:23px;"><?php echo $cm->content ?></div>
	@endforeach
	<hr>
	<div style="font-size: 20px;">
		<a href="{{route('article.show',$a->id)}}" style="text-decoration: underline;">Read more</a>
		&nbsp;
		<a href="{{route('article.show',$a->id)}}"  style="text-decoration: underline;">{{count($a->comment)}} comments</a>
	</div>
</div>
@endforeach