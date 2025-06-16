<!-- Modal -->
<div class="modal fade" id="delete{{ $doctor->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ trans('doctors.delete_doctor') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('Doctors.destroy', $doctor->id ) }}" method="post">
                <!-- first it going to doctor dysroy then make delete method-->
                {{ method_field('delete') }}
                {{ csrf_field() }}
                <div class="modal-body">
                    <h5>{{trans('sections_trans.Warning')}} {{$doctor->name}}</h5>
                    <!-- we have single delete and multi delete if value=1 =>page_id =1 =>sigle delete -->
                    <input type="hidden" value="1" name="page_id">
                    @if($doctor->image)
                    <!--selecting doctor image to delete it   -->
                        <input type="hidden" name="filename" value="{{$doctor->image->filename}}">
                    @endif
                    <!--selecting doctor id  -->
                    <input type="hidden" name="id" value="{{ $doctor->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Dashboard/sections_trans.Close')}}</button>
                    <button type="submit" class="btn btn-danger">{{trans('Dashboard/sections_trans.submit')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
