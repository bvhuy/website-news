@extends('admin.layouts')
@section('css')
@section('css')
<link href="{{ asset('assets/admin/global/plugins/bootstrap-toastr/toastr.min.css') }}" rel="stylesheet">
@endsection

@section('css-finally')
<!-- bootstrap-daterangepicker -->
<link href="{{ asset('assets/admin/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Tổng quan</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <!-- start project list -->
                    <br />
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Tổng khách truy cập và số lần xem trang</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <div id="reportrangevisitorsviews" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                        <span></span> <b class="caret"></b>
                                    </div>
                                </li>
                                <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <!-- start project list -->
                            <br />
                            <canvas id="TotalVisitorsAndPageViews"></canvas>
                        </div>
                    </div>
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Các trang được truy cập nhiều nhất</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li>
                                    <div id="reportrangemostpages" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                        <span></span> <b class="caret"></b>
                                    </div>
                                </li>
                                <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <!-- start project list -->
                            <br />
                            <div class="table-responsive">
                                <table class="table table-striped projects table-function-container">
                                    <thead>
                                        <tr>
                                            <th style="width: 1%">#</th>
                                            <th>Tiêu đề trang</th>
                                            <th>Trang</th>
                                            <th style="width: 20%">Số lượt xem trang</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $_SESSION['i'] = 0; ?>
                                        @foreach ($mostVisitedPages as $row)
                                        <?php $_SESSION['i']=$_SESSION['i'] + 1; ?>
                                        <tr>
                                            <td>{{$_SESSION['i']}}</td>
                                            <td><p>{{ $row['pageTitle'] }}</p></td>
                                            <td><p>{{ $row['url'] }}</p></td>
                                            <td><p>{{ $row['pageViews'] }}</p></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>      
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript" src="{{ asset('assets/admin/global/plugins/jquery-form/jquery.form.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/admin/global/plugins/bootstrap-toastr/toastr.min.js') }}"></script>
@endsection

