<div>
    <div class="container">
        <div class="row mt-5">

            <div class="col-md-12">

                 <!-- Date range filter -->
                 <div class="search-filter">
                      <input type="text" class="datepicker" id="from_date" wire:model="from_date">
                      <input type="text" class="datepicker" id="to_date" wire:model="to_date"> 
                      <a href="/recordexport">Export All Datas</a>
                 </div>

                 <!-- Paginated records -->
                 <table class="table">
                     <thead>
                          <tr>
                              <th >Plate</th>
                              <th >Code</th>
                              <th >Amount Paid</th>
                              <th >Parking Cost</th>
                              <th >Exit Time</th>
                              <th >Is Parked</th>
                          </tr>
                     </thead>
                     <tbody>
                          @if ($Record->count())
                               @foreach ($Record as $employee)
                                   <tr>
                                       <td>{{ $employee->plate }}</td>
                                       <td>{{ $employee->code }}</td>
                                       <td>{{ $employee->amount_paid }}</td>
                                       <td>{{ $employee->parking_cost }}</td>
                                       <td>{{ $employee->exit_time }}</td>
                                       <td>{{ $employee->is_parked }}</td>
                                   </tr>
                               @endforeach
                          @else
                               <tr>
                                    <td colspan="5">No record found</td>
                               </tr>
                          @endif
                     </tbody>
                 </table>

                 <!-- Pagination navigation links -->
                 {{ $Record->links() }}
            </div>

        </div>
   </div>
</div>

@section('scripts')
<script>
$(document).ready(function(){

    $("#from_date").datepicker({
        dateFormat: "yy-mm-dd",
        changeYear: true,
        changeMonth: true,
        onSelect: function (selected) {
             var dt = new Date(selected);

             @this.set('from_date', selected);

             dt.setDate(dt.getDate() + 1);
             $("#to_date").datepicker("option", "minDate", dt);
        }
    });

    $("#to_date").datepicker({
        dateFormat: "yy-mm-dd",
        changeYear: true,
        changeMonth: true,
        onSelect: function (selected) {
             var dt = new Date(selected);

             @this.set('to_date', selected);

             dt.setDate(dt.getDate() - 1);
             $("#from_date").datepicker("option", "maxDate", dt);
        }
    });
});
</script>
@endsection