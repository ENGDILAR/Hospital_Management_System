<!-- Modal -->
<div wire:ignore.self class="modal fade" id="delete_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ trans('invoices_trans.Delete_invoice_Data') }}  </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                {{ trans('invoices_trans.Deleted') }}   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('invoices_trans.close') }}</button>
                <button type="button" wire:click.prevent="destroy()" class="btn btn-danger">{{ trans('invoices_trans.save') }}</button>
            </div>
            

        </div>
    </div>
</div>
