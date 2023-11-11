@extends('layouts.dashboard.master')
@section('page_header')
    <li class="breadcrumb-item">
        <a href="{{route('admin.index')}}" class="text-muted">{{__('admin/dashboard.home')}}</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{route('admin.reservations.index')}}" class="text-muted">@lang('admin/dashboard.reservations')</a>
    </li>
    <li class="breadcrumb-item">
        <a href="" class="text-muted">@lang('admin/dashboard.view')</a>
    </li>
@endsection
@section('content')
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6">
                    <!--begin::Base Table Widget 5-->
                    <div class="card card-custom card-stretch gutter-b">
                        <!--begin::Header-->
                        <div class="card-header font-weight-bold border-0 pt-5 justify-content-center h2">
                                @lang('admin/dashboard.user_data')
                        </div>
                        <!--end::Header-->

                        <!--begin::Body-->
                        <div class="card-body pt-2 pb-0 mt-n3">
                            <div class="tab-content mt-5">
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade active show">
                                    <!--begin::Table-->
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-vertical-center">
                                            <thead>
                                            <tr>
                                                <th class="p-0 w-50px"></th>
                                                <th class="p-0 min-w-150px"></th>
                                                <th class="p-0 min-w-100px"></th>
                                                <th class="p-0 min-w-110px"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="pl-0 py-5">
                                                    <div class="symbol symbol-50 symbol-light mr-2">
                                                        <span class="symbol-label">
                                                            <img src="{{$patient->image ? url($patient->image->url) : resolvePhoto()}}" class="h-50 align-self-center" alt="">
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$patient->full_name}}</a>
                                                    <span class="text-muted font-weight-bold d-block">{{ltrim($patient->country->phone_code, '+')."-".$patient->phone_no}}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-muted font-weight-500 font-size-h3">
                                                        {{$reservation->age}} @lang('admin/dashboard.years')
                                                    </span>
                                                </td>
                                                <td class="text-right">
                                                    <span class="label label-lg label-light-{{$reservation->gender == 0 ? "primary" : "danger"}} label-inline">{{$reservation->gender == 0 ? "Male" : "Female"}}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="pl-0 py-5">
                                                    <div class="symbol symbol-50 symbol-light mr-2">
                                                        <span class="symbol-label">
                                                            <img src="{{ $doctor->image ? url($doctor->image->url) : resolvePhoto()}}" class="h-50 align-self-center" alt="">
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$doctor->full_name}}</a>
                                                    <span class="text-muted font-weight-bold d-block">{{ltrim($doctor->country->phone_code, '+')."-".$doctor->phone_no}}</span>
                                                </td>
                                                <td class="text-center">
                                                    @foreach($doctor->specialties as $specialist)
                                                        <span class="text-muted font-weight-500 font-size-h3">
                                                        {{$specialist->name}}
                                                    </span>
                                                    @endforeach

                                                </td>
                                                <td class="text-right">
                                                    <span class="label label-lg label-light-success label-inline">{{$doctor->nick_name ?? '---'}}</span>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--end::Table-->
                                </div>
                                <!--end::Tap pane-->
                            </div>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Base Table Widget 5-->
                </div>
                <div class="col-xl-6">
                    <!--begin::Base Table Widget 5-->
                    <div class="card card-custom card-stretch gutter-b">
                        <!--begin::Header-->
                        <div class="card-header font-weight-bold border-0 pt-5 justify-content-center h2">
                                @lang('admin/dashboard.reservation_data')
                        </div>
                        <!--end::Header-->

                        <!--begin::Body-->
                        <div class="card-body pt-2 pb-0 mt-n3">
                            <div class="tab-content mt-5">
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade active show">
                                    <!--begin::Table-->
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-vertical-center">
                                            <thead>
                                            <tr>
                                                <th class="p-0 min-w-100px"></th>
                                                <th class="p-0 min-w-100px"></th>
                                                <th class="p-0 min-w-100px"></th>
                                                <th class="p-0 min-w-100px"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="pl-0 py-5">
                                                    <div class="symbol symbol-50 symbol-light mr-2">
                                                        <span class="symbol-label">
                                                            {{$reservation->id}}#
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark font-weight-bolder  mb-1 font-size-lg">@lang('admin/dashboard.reservation_date')</a>
                                                    <span class="text-muted font-weight-bold d-block">{{$reservation->date}}</span>
                                                </td>
                                                <td class="text-center">
                                                    <a href="#" class="text-dark font-weight-bolder  mb-1 font-size-lg d-block">@lang('admin/dashboard.reservation_status')</a>
                                                @if($reservation->status == -1)
                                                        <span
                                                            class="label label-lg font-weight-bold label-light-primary label-inline">Pending</span>
                                                    @elseif($reservation->status == 0)
                                                        <span
                                                            class="label label-lg font-weight-bold label-light-danger label-inline">Canceled</span>
                                                    @else
                                                        <span
                                                            class="label label-lg font-weight-bold label-light-success label-inline">Upcoming</span>
                                                    @endif

                                                </td>
                                                <td class="text-right">
                                                    <a href="#" class="text-dark font-weight-bolder  mb-1 font-size-lg d-block">@lang('admin/dashboard.reservation_duration')</a>
                                                    <span class="label label-lg label-light-warning label-inline">{{$reservation->duration->duration ?? '---'}} @lang('admin/dashboard.minute')</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark font-weight-bolder  mb-1 font-size-lg">@lang('admin/dashboard.reservation_price')</a>
                                                    <span class="text-muted font-weight-bold d-block">{{number_format(($reservation->price * 0.75),2) }} </span>
                                                </td>

                                                <td class="text-center">
                                                    <a href="#" class="text-dark font-weight-bolder  mb-1 font-size-lg d-block">@lang('admin/dashboard.start_time')</a>
                                                    <span class="label label-lg label-light-warning label-inline">{{$reservation->start_time ?? '---'}} </span>
                                                </td>
                                                <td class="text-center">
                                                    <a href="#" class="text-dark font-weight-bolder  mb-1 font-size-lg d-block">@lang('admin/dashboard.end_time')</a>
                                                    <span class="label label-lg label-light-warning label-inline">{{$reservation->end_time ?? '---'}}</span>
                                                </td>
                                                <td class="text-right">
                                                    <a href="#" class="text-dark font-weight-bolder  mb-1 font-size-lg d-block">@lang('admin/dashboard.communication')</a>
                                                    <span class="text-muted font-weight-bold d-block">{{$reservation->communication->name}} </span>

                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--end::Table-->
                                </div>
                                <!--end::Tap pane-->
                            </div>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Base Table Widget 5-->
                </div>
                <div class="col-xl-6">
                    <!--begin::Base Table Widget 5-->
                    <div class="card card-custom card-stretch gutter-b">
                        <!--begin::Header-->
                        <div class="card-header font-weight-bold border-0 pt-5 justify-content-center h2">
                                @lang('admin/dashboard.payments_notes')
                        </div>
                        <!--end::Header-->

                        <!--begin::Body-->
                        <div class="card-body pt-2 pb-0 mt-n3">
                            <div class="tab-content mt-5">
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade active show">
                                    <!--begin::Table-->
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-vertical-center">
                                            <thead>
                                            <tr>
                                                <th class="p-0 min-w-100px"></th>
                                                <th class="p-0 min-w-100px"></th>
                                                <th class="p-0 min-w-100px"></th>
                                                <th class="p-0 min-w-100px"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark font-weight-bolder  mb-1 font-size-lg">@lang('admin/dashboard.problem')</a>
                                                    <span class="text-muted font-weight-bold d-block">{{$reservation->problem ?? '---'}} </span>
                                                </td>

                                                <td class="text-center">
                                                    <a href="#" class="text-dark font-weight-bolder  mb-1 font-size-lg d-block">@lang('admin/dashboard.report')</a>
                                                    <span class="text-muted font-weight-bold">{{$reservation->report ?? '---'}} </span>
                                                </td>
                                                <td class="text-center">
                                                    <a href="#" class="text-dark font-weight-bolder  mb-1 font-size-lg d-block">@lang('admin/dashboard.message')</a>
                                                    <span class="text-muted font-weight-bold">{{$reservation->message ?? '---'}}</span>
                                                </td>
                                                <td class="text-center">
                                                    <a href="#" class="text-dark font-weight-bolder  mb-1 font-size-lg d-block">@lang('admin/dashboard.notes')</a>
                                                    <span class="text-muted font-weight-bold d-block">{{$reservation->notes ?? '---'}} </span>

                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="pl-0">
                                                    <a href="#" class="text-dark font-weight-bolder  mb-1 font-size-lg">@lang('admin/dashboard.payment')</a>
                                                    <span class="text-muted font-weight-bold d-block">{{$reservation->payment->name ?? '---'}} </span>
                                                </td>

                                                <td class="text-center">
                                                    <a href="#" class="text-dark font-weight-bolder  mb-1 font-size-lg d-block">@lang('admin/dashboard.cancel')</a>
                                                    <span class="text-muted font-weight-bold">{{$reservation->reasonCancelation->reason ?? '---'}} </span>
                                                </td>
                                                <td class="text-center">
                                                    <a href="#" class="text-dark font-weight-bolder  mb-1 font-size-lg d-block">@lang('admin/dashboard.reschedule')</a>
                                                    <span class="text-muted font-weight-bold">{{$reservation->reasonRescheduling->reason ?? '---'}}</span>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <!--end::Table-->
                                </div>
                                <!--end::Tap pane-->
                            </div>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Base Table Widget 5-->
                </div>
                <div class="col-xl-6">
                    <!--begin::Base Table Widget 5-->
                    <div class="card card-custom card-stretch gutter-b">
                        <!--begin::Header-->
                        <div class="card-header font-weight-bold border-0 pt-5 justify-content-center h2">
                                @lang('admin/dashboard.prescriptions')
                        </div>
                        <!--end::Header-->

                        <!--begin::Body-->
                        <div class="card-body pt-2 pb-0 mt-n3">
                            <div class="tab-content mt-5">
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade active show">
                                    <!--begin::Table-->
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-vertical-center">
                                            <thead>
                                            <tr>
                                                <th class="p-0 min-w-100px"></th>
                                                <th class="p-0 min-w-100px"></th>
                                                <th class="p-0 min-w-100px"></th>
                                                <th class="p-0 min-w-100px"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($reservation->prescriptions as $prescription)

                                                <tr>
                                                    <td class="text-center">
                                                        <a href="#" class="text-dark font-weight-bolder  mb-1 font-size-lg d-block">@lang('admin/dashboard.name')</a>
                                                        <span class="text-muted font-weight-bold">{{$prescription->name ?? '---'}} </span>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="#" class="text-dark font-weight-bolder  mb-1 font-size-lg d-block">@lang('admin/dashboard.dose')</a>
                                                        <span class="text-muted font-weight-bold">{{$prescription->dose  ?? '---'}}</span>
                                                    </td>
                                                    <td class="text-right">
                                                        <a href="#" class="text-dark font-weight-bolder  mb-1 font-size-lg d-block">@lang('admin/dashboard.frequency')</a>
                                                        <span class="text-muted font-weight-bold d-block">{{$prescription->frequency  ?? '---'}} </span>

                                                    </td>
                                                    <td class="text-right">
                                                        <a href="#" class="text-dark font-weight-bolder  mb-1 font-size-lg d-block">@lang('admin/dashboard.duration')</a>
                                                        <span class="text-muted font-weight-bold d-block">{{$prescription->duration  ?? '---'}} </span>

                                                    </td>
                                                    <td class="text-right">
                                                        <a href="#" class="text-dark font-weight-bolder  mb-1 font-size-lg d-block">@lang('admin/dashboard.instruction')</a>
                                                        <span class="text-muted font-weight-bold d-block">{{$prescription->instruction  ?? '---'}} </span>

                                                    </td>
                                                </tr>
                                            @empty
                                                <div class="font-weight-bold h2">@lang('admin/dashboard.no_data_found')</div>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--end::Table-->
                                </div>
                                <!--end::Tap pane-->
                            </div>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Base Table Widget 5-->
                </div>
                <div class="col-xl-4">
                    <!--begin::Base Table Widget 5-->
                    <div class="card card-custom card-stretch gutter-b">
                        <!--begin::Header-->
                        <div class="card-header font-weight-bold border-0 pt-5 justify-content-center h2">
                                @lang('admin/dashboard.reviews')
                        </div>
                        <!--end::Header-->

                        <!--begin::Body-->
                        <div class="card-body pt-2 pb-0 mt-n3">
                            <div class="tab-content mt-5">
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade active show">
                                    <!--begin::Table-->
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-vertical-center">
                                            <thead>
                                            <tr>
                                                <th class="p-0 min-w-100px"></th>
                                                <th class="p-0 min-w-100px"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">
                                                        <a href="#" class="text-dark font-weight-bolder  mb-1 font-size-lg d-block">@lang('admin/dashboard.rating')</a>
                                                        <span class="label label-lg font-weight-bold label-light-primary label-inline">{{$reservation->review->rating ?? '---'}} </span>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="#" class="text-dark font-weight-bolder  mb-1 font-size-lg d-block">@lang('admin/dashboard.description')</a>
                                                        <span class="text-muted font-weight-bold">{{$reservation->review->description  ?? '---'}}</span>
                                                    </td>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--end::Table-->
                                </div>
                                <!--end::Tap pane-->
                            </div>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Base Table Widget 5-->
                </div>
                @if($reservation->created_by == 'admin')
                    <div class="col-xl-4">
                        <!--begin::Base Table Widget 5-->
                        <div class="card card-custom card-stretch gutter-b">
                            <!--begin::Header-->
                            <div class="card-header font-weight-bold border-0 pt-5 justify-content-center h2">
                                @lang('admin/dashboard.created_by') @lang('admin/dashboard.admin')
                            </div>
                            <!--end::Header-->

                            <!--begin::Body-->
                            <div class="card-body pt-2 pb-0 mt-n3">
                                <div class="tab-content mt-5">
                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade active show">
                                        <!--begin::Table-->
                                        <div class="table-responsive">
                                            <table class="table table-borderless table-vertical-center">
                                                <thead>
                                                <tr>
                                                    <th class="p-0 min-w-100px"></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td class="text-center">
                                                        <a href="{{Storage::url($reservation->finance_attach)}}" target="_blank" class="text-danger font-weight-bolder  mb-1 font-size-lg d-block">@lang('admin/dashboard.click_here_to_view_finance_attach') <i class="flaticon-upload text-danger font-size-h3"></i></a>
                                                    </td>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Tap pane-->
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Base Table Widget 5-->
                    </div>
                @endif

            </div>
        </div> {{--end containe fluied--}}
    </div>
@endsection

