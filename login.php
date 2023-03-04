<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  <header>
    <!-- place navbar here -->
  </header>
  <main>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mb-3">

                <div class="card-body">

                <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login </h5>
                    <p class="text-center small">Enter your username & password to login</p>
                </div>

                <form action="patient.php" method="POST" class="row g-3 needs-validation" novalidate>

                    <div class="col-12">
                    <label for="yourUsername" class="form-label">Patient Name</label>
                    <div class="input-group has-validation">
                        <input type="text" name="patient_name" class="form-control" id="yourUsername" required>
                    </div>
                    </div>

                    <div class="col-12">
                    <label for="" class="form-label">Patient Contact</label>
                    <input type="number" name="patient_conatct" class="form-control" id="yourPassword" required>
                    </div>

                    <div class="col-12">
                        <input class="btn btn-primary w-100" type="submit" value="Login" name="login" id="login">
                    </div>

                </form>

                </div>
            </div>
        </div>
    </div>
  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>