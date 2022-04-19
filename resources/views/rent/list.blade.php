@extends('layouts.app')

@section('content')
@include('layouts.headers.cards')

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <!-- <div style="background-color: cornflowerblue;" class="card mb-3">
            <div class="nav-wrapper m-3">
                    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i>Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>Profile</a>
                        </li>
                    </ul>
                </div>
            </div> -->
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 style="display: inline-block;" class="mb-0">House Rent</h3>
                    <span style="float: right;" class="btn-group">
                        <a class="btn btn-primary btn-sm" href="{{route('rent.add')}}" role="button">
                            <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>Add Bill</a>
                    </span>
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
                                <th scope="col" class="sort" data-sort="receipt">Reciept</th>
                                <th scope="col" class="sort" data-sort="amount">Amount</th>
                                <th scope="col" class="sort" data-sort="month">Month</th>
                                <th scope="col" class="sort" data-sort="created_by">Created By</th>
                                <th scope="col">Created At</th>
                                <th scope="col" class="sort" data-sort="outstanding">Outstanding Payment</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <tr>
                                @foreach ($housesRent as $houseRent)
                                <th scope="row">
                                    <div class="media align-items-center">
                                        <a href="#" class="avatar rounded-circle mr-3">
                                            <img alt="Image placeholder" src="../assets/img/theme/bootstrap.jpg">
                                        </a>
                                        <div class="media-body">
                                            <span class="name mb-0 text-sm"><a href="#" data-toggle="modal" data-target="#exampleModal-{{$houseRent->id}}">
                                            {{$houseRent->bill_image}}
                                            </a></span>
                                        </div>
                                    </div>
                                </th>
                                <td class="amount">
                                    RM{{$houseRent->amount ?? ' ---'}}
                                </td>
                                <td class="month">
                                    {{$houseRent->month}}
                                </td>
                                <td class="created_by">
                                    {{$houseRent->created_by}}
                                </td>
                                <td class="created_at">
                                    {{$houseRent->created_at}}
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="completion mr-2">60%</span>
                                        <div>
                                            <div class="progress">
                                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <a class="dropdown-item" href="{{route('rent.edit',$houseRent->id)}}"><i class="ni ni-settings-gear-65"></i>Edit</a>
                                            <a class="dropdown-item" href="{{route('rent.view')}}"><i class="ni ni-zoom-split-in"></i>View</a>
                                            <a class="dropdown-item" onClick="javascript: return confirm('Are you sure you want to delete this bill?');" href="{{route('rent.delete',$houseRent->id)}}"><i class="ni ni-fat-remove"></i>Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade bd-example-modal-lg" id="exampleModal-{{$houseRent->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{$houseRent->bill_image}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <img alt="Image placeholder" class="img-center" src="{{asset('storage/images/receipt/'.$houseRent->bill_image)}}">
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

<style>
    .img-center {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 60%;
    }
</style>