@foreach ($articles as $a)
<div class="col-sm-12">
	<div class="date">
		<p><span class='day'>{{$a->created_at->format('d')}}</span>
		   <span>{{$a->created_at->format('M')}} / {{$a->created_at->year}}</span></p> 
	</div>
	<h2 style="font-family: Arvo, Cambria, Georgia, Times, serif; font-size: 1.8em;">
		<a href="{{route('article.show',$a->id)}}">{{$a->title}}</a>
	</h2>
	<img  src="/storage/images/{{ $a->image }}" style="display: block;width: 100%;height: auto;"/>
	<small>
		<i class="fas fa-user"></i> Written by: {{$a->user->name}}  | 
		<!-- <i class="fas fa-folder-open"></i> Category: {{$a->category}} | -->
		<i class="fas fa-calendar-alt"></i> Updated at: {{$a->updated_at}} |
		<i class="fas fa-comments"></i> {{$a->comments->count()}} comments |
		<i class="fas fa-eye"></i> {{$a->view}} views
	</small>
	<p style="margin-bottom: 0px;border-top: 1px dashed #b1b1b1;"> {{$a->description}} </p>
	
	@foreach($a->latestComments as $cm)
	<hr>
	<img src="/storage/avatars/{{ $cm->user->avatar }}" style="width:20px;height:20px;" alt="avatar" />
	<small>{{$cm->user->name}}</small>
	<small> ({{$cm->updated_at}}) wrote:</small>
	<div style="margin-left:23px;"><?php echo $cm->content ?></div>
	@endforeach 
	<hr>
	<!-- <div style="font-size: 20px;"> -->
		<a class="btn btn-info" href="{{route('article.show',$a->id)}}">read more... <i style="vertical-align: middle;" class="fas fa-chevron-right"></i></a>
		<!-- &nbsp;
		<a href="{{route('article.show',$a->id)}}"  style="text-decoration: underline;">{{count($a->comments)}} comments</a> -->
	<!-- </div> -->
</div>
@endforeach