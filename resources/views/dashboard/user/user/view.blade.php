@extends('layouts.dashboard.master')


@section('content')
    <div class="content flex-column-fluid" style="margin: 0 20px" id="kt_content">
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <div class="d-flex">
                    <!--begin: Info-->
                    <div class="flex-grow-1">
                        <!--begin::Title-->
                        <div class="d-flex align-items-center justify-content-between flex-wrap">
                            <!--begin::User-->
                            <div class="mr-3">
                                <div class="d-flex align-items-center mr-3">
                                    <!--begin::Name-->
                                    <a href="#"
                                       class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">
                                        {{$user->full_name}}
                                    </a>
                                    <!--end::Name-->

                                </div>
                                <!--begin::Contacts-->
                                <div class="d-flex flex-wrap my-2">
                                    <a href="#"
                                       class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                        <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                 viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <path
                                                        d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z"
                                                        fill="#000000"/>
                                                    <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5"/>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>{{$user->email}}
                                    </a>
                                    <a href="#" class="text-muted text-hover-primary font-weight-bold">
                                        <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Map/Marker2.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                                 width="24px" height="24px" viewBox="0 0 24 24"
                                                 version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none"
                                                   fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <path
                                                        d="M9.82829464,16.6565893 C7.02541569,15.7427556 5,13.1079084 5,10 C5,6.13400675 8.13400675,3 12,3 C15.8659932,3 19,6.13400675 19,10 C19,13.1079084 16.9745843,15.7427556 14.1717054,16.6565893 L12,21 L9.82829464,16.6565893 Z M12,12 C13.1045695,12 14,11.1045695 14,10 C14,8.8954305 13.1045695,8 12,8 C10.8954305,8 10,8.8954305 10,10 C10,11.1045695 10.8954305,12 12,12 Z"
                                                        fill="#000000"/>
                                                </g>
                                            </svg>
                                        </span>
                                    </a>
                                </div>
                                <!--end::Contacts-->
                            </div>

                        </div>
                    </div>
                    <!--end::Info-->
                </div>
            </div>
        </div>
        <!--end::Card-->
        <!--begin::Row-->
        <div class="row">
            <div class="col-xl-4">

                <!--begin::Card-->
                <div class="card card-custom">
                    <!--begin::Header-->
                    <div class="card-header h-auto py-4">
                        <div class="card-title">
                            <h3 class="card-label">Personal Information</h3>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-4">
                        <div class="form-group row my-2">
                            <label class="col-4 col-form-label">Name:</label>
                            <div class="col-8">
                                <span class="form-control-plaintext font-weight-bolder">{{$user->full_name}}</span>
                            </div>
                        </div>
                        <div class="form-group row my-2">
                            <label class="col-4 col-form-label">Phone:</label>
                            <div class="col-8">
                                <span class="form-control-plaintext font-weight-bolder">{{$user->phone}}</span>
                            </div>
                        </div>
                        <div class="form-group row my-2">
                            <label class="col-4 col-form-label">Email:</label>
                            <div class="col-8">
                                <span class="form-control-plaintext font-weight-bolder">
                                    {{$user->email}}
                                </span>
                            </div>
                        </div>
                    </div>
                    <!--end::Body-->

                </div>
                <!--end::Card-->
            </div>
            <div class="col-lg-8">
                <!--begin::Advance Table Widget 3-->
                <div class="card card-custom card-stretch gutter-b">
                    <div class="card-header flex-wrap py-3">
                        <div class="card-title">
                            <h3 class="card-label">
                                <span class="card-label font-weight-bolder text-dark">@lang('admin/dashboard.orders') ({{$user->orders()->count()}})</span>
                            </h3>
                        </div>
                        <div class="card-toolbar">

                            <!--begin::Button-->
                            <a href="{{route('admin.users.trips',$user->id)}}"
                               class="btn btn-primary">
                                <i class="la la-eye"></i>@lang('admin/dashboard.trips')</a>
                            <!--end::Button-->
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table" id="datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('admin/dashboard.provider')</th>
                                <th>@lang('admin/dashboard.services_number')</th>
                                <th>@lang('admin/dashboard.total_price')</th>
                                <th>@lang('admin/dashboard.payment_method')</th>
                                <th>@lang('admin/dashboard.payment_status')</th>
                                <th>@lang('admin/dashboard.order_status')</th>
                                <th>@lang('admin/dashboard.book_date')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($user->orders->first()))
                                @foreach($user->orders as $index => $order)
                                    <tr id="row-{{$order->id}}">
                                        <td>{{$index + 1}}</td>
                                        <td>{{ \App\Models\Provider::whereId($order->provider_id)->value('full_name') ?? \App\Models\Admin::whereId($order->service->admin_id)->value('name')}}</td>
                                        <td>
                                            {{$order->services()->count()}}
                                        </td>

                                        <td>
                                            <span class="bold number"> {{number_format($order->total_price,2)}} </span>
                                        </td>
                                        <td>
                                            <span class="bold "> {{$order->payment_with}} </span>
                                        </td>
                                        <td>
                                            <span class="bold "> {{$order->payment_status}} </span>
                                        </td>
                                        <td class="bold">
                                            {{$order->status}}
                                        </td>
                                        <td>
                                            {{dateFormat($order->booked_date)}}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--end::Advance Table Widget 3-->
            </div>

        </div>
        <!--end::Row-->
    </div>
@endsection
