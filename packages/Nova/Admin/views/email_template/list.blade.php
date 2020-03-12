@section('title')
	The list of email template
@stop

@section('breadcrumb')
	<li>
		<a href="{{ URL::current() }}">
			List email template
		</a>
	</li>
@stop

@section('content')
	<div class="row">
		<div class="col-lg-12">
				<section class="panel m-t-small">
					<header class="panel-heading header-box">
						<i class="icon-bell"></i>
						List of email template
						
						<div class="pull-right">
							<a class="btn btn-primary btn-small" href="{{ URL::route('admin.addEmailTemplate', array('id'=>0)) }}">
								New Email Template
							</a>
						</div>
						
					</header>
					<div class="pull-out">
						<div class="">
								<table class="table table-hover table-striped m-b-none text-small">
									<thead>
										<tr>
											<th>ID</th>
											<th>Slug</th>
											<th>Price</th>
											<th width="280">Subject</th>
											<th width="320">Description</th>
											<th>Created at</th>
											<th>Updated at</th>
											<th width="170">Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($list_template as $temp) 
										<tr>
											<td>{{$temp->id}}</td>
											<td>{{$temp->slug}}</td>
											<td>${{number_format($temp->price/100)}}</td>
											<td>{{$temp->subject}}</td>
											<td>{{$temp->description}}</td>
											<td>{{!empty($temp->created_at) ? date("M d, Y H:i",strtotime($temp->created_at)) : "" }}</td>
											<td>{{!empty($temp->updated_at) ? date("M d, Y H:i",strtotime($temp->updated_at)) : "" }}</td>
											<td>
												<a target="_blank" href="{{ URL::route('admin.viewEmail',array('id'=>$temp->id)) }}">
													View
												</a>
												&nbsp;|&nbsp;

												<a href="{{ URL::route('admin.addEmailTemplate',array('id'=>$temp->id)) }}">
													Update
												</a>
												&nbsp;|&nbsp;
												
												<a href="{{ URL::route('admin.delEmailTemplate', ['tem_id' => $temp->id ]) }}" class="confirm-danger">
							        				Delete
							    				</a>
												
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
								<div style="text-align: center;">{{ $list_template->links() }} <span style="float: right;margin-top: 10px;margin-right: 20px;">Total: {{ $list_template->total() }}</span></div>
						</div>
					</div>
				</section>
		</div>
	</div>
@stop