@extends('admin.master')

@section('judul')
Edit Member
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="text-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin"><i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/admin/member">Master Member</a></li>
                        <li class="breadcrumb-item active">Form Edit Member</li>
                    </ol>
                </div>

                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Form Edit Member</h3>
                    </div>
                    <form method="post" action="/admin/member/update" enctype="multipart/form-data">
                    <div class="card-body">
                        {{ csrf_field() }}
                        <input type="hidden" name="oldusername" value="{{$member->username}}">
                         <div class="row">
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label>Username</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="username" id="username" name="username" value="{{ old('username', $member->username)}}">
                                        @error('username')
                                            <span class="msg invalid-feedback" role="alert">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                             </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email </label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                                        </div>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" id="email" name="email" value="{{ old('email', $member->email)}}">
                                        @error('email')
                                            <span class="msg invalid-feedback" role="alert">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                             </div>
                         </div>
                        <div class="row">
                            <div class="col-md-6">
                                    <label>No. Hp</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                        </div>
                                        <input id="nohp" name="nohp" type="number" class="form-control @error('nohp') is-invalid @enderror" placeholder="No. Hp" aria-label="nohp" aria-describedby="basic-addon1" value="{{ old('nohp', $member->nohp)}}">
                                        @error('nohp')
                                            <span class="msg invalid-feedback" role="alert">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                             </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                        </div>
                                        <input id="password" type="password" class="form-control" name="password" autocomplete="new-password">
                                        <small id="passwordHelpBlock" class="form-text text-muted">
                                            Password Setidaknya terdiri dari 6 karakter, tidak terdiri dari spasi, spesial karakter ataupun emoji.
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="password-confirm">Konfirmasi Password</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock" aria-hidden="true"></i></span>
                                        </div>
                                        <input id="password-confirm" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" autocomplete="new-password">
                                        @error('password')
                                            <span class="msg invalid-feedback" role="alert">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-right">
                            <button type="submit" id="btnSimpan" class="btn btn-primary"><i id="iconbtn" class="fa  fa-check-circle" aria-hidden="true"></i>&nbsp;Simpan</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
