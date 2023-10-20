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

<p style="text-align: justify;">It seems that you have not attended the said counselling made for you. You must report to the guidance office as soon as possible.</p>

<p style="text-align: justify;">We want to inform you that we are hosting a career counseling program to assist our young generation, and we would be grateful if you could attend this event to help our efforts. </p>

<p style="text-align: justify;">In this time of limited career-building opportunities, your brilliant ideas will assist our participants and us reach our goal. We hope you will help us in making our event a success.</p>

<p style="text-align: justify;">We are looking forward to hearing from you.</p>

<p style="text-align: justify;">Your attendance is required, so hope to see you.</p>

<br>
<p>Kind regards,</p>
<p><strong>{{ $data['guidance_fname'] }} {{ $data['guidance_lname'] }}</strong></p>
<p><em>Guidance Counselor of Technological University of the Philippines – Taguig Campus
</td>
  </tr>
</table>

</body>
</html>

