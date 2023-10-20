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
    <td style="text-align: center;">
    	<p><strong>Student's Information</strong></p>
        <p>{{ $data['student_fname'] }} {{ $data['student_lname'] }}</p>
    </td>
    <td style="text-align: center;">
    	<p><strong>Parent's Information</strong></p>
        <p>{{ $data['parent_fname'] }} {{ $data['parent_lname'] }}</p>
    </td>
  </tr>
  <tr>
    <td style="text-align: center;">
    	<p><strong>Commited Violation</strong></p>
        <p>{{ $data['category'] }}  | {{ $data['violation'] }}</p>
        <p>{{ $data['remarks'] }}</p>
    </td>
    <td style="text-align: center;">
    	<p><strong>Date of Violation Committed by the Student</strong></p>
        <p>{{ $data['date_recorded'] }}</p>
    </td>
  </tr>
  <tr>
    <td colspan="2">
    <p>Dear Mr./ Ms. {{ $data['parent_lname'] }},</p>

<p style="text-align: justify;">Talking to someone they trust, such as friends, teachers, relatives, or neighbors, is a common way for children to receive emotional support. However, this is only sometimes possible due to various factors. A problem can impact a child's behavior and academic progress/attainment; a school counselor can help. </p>

<p style="text-align: justify;">Counseling will allow students to discuss important issues; counselors are trained to relate to children and listen without judging them. This can help your child feel better about themselves and cope with life situations and incidents such as stress, anxiety, self-harm, grief, relationship problems, and anger. Given the current pandemic and uncertainties, our counseling service could not have come at a better time.</p>

<p style="text-align: justify;">We will have both weekly sessions and a drop-in service. Counseling is entirely voluntary and person-centered, which means that the student will entirely lead the sessions. Sessions are private, and unless there is a concern for the child's well-being or safety, the counselor will not discuss what they have said to them. If the counselor suspects a child or someone they know is in danger, they must follow our safeguarding procedures.</p>

<p style="text-align: justify;">We are confident this will be a valuable addition to our students' pastoral care, and we hope they will take advantage of this opportunity. </p>

<p style="text-align: justify;">Please do not hesitate to contact your child's counselor with any concerns or questions.</p>

<br>
<p>Kind regards,</p>
<p><strong>{{ $data['guidance_fname'] }} {{ $data['guidance_lname'] }}</strong></p>
<p><em>Guidance Counselor of Technological University of the Philippines – Taguig Campus
</td>
  </tr>
</table>

</body>
</html>

