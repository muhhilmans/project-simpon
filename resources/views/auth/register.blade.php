@extends('auth.layout', ['title' => 'Register'])

@section('content')
<form id="formAuthentication" class="mb-3" action="{{ route('registering') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label for="name" class="form-label">Full Name</label>
      <input
        type="text"
        class="form-control"
        id="name"
        name="name"
        placeholder="Enter your name"
        autofocus
      />
    </div>
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input
        type="text"
        class="form-control"
        id="username"
        name="username"
        placeholder="Enter your username"
        autofocus
      />
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" />
    </div>
    <div class="mb-3 form-password-toggle">
      <label class="form-label" for="password">Password</label>
      <div class="input-group input-group-merge">
        <input
          type="password"
          id="password"
          class="form-control"
          name="password"
          placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
          aria-describedby="password"
        />
        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
      </div>
    </div>

    <div class="mb-3">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" required />
        <label class="form-check-label" for="terms-conditions">
          I agree to
          <a href="javascript:void(0);">privacy policy & terms</a>
        </label>
      </div>
    </div>
    <button class="btn btn-primary d-grid w-100" type="submit">Sign up</button>
  </form>

  <p class="text-center">
    <span>Already have an account?</span>
    <a href="{{ route('login') }}">
      <span>Sign in instead</span>
    </a>
  </p>
@endsection