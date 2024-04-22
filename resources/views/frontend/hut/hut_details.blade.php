@extends('frontend.main_master')
@section('main')

<!-- Inner Banner -->
<div class="inner-banner inner-bg10">
    <div class="container">
        <div class="inner-title">
            <ul>
                <li>
                    <a href="index.html">Home</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>Room Details </li>
            </ul>
            <h3>{{$hutdetails->type->name}}</h3>
        </div>
    </div>
</div>
<!-- Inner Banner End -->

<!-- Room Details Area End -->
<div class="room-details-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="room-details-side">
                    <div class="side-bar-form">
                        <h3>Booking Sheet </h3>
                        <form>
                            <div class="row align-items-center">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Check in</label>
                                        <div class="input-group">
                                            <input id="datetimepicker" type="text" class="form-control" placeholder="09/29/2020">
                                            <span class="input-group-addon"></span>
                                        </div>
                                        <i class='bx bxs-calendar'></i>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Check Out</label>
                                        <div class="input-group">
                                            <input id="datetimepicker-check" type="text" class="form-control" placeholder="09/29/2020">
                                            <span class="input-group-addon"></span>
                                        </div>
                                        <i class='bx bxs-calendar'></i>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Numbers of Persons</label>
                                        <select class="form-control">
                                            <option>01</option>
                                            <option>02</option>
                                            <option>03</option>
                                            <option>04</option>
                                            <option>05</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Numbers of Rooms</label>
                                        <select class="form-control">
                                            <option>01</option>
                                            <option>02</option>
                                            <option>03</option>
                                            <option>04</option>
                                            <option>05</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <button type="submit" class="default-btn btn-bg-three border-radius-5">
                                        Book Now
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>
            </div>

            <div class="col-lg-8">
                <div class="room-details-article">
                    <div class="room-details-slider owl-carousel owl-theme">
                        @foreach($multiImage as $image)
                        <div class="room-details-item">
                            <img src="{{asset('upload/hutimg/multi_img/'.$image->multi_img)}}" alt="Images">
                        </div>
                        @endforeach
                    </div>





                    <div class="room-details-title">
                        <h2>{{$hutdetails->type->name}}</h2>
                        <ul>

                            <li>
                                <b>${{$hutdetails->price}}/Night/Hut</b>
                            </li>

                        </ul>
                    </div>

                    <div class="room-details-content">
                        <p>{{$hutdetails->short_desc}}</p>
                        <p>
                            {!! $hutdetails->description !!}
                        </p>




                        <div class="side-bar-plan">
                            <h3>Basic Plan Facilities</h3>
                            <ul>
                                @foreach($facility as $fac)
                                <li><a href="#">{{$fac->facility_name}}</a></li>
                                @endforeach
                            </ul>


                        </div>







                        <div class="row">
                            <div class="col-lg-6">



                                <div class="services-bar-widget">
                                    <h3 class="title">Download Brochures</h3>
                                    <div class="side-bar-list">
                                        <ul>
                                            <li>
                                                <a href="#"> <b>Capacity : </b> {{$hutdetails->hut_capacity}} <i class='bx bxs-cloud-download'></i></a>
                                            </li>
                                            <li>
                                                <a href="#"> <b>Size : </b> {{$hutdetails->size}}ft2 <i class='bx bxs-cloud-download'></i></a>
                                            </li>


                                        </ul>
                                    </div>
                                </div>




                            </div>



                            <div class="col-lg-6">
                                <div class="services-bar-widget">
                                    <h3 class="title">Hut Details</h3>
                                    <div class="side-bar-list">
                                        <ul>
                                            <li>
                                                <a href="#"> <b>View : </b> {{$hutdetails->view}} <i class='bx bxs-cloud-download'></i></a>
                                            </li>
                                            <li>
                                                <a href="#"> <b>Bad Style : </b> {{$hutdetails->bed_style}} <i class='bx bxs-cloud-download'></i></a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>



                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<!-- Room Details Area End -->

<!-- Room Details Other -->
<div class="room-details-other pb-70">
    <div class="container">
        <div class="room-details-text">
            <h2>Other Huts</h2>
        </div>

        <div class="row ">
            @foreach($otherHuts as $item)
            <div class="col-lg-6">
                <div class="room-card-two">
                    <div class="row align-items-center">
                        <div class="col-lg-5 col-md-4 p-0">
                            <div class="room-card-img">
                                <a href="{{url('hut/details/'.$item->id)}}">
                                    <img src="{{ asset( 'upload/hutimg/'.$item->image ) }}" alt="Images">
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-8 p-0">
                            <div class="room-card-content">
                                <h3>
                                    <a href="{{url('hut/details/'.$item->id)}}">{{ $item['type']['name'] }}</a>
                                </h3>
                                <span>${{ $item->price }} / Per Night </span>
                                <div class="rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </div>
                                <p>${{ $item->short_desc }}</p>
                                <ul>
                                    <li><i class='bx bx-user'></i> ${{ $item->hut_capacity }}</li>
                                    <li><i class='bx bx-expand'></i> ${{ $item->size  }}ft2</li>
                                </ul>

                                <ul>
                                    <li><i class='bx bx-show-alt'></i> ${{ $item->view }}</li>
                                    <li><i class='bx bxs-hotel'></i> ${{ $item->bed_style }}</li>
                                </ul>

                                <a href="" class="book-more-btn">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Room Details Other End -->

@endsection