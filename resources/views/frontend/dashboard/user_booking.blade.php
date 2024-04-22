@extends('frontend.main_master')
@section('main')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<!-- Inner Banner -->
<div class="inner-banner inner-bg6">
    <div class="container">
        <div class="inner-title">
            <ul>
                <li>
                    <a href="">Home</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>User Booking List </li>
            </ul>
            <h3>User Booking List</h3>
        </div>
    </div>
</div>
<!-- Inner Banner End -->
<style>
    .c-dashboardInfo {
        margin-bottom: 15px;
    }

    .c-dashboardInfo .wrap {
        background: #ffffff;
        box-shadow: 2px 10px 20px rgba(0, 0, 0, 0.1);
        border-radius: 7px;
        text-align: center;
        position: relative;
        overflow: hidden;
        padding: 40px 25px 20px;
        height: 100%;
    }

    .c-dashboardInfo__title,
    .c-dashboardInfo__subInfo {
        color: #6c6c6c;
        font-size: 1.18em;
    }

    .c-dashboardInfo span {
        display: block;
    }

    .c-dashboardInfo__count {
        font-weight: 600;
        font-size: 2.5em;
        line-height: 64px;
        color: #323c43;
    }

    .c-dashboardInfo .wrap:after {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 10px;
        content: "";
    }

    .c-dashboardInfo:nth-child(1) .wrap:after {
        background: linear-gradient(82.59deg, #00c48c 0%, #00a173 100%);
    }

    .c-dashboardInfo:nth-child(2) .wrap:after {
        background: linear-gradient(81.67deg, #0084f4 0%, #1a4da2 100%);
    }

    .c-dashboardInfo:nth-child(3) .wrap:after {
        background: linear-gradient(69.83deg, #0084f4 0%, #00c48c 100%);
    }

    .c-dashboardInfo:nth-child(4) .wrap:after {
        background: linear-gradient(81.67deg, #ff647c 0%, #1f5dc5 100%);
    }

    .c-dashboardInfo__title svg {
        color: #d7d7d7;
        margin-left: 5px;
    }

    .MuiSvgIcon-root-19 {
        fill: currentColor;
        width: 1em;
        height: 1em;
        display: inline-block;
        font-size: 24px;
        transition: fill 200ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
        user-select: none;
        flex-shrink: 0;
    }
</style>
<!-- Service Details Area -->
<div class="service-details-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">

                @include('frontend.dashboard.user_menu')

            </div>


            <div class="col-lg-9">
                <div class="service-article">


                    <section class="checkout-area pb-70">
                        <div class="container">
                            <form action="{{ route('password.change.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div id="root">
                                        <div class="container pt-5">
                                            <div class="row align-items-stretch">
                                                <div class="c-dashboardInfo col-lg-3 col-md-6">
                                                    <div class="wrap">
                                                        <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">Pending Bookings<svg class="MuiSvgIcon-root-19" focusable="false" viewBox="0 0 24 24" aria-hidden="true" role="presentation">
                                                                <path fill="none" d="M0 0h24v24H0z"></path>
                                                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z">
                                                                </path>
                                                            </svg></h4><span class="hind-font caption-12 c-dashboardInfo__count">Total: {{ $pendingCount }}</span>
                                                    </div>
                                                </div>
                                                <div class="c-dashboardInfo col-lg-3 col-md-6">
                                                    <div class="wrap">
                                                        <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">Complete Bookings<svg class="MuiSvgIcon-root-19" focusable="false" viewBox="0 0 24 24" aria-hidden="true" role="presentation">
                                                                <path fill="none" d="M0 0h24v24H0z"></path>
                                                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z">
                                                                </path>
                                                            </svg></h4><span class="hind-font caption-12 c-dashboardInfo__count">Total: {{ $completeCount }}</span>
                                                    </div>
                                                </div>

                                                <div class="c-dashboardInfo col-lg-3 col-md-6">
                                                    <div class="wrap">
                                                        <h4 class="heading heading5 hind-font medium-font-weight c-dashboardInfo__title">Total Bookings<svg class="MuiSvgIcon-root-19" focusable="false" viewBox="0 0 24 24" aria-hidden="true" role="presentation">
                                                                <path fill="none" d="M0 0h24v24H0z"></path>
                                                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z">
                                                                </path>
                                                            </svg></h4><span class="hind-font caption-12 c-dashboardInfo__count">Total: {{ $totalCount }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="billing-details">
                                            <h3 class="title">User Booking List </h3>



                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">B No</th>
                                                            <th scope="col">B Date</th>
                                                            <th scope="col">Customer</th>
                                                            <th scope="col">Hut</th>
                                                            <th scope="col">Check In/Out</th>
                                                            <th scope="col">Total Hut</th>
                                                            <th scope="col">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($allData as $item)
                                                        <tr>
                                                            <td> <a href="{{ route('user.invoice',$item->id) }}">{{ $item->code }}</a> </td>
                                                            <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                                            <td>{{ $item['user']['name'] }}</td>
                                                            <td>{{ $item['hut']['type']['name'] }}</td>
                                                            <td> <span class="badge bg-primary">{{ $item->check_in }}</span> <span class="badge bg-warning text-dark">{{ $item->check_out }}</span> </td>
                                                            <td>{{ $item->number_of_huts }}</td>
                                                            <td>
                                                                @if ($item->status == 1)
                                                                <span class="badge bg-success">Complete</span>
                                                                @else
                                                                <span class="badge bg-info text-dark">Pending</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>



                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </section>

                </div>
            </div>


        </div>
    </div>
</div>
<!-- Service Details Area End -->




@endsection