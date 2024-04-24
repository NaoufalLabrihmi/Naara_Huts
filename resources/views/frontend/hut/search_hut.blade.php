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
<div class="container pt-4">
    <div class="row px-5">

        <?php $empty_array = []; ?>

        @foreach ($huts as $item)
        @php
        $bookings = App\Models\Booking::withCount('assign_huts')->whereIn('id',$check_date_booking_ids)->where('huts_id', $item->id)->get()->toArray();
        $total_book_hut = array_sum(array_column($bookings, 'assign_huts_count'));
        $av_hut = $item->hut_numbers_count-$total_book_hut;
        @endphp

        @if($av_hut > 0 && old('person') <= $item->total_adult)
            <div class="col-lg-6">
                <div class="room-card-two">
                    <div class="row align-items-center">
                        <div class="col-lg-5 col-md-4 p-0">
                            <div class="room-card-img">
                                <a href="{{ route('search_hut_details', $item->id.'?check_in='.old('check_in').'&check_out='.old('check_out').'&person='.old('person')) }}">
                                    <img src="{{ asset( 'upload/hutimg/'.$item->image ) }}" alt="Images" style="width: 100%; height:300px;">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-8 p-0">
                            <div class="room-card-content">
                                <h3>
                                    <a href="{{ route('search_hut_details', $item->id.'?check_in='.old('check_in').'&check_out='.old('check_out').'&person='.old('person')) }}">{{ $item['type']['name'] }}</a>
                                </h3>
                                <span>{{ $item->price }} / Per Night </span>
                                <div class="rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </div>
                                <p>{{ $item->short_desc }}</p>
                                <ul>
                                    <li><i class='bx bx-user'></i> {{ $item->hut_capacity }} Person</li>
                                    <li><i class='bx bx-expand'></i> {{ $item->size }}ft2</li>
                                </ul>
                                <ul>
                                    <li><i class='bx bx-show-alt'></i>{{ $item->view }}</li>
                                    <li><i class='bx bxs-hotel'></i> {{ $item->bed_style }}</li>
                                </ul>
                                <a href="{{ route('search_hut_details', $item->id.'?check_in='.old('check_in').'&check_out='.old('check_out').'&person='.old('person')) }}" class="book-more-btn">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <?php array_push($empty_array, $item->id) ?>
            @endif

            @endforeach

            @if(count($huts) == count($empty_array))
            <div class="col-12">
                <p class="text-center text-danger"> Sorry No Data Found </p>
            </div>
            @endif

    </div>
</div>
<!-- Room Area End -->

@endsection