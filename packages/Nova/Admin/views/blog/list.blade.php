@section('title')
	List Blog
@stop

@section('breadcrumb')
<li>
	<a href="{{ URL::route('admin.home') }}">
		List Blog
	</a>
	</li>
@stop

@section('content')
<div class="row">
<div class="col-lg-12">

	<section class="panel">
	    <header class="panel-heading header-box">
	        <i class="icon-bell"></i>
	        Search filter
	    </header>
    	<div class="pull-out">
        	<div style="margin-top: 28px;" class="form-group">
            {{ Form::open(array('route' => 'admin.blogList', 'method' => 'POST', 'id' => 'search_filter', 'class' => 'form-horizontal')) }}
            
            <div class="col-lg-2">
                <input autocomplete="off" id="date_from" name="date_from" placeholder="Date From" class="form-control" value="{{ $date_from }}" />
            
            </div>

            <div class="col-lg-2">
                <input autocomplete="off" id="date_to" name="date_to" placeholder="Date To" class="form-control" value="{{ $date_to }}" />
            </div>

            <div class="col-lg-2">
                <select name="search_by" class="form-control">
                    <option {{ ( ($search_by == "") || ($search_by === null) ) ? 'selected="selected"' : "" }} value="">Search By</option>
                    <option {{ $search_by == 1 ? 'selected="selected"' : "" }} value="1">Publish Date</option>
                    <option {{ $search_by == 2 ? 'selected="selected"' : "" }} value="2">Create Date</option>
                    <option {{ $search_by == 3 ? 'selected="selected"' : "" }} value="3">Update Date</option>
                </select>
            </div>

            <div class="col-lg-2">
                <select name="status" class="form-control">
                    <option {{ ( ($status == '') || ($status === null) ) ? 'selected="selected"' : "" }} value="">Seclect Status</option>
                    <option {{ $status == 1 ? 'selected="selected"' : "" }} value="1">Published</option>
                    <option {{ $status === "0" ? 'selected="selected"' : "" }} value="0">Unpublished</option>
                </select>
            </div>

            <div style="padding-top: 6px;" class="col-lg-2">
                <input name="submit" id="TxtSubmit" type="submit" class="btn btn-xs btn-small btn-info" value="Submit">
                
                @if($search)
                <button id="TxtReset" onClick="return resetSearchFilter()" type="button" class="btn btn-xs btn-small btn-info">Reset</button>
                @endif
            </div>
            {{ Form::close() }}
        </div>
    </div>

</section>	
			<section class="panel">
				<header class="panel-heading header-box">
					<i class="icon-bell"></i>
					Blog List
				</header>				
					<div class="pull-out">
						<table class="table table-hover table-striped m-b-none text-small">
							<thead>
								<tr>
									<th width="5">No</th>
									<th width="10">ID</th>
									<th width="90">Title</th>
									<th width="90">Intro Text</th>
									<th width="90">Author</th>
									<th width="40">Status</th>
									<th width="120">Publish at</th>
									<th width="120">Created at</th>
									<th width="120">Update at</th>
									<th style="width: 160px; text-align: center;">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i=1;?>
								<?php if(!empty($listPost)): ?>
								<?php foreach ($listPost as $k => $post): ?>
									<tr>
										<td>{{$i++}}</td>
										<td> {{ $post->id }}</td>
										<td> {{ $post->title }}</td>	
										<td> 
											<?php $intro_txt = trim(strip_tags($post->intro_txt));?>
											{{ (strlen($intro_txt) > 200) ? substr($intro_txt,0,200)."..." : $intro_txt }}
										</td>
										<td>{{user($post->user_id)->name()}}</td>
										<td style="padding-top: 14px;"> {!! $post->status == 1 ? '<a rel="'.$post->id.'" data-status="0" style="text-decoration: none;cursor: pointer;" class="statusItem btn-small btn-success">&nbsp;Public&nbsp;</a>' : '<a rel="'.$post->id.'" data-status="1" style="text-decoration: none;cursor: pointer;" class="statusItem btn-small btn-danger">UnPublic</a>' !!}</td>
										
										<td>{{ !empty($post->published_at) && ($post->published_at != "0000-00-00 00:00:00") ? date('M d, Y H:i', strtotime($post->published_at)) : "" }}</td>
										<td>{{ date('M d, Y H:i', strtotime($post->created_at)) }}</td>
										<td>{{ date('M d, Y H:i', strtotime($post->updated_at)) }}</td>

										<td width="80">
											<a class="btn btn-small btn-default" href="{{ route('admin.updateBlog',[$post->id]) }}">Edit</a>

											<a class="del_blog btn btn-small btn-default" id="del_blog_{{ $post->id }}" rel="{{ $post->id }}" href="javascript:void()" class="confirm-danger">
						        				Delete
						    				</a>
						    			</td>
									</tr>
								<?php endforeach;
									  endif;
								 ?>
							</tbody>
						</table>
						<div style="text-align: center;">{{ $listPost->links() }} <span style="float: right;margin-top: 10px;margin-right: 20px;">Total: {{ $listPost->total() }}</span></div>
					</div>
			</section>
		</div>

	</div>
@stop

@section('javascript')
@parent
<script type="text/javascript">
alertify.defaults.transition = "zoom";

function resetSearchFilter(){
    window.location.href = "{{ route('admin.blogList') }}";
}

$("#date_from").datepicker({
    dateFormat: 'dd-mm-yy',
      //showOn: "both",
      onSelect: function( selectedDate ) {hh:ii
          $("#date_to").datepicker( "option", "minDate", selectedDate);
      }
  });

  $("#date_to").datepicker({
    dateFormat: 'dd-mm-yy',
     // showOn: "both",
      onSelect: function( selectedDate ) {
          $("#date_from").datepicker( "option", "maxDate", selectedDate);
      }
  });

	$(".del_blog").click(function(){
		var rel = $(this).attr('rel');
		$.confirm({
            message: 'Are you sure you want to delete Blog ID:  '+rel+' ?',
            yes: function () {
				$.ajaxExec({
		            url: '{{ URL::route("admin.delBlogSubmited") }}',
		            data: {
		                id: rel,
		                _token: '{{ csrf_token() }}'
		            },
		            success: function (data) {
		            	//Amo.alert("Delete success.");
		            	alertify.alert('', data.msg,
		            		function(){ 
		            			location.reload();
		            	});
		            }
		        });
            }
        });
        return false;
	});

	$(".statusItem").click(function(){
		var itemId = $(this).attr("rel");
		var statusItem = $(this).attr("data-status");
		$.ajaxExec({
            url: '{{ URL::route("admin.publishBlog") }}',
            data: {
                itemId: itemId,
                statusItem: statusItem,
                _token: '{{ csrf_token() }}'
            },
            success: function (data) {
            	alertify.alert('', data.msg,
            		function(){ 
            			location.reload();
            	});
            }
        });
	});

</script>
@stop







