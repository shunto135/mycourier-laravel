@extends('layouts.resigter')

@section('content')
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src={{asset('home/img/icon-12.png')}} alt="MyCourier">
                            </a>
                        </div>
                        <div class="login-form">
                            <form  method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group custom">
                                    <label class="label">Username</label>
                                    <input class="au-input au-input--full @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" placeholder="Username">
                                    @error('name')
                                    <small class="text text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                    @enderror
                                </div>
                                <div class="form-group custom">
                                    <label class="label">Email Address</label>
                                    <input class="au-input au-input--full @error('email') is-invalid @enderror" type="email" name="email"  value="{{ old('email') }}" placeholder="Email">
                                    @error('email')
                                    <small class="text text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                    @enderror
                                </div>
                                <div class="form-group custom" style="display: flex">
                                    <label class="switch switch-3d switch-primary mr-3">
                                        <input type="hidden" name="isEmployee" id="isEmployee" value="0">
                                        <input type="checkbox" name="isChecked" id="isChecked" class="switch-input">
                                        <span class="switch-label"></span>
                                        <span class="switch-handle"></span>
                                    </label>
                                    <span class="label">Join as a Rider</span>
                                </div>
                                <div class="form-group custom">
                                    <label class="label">Password</label>
                                    <input class="au-input au-input--full  @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password">
                                    @error('password')
                                    <small class="text text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                    @enderror
                                </div>
                                <div class="form-group custom">
                                    <label class="label">Confirm Password</label>
                                    <input id="password-confirm" class="au-input au-input--full" type="password" name="password_confirmation" placeholder="Retype Password">
                                </div>
                                <button class="au-btn au-btn--block au-btn--blue m-b-20" type="submit">register</button>
                                {{--                            <div class="social-login-content">--}}
                                {{--                                <div class="social-button">--}}
                                {{--                                    <button class="au-btn au-btn--block au-btn--blue m-b-20">register with facebook</button>--}}
                                {{--                                    <button class="au-btn au-btn--block au-btn--blue2">register with twitter</button>--}}
                                {{--                                </div>--}}
                                {{--                            </div>--}}
                            </form>
                            <div class="register-link">
                                <p>
                                    Already have account?
                                    <a href="{{route('login')}}">Sign In</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('script')
    <script>
        let data = document.querySelector("input[name='isChecked']");
        data.addEventListener("change",function(){
            document.getElementById('isEmployee').value = this.checked ? 1 : 0;
            //console.log(document.getElementById('isEmployee').value);
        });
    </script>
@endsection
