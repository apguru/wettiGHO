@extends('main')

@section('title', 'Bestenliste')

@section('content')
  <br>
  <div class="row">
  	<div class="col-md-12">
  		<table class="table">
  			<thead>
  				<th>Benutzername</th>
  				<th>Gewonnen</th>
  				<th>davon 5 Punkte</th>
  				<th>davon 3 Punkte</th>
  				<th>davon 2 Punkte</th>
  				<th>Verloren</th>
  				<th>Rate</th>
  				<th>Kontostand</th>
  			</thead>
  			<tbody>
  				@foreach($data as $dataElement)
  					<tr>
						<td>{{ $dataElement->bName }}</td>
						<td>{{ ($dataElement->Pkt5) + ($dataElement->Pkt3) + ($dataElement->Pkt2) }}</td>
						<td>{{ $dataElement->Pkt5 }}</td>
						<td>{{ $dataElement->Pkt3 }}</td>
						<td>{{ $dataElement->Pkt2 }}</td>
						<td>{{ $dataElement->Loose }}</td>
						<td>{{ (($dataElement->Pkt5) + ($dataElement->Pkt3) + ($dataElement->Pkt2)) / $dataElement->Loose }}</td>
						<td>{{ $dataElement->Kontostand }}</td>
					</tr>
  				@endforeach
  			</tbody>
   		</table>
   		<div class="text-center">
        	{!! $data->links() !!}
      	</div>
  	</div>
  </div>
@endsection