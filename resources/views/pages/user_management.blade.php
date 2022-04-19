@extends('layouts.app')

@section('content')
@include('layouts.headers.cards')

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">Housemate</h3>
                </div>
                @if (session('message'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">Name</th>
                                <th scope="col" class="sort" data-sort="budget">Phone</th>
                                <th scope="col" class="sort" data-sort="status">Email</th>
                                <th scope="col">Age</th>
                                <th scope="col" class="sort" data-sort="completion">Outstanding Payment</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <tr>
                                @foreach($users as $user)
                                <th scope="row">
                                    <div class="media align-items-center">
                                        <a href="#" class="avatar rounded-circle mr-3">
                                            <img alt="Image placeholder" style="height: 50px;" src="{{ asset('storage/images/profile_img/'. $user->userDetail->picture) }}">
                                        </a>
                                        <div class="media-body">
                                            <span class="name mb-0 text-sm">{{$user->name}}</span>
                                        </div>
                                    </div>
                                </th>
                                <td class="budget">
                                    0{{$user->userDetail->phone_no ?? ''}}
                                </td>
                                <td class="budget">
                                    {{$user->email}}
                                </td>
                                <td>
                                    {{$user->userDetail->age ?? ''}}
                                </td>
                                <td>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        @role('Admin')
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="{{ route('profile.show',$user->id) }}"><i class="ni ni-settings-gear-65"></i>Edit</a>
                                            <a class="dropdown-item" href="" data-toggle="modal" data-target="#exampleModal-{{$user->id}}"><i class="ni ni-zoom-split-in"></i>View</a>
                                            <a class="dropdown-item" onClick="javascript: return confirm('Are you sure you want to delete this user?');" href="{{route('user.delete',$user->id)}}"><i class="ni ni-fat-remove"></i>Delete</a>
                                        </div>
                                        @else
                                        @if (auth()->user()->id == $user->id)
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="{{ route('profile.show',$user->id) }}"><i class="ni ni-settings-gear-65"></i>Edit</a>
                                            <a class="dropdown-item" href="" data-toggle="modal" data-target="#exampleModal-{{$user->id}}"><i class="ni ni-zoom-split-in"></i>View</a>
                                        </div>
                                        @endif
                                        @endrole
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade bd-example-modal" id="exampleModal-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="exampleModalLabel">Housemate Profile</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <div class="">
                                        <div class="card card-profile shadow">
                                            <div class="row justify-content-center">
                                                <div class="col-lg-3 order-lg-2">
                                                    <div class="card-profile-image">
                                                        <a href="#">
                                                            <img width="200px" style="height: 200px;" src="{{ asset('storage/images/profile_img/'. $user->userDetail->picture) }}" class="rounded-circle">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                                                <!-- <div class="d-flex justify-content-between">
                                                    <a href="#" class="btn btn-sm btn-info mr-4">{{ __('Connect') }}</a>
                                                    <a href="#" class="btn btn-sm btn-default float-right">{{ __('Message') }}</a>
                                                </div> -->
                                            </div>
                                            <div class="card-body pt-0 pt-md-4">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                                                            <div>
                                                                <span class="heading">22</span>
                                                                <span class="description">{{ __('Friends') }}</span>
                                                            </div>
                                                            <div>
                                                                <span class="heading">10</span>
                                                                <span class="description">{{ __('Photos') }}</span>
                                                            </div>
                                                            <div>
                                                                <span class="heading">89</span>
                                                                <span class="description">{{ __('Comments') }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <h3>
                                                        {{$user->name}}<span class="font-weight-light">, {{$user->userDetail->age ?? 'Age not set'}}</span>
                                                    </h3>
                                                    <div class="h5 font-weight-300">
                                                        <i class="ni location_pin mr-2"></i>{{$user->userDetail->birth_place ?? 'Birthplace not set'}}
                                                    </div>
                                                    <div class="h5 mt-4">
                                                        <i class="ni business_briefcase-24 mr-2"></i>{{$user->userDetail->profession ?? 'Profession not set'}} - {{$user->userDetail->workplace ?? 'Workplace not set'}}
                                                    </div>
                                                    <div>
                                                        <i class="ni education_hat mr-2"></i>{{$user->userDetail->education ?? 'Education not set'}}
                                                    </div>
                                                    <hr class="my-4" />
                                                    <p>{{$user->userDetail->about ?? 'About not set'}}</p>
                                                    <!-- <a href="#">{{ __('Show more') }}</a> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                </div>
                                </div>
                            </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Card footer -->
                <!-- <div class="card-footer py-4">
              <nav aria-label="...">
                <ul class="pagination justify-content-end mb-0">
                  <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">
                      <i class="fas fa-angle-left"></i>
                      <span class="sr-only">Previous</span>
                    </a>
                  </li>
                  <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">
                      <i class="fas fa-angle-right"></i>
                      <span class="sr-only">Next</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div> -->
            </div>
        </div>
    </div>
</div>

@include('layouts.footers.auth')

@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
