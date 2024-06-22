@inject('set', 'App\Http\Controllers\InputLoan\BuyerController')
@extends('layouts.app')

@section('content')

<!-- start page title -->
@include('partials.breadcrumb',[
    'page_title'    => $set->_page_title,
    'menu_group'    => $set->_menu_group,
    'menu_item'     => 'Buyers',
    'menu_item_url' => route($set->_route.'.index'),
    'current'       => 'Add'
])
<!-- end page title -->

<div class="row">
    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card" id="pages">
            <div class="card-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"><a class="nav-link" href="{{ route($set->_route.'.index') }}">List of buyers</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ url()->current() }}">Add new buyer</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active">
                        <!-- content starts here -->
                            {!! Form::open(['files'=>true, 'method' => 'POST', 'route' => ['input-loans.buyers.store']]) !!}

                                <div class="form-group mb-3">
                                    {!! Form::label('country_id', 'Country (required)', ['class' => 'col-sm-3 form-label']) !!}                
                                    <div class="col-sm-5">
                                   {!! Form::select('country_id', $countries, old('country_id'), ['class' => 'form-control select2','placeholder'=>'--Select--', 'id' => 'country_id']) !!}    
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    {!! Form::label('buyer_name', 'Buyer name (required)', ['class' => 'col-sm-4 col-form-label']) !!}
                                    <div class="col-sm-5">
                                        {!! Form::text('buyer_name', old('buyer_name'), ['class' => 'form-control', 'placeholder' => 'ABC COMPANY LIMITED', 'required' => '', 'id' => 'name']) !!}
                                    </div> 
                                </div>

                                <div class="form-group mb-3">
                                {!! Form::label('file', 'Logo (optional)', ['class' => 'col-sm-4 col-form-label']) !!}
                                    <div class="col-sm-5">
                                        <input class="form-control" id="formSizeDefault" type="file" name="file">
                                    </div> 
                                </div>

                              <div class="row">
                                {!! Form::label('activity', 'Choose Enterprise (required)', ['class' => 'col-sm-12 form-label']) !!}
                                @if (isset($enterprises) && count($enterprises) > 0)
                                    @foreach ($enterprises as $activity)
                                    <div class="col-lg-12 col-md-12">
                                      <label class="form-check mb-2">
                                        <input class="form-check-input" name="enterprises[]" type="checkbox" value="{{ $activity->id }}" {{ old('enterprises') ? 'checked=""' : '' }}><span class="custom-control-label">{{ $activity->name }}</span>
                                      </label>                     
                                    </div><!-- col-3 -->
                                    @endforeach
                                @endif
                              </div><!-- row --> 

                                <div class="form-group mb-3">
                                    {!! Form::label('location_id', 'Location (required)', ['class' => 'col-sm-3 form-label']) !!}                
                                    <div class="col-sm-5">
                                   {!! Form::select('location_id', $locations, old('location_id'), ['class' => 'form-control select2','placeholder'=>'--Select--']) !!}    
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    {!! Form::label('address', 'Address (optional)', ['class' => 'col-sm-4 col-form-label']) !!}
                                    <div class="col-sm-5">
                                        {!! Form::textarea('address', old('address'), ['class' => 'form-control', 'rows' => 2]) !!}
                                    </div> 
                                </div>

                                <div class="form-group mb-3">
                                    {!! Form::label('services', 'Contact person (required)', ['class' => 'col-sm-4 col-form-label']) !!}
                                        <div class="col-sm-5">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                {!! Form::text('contact_person_name', old('contact_person_name'), ['class' => 'form-control', 'placeholder' => 'John Doe', 'required' => '', 'id' => 'name']) !!}              
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group" data-input-flag="">
                                                  <button class="btn btn-light border" type="button">
                                                    <span class="ms-2 country-codeno">+ {{ old('dialing_code') ?? '000' }}</span>
                                                  </button>
                                                      {!! Form::text('contact_person_phone_number', old('contact_person_phone_number'), ['class' => 'form-control rounded-end flag-input', 'placeholder' => 'Phone e.g. 775xxxxxx', 'required' => '']) !!}
                                                </div>         
                                            </div> 
                                        </div>
                                    </div> 
                                </div>

                                <h4><span>Buyer Administrator</span></h4>

                                <div class="form-group mb-3">
                                    {!! Form::label('name', 'Name (required)', ['class' => 'col-sm-4 col-form-label']) !!}
                                    <div class="col-sm-5">
                                        {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'John Doe', 'required' => '', 'id' => 'name']) !!}
                                    </div> 
                                </div>

                                <div class="form-group mb-3">
                                    {!! Form::label('services', 'Contacts (required)', ['class' => 'col-sm-4 col-form-label']) !!}
                                        <div class="col-sm-5">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'example@email.com', 'required'=>'']) !!}              
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group" data-input-flag="">
                                                  <button class="btn btn-light border" type="button">
                                                    <span class="ms-2 country-codeno">+ {{ old('dialing_code') ?? '000' }}</span>
                                                  </button>
                                                      {!! Form::text('phone_number', old('phone_number'), ['class' => 'form-control rounded-end flag-input', 'placeholder' => '775xxxxxx', 'required' => '']) !!}
                                                </div>         
                                            </div> 
                                        </div>
                                    </div> 
                                </div>                                                                

                                <div class="form-group mb-3">
                                    {!! Form::label('password', 'Password (auto)', ['class' => 'col-sm-4 col-form-label']) !!}
                                    <div class="col-sm-5">
                                        {!! Form::text('password', old('password') ?? generatePassword(0,9,10), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                                    </div> 
                                </div>

                                <input type="hidden" name="roles" value="{{ $buyer_admin }}">
                                <input type="hidden" name="dialing_code" value="{{ old('dialing_code') ?? '000' }}" id="dialing_code">
                                <input type="hidden" name="status" value="Active">

                                <div class="form-buttons-w">
                                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                                </div>
                           
                            {!! Form::close() !!}
                        <!-- content ends here -->
                    </div>
                </div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div>
    <!--end col-->

</div>

@endsection

@section('styles')

@endsection

@section('scripts')
    
   <script type="text/javascript">

     $('#country_id').change(function(){
        $.get("{{ url('get_dialing_code_by_country')}}", 
            { country_id: $(this).val() }, 
            function(data) {
                var model = $('#dialing_code');
                var code = $('.country-codeno');
                model.empty();
                code.empty();
                 model.val(data);
                 code.text("+"+data);
            });
    });
   </script>

@endsection

