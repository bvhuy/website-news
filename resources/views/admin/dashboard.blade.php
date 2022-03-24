@extends('admin_layout')
@section('title')
<title>Dashboard - Admin</title>
@endsection
@section('css')

@endsection
@section('dashboard')
<div class="main-content">
  <div class="main-content-inner">
    <div class="page-content">

      <div class="page-header">
       
        <h1>Xin chào
          <?php
            $name = Auth::user()->admin_name;
            if($name) {
              echo $name;
            }
          ?>
        </h1>
        
      </div><!-- /.page-header -->
      
    </div><!-- /.page-content -->
  </div>
</div><!-- /.main-content -->
@endsection

@section('js')
<!--[if lte IE 8]>
  <script src="assets/js/excanvas.min.js"></script>
<![endif]-->
<script src="{{asset('public/assets/js/jquery-ui.custom.min.js')}}"></script>
<script src="{{asset('public/assets/js/jquery.ui.touch-punch.min.js')}}"></script>
<script src="{{asset('public/assets/js/jquery.easypiechart.min.js')}}"></script>
<script src="{{asset('public/assets/js/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('public/assets/js/jquery.flot.min.js')}}"></script>
<script src="{{asset('public/assets/js/jquery.flot.pie.min.js')}}"></script>
<script src="{{asset('public/assets/js/jquery.flot.resize.min.js')}}"></script>
@endsection