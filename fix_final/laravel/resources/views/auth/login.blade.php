<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dribbble</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:"Segoe UI", sans-serif;
        }

        body{
            width:100%;
            min-height:100vh;
            background:#fff;
            overflow-y:auto;
        }

        .container{
            width:100%;
            min-height:100vh;
            display:flex;
        }

        /* LEFT */
        .left{
            width:65%;
            background:#ffffff;
            position:relative;
            display:flex;
            justify-content:center;
            align-items:center;
            padding:50px 30px;
        }

        .logo{
            position:absolute;
            top:30px;
            left:40px;
            font-size:28px;
            font-style:italic;
            font-weight:700;
            color:#111827;
            text-decoration:none;
        }

        .logo:hover{
            color:#d89ae4;
            transition:0.3s;
        }

        .form-wrapper{
            width:100%;
            max-width:420px;
        }

        /* DRIBBBLE BALL ANIMATION */
        .dribbble-logo-ball{
            width:52px;
            height:52px;
            border:3px solid #d89ae4;
            border-radius:50%;
            margin:0 auto 18px;
            position:relative;
            animation:spin 8s linear infinite;
        }

        .dribbble-logo-ball .line{
            position:absolute;
            border:2px solid #d89ae4;
            border-radius:50%;
        }

        .line1{
            width:58px;
            height:22px;
            top:12px;
            left:-6px;
            border-left:none;
            border-right:none;
        }

        .line2{
            width:18px;
            height:52px;
            left:15px;
            top:-3px;
            border-top:none;
            border-bottom:none;
            transform:rotate(25deg);
        }

        .line3{
            width:18px;
            height:52px;
            right:15px;
            top:-3px;
            border-top:none;
            border-bottom:none;
            transform:rotate(-25deg);
        }

        .line4{
            width:50px;
            height:50px;
            top:-2px;
            left:-2px;
            border-top:none;
            border-left:none;
            transform:rotate(45deg);
        }

        @keyframes spin{
            from{ transform:rotate(0deg); }
            to{ transform:rotate(360deg); }
        }

        h1{
            text-align:center;
            font-size:42px;
            font-weight:700;
            color:#111827;
            margin-bottom:12px;
            line-height:1.2;
        }

        .subtitle{
            text-align:center;
            color:#6b7280;
            font-size:16px;
            line-height:1.7;
            margin-bottom:30px;
        }

        .input-group{
            margin-bottom:16px;
            position:relative;
        }

        .input-group label{
            display:block;
            font-size:13px;
            font-weight:500;
            color:#374151;
            margin-bottom:6px;
        }

        .input-group input{
            width:100%;
            padding:16px 18px;
            border-radius:16px;
            border:1px solid #e5e7eb;
            background:#fafafa;
            font-size:14px;
            transition:0.3s;
        }

        .input-group input:focus{
            outline:none;
            border-color:#d89ae4;
            background:#fff;
            box-shadow:0 0 0 4px rgba(216,154,228,0.15);
        }

        /* ERROR MESSAGE */
        .error-message{
            color:#ef4444;
            font-size:12px;
            margin-top:4px;
            display:none;
        }
        .input-group input:invalid + .error-message{
            display:block;
        }

        /* REMEMBER & FORGOT */
        .form-options{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin:8px 0 20px;
            font-size:14px;
        }

        .remember-me{
            display:flex;
            align-items:center;
            gap:8px;
            color:#374151;
            cursor:pointer;
        }

        .remember-me input{
            width:16px;
            height:16px;
            accent-color:#d89ae4;
            cursor:pointer;
        }

        .forgot-link{
            color:#d89ae4;
            text-decoration:none;
            font-weight:500;
            transition:0.2s;
        }

        .forgot-link:hover{
            color:#c07dd9;
            text-decoration:underline;
        }

        .login-btn{
            width:100%;
            padding:16px;
            border:none;
            border-radius:999px;
            background:#111827;
            color:#fff;
            font-size:15px;
            font-weight:600;
            cursor:pointer;
            margin-top:8px;
            transition:0.3s;
        }

        .login-btn:hover{
            background:#000;
            transform:translateY(-2px);
            box-shadow:0 10px 25px rgba(0,0,0,0.15);
        }

        .login-btn:active{
            transform:translateY(0);
        }

        /* SOCIAL LOGIN */
        .divider{
            display:flex;
            align-items:center;
            margin:24px 0;
            color:#9ca3af;
            font-size:13px;
        }

        .divider::before,
        .divider::after{
            content:"";
            flex:1;
            height:1px;
            background:#e5e7eb;
        }

        .divider span{
            padding:0 12px;
        }

        .social-login{
            display:flex;
            gap:12px;
        }

        .social-btn{
            flex:1;
            padding:12px;
            border:1px solid #e5e7eb;
            border-radius:16px;
            background:#fff;
            display:flex;
            align-items:center;
            justify-content:center;
            gap:8px;
            font-size:14px;
            font-weight:500;
            color:#374151;
            cursor:pointer;
            transition:0.3s;
        }

        .social-btn:hover{
            background:#fafafa;
            border-color:#d89ae4;
        }

        .social-btn svg{
            width:20px;
            height:20px;
        }

        .bottom-text{
            text-align:center;
            margin-top:24px;
            color:#6b7280;
            font-size:13px;
            line-height:1.7;
        }

        .bottom-text a{
            color:#111827;
            text-decoration:none;
            font-weight:600;
        }

        .bottom-text a:hover{
            color:#d89ae4;
        }

        /* RIGHT SIDE */
        .right{
            width:35%;
            position:relative;
            overflow:hidden;
            background:#0f172a;
        }

        .bg-image{
            position:absolute;
            width:100%;
            height:100%;
            object-fit:cover;
            animation:zoom 15s ease-in-out infinite alternate;
        }

        @keyframes zoom{
            from{ transform:scale(1); }
            to{ transform:scale(1.08); }
        }

        .overlay{
            position:absolute;
            inset:0;
            background:linear-gradient(
                to bottom,
                rgba(15,23,42,0.2),
                rgba(15,23,42,0.45)
            );
        }

        .circle{
            position:absolute;
            border-radius:50%;
            background:rgba(255,255,255,0.12);
            backdrop-filter:blur(6px);
            animation:float 7s ease-in-out infinite;
        }

        .circle1{
            width:90px;
            height:90px;
            top:15%;
            left:10%;
        }

        .circle2{
            width:130px;
            height:130px;
            bottom:15%;
            right:10%;
            animation-delay:2s;
        }

        .circle3{
            width:70px;
            height:70px;
            top:55%;
            left:30%;
            animation-delay:4s;
        }

        @keyframes float{
            0%,100%{ transform:translateY(0px); }
            50%{ transform:translateY(-25px); }
        }

        /* QUOTE TEXT */
        .quote-box{
            position:absolute;
            bottom:40px;
            left:50%;
            transform:translateX(-50%);
            text-align:center;
            color:#fff;
            padding:0 20px;
            max-width:85%;
            z-index:2;
        }

        .quote-box p{
            font-size:18px;
            font-weight:500;
            line-height:1.5;
            margin-bottom:8px;
            text-shadow:0 2px 4px rgba(0,0,0,0.3);
        }

        .quote-box span{
            font-size:13px;
            opacity:0.8;
        }

        /* RESPONSIVE */
        @media(max-width:1000px){
            .container{ flex-direction:column; }
            .left{
                width:100%;
                padding:100px 25px 50px;
            }
            .right{
                width:100%;
                height:300px;
            }
            h1{ font-size:34px; }
            .subtitle{ font-size:15px; }
            .logo{ left:25px; top:25px; }
            .form-options{ flex-direction:column; align-items:flex-start; gap:10px; }
            .quote-box{ bottom:20px; }
            .quote-box p{ font-size:16px; }
        }

        @media(max-width:600px){
            h1{ font-size:28px; }
            .subtitle{ font-size:14px; }
            .input-group input{ padding:15px; }
            .login-btn, .social-btn{ padding:15px; }
            .social-login{ flex-direction:column; }
        }
    </style>
