@extends('dashboard.base')

@section('css')

@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <will-form inline-template v-cloak>
                    <div class="col-sm-10 mx-auto">
                        @include('dashboard.willform.partials.input')
                        @include('dashboard.willform.partials.mirror-select')
                        @include('dashboard.willform.partials.address')
                        @include('dashboard.willform.partials.second-applicant')
                        @include('dashboard.willform.partials.second_executer')
                        @include('dashboard.willform.partials.reserve-executor')
                        @include('dashboard.willform.partials.children-details')
                        @include('dashboard.willform.partials.reserve-guardian')
                    </div>
                </will-form>
                <!-- /.col-->
            </div>
        </div>
    </div>

@endsection
