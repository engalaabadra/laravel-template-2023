
@extends('admin.layouts.master')
@section('page')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ trans('Edit town') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.towns.update',$town->id) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="{{$town->id}}">

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ trans('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $town->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="code" class="col-md-4 col-form-label text-md-right">{{ trans('code') }}</label>

                            <div class="col-md-6">
                                <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') ?? $town->code }}" required autocomplete="code" autofocus>

                                @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">{{ trans('country') }}</label>

                            <div class="col-md-6">
                                 <select class="custom-select my-select"  name="country">
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}"  {{ $country->id === $town->city->country->id ? 'selected' : '' }}  >{{$country->name}}</option>
                                    @endforeach
                                  </select>
                                @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ trans('city') }}</label>

                            <div class="col-md-6">
                                 <select class="custom-select my-select"  name="city">
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}"  {{ $city->id === $cityTown->id ? 'selected' : '' }}  >{{$city->name}}</option>
                                    @endforeach
                                  </select>
                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="active" class="col-md-4 col-form-label text-md-right">{{ trans('Status') }}</label>
                            <div class="col-md-6">
                                <select class="custom-select my-select" name="active">
                                    @foreach($activees as $active)
                                        <option value="{{$active}}"  @if($active==$town->active) selected @endif>
                                            @if($active==0)
                                                InActive
                                            @else
                                                Active
                                            @endif
                                        </option>
                                        @endforeach
                                    </select>
                                @error('active')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="mb-0 form-group row">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ trans('Edit') }}
                                </button>

                             
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> 
    
</div>
<script>
    $(document).ready(function(){
              var multipleCancelButton = new Choices('#choices-multiple-remove-button-in-edit', {
              removeItemButton: true,
              maxItemCount:5,
              searchResultLimit:5,
              renderChoiceLimit:5
              });
          });
   </script>
@stop