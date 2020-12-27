<?php
function username()
{
    include('dbconnect.php');
    include("session.php");
    $sql = "SELECT firstname, lastname FROM user WHERE user_id=". getUserId();

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            return $row['lastname']." ".$row['firstname'];
        }
    }

    $conn->close();
}
?>
<!-- Sidebar -->
<div id="sidebar">
    <div class="inner">
        <!-- Menu -->
        <nav id="menu">
            <div style="margin-bottom: 30px;">
                <h1 style="color: white"><?php echo username(); ?></h1>
            </div>

            <ul>
                <li><a href="home.php"><i class = "fa fa-home fa-lg"></i>  Homepage</a></li>
                <li>
                    <span class="opener"><i class = "fa fa-calendar"></i>  Task</span>
                    <ul>
                        <li><a href="task.php#addtask">Add Task</a></li>
                        <li><a href="task.php#today">Today</a></li>
                        <li><a href="task.php#upcoming">Upcoming</a></li>
                    </ul>
                </li>
                <li><a href="history.php"><i class = "fa fa-history fa-lg"></i>  History</a></li>
                <li><a href="logout.php" onclick="return confirm('Are you sure you want to sign out?')"><i class = "fa fa-sign-out fa-lg"></i>  Sign Out</a></li>
            </ul>
        </nav>

        <!-- Footer -->
        <footer id="footer">
            <p class="setting">
                <i class = "fa fa-cog"></i>  <a rel="Setting" href="setting.html">Setting</a></p>
        </footer>
    </div>
</div>
