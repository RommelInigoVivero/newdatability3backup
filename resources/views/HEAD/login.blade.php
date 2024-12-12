<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/CSS/mystyles2.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container-fluid p-0" id="logo"> <!-- Use container-fluid to span full width -->
    <img src="https://paranaquecity.gov.ph/wp-content/uploads/2023/08/pque-logo.png" alt="Logo">
    <div id="clock">
        <div class="clock-label">Philippine Standard Time:</div>
        <div class="clock-time-date" id="time-date"></div>
    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand">ITDD PORTAL</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('ITDD.login')}}">ITDD</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('login') }}">PDAO</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="">APPLICANT</a>
                </li>
            </ul>
        </div>
    </div>
</nav>





<div class="center-wrapper">
    <div class="w3-card-4" style="width:65%;">
       <form action="{{ route('Head.login.post') }}" method="POST">
            @csrf
            <header class="w3-container w3-green">
                <div class="header-content">
                    <h2>Information Technology Development Department Portal - HEAD</h2>
                </div>
            </header>

            <div class="row">
                <div class="column w3-container" id="col1">
                    <img src="/CSS/ITDD-LOGO.jpg" id="PDAO_LOGO">
                </div>

                <div class="column w3-container" id="col1">
    
                    <div id="col2">
                    <h1>Login</h1>
                        <label for="UserName"><span class="material-symbols-outlined">person</span>User Name</label>
                        <input type="text" id="UserName" name="username" placeholder="User Name" required>

                        <label for="Password"><span class="material-symbols-outlined">lock</span>Password</label>
                        <input type="password" id="Password" name="password" placeholder="Password" required>

                        <div class="btn-con">
                            <button type="button" class="button-common" onclick="window.location='{{ route('register') }}'">
                                Register
                            </button>
                            <button class="button-common" id="signin" type="submit">
                                Log In <span class="material-symbols-outlined">login</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <footer class="w3-container w3-green">
            <h5>©2024 City Goverment of Parañaque City. All rights reserved</h5>
        </footer>
    </div>
</div>

<!-- Login Modal for Errors -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true" style="display: none;" aria-modal="true">
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

        // Close button functionality
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
