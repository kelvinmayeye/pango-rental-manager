@extends('backend.layouts.app')
@section('content')
   <!-- jQuery script -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    // Wait for the document to be ready
    $(document).ready(function(){
        // Attach an event listener to the dropdown change event
        $('#lease_id').change(function(){
            // Get the selected value from the dropdown
            var selectedLease = $(this).val();

            // Make an AJAX request to the 'lease' route
            $.get('/lease/' + selectedLease, function(data){
                // Update the content of the monthly_rate input field with the received data
                $('#monthly_rate').val(data.amount);

                // Clear any previous error messages
                $('#errorContainer').text('');
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                // Display an error message in the error container
                $('#errorContainer').text('AJAX request failed: ' + textStatus + ', ' + errorThrown);
            });
        });
    });
</script>

<!-- Main content -->
<section class="content pt-5">
    <div class="container-fluid">
        <div class="col-md-4 mx-auto">
            <!-- general form elements -->
            <div class="card">
                <div class="card-header">
                    <h4>Add Payment</h4>
                </div>
                <form action="{{ route('payments.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <!-- Lease dropdown -->
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label for="lease_id">Lease</label>
                                    <select name="lease_id" id="lease_id" class="form-control" required>
                                        <option selected disabled> Select lease </option>
                                        @foreach ($leases as $lease)
                                            <option value="{{ $lease->id }}">
                                                {{ $lease->tenantProperty->tenant->fullname }}
                                                ({{ $lease->tenantProperty->property->name }})
                                              </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Monthly Rate input field -->
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label for="monthly_rate">Monthly Rate</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Tsh</span>
                                        </div>
                                        <input type="text" id="monthly_rate" placeholder="0" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Amount Paid input field -->
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label>Amount Paid</label>
                                    <input type="text" class="form-control" name="amount" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card footer with buttons -->
                    <div class="card-footer d-flex">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a class="btn btn-danger mx-3" href="{{ route('payments.index') }}">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Container for error messages -->
<div id="errorContainer"></div>
<!-- /.content -->

@endsection
