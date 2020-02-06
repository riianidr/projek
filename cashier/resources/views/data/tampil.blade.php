<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<table border="1">
		<tr>
			<td>NIM</td>
		
		</tr>
		 @foreach ($invoice as $cus)
		<tr>
            <td>{{ $cus->id }}</td>
           
		</tr>
		@endforeach
	</table>
</body>
</html>