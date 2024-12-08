<?php
if (isset($_POST['btnlogout'])) {
    unset($_SESSION['admin']);
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentRadar - Navbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        /* Unified Color Scheme and Font */
        body,
        .navbar,
        .offcanvas-header,
        .offcanvas-body {
            font-family: 'Poppins', sans-serif;
        }

        .navbar {
            background-color: #ffffff95;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
            margin-bottom: 1%;
        }

        .navbar-brand {
            color: #009688;
            font-weight: 600;
            font-size: 24px;
            transition: color 0.3s ease;
        }

        .navbar-brand:hover {
            color: #00796B;
        }

        .navbar-nav .nav-link {
            color: #333333;
            font-weight: 500;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #009688;
            transform: scale(1.05);
        }

        .navbar-nav .nav-item i {
            margin-right: 8px;
        }

        .navbar-toggler-icon {
            filter: invert(0.6);
        }

        /* Profile Icon and Username */
        .profile-icon {
            font-size: 1.5rem;
            color: #009688;
            margin-right: 8px;
        }

        .username {
            font-size: 16px;
            color: #333;
            font-weight: 600;
            margin-right: 15px;
        }

        /* Offcanvas Styles */
        .offcanvas-header {
            background-color: #009688;
            color: white;
        }

        .offcanvas-title {
            font-weight: 600;
            font-size: 20px;
        }

        .offcanvas-body {
            background-color: #ffffff;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.05);
        }

        .btn-logout {
            color: #009688;
            font-weight: 600;
            border: none;
            background-color: transparent;
            transition: color 0.3s ease;
        }

        .btn-logout:hover {
            color: #00796B;
        }

        /* Hover Animations */
        .navbar-toggler {
            transition: transform 0.3s ease;
        }

        .navbar-toggler:hover {
            transform: scale(1.1);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 20px;
            }

            .username {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
<form action="" method="POST">
        <nav class="navbar fixed-top border-bottom">
            <div class="container-fluid">
                <a class="navbar-brand" href="admin.php">RentRadar</a>
                <div class="d-flex align-items-center">
                    <i class="fas fa-user-circle profile-icon"></i>
                    <span class="username">Hi, Admin</span>
                    <button class="navbar-toggler ms-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">RentRadar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="admin.php"><i class="fas fa-home"></i> Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="admin_user.php"><i class="fa-solid fa-eye"></i> Users</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="admin_owner.php"><i class="fas fa-users"></i> Owners</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="admin_house.php"><i class="fas fa-info-circle"></i> Houses</a>
                            </li>
                        </ul>
                        <form class="d-flex mt-3" role="search">
                            <button class="btn-logout" name="btnlogout" type="submit">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
    document.querySelector('.btn-logout').addEventListener('click', function (event) {
        if (!confirm('Are you sure you want to log out?')) {
            event.preventDefault();
        }
    });
</script>

</body>


</html>