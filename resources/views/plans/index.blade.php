@extends('layouts.app')
@section('content')
    <div class="container py-5">
        <section class="page-title">
            <div class="auto-container">
                <h1>{{ __('All Plans') }}</h1>
            </div>
        </section>
        <div class="row">
            <div class="col">
                <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <th>Name</th>
                        <th>Call Minutes</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

<script src="{{ asset('vendor/laravel-plan-management/js/app.js') }}"></script>

@push('scripts')
    <script>
        $(function () {
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('plan.anyData') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'call_minutes', name: 'call_minutes'},
                    {data: 'is_active', name: 'is_active'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
        $(document).ready(function(){
            deletePlan();
        });
    </script>
@endpush


