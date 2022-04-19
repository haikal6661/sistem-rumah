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
                    <h3 style="display: inline-block;" class="mb-0">House Rent Status For</h3>
                    <!-- <span style="float: right;" class="btn-group">
                        <a class="btn btn-primary btn-sm" href="{{route('rent.add')}}" role="button">
                            <span class="btn-inner--icon"><i class="ni ni-fat-add"></i></span>Add Bill</a>
                    </span> -->
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
                                <th scope="col" class="sort" data-sort="receipt">Housemate</th>
                                <th scope="col" class="sort" data-sort="amount">Amount to pay</th>
                                <th scope="col" class="sort" data-sort="month">Status</th>
                                <th scope="col" class="sort" data-sort="created_by">Paid On</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <tr>
                                
                            </tr>
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