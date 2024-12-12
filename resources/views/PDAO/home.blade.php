<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/dashboard.css"> <!-- Link to your custom CSS file -->
    <title>Dashboard</title>
</head>



<body>
<nav id="sidebar">  
    <ul>
        <li>
            <span class="logo">PDAO</span>
            <button onclick="toggleSidebar()" id="toggle-btn">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg>
            </button>
        </li>
        <li>
            <button onclick="toggleSubmenu(this)" class="dropdown-btn">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z"/></svg>
                <span>Home</span>
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="m280-400 200-200 200 200H280Z"/></svg>
            </button>
            <ul class="sub-menu">
                <div>
                    <li class="active"><a href={{route('home')}}>Dashboard</a></li>
                    <li><a href={{ route('create') }}>Walk In Applicant</a></li>
                    <li><a href={{route('applicants.index')}}>Online Applicant</a></li>
                </div>
            </ul>

        </li>

        <li>
            <a href={{ route('views') }}>
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm240-240H200v160h240v-160Zm80 0v160h240v-160H520Zm-80-80v-160H200v160h240Zm80 0h240v-160H520v160ZM200-680h560v-80H200v80Z"/></svg>
                <span>PWD Database</span>
            </a>
        </li>
        
        <li>
            <button onclick="toggleSubmenu(this)" class="dropdown-btn">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="m370-80-16-128q-13-5-24.5-12T307-235l-119 50L78-375l103-78q-1-7-1-13.5v-27q0-6.5 1-13.5L78-585l110-190 119 50q11-8 23-15t24-12l16-128h220l16 128q13 5 24.5 12t22.5 15l119-50 110 190-103 78q1 7 1 13.5v27q0 6.5-2 13.5l103 78-110 190-118-50q-11 8-23 15t-24 12L590-80H370Zm70-80h79l14-106q31-8 57.5-23.5T639-327l99 41 39-68-86-65q5-14 7-29.5t2-31.5q0-16-2-31.5t-7-29.5l86-65-39-68-99 42q-22-23-48.5-38.5T533-694l-13-106h-79l-14 106q-31 8-57.5 23.5T321-633l-99-41-39 68 86 64q-5 15-7 30t-2 32q0 16 2 31t7 30l-86 65 39 68 99-42q22 23 48.5 38.5T427-266l13 106Zm42-180q58 0 99-41t41-99q0-58-41-99t-99-41q-59 0-99.5 41T342-480q0 58 40.5 99t99.5 41Zm-2-140Z"/></svg>
                <span>Settings</span>
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="m280-400 200-200 200 200H280Z"/></svg>
            </button>
            <ul class="sub-menu">
                <div>
                    <li>
                        <a href={{ route('logout') }}>
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z"/></svg>
                            <span>Logout</span>
                        </a>
                    </li>
                </div>
            </ul>
        </li>
    </ul>
</nav>


