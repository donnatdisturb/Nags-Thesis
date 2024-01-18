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
                <p>Dear student {{ $studentFName }} {{ $studentLName }},</p>

                <p style="text-align: justify;">Good moral request is now available to claim. The schedule for claiming the Good Moral will be on {{ $scheduleDate }}.
                 Thank you</p>

                <p>Kind regards,</p>
                <p>Guidance Counselor: {{ $guidanceFName }} {{ $guidanceLName }}</p>
                <p>Muntinlupa Business High School</p>
            </td>
        </tr>
    </table>

</body>

</html>
