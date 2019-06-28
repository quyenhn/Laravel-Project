<table border="1px solid black">
	<th>id</th>
	<th>nguoi theo doi</th>
	<th>dang theo doi</th>
	<tr>
        <td>{{$user->id}}</td>
        
		<td>@foreach($followers as $er) {{$er->name}} @endforeach</td>
		
		
		<td>@foreach($followings as $ing) {{$ing->name}} @endforeach</td>
		
	</tr>
</table>