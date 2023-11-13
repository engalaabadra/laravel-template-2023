@extends('layouts.dashboard.master')
@section('page_header')
    <li class="breadcrumb-item">
        <a href="{{route('admin.index')}}" class="text-muted">{{__('admin/dashboard.home')}}</a>
    </li>
    <li class="breadcrumb-item">
        <a href="" class="text-muted">@lang('admin/dashboard.reservations')</a>
    </li>
@endsection
@section('content')
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card card-custom">
                        <div class="card-header flex-wrap border-0 pt-6 pb-0">
                            <div class="card-title">
                                <h3 class="card-label"> @lang('admin/dashboard.reservations')</h3>
                            </div>
                            <div class="card-toolbar">
                                <a href="{{route('admin.reservations.create')}}" class="btn btn-primary"><i class="la la-plus"></i>@lang('admin/dashboard.create_reservation')</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table-bordered table-hover table" id="dataTable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('admin/dashboard.doctor_name')</th>
                                    <th>@lang('admin/dashboard.patient_name')</th>
                                    <th>@lang('admin/dashboard.name')</th>
                                    <th>@lang('admin/dashboard.start_time')</th>
                                    <th>@lang('admin/dashboard.end_time')</th>
                                    <th>@lang('admin/dashboard.communication')</th>
                                    <th>@lang('admin/dashboard.gender')</th>
                                    <th>@lang('admin/dashboard.age')</th>
                                    <th>@lang('admin/dashboard.price')</th>
                                    <th>@lang('admin/dashboard.status')</th>
                                    <th>@lang('admin/dashboard.created_by')</th>
                                    <th>@lang('admin/dashboard.created_at')</th>
                                    <th>@lang('admin/dashboard.action')</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(!empty($reservations->first()))
                                    {{--                            @dd($reservations)--}}
                                    @foreach($reservations as $index => $reservation)
                                        <tr id="row-{{$reservation->id}}">
                                            <td>{{$reservation->id}}</td>
                                            <td>{{ $reservation->doctor->full_name ?? '---'}}</td>
                                            <td>{{ $reservation->full_name ?? '---'}}</td>
                                            <td>{{ $reservation->user->full_name ?? '---'}}</td>
                                            <td>{{timeFormat($reservation->start_time)  ?? '---'}}</td>
                                            <td>{{timeFormat($reservation->end_time)  ?? '---'}}</td>
                                            <td>{{ $reservation->communication->name ?? '---'}}</td>
                                            <td><span
                                                    class="font-weight-bold text-{{ $reservation->gender == 0 ? 'primary' : 'danger'}}">{{ $reservation->gender == 0 ? 'Male' : 'Female'}}</span>
                                            </td>
                                            <td>{{ $reservation->age ?? '---'}}</td>
                                            <td>{{ $reservation->price ?? '---'}}</td>
                                            <td>
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
                                            <td class="number">{{ dateFormat($reservation->created_at,'Y-M-d') ?? '---' }}</td>
                                            <td>
                                                @if($reservation->created_by == 'admin')
                                                    <span class="label label-lg font-weight-bold label-light-danger label-inline">Admin</span>
                                                @else
                                                    <span class="label label-lg font-weight-bold label-light-primary label-inline">Patient</span>
                                                @endif

                                            </td>
                                            <td class="dt_action_btn_cont text-center">

                                                <a href="{{route('admin.reservations.show',$reservation->id)}}" class="btn btn-sm btn-clean btn-icon">
                                                    <i class="flaticon-eye"></i>
                                                </a>
                                                <a href="{{route('admin.reservations.edit',$reservation->id)}}" class="btn btn-sm btn-clean btn-icon">
                                                    <i class="flaticon-edit-1"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            <div class="pagination-cont">
                                <div class="d-flex flex-wrap py-2 mr-3 justify-content-center">
                                    {{$reservations->links("pagination::bootstrap-4")}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> {{--end containe fluied--}}
    </div>

    <!-- begin: delete modal -->
    @include('dashboard.includes.alerts.delete-modal')
    <!-- end:: delete modal -->
@endsection

