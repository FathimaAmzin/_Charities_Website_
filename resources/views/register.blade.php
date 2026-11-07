<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Account | Social Development Council (SDC)</title>

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
            padding: 40px 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* Ambient geometric texture grid */
        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: radial-gradient(rgba(255, 255, 255, 0.12) 1px, transparent 1px);
            background-size: 32px 32px;
            pointer-events: none;
            z-index: 1;
        }

        .register-wrapper {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 480px;
        }

        .register-box {
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
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #FFFFFF;
            box-shadow: 0 6px 18px rgba(0, 89, 255, 0.28);
        }

        h2 {
            text-align: center;
            margin-bottom: 6px;
            color: #0B2568;
            font-size: 24px;
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        .subtitle {
            text-align: center;
            color: #64748B;
            margin-bottom: 24px;
            font-size: 14px;
            line-height: 1.4;
        }

        .alert-error {
            background-color: #FEF2F2;
            color: #DC2626;
            padding: 11px 14px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 18px;
            border: 1px solid #FEE2E2;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            color: #1E293B;
            font-size: 13px;
            font-weight: 600;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap > i:first-child,
        .input-wrap i.input-icon-left {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94A3B8;
            font-size: 14px;
            transition: color 0.2s;
            pointer-events: none;
            z-index: 2;
        }

        .password-toggle-btn {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            padding: 6px 8px;
            cursor: pointer;
            color: #94A3B8;
            font-size: 15px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: color 0.2s ease, background-color 0.2s ease;
            z-index: 5;
            line-height: 1;
        }

        .password-toggle-btn i {
            position: static !important;
            transform: none !important;
            left: auto !important;
            top: auto !important;
            color: inherit !important;
            font-size: 15px !important;
            pointer-events: none;
        }

        .password-toggle-btn:hover {
            color: #0059FF !important;
            background-color: rgba(0, 89, 255, 0.08);
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 11px 42px 11px 40px;
            border: 1.5px solid #E2E8F0;
            border-radius: 10px;
            background: #F8FAFC;
            outline: none;
            font-size: 13.5px;
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
            margin-top: 6px;
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

        .login-link {
            text-align: center;
            margin-top: 22px;
            color: #64748B;
            font-size: 13.5px;
        }

        .login-link a {
            color: #0059FF;
            text-decoration: none;
            font-weight: 700;
        }

        .login-link a:hover {
            color: #0B2568;
            text-decoration: underline;
        }

        .back-home {
            text-align: center;
            margin-top: 18px;
        }

        .back-home a {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #64748B;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: color 0.2s;
        }

        .back-home a:hover {
            color: #0059FF;
        }

        .org-footer-note {
            text-align: center;
            margin-top: 20px;
            font-size: 11.5px;
            color: rgba(255, 255, 255, 0.7);
            letter-spacing: 0.03em;
        }

        /* Responsive Mobile Polish */
        @media (max-width: 575.98px) {
            body {
                padding: 20px 14px;
            }
            .register-box {
                padding: 28px 20px;
                border-radius: 16px;
            }
            .logo-header img {
                width: 54px;
                height: 54px;
            }
            h2 {
                font-size: 21px;
            }
            .subtitle {
                font-size: 13px;
                margin-bottom: 18px;
            }
            input[type="text"],
            input[type="email"],
            input[type="password"],
            select {
                padding: 11px 12px 11px 38px;
                font-size: 14px;
            }
            button[type="submit"] {
                padding: 12px;
                font-size: 14.5px;
            }
        }
    </style>
</head>

<body>

    <div class="register-wrapper">

        <div class="register-box">

            <div class="text-center" style="text-align: center;">
                <div class="brand-pill">
                    <span class="dot"></span> Social Development Council
                </div>
            </div>

            <div class="logo-header">
                <img src="{{ asset('images/logo-sdc.jpg') }}" alt="SDC Logo" onerror="this.src='https://ui-avatars.com/api/?name=SDC&background=0059FF&color=fff&size=80'">
            </div>

            <h2>Create Account</h2>
            <p class="subtitle">Join as a supporter, donor, or verified community member</p>

            @if($errors->any())
                <div class="alert-error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <div>
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            <form action="{{ route('register.post') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Full Name <span style="color:#DC2626;">*</span></label>
                    <div class="input-wrap">
                        <i class="fa-regular fa-user"></i>
                        <input type="text" id="name" name="name"
                               value="{{ old('name') }}"
                               placeholder="e.g. John Doe" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email Address <span style="color:#DC2626;">*</span></label>
                    <div class="input-wrap">
                        <i class="fa-regular fa-envelope"></i>
                        <input type="email" id="email" name="email"
                               value="{{ old('email') }}"
                               placeholder="john@example.com" required>
                    </div>
                </div>

                <div style="display:flex; gap:12px;">
                    <div class="form-group" style="flex:1;">
                        <label for="phone">Phone (Optional)</label>
                        <div class="input-wrap">
                            <i class="fa-solid fa-phone"></i>
                            <input type="text" id="phone" name="phone"
                                   value="{{ old('phone') }}"
                                   placeholder="+94 77 123 4567">
                        </div>
                    </div>
                    <div class="form-group" style="flex:1;">
                        <label for="country">Country</label>
                        <div class="input-wrap">
                            <i class="fa-solid fa-globe"></i>
                            <input type="text" id="country" name="country"
                                   value="{{ old('country', 'Sri Lanka') }}"
                                   placeholder="Sri Lanka">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password <span style="color:#DC2626;">*</span></label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-lock input-icon-left"></i>
                        <input type="password" id="password" name="password"
                               placeholder="Minimum 8 characters" required>
                        <button type="button" class="password-toggle-btn" onclick="togglePass('password', 'togglePassIcon1', this)" aria-label="Toggle password visibility" title="Show password">
                            <i class="fa-regular fa-eye" id="togglePassIcon1"></i>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password <span style="color:#DC2626;">*</span></label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-shield-halved input-icon-left"></i>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               placeholder="Re-type password" required>
                        <button type="button" class="password-toggle-btn" onclick="togglePass('password_confirmation', 'togglePassIcon2', this)" aria-label="Toggle password visibility" title="Show password">
                            <i class="fa-regular fa-eye" id="togglePassIcon2"></i>
                        </button>
                    </div>
                </div>

                <button type="submit">
                    <span>Create Account</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
            </form>

            <p class="login-link">
                Already have an account?
                <a href="{{ route('login') }}">Login</a>
            </p>

            <p class="back-home">
                <a href="{{ route('home') }}">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Return to SDC Website</span>
                </a>
            </p>

        </div>

        <div class="org-footer-note">
            © {{ date('Y') }} Social Development Council • Maligaikadu, Sri Lanka
        </div>

    </div>

    <script>
        function togglePass(inputId, iconId, btn) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (!input || !icon) return;
            const isPassword = input.getAttribute('type') === 'password';
            input.setAttribute('type', isPassword ? 'text' : 'password');
            icon.className = isPassword ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye';
            if (btn) {
                btn.setAttribute('title', isPassword ? 'Hide password' : 'Show password');
            }
        }
    </script>
</body>
</html>
