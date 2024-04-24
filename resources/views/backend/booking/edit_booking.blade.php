@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-5">


        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-info">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Booking No:</p>
                            <h6 class="my-1 text-info">{{ $editData->code }}</h6>

                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i class='bx bxs-cart'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-danger">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Booking Date:</p>
                            <h6 class="my-1 text-danger">{{ \Carbon\Carbon::parse($editData->created_at)->format('d/m/Y')  }}</h6>

                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i class='bx bxs-wallet'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-success">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Payment Method </p>
                            <h6 class="my-1 text-success">{{ $editData->payment_method }}</h6>

                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class='bx bxs-bar-chart-alt-2'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Payment Stauts </p>
                            <h6 class="my-1 text-warning">
                                @if ($editData->payment_status == '1')
                                <span class="text-success">Complete</span>
                                @else
                                <span class="text-danger">Pending</span>
                                @endif
                            </h6>

                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i class='bx bxs-group'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Booking Status</p>
                            <h6 class="my-1 text-warning">
                                @if ($editData->status == '1')
                                <span class="text-success">Complete</span>
                                @else
                                <span class="text-danger">Pending</span>
                                @endif
                            </h6>

                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i class='bx bxs-group'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div><!--end row-->

    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Hut Type</th>
                                    <th>Total Hut</th>
                                    <th>Price</th>
                                    <th>Check In / Out Date</th>
                                    <th>Total Days</th>
                                    <th>Total </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $editData->hut->type->name }}</td>
                                    <td>{{ $editData->number_of_huts }}</td>
                                    <td>{{ $editData->actual_price }}$/1Hut</td>
                                    <td>
                                        <span class="badge bg-primary">{{ $editData->check_in }}</span> /
                                        <span class="badge bg-warning text-dark">{{ $editData->check_out }}</span>
                                    </td>
                                    <td>{{ $editData->total_night }}</td>
                                    <td>{{ $editData->actual_price *  $editData->number_of_huts }}$/nights</td>

                                </tr>
                            </tbody>

                        </table>
                        <div class="col-md-6" style="float: right">
                            <style>
                                .test_table td {
                                    text-align: right;
                                }
                            </style>
                            <table class="table test_table float-right border" style="margin-top: 20px;">
                                <tr>
                                    <td>Subtotal</td>
                                    <td>${{ $editData->subtotal }}</td>
                                </tr>
                                <tr>
                                    <td>Discount</td>
                                    <td>${{ $editData->discount }}</td>
                                </tr>
                                <tr>
                                    <td>Grand Total</td>
                                    <td>${{ $editData->total_price }}</td>
                                </tr>
                            </table>


                        </div>

                        <div style="clear: both"></div>
                        <div style="margin-top: 40px; margin-bottom:20px;">
                            <a href="javascript::void(0)" class="btn btn-primary assign_hut"> Assign Hut</a>
                        </div>

                        @php
                        $assign_huts = App\Models\BookingHutList::with('hut_number')->where('booking_id',$editData->id)->get();
                        @endphp

                        @if (count($assign_huts) > 0)
                        <table class="table table-bordered">
                            <tr>
                                <th>Hut Number</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($assign_huts as $assign_hut)
                            <tr>
                                <td>{{ $assign_hut->hut_number->hut_no }}</td>
                                <td>
                                    <a href="{{ route('assign_hut_delete',$assign_hut->id) }}" id="delete">Delete</a>
                                </td>
                            </tr>
                            @endforeach

                        </table>
                        @else
                        <div class="alert alert-danger text-center">
                            Not Found Assign Hut
                        </div>
                        @endif
                    </div>
                    {{-- // end table responsive --}}

                    <form action="{{ route('update.booking.status',$editData->id) }}" method="POST">
                        @csrf

                        <div class="row" style="margin-top: 40px;">
                            <div class="col-md-5">
                                <label for="">Payment Status</label>
                                <select name="payment_status" id="input7" class="form-select">
                                    <option selected="">Select Status..</option>
                                    <option value="0" {{ $editData->payment_status == 0 ? 'selected':''}}> Pending </option>
                                    <option value="1" {{ $editData->payment_status == 1?'selected':''}}>Complete </option>
                                </select>
                            </div>


                            <div class="col-md-5">
                                <label for="">Booking Status</label>
                                <select name="status" id="input7" class="form-select">
                                    <option selected="">Select Status..</option>
                                    <option value="0" {{ $editData->status == 0 ? 'selected':''}}> Pending </option>
                                    <option value="1" {{ $editData->status == 1 ?'selected':''}}>Complete </option>
                                </select>
                            </div>

                            <div class="col-md-12" style="margin-top: 20px;">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('download.invoice',$editData->id) }}" class="btn btn-warning px-3 radius-10"><i class="lni lni-download"></i> Download Invoice</a>
                            </div>

                        </div>


                    </form>

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card radius-10 w-100">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Manage Hut and Date </h6>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('update.booking', $editData->id) }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="">CheckIn</label>
                                <input type="date" required name="check_in" id="check_in" class="form-control" value="{{ $editData->check_in }}">
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="">CheckOut</label>
                                <input type="date" required name="check_out" id="check_out" class="form-control" value="{{ $editData->check_out }}">
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="">Hut</label>
                                <input type="number" required name="number_of_huts" class="form-control" value="{{ $editData->number_of_huts }}">
                            </div>
                            <input type="hidden" name="available_hut" id="available_hut" class="form-control">

                            <div class="col-md-12 mb-2">
                                <label for="">Availability: <span class="text-success availability"></span> </label>
                            </div>

                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary">Update </button>

                            </div>


                        </div>
                    </form>
                </div>
            </div>
            <div class="card radius-10 w-100">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-0">Customer Infromation </h6>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center border-top">Name <span class="badge bg-success rounded-pill">{{ $editData['user']['name'] }}</span>
                        </li>
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Email <span class="badge bg-danger rounded-pill">{{ $editData['user']['email'] }} </span>
                        </li>
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Phone <span class="badge bg-primary rounded-pill">{{ $editData['user']['phone'] }}</span>
                        </li>
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Country <span class="badge bg-warning text-dark rounded-pill">{{ $editData->country }}</span>
                        </li>

                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center border-top">State <span class="badge bg-success rounded-pill">{{ $editData->state }}</span>
                        </li>
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Zip Code <span class="badge bg-danger rounded-pill"> {{ $editData->zip_code }} </span>
                        </li>
                        <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Address <span class="badge bg-danger rounded-pill"> {{ $editData->adress }} </span>
                        </li>


                    </ul>


                </div>

            </div>
        </div>
    </div>
</div><!--end row-->
<!-- Modal -->
<div class="modal fade myModal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Huts</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>

        </div>
    </div>
</div>
<!-- Modal -->
<script>
    $(document).ready(function() {
        getAvaility();
    });
    $(".assign_hut").on('click', function() {
        $.ajax({
            url: "{{ route('assign_hut',$editData->id) }}",
            success: function(data) {
                console.log('hello');
                $('.myModal .modal-body').html(data);

                $('.myModal').modal('show');
            }
        });
        return false;
    });

    function getAvaility() {
        var check_in = $('#check_in').val();
        var check_out = $('#check_out').val();
        var hut_id = "{{ $editData->huts_id }}";


        $.ajax({
            url: "{{ route('check_hut_availability') }}",
            data: {
                hut_id: hut_id,
                check_in: check_in,
                check_out: check_out
            },
            success: function(data) {
                $(".availability").text(data['available_hut']);
                $("#available_hut").val(data['available_hut']);
            }
        });
    }
</script>

@endsection