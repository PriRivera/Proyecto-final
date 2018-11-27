<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><!--Icon Library-->
    <title>Administrator</title>
</head>
<body>
    <header>
        <nav class="main-nav">            
            <div class="burger">
                <input type="checkbox" class="burger__button">
                <span class="burger__span"></span>
                <span class="burger__span"></span>
                <span class="burger__span"></span>
                <ul class="burger-menu">
                    <a href="index.php" class="burger-menu__link"><li class="burger-menu__li">Home</li></a>
                    <a href="contact.php" class="burger-menu__link"><li class="burger-menu__li">Contact</li></a>
                    <a href="login.php" class="burger-menu__link"><li class="burger-menu__li">Login</li></a>
                    <a href="profile.php" class="burger-menu__link"><li class="burger-menu__li">Profile</li></a>
                    <a href="submit.php" class="burger-menu__link"><li class="burger-menu__li">New recipe</li></a>
                    <a href="#" class="burger-menu__link"><li class="burger-menu__li">Logout</li></a>
                </ul>
            </div>
            <a href="index.php"><img class="logo" src="img/logo.png" alt="Secret du Chef's logo"></a>
            <form action="search.php" class="main-nav__search-container">
                <input class="search-text" type="text" placeholder="Search.." name="keyWord">
                <button class="main-nav__button" href="#"><i class="fa fa-search"></i></button>
            </form>
            <ul class="main-nav__list">
                    <li class="main-nav__item"><a class="main-nav__link" href="index.php">Home</a></li>
                    <li class="main-nav__item"><a class="main-nav__link" href="contact.php">Contact</a></li>
                    <?php 
                        if (isset($_SESSION["isLoggedIn"])) {
                            echo "<div id='logedin' class='main-nav__item  dropdown'>
                                    <button class='dropbtn'>".$_SESSION["usr"]."</button>
                                    <div class='dropdown-content'>
                                        <a href='profile.php' class='dropdown-content__a'>Profile</a>
                                        <a href='submit.php' class='dropdown-content__a'>New recipe</a>
                                        <form action='profile.php' method='POST'>
                                            <input type='submit' id='sublogout' name='logout' value='true' style='display:none;'>
                                            <label for='sublogout' id='logout' class='dropdown-content__a'>Log out
                                        </form>
                                    </div>
                                </div>";
                        }else{
                            echo "<li class='main-nav__item'><a class='main-nav__link'href='login.php'>Login</a></li>";
                        }
                    ?>                   
            </ul>
        </nav>
                    </header>
        <div>
        <h1 class="main-message">Welcome</h1>
            <a class="second-message">Recipes to be approved:</a>
            <ul>
                <p> Change the status to one in order to aprove</p>
                <li class="list_admin"><a href="#">Patotatos</a><input id="stat" class="admin_input form-login_imput" list="status" placeholder="status.." name='validate-status'>
                <button class="admin_btn main-btn">Save</button></li>
                <li class="list_admin"><a href="#">Patotatos</a><input id="stat" class="admin_input form-login_imput" list="status" placeholder="status.." name='validate-status'>
                <button class="admin_btn main-btn">Save</button></li>
                <li class="list_admin"><a href="#">Patotatos</a><input id="stat" class="admin_input form-login_imput" list="status" placeholder="status.." name='validate-status'>
                <button class="admin_btn main-btn">Save</button></li>
                <li class="list_admin"><a href="#">Patotatos</a><input id="stat" class="admin_input form-login_imput" list="status" placeholder="status.." name='validate-status'>
                <button class="admin_btn main-btn">Save</button></li>
                <datalist id="status">
                <option value="1">
                <option value="0">
               
                
        </datalist>
            </ul>
        </div>
    </body>