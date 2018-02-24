<li class="dropdown navbar-right">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <span class="glyphicon glyphicon-user"></span> <?= $user->first_name; ?>
    </a>
    <ul class="dropdown-menu">
        <li>
            <a href="./user_profile.php"><span class="glyphicon glyphicon-edit"></span> Edit Profile</a>
        </li>
        <li>
            <a href="./logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout <?php echo $user->first_name; ?></a>
        </li>
    </ul>
</li>