@inject('set', 'App\Http\Controllers\Insurance\InsuranceSubscriptionController')
@extends('layouts.app')

@section('content')

<!-- start page title -->
@include('partials.breadcrumb',[
    'page_title'    => $set->_page_title,
    'menu_group'    => $set->_menu_group,
    'menu_item'     => 'Farmers',
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
                    <li class="nav-item"><a class="nav-link" href="{{ route($set->_route.'.index') }}">List of subscriptions</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route($set->_route.'.create-crops') }}">Subscribe farmer (Crop)</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route($set->_route.'.create-livestock') }}">Subscribe farmer (Livestock)</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active">
                        <!-- content starts here -->

                            @include('insurance.subscriptions.create', ['category' => 'livestock'])

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

@endsection

