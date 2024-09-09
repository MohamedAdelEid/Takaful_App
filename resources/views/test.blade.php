<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Insurance Email</title>
</head>
<body>
<h1>Test Insurance Email</h1>

<form action="{{ url('/send-insurance-email') }}" method="POST">
    @csrf
    <label for="insurance_id">Insurance ID:</label>
    <input type="number" id="insurance_id" name="insurance_id" required>

    <label for="insurance_type">Insurance Type:</label>
    <select id="insurance_type" name="insurance_type" required>
        <option value="medical">Medical</option>
        <option value="life">Life</option>
        <option value="car">Car</option>
    </select>

    <button type="submit">Send Email</button>
</form>

@if(session('message'))
    <p>{{ session('message') }}</p>
@endif
</body>
</html>
