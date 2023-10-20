<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}
</style>
</head>
<body>

<table width="98%" style="width:100%;">
  <tr>
    <th colspan="2"><img src="{{ $message->embed(public_path('/images/Banner.png')) }}" alt="PASSway" width="1246" height="150"/></th>
  </tr>
  <tr>
    <td colspan="2">
    <p>Good day Mr/Ms. {{ $data['student_fname'] }} {{ $data['student_lname'] }},</p>

<p style="text-align: justify;">We are thankful for your cooperation and attendance during your last counselling schedule. We hope for your bright future.</p>

<br>
<p>Kind regards,</p>
<p><strong>{{ $data['guidance_fname'] }} {{ $data['guidance_lname'] }}</strong></p>
<p><em>Guidance Counselor of Technological University of the Philippines – Taguig Campus
</td>
  </tr>
</table>

</body>
</html>

