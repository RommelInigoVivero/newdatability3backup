<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renew PWD Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<style>
    /* Additional CSS for ID card styling */
    .id-card {
        border: 2px solid #007bff;
        border-radius: 8px;
        
        margin-bottom: px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        background: #f9f9f9;
        display: flex;
        align-items: center;
        position: relative;
        height: 175px;
    }
    .id-card img {
        border-radius: 8px;
        width: 100px;
        height: auto;
        position: absolute;
        left: 20px;
        top: 20px;
        border: 2px solid #007bff;
    }
    .id-card-header {
        font-size: 1.5rem;
        font-weight: bold;
        margin-left: 140px;
        
    }
    #content {
        font-size: 1.5rem;
        font-weight: bold;
        margin-left: 140px;
        
    }
    .id-card p {
        margin: 5px 0;
    }
    .id-card-footer {
        margin-top: 20px;
        text-align: center;
        font-size: 0.9rem;
        color: #555;
    }
    #logo {
    background-color: #1b7402;
    display: flex;
    justify-content: center; /* Center the logo */
    align-items: center;
    padding: 30px 50px; /* Increased padding to enlarge the container */
    width: 100%;
    height: 120px; /* Adjust the height as needed */
    box-sizing: border-box;
    position: relative;
}

#logo img {
    max-height: 100%;
    width: auto;
}


/* Style for the clock */
#clock {
    position: absolute;
    bottom: 10px; /* Position it at the bottom of the logo */
    right: 10px; /* Position it to the right of the logo */
    color: white; /* Text color */
    font-size: 16px; /* Font size */
    font-family: Arial, Helvetica, sans-serif;
    text-align: right; /* Right-align text */
}

#clock .clock-label {
    font-weight: bold; /* Bold for labels */
    margin-bottom: 5px; /* Space below the label */
}

#clock .clock-time-date {
    font-size: 14px; /* Font size for time and date */
}
</style>
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
        <a class="navbar-brand">PDAO PORTAL</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('ITDD.login')}}">ITDD</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('login') }}">PDAO</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="">APPLICANT</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" href="{{route('verify')}}">Verify</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h1>PWD Verification</h1>
    <h4>Please enter your PWD ID to verify if you are registered.</h4>

    <!-- Form for PWD verification -->
    <form id="pwd-verification-form">
        <input type="text" id="search" name="search" placeholder="Enter PWD ID" class="form-control mb-3">
        <button type="submit" class="btn btn-primary">Verify</button>
    </form>

    <div id="search-results" class="mt-4"></div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('#pwd-verification-form').on('submit', function(e) {
            e.preventDefault(); // Prevent default form submission
            let query = $('#search').val(); // Get the input value

            if (query.length > 0) { // Ensure something is entered
                $.ajax({
                    url: "{{ route('getverify') }}", // Your backend route
                    method: 'GET',
                    data: { search: query },
                    success: function(data) {
                        let output = '';
                        // Check if data is an array
                        if (Array.isArray(data) && data.length > 0) {
                            data.forEach(function(dataForm) {
                                output += `
                                    <div class="id-card">
                                        <img src="{{  asset('storage/app/private') }}/${dataForm.IDpicture}" alt="ID Picture">
                                        <div class="id-card-header">
                                            ${dataForm.FN} ${dataForm.MN} ${dataForm.LN}
                                        </div>
                                        <div class="id-card-header" id="content">
                                            <strong>PWD ID:</strong> ${dataForm.PWD_id}
                                        </div>
                                    </div>
                                `;
                            });
                        } else {
                            // If no records were found or data is not an array
                            output += '<strong><h1><center>No records found. Please inquire at PDAO.</h1></strong>';
                        }
                        $('#search-results').html(output);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText); // Log any error response
                        $('#search-results').html('<strong><h1><center>Error occurred. Please try again.</h1></strong>');
                    }
                });
            } else {
                $('#search-results').empty(); // Clear results if no input
            }
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
