@section('content')
<section class="jumbotron">
		<div class="container">
		<h1>Stundenplanung</h1>
		</div>
	</section>

	<section class="card">
		<div class="card-body">
			<h2 class="card-title">Neue Stunde planen</h2>
			<h3><input type="text" name="Titel" placeholder="Titel"></h3>
			<div class="table-responsive">
				<table class="table table-bordered pagin-table table-hover">
					<thead>
						<tr>
							<th scope="col"></th>
							<th scope="col">Makierung</th>
							<th scope="col">Asana</th>
							<th scope="col">Sanskrit</th>
							<th scope="col">Dauer</th>
							<th scope="col">Bild</th>
							<th scope="col">Info</th>
						</tr>
					</thead>
					<tbody>
						@if(count($data->entries))
						@foreach($data->entries as $k => $obj)
						<tr>
							<td><i class="fa fa-ellipsis-v"></i></td>
							<td></td>
							<td>{{ isset($obj->de_titel) ? $obj->de_titel : '' }}</td>
							<td>{{ isset($obj->sanskrit_titel) ? $obj->sanskrit_titel : '' }}</td>
							<td>15:00</td>
							<td>
								@if(isset($obj->image->path) && AppRepo::getInstance()->is_url_exist('http://yoga.nodecrew.de'.$obj->image->path))
								<img src="{{ 'http://yoga.nodecrew.de'.$obj->image->path }}" />
								@else
								-
								@endif
							</td>
							<td>
								<div class="btn-group btn-group-toggle">
									<a class="btn" href="" data-toggle="modal" data-target="#exampleModal"><i alt="Detail-Informationen" title="Detail-Informationen" class="fa fa-info-circle"></i></a>
									<a class="btn" alt="Bearbeiten" title="Bearbeiten" href=""><i class="fa fa-pencil" ></i></a>
									<a class="btn" alt="Duplizieren" title="Duplizieren" href=""><i class="fa fa-files-o"></i></a>
									<a class="btn" alt="Löschen" title="Löschen" href=""><i class="fa fa-trash-o"></i></a>
								</div>
							</td>
						</tr>
						@endforeach
						@endif

						<tr>
							<td></td>
							<td>
								<select>
									<option>Meditation</option>
									<option>Asana</option>
								</select>
							</td>
							<td><input type="text" name="Asana" placeholder="Asana autocomplete"></td>
							<td>... (Ausgabe nach Auswahl Asana)</td>
							<td>
								<select>
									<option>1:00</option>
									<option>2:00</option>
									<option>5:00</option>
									<option>10:00</option>
									<option>15:00</option>
								</select>
							</td>
							<td><img src=""></td>
							<td>
								<div class="btn-group btn-group-toggle">
									<a class="btn"href=""><i  alt="Detail-Informationen" title="Detail-Informationen" class="fa fa-check"></i> Speichern</a>
								</div>
							</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="4">Gesamt</td>
							<td>25/90</td>
						</tr>
					</tfoot>
				</table>
			</div>				
			<button class="btn" type="" name="Abspeichern">Abspeichern</button>
		</div>
	</section>

@stop

@section('javascript')
	@parent
@stop