</head>

<body>
<div class="container">

    <!-- LEFT: FORM -->
    <div class="left">
        <a href="{{ route('home') }}" class="logo">Dribbble</a>

        <div class="form-wrapper">
            <!-- Animated Dribbble Ball -->
            <div class="dribbble-logo-ball">
                <div class="line line1"></div>
                <div class="line line2"></div>
                <div class="line line3"></div>
                <div class="line line4"></div>
            </div>

            <h1>Sign in to Dribbble</h1>
            <p class="subtitle">
                Welcome back! Please enter your credentials to continue.
            </p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="input-group">
                    <label for="email">Email Address</label>
                    <input 
                        type="email" 
                        id="email"
                        name="email" 
                        placeholder="you@example.com"
                        value="{{ old('email') }}"
                        required 
                        autofocus
                    >
                    @error('email')
                        <span class="error-message" style="display:block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input 
                        type="password" 
                        id="password"
                        name="password" 
                        placeholder="••••••••"
                        required 
                    >
                    @error('password')
                        <span class="error-message" style="display:block;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        <span>Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="forgot-link" href="{{ route('password.request') }}">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <button type="submit" class="login-btn">
                    Sign In
                </button>
            </form>

            <!-- Social Login -->
            <div class="divider"><span>or continue with</span></div>
            <div class="social-login">
                <button class="social-btn">
                    <svg viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>
                    Google
                </button>
                <button class="social-btn">
                    <svg viewBox="0 0 24 24"><path fill="#1877F2" d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    Facebook
                </button>
            </div>

            <div class="bottom-text">
                Don't have an account? 
                <a href="{{ route('register') }}">Sign up</a>
            </div>
        </div>
    </div>

    <!-- RIGHT: DECORATIVE -->
    <div class="right">
        <img
            src="https://images.unsplash.com/photo-1558655146-d09347e92766?q=80&w=1200&auto=format&fit=crop"
            class="bg-image"
            alt="Design Inspiration"
        >
        <div class="overlay"></div>

        <div class="circle circle1"></div>
        <div class="circle circle2"></div>
        <div class="circle circle3"></div>

        <!-- Optional Quote -->
        <div class="quote-box">
            <p>"Design is not just what it looks like. Design is how it works."</p>
            <span>— Steve Jobs</span>
        </div>
    </div>

</div>
</body>
</html>