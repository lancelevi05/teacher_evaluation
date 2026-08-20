<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Forgot Password</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #217ab6;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    }

    .card {
      display: flex;
      width: 810px;
      max-width: 94vw;
      background: #fff;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 30px 60px rgba(0, 0, 0, 0.25);
    }

    /* Left panel: solid blue, logo centered */
    .left {
      flex: 0 0 340px;
      background: #1a48c5;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px;
    }

    .logo-wrap {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 16px;
    }

    .logo-wrap img {
      max-width: 260px;
      max-height: 260px;
      width: 100%;
      object-fit: contain;
    }

    .logo-fallback {
      width: 96px;
      height: 96px;
      border-radius: 20px;
      background: rgba(255, 255, 255, 0.12);
      border: 1px solid rgba(255, 255, 255, 0.35);
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      font-weight: 700;
      font-size: 14px;
      letter-spacing: 0.05em;
    }

    .brand-title {
      margin: 4px 0 0;
      color: #fff;
      font-size: 22px;
      font-weight: 700;
      text-align: center;
      line-height: 1.3;
    }

    .brand-desc {
      margin: 0;
      color: rgba(255, 255, 255, 0.85);
      font-size: 14px;
      text-align: center;
      line-height: 1.5;
      max-width: 260px;
    }

    /* Right panel: the form */
    .right {
      flex: 1;
      padding: 44px 48px;
    }

    .right h1 {
      margin: 0 0 6px;
      font-size: 26px;
      color: #1e1b3a;
    }

    .right p.sub {
      margin: 0 0 28px;
      color: #6b7280;
      font-size: 14px;
      line-height: 1.5;
    }

    label {
      display: block;
      font-size: 14px;
      color: #1e1b3a;
      margin-bottom: 6px;
      font-weight: 500;
    }

    input[type="email"] {
      width: 100%;
      padding: 11px 14px;
      border: 1px solid #d8dae0;
      border-radius: 8px;
      font-size: 14px;
      margin-bottom: 18px;
      outline: none;
      transition: border-color 0.15s;
    }

    input[type="email"]:focus {
      border-color: #4f46e5;
      box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
    }

    button.signin {
      width: 100%;
      padding: 13px;
      background: #1d4ed8;
      color: #fff;
      border: none;
      border-radius: 8px;
      font-size: 15px;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.15s;
    }

    button.signin:hover {
      background: #4029b0;
    }

    .back-link {
      text-align: center;
      margin-top: 16px;
      font-size: 14px;
      color: #6b7280;
    }

    a {
      color: #1d4ed8;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    .error-msg {
      background: #edd9d4;
      color: #721c24;
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 15px;
      font-size: 14px;
    }

    .status-msg {
      background: #d4edda;
      color: #155724;
      padding: 10px;
      border-radius: 6px;
      margin-bottom: 15px;
      font-size: 14px;
    }

    .icon-wrap {
      width: 52px;
      height: 52px;
      border-radius: 50%;
      background: #eef0fb;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 18px;
    }

    .icon-wrap svg {
      width: 24px;
      height: 24px;
      stroke: #1d4ed8;
    }

    @media (max-width: 640px) {
      .card {
        flex-direction: column;
        width: 94vw;
      }

      .left {
        flex: none;
        padding: 30px;
      }

      .right {
        padding: 32px 28px;
      }
    }
  </style>
</head>

<body>

  <div class="card">
    <div class="left">
      <div class="logo-wrap">
        <!-- Replace src with your actual logo file -->
        <img src="images/aclc-Photoroom.png" alt="Logo"
          onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
        <div class="logo-fallback" style="display:none;">LOGO</div>
        <h2 class="brand-title">Teacher Evaluation &amp; Analytics System</h2>
        <p class="brand-desc">
          Don't worry — it happens. Enter your email and we'll send you a link to get back into your account.
        </p>
      </div>
    </div>

    <div class="right">
      <div class="icon-wrap">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="3" y="11" width="18" height="10" rx="2"></rect>
          <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
        </svg>
      </div>

      <h1>Forgot your password?</h1>
      <p class="sub">No problem. Enter the email address associated with your account and we'll email you a link to reset your password.</p>

      @if (session('status'))
        <div class="status-msg">
          {{ session('status') }}
        </div>
      @endif

      @error('email')
        <div class="error-msg">
          {{ $message }}
        </div>
      @enderror

      <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <label for="email">Email address</label>
        <input type="email" id="email" placeholder="you@school.edu" name="email" value="{{ old('email') }}" required autofocus>

        <button type="submit" class="signin">Send Password Reset Link</button>
      </form>

      <div class="back-link">Remembered your password? <a href="{{ route('login') }}">Back to Sign In</a></div>
    </div>
  </div>

</body>

</html>