
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dropdown Menu</title>
  <script>
        window.onpageshow = function(event) {
            if (event.persisted) {
                window.location.reload();
            }
        };
    </script>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-image: url('images/background.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      background: linear-gradient(
    to right, 
    hsla(0, 100%, 50%, 0.5),    /* Red */
    hsla(240, 100%, 50%, 0.5)   /* Blue */
  ); 
    }

    .menu-container {
      position: relative;
      display: inline-block;
      
    }

    .menu-icon {
      font-size: 30px;
      cursor: pointer;
      user-select: none;
      margin-left: 130px;
    }

    .dropdown-menu {
      display: none;
      position: absolute;
      top: 40px;
      right: 0;
      background-color: #f9f9f9;
      box-shadow: 0 8px 16px rgba(2PX,0,0,0.2);
      min-width: 160px;
      z-index: 1;
    }

    .dropdown-menu a {
      display: block;
      padding: 12px 16px;
      color: black;
      text-decoration: none;
    }

    .dropdown-menu a:hover {
      background-color: #f1f1f1;
    }

    .show {
      display: block;
    }
    fieldset{
        width: 120px;
        height: 630px;
        background: cyan;
        border: none;
        margin-left: -10px;
        margin-top: -10px;
        border-radius: 10px;
        background: linear-gradient(
    to right, 
    rgba(255, 0, 0, 0.5),   /* Red with 50% opacity */
    rgba(0, 0, 255, 0.5)    /* Blue with 50% opacity */
  );


    }
    .hhhf{
        margin-left: 500px;
        margin-top: 200px;

    }
    .nav{
      margin-left: 170px;
      height: 100px;
     width: 1200px;
      word-spacing: 20px;
      margin-top: -645px;background: #000;
      color: white;
      padding: 20px;
     

    }
    .nav a{
      text-decoration: none;
      color: white;
    }
    .photo{
      width: 50px;
      height:50px;
      border-radius: 100%;
    }
  </style>
</head>
<body>
<fieldset>
<div class="menu-container">
  <img src="gikonko.png" alt="" class="photo">
  <div class="menu-icon" onclick="toggleMenu()">☰</div>
  <div id="dropdown" class="dropdown-menu">
    <a href="trainees.php">Addtrainees</a>
    <a href="user.php">Manage users</a>
    <a href="viewmodules.php">modules</a>
    <a href="database.php">view trades</a>
    <a href="alluser.php">view users</a>
    <a href="report.php">view trainees</a>
    <a href="logout.php">Logout</a>
  </div>
</div>
</fieldset>

  <div class="nav">
    <a href="viewmodules.php">viewmodules</a>
    <a href="addtrade.php">addtrade</a>
    <a href="addmodule.php">addmodule</a>
    <a href="marks_report.php">viewmarksreport</a>
    <a href="logout.php">Logout</a>
  </div>
  
  
<script>
  function toggleMenu() {
    document.getElementById("dropdown").classList.toggle("show");
  }

  // Optional: Close the menu when clicking outside
  window.onclick = function(event) {
    if (!event.target.matches('.menu-icon')) {
      const dropdown = document.getElementById("dropdown");
      if (dropdown.classList.contains('show')) {
        dropdown.classList.remove('show');
      }
    }
  }
</script>
<script>
    history.pushState(null, null, location.href);
    window.onpopstate = function () {
        history.go(1);
    };
</script>

<div class="hhhf">
<h2><i><b>Wellcome admin</b></i></h2>
<h4>youcan use the navigation on left side to perfom an task</h4>

</div>
<script>
    // Prevent back navigation using browser back button
    history.pushState(null, null, location.href);
    window.addEventListener('popstate', function () {
        history.pushState(null, null, location.href);
    });

    // Also prevent using Backspace key to go back (outside input fields)
    document.addEventListener('keydown', function (e) {
        const element = e.target.nodeName.toLowerCase();
        if (e.key === 'Backspace' && (element !== 'input' && element !== 'textarea')) {
            e.preventDefault();
        }
    });
</script>

</body>
</html>

