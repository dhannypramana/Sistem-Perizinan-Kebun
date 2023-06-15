<!DOCTYPE html>
<html>

<head>
    <title>Surat</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}">
</head>

<style>
    .kop {
        margin: 0;
        padding: 0;
        width: 100%;
    }
</style>

<body>
    <div class="container mt-3">
        <div class="custom-file col-md-6">
            <input type="file" class="custom-file-input" id="customFile">
            <label class="custom-file-label" for="customFile">Choose file</label>
        </div>
    </div>

    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>

    <script>
        var fileInputs = document.querySelectorAll('.custom-file-input');
        var labels = document.querySelectorAll('.custom-file-label');

        fileInputs.forEach(function(fileInput, index) {
            fileInput.addEventListener('change', function() {
                labels[index].textContent = this.files[0].name;
            });
        });
    </script>
</body>


</html>
