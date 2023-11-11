@extends('layouts.dashboard.master')

@section('page_header')
    <li class="breadcrumb-item">
        <a href="{{url('admin/home')}}" class="text-muted">@lang('admin/dashboard.home')</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{url('admin/reservations')}}" class="text-muted">@lang('admin/dashboard.reservations')</a>
    </li>
    <li class="breadcrumb-item">
        <a href="" class="text-muted">@lang('admin/dashboard.edit_reservations')</a>
    </li>
@endsection
@section('content')

    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-custom gutter-b ">
                        <div class="card-header">
                            <h3 class="card-title">@lang('admin/dashboard.edit_reservations')</h3>
                            <div class="card-toolbar">
                                <a href="{{route('admin.reservations.index')}}"
                                   class="btn btn-primary ">
                                    <i class="flaticon2-reply-1"
                                       style="font-size: 1rem;"></i> @lang('admin/dashboard.back')
                                </a>
                            </div>
                        </div>
                        <form novalidate="novalidate" class="form form-label-right" method="post"
                              action="{{ route('admin.reservations.update',$reservation->id) }}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group validated">
                                            <label>@lang('admin/dashboard.name') </label> <span
                                                class="text-danger"> *</span>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="la la-exclamation-triangle flaticon-user"></i>
                                            </span>
                                                </div>
                                                <input type="text" name="full_name" value="{{$reservation->full_name}}"
                                                       class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                       placeholder="@lang('admin/dashboard.enter') @lang('admin/dashboard.name') "
                                                       aria-describedby="basic-addon1"
                                                />
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->has('full_name') ? $errors->first('full_name') : '' }}</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group validated">
                                            <label>@lang('admin/dashboard.date') </label> <span
                                                class="text-danger"> *</span>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="flaticon-calendar-with-a-clock-time-tools"></i>
                                            </span>
                                                </div>
                                                <input type="date" name="date" value="{{$reservation->date}}"
                                                       class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}"
                                                       placeholder="@lang('admin/dashboard.enter') @lang('admin/dashboard.date') "
                                                       aria-describedby="basic-addon1"
                                                />
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->has('date') ? $errors->first('date') : '' }}</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group validated">
                                            <label>@lang('admin/dashboard.start_time')</label> <span
                                                class="text-danger"> *</span>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="la la-exclamation-triangle flaticon-envelope"></i>
                                                    </span>
                                                </div>
                                                <input type="time" name="start_time"
                                                       value="{{$reservation->start_time}}"
                                                       autocomplete="off"
                                                       class="form-control {{ $errors->has('start_time') ? 'is-invalid' : '' }}"
                                                       placeholder="@lang('admin/dashboard.enter') @lang('admin/dashboard.start_time')"
                                                       aria-describedby="basic-addon1">
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->has('start_time') ? $errors->first('start_time') : '' }}</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group validated">
                                            <label>@lang('admin/dashboard.end_time')</label> <span class="text-danger"> *</span>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="la la-exclamation-triangle flaticon-envelope"></i>
                                                    </span>
                                                </div>
                                                <input type="time" name="end_time" value="{{$reservation->end_time}}"
                                                       autocomplete="off"
                                                       class="form-control {{ $errors->has('end_time') ? 'is-invalid' : '' }}"
                                                       placeholder="@lang('admin/dashboard.enter') @lang('admin/dashboard.end_time')"
                                                       aria-describedby="basic-addon1">
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->has('end_time') ? $errors->first('end_time') : '' }}</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>@lang("admin/dashboard.day")</label>
                                            <span class="text-danger"> *</span>
                                            <select class="form-control select2" name="day_id">
                                                @foreach($days as $day)
                                                    <option value="{{$day->id}}"
                                                        {{ $day->id == $reservation->day_id ? 'selected' : '' }}>
                                                        {{$day->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="text-danger"
                                                 style="margin-right: 6px !important; margin-top: 11px; ">
                                                <strong>{{ $errors->has('communication_id') ? $errors->first('communication_id') : '' }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>@lang("admin/dashboard.duration")</label><span class="text-danger"> *</span>
                                            <select class="form-control select2" name="duration_id">
                                                @foreach($durations as $duration)
                                                    <option value="{{$duration->id}}"
                                                        {{ $duration->id == $reservation->duration_id ? 'selected' : '' }}>
                                                        {{$duration->duration}} @lang('admin/dashboard.minute')
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="text-danger"
                                                 style="margin-right: 6px !important; margin-top: 11px; ">
                                                <strong>{{ $errors->has('duration_id') ? $errors->first('duration_id') : '' }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group validated">
                                            <label>@lang('admin/dashboard.price')</label> <span
                                                class="text-danger"> *</span>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="la la-exclamation-triangle la la-mobile"></i>
                                                    </span>
                                                </div>
                                                <input name="price" type="number" value="{{$reservation->price}}"
                                                       class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}"
                                                       placeholder="@lang('admin/dashboard.enter') @lang('admin/dashboard.price')"
                                                       aria-describedby="basic-addon1">
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->has('price') ? $errors->first('price') : '' }}</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>@lang("admin/dashboard.communication")</label>
                                            <span class="text-danger"> *</span>
                                            <select class="form-control select2" name="communication_id">
                                                @foreach($communications as $communication)
                                                    <option value="{{$communication->id}}"
                                                        {{ $communication->id == $reservation->communication_id ? 'selected' : '' }}>
                                                        {{$communication->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="text-danger"
                                                 style="margin-right: 6px !important; margin-top: 11px; ">
                                                <strong>{{ $errors->has('communication_id') ? $errors->first('communication_id') : '' }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>@lang("admin/dashboard.payment_method")</label>
                                            <span class="text-danger"> *</span>
                                            <select class="form-control select2" name="payment_id">
                                                @foreach($payments as $payment)
                                                    <option value="{{$payment->id}}"
                                                        {{ $payment->id == $reservation->payment_id ? 'selected' : '' }}>
                                                        {{$payment->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="text-danger"
                                                 style="margin-right: 6px !important; margin-top: 11px; ">
                                                <strong>{{ $errors->has('payment_id') ? $errors->first('payment_id') : '' }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>@lang("admin/dashboard.gender")</label>
                                            <span class="text-danger"> *</span>
                                            <select class="form-control select2" name="gender">
                                                <option value="0"
                                                    {{$reservation->gender == '0' ?? 'selected' }}>
                                                    Male
                                                </option>
                                                <option value="1"
                                                    {{$reservation->gender == '1' ?? 'selected' }}>
                                                    Female
                                                </option>
                                            </select>
                                            <div class="text-danger"
                                                 style="margin-right: 6px !important; margin-top: 11px; ">
                                                <strong>{{ $errors->has('gender') ? $errors->first('gender') : '' }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group validated">
                                            <label>@lang('admin/dashboard.age')</label> <span
                                                class="text-danger"> *</span>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="la la-exclamation-triangle la la-mobile"></i>
                                                    </span>
                                                </div>
                                                <input name="age" type="number" value="{{$reservation->age}}"
                                                       class="form-control {{ $errors->has('age') ? 'is-invalid' : '' }}"
                                                       placeholder="@lang('admin/dashboard.enter') @lang('admin/dashboard.age')"
                                                       aria-describedby="basic-addon1">
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->has('age') ? $errors->first('age') : '' }}</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group validated">
                                            <label>@lang('admin/dashboard.problem') </label> <span class="text-danger"> *</span>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="la la-exclamation-triangle flaticon-user"></i>
                                            </span>
                                                </div>
                                                <input type="text" name="problem" value="{{$reservation->problem}}"
                                                       class="form-control {{ $errors->has('problem') ? 'is-invalid' : '' }}"
                                                       placeholder="@lang('admin/dashboard.enter') @lang('admin/dashboard.problem') "
                                                       aria-describedby="basic-addon1"
                                                />
                                                <div class="invalid-feedback">
                                                    <strong>{{ $errors->has('problem') ? $errors->first('problem') : '' }}</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>@lang("admin/dashboard.is_start")</label>
                                            <span class="text-danger"> *</span>
                                            <select class="form-control select2" name="is_start">
                                                <option value="0"
                                                    {{ $reservation->is_start == '0' ?? 'selected'}}>
                                                    @lang('admin/dashboard.no')
                                                </option>
                                                <option value="1"
                                                    {{ $reservation->is_start == '1' ?? 'selected'}}>
                                                    @lang('admin/dashboard.yes')
                                                </option>
                                            </select>
                                            <div class="text-danger"
                                                 style="margin-right: 6px !important; margin-top: 11px; ">
                                                <strong>{{ $errors->has('is_start') ? $errors->first('is_start') : '' }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>@lang("admin/dashboard.is_end")</label>
                                            <span class="text-danger"> *</span>
                                            <select class="form-control select2" name="is_end">
                                                <option value="0"
                                                    {{ $reservation->is_end == '0' ?? 'selected'}}>
                                                    @lang('admin/dashboard.no')
                                                </option>
                                                <option value="1"
                                                    {{ $reservation->is_end == '1' ?? 'selected'}}>
                                                    @lang('admin/dashboard.yes')
                                                </option>
                                            </select>
                                            <div class="text-danger"
                                                 style="margin-right: 6px !important; margin-top: 11px; ">
                                                <strong>{{ $errors->has('is_end') ? $errors->first('is_end') : '' }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>@lang("admin/dashboard.status")</label>
                                            <span class="text-danger"> *</span>
                                            <select class="form-control select2" name="status">
                                                <option value="-1"
                                                    {{ $reservation->status == '-1' ?? 'selected'}}>
                                                    @lang('admin/dashboard.pending')
                                                </option>
                                                <option value="0"
                                                    {{ $reservation->status == '0' ?? 'selected'}}>
                                                    @lang('admin/dashboard.canceled')
                                                </option>
                                                <option value="1"
                                                    {{ $reservation->status == '1' ?? 'selected'}}>
                                                    @lang('admin/dashboard.upcoming')
                                                </option>
                                            </select>
                                            <div class="text-danger"
                                                 style="margin-right: 6px !important; margin-top: 11px; ">
                                                <strong>{{ $errors->has('status') ? $errors->first('status') : '' }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">@lang('admin/dashboard.submit')</button>
                                <button type="reset" class="btn btn-secondary">@lang('admin/dashboard.cancel')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
