@extends('master.main')
@section('title' , 'Change Password')
@section('main')
<main>
    <!-- breadcrumb-area -->
    <section class="breadcrumb-area tg-motion-effects breadcrumb-bg" data-background="uploads/bg/breadcrumb_bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <h2 class="title">Change password</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Change password</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb-area-end -->

    <!-- contact-area -->
    <section class="contact-area">
        <div class="contact-wrap">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="contact-content">
                            <div class="section-title mb-15">
                                <span class="sub-title">Change password</span>
                                <form action="" method="POST">
                                    @csrf
                                    <div class="contact-form-wrap">
                                        <div class="form-grp">
                                            <input name="old_password" type="password" placeholder="Your Old Password *" required>
                                        </div>
                                        @error('old_password')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                        <div class="form-grp">
                                            <input name="password" type="password" placeholder="Your New Password *" required>
                                        </div>
                                        @error('password')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                        <div class="form-grp">
                                            <input name="confirm_password" type="password" placeholder="Your Confirm Password *" required>
                                        </div>
                                        @error('confirm_password')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                        <button type="submit">Change Password</button>
                                    </div>
                                </form>
                                <p class="ajax-response mb-0"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- contact-area-end -->

</main>
@stop