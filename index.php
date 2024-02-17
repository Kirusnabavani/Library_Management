<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>e-Library Management System</title>
<style>
  body, html {
    margin: 0;
    padding: 0;
    height: 100%;
    font-family: Arial, sans-serif;
  }
  .full-background {
    background-image: url("img/Library.jpg"); 
    background-position: center center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }
  .header, .footer {
    background: rgba(0, 100, 0, 0.7);
    color: white;
    text-align: center;
    padding: 20px;
  }
  .footer {
    flex-grow: 0;
  }
  .options {
    flex-grow: 1;
    display: flex;
    justify-content: space-around;
    align-items: center;
  }
  .option a {
    display: block;
    padding: 20px;
    background: #fff;
    color: #000;
    text-decoration: none;
    border-radius: 5px;
    margin: 0 20px;
    width: 200px; 
    text-align: center;
  }
  .option img {
    width: 50px; 
    height: auto;
  }
  .option h3 {
    margin: 10px 0;
  }
</style>
</head>
<body>

<div class="full-background">
  <div class="header">
    <h1>Library Management System</h1>
  </div>

  <div class="options">
    <div class="option">
      <a href="login.php"> 
        <img src="img/admin-icon.png" alt="Admin">
        <h3>Admin</h3>
      </a>
    </div>
    <div class="option">
      <a href="student-section.php"> 
        <img src="img/student-icon.png" alt="Student">
        <h3>Student</h3>
      </a>
    </div>
  </div>

  <div class="footer">
    <p><h2><b>Welcome to the Online Library</h2> </b></p>
    <h4><b>Author: Tech Titans</b></h4>
  </div>
</div>

</body>
</html>
