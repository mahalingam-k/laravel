@if($pagination)
<div id="pagin">
<ul style="margin:0px;  font-family:calibri;font-weight:large;">
@foreach($pagination as $index => $page)
	
    @if($page['label'] != '&laquo;' && $page['label'] != '&raquo;')
	<li{{ $page['cssClass'] != '' ? ' class="' . $page['cssClass'] . '"' : '' }}><a style="color:white;font-size:larze;font-weight:bold;" href="{{ $page['link'] }}">{{ $page['label'] }}</a></li>
	@elseif($page['label'] == '&laquo;')
		@if($page['cssClass'] == 'disabled')
		<li{{ $page['cssClass'] != '' ? ' class="' . $page['cssClass'] . '"' : '' }}><a style="color:#D1D0CE;font-size:larze;font-weight:bold;" href="#">previous page</a> &middot;</li>
		@else
		<li{{ $page['cssClass'] != '' ? ' class="' . $page['cssClass'] . '"' : '' }}><a style="color:white;font-size:larze;font-weight:bold;" href="{{ $page['link'] }}">previous page</a> &middot;</li>
		@endif
	@else
		@if($page['cssClass'] == 'disabled')
		<li{{ $page['cssClass'] != '' ? ' class="' . $page['cssClass'] . '"' : '' }}>&middot; <a style="color:#D1D0CE;font-size:larze;font-weight:bold;" href="#">next page</a></li>
		@else
		<li{{ $page['cssClass'] != '' ? ' class="' . $page['cssClass'] . '"' : '' }}>&middot; <a style="color:white;font-size:larze;font-weight:bold;" href="{{ $page['link'] }}">next page</a></li>
		@endif
	@endif
@endforeach
</ul>
</div>
@endif