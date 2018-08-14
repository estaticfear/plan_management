@extends('layouts.app')
@section('content')
    <div class="container py-5">
        <section class="page-title">
            <div class="auto-container">
                <h1>{{ __('Plan Details') }}</h1>
            </div>
        </section>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Name:</label>
                    <p>{{ $plan->name }}</p>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>Call Minutes:</label>
                    <p>{{ $plan->call_minutes }}</p>
                </div>
            </div>
            <div class="col">
                <label>Status:</label>
                <p>{{ ($plan->is_active) ? 'Enable' : 'Disable'  }}</p>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <h2>Plan Options</h2>
                <table class="table table-striped" id="plan-options">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (!empty($planOptions))
                        @foreach ($planOptions as $option)
                            <tr>
                                <td>{{ $option['value'] }}></td>
                                <td>{{ $option['position'] }}</td>
                                <td>{{ ($option['is_active']) ? 'Enable' : 'Disable' }}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
