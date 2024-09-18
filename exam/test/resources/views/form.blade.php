<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- CSRF Token Meta Tag -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="container-fluid h-100" style="display:flex; align-items:center; justify-content:center;">
        <form style="width: 26rem;" id="ticketForm" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Name input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" required />
            </div>

            <!-- Location input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="location">Location</label>
                <select id="location" name="location" class="form-select" aria-label="Default select example" required>
                    <option selected disabled>Open this select menu</option>
                    @foreach($locations as $location)
                        <option value="{{ $location->CenterID }}">{{ $location->CenterName }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Problem Description input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="problem_description">Problem Description</label>
                <textarea id="problem_description" name="problem_description" class="form-control" rows="4" required></textarea>
            </div>

            <!-- Problem Type input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="problemType">Problem Type</label>
                <select id="problemType" name="problem_type" class="form-select" aria-label="Default select example" required>
                    <option selected disabled>Open this select menu</option>
                    <option value="Hardware">Hardware</option>
                    <option value="Software">Software</option>
                </select>
            </div>

            <!-- Device Type input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="deviceType">Device Type</label>
                <select id="deviceType" name="device_type" class="form-select" aria-label="Default select example">
                    <option selected disabled>Open this select menu</option>
                    <option value="Laptop">Laptop</option>
                    <option value="Mobile">Mobile</option>
                    <option value="Printer">Printer</option>
                    <option value="Access Point">Access Point</option>
                </select>
            </div>

            <!-- OS version input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="os_version">OS version</label>
                <input type="text" id="os_version" name="os_version" class="form-control" />
            </div>

            <!-- Error code input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="error_code">Error code (optional)</label>
                <input type="text" id="error_code" name="error_code" class="form-control" />
            </div>

            <!-- Screenshots input -->
            <div class="mb-3">
                <label for="screenshots" class="form-label">Screenshots (optional)</label>
                <input class="form-control" type="file" id="screenshots" name="screenshots">
            </div>

            <!-- Hardware-specific inputs -->
            <div id="hardware" style="display: none;">
                <div class="form-outline mb-4">
                    <label class="form-label" for="serial_number">Device Serial Number (SN)</label>
                    <input type="text" id="serial_number" name="serial_number" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="picture" class="form-label">Picture (optional)</label>
                    <input class="form-control" type="file" id="picture" name="picture">
                </div>
            </div>

            <!-- Submit button -->
            <button type="button" id="submitButton" class="btn btn-primary btn-block mb-4 w-100">Send</button>
        </form>
    </div>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Custom Script -->
    <script>
        $(document).ready(function() {
            $('#problemType').change(function() {
                if ($(this).val() === 'Hardware') {
                    $('#hardware').show();
                } else {
                    $('#hardware').hide();
                }
            });

            $('#submitButton').click(function() {
                var formData = new FormData($('#ticketForm')[0]);

                $.ajax({
                    url: "{{ route('submit.ticket') }}",
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'token':'tT1xmeFPHM92yVACC1CmhZlSKFU1qTyUrPj7OeeKMcbxCBVBE6pWXb8VFOjSvsTk'
                    },
                    success: function(response) {
                        alert(response.message);
                        $('#ticketForm')[0].reset();
                        $('#hardware').hide();
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        var errorMessages = '';
                        $.each(errors, function(key, value) {
                            errorMessages += value + '\n';
                        });
                        alert('Form submission failed:\n' + errorMessages);
                    }
                });
            });
        });
    </script>
</body>
</html>