<!--     <div class="header-container">
        <h1>PDAO DATABASE MANAGEMENT SYSTEM</h1>
    </div>

    <div class="container mt-5 custom-border">
        <h1 class="header-title">Dashboard</h1>

        
        <div class="row custom-border">
            
            <div class="col-lg-4">
                <div class="card">
                    <a href="{{ route('create') }}" style="text-decoration: none; color: inherit;">
                        <div class="row align-items-center">
                            <div class="col-md-4 text-center" id="icon">
                                <img src="/CSS/add.png" alt="Add Icon">
                            </div>
                            <div class="col-md-8 card-body">
                                <h4 class="card-title">Add New Data</h4>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            
            
            <div class="col-lg-4">
                <div class="card">
                    <a href="{{ route('views') }}" style="text-decoration: none; color: inherit;">
                        <div class="row align-items-center">
                            <div class="col-md-4 text-center" id="icon">
                                <img src="/CSS/view.png" alt="View Icon">
                            </div>
                            <div class="col-md-8 card-body">
                                <h4 class="card-title">View Database</h4>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            
            <div class="col-lg-4">
                <div class="card">
                    <a href="{{route('applicants.index')}}" style="text-decoration: none; color: inherit;">
                        <div class="row align-items-center">
                            <div class="col-md-4 text-center" id="icon">
                                <img src="/CSS/applicants.png" alt="Applicants Icon">
                            </div>
                            <div class="col-md-8 card-body">
                                <h4 class="card-title">View Applicants</h4>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div> -->
    <main>
    <div class="w3-container custom-border">
        <h2 class="dashboard-title">Reports Overview</h2>
        
        <!-- Applicants Added Container -->
        <div class="card reports-container custom-border mt-5">
            <div class="reports text-center">
                <h3 class="section-title">Applicants Added</h3>
                <div class="data-summary text-left">
                    <p><strong>Records added today:</strong> {{ $today }}</p>
                    <p><strong>Records added last week:</strong> {{ $lastWeek }}</p>
                </div>
                <div class="d-flex align-items-center mb-6">
                    <label id="dateRangeLabel" class="date-range-label">Sort By:</label>
                    <select id="dateRange" class="form-control dropdown" style="width: 150px;">
                        <option value="Daily">Daily</option>
                        <option value="Weekly">Weekly</option>
                        <option value="Monthly">Monthly</option>
                    </select>
                </div>
                <div class="chart-container">
                    <canvas id="lineChart" width="500" height="300"></canvas>
                </div>
            </div>
        </div>

        <!-- Disability Reports Container -->
        <div class="card disability-reports-container custom-border mt-5">
            <h4 class="section-title">Disability Reports</h4>
            <select id="barangaySelect" class="form-control mb-3">
                <option value="">--Select Barangay--</option>
                <option value="Baclaran">Baclaran</option>
                <option value="BF Homes">BF Homes</option>
                <option value="Don Bosco">Don Bosco</option>
                <option value="Don Galo">Don Galo</option>
                <option value="La Huerta">La Huerta</option>
                <option value="Marcelo Green">Marcelo Green</option>
                <option value="Merville">Merville</option>
                <option value="Moonwalk">Moonwalk</option>
                <option value="San Antonio">San Antonio</option>
                <option value="San Dionisio">San Dionisio</option>
                <option value="San Isidro">San Isidro</option>
                <option value="San Martin de Porres">San Martin de Porres</option>
                <option value="Santo Niño">Santo Niño</option>
                <option value="Sun Valley">Sun Valley</option>
                <option value="Tambo">Tambo</option>
                <option value="Vitalez">Vitalez</option>
            </select>

            <!-- Chart Container for Disability Data -->
            <div class="chart-container">
                <canvas id="disabilityBarChart" width="500" height="300"></canvas>
            </div>
        </div>

        <!-- Cause of Disability Reports Container -->
        <div class="card cause-of-disability-container custom-border mt-5">
            <h4 class="section-title">Cause of Disability Reports</h4>
            <select id="additionalBarangaySelect" class="form-control mb-3">
                <option value="">--Select Barangay--</option>
                <option value="Baclaran">Baclaran</option>
                <option value="BF Homes">BF Homes</option>
                <option value="Don Bosco">Don Bosco</option>
                <option value="Don Galo">Don Galo</option>
                <option value="La Huerta">La Huerta</option>
                <option value="Marcelo Green">Marcelo Green</option>
                <option value="Merville">Merville</option>
                <option value="Moonwalk">Moonwalk</option>
                <option value="San Antonio">San Antonio</option>
                <option value="San Dionisio">San Dionisio</option>
                <option value="San Isidro">San Isidro</option>
                <option value="San Martin de Porres">San Martin de Porres</option>
                <option value="Santo Niño">Santo Niño</option>
                <option value="Sun Valley">Sun Valley</option>
                <option value="Tambo">Tambo</option>
                <option value="Vitalez">Vitalez</option>
            </select>

            <!-- Container for the charts side by side -->
            <div class="chart-container d-flex">
                <div class="chart-box">
                    <canvas id="congenitalCauseChart"></canvas>
                </div>
                <div class="chart-box">
                    <canvas id="acquiredCauseChart"></canvas>
                </div>
            </div>

        </div>
    </div>
</main>




