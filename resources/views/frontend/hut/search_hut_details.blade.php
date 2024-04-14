@extends('frontend.main_master')
@section('main')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<!-- Inner Banner -->
<div class="inner-banner inner-bg10">
    <div class="container">
        <div class="inner-title">
            <ul>
                <li>
                    <a href="{{url('/')}}">Home</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>Hut Details </li>
            </ul>
            <h3>{{$hutdetails->type->name}}</h3>
        </div>
    </div>
</div>
<!-- Inner Banner End -->

<style>
    #toast {
        visibility: hidden;
        height: 50px;
        width: fit-content;
        margin: auto;
        background-color: rgb(209, 68, 68);
        color: #fff;
        text-align: center;
        border-radius: 10px;
        position: fixed;
        z-index: 1000;
        left: 0;
        right: 0;
        top: 30px;
        font-size: 17px;
        white-space: nowrap;
    }

    #toast #desc {
        color: #fff;
        padding: 16px;
        overflow: hidden;
        white-space: nowrap;
    }

    #toast.show {
        visibility: visible;
        animation: fadein 1s, fadeout 1s 3s;
    }

    @keyframes fadein {
        from {
            top: 0;
            opacity: 0;
        }

        to {
            top: 30px;
            opacity: 1
        }
    }

    @keyframes fadeout {
        from {
            top: 30px;
            opacity: 1;
        }

        to {
            top: 0;
            opacity: 0;
        }
    }
</style>
<!-- Hut Details Area End -->
<div class="room-details-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="room-details-side">
                    <div class="side-bar-form">
                        <h3>Booking Sheet </h3>
                        <form action="{{ route('user_booking_store',$hutdetails->id) }}" method="post" id="bk_form">
                            @csrf
                            <input type="hidden" name="hut_id" value="{{$hutdetails->id}}">
                            <div class="row align-items-center">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Check in</label>
                                        <div class="input-group">
                                            <input autocomplete="off" type="text" required name="check_in" id="check_in" class="form-control dt_picker" value="{{ old('check_in') ? date('Y-m-d', strtotime(old('check_in'))) : '' }}">
                                            <span class="input-group-addon"></span>
                                        </div>
                                        <i class='bx bxs-calendar'></i>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Check Out</label>
                                        <div class="input-group">
                                            <input autocomplete="off" type="text" required name="check_out" id="check_out" class="form-control dt_picker" value="{{ old('check_out') ? date('Y-m-d', strtotime(old('check_out'))) : '' }}">
                                            <span class="input-group-addon"></span>
                                        </div>
                                        <i class='bx bxs-calendar'></i>
                                    </div>
                                </div>
                                <div id="toast">
                                    <div id="desc"></div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Numbers of Persons</label>
                                        <select class="form-control" name="person" id="nmbr_person">
                                            @for($i=0;$i<=4;$i++) <option {{old('person') == $i ? 'selected' : ''}}>0{{$i}}</option>
                                                @endfor
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" id="total_adult" value="{{$hutdetails->total_adult}}">
                                <input type="hidden" id="hut_price" value="{{$hutdetails->price}}">
                                <input type="hidden" id="discount_p" value="{{$hutdetails->discount}}">

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Numbers of Huts</label>
                                        <select class="form-control number_of_huts" name="number_of_huts" id="select_hut">
                                            @for($i=1;$i<=5;$i++) <option value="0{{$i}}">0{{$i}}</option>
                                                @endfor
                                        </select>
                                    </div>
                                    <input type="hidden" name="available_hut" id="available_hut">
                                    <p class="available_hut"></p>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <table class="table">
                                        <tr>
                                            <td>
                                                <p> SubTotal </p>
                                            </td>
                                            <td style="text-align: right"><span class="t_subtotal">0</span></td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <p> Discount </p>
                                            </td>
                                            <td style="text-align: right"><span class="t_discount">0</span></td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <p> Total </p>
                                            </td>
                                            <td style="text-align: right"><span class="t_g_total">0</span></td>
                                        </tr>
                                    </table>
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

                    <div class="room-details-review">
                        <h2>Clients Review and Retting's</h2>
                        <div class="review-ratting">
                            <h3>Your retting: </h3>
                            <i class='bx bx-star'></i>
                            <i class='bx bx-star'></i>
                            <i class='bx bx-star'></i>
                            <i class='bx bx-star'></i>
                            <i class='bx bx-star'></i>
                        </div>
                        <form>
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <textarea name="message" class="form-control" cols="30" rows="8" required data-error="Write your message" placeholder="Write your review here.... "></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12">
                                    <button type="submit" class="default-btn btn-bg-three">
                                        Submit Review
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hut Details Area End -->

