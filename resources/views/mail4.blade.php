<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            font-family: Arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        p {
            text-align: justify;
        }
    </style>
</head>

<body>

    <table width="98%" style="width:100%;">
        <tr>
            <th colspan="2"><img src="{{ $message->embed(public_path('/images/Banner.png')) }}" alt="PASSway" width="1246" height="150" /></th>
        </tr>
        <tr>
            <td colspan="2">
                <p>Dear Guidance,</p>

                <p style="text-align: justify;">Please be informed that a student is attempting to request a good moral. Below are the student's details:</p>

                <table>
                    <tr>
                        <th>Student ID</th>
                        <td>{{ $studentId }}</td>
                    </tr>
                    <tr>
                        <th>Student Name</th>
                        <td>{{ $studentFName }} &nbsp; {{ $studentLName }}</td>
                    </tr>
        
                </table>

                <p>Kind regards,</p>
                <p>Muntinlupa Business High School</p>
            </td>
        </tr>
    </table>

</body>

</html>
