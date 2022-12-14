<div class="container-fluid">
    <!-- Breadcrumb-->
    <div class="row pt-2 pb-2">
        <div class="col-sm-9">
            <h4 class="page-title">Dashboard Page</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javaScript:void();">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </div>
    </div>
    <!-- End Breadcrumb-->
    <div class="row">
        <div class="col-12">
            @livewire('widgets.today-hour-wise-report')
        </div>
        <div class="col-12">
            @livewire('widgets.day-wise-income-expense-chart')
        </div>
        <div class="col-12 col-sm-6 col-lg-6 col-xl-3">
            <div class="card bg-success shadow-success">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body text-left">
                            <h4 class="text-white">{{ money_format_india($today_total_income) }} TK</h4>
                            <span class="text-white">Today's Sale</span>
                        </div>
                        <i class="icon-like text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-6 col-xl-3">
            <div class="card bg-warning shadow-warning">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body text-left">
                            <h4 class="text-white">{{ money_format_india($today_total_expense) }} TK</h4>
                            <span class="text-white">Today's Expense</span>
                        </div>
                        <i class="icon-like text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-6 col-xl-3">
            <div class="card bg-warning shadow-warning">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body text-left">
                            <h4 class="text-white">{{ money_format_india($today_total_purchase) }} TK</h4>
                            <span class="text-white">Today's Buy</span>
                        </div>
                        <i class="icon-like text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-6 col-xl-3">
            <div class="card bg-danger shadow-danger">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body text-left">
                            <h4 class="text-white">{{ money_format_india($today_delete_orders) }}</h4>
                            <span class="text-white">Today Delete Orders</span>
                        </div>
                        <i class="icon-like text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($categories as $category)
        <div class="col-12 col-sm-6 col-lg-6 col-xl-3">
            <div class="card bg-primary shadow-primary">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body text-left">
                            <h4 class="text-white">{{ money_format_india($category->total_sell_of_today()) }}</h4>
                            <span class="text-white">{{ str_limit($category->name, 16, '...') }}</span>
                        </div>
                        <i class="icon-like text-white"></i>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- End container-fluid-->
