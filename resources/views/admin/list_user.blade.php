@extends('layouts.app')

@section('content')
<!-- BEGIN: Content-->
<!-- users list start -->
<section class="users-list-wrapper">
  <div class="users-list-table">
    <div class="card">
      <div class="card-content">
        <div class="card-body">
          <form method="post" class="form form-horizontal" action="{{route('users')}}">
            @csrf
            <div class="row form-group">
              <div class="col-md-4">
                <div class="row">

                  <div class="col-md-5">
                    <label for="accountName" class="col-form-label text-md-right">{{ __('Tài khoản') }}</label>
                  </div>
                  <div class="col-md-6">
                    <input id="accountName" type="text"
                      class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="accountName"
                      value="{{ $accountName }}" required autofocus />
                  </div>

                </div>
              </div>

              <div class="col-md-2">
                <div class="row">
                  <button type="submit" class="btn btn-primary">
                    {{ __('Search') }}
                  </button>
                </div>

              </div>
            </div>
          </form>
          <!-- datatable start -->
          <div class="table-responsive">
            <table id="users-list-datatable" class="table">
              <thead>
                <tr>
                  <th>id</th>
                  <th>cAccname</th>
                  <th>nExtPoint</th>
                  <th>nExtPoint1</th>
                  <th>bIsBanned</th>
                  <th>email</th>
                  <th>phone</th>
                  <th>nap card</td>
                  <th>edit</th>
                  <th>view</th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $user)
                <tr>
                  <td>{{$user->id}}</td>
                  <td>{{$user->cAccName}}</td>
                  <td>{{$user->nExtPoint}}</td>
                  <td>{{$user->nExtPoint1}}</td>
                  <td>{{$user->bIsBanned}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->phone}}</td>
                  <td><a href="{{ route('management.user.napcard', $user->cAccName) }}"><i
                        class="feather icon-dollar-sign"></i></a></td>
                  <td><a href="{{ route('management.user.edit', $user->cAccName) }}"><i
                        class="feather icon-edit-1"></i></a></td>
                  <td><a href="{{ route('management.user.show', $user->cAccName) }}"><i
                        class="feather icon-eye"></i></a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- datatable ends -->
        </div>
      </div>
    </div>
  </div>
</section>
<!-- users list ends -->

<!-- END: Content-->
@endsection