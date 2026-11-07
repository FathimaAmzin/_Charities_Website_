<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Forgot Password | Social Development Council (SDC)</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: 
                radial-gradient(circle at 12% 18%, rgba(0, 89, 255, 0.32) 0%, transparent 45%),
                radial-gradient(circle at 88% 82%, rgba(46, 119, 255, 0.24) 0%, transparent 45%),
                linear-gradient(135deg, rgba(6, 16, 42, 0.94) 0%, rgba(11, 37, 104, 0.88) 50%, rgba(4, 11, 30, 0.96) 100%),
                url('https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?auto=format&fit=crop&w=2000&q=85') center/cover no-repeat fixed;
            padding: 30px 20px;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: radial-gradient(rgba(255, 255, 255, 0.12) 1px, transparent 1px);
            background-size: 32px 32px;
            pointer-events: none;
            z-index: 1;
        }

        .auth-wrapper {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 440px;
        }

        .auth-box {
            width: 100%;
            padding: 42px 38px;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 
                0 25px 60px -15px rgba(0, 10, 40, 0.45),
                0 0 0 1px rgba(255, 255, 255, 0.6);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .brand-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #EBF2FF;
            color: #0059FF;
            font-size: 11.5px;
            font-weight: 700;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            padding: 5px 12px;
            border-radius: 50px;
            margin-bottom: 16px;
        }

        .brand-pill .dot {
            width: 6px;
            height: 6px;
            background: #0059FF;
            border-radius: 50%;
        }

        .logo-header {
            text-align: center;
            margin-bottom: 8px;
        }

        .logo-header img {
            width: 64px;
            height: 64px;
            border-radius: 12px;
            object-fit: cover;
            border: 2px solid #EBF2FF;
            box-shadow: 0 4px 12px rgba(0, 89, 255, 0.15);
        }

        h2 {
            font-size: 24px;
            font-weight: 800;
            color: #0B2568;
            margin-bottom: 6px;
            text-align: center;
            letter-spacing: -0.02em;
        }

        .subtitle {
            font-size: 13.5px;
            color: #64748B;
            text-align: center;
            margin-bottom: 24px;
            line-height: 1.5;
        }

        .alert-success {
            background: #ECFDF5;
            color: #065F46;
            padding: 12px 14px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 20px;
            border: 1px solid #A7F3D0;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            line-height: 1.5;
        }

        .alert-error {
            background: #FEF2F2;
            color: #991B1B;
            padding: 12px 14px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 20px;
            border: 1px solid #FECACA;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            color: #1E293B;
            font-size: 13.5px;
            font-weight: 600;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94A3B8;
            font-size: 14px;
            transition: color 0.2s;
        }

        input[type="email"] {
            width: 100%;
            padding: 12px 14px 12px 40px;
            border: 1.5px solid #E2E8F0;
            border-radius: 10px;
            background: #F8FAFC;
            outline: none;
            font-size: 14px;
            color: #0F172A;
            transition: all 0.2s ease;
        }

        input:focus {
            border-color: #0059FF;
            background: #FFFFFF;
            box-shadow: 0 0 0 4px rgba(0, 89, 255, 0.14);
        }

        input:focus + i,
        .input-wrap:focus-within i {
            color: #0059FF;
        }

        button[type="submit"] {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #0059FF 0%, #0B2568 100%);
            color: #FFFFFF;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: 0.02em;
            transition: all 0.25s ease;
            box-shadow: 0 4px 14px rgba(0, 89, 255, 0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        button[type="submit"]:hover {
            background: linear-gradient(135deg, #2E77FF 0%, #0059FF 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 89, 255, 0.45);
        }

        .auth-footer-links {
            text-align: center;
            margin-top: 24px;
            color: #64748B;
            font-size: 13.5px;
        }

        .auth-footer-links a {
            color: #0059FF;
            text-decoration: none;
            font-weight: 700;
        }

        .auth-footer-links a:hover {
            color: #0B2568;
            text-decoration: underline;
        }

        .org-footer-note {
            text-align: center;
            margin-top: 20px;
            font-size: 11.5px;
            color: rgba(255, 255, 255, 0.7);
            letter-spacing: 0.03em;
        }
    </style>
</head>

<body>

    <div class="auth-wrapper">

        <div class="auth-box">

            <div class="text-center" style="text-align: center;">
                <div class="brand-pill">
                    <span class="dot"></span> Social Development Council
                </div>
            </div>

            <div class="logo-header">
                <img src="{{ asset('images/logo-sdc.jpg') }}" alt="SDC Charity Logo" onerror="this.src='https://ui-avatars.com/api/?name=SDC&background=0059FF&color=fff&size=80'">
            </div>

            <h2>Forgot Password?</h2>
            <p class="subtitle">Enter your registered email address and we'll send you instructions to reset your password.</p>

            @if(session('status'))
                <div class="alert-success">
                    <i class="fa-solid fa-circle-check" style="margin-top: 2px;"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="alert-error">
                    <i class="fa-solid fa-circle-exclamation" style="margin-top: 2px;"></i>
                    <div>
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email">Registered Email Address</label>
                    <div class="input-wrap">
                        <i class="fa-regular fa-envelope"></i>
                        <input type="email" id="email" name="email"
                               value="{{ old('email') }}"
                               placeholder="name@example.com" required autofocus>
                    </div>
                </div>

                <button type="submit">
                    <span>Send Password Reset Link</span>
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
            </form>

            <p class="auth-footer-links">
                Remember your password?
                <a href="{{ route('login') }}">Return to Login</a>
            </p>

        </div>

        <div class="org-footer-note">
            © {{ date('Y') }} Social Development Council • Maligaikadu, Sri Lanka
        </div>

    </div>

</body>
</html>

