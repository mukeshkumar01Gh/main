<!DOCTYPE html>
<html lang="en">

<head>
    <title>test</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>User Create</h2>
        <form action="{{ route('user.store') }}" method="POST">
            {{-- @csrf --}}
            <div class="form-group">
                <label for="email">UserName:</label>
                <input type="text" class="form-control" id="email" placeholder="Enter username" name="username"
                    required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
            </div>
            <div class="form-group">
                <label for="email">First Name:</label>
                <input type="text" class="form-control" id="email" placeholder="Enter first name" name="first_name"
                    required>
            </div>
            <div class="form-group">
                <label for="email">Last Name:</label>
                <input type="text" class="form-control" id="email" placeholder="Enter liast name" name="last_name"
                    required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>

</html>
