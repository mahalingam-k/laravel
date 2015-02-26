<html>
<body style="font-family:calibri;font-size:10;">
@if(isset($template))
{{ $template }}
@else
<h1>Hi, {{ $email }}!</h1>
 
<p>We'd like to inform you that following are the results of research trail exported by you.</p>
@endif
<div>
        <table border="1">

            <thead>
            <tr>
				<th>Date and Time</th>
				<th>Search Strings</th>	
				<th>Hits</th>	
			</tr>
            </thead>

            <tbody>
            
            @foreach ($stats as $index => $stat) 
            <tr>
				<td>{{ $stat->action_on }}</td>               
                <td>{{ $stat->content }}</td>
				<td>{{ $stat->document_count }}</td>	
            </tr>
            @endforeach 
           
            </tbody>

        </table>
    </div>
</body>
</html>