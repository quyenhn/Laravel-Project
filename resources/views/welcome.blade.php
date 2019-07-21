<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<div class="container">
		
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.1/socket.io.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript">
	var socket = io('http://localhost:3000');
	socket.on('message', function(data){
		console.log('--------mess-------',data);
		$('.container').append(data+'<br>');
	});
</script>
</body>
</html>