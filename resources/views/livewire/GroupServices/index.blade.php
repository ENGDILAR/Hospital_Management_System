

<!-- we got this table from واجهات/table-basic or table data-->
<!-- wire click is like h ref but it is make the function run -->
<button class="btn btn-primary pull-right" wire:click="show_form_add" type="button"> {{ trans('Services.add_Group_Services') }}</button><br><br>
<div class="table-responsive">
        <table class="table text-md-nowrap" id="example1" data-page-length="50"style="text-align: center">
        <thead>
            <tr>
                <th>#</th>
                <th> {{ trans('Services.name') }}</th>
                <th>  {{ trans('Services.Total_with_tax') }}</th>
                <th>{{ trans('Services.Notes') }}</th>
                <th>{{ trans('Services.operations') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($groups as $group)
                <tr>
                    <td>{{ $loop->iteration}}</td>
                    <td>{{ $group->name }}</td>
                    <!-- number fromat to put a , between a specified distance -->
                    <td>{{ number_format($group->Total_with_tax, 2) }}</td>
                    <td>{{ $group->notes }}</td>
                    <td>
                        <!-- go to edit function with group id-->
                        <button wire:click="edit({{ $group->id }})" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                        <!-- go  to delete function and take group id with you-->
                        <!-- data-target is modal name-->
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteGroup{{$group->id}}"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
              @include('livewire.GroupServices.delete')
            @endforeach
    </table>

</div>



