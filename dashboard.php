<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <style>
        /* Additional CSS styles for the admin dashboard */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .nav-title {
            font-size: 24px;
            font-weight: bold;
        }

        .nav-links {
            list-style-type: none;
            display: flex;
        }

        .nav-links li {
            margin-right: 15px;
        }

        .nav-links li a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        .nav-links li a.logout {
            background-color: #dc3545;
            padding: 8px 15px;
            border-radius: 5px;
        }

        main {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .dashboard-cards {
            display:flex;
            flex-direction: column;
            width:100%;
            gap: 20px;
            justify-content: center;
            align-items: center;
        }

        .card {
          width: 80%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .card img {
            width: 80px;
            height: 80px;
            margin-bottom: 10px;
        }

        .info h2 {
            font-size: 28px;
            margin-bottom: 5px;
        }

        .info p {
            font-size: 16px;
            color: #666;
        }

        .logout {
              border: 2px;;
              color: white;
              padding: 15px 32px;
              text-align: center;
              display: inline-block;
              font-size: 16px;
              margin: 4px 2px;
              cursor: pointer;
}
    </style>
</head>
<body>

<header>
  <nav>
    <div class="nav-title">Library Management System</div>
    <ul class="nav-links">
      <li><a href="User_Detail.php">User Details</a></li>
      <li><a href="member_registration.php">Member Registration</a></li>
      <li><a href="book_registration.php">Books Registration</a></li>
      <li><a href="book_borrow.php">Books Borrow</a></li>
      <li><a href="book_cat_regist.php">Book Categories</a></li>
      <li><a href="fine.php">Assign Fine</a></li>
      
      <li><a href="index.php" class="logout">Log Me Out</a></li>
    </ul>
  </nav>
</header>

<main>
  <h1>ADMIN DASHBOARD</h1>
  <div class="dashboard-cards">
    <div class="card">
      <img src="img/book list.png" alt="Books Listed" width="40px" height="20px">
      <div class="info">
        <h2>2</h2>
        <p>Books Listed</p>
      </div>
    </div>
    <div class="card">
      <img src="img/book issue.png" alt="Times Book Issued">
      <div class="info">
        <h2>6</h2>
        <p>Times Book Issued</p>
      </div>
    </div>
    <div class="card">
      <img src="img/retubook.png" alt="Times Books Returned">
      <div class="info">
        <h2>3</h2>
        <p>Times Books Returned</p>
      </div>
    </div>
    <div class="card">
      <img src="img/reglist.png" alt="Registered Users">
      <div class="info">
        <h2>6</h2>
        <p>Registered Users</p>
      </div>
    </div>
    <div class="card">
      <img src="img/author.png" alt="Authors Listed">
      <div class="info">
        <h2>2</h2>
        <p>Authors Listed</p>
      </div>
    </div>
    <div class="card">
      <img src="img/category.png" alt="Listed Categories">
      <div class="info">
        <h2>6</h2>
        <p>Listed Categories</p>
      </div>
    </div>
  </div>
</main>

</body>
</html>
