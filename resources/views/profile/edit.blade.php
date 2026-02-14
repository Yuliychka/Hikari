<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Profile | Hikari</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Poppins:wght@300;400;600;800&family=Noto+Sans+JP:wght@700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #0a0a0a;
            color: white;
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        .profile-container {
            padding-top: 120px;
            padding-bottom: 60px;
            min-height: 100vh;
            background: radial-gradient(circle at top right, rgba(220, 20, 60, 0.05), transparent),
                        radial-gradient(circle at bottom left, rgba(220, 20, 60, 0.05), transparent);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(220, 20, 60, 0.2);
            border-radius: 0;
            padding: 2rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .glass-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 3px;
            height: 100%;
            background: crimson;
        }

        .section-title {
            font-family: 'Noto Sans JP', sans-serif;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #fff;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title span {
            color: crimson;
            font-size: 0.8rem;
        }

        /* Form Styling Overrides */
        input[type="text"], input[type="email"], input[type="password"] {
            background: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(220, 20, 60, 0.3) !important;
            border-radius: 0 !important;
            color: white !important;
            padding: 10px 15px !important;
        }

        input:focus {
            border-color: crimson !important;
            box-shadow: 0 0 10px rgba(220, 20, 60, 0.2) !important;
        }

        .btn-hikari {
            background: crimson;
            color: white;
            border: none;
            border-radius: 0;
            padding: 10px 25px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.8rem;
            transition: all 0.3s;
        }

        .btn-hikari:hover {
            background: #b01430;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 20, 60, 0.4);
        }

        label {
            color: rgba(255, 255, 255, 0.6) !important;
            font-size: 0.75rem !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 1px !important;
            margin-bottom: 5px !important;
        }

        .text-gray-600 { color: rgba(255, 255, 255, 0.5) !important; }
        .text-gray-800 { color: #fff !important; }
    </style>
</head>
<body>
    @include('additions.navbar')

    <div class="profile-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h1 class="mb-5" style="font-weight: 800; font-size: 2.5rem; letter-spacing: -1px;">
                        ACCOUNT <span style="color: crimson;">PROFILE</span>
                        <div style="font-family: 'Noto Sans JP', sans-serif; font-size: 0.8rem; color: crimson; margin-top: -10px;">プロフィール</div>
                    </h1>

                    <!-- Profile Info -->
                    <div class="glass-card">
                        <h2 class="section-title">Account Information <span>アカウント情報</span></h2>
                        @include('profile.partials.update-profile-information-form')
                    </div>

                    <!-- Password -->
                    <div class="glass-card">
                        <h2 class="section-title">Shield Security <span>セキュリティ</span></h2>
                        @include('profile.partials.update-password-form')
                    </div>

                    <!-- Delete -->
                    <div class="glass-card" style="border-color: rgba(255, 0, 0, 0.1);">
                        <h2 class="section-title" style="color: #666;">Danger Zone <span>危険地帯</span></h2>
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
