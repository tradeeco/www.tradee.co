@if ($errors->has())
<div class="alert alert-danger alert-dismissibl fade in">
    <button type="button" class="close" data-dismiss="alert">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    <ul>
    @foreach ($errors->all() as $error)
		<li>{!! $error !!}</li>
	@endforeach
	</ul>
</div>
@endif

@if (isset($alert))
<div class="alert alert-{{ $alert['type'] }} alert-dismissibl fade in">
    <button type="button" class="close" data-dismiss="alert">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    <ul>
        <li>{!! $alert['msg'] !!}</li>
    </ul>
</div>
@endif
