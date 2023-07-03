<!DOCTYPE html>
<html>

<head>
    <title>Surat</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Quicksand&display=swap');

        * {
            font-family: 'Quicksand', sans-serif,
        }
    </style>
</head>

<body>
    <div class="vh-100 d-flex justify-content-center align-items-center border">
        <button class="btn btn-primary mt-5" id="btn-accept">Accept</button>
    </div>

    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#btn-accept').click(() => {
                Swal.fire({
                    icon: 'info',
                    title: 'Setujui Ajuan?',
                    width: "700px",
                    html: `
                    <div class="form-group text-left mb-2">
                        <label class="form-label">Format Surat Balasan</label>
                        <select name="license_format_select" id="license_format_select" class="form-control shadow-none">
                        </select>
                    </div>
                    `,
                    showCloseButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Submit',
                    didOpen: () => {
                        let license_format_select = $('#license_format_select');
                        let url = "{{ route('get-license-formats') }}";

                        $.get(url).done((response) => {
                            $.each(response.data, (index, option) => {
                                const optionElement = $('<option></option>')
                                    .val(option.title)
                                    .text(option.title);
                                license_format_select.append(optionElement);
                            });
                        });
                    },
                });
            })
        })
    </script>

</body>

</html>
