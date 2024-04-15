@extends('master.main')
@section('title' , 'Register')
@section('main')
<main>
    <!-- breadcrumb-area -->
    <section class="breadcrumb-area tg-motion-effects breadcrumb-bg" data-background="uploads/bg/breadcrumb_bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <h2 class="title">Register</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Register</li>
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
                                <span class="sub-title">Create your account</span>
                                <form action="" method="POST">
                                    @csrf
                                    <div class="contact-form-wrap">
                                        <div class="form-grp">
                                            <input name="name" type="text" placeholder="Your Name *" required>
                                            @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-grp">
                                            <input name="email" type="email" placeholder="Your Email *" required>
                                            @error('email')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-grp">
                                            <input name="phone" type="number" placeholder="Your Phone *" required>
                                            @error('phone')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-grp">
                                            <input name="address" type="text" placeholder="Your Address *" required>
                                            @error('address')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-grp">
                                            <select name="gender" class="form-control">
                                                <option value="">Select your gender</option>
                                                <option value="1">Male</option>
                                                <option value="0">Female</option>
                                            </select>
                                        </div>
                                        <div class="form-grp">
                                            <input name="password" type="password" placeholder="Your Password *" required>
                                            @error('password')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-grp">
                                            <input name="confirm_password" type="password" placeholder="Your Confirm Password *" required>
                                            @error('confirm_password')
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <button type="submit">Create account</button>
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