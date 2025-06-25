<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <title>Login Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }
        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            background: #fff;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            display: flex;
            max-width: 900px;
            width: 90vw;
            align-items: center;
            justify-content: space-between;
        }
        .left {
            display: flex;
            flex-direction: column;
            align-items: center;
            max-width: 350px;
            width: 40vw;
            animation: slideInLeft 1.5s ease-out; /* Penerapan animasi */
        }
        .left img {
            width: 100%;
            height: auto;
        }
        .hashtag {
            margin-top: 10px;
            font-size: 60px; /* Ukuran font diperbesar */
            font-weight: 700; /* Menjadikan font lebih tebal */
            color: #0f3a6e;
            font-family: 'Dancing Script', cursive; /* Pastikan font tetap menggunakan Dancing Script */
            user-select: none;
        }
        .right {
            max-width: 350px;
            width: 45vw;
            animation: slideInRight 1.5s ease-out; /* Penerapan animasi */
        }
        .login-title {
            font-weight: 700;
            font-size: 24px;
            color: #1a254f;
            margin: 0 0 6px 0;
        }
        .login-subtitle {
            font-weight: 400;
            font-size: 12px;
            color: #7a7a7a;
            margin: 0 0 20px 0;
        }
        form {
            border: 1px solid #ddd;
            border-radius: 15px;
            padding: 20px 20px 15px 20px;
        }
        label {
            font-weight: 600;
            font-size: 11px;
            color: #333;
            display: block;
            margin-bottom: 4px;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            font-size: 11px;
            padding: 6px 8px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-bottom: 15px;
            font-family: 'Inter', sans-serif;
            color: #666;
        }
        input::placeholder {
            font-size: 11px;
            color: #bbb;
        }
        button {
            width: 100%;
            background-color: #1a254f;
            color: white;
            font-size: 12px;
            font-weight: 500;
            border: none;
            border-radius: 6px;
            padding: 8px 0;
            cursor: pointer;
        }
        .signup-text {
            font-size: 10px;
            color: #7a7a7a;
            text-align: center;
            margin-top: 10px;
        }
        .signup-text a {
            color: #1a254f;
            text-decoration: none;
            font-weight: 600;
        }
        @media (max-width: 700px) {
            .container {
                flex-direction: column;
                max-width: 90vw;
            }
            .left, .right {
                width: 100%;
                max-width: 100%;
                margin-bottom: 20px;
            }
            .hashtag {
                font-size: 20px;
                text-align: center;
            }
            .right {
                max-width: 100%;
            }
        }

        /* Animasi Slide dari Kiri */
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-100%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Animasi Slide dari Kanan */
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(100%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="left">
          <img src="/build/assets/img/logo.png" alt="Logo BPKP" style="width: 600px;" class="mx-auto mb-4">
            <div class="hashtag">
                #AkseleratifIndependen
            </div>
        </div>
        <div class="right">
            <h1 class="login-title">
                Log in
            </h1>
            <div class="login-subtitle">
                Log in for admin
            </div>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <label for="email">
                    Email
                </label>
                <input id="email" name="email" placeholder="Masukkan Email" required="" type="email" value="{{ old('email') }}"/>
                @error('email')
                    <div style="color:red; font-size:12px;">{{ $message }}</div>
                @enderror
                <label for="password">
                    Password
                </label>
                <input id="password" name="password" placeholder="Masukkan Password" required="" type="password"/>
                @error('password')
                    <div style="color:red; font-size:12px;">{{ $message }}</div>
                @enderror
                <button type="submit">
                    Login
                </button>
            </form>
        </div>
    </div>
</body>
</html>
