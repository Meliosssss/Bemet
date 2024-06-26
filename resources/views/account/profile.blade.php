@extends('master.main')
@section('title' , 'Profile')
@section('main')
<main>
    <!-- breadcrumb-area -->
    <section class="breadcrumb-area tg-motion-effects breadcrumb-bg" data-background="uploads/bg/breadcrumb_bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <h2 class="title">Your profile</h2>
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
                                <span class="sub-title">Update your profile</span>
                                <form action="" method="POST">
                                    @csrf
                                    <div class="contact-form-wrap">
                                        <div class="form-grp">
                                            <input name="name" value="{{ $auth->name }}" type="text" placeholder="Your Name *" required>
                                            @error('name')
                                            <div>
                                                <span class="text-danger">{{ $message }}</span>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-grp">
                                            <input name="email" value="{{ $auth->email }}" type="email" placeholder="Your Email *" required>
                                            @error('email')
                                            <div>
                                                <span class="text-danger">{{ $message }}</span>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-grp">
                                            <input name="phone" value="{{ $auth->phone }}" type="number" placeholder="Your Phone *" required>
                                            @error('phone')
                                            <div>
                                                <span class="text-danger">{{ $message }}</span>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-grp">
                                            <input name="address" value="{{ $auth->address }}" type="text" placeholder="Your Address *" required>
                                            @error('address')
                                            <div>
                                                <span class="text-danger">{{ $message }}</span>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-grp">
                                            <select name="gender" class="form-control">
                                                <option value="">Select</option>
                                                <option value="1" {{ $auth->gender == 1 ? 'selected' : '' }}>Male
                                                </option>
                                                <option value="0" {{ $auth->gender == 0 ? 'selected' : '' }}>Female
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-grp">
                                            <input name="password" type="password" placeholder="Your Password *" required>
                                            @error('password')
                                            <div>
                                                <span class="text-danger">{{ $message }}</span>
                                            </div>
                                            @enderror
                                        </div>
                                        <button type="submit">Update Profile</button>
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