$(document).ready(function() {
    // Select all checkboxes
    $('#selectAll').change(function() {
        $('.record-checkbox').prop('checked', this.checked);
    });

    // Live search functionality
    $('#search').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('#dataTable tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    // View Details button click handler
    $(document).on('click', '.view-details', function() {
        var id = $(this).data('id');
        
        // Fetch user details
        $.ajax({
            url: '{{ route("getUserDetails", ":id") }}'.replace(':id', id),
            method: 'GET',
            success: function(response) {
                // Populate the modal fields
                $('#modalPWD_id').text(response.PWD_id);
                $('#modalDate_of_birth').text(response.Date_of_birth);
                $('#modalSex').text(response.Sex);
                $('#modalCivil_status').text(response.Civil_status);
                $('#modalAddress').text(response.HouseNo_Street + ', ' + response.Barangay + ', ' + response.Municipality + ', ' + response.Province + ', ' + response.Region);
                $('#modalLandline').text(response.Landline_No || 'NONE');
                $('#modalMobile').text(response.Mobile_No || 'NONE');
                $('#modalEmail').text(response.Email_address || 'NONE');
                $('#modalEducational_Attainment').text(response.Educational_Attainment);
                $('#modalStatus_of_Employment').text(response.Status_of_Employment);
                $('#modalCategory_of_Employment').text(response.Category_of_Employment);
                $('#modalType_of_Employment').text(response.Type_of_Employment);
                $('#modalOccupation').text(response.Occupation);

                // Show the user details modal
                $('#userDetailsModal').modal('show');
            },
            error: function(xhr) {
                console.error(xhr);
            }
        });
    });

    // View Diseases button click handler
    $(document).on('click', '.view-diseases', function() {
        var id = $(this).data('id');

        // Fetch disease data
        $.ajax({
            url: '{{ route("getDiseases", ":id") }}'.replace(':id', id),
            method: 'GET',
            success: function(response) {
                // Populate the modal lists
                $('#disabilityList').empty();
                $.each(response.disabilities, function(key, value) {
                    $('#disabilityList').append('<li>' + key + '</li>'); // Assuming key is the disability name
                });
                $('#congenitalDiseasesList').empty();
                $.each(response.congenital, function(key, value) {
                    if (value) {
                        $('#congenitalDiseasesList').append('<li>' + value + '</li>'); // Display the actual stored string
                    }
                });
                $('#acquiredDiseasesList').empty();
                $.each(response.acquired, function(key, value) {
                    if (value) {
                        $('#acquiredDiseasesList').append('<li>' + value + '</li>'); // Display the actual stored string
                    }
                });

                // Show the diseases modal
                $('#diseasesModal').modal('show');
            },
            error: function(xhr) {
                console.error(xhr);
            }
        });
    });

    // Prevent checkbox click from triggering the row click
    $(document).on('click', '.record-checkbox', function(event) {
        event.stopPropagation(); // Prevent the row click event from firing
    });

    // Delete selected records
    $('#deleteSelected').click(function() {
        var selected = $('.record-checkbox:checked');
        if (selected.length > 0) {
            $('#deleteModal').modal('show');
        } else {
            $('#noSelectionModal').modal('show');
        }
    });

    // Confirm delete action
    $('#confirmDelete').click(function() {
        var ids = $('.record-checkbox:checked').map(function() {
            return $(this).val();
        }).get();

        // Perform AJAX delete operation here
        $.ajax({
            url: '{{ route("dataforms.bulkDelete") }}',
            method: 'POST',
            data: { ids: ids, _token: '{{ csrf_token() }}' },
            success: function(response) {
                location.reload();
            },
            error: function(xhr) {
                console.error(xhr);
            }
        });
    });
});