<!-- Title Form Input -->

<div class="form-group">
	{!! Form::label('title', 'Title') !!}
	{!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Body Form Input -->

<div class="form-group">
	{!! Form::label('body', 'Body') !!}
	{!! Form::textarea('body', null, ['class' => 'form-control']) !!}
</div>

<!-- Published_at Form Input -->
<div class="form-group">
	{!! Form::label('published_at', 'Publish On') !!}
	{!! Form::input('date','published_at', $article->published_at->format('Y-m-d'), ['class' => 'form-control']) !!}
</div>

<!-- Tags Form Input -->

<div class="form-group">
	{!! Form::label('tagList', 'Tags') !!}
	{!! Form::select('tagList[]',$tags ,null, ['id' => 'tagList','class' => 'form-control', 'multiple']) !!}
</div>

<!-- Add Article Form Input -->
<div class='form-group'>
	{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>

@section('footer')
	<script type="text/javascript">
	$('#tagList').select2({
  		tags: true
	});
	</script>
@stop