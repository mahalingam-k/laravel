<html>
<body style="font-family:calibri;font-size:10;">
<h1>Hi, {{ $firstname }}!</h1>
 
<p>We'd like to inform you that following are the new documents added for the search term:<b> {{ $searchterm }} </b></p>

<div>
        <table border="1">

            <thead>
            <tr>
				<th>Document ID</th>
				<th>Citation</th>	
			</tr>
            </thead>

            <tbody>
            
            @foreach ($docs as $index => $doc) 
            <tr>
                
				<td><a href="{{ $url }}/document/{{$index}}">{{ $index }}</a></td>
				<td>{{ $doc }}</td>
            </tr>
            @endforeach 
           
            </tbody>

        </table>
		
		To unsubscribe <a href = "{{ $url}}/unsetalerts/{{ $unsubscribeid }}">click here</a>
    </div>
</body>
</html>