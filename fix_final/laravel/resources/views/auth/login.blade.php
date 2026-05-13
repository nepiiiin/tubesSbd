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
            transition:color 0.3s;
        }

        .logo:hover{
            color:#d89ae4;
        }

        .form-wrapper{
            width:100%;
            max-width:420px;
        }

        /* DRIBBBLE BALL */
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

        /* RIGHT */
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
            0%{ transform:translateY(0px); }
            50%{ transform:translateY(-25px); }
            100%{ transform:translateY(0px); }
        }

        /* RESPONSIVE */
        @media(max-width:1000px){
            .container{ flex-direction:column; }
            .left{ width:100%; padding:100px 25px 50px; }
            .right{ width:100%; height:300px; }
            h1{ font-size:34px; }
            .subtitle{ font-size:15px; }
            .logo{ left:25px; top:25px; }
        }

        @media(max-width:600px){
            h1{ font-size:28px; }
            .subtitle{ font-size:14px; }
            .input-group input{ padding:15px; }
            .login-btn{ padding:15px; }
        }
    </style>
</head>

<body>

<div class="container">

    <!-- LEFT -->
    <div class="left">
        <a href="{{ route('home') }}" class="logo">Dribbble</a>

        <div class="form-wrapper">

            <!-- Dribbble Ball (sama persis) -->
            <div class="dribbble-logo-ball">
                <div class="line line1"></div>
                <div class="line line2"></div>
                <div class="line line3"></div>
                <div class="line line4"></div>
            </div>

            <!-- TEXT BERBEDA -->
            <h1>Sign in to Dribbble</h1>

            <p class="subtitle">
                Welcome back! Enter your credentials to access your account.
            </p>

            <!-- FORM LOGIN -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="input-group">
                    <input
                        type="email"
                        name="email"
                        placeholder="Email Address"
                        value="{{ old('email') }}"
                        required
                        autofocus
                    >
                </div>

                <div class="input-group">
                    <input
                        type="password"
                        name="password"
                        placeholder="Password"
                        required
                    >
                </div>

                <button type="submit" class="login-btn">
                    Sign In
                </button>
            </form>

            <!-- BOTTOM TEXT -->
            <div class="bottom-text">
                Don't have an account?
                <a href="{{ route('register') }}">
                    Sign up
                </a>
            </div>

        </div>
    </div>

    <!-- RIGHT (SAMA PERSIS DENGAN REGISTER) -->
    <div class="right">
        <img
            src="https://images.unsplash.com/photo-1511300636408-a63a89df3482?q=80&w=1200&auto=format&fit=crop"
            class="bg-image"
            alt="Design Inspiration"
        >
        <div class="overlay"></div>
        <div class="circle circle1"></div>
        <div class="circle circle2"></div>
        <div class="circle circle3"></div>
    </div>

</div>

</body>
</html>