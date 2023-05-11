<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.css') }}">
</head>

<body>
    <div id="container"></div>

    <button id="addSubject" class="btn btn-primary mt-5">Add</button>

    <script>
        $(document).ready(function() {
            let count = 0;

            $('#addSubject').click(function() {
                count++;
                var html = `
                <div class="d-flex" id="group-${count}">
                    <p>${count}</p>
                    <button id="deleteSubject" onclick="deleteSubject(${count})" class="btn btn-danger ml-2">Delete</button>
                </div>
                `;

                $('#container').append(html);
            });
        });

        const updateCount = () => {
            let count = 1;
            $('[id^="group-"]').each(function() {
                $(this).find('p').text(count);
                $(this).attr('id', 'group-' + count);
                $(this).find('button').attr('onclick', 'deleteSubject(' + count + ')');
                count++;
            });
        };


        const deleteSubject = (count) => {
            console.log(count);
            $('#group-' + count).remove();
            updateCount()
        };
    </script>
</body>

</html>
