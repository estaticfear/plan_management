@extends('layouts.app')
@section('content')
    <div class="container py-5">
        <section class="page-title">
            <div class="auto-container">
                <h1>{{ __('Create Plan') }}</h1>
            </div>
        </section>
        {!! Form::open(['method' => 'POST','route'=>['plans.store'], 'autocomplete' => 'off', 'class' => 'form-horizontal formValidate', 'id' => 'plan-form'])  !!}
        <div class="row">
            <div class="col-12 col-sm-4">
                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                    {!! Form::label('name', null, ['class' => 'control-label required']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'required', 'autofocus', 'data-rule-required' => 'true']) !!}
                    @if ($errors->has('name'))
                        <div class="error-message">{{ $errors->first('name') }}</div>
                    @endif
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <div class="form-group{{ $errors->has('call_minutes') ? ' has-danger' : '' }}">
                    {!! Form::label('call_minutes', null, ['class' => 'control-label required']) !!}
                    {!! Form::number('call_minutes', null, ['class' => 'form-control', 'required', 'data-rule-required' => 'true']) !!}
                    @if ($errors->has('call_minutes'))
                        <div class="error-message">{{ $errors->first('call_minutes') }}</div>
                    @endif
                </div>
            </div>
            <div class="col">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="is_active_checkbox form-check-input" type="checkbox">Is Active
                        <input name="is_active" class="is_active" type="hidden" value="1">
                    </label>
                </div>
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
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><input type="text" class="form-control" name="option[value][]"></td>
                        <td><input type="number" class="form-control" name="option[position][]" value="0"></td>
                        <td>
                            <input type="checkbox" class="is_active_checkbox" checked>
                            <input type="hidden" class="is_active" name="option[is_active][]" value="1">
                        </td>
                        <td><button type="button" class="btn btn-danger delete-button">Delete</button</td>
                    </tr>
                    </tbody>
                </table>
                <div class="float-right">
                    <button type="button" id="add-more" class="btn btn-block btn-lg">Add More</button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-primary btn-md">Save</button>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
@endsection

<script src="{{ asset('vendor/laravel-plan-management/js/app.js') }}"></script>

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            scripts();
        });
    </script>
@endpush
