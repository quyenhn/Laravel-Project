@foreach ($articles as $a)
<style type="text/css">
.date {
	background: url(http://2.bp.blogspot.com/-rgbMJms0Tzw/VuEzZ9P-qlI/AAAAAAAAAW0/M-Wn5H0S4jk/s000/sprite.png) bottom left no-repeat;
	float: left;
	margin-left: -100px;
	padding-bottom: 14px;
	width: 90px;
}
.date p {
	background: #eb374b;
	color: #fff;
	font-family: Arvo, Cambria, Georgia, Times, serif;
	font-size: 0.75em;
	line-height: 1.1;
	margin-bottom: 0;
	padding: 5px 10px;
	text-align: right;
	text-transform: uppercase;
}
.date {
	clear: both;
	display: block;
	font-size: 1em;
}
.date .day {
	clear: both;
	display: block;
	font-size: 1.8em;
}
</style>
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