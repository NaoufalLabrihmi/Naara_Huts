@extends('frontend.main_master')
@section('main')

<!-- Inner Banner -->
<div class="inner-banner inner-bg9">
    <div class="container">
        <div class="inner-title">
            <ul>
                <li>
                    <a href="{{url('/')}}">Home</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>Huts</li>
            </ul>
            <h3>Huts</h3>
        </div>
    </div>
</div>
<!-- Inner Banner End -->

<!-- Room Area -->
<div class="room-area pt-100 pb-70">
    <div class="container">
        <div class="section-title text-center">
            <span class="sp-color">HUTS</span>
            <h2>Our Huts & Rates</h2>
        </div>
        <div class="row pt-45">
            <?php $empty_array = []; ?>

            @foreach ($huts as $item)

            @php
            $bookings = App\Models\Booking::withCount('assign_huts')->whereIn('id',$check_date_booking_ids)->where('huts_id', $item->id)->get()->toArray();
            $total_book_hut = array_sum(array_column($bookings, 'assign_huts_count'));
            $av_hut = $item->hut_numbers_count-$total_book_hut;
            @endphp

            @if($av_hut > 0 && old('person') <= $item->total_adult)


                <div class="col-lg-4 col-md-6">
                    <div class="room-card">
                        <a href="{{url('hut/details/'.$item->id)}}">
                            <img src="{{ asset( 'upload/hutimg/'.$item->image ) }}" alt="Images" style="width: 550px; height:300px;">
                        </a>
                        <div class="content">
                            <h6><a href="{{url('hut/details/'.$item->id)}}">{{ $item['type']['name'] }}</a></h6>
                            <ul>
                                <li class="text-color">${{ $item->price }}</li>
                                <li class="text-color">Per Night</li>
                            </ul>
                            <div class="rating text-color">
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star'></i>
                                <i class='bx bxs-star-half'></i>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <?php array_push($empty_array, $item->id) ?>
                @endif
                @endforeach

                @if(count($huts) == count($empty_array))
                <p class="text-center text-danger"> Sorry No Data Found </p>
                @endif
        </div>
    </div>
</div>
<!-- Room Area End -->






@endsection