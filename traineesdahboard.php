
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>User Dashboard</title>
    <style>
        /* Reset & base */
        * {
            box-sizing: border-box;
            margin: 0; 
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body, html {
            height: 100%;
            background: #f5f7fa;
            
            height: 100%;
           background-image: url('c:/Users/Jean Damour/Music/OIP.jpg'); /* ← ADD THIS */
           background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        /* Container fills whole viewport height and width, content aligned left with some padding */
        .dashboard-container {
            background: white;
            height: 100vh;
            width: 100%;
            padding: 30px 40px;
            box-shadow: 3px 0 15px rgba(0,0,0,0.1);
            /* Align content to top left */
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        h2 {
            margin-bottom: 20px;
            color: #4a90e2;
            width: 100%;
            text-align: left;
        }

        /* Dropdown container */
        .dropdown {
            position: relative;
            width: 250px; /* fixed width for dropdown */
        }

        /* Dropdown button */
        .dropbtn {
            background-color: #4a90e2;
            color: white;
            padding: 15px;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            text-align: left;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .dropbtn:hover {
            background-color: #357ABD;
        }

        /* Dropdown content (hidden by default) */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 100%;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            border-radius: 6px;
            z-index: 1;
            margin-top: 5px;
        }

        /* Dropdown links */
        .dropdown-content a {
            color: #333;
            padding: 12px 20px;
            text-decoration: none;
            display: block;
            border-bottom: 1px solid #eee;
            transition: background-color 0.2s ease;
        }

        .dropdown-content a:last-child {
            border-bottom: none;
        }

        .dropdown-content a:hover {
            background-color: #f0f4ff;
            color: #4a90e2;
        }

        /* Show dropdown on hover */
        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* Arrow icon */
        .arrow {
            border: solid white;
            border-width: 0 3px 3px 0;
            display: inline-block;
            padding: 5px;
            margin-left: 10px;
            transform: rotate(45deg);
            -webkit-transform: rotate(45deg);
        }

        /* Logout button */
        .logout-btn {
            margin-top: 30px;
            background: #e74c3c;
            color: white;
            padding: 12px 25px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
            align-self: flex-start; /* left align */
        }

        .logout-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>

<div class="dashboard-container">
    <h2>Welcome trainee you can look for you mairks</h2>

    <div class="dropdown">
        <button class="dropbtn">
            View Marks
            <i class="arrow"></i>
        </button>
        <div class="dropdown-content">
            <a href="trainee_dashboard.php">View My Marks</a>
          
        </div>
    </div>

    <a class="logout-btn" href="logout.php">Logout</a>
    <h5><i>look for your marks then check if you're competent or not then make decision</i></h5>
</div>

</body>
</html>
