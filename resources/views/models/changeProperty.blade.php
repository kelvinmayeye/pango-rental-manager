<!-- Modal -->
<div class="modal fade" id="changePropertyModal{{ $tenantProperty->id }}" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Change property</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('tenantProperties.update',$tenantProperty->id) }}" method="post">
            @csrf
            @method('PATCH')
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" name="property_id" value="{{ $tenantProperty->id }}">
                    <div class="col-md-12 mb-2">
                        <div class="form-group">
                            <label for="">Property</label>
                            @if ($properties == null)
                                <h4 style="color: #b10a0a;">All properties are taken</h4>
                            @else
                                <select name="property_id" id="" class="form-control" required>

                                    <option selected disabled> select property </option>
                                    @foreach ($properties as $property)
                                        <option value="{{ $property->id }}">{{ $property->name }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
</div>