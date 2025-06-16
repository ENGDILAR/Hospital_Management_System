<button class="btn btn-primary pull-right" wire:click="show_form_add" type="button">{{ trans('invoices_trans.Add_New_Invoice') }} </button><br><br>
<div class="table-responsive">
    <table class="table text-md-nowrap" id="example1" data-page-length="50"style="text-align: center">
        <thead>
        <tr>
            <th>#</th>
            <th>{{ trans('invoices_trans.Service_Name') }}  </th>
            <th>{{ trans('invoices_trans.Patient_name') }} </th>
            <th> {{ trans('invoices_trans.Invoice_Date') }} </th>
            <th> {{ trans('invoices_trans.Doctor_name') }}</th>
            <th>{{ trans('invoices_trans.Section') }}</th>
            <th> {{ trans('invoices_trans.Service_Price') }}</th>
            <th>{{ trans('invoices_trans.Discount_value') }} </th>
            <th>{{ trans('invoices_trans.Tax_Rate') }} </th>
            <th>{{ trans('invoices_trans.Tax_Value') }} </th>
            <th> {{ trans('invoices_trans.Total_with_Tax') }} </th>
            <th> {{ trans('invoices_trans.Invoice_Type') }}</th>
            <th> {{ trans('invoices_trans.Processes') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($single_invoices as $single_invoice)
            <tr>
                <td>{{ $loop->iteration}}</td>
                <td>{{ $single_invoice->Service->name }}</td>
                <td>{{ $single_invoice->Patient->name }}</td>
                <td>{{ $single_invoice->invoice_date }}</td>
                <td>{{ $single_invoice->Doctor->name }}</td>
                <td>{{ $single_invoice->Section->name }}</td>
                <td>{{ number_format($single_invoice->price, 2) }}</td>
                <td>{{ number_format($single_invoice->discount_value, 2) }}</td>
                <td>{{ $single_invoice->tax_rate }}%</td>
                <td>{{ number_format($single_invoice->tax_value, 2) }}</td>
                <td>{{ number_format($single_invoice->total_with_tax, 2) }}</td>
                <td>{{ $single_invoice->type == 1 ?trans('invoices_trans.Cash') :trans('invoices_trans.Later') }}</td>
                <td>
                    <button wire:click="edit({{ $single_invoice->id }})" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_invoice" wire:click="delete({{ $single_invoice->id }})" ><i class="fa fa-trash"></i></button>
                    <button wire:click="print({{ $single_invoice->id }})"  class="btn btn-primary btn-sm"><i class="fas fa-print"></i></button>
             
                </td>
            </tr>

        @endforeach
    </table>

    @include('livewire.single_invoices.delete')

</div>
