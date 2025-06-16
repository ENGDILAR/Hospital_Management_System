<div>

    {{--    @if ($catchError)--}}
    {{--        <div class="alert alert-danger" id="success-danger">--}}
    {{--            <button type="button" class="close" data-dismiss="alert">x</button>--}}
    {{--            {{ $catchError }}--}}
    {{--        </div>--}}
    {{--    @endif--}}
    
    <!-- if we add a group succesfully-->
        @if ($ServiceSaved)
            <div class="alert alert-info">{{trans('Services.Data_has_been_saved_successfully') }}</div>
        @endif
       <!-- if we update a group succesfully-->
        @if ($ServiceUpdated)
            <div class="alert alert-info">{{ trans('Services.Data_has_been_modified_successfully') }}</div>
        @endif
     <!-- we have true value of show table from live wore create groupservices -->
        @if($show_table)
            @include('livewire.GroupServices.index')
        @else
        <!-- if i press on submit button in the code go to save group function -->
            <form wire:submit.prevent="saveGroup" autocomplete="off">
                @csrf
                <div class="form-group">
                    <label>  {{ trans('Services.Group_name') }}</label>
                    <input wire:model="name_group" type="text" name="name_group" class="form-control" required>
                </div>
    
                <div class="form-group">
                    <label>{{ trans('Services.Notes') }}</label>
                    <textarea wire:model="notes" name="notes" class="form-control" rows="5"></textarea>
                </div>
    
                <div class="card mt-4">
                    <div class="card-header">
                        <div class="col-md-12">
                            <button class="btn btn-outline-primary"
                                    wire:click.prevent="addService">{{ trans('Services.Add_sub_service') }}</button>
                        </div>
                    </div>
    
    
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr class="table-primary">
                                    <th> {{ trans('Services.Service_name') }}</th>
                                    <th width="200">{{ trans('Services.quantity') }}</th>
                                    <th width="200">{{ trans('Services.operations') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($GroupsItems as $index => $groupItem)
                                    <tr>
                                        <td>
                                            <!-- add-->
                                            <!-- if i press on save then take the id and go to get the values from the data base -->
                                            @if($groupItem['is_saved'])
                                                <input type="hidden" name="GroupsItems[{{$index}}][service_id]"
                                                       wire:model="GroupsItems.{{$index}}.service_id"/>
                                                @if($groupItem['service_name'] && $groupItem['service_price'])
                                                    {{ $groupItem['service_name'] }}
                                                    ({{ number_format($groupItem['service_price'], 2) }})
                                                @endif
                                            @else
                                                <select name="GroupsItems[{{$index}}][service_id]"
                                                        class="form-control{{ $errors->has('GroupsItems.' . $index) ? ' is-invalid' : '' }}"
                                                        wire:model="GroupsItems.{{$index}}.service_id">
                                                    <option value="">-- choose product --</option>
                                                    @foreach ($allServices as $service)
                                                        <option value="{{ $service->id }}">
                                                            {{ \App\Models\ServiceTranslation::where(['Service_id' => $service->id])->pluck('name')->first() }}
                                                            ({{ number_format($service->price, 2) }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('GroupsItems.' . $index))
                                                    <em class="invalid-feedback">
                                                        {{ $errors->first('GroupsItems.' . $index) }}
                                                    </em>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if($groupItem['is_saved'])
                                                <input type="hidden" name="GroupsItems[{{$index}}][quantity]"
                                                       wire:model="GroupsItems.{{$index}}.quantity"/>
                                                {{ $groupItem['quantity'] }}
                                            @else
                                                <input type="number" name="GroupsItems[{{$index}}][quantity]"
                                                       class="form-control" wire:model="GroupsItems.{{$index}}.quantity"/>
                                            @endif
                                        </td>
                                        <td>
                                            @if($groupItem['is_saved'])
                                                <button class="btn btn-sm btn-primary"
                                                        wire:click.prevent="editService({{$index}})">
                                                        {{ trans('Services.edit') }}
                                                </button>
                                                
                                            <!-- edit-->
                                            @elseif($groupItem['service_id'])
                                                <button class="btn btn-sm btn-success mr-1"
                                                        wire:click.prevent="saveService({{$index}})">
                                                        {{ trans('Services.Confirm') }}
                                                </button>
                                            @endif
                                            <button class="btn btn-sm btn-danger"
                                                    wire:click.prevent="removeService({{$index}})">{{ trans('Services.delte') }}                                         </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
    
    
                        <div class="col-lg-4 ml-auto text-right">
                            <table class="table pull-right">
                                <tr>
                                    <td style="color: red">{{ trans('Services.Total') }}   </td>
                                    <td>{{ number_format($subtotal, 2) }}</td>
                                </tr>
    
                                <tr>
                                    <td style="color: red"> {{ trans('Services.Descount_vlue') }}   </td>
                                    <td width="125">
                                        <input type="number" name="discount_value" class="form-control w-75 d-inline"
                                               wire:model="discount_value">
                                    </td>
                                </tr>
    
                                <tr>
                                    <td style="color: red">  {{ trans('Services.Tax_rate') }}  </td>
                                    <td>
                                        <input type="number" name="taxes" class="form-control w-75 d-inline" min="0"
                                               max="100" wire:model="taxes"> %
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: red">   {{ trans('Services.Total_with_tax') }} </td>
                                    <td>{{ number_format($total, 2) }}</td>
                                </tr>
                            </table>
                        </div>
                        <br/>
                        <div>
                            <!-- go to save group function be wireclick.prevent-->
                            <input class="btn btn-outline-success" type="submit" value=" {{ trans('Services.Confirm') }} ">
                        </div>
                    </div>
                </div>
    
            </form>
        @endif
    
    
    </div>
    
    