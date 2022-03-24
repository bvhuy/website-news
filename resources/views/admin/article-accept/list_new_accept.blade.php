@extends('admin_layout')
@section('title')
<title>Danh sách bài viết chờ duyệt - Admin</title>
@endsection
@section('dashboard')
<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs" id="breadcrumbs">
			<script type="text/javascript">
				try {
					ace.settings.check('breadcrumbs', 'fixed')
				} catch (e) {}
			</script>
		</div>

		<div class="page-content">
			<div class="page-header">
				<h1>
					Duyệt bài viết
					<small>
							<i class="ace-icon fa fa-angle-double-right"></i>
							Danh sách
						</small>
				</h1>
			</div>
			<!-- /.page-header -->
			<div class="row">
				<div class="col-xs-12">
					<div class="row">
						<div class="col-xs-12">
							<div class="clearfix">
								<div class="pull-right tableTools-container"></div>
							</div>
							<!-- div.table-responsive -->

							<!-- div.dataTables_borderWrap -->
							<div>
								<table id="dynamic-table" class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th style="width: 35px" class="center">
												<label class="pos-rel">
                                                    <input type="checkbox" class="ace" />
                                                    <span class="lbl"></span>
                                                </label>
											</th>
											<th style="width: 120px">Tên bài viết</th>
                                            <th style="width: 80px">Danh mục</th>
											<th style="width: 90px">Danh mục con</th>
                                            <th style="width: 100px">Ảnh đại diện</th>
                                            <th style="width: 90px">Ngày thêm</th>	
											<th style="width: 90px">Trạng thái</th>
                                            <th style="width: 90px">Hiển thị</th>
                                            <th style="width: 100px">Người thêm</th>
											<th style="width: 210px"></th>
										</tr>
									</thead>

									<tbody>
										@foreach ($list_new as $key => $list_news)			
										<tr>
											<td class="center">
												<label class="pos-rel">
													<input type="checkbox" class="ace" />
													<span class="lbl"></span>
												</label>
											</td>
                                            <td class="text-truncate-container" style="max-width: 120px;">{{$list_news->name}}</td>
											<td>
												@foreach ($list_new_category as $key => $list_new_categories)
													@if ($list_news->id == $list_new_categories->new_id)
														@foreach ($list_category as $key => $list_categories)
															@if($list_new_categories->category_id == $list_categories->id)
                                                            <span class="label label-sm label-success">{{$list_categories->name}}</span>
															@endif
														@endforeach
													@endif
												@endforeach
											</td>
											<td>
												@foreach ($list_new_category as $key => $list_new_categories)
													@if ($list_news->id == $list_new_categories->new_id)
														@foreach ($list_type as $key => $list_types)
															@if($list_new_categories->type_id == $list_types->id)
                                                            <span class="label label-sm label-success">{{$list_types->name}}</span>
															@endif
														@endforeach
													@endif
												@endforeach

											</td>
                                            <td><img src="{{URL::to('public/uploads/new/'.$list_news->thumbnail)}}" alt="" width="100" class="img-thumbnail"></td>
                                            <td><?php echo date_format(date_create($list_news->created_at), "H:i d-m-Y"); ?></td>
											<td>
												@if ($list_news->accept == 0)
												<span class="label label-sm label-inverse">Chưa duyệt</span>
												@elseif($list_news->accept == 1)
												<span class="label label-sm label-info">Đã Duyệt</span>
                                                @else
                                                <span class="label label-sm">Từ chối</span>
												@endif
												
											</td>
                                            <td class="hidden-480">
												@if ($list_news->status_accept == 0)
												<a href="{{URL::to('/unactive-status-accept-new/'.$list_news->id)}}"><span class="label label-sm label-inverse">Ẩn</span></a>
												@else
												<a href="{{URL::to('/active-status-accept-new/'.$list_news->id)}}"><span class="label label-sm label-info">Hiện</span></a>
												@endif
												
											</td>
                                            <td>{{$list_news->created_by}}</td>
											<td>
												<a class="btn btn-danger btn-sm" href="{{URL::to('/refuse-new/'.$list_news->id)}}">Từ chối</a>
                                                <a class="btn btn-success btn-sm" href="{{URL::to('/accept-new/'.$list_news->id)}}">Chấp nhận</a>
                                                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#view-article-accept-{{$list_news->id}}">
                                                    Xem
                                                </a>
                                                <div class="modal fade" id="view-article-accept-{{$list_news->id}}" tabindex="-1" role="dialog" aria-labelledby="notify-label-article-accept-{{$list_news->id}}" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title text-danger text-center" id="notify-label-article-accept-{{$list_news->id}}"><b>{{ $list_news->name }}</b></h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card view-article-accept">
                                                                    <div class="card-body">
                                                                      {!!$list_news->content!!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<!-- PAGE CONTENT ENDS -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.page-content -->
	</div>
</div>
<!-- /.main-content -->
@endsection

@section('js')
	    <!-- page specific plugin scripts -->
		<script src="{{asset('public/assets/js/jquery.dataTables.min.js')}}"></script>
		<script src="{{asset('public/assets/js/jquery.dataTables.bootstrap.min.js')}}"></script>
		<script src="{{asset('public/assets/js/dataTables.tableTools.min.js')}}"></script>
		<script src="{{asset('public/assets/js/dataTables.colVis.min.js')}}"></script>
		@endsection

		@section('custom-js')
    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        jQuery(function($) {
            //initiate dataTables plugin
            var oTable1 =
                $('#dynamic-table')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                .dataTable({
                    bAutoWidth: false,
                    "aoColumns": [{
                            "bSortable": false
                        },
                        null, null, null, null, null, null, null,null,
						{
                            "bSortable": false
                        }
                    ],
                    "aaSorting": [],

                    //,
                    //"sScrollY": "200px",
                    //"bPaginate": false,

                    //"sScrollX": "100%",
                    //"sScrollXInner": "120%",
                    //"bScrollCollapse": true,
                    //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
                    //you may want to wrap the table inside a "div.dataTables_borderWrap" element

                    //"iDisplayLength": 50
                });
            //oTable1.fnAdjustColumnSizing();


            //TableTools settings
            TableTools.classes.container = "btn-group btn-overlap";
            TableTools.classes.print = {
                "body": "DTTT_Print",
                "info": "tableTools-alert gritter-item-wrapper gritter-info gritter-center white",
                "message": "tableTools-print-navbar"
            }

            //initiate TableTools extension
            var tableTools_obj = new $.fn.dataTable.TableTools(oTable1, {
                "sSwfPath": "assets/swf/copy_csv_xls_pdf.swf",

                "sRowSelector": "td:not(:last-child)",
                "sRowSelect": "multi",
                "fnRowSelected": function(row) {
                    //check checkbox when row is selected
                    try {
                        $(row).find('input[type=checkbox]').get(0).checked = true
                    } catch (e) {}
                },
                "fnRowDeselected": function(row) {
                    //uncheck checkbox
                    try {
                        $(row).find('input[type=checkbox]').get(0).checked = false
                    } catch (e) {}
                },

                "sSelectedClass": "success",
                "aButtons": [{
                        "sExtends": "copy",
                        "sToolTip": "Copy to clipboard",
                        "sButtonClass": "btn btn-white btn-primary btn-bold",
                        "sButtonText": "<i class='fa fa-copy bigger-110 pink'></i>",
                        "fnComplete": function() {
                            this.fnInfo('<h3 class="no-margin-top smaller">Table copied</h3>\
									<p>Copied ' + (oTable1.fnSettings().fnRecordsTotal()) + ' row(s) to the clipboard.</p>',
                                1500
                            );
                        }
                    },

                    {
                        "sExtends": "csv",
                        "sToolTip": "Export to CSV",
                        "sButtonClass": "btn btn-white btn-primary  btn-bold",
                        "sButtonText": "<i class='fa fa-file-excel-o bigger-110 green'></i>"
                    },

                    {
                        "sExtends": "pdf",
                        "sToolTip": "Export to PDF",
                        "sButtonClass": "btn btn-white btn-primary  btn-bold",
                        "sButtonText": "<i class='fa fa-file-pdf-o bigger-110 red'></i>"
                    },

                    {
                        "sExtends": "print",
                        "sToolTip": "Print view",
                        "sButtonClass": "btn btn-white btn-primary  btn-bold",
                        "sButtonText": "<i class='fa fa-print bigger-110 grey'></i>",

                        "sMessage": "<div class='navbar navbar-default'><div class='navbar-header pull-left'><a class='navbar-brand' href='#'><small>Optional Navbar &amp; Text</small></a></div></div>",

                        "sInfo": "<h3 class='no-margin-top'>Print view</h3>\
									  <p>Please use your browser's print function to\
									  print this table.\
									  <br />Press <b>escape</b> when finished.</p>",
                    }
                ]
            });
            //we put a container before our table and append TableTools element to it
            $(tableTools_obj.fnContainer()).appendTo($('.tableTools-container'));

            //also add tooltips to table tools buttons
            //addding tooltips directly to "A" buttons results in buttons disappearing (weired! don't know why!)
            //so we add tooltips to the "DIV" child after it becomes inserted
            //flash objects inside table tools buttons are inserted with some delay (100ms) (for some reason)
            setTimeout(function() {
                $(tableTools_obj.fnContainer()).find('a.DTTT_button').each(function() {
                    var div = $(this).find('> div');
                    if (div.length > 0) div.tooltip({
                        container: 'body'
                    });
                    else $(this).tooltip({
                        container: 'body'
                    });
                });
            }, 200);



            //ColVis extension
            var colvis = new $.fn.dataTable.ColVis(oTable1, {
                "buttonText": "<i class='fa fa-search'></i>",
                "aiExclude": [0, 9],
                "bShowAll": true,
                //"bRestore": true,
                "sAlign": "right",
                "fnLabel": function(i, title, th) {
                    return $(th).text(); //remove icons, etc
                }

            });

            //style it
            $(colvis.button()).addClass('btn-group').find('button').addClass('btn btn-white btn-info btn-bold')

            //and append it to our table tools btn-group, also add tooltip
            $(colvis.button())
                .prependTo('.tableTools-container .btn-group')
                .attr('title', 'Show/hide columns').tooltip({
                    container: 'body'
                });

            //and make the list, buttons and checkboxed Ace-like
            $(colvis.dom.collection)
                .addClass('dropdown-menu dropdown-light dropdown-caret dropdown-caret-right')
                .find('li').wrapInner('<a href="javascript:void(0)" />') //'A' tag is required for better styling
                .find('input[type=checkbox]').addClass('ace').next().addClass('lbl padding-8');



            /////////////////////////////////
            //table checkboxes
            $('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);

            //select/deselect all rows according to table header checkbox
            $('#dynamic-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function() {
                var th_checked = this.checked; //checkbox inside "TH" table header

                $(this).closest('table').find('tbody > tr').each(function() {
                    var row = this;
                    if (th_checked) tableTools_obj.fnSelect(row);
                    else tableTools_obj.fnDeselect(row);
                });
            });

            //select/deselect a row when the checkbox is checked/unchecked
            $('#dynamic-table').on('click', 'td input[type=checkbox]', function() {
                var row = $(this).closest('tr').get(0);
                if (!this.checked) tableTools_obj.fnSelect(row);
                else tableTools_obj.fnDeselect($(this).closest('tr').get(0));
            });




            $(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
                e.stopImmediatePropagation();
                e.stopPropagation();
                e.preventDefault();
            });


            //And for the first simple table, which doesn't have TableTools or dataTables
            //select/deselect all rows according to table header checkbox
            var active_class = 'active';
            $('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function() {
                var th_checked = this.checked; //checkbox inside "TH" table header

                $(this).closest('table').find('tbody > tr').each(function() {
                    var row = this;
                    if (th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
                    else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
                });
            });

            //select/deselect a row when the checkbox is checked/unchecked
            $('#simple-table').on('click', 'td input[type=checkbox]', function() {
                var $row = $(this).closest('tr');
                if (this.checked) $row.addClass(active_class);
                else $row.removeClass(active_class);
            });



            /********************************/
            //add tooltip for small view action buttons in dropdown menu
            $('[data-rel="tooltip"]').tooltip({
                placement: tooltip_placement
            });

            //tooltip placement on right or left
            function tooltip_placement(context, source) {
                var $source = $(source);
                var $parent = $source.closest('table')
                var off1 = $parent.offset();
                var w1 = $parent.width();

                var off2 = $source.offset();
                //var w2 = $source.width();

                if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2)) return 'right';
                return 'left';
            }

        })
    </script>
@endsection