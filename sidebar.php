<?php
function username()
{
    $conn = include('dbConnect.php');

    $sql = "SELECT firstname, lastname FROM user WHERE user_id=".getUserId();

    $result = $conn->query($sql);

    $name = "";

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $name = $row['lastname']." ".$row['firstname'];
        }
    }

    $conn->close();

    return $name;
}

$urlExt = "";

$array = explode('/',$_SERVER['REQUEST_URI']);
if( $array[count($array)-2]!="Web_Project"){
    $urlExt = "../";
}

?>
<!-- Sidebar -->
<div id="sidebar">
    <div class="inner">
        <!-- Menu -->
        <nav id="menu">
            <div style="margin-bottom: 80px;">
                <h1 style="color: white"><?php echo username(); ?></h1>
            </div>

            <ul>
                <li><a href="<?php echo $urlExt; ?>home.php"><i class = "fa fa-home fa-lg"></i>  Homepage</a></li>
                <li>
                    <span class="opener"><i class = "fa fa-calendar"></i>  Task</span>
                    <ul>
                        <li><a href="<?php echo $urlExt; ?>task/index.php#addtask">Add Task</a></li>
                        <li><a href="<?php echo $urlExt; ?>task/index.php#today">Today</a></li>
                        <li><a href="<?php echo $urlExt; ?>task/index.php#upcoming">Upcoming</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo $urlExt; ?>history.php"><i class = "fa fa-history fa-lg"></i>  History</a></li>
                <li><a href="<?php echo $urlExt; ?>logout.php" onclick="return confirm('Are you sure you want to sign out?')"><i class = "fa fa-sign-out fa-lg"></i>  Sign Out</a></li>
            </ul>
        </nav>

        <!-- Footer -->
        <footer id="footer">
            <p class="setting">
                <i class = "fa fa-cog"></i>  <a rel="Setting" href="setting.html">Setting</a></p>
        </footer>
    </div>
</div>
