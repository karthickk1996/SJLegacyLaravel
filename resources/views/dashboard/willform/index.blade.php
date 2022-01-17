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
                            <table class="table table-striped table-bordered yajra-datatable">
                                <thead>
                                <tr>
                                    <th>User Id</th>
                                    <th>Will Number</th>
                                    <th>Status</th>
                                    <th>Single/Mirror Will</th>
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
    </div>

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
                    {data: 'status', name: 'status'},
                    // {data: 'payment_type', name: 'username'},
                    {data: 'willType', name: 'willType'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                    {data: 'created_at', name: 'Date Created'},
                ]
            });

        });
    </script>
@endsection
