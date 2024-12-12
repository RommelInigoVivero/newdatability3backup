<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Portal</title>
    <link rel="stylesheet" href="/CSS/mystyles2.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #121212;
            color: #f1f1f1;
            font-family: 'Arial', sans-serif;
        }
        .container {
            padding: 20px;
        }
        .card {
            background-color: #2a2a2a;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border: none;
            width: 70%;  /* Increased width */
            margin: 0 auto;
        }
        .card-header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 15px;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }
        .card-body {
            padding: 20px;
        }
        .form-control {
            background-color: #444;
            color: #fff;
            border: 1px solid #555;
            border-radius: 5px;
        }
        .form-control:focus {
            border-color: #00bcd4;
            box-shadow: 0 0 8px rgba(0, 188, 212, 0.7);
        }
        .btn-primary {
            background-color: #00bcd4;
            color: #fff;
            border-radius: 5px;
            border: none;
            padding: 10px 20px;
        }
        .btn-primary:hover {
            background-color: #0097a7;
        }
        .btn-secondary {
            background-color: #666;
            color: #fff;
            border-radius: 5px;
            border: none;
            padding: 10px 20px;
        }
        .btn-secondary:hover {
            background-color: #555;
        }
        .alert-danger {
            background-color: #f44336;
            color: white;
            border-radius: 5px;
            padding: 10px;
        }
        .footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
            margin-top: 20px;
            border-bottom-left-radius: 12px;
            border-bottom-right-radius: 12px;
        }
        .btn-con {
            text-align: right; /* Aligned buttons to the right */
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Error Message Handling -->
    @if ($errors->any())
        <div class="alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card mx-auto">
        <div class="card-header">
            <h3>Registration Portal</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('account-create') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="Lname" class="font-weight-bold">
                        <span class="material-symbols-outlined">person</span> Last Name
                    </label>
                    <input type="text" id="Lname" name="Lname" class="form-control" placeholder="Last name" required>
                </div>

                <div class="form-group">
                    <label for="Fname" class="font-weight-bold">
                        <span class="material-symbols-outlined">person</span> First Name
                    </label>
                    <input type="text" id="Fname" name="Fname" class="form-control" placeholder="First name" required>
                </div>

                <div class="form-group">
                    <label for="UserName" class="font-weight-bold">
                        <span class="material-symbols-outlined">person</span> User Name
                    </label>
                    <input type="text" id="UserName" name="username" class="form-control" placeholder="User Name" required>
                </div>

                <div class="form-group">
                    <label for="Email" class="font-weight-bold">
                        <span class="material-symbols-outlined">email</span> Email
                    </label>
                    <input type="email" id="Email" name="email" class="form-control" placeholder="Email" required>
                </div>

                <div class="form-group">
                    <label for="Password" class="font-weight-bold">
                        <span class="material-symbols-outlined">lock</span> Password
                    </label>
                    <input type="password" id="Password" name="password" class="form-control" placeholder="Password" required>
                </div>

                <div class="form-group">
                    <label for="AccessLvl" class="font-weight-bold">
                        <span class="material-symbols-outlined">key</span> Access Level:
                    </label>
                    <select name="role" id="AccessLvl" class="form-control" required>
                        <option value="ITDD">ITDD</option>
                        <option value="PDAO">PDAO</option>
                    </select>
                </div>

                <div class="btn-con">
                    <button type="button" class="btn-secondary" id="return" onclick="window.location='{{ route('HEAD.dashboard') }}'">
                        Return
                    </button>
                    <button type="submit" class="btn-primary">
                        Register <span class="material-symbols-outlined">login</span>
                    </button>
                </div>
            </form>

            <div class="footer">
                <p>©2024 City Government of Parañaque City. All rights reserved</p>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        @if(session('error'))
            alert("{{ session('error') }}");
        @endif
    });
</script>
</body>
</html>
