@foreach ($articles as $a)
<div class="col-sm-10">
	<div class="date">
		<p><span class='day'>{{$a->created_at->day}}</span>{{$a->created_at->month}} / {{$a->created_at->year}}</p> 
	</div>

	<h2 style="font-family: Arvo, Cambria, Georgia, Times, serif; font-size: 1.8em;">
		<a style="color:#000;" href="{{route('article.show',$a->id)}}">{{$a->title}}</a>
	</h2>
	<img  src="/storage/images/{{ $a->image }}" style="display: block;width: 100%;height: auto;"/>
	<small>Updated at: {{$a->updated_at}}, Author: {{$a->user->name}}</small>
	<p style="margin-bottom: 0px;"> {{$a->description}} </p>
	
	@foreach($a->latestComments as $cm)
	<hr>
	<img src="/storage/avatars/{{ $cm->user->avatar }}" style="width:20px;height:20px;" alt="avatar" />
	<small>{{$cm->user->name}}</small>
	<small> ({{$cm->updated_at}}) wrote:</small>
	<div style="margin-left:23px;"><?php echo $cm->content ?></div>
	@endforeach 
	<hr>
	<div style="font-size: 20px;">
		<a href="{{route('article.show',$a->id)}}" style="text-decoration: underline;">Read more</a>
		&nbsp;
		<a href="{{route('article.show',$a->id)}}"  style="text-decoration: underline;">{{count($a->comments)}} comments</a>
	</div>
</div>
@endforeach