<!-- Hut Details Other -->
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
<!-- Hut Details Other End -->


<script>
    $(document).ready(function() {
        var check_in = "{{ old('check_in') }}";
        var check_out = "{{ old('check_out') }}";
        var hut_id = "{{ $hut_id }}";
        if (check_in != '' && check_out != '') {
            getAvaility(check_in, check_out, hut_id);
        }
        $("#check_in").on('change', function() {
            var check_out = $("#check_out").val();
            var check_in = $(this).val();
            if (check_in != '' && check_out != '') {
                getAvaility(check_in, check_out, hut_id);
            }
        });
        $("#check_out").on('change', function() {
            var check_out = $(this).val();
            var check_in = $("#check_in").val();
            if (check_in != '' && check_out != '') {
                getAvaility(check_in, check_out, hut_id);
            }
        });
        $(".number_of_huts").on('change', function() {
            var check_out = $("#check_out").val();
            var check_in = $("#check_in").val();
            if (check_in != '' && check_out != '') {
                getAvaility(check_in, check_out, hut_id);
            }
        });
    });

    function getAvaility(check_in, check_out, hut_id) {
        $.ajax({
            url: "{{ route('check_hut_availability') }}",
            data: {
                hut_id: hut_id,
                check_in: check_in,
                check_out: check_out
            },
            success: function(data) {
                $(".available_hut").html('Availability : <span class="text-success">' + data['available_hut'] + ' Huts</span>');
                $("#available_hut").val(data['available_hut']);
                // Check if check-in is after check-out
                if (check_in && check_out && new Date(check_in) > new Date(check_out)) {
                    showError("Error check in sup that check out");
                    showNotification("Check-in date cannot be after check-out date.");
                } else {
                    // Calculate and show prices
                    price_calculate(data['total_nights']);
                }
            }
        });
    }

    function price_calculate(total_nights) {
        var check_in = $("#check_in").val();
        var check_out = $("#check_out").val();
        var hut_price = $("#hut_price").val();
        var discount_p = $("#discount_p").val();
        var select_hut = $("#select_hut").val();
        var sub_total = hut_price * total_nights * parseInt(select_hut);
        var discount_price = (parseInt(discount_p) / 100) * sub_total;
        $(".t_subtotal").text(sub_total);
        $(".t_discount").text(discount_price);
        $(".t_g_total").text(sub_total - discount_price);
    }

    function showError(message) {
        $(".t_subtotal, .t_discount, .t_g_total").text(message);
    }

    $(document).ready(function() {
        $("#bk_form").on('submit', function(event) {
            event.preventDefault(); // Prevent form submission

            var av_hut = parseInt($("#available_hut").val());
            var select_hut = parseInt($("#select_hut").val());
            var nmbr_person = parseInt($("#nmbr_person").val());
            var total_adult = parseInt($("#total_adult").val());
            var check_in = $("#check_in").val();
            var check_out = $("#check_out").val();
            // Check if check-in is after check-out
            if (check_in && check_out && new Date(check_in) > new Date(check_out)) {
                showNotification("Check-in date cannot be after check-out date.");
                return;
            }

            if (select_hut > av_hut || nmbr_person > total_adult) {
                var message = (select_hut > av_hut) ? 'Sorry, you have selected more huts than available.' : 'Sorry, you have selected more persons than available.';
                showNotification(message);
            } else {
                // Submit form if validation passes
                $("#bk_form").unbind('submit').submit();
            }
        });
    });

    function showNotification(message) {
        let notification = $("#toast");
        notification.find("#desc").text(message);
        notification.addClass("show");
        setTimeout(() => {
            notification.removeClass("show");
        }, 4000);
    }
</script>

@endsection