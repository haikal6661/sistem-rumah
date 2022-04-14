@extends('layouts.app')

@section('content')
@include('layouts.headers.cards')

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
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
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="receipt">Reciept</th>
                                <th scope="col" class="sort" data-sort="amount">Amount</th>
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
                                            <span class="name mb-0 text-sm">{{$houseRent->bill_image}}</span>
                                        </div>
                                    </div>
                                </th>
                                <td class="amount">
                                    RM{{$houseRent->amount ?? ' ---'}}
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
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
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