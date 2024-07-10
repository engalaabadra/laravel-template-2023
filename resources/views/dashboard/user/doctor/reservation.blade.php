@extends('layouts.dashboard.master')

@push('css')
    <style>
        .home_filter {
            background: #fff !important;
        }

        .home_filter.active {
            color: #fff !important;
            background-color: #1bc5bd !important;
        }
    </style>
@endpush

@section('content')
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b">
                        <div class="card-header flex-wrap py-3">
                            <div class="card-title">
                                <h3 class="card-label">
                                    <span class="card-label font-weight-bolder text-dark">@lang('admin/dashboard.trips') ({{$user->trips()->count()}})</span>
                                </h3>
                            </div>
                            <div class="card-toolbar">

                                <!--begin::Button-->
                                <a href="{{route('admin.users.show',$user->id)}}"
                                   class="btn btn-primary">
                                    <i class="la la-eye"></i>@lang('admin/dashboard.orders')</a>
                                <!--end::Button-->
                            </div>
                        </div>
                        <div class="card-body">

                            <!--begin: Datatable-->
                            <table class="table-bordered table-hover table" id="datatable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('admin/dashboard.customer_name')</th>
                                    <th>@lang('admin/dashboard.from_location')</th>
                                    <th>@lang('admin/dashboard.to_location')</th>
                                    <th>@lang('admin/dashboard.trip_status')</th>
                                    <th>@lang('admin/dashboard.payment_status')</th>
                                    <th>@lang('admin/dashboard.payment_method')</th>
                                    <th>@lang('admin/dashboard.price')</th>
                                    <th>@lang('admin/dashboard.created_at')</th>
                                </tr>
                                </thead>
                                <tbody>


                                @foreach ($user->trips as $index => $trip)

                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $user->full_name }}</td>
                                        <td>{{ $trip->from_location }}</td>
                                        <td>{{ $trip->to_location }}</td>
                                        <td>{{ $trip->status }}</td>
                                        <td>{{ $trip->payment_status }}</td>
                                        <td>{{ $trip->payment_with }}</td>
                                        <td>{{ $trip->total }}</td>
                                        <td>{{ dateFormat($trip->updated_at) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>


                            </table>

                            <!--end: Datatable-->
                        </div>
                    </div>
                    <!--end::Card-->
                </div>
            </div>
        </div>
    </div>
@endsection


