<!-- resources/views/violation_form.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Violation Report Classification</title>
</head>
<body>
    <form method="post" action="/classify">
        @csrf
        <textarea name="description" rows="10" cols="50" placeholder="Enter violation report description"></textarea>
        <br>
        <button type="submit">Classify</button>
    </form>
</body>
</html>