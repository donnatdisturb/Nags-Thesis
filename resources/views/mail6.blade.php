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
            <th colspan="2">
                <img src="{{ $message->embed(public_path('/images/Banner.png')) }}" alt="PASSway" width="1246" height="150" />
            </th>
        </tr>
        <tr>
            <td colspan="2">
                <p>Dear student {{ $studentFName }} &nbsp;{{ $studentLName }},</p>

                <p style="text-align: justify;">
                    Your Good moral request has been denied due to violations in your records. If you have any queries or need further information, please contact the Guidance Counselor.
                </p>

                <p>Thank you,</p>

                <p>Kind regards,</p>
                <p>Guidance Counselor: {{ $guidanceFName }} &nbsp; {{ $guidanceLName }}</p>
                <p>Muntinlupa Business High School</p>
            </td>
        </tr>
    </table>

</body>

</html>
