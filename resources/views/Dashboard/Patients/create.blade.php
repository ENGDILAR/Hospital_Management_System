@extends('Dashboard.layouts.master')
@section('css')
    <!--Internal   Notify -->
    <link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection
@section('title')
   {{ trans('patient_translation.Add_new_patient') }}
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">  {{ trans('patient_translation.Patients') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/  {{ trans('patient_translation.ADD_patient') }}</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
@include('Dashboard.messages_alert')
<!-- row -->
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <form action="{{route('Patients.store')}}" method="post" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-3">
                            <label>{{ trans('patient_translation.patient_name') }}</label>
                            <input type="text" name="name"  value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror " required>
                        </div>
                        <div class="col">
                            <label>{{ trans('patient_translation.Email') }} </label>
                            <input type="email" name="email"  value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" required>
                        </div>


                        <div class="col">
                            <label> {{ trans('patient_translation.Birth_Date') }} </label>
                            <input class="form-control fc-datepicker" name="Date_Birth" placeholder="YYYY-MM-DD"
                             type="text" required>
                        </div>

                    </div>
                    <br>
                    <div class="row">
                        <div class="col-3">
                            <label>{{ trans('patient_translation.Phone_Number') }} </label>
                            <input type="number" name="Phone"  value="{{old('Phone')}}" class="form-control @error('Phone') is-invalid @enderror" required>
                        </div>

                        <div class="col">
                            <label>{{ trans('patient_translation.Gender') }}</label>
                            <select class="form-control" name="Gender" required>
                                <option value="" selected>--{{ trans('patient_translation.Choss') }}--</option>
                                <option value="1">{{ trans('patient_translation.Male') }}</option>
                                <option value="2">{{ trans('patient_translation.Fmale') }}</option>
                            </select>
                        </div>

                        <div class="col">
                            <label>{{ trans('patient_translation.Blod_Type') }} </label>
                            <select class="form-control" name="Blood_Group" required>
                                <option value="" selected>--  {{ trans('patient_translation.Choss') }}  --</option>
                                <option value="O-">O-</option>
                                <option value="O+">O+</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                            </select>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col">
                            <label>{{ trans('patient_translation.Adress') }}</label>
                            <textarea rows="5" cols="10" class="form-control" name="Address"></textarea>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col">
                            <button class="btn btn-success">{{ trans('patient_translation.Submit') }} </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('dashboard/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();
    </script>
    <script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('/plugins/notify/js/notifit-custom.js')}}"></script>
@endsection
