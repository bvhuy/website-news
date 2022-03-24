@extends('admin_layout')
@section('css')
<style>
  #menu-sub tr:hover {
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
          Thay đổi vị trí menu con
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
                    <th class="text-center">{{ $category->name }}</th>
                  </tr>
                </thead>
                <input type="hidden" id="category_id" value = "{{ $category->id }}">
                <tbody id="menu-sub">
                  @foreach ($type as $key => $result)
                    <tr data-index-sub="{{ $result->id }}" data-position-sub="{{ $result->position_number }}">
                      <td><i class="fa fa-arrows" aria-hidden="true"></i> {{ $result->name }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="text-center">
                <a class="btn btn-success" href="{{ URL::to('/list-position-menu') }}"> Quay lại </a>
              </div>
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
		$('#menu-sub').sortable({
      update: function(event, ui) {
        $(this).children().each(function(index) {
          if($(this).attr('data-position-sub') != (index + 1)) {
            $(this).attr('data-position-sub', (index + 1)).addClass('updated-menu-sub');
          }
        });
        saveNewPositionsMenuSub();
      }
    });
	});
  function saveNewPositionsMenuSub() {
    var category_id = document.getElementById('category_id').value;
    var positions = [];
    $('.updated-menu-sub').each(function() {
      positions.push([$(this).attr('data-index-sub'), $(this).attr('data-position-sub')]);
      $(this).removeClass('updated-menu-sub');
    });

    $.ajax({
        url: '{{ url('update-menu-sub') }}',
        method: 'POST',
        dataType: 'text',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            update: 1,
            positions: positions,
            category_id: category_id
        }, success: function (response) {
            console.log(response);
        }
    });
  }
</script>
@endsection