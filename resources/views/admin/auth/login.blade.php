<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Kunlun Treks and Tours</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0F2D3F 0%, #1B4965 50%, #2D6A8F 100%);
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
            background: radial-gradient(ellipse at 30% 50%, rgba(232,163,23,0.08) 0%, transparent 60%),
                        radial-gradient(ellipse at 70% 20%, rgba(255,255,255,0.04) 0%, transparent 50%);
            animation: float 15s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(-20px, -30px) rotate(2deg); }
        }

        .login-card {
            width: 420px;
            max-width: 90vw;
            background: rgba(255,255,255,0.97);
            border-radius: 20px;
            padding: 48px 40px;
            box-shadow: 0 25px 80px rgba(0,0,0,0.3);
            position: relative;
            z-index: 1;
            backdrop-filter: blur(20px);
        }

        .login-brand {
            text-align: center;
            margin-bottom: 36px;
        }

        .login-brand .icon-wrap {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #1B4965, #2D6A8F);
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            box-shadow: 0 8px 25px rgba(27,73,101,0.3);
        }

        .login-brand .icon-wrap i {
            color: #E8A317;
            font-size: 1.6rem;
        }

        .login-brand h3 {
            font-weight: 700;
            color: #1F2937;
            margin-bottom: 4px;
        }

        .login-brand p {
            color: #8B95A5;
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
            border-color: #1B4965;
            box-shadow: 0 0 0 3px rgba(27,73,101,0.1);
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.95rem;
            background: linear-gradient(135deg, #1B4965, #2D6A8F);
            border: none;
            color: #fff;
            transition: all 0.3s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(27,73,101,0.3);
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
            <div class="icon-wrap">
                <i class="fas fa-mountain"></i>
            </div>
            <h3>Kunlun Treks</h3>
            <p>Sign in to the admin panel</p>
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
                <i class="fas fa-sign-in-alt me-2"></i> Sign In
            </button>
        </form>
    </div>
</body>
</html>
