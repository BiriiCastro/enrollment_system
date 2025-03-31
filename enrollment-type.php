<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Enrollment System</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
        }
        .enrollment-container {
            max-width: 800px;
            margin: 50px auto;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 30px;
        }
        .enrollment-type {
            text-align: center;
            margin-bottom: 40px;
        }
        .enrollment-option {
            margin: 15px;
            min-width: 200px;
        }
        .btn-primary {
            background-color: #0d6efd;
        }
        .btn-secondary {
            background-color: #003366;
        }
        .section {
            display: none;
            padding: 20px;
            border-top: 1px solid #ddd;
            margin-top: 20px;
        }
        .section-active {
            display: block;
        }
    </style>
</head>
<body>
    <div class="container enrollment-container">
        <!-- Initial Selection Screen -->
        <div id="enrollment-selection" class="section section-active">
            <div class="enrollment-type">
                <h2 class="mb-4">Type of Enrollment</h2>
                <div class="d-flex justify-content-center flex-wrap">
                    <button class="btn btn-primary enrollment-option" onclick="redirect('Form.php?type=new')">New Student</button>
                    <button class="btn btn-primary enrollment-option" onclick="redirect('Form.php?type=transferee')">Transferee Student</button>
                    <button class="btn btn-primary enrollment-option" onclick="redirect('Form.php?type=old')">Old Student</button>
                </div>
            </div>
        </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function redirect(url) {
            // Redirect to the specified URL with proper parameters
            window.location.href = url;
        }
    </script>
</body>
</html>