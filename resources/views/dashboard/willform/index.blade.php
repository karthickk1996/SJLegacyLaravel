@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header"><h4>Will Submissions</h4></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <a class="btn btn-lg btn-primary" href="{{ route('willform.create') }}">New Will</a>
                                </div>
                            </div>
                            <br>
                            @if(session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success !</strong> {{session()->get('success')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <table class="table table-striped table-bordered yajra-datatable">
                                <thead>
                                <tr>
                                    <th>User Id</th>
                                    <th>Will Number</th>
                                    <th>Single/Mirror Will</th>
                                    <th>Status</th>
                                    <th>View/Edit</th>
                                    <th>Date Created</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach($data as $datum)
        <div class="modal fade" id="will-{{$datum->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body" id="will-print-{{$datum->id}}">
                        @include('dashboard.willform.print.index',['data' => $datum])
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary"
                                onclick="printJS('will-print-{{$datum->id}}', 'html')">Print
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('javascript')
    <script type="text/javascript">
        $(function () {

            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('willform.submissions') }}",
                columns: [
                    {data: 'user_id', name: 'UserId'},
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'willType', name: 'willType'},
                    {data: 'status', name: 'Status'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                    {data: 'createdAt', name: 'Date Created'},
                ]
            });

        });

        function deleteWill(id) {
            jQuery.ajax({
                url: "/will",
                method: 'delete',
                data: {
                    id: id,
                    "_token": "{{ csrf_token() }}",
                },
                success: function (result) {
                    window.location.href = '/will/submissions';
                }
            });
        }
    </script>
@endsection
