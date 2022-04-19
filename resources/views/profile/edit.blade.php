@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Hello') . ' '. auth()->user()->name,
        'description' => __('This is your profile page. You can see the progress you\'ve made with your work and manage your projects or assigned tasks'),
        'class' => 'col-lg-7'
    ])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="#">
                                    <img src="{{ asset('argon') }}/img/theme/team-4-800x800.jpg" class="rounded-circle">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="d-flex justify-content-between">
                            <a href="#" class="btn btn-sm btn-info mr-4">{{ __('Connect') }}</a>
                            <a href="#" class="btn btn-sm btn-default float-right">{{ __('Message') }}</a>
                        </div>
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
                                {{ auth()->user()->name }}<span class="font-weight-light">, {{auth()->user()->userDetail->age ?? 'Age not set'}}</span>
                            </h3>
                            <div class="h5 font-weight-300">
                                <i class="ni location_pin mr-2"></i>{{auth()->user()->userDetail->birth_place ?? 'Birthplace not set'}}
                            </div>
                            <div class="h5 mt-4">
                                <i class="ni business_briefcase-24 mr-2"></i>{{auth()->user()->userDetail->profession ?? 'Profession not set'}} - {{auth()->user()->userDetail->workplace ?? 'Workplace not set'}}
                            </div>
                            <div>
                                <i class="ni education_hat mr-2"></i>{{auth()->user()->userDetail->education ?? 'Education not set'}}
                            </div>
                            <hr class="my-4" />
                            <p>{{auth()->user()->userDetail->about ?? 'About not set'}}</p>
                            <!-- <a href="#">{{ __('Show more') }}</a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('Edit Profile') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('profile.update') }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>
                            
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('picture') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-picture">{{ __('Profile Picture') }}</label>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-3 order-lg-2">
                                            <div style="height: 200px;" class="">
                                                <a href="#">
                                                    <img width="200px" src="{{ old('picture', auth()->user()->name) }}"  class="rounded-circle">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                    <label for="formFile" class="form-label"></label>
                                    <input class="form-control" type="file" id="formFile">
                                    </div>

                                    @if ($errors->has('picture'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('picture') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>  
                                <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="phone">{{ __('Phone No') }}</label><span> eg.(0123456789)</span>
                                    <input type="tel" name="phone" id="phone" class="form-control form-control-alternative{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="{{ __('0123456789') }}" value="<?php echo '0'; ?>{{ old('phone_no', auth()->user()->userDetail->phone_no ?? '') }}" autofocus>
                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('age') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="age">{{ __('Age') }}</label>
                                    <input type="number" name="age" id="age" class="form-control form-control-alternative{{ $errors->has('age') ? ' is-invalid' : '' }}" placeholder="{{ __('eg.25') }}" value="{{ old('age', auth()->user()->userDetail->age ?? '') }}" autofocus>
                                    @if ($errors->has('age'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('age') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('birth_place') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="birth_place">{{ __('Birth Place') }}</label>
                                    <input type="text" name="birth_place" id="birth_place" class="form-control form-control-alternative{{ $errors->has('birth_place') ? ' is-invalid' : '' }}" placeholder="{{ __('eg.Sabak Bernam,Selangor') }}" value="{{ old('birth_place', auth()->user()->userDetail->birth_place ?? '') }}" autofocus>

                                    @if ($errors->has('birth_place'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('birth_place') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('education') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="education">{{ __('Education') }}</label>
                                    <input type="text" name="education" id="education" class="form-control form-control-alternative{{ $errors->has('education') ? ' is-invalid' : '' }}" placeholder="{{ __('eg.Universiti Putra Malaysia') }}" value="{{ old('education', auth()->user()->userDetail->education ?? '') }}" autofocus>

                                    @if ($errors->has('education'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('education') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('profession') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="profession">{{ __('Profession') }}</label>
                                    <input type="text" name="profession" id="profession" class="form-control form-control-alternative{{ $errors->has('profession') ? ' is-invalid' : '' }}" placeholder="{{ __('eg.Software Engineer') }}" value="{{ old('profession', auth()->user()->userDetail->profession ?? '') }}" autofocus>

                                    @if ($errors->has('profession'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('profession') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('workplace') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="workplace">{{ __('Workplace') }}</label>
                                    <input type="text" name="workplace" id="workplace" class="form-control form-control-alternative{{ $errors->has('workplace') ? ' is-invalid' : '' }}" placeholder="{{ __('eg.Big Data Technology') }}" value="{{ old('workplace', auth()->user()->userDetail->workplace ?? '') }}" autofocus>

                                    @if ($errors->has('workplace'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('workplace') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('about') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="about">{{ __('About Yourself') }}</label>
                                    <textarea name="about" rows="4" cols="50" class="form-control form-control-alternative{{ $errors->has('about') ? ' is-invalid' : '' }}" placeholder="{{ __('eg.I like to eat') }}" autofocus>{{auth()->user()->userDetail->about ?? ''}}</textarea>
                                    @if ($errors->has('about'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('about') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                        <hr class="my-4" />
                        <form method="post" action="{{ route('profile.password') }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('Password') }}</h6>

                            @if (session('password_status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('password_status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-current-password">{{ __('Current Password') }}</label>
                                    <input type="password" name="old_password" id="input-current-password" class="form-control form-control-alternative{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="{{ __('Current Password') }}" value="" required>
                                    
                                    @if ($errors->has('old_password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-password">{{ __('New Password') }}</label>
                                    <input type="password" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="" required>
                                    
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-password-confirmation">{{ __('Confirm New Password') }}</label>
                                    <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" placeholder="{{ __('Confirm New Password') }}" value="" required>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Change password') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection
