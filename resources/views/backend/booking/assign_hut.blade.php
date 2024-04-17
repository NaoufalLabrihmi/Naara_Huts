<form action="" method="POST">
    @csrf

    <table class="table">
        <tr>
            <th>Hut Number</th>
            <th>Action</th>
        </tr>

        @foreach($hut_numbers as $hut_number)
        <tr>
            <td>{{ $hut_number->hut_no }}</td>
            <td>
                <a href="{{ route('assign_hut_store',[$booking->id,$hut_number->id]) }}" class="btn bg-primary"><i class="lni lni-circle-plus"></i></a>
            </td>
        </tr>
        @endforeach

    </table>



</form>