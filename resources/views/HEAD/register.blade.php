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
</head>
<body>

<div class="container-fluid p-0" id="logo">
    <img src="https://paranaquecity.gov.ph/wp-content/uploads/2023/08/pque-logo.png" alt="Logo">
    <div id="clock">
        <div class="clock-label">Philippine Standard Time:</div>
        <div class="clock-time-date" id="time-date"></div>
    </div>
</div>
@if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                            @endforeach
                    </ul>
                </div>
            @endif
<div class="center-wrapper">
    <div class="w3-card-4" style="width: 65%;">
        <form action="{{ route('register.post.head') }}" method="POST">
            @csrf
            <header class="w3-container w3-green">
                <h2>Registration Portal</h2>
            </header>

            <div id="form-content" class="p-4">
                <h4>Register</h4>
                
                <div class="form-group">
                    <label for="Lname" class="font-weight-bold">
                        <span class="material-symbols-outlined">person</span>Last name
                    </label>
                    <input type="text" id="Lname" name="Lname" class="form-control line-input" placeholder="Last name" required>
                </div>

                <div class="form-group">
                    <label for="Fname" class="font-weight-bold">
                        <span class="material-symbols-outlined">person</span>First name
                    </label>
                    <input type="text" id="Fname" name="Fname" class="form-control line-input" placeholder="First name" required>
                </div>

                <div class="form-group">
                    <label for="UserName" class="font-weight-bold">
                        <span class="material-symbols-outlined">person</span>User Name
                    </label>
                    <input type="text" id="UserName" name="username" class="form-control line-input" placeholder="User Name" required>
                </div>

                <div class="form-group">
                    <label for="Email" class="font-weight-bold">
                        <span class="material-symbols-outlined">email</span>Email
                    </label>
                    <input type="email" id="Email" name="email" class="form-control line-input" placeholder="Email" required>
                </div>

                <div class="form-group">
                    <label for="Password" class="font-weight-bold">
                        <span class="material-symbols-outlined">lock</span>Password
                    </label>
                    <input type="password" id="Password" name="password" class="form-control line-input" placeholder="Password" required>
                </div>

                <div class="form-group">
                    <label for="AccessLvl" class="font-weight-bold">
                        <span class="material-symbols-outlined">key</span>Access Level:
                    </label>
                    <select name="role" id="AccessLvl" class="form-control line-input" required>
                        <option value="HEAD">HEAD</option>
                    </select>
                </div>

                <div class="btn-con text-right">
                    <button type="button" class="button-common" id="return" onclick="window.location='{{ route('ITDD.login') }}'">
                        Return
                    </button>
                    <button type="submit" class="button-common">
                        Register <span class="material-symbols-outlined">login</span>
                    </button>
                </div>
            </div>
        </form>

        <footer class="w3-container w3-green">
            <h5>©2024 City Goverment of Parañaque City. All rights reserved</h5>
        </footer>
    </div>
</div>

<!-- Login Modal for Errors -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Login Error</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="errorMessage"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="modalCloseButton" data-dismiss="modal">Close</button>
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
            document.getElementById('errorMessage').textContent = "{{ session('error') }}";
            var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
        @endif

        document.getElementById('modalCloseButton').addEventListener('click', function() {
            var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.hide();
        });
    });

    function updateClock() {
        const now = new Date();
        const options = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: true
        };

        const dateTimeString = now.toLocaleString('en-PH', options);
        document.getElementById('time-date').textContent = dateTimeString;
    }

    updateClock();
    setInterval(updateClock, 1000);
</script>
</body>
</html>