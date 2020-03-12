@section('javascript')
	<script type="text/javascript">
		var base_url = '{{ URL::to('/') }}/';
	</script>

	{{ Html::script('packages/jquery/js/jquery-1.7.2.min.js') }}
	{{ Html::script('packages/jquery/js/jquery-migrate-1.2.1.min.js') }}
	{{ Html::script('packages/thickbox/js/thickbox.js') }}
	{{ Html::script('packages/jquery/js/jquery.cookie.js') }}
	{{ Html::script('packages/jquery/js/jquery.blockUI.js') }}
	{{ Html::script('packages/jquery/js/jquery.common.js') }}

	<script type="text/javascript">
	     $.cookie.defaults.path = '/';
	</script>

	{{ Html::script('packages/bootstrap-2/bootstrap.min.js') }}
	{{-- Html::script('packages/bootstrap-2/bootstrap-modalmanager.js') --}}
	{{-- Html::script('packages/bootstrap-2/bootstrap-dialog/js/bootstrap-dialog.min.js') --}}

	<!-- combodate && momentjs -->
	{{ Html::script('packages/combodate/combodate.js') }}
	{{ Html::script('packages/momentjs/moment.min.1.7.2.js') }}
	{{ Html::script('packages/momentjs/moment.vi.js') }}
	
	<!--- select 2-->
	{{ Html::script('packages/select2/select2.min.js') }}
	{{ Html::script('packages/select2/select2_locale_vi.js') }}
	<!-- date picker -->
	{{ Html::script('packages/alertify/js/alertify.js') }}
	<!-- datatables -->

	{{ Html::script('packages/datatables/media/js/jquery.dataTables.min.js') }}
	{{ Html::script('packages/datatables/extensions/FixedColumns/js/dataTables.fixedColumns.min.js') }}
	{{ Html::script('packages/datatables/extensions/FixedHeader/js/dataTables.fixedHeader.min.js') }}
	{{ Html::script('packages/datatables/extensions/TableTools/js/dataTables.tableTools.min.js') }}
	{{ Html::script('packages/datatables/plugins/js/numeric-comma.js') }}
	{{-- Html::script('packages/jquery/jquery-ui-1.12.1.custom/jquery-ui.js') --}}
	{{ Html::script('packages/jquery/js/jquery-ui-1.8.20.custom.min.js') }}
	{{-- Html::script('packages/ckeditor/ckeditor.js') --}}

	{{ Html::script('packages/dropify/dist/js/dropify.min.js') }}
	{{ Html::script('packages/tinymce/tinymce.min.js') }}
	{{ Html::script('packages/admin/js/main.js') }}

	<script type="text/javascript">
		$(document).ready(function(){
			@if(Session::has('error_message'))
				Amo.alert('{{ Session::get("error_message") }}', 0);
		  	@endif
		  	
		  	@if(Session::has('success_message'))
				Amo.success('{{ Session::get("success_message") }}',0);
		  	@endif

		  	@if(Session::has('flash_error_message'))
				Amo.alert('{{ Session::get("flash_error_message") }}',8000);
		  	@endif

		  	@if(Session::has('flash_success_message'))
				Amo.success('{{ Session::get("flash_success_message") }}',8000);
		  	@endif

			$('input.combodate').combodate({
			    minYear: 1950,
			    maxYear: {{ date('Y') }} + 1,
			    customClass: 'form-control',
			    smartDays: true,
			    firstItem: 'name'
			});

			$('#scrollToTop').click(function() {
	            $("body,Html").animate({
	                scrollTop: 0
	            }, 600);
	            return false;
	        });

			$(".select2-control").select2();

		});

		function form_submit(name)
		{

		    $("[name=\""+name+"\"]").submit();
		}
	</script>
@show