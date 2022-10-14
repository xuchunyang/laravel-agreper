<!doctype html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: sans-serif;
        }

        .validation-error {
            color: #ff4646;
        }

        .flash.success {
            background-color: lightgreen;
            border-radius: 5px;
            padding: 8px;
        }

        .flash.error {
            background-color: #ff4646;
            border-radius: 5px;
            padding: 8px;
        }

        table {
            border-collapse: collapse;
            width: 80%;
        }

        th, td {
            border: 1px solid;
            padding: 5px;
            text-align: left;
        }

        textarea {
            width: 95%;
        }
    </style>
</head>
<body>

{{ $slot }}

</body>
</html>
