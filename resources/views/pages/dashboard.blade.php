@extends('layouts.app')

@section('title', 'General Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
@endpush

@section('main')

    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Admin</h4>
                            </div>
                            <div class="card-body">
                                {{ Auth::user()->where('roles', 'ADMIN')->count() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Product</h4>
                            </div>
                            <div class="card-body">
                                @php
                                    $product = App\Models\Product::count();
                                    echo $product;
                                @endphp
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Order</h4>
                            </div>
                            <div class="card-body">
                                @php
                                    $order = App\Models\Order::count();
                                    echo $order;
                                @endphp
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total User</h4>
                            </div>
                            <div class="card-body">
                                @php
                                    $user = App\Models\User::count();
                                    echo $user;
                                @endphp
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Statistics</h4>
                            <div class="card-header-action">
                                <div class="btn-group">
                                    <a href="#" class="btn btn-primary" data-period="week">Week</a>
                                    <a href="#" class="btn" data-period="month">Month</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart" height="182"></canvas>
                            <div class="statistic-details mt-sm-4">
                                <div class="statistic-details-item">
                                    @php
                                        use Carbon\Carbon;
                                        $timezone = 'Asia/Jakarta';
                                        $today = Carbon::now($timezone)->toDateString();
                                        $yesterday = Carbon::yesterday($timezone)->toDateString();

                                        $todaySales = DB::table('orders')
                                            ->whereDate('transaction_time', $today)
                                            ->sum('total');

                                        $yesterdaySales = DB::table('orders')
                                            ->whereDate('transaction_time', $yesterday)
                                            ->sum('total');

                                        if ($yesterdaySales > 0) {
                                            $percentChange = (($todaySales - $yesterdaySales) / $yesterdaySales) * 100;
                                        } else {
                                            $percentChange = $todaySales > 0 ? 100 : 0;
                                        }

                                        if ($percentChange > 0) {
                                            $icon = 'fas fa-caret-up';
                                            $color = 'text-primary';
                                        } else {
                                            $icon = 'fas fa-caret-down';
                                            $color = 'text-danger';
                                        }
                                        $order = App\Models\Order::whereDate(
                                            'transaction_time',
                                            Carbon::now($timezone),
                                        )->get();
                                        $orderSum = $order->sum('total');

                                        $todaySalesFormatted = number_format($todaySales);
                                        $percentChangeFormatted = number_format(abs($percentChange), 2);
                                    @endphp
                                    <span class="text-muted"><span class="{{ $color }}"><i
                                                class="{{ $icon }}"></i></span>
                                        {{ $percentChangeFormatted }}%</span>
                                    <div class="detail-value">Rp.
                                        {{ number_format($orderSum) }}
                                    </div>
                                    <div class="detail-name">Today's Sales</div>
                                </div>
                                <div class="statistic-details-item">
                                    <span class="text-muted"><span class="text-danger"><i
                                                class="fas fa-caret-down"></i></span> 23%</span>
                                    <div class="detail-value">Rp.
                                        @php
                                            $order = App\Models\Order::whereBetween('transaction_time', [
                                                Carbon::now($timezone)->startOfWeek(),
                                                Carbon::now($timezone)->endOfWeek(),
                                            ])->get();
                                            $orderSum = $order->sum('total');
                                            echo number_format($orderSum);
                                        @endphp
                                    </div>
                                    <div class="detail-name">This Week's Sales</div>
                                </div>
                                <div class="statistic-details-item">
                                    <span class="text-muted"><span class="text-primary"><i
                                                class="fas fa-caret-up"></i></span>9%</span>
                                    <div class="detail-value">
                                        Rp.
                                        @php
                                            $order = App\Models\Order::whereMonth(
                                                'transaction_time',
                                                Carbon::now($timezone)->month,
                                            )
                                                ->whereYear('transaction_time', Carbon::now()->year)
                                                ->get();
                                            $orderSum = $order->sum('total');
                                            echo number_format($orderSum);
                                        @endphp
                                    </div>
                                    <div class="detail-name">This Month's Sales</div>
                                </div>
                                <div class="statistic-details-item">
                                    <span class="text-muted"><span class="text-primary"><i
                                                class="fas fa-caret-up"></i></span> 19%</span>
                                    <div class="detail-value">Rp.@php
                                        $order = App\Models\Order::all();
                                        $order = $order->sum('total');
                                        echo number_format($order);
                                    @endphp</div>
                                    <div class="detail-name">This Year's Sales</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Top Product</h4>

                        </div>
                        <div class="card-body" style="display: flex; align-items: center;">
                            <canvas id="myChart2" height="193"></canvas>
                            <div id="chartLegend" style="margin-left: 20px"></div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>Top Caetgory</h4>

                        </div>
                        <div class="card-body">
                            <canvas id="myChart3" height="195"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Recent Activities</h4>

                        </div>
                        <div class="card-body">
                            <canvas id="myChart2" height="193"></canvas>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Recent Activities</h4>

                        </div>
                        <div class="card-body">
                            <canvas id="myChart2" height="193"></canvas>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
