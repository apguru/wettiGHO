@extends('main')

@section('title','Spiel erstellen')

@section('stylesheets')
  {{ Html::style('css/bootstrap-datetimepicker.min.css') }}
@endsection

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<h1>Spiel erstellen</h1>

			<form action="{{ route('spiele.store')  }}" method="POST" class="form-horizontal" role="form">
				{{ csrf_field() }}
				<div class="form-group">
					<label for="heim">Heim</label>
					<input type="text" name="heim"  id="heim" class="form-control" placeholder="Heim">
				</div>
				<div class="form-group">
					<label for="gast">Gast</label>
					<input type="text" name="gast" id="gast" class="form-control" placeholder="Gast">
				</div>
				<div class="form-group">
					<label for="spielTag" class="col-md-2 control-label">Spieltag</label>
          <div name='spielTag' class="input-group date form_datetime col-md-5" data-date="1979-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="spielTag">
          	<input name="spielTag" class="form-control" size="16" type="text" value="" readonly>
            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
						<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
          </div>
					<input type="hidden" name='spielTag' id="spielTag" value="" /><br/>
        </div>
        <button type="submit" class="btn btn-success">Erstellen</button>
			</form>	
		</div>
	</div>
@endsection

@section('scripts')
{{ Html::script('js/bootstrap-datetimepicker.js') }}
<script type="text/javascript">
	$('.form_datetime').datetimepicker({
		weekStart: 1,
    todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
    showMeridian: 1
  });
</script>
@endsection