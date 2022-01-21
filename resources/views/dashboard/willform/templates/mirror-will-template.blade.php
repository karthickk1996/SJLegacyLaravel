@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">Edit Mirror Will</div>
                        <div class="card-body">
                            <tiny-editor data="{{$data ? $data->content : ''}}"
                                         type="mirror-will"
                            ></tiny-editor>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
