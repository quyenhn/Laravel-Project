@foreach ($articles as $a)
<div class="col-sm-10">
	<div class="date">
		<p><span class='day'>{{$a->created_at->format('d')}}</span>
		   <span>{{$a->created_at->format('M')}} / {{$a->created_at->year}}</span></p> 
	</div>
	<h2 style="font-family: Arvo, Cambria, Georgia, Times, serif; font-size: 1.8em;">
		<a href="{{route('article.show',$a->id)}}">{{$a->title}}</a>
	</h2>
	<img  src="/storage/images/{{ $a->image }}" style="display: block;width: 100%;height: auto;"/>
	<small>Updated at: {{$a->updated_at}}, Author: {{$a->user->name}}, {{$a->comments->count()}} comments</small>
	<p style="margin-bottom: 0px;"> {{$a->description}} </p>
	
	@foreach($a->latestComments as $cm)
	<hr>
	<img src="/storage/avatars/{{ $cm->user->avatar }}" style="width:20px;height:20px;" alt="avatar" />
	<small>{{$cm->user->name}}</small>
	<small> ({{$cm->updated_at}}) wrote:</small>
	<div style="margin-left:23px;"><?php echo $cm->content ?></div>
	@endforeach 
	<hr>
	<!-- <div style="font-size: 20px;"> -->
		<a class="btn btn-info" href="{{route('article.show',$a->id)}}">Read more</a>
		<!-- &nbsp;
		<a href="{{route('article.show',$a->id)}}"  style="text-decoration: underline;">{{count($a->comments)}} comments</a> -->
	<!-- </div> -->
</div>
@endforeach