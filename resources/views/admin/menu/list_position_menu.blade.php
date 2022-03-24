@extends('admin_layout')
@section('css')
<style>
   #menu-master tr:hover {
    cursor: pointer;
  }
</style>
@endsection
@section('dashboard')
<div class="main-content">
  <div class="main-content-inner">
    <div class="breadcrumbs" id="breadcrumbs">
      <script type="text/javascript">
        try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
      </script>
    </div>

    <div class="page-content">
      <div class="page-header">
        <h1 class="text-center">
          Thay đổi vị trí Menu
        </h1>
      </div><!-- /.page-header -->

      <div class="row">
        <div class="col-xs-12">
          <!-- PAGE CONTENT BEGINS -->
          <div class="row">
            <div class="col-md-4 col-md-offset-4">
              <table id="simple-table" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th colspan="2" class="text-center">Tên Menu</th>
                  </tr>
                </thead>

                <tbody id="menu-master">
                  @foreach ($category as $key => $result)
                    <tr data-index="{{ $result->id }}" data-position="{{ $result->position_number }}">
                      <td><i class="fa fa-arrows" aria-hidden="true"></i> {{ $result->name }}</td>
                      <td><a class="btn btn-success btn-sm" href="{{ URL::to('/edit-menu-sub/'.$result->id) }}">Xem Menu Con</a></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div><!-- /.span -->
          </div><!-- /.row -->
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script src="{{asset('public/assets/js/jquery-ui.min.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#menu-master').sortable({
      update: function(event, ui) {
        $(this).children().each(function(index) {
          if($(this).attr('data-position') != (index + 1)) {
            $(this).attr('data-position', (index + 1)).addClass('updated');
          }
        });
        saveNewPositions();
      }
    });
	});
  function saveNewPositions() {
    var positions = [];
    $('.updated').each(function() {
      positions.push([$(this).attr('data-index'), $(this).attr('data-position')]);
      $(this).removeClass('updated');
    });

    $.ajax({
        url: '{{ url('update-list-position') }}',
        method: 'POST',
        dataType: 'text',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            update: 1,
            positions: positions
        }, success: function (response) {
            console.log(response);
        }
    });
  }
</script>
@endsection