<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
        document.addEventListener('DOMContentLoaded', () => {
            const dateRangeSelect = document.getElementById('dateRange');
            const barangaySelect = document.getElementById('barangaySelect');
            const additionalBarangaySelect = document.getElementById('additionalBarangaySelect');

            // Fetch counts based on selected barangay
            barangaySelect.addEventListener('change', () => {
                const selectedBarangay = barangaySelect.value;
                fetch(`/get-disability-counts?barangay=${selectedBarangay}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('countDeaf').innerText = data.deaf;
                        document.getElementById('countIntellectual').innerText = data.intellectual;
                        document.getElementById('countLearning').innerText = data.learning;
                        document.getElementById('countMental').innerText = data.mental;
                        document.getElementById('countPhysical').innerText = data.physical;
                        document.getElementById('countPsychosocial').innerText = data.psychosocial;
                        document.getElementById('countSpeechAndLanguage').innerText = data.speech_and_language;
                        document.getElementById('countVisual').innerText = data.visual;
                        document.getElementById('countCancer').innerText = data.cancer;
                        document.getElementById('countRareDisease').innerText = data.rare_disease;
                    });
            });

            // Fetch additional counts based on selected barangay
            document.getElementById('additionalBarangaySelect').addEventListener('change', function() {
            var selectedBarangay = this.value;

            if (selectedBarangay) {
                fetch(`/get-additional-counts?barangay=${selectedBarangay}`)
                    .then(response => response.json())
                    .then(data => {
                        // Update the table with the counts
                        document.getElementById('countCongenitalADHD').innerText = data.congenital_adhd || 0;
                        document.getElementById('countCongenitalCerebral').innerText = data.congenital_cerebral || 0;
                        document.getElementById('countCongenitalDown').innerText = data.congenital_down || 0;
                        document.getElementById('countCongenitalOthers').innerText = data.congenital_others || 0;
                        document.getElementById('countAcquiredChronic').innerText = data.acquired_chronic || 0;
                        document.getElementById('countAcquiredCerebral').innerText = data.acquired_cerebral || 0;
                        document.getElementById('countAcquiredInjury').innerText = data.acquired_injury || 0;
                        document.getElementById('countAcquiredOthers').innerText = data.acquired_others || 0;
                    });
            }
        });

        const ctx = document.getElementById('lineChart').getContext('2d');
let chart;

// Sample data from the backend
const records = @json($records); // Assuming this is an array of Date_applied

const fetchData = (range) => {
    let counts = [];
    let labels = [];
    let xAxisTitle = ''; // Variable for dynamic x-axis title

    // Get current date
    const today = new Date();
    today.setHours(0, 0, 0, 0); // Reset time for accurate comparison

    if (range === 'Daily') {
        const startOfWeek = new Date(today);
        const dayOfWeek = startOfWeek.getDay(); // Sunday = 0, Monday = 1, etc.
        const firstDayOfWeek = new Date(startOfWeek);
        firstDayOfWeek.setDate(startOfWeek.getDate() - (dayOfWeek === 0 ? 6 : dayOfWeek - 1)); // Adjust to Monday

        for (let i = 0; i < 7; i++) {
            const day = new Date(firstDayOfWeek);
            day.setDate(firstDayOfWeek.getDate() + i);
      
            labels.push(day.toLocaleDateString('en-US', { weekday: 'short', month: 'short', day: 'numeric' }));

            counts.push(records.filter(date => {
                const recordDate = new Date(date);
                recordDate.setHours(0, 0, 0, 0); // Reset time for accurate comparison
                return recordDate.getTime() === day.getTime();
            }).length);
        }
        xAxisTitle = 'Daily Report'; // Title for the weekly view
    } else if (range === 'Weekly') {
        const firstDayOfCurrentMonth = new Date(today.getFullYear(), today.getMonth(), 1);
        const lastDayOfCurrentMonth = new Date(today.getFullYear(), today.getMonth() + 1, 0); // Get the last day of the month
        let currentWeekStart = firstDayOfCurrentMonth;

        while (currentWeekStart <= lastDayOfCurrentMonth) {
            // Calculate the end of the current week (Sunday)
            const currentWeekEnd = new Date(currentWeekStart);
            currentWeekEnd.setDate(currentWeekEnd.getDate() + 6);

            // Adjust currentWeekEnd to not exceed the last day of the month
            if (currentWeekEnd > lastDayOfCurrentMonth) {
                currentWeekEnd.setDate(lastDayOfCurrentMonth.getDate());
            }

            // Format the label to include start and end dates of the week (e.g., "Oct 1 - Oct 7")
            const weekLabel = `${currentWeekStart.toLocaleDateString('en-US', { month: 'short', day: 'numeric' })} - ${currentWeekEnd.toLocaleDateString('en-US', { month: 'short', day: 'numeric' })}`;
            labels.push(weekLabel);

            // Count records for the current week
            const countForWeek = records.filter(date => {
                const recordDate = new Date(date);
                return recordDate >= currentWeekStart && recordDate <= currentWeekEnd;
            }).length;
            counts.push(countForWeek);

            // Move to the next week
            currentWeekStart.setDate(currentWeekStart.getDate() + 7);
        }
        xAxisTitle = 'Weekly Report'; // Title for the monthly view
    } else if (range === 'Monthly') {
        const currentYear = today.getFullYear(); // Get the current year
        for (let i = 0; i < 12; i++) {
            const month = new Date(currentYear, i); // Create a date for the first day of each month
            labels.push(month.toLocaleString('default', { month: 'short' }));
            counts.push(records.filter(date => {
                const recordDate = new Date(date);
                return recordDate.getMonth() === month.getMonth() && recordDate.getFullYear() === currentYear;
            }).length);
        }
        xAxisTitle = 'Monthly Report'; // Title for the yearly view
    }

    // Update the chart with new data
    if (chart) {
        chart.destroy();
    }

    chart = new Chart(ctx, {
        type: 'line', // Keep it as a line chart
        data: {
            labels: labels,
            datasets: [{
                label: 'Records Added',
                data: counts,
                borderColor: 'rgba(251, 0, 25, 0.8)', // Line color
                backgroundColor: 'rgba(75, 192, 192, 0.4)', // Fill color
                borderWidth: 2,
                fill: true, // Fill under the line for better visibility
                pointRadius: 5, // Size of the points on the line
                pointHoverRadius: 7 // Size of the points when hovered
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                },
                x: {
                    type: 'category',
                    title: {
                        display: true,
                        text: xAxisTitle // Set dynamic x-axis title based on selection
                    }
                }
            }
        }
    });
}

        // Event listener for dropdown change
        document.getElementById('dateRange').addEventListener('change', (event) => {
            fetchData(event.target.value);
        });

        // Initial load with today's data
        fetchData('today');
        
        // Event listener for dropdown change
        document.getElementById('dateRange').addEventListener('change', (event) => {
            fetchData(event.target.value);
        });

        // Initial load with today's data
        fetchData('today');

            // Date range change event for chart data update
            dateRangeSelect.addEventListener('change', (event) => {
                const range = event.target.value;
                // Fetch and update chart data based on selected range
                // Example: Fetch data based on range and update chart
                // Uncomment and replace this logic with actual data fetching and chart updating
                /*
                fetch(`/get-chart-data?range=${range}`)
                    .then(response => response.json())
                    .then(data => {
                        lineChart.data.labels = data.labels; // Update with actual labels
                        lineChart.data.datasets[0].data = data.values; // Update with actual values
                        lineChart.update();
                    });
                */
            });
        });


        document.addEventListener('DOMContentLoaded', () => {
    const barangaySelect = document.getElementById('barangaySelect');

    // Set up the bar chart
    const ctx = document.getElementById('disabilityBarChart').getContext('2d');
    const disabilityBarChart = new Chart(ctx, {
        type: 'bar', // Bar chart
        data: {
            labels: ['Deaf', 'Intellectual', 'Learning', 'Mental', 'Physical', 'Psychosocial', 'Speech and Language', 'Visual', 'Cancer', 'Rare Disease'],
            datasets: [{
                label: 'Disability Count',
                data: [], // Start with empty data
                backgroundColor: [
                    '#FF5733', // Deaf - red
                    '#33FF57', // Intellectual - green
                    '#3357FF', // Learning - blue
                    '#FF33A1', // Mental - pink
                    '#F5A623', // Physical - orange
                    '#8E44AD', // Psychosocial - purple
                    '#2ECC71', // Speech and Language - light green
                    '#3498DB', // Visual - light blue
                    '#F39C12', // Cancer - yellow
                    '#D35400'  // Rare Disease - dark orange
                ],
                borderColor: '#333', // Uniform border color for all bars
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });

    // Fetch counts based on selected barangay
    barangaySelect.addEventListener('change', () => {
        const selectedBarangay = barangaySelect.value;

        if (selectedBarangay) {
            fetch(`/get-disability-counts?barangay=${selectedBarangay}`)
                .then(response => response.json())
                .then(data => {
                    // Extract data to update the chart
                    const disabilityCounts = [
                        data.deaf || 0,
                        data.intellectual || 0,
                        data.learning || 0,
                        data.mental || 0,
                        data.physical || 0,
                        data.psychosocial || 0,
                        data.speech_and_language || 0,
                        data.visual || 0,
                        data.cancer || 0,
                        data.rare_disease || 0
                    ];

                    // Find the highest disability count
                    const maxCount = Math.max(...disabilityCounts);

                    // Calculate the dynamic max Y-axis value (maxCount + 10)
                    const dynamicMax = maxCount + 10;

                    // Update the Y-axis max value dynamically
                    disabilityBarChart.options.scales.y.max = dynamicMax;

                    // Update the chart with the new data
                    disabilityBarChart.data.datasets[0].data = disabilityCounts;
                    disabilityBarChart.update();
                })
                .catch(error => console.error('Error fetching data:', error));
        }
    });
});


document.getElementById('additionalBarangaySelect').addEventListener('change', function() {
    var selectedBarangay = this.value;

    if (selectedBarangay) {
        fetch(`/get-additional-counts?barangay=${selectedBarangay}`)
            .then(response => response.json())
            .then(data => {
                // Extract data for congenital and acquired causes
                const congenitalData = [
                    data.congenital_adhd || 0,
                    data.congenital_cerebral || 0,
                    data.congenital_down || 0,
                    data.congenital_others || 0
                ];

                const acquiredData = [
                    data.acquired_chronic || 0,
                    data.acquired_cerebral || 0,
                    data.acquired_injury || 0,
                    data.acquired_others || 0
                ];

                // Calculate dynamic Y-axis max for both congenital and acquired
                const congenitalMax = Math.max(...congenitalData) + 10;
                const acquiredMax = Math.max(...acquiredData) + 10;

                // Define unique colors for each bar in congenital dataset
                const congenitalColors = [
                    '#FF5733', // ADHD - red
                    '#33FF57', // Cerebral Palsy - green
                    '#3357FF', // Down Syndrome - blue
                    '#FF33A1'  // Others - pink
                ];

                // Define unique colors for each bar in acquired dataset
                const acquiredColors = [
                    '#F5A623', // Chronic Illness - orange
                    '#8E44AD', // Cerebral Palsy - purple
                    '#2ECC71', // Injury - light green
                    '#3498DB'  // Others - light blue
                ];

                // Update the congenital chart
                const congenitalCtx = document.getElementById('congenitalCauseChart').getContext('2d');
                new Chart(congenitalCtx, {
                    type: 'bar',
                    data: {
                        labels: ['ADHD', 'Cerebral Palsy', 'Down Syndrome', 'Others'],
                        datasets: [{
                            label: 'Congenital Causes',
                            data: congenitalData,
                            backgroundColor: congenitalColors, // Different colors for each bar
                            borderColor: '#2980B9',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: congenitalMax, // Set dynamic max value
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        }
                    }
                });

                // Update the acquired chart
                const acquiredCtx = document.getElementById('acquiredCauseChart').getContext('2d');
                new Chart(acquiredCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Chronic Illness', 'Cerebral Palsy', 'Injury', 'Others'],
                        datasets: [{
                            label: 'Acquired Causes',
                            data: acquiredData,
                            backgroundColor: acquiredColors, // Different colors for each bar
                            borderColor: '#27AE60',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: acquiredMax, // Set dynamic max value
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    }
});



const toggleButton =document.getElementById('toggle-btn')
const sidebar =document.getElementById('sidebar')

function toggleSidebar(){
    sidebar.classList.toggle('close')

    Array.from(sidebar.getElementsByClassName('show')).forEach(uL =>{
        uL.classList.remove('show')
        
    })
    
}

function toggleSubmenu(button) {
    button.nextElementSibling.classList.toggle('show')
    button.classList.toggle('rotate')

    if(sidebar.classList.contains('close')){
        sidebar.classList.toggle('close')
        toggleButton.classList.toggle('rotate')
    }
}






    </script>
</body>

</html>
