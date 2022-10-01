<x-app-layout>

    <!-- Edit job form -->
    <div class="row">
        <div class="col-md-8 offset-md-2">

            <h3 class="text-center border-bottom-1">Edit a job</h3>
            @include('layout.success_messages')
            <p>
                <a href="{{ route('job_list_formatted') }}/" class="btn btn-primary" target="_blank">Properties List</a>
            </p>
            <hr/>
            <form action="{{ route('update_job', ["id" => $job->id ]) }}">
                <div class="form-group row mb-3">
                    <label htmlFor="colFormLabelSm"
                           class="col-sm-2 col-form-label col-form-label-md">Summary</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-md" id="summary" name="summary"
                               placeholder="Summary" value="{{ $job->summary }}"/>
                        @if ($errors->has('summary'))
                                <strong class="text-danger">{{ $errors->first('summary') }}</strong>
                        @endif
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label htmlFor="colFormLabel" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-md" id="description"
                               name="description"
                               placeholder="Description" value="{{ $job->description }}"/>

                        @if ($errors->has('description'))
                                <strong class="text-danger">{{ $errors->first('description') }}</strong>
                        @endif
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label htmlFor="colFormLabelLg"
                           class="col-sm-2 col-form-label col-form-label-md">Property</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="property">
                            @forelse($propertyList AS $property)
                                @if($loop->first)
                                    <option value="">Select a property</option>
                                @endif
                                <option
                                    value="{{ $property->id }}" {{ $job->property_id == $property->id ? "selected" : ""}} >{{ $property->name }}</option>
                            @empty
                                <option value="">No property available</option>
                            @endforelse
                        </select>
                        @if ($errors->has('property'))
                                <strong class="text-danger">{{ $errors->first('property') }}</strong>
                        @endif
                    </div>
                </div>
                <hr/>
                <div class="form-group row mb-3 text-right">
                    <label htmlFor="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-md"></label>
                    <div class="col-sm-10 text-right">
                        <input type="hidden" name="user" value="1"/>
                        <button type="submit" class="btn btn-primary" value="Submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
