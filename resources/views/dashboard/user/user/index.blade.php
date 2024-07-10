@extends('layouts.dashboard.master')

@section('page_header')
    <li class="breadcrumb-item">
        <a href="{{route('admin.index')}}" class="text-muted">{{__('admin/dashboard.home')}}</a>
    </li>
    <li class="breadcrumb-item">
        <a href="" class="text-muted">@lang('admin/dashboard.customers')</a>
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
                        <h3 class="card-label"> @lang('admin/dashboard.customers')</h3>
                    </div>
                    <div class="card-toolbar">
                    </div>
                </div>
                <div class="card-body">
                    <table class="table-bordered table-hover table" id="dataTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('admin/dashboard.name')</th>
                            <th>@lang('admin/dashboard.email')</th>
                            <th>@lang('admin/dashboard.phone')</th>
                            <th>@lang('admin/dashboard.country')</th>
                            <th>@lang('admin/dashboard.created_at')</th>
                            <th>@lang('admin/dashboard.action')</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if(!empty($users->first()))
{{--                            @dd($users)--}}
                            @foreach($users as $index => $user)
                                <tr id="row-{{$user->id}}">
                                    <td>{{$index + 1}}</td>
                                    <td>{{ $user->full_name ?? '---'}}</td>
                                    <td>{{ $user->email ?? '---'}}</td>
                                    <td class="bold"> {{ $user->phone_no ?? '---'}}</td>
                                    <td>{{ $user->country->name ?? '---'}}</td>
                                    <td class="number">{{ dateFormat($user->created_at,'Y/M/d') ?? '---' }}</td>
                                    <td class="dt_action_btn_cont text-center">

                                        <a
                                            href="{{route('admin.customers.show',$user->id)}}"
                                            class="btn btn-sm btn-clean btn-icon btn-icon-md btn-primary"
                                            title="{{__('admin/dashboard.show')}}">
                                            <i class="flaticon-eye "></i>
                                        </a>


                                        <a class="btn btn-sm btn-clean btn-icon btn-icon-md delete-button btn-danger"
                                           title="{{__('admin/dashboard.delete')}}" data-toggle="modal"
                                           onclick="javascript:$('#delete_modal').modal('show');"
                                           data-target="#delete_modal"
                                           data-url="{{route('admin.customers.destroy',$user->id)}}"
                                           data-item-id="{{$user->id}}">
                                            <i class="flaticon2-trash "></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <div class="pagination-cont">
                        <div class="d-flex flex-wrap py-2 mr-3 justify-content-center">
                            {{$users->links("pagination::bootstrap-4")}}
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
{{--@push('js')--}}
{{--    <script>--}}
{{--        $(document).ready(function () {--}}

{{--            $(document).on('click', '.btn_status', function () {--}}
{{--                let user_id = $(this).data("user_id");--}}
{{--                let status_change = $(this).data("status_change");--}}
{{--                let url = $(this).data("url");--}}
{{--                let method = $(this).data("method");--}}

{{--                /***** get Current stauts of Provider ****/--}}
{{--                if ($(this).text().replace(/\s+/g, '') === $("#user_status" + user_id + "").text().replace(/\s+/g, '')) {--}}
{{--                    return true;--}}
{{--                }--}}
{{--                /***** get Current stauts of Provider ****/--}}

{{--                $("#user_status" + user_id + "").empty();--}}
{{--                $("#loading_status" + user_id + "").css({'top': '-2px !important', 'display': 'flex'});--}}

{{--                $.ajax({--}}
{{--                    url: url,--}}
{{--                    method: method,--}}
{{--                    data: {--}}
{{--                        status: status_change,--}}
{{--                        user_id: user_id,--}}
{{--                        _token: $('meta[name="csrf-token"]').attr('content')--}}
{{--                    },--}}
{{--                    success: function (data) {--}}
{{--                        $("#loading_status" + user_id + "").css('display', 'none');--}}
{{--                        $("#user_status" + user_id + "").html(data);--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--@endpush--}}