@section('js-finally')
<!-- Chart.js -->
<script src="{{ asset('assets/admin/vendors/Chart.js/dist/Chart.min.js') }}"></script>
{{--
<!-- jQuery Sparklines -->
<script src="{{ asset('assets/admin/vendors/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<!-- morris.js -->
<script src="{{ asset('assets/admin/vendors/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/morris.js/morris.min.js') }}"></script>
<!-- gauge.js -->
<script src="{{ asset('assets/admin/vendors/gauge.js/dist/gauge.min.js') }}"></script>
<!-- bootstrap-progressbar -->
<script src="{{ asset('assets/admin/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
<!-- Skycons -->
<script src="{{ asset('assets/admin/vendors/skycons/skycons.js') }}"></script>
<!-- Flot -->
<script src="{{ asset('assets/admin/vendors/Flot/jquery.flot.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/Flot/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/Flot/jquery.flot.time.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/Flot/jquery.flot.stack.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/Flot/jquery.flot.resize.js') }}"></script>
<!-- Flot plugins -->
<script src="{{ asset('assets/admin/vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/flot.curvedlines/curvedLines.js') }}"></script>
<!-- DateJS -->
<script src="{{ asset('assets/admin/vendors/DateJS/build/date.js') }}"></script> --}}
<!-- bootstrap-daterangepicker -->
<script src="{{ asset('assets/admin/vendors/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script>
    function init_daterangepicker() {
        if (typeof($.fn.daterangepicker) === 'undefined') { return; }
        console.log('init_daterangepicker');

        var cb = function(start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
            $('#reportrangevisitorsviews span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
            $('#reportrangemostpages span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
        };

        var optionSet1 = {
            startDate: moment().subtract(29, 'days'),
            endDate: moment(),
            minDate: '01/01/2012',
            maxDate: "{{ date('d/m/Y') }}",
            dateLimit: {
                days: 60
            },
        showDropdowns: true,
        showWeekNumbers: true,
        timePicker: false,
        timePickerIncrement: 1,
        timePicker12Hour: true,
        ranges: {
            'Hôm nay': [moment(), moment()],
            'Hôm qua': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            '7 ngày trước': [moment().subtract(6, 'days'), moment()],
            '30 ngày trước': [moment().subtract(29, 'days'), moment()],
            'Tháng này': [moment().startOf('month'), moment().endOf('month')],
            'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        opens: 'left',
        buttonClasses: ['btn btn-default'],
        applyClass: 'btn-small btn-primary',
        cancelClass: 'btn-small',
        format: 'DD/MM/YYYY',
        separator: ' to ',
        locale: {
            applyLabel: 'Chọn',
            cancelLabel: 'Làm mới',
            fromLabel: 'Từ',
            toLabel: 'Đến',
            customRangeLabel: 'Tuỳ chọn',
            daysOfWeek: ['CN', 'Hai', 'Ba', 'Tư', 'Năm', 'Sáu', 'Bảy'],
            monthNames: ['Tháng một', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
            firstDay: 1
        }
    };

    $('#reportrangevisitorsviews span').html(moment().subtract(29, 'days').format('DD/MM/YYYY') + ' - ' + moment().format('DD/MM/YYYY'));
    $('#reportrangevisitorsviews').daterangepicker(optionSet1, cb);
    $('#reportrangevisitorsviews').on('show.daterangepicker', function() {
        console.log("show event fired");
    });
    $('#reportrangevisitorsviews').on('hide.daterangepicker', function() {
        console.log("hide event fired");
    });

    $('#reportrangemostpages span').html(moment().subtract(29, 'days').format('DD/MM/YYYY') + ' - ' + moment().format('DD/MM/YYYY'));
    $('#reportrangemostpages').daterangepicker(optionSet1, cb);
    $('#reportrangemostpages').on('show.daterangepicker', function() {
        console.log("show event fired");
    });
    $('#reportrangemostpages').on('hide.daterangepicker', function() {
        console.log("hide event fired");
    });

    // if ($('#TotalVisitorsAndPageViews').length) {

    var ctx = document.getElementById("TotalVisitorsAndPageViews");
    var TotalVisitorsAndPageViews = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($date->map(function($d){ return $d->format('d/m/Y'); })) !!},
            datasets: [{
                label: 'Khách',
                backgroundColor: "#26B99A",
                data: {!! json_encode($visitors) !!}
            }, {
                label: 'Số lượt xem trang',
                backgroundColor: "#03586A",
                data: {!! json_encode($pageViews) !!}
            }]
        },

        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    // }

    $('#reportrangevisitorsviews').on('apply.daterangepicker', function(ev, picker) {
        console.log("apply event fired, start/end dates are " + picker.startDate.format('DD/MM/YYYY') + " to " + picker.endDate.format('DD/MM/YYYY'));
        var dateFrom = picker.startDate.format('DD-MM-YYYY');
        var dateTo = picker.endDate.format('DD-MM-YYYY');
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ url(route('admin.statistic.visitors.views')) }}",
            method: "POST",
            dataType: "JSON",
            data: {
                dateFrom:dateFrom,
                dateTo: dateTo,
                _token: _token
            },
            success:function(res) {
                const datapoints = res.data;
                const labelsmonth = datapoints.date.map(
                    function(index) {
                        return index;
                    }
                );
                const visitors = datapoints.visitors.map(
                    function(index) {
                        return index;
                    }
                );
                const pageViews = datapoints.pageViews.map(
                    function(index) {
                        return index;
                    }
                );

                TotalVisitorsAndPageViews.data.labels = labelsmonth;
                TotalVisitorsAndPageViews.data.datasets[0].data = visitors;
                TotalVisitorsAndPageViews.data.datasets[1].data = pageViews;
                TotalVisitorsAndPageViews.update();
            
            }
        })
    });

    $('#reportrangevisitorsviews').on('cancel.daterangepicker', function(ev, picker) {
        console.log("cancel event fired");
    });
    $('#options1').click(function() {
        $('#reportrangevisitorsviews').data('daterangepicker').setOptions(optionSet1, cb);
    });
    $('#options2').click(function() {
        $('#reportrangevisitorsviews').data('daterangepicker').setOptions(optionSet2, cb);
    });
    $('#destroy').click(function() {
        $('#reportrangevisitorsviews').data('daterangepicker').remove();
    });

    $('#reportrangemostpages').on('apply.daterangepicker', function(ev, picker) {
        console.log("apply event fired, start/end dates are " + picker.startDate.format('DD/MM/YYYY') + " to " + picker.endDate.format('DD/MM/YYYY'));
        var dateFrom = picker.startDate.format('DD-MM-YYYY');
        var dateTo = picker.endDate.format('DD-MM-YYYY');
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: "{{ url(route('admin.statistic.most.visited.pages')) }}",
            method: "POST",
            dataType: "JSON",
            data: {
                dateFrom:dateFrom,
                dateTo: dateTo,
                _token: _token
            },
            success:function(res) {
                $('tbody').empty();
                $('tbody').html(res.data);
            }
        })
    });
    $('#reportrangemostpages').on('cancel.daterangepicker', function(ev, picker) {
        console.log("cancel event fired");
    });
    $('#options1').click(function() {
        $('#reportrangemostpages').data('daterangepicker').setOptions(optionSet1, cb);
    });
    $('#options2').click(function() {
        $('#reportrangemostpages').data('daterangepicker').setOptions(optionSet2, cb);
    });
    $('#destroy').click(function() {
        $('#reportrangemostpages').data('daterangepicker').remove();
    });
}

$(document).ready(function() {
    init_daterangepicker();
});
</script>
@endsection