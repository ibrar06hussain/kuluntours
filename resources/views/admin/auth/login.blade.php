<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Kunlun Treks and Tours</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700;800;900&family=Outfit:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        h1, h2, h3, h4, h5, h6, .btn { font-family: 'Outfit', 'Montserrat', sans-serif; }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #111418 0%, #1A1E24 50%, #8A0B14 100%);
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(ellipse at 30% 50%, rgba(223,171,53,0.12) 0%, transparent 60%),
                        radial-gradient(ellipse at 70% 20%, rgba(217,26,42,0.15) 0%, transparent 50%);
            animation: float 15s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(-20px, -30px) rotate(2deg); }
        }

        .login-card {
            width: 440px;
            max-width: 90vw;
            background: rgba(255,255,255,0.98);
            border-radius: 20px;
            padding: 44px 40px;
            box-shadow: 0 25px 80px rgba(0,0,0,0.5);
            position: relative;
            z-index: 1;
            backdrop-filter: blur(20px);
            border-top: 4px solid #DFAB35;
        }

        .login-brand {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-brand .logo-img {
            max-height: 80px;
            width: auto;
            object-fit: contain;
            margin-bottom: 12px;
            filter: drop-shadow(0 4px 10px rgba(0,0,0,0.15));
        }

        .login-brand h3 {
            font-weight: 800;
            color: #D91A2A;
            margin-bottom: 4px;
            letter-spacing: -0.5px;
        }

        .login-brand h3 span {
            color: #B8860B;
        }

        .login-brand p {
            color: #64748B;
            font-size: 0.85rem;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #4B5563;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px 16px;
            border: 1.5px solid #E5E7EB;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: #D91A2A;
            box-shadow: 0 0 0 3px rgba(217,26,42,0.15);
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.95rem;
            background: linear-gradient(135deg, #E61C24 0%, #C8102E 60%, #8A0B14 100%);
            border: none;
            color: #fff;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(217, 26, 42, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(217,26,42,0.45);
            color: #fff;
        }

        .input-group-text {
            background: #F9FAFB;
            border: 1.5px solid #E5E7EB;
            border-right: none;
            border-radius: 10px 0 0 10px;
            color: #8B95A5;
        }

        .input-group .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-brand">
            <img src="{{ asset('images/logo.png') }}" alt="Kunlun Treks and Tours" class="logo-img">
            <h3>KUNLUN <span>TREKS</span></h3>
            <p>Admin Control Panel & Expedition Management</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger py-2 px-3" style="font-size: 0.85rem; border-radius: 10px;">
                <i class="fas fa-exclamation-triangle me-1"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" class="form-control" id="email" name="email"
                           value="{{ old('email') }}" placeholder="admin@kunluntreks.com" required autofocus>
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password"
                           placeholder="Enter your password" required>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember" style="font-size: 0.85rem;">
                        Remember me
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-login">
                <i class="fas fa-sign-in-alt me-2"></i> Sign In to Dashboard
            </button>
        </form>
    </div>
</body>
</html>
