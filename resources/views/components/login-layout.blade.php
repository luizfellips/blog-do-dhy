<!doctype html>
<html>

<head>
    @include('includes.head')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');


        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #525ceb;
        }

        .login-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        @media (max-width: 430px) {
            .login-form {
                width: 450px;
                margin-inline: 15px;
            }
        }

        .login-form .Link {
            margin: 15px;

            a {
                text-decoration: none;
                color: #333;
                user-select: none;
                font-size: 30px;
            }

        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input:not(.form-check-input) {
            width: 100%;
            font-size: 18px;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
            transition: 0.2s;
        }

        .form-group input:hover {
            scale: 1.05;
        }

        .form-group button {
            background-color: #525ceb;
            color: #fff;
            padding: 10px;
            border: none;
            font-size: 25px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.2s;
        }

        .form-group button:hover {
            scale: 1.05;
        }
    </style>
</head>

<body>

    <div id="main" class="login-form">
        {{ $slot }}
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

</html>
