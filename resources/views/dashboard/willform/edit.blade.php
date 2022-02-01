@extends('dashboard.base')

@section('css')
    <script src="https://js.stripe.com/v3/"></script>

    <style>
        .mx-datepicker {
            position: unset !important;
            width: unset !important;
            display: unset !important;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <edit-will-form inline-template v-cloak
                                :data="{{json_encode($data)}}"
                                id="{{$id}}"
                                :intent="{{json_encode($intent)}}">
                    <div class="col-sm-10 mx-auto">
                        @include('dashboard.willform.partials.input')
                        @include('dashboard.willform.partials.mirror-select')
                        @include('dashboard.willform.partials.address')
                        @include('dashboard.willform.partials.second-applicant')
                        @include('dashboard.willform.partials.executor')
                        @include('dashboard.willform.partials.executor_summary')
                        @include('dashboard.willform.partials.reserve-executor')
                        @include('dashboard.willform.partials.guardian')
                        @include('dashboard.willform.partials.children-details')
                        @include('dashboard.willform.partials.reserve-guardian')
                        @include('dashboard.willform.partials.gift-options')
                        @include('dashboard.willform.partials.gift-money')
                        @include('dashboard.willform.partials.gift-charity')
                        @include('dashboard.willform.partials.gift-bank')
                        @include('dashboard.willform.partials.gift-property')
                        @include('dashboard.willform.partials.gift-pet')
                        @include('dashboard.willform.partials.business')
                        @include('dashboard.willform.partials.residue')
                        @include('dashboard.willform.partials.request')
                        @include('dashboard.willform.partials.payment',[
                            'intent' => $intent
                        ])
                    </div>
                </edit-will-form>
                <!-- /.col-->
            </div>
        </div>
    </div>
@endsection
