<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="description" content="¿Que se supone que va aquí"> <!--Aiuda-->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><!--Icon Library-->
    <title>Baked potato</title>
</head>
<body class="">
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
            <div class="main-nav__search-container">
                <input class="search-text" type="text" placeholder="Search.." name="search">
                <a class="main-nav__button" href="#"><i class="fa fa-search"></i></a>
            </div>
            <ul class="main-nav__list">
                    <li class="main-nav__item"><a class="main-nav__link" href="index.php">Home</a></li>
                    <li class="main-nav__item"><a class="main-nav__link" href="contact.php">Contact</a></li>
                    <li class="main-nav__item"><a class="main-nav__link"href="login.php">Login</a></li>
                    <div id="logedin" class="main-nav__item  dropdown">
                        <button class="dropbtn">Hiram</button>
                        <div class="dropdown-content">
                            <a href="profile.php" class="dropdown-content__a">Profile</a>
                            <a href="submit.php" class="dropdown-content__a">New recipe</a>
                            <a id="logout" href="#" class="dropdown-content__a">Log out</a>
                        </div>
                    </div>
            </ul>
        </nav>
    </header>
    <section class="recipe-sector">
        <h1 class="recipe-title">Oven baked potato</h1>
        <div class="left-block">
            <div class="recipe-image--container">
                <img class="recipe-image" src="img/papa.jpg" alt="Baked potato.">
            </div>
        </div>
        <div class="right-block">
            <h3><span>Author</span></h3>
            <p>By: Priscilla la loca</p>
            <br>
            <h3><span>Description</span></h3>
            <p class="main-p">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed velit ex, maximus sit amet dui a, ornare dapibus dolor. Donec tristique lobortis dolor, at suscipit arcu rutrum sed. Nullam nec nisl volutpat, finibus mi vitae, scelerisque enim. Vivamus accumsan, augue sed feugiat volutpat, massa ligula viverra lacus, vitae auctor felis erat vitae mauris. Cras ac dui sed velit rutrum consequat id id eros. Vivamus ac nulla ex. Sed eu neque justo. Sed pellentesque non ipsum non condimentum.</p>
        </div>
        <div class="central-block">
            <br><br>
            <h3><span>Ingredients</span> list</h3> <br>
            <table class="ingredient-table">
                <tr class="ingredient-title">
                    <th>Ingredient</th>
                    <th>Amount</th> 
                    <th>Measure</th>
                </tr>         
                <tr>
                    <th>Potatoes</th>
                    <th>5</th> 
                    <th>Kilograms</th>
                </tr>
                <tr>
                    <th>Salsa lizano</th>
                    <th>5</th> 
                    <th>Liters</th>
                </tr>
                <tr>
                    <th>Queso</th>
                    <th>100</th> 
                    <th>Grams</th>
                </tr>
            </table>
            <br><br>
            <h3><span>Preparation</span> instructions.</h3>
            <p class="main-p">Proin fringilla ante eu leo consectetur, in mollis lorem hendrerit. Donec sed dui leo. Quisque vitae ante ac augue euismod ornare et ut erat. Vestibulum hendrerit libero ut neque elementum vulputate. <br><br>
                Duis malesuada finibus mauris, ac rhoncus mauris placerat ut. Pellentesque sagittis neque ex. Aenean tristique ultricies purus non porttitor. <br><br>
                Cras maximus dolor turpis, non iaculis mauris sodales non. Duis vulputate nisl volutpat sem bibendum, id consectetur arcu mollis. <br><br>
                Nullam vel augue vitae est vehicula aliquet vitae quis lorem. Mauris ultricies ultricies vehicula. Quisque a venenatis purus. <br><br>
                Fusce suscipit sodales ipsum at tincidunt. Aliquam erat volutpat. Donec facilisis euismod ligula, eget egestas odio laoreet fringilla. Vivamus ut porttitor orci, ut dignissim enim. <br><br>
            </p>
        </div>
    </section>
    <footer class="main-footer">
        <nav class="footer-nav">
            <a href="index.php"><img class="footer-logo" src="img/logo.png" alt="Secret du Chef's logo"></a>
            <ul class="footer-imgs">
                <li class="footer-li_item"><a class="footer-li_link"></a><img class="footer-li_img" src="img/fb.png" alt="facebook"></a></li>
                <li class="footer-li_item"><a class="footer-li_link"></a><img class="footer-li_img" src="img/instagram.png" alt="instagram"></a></li>
                <li class="footer-li_item"><a class="footer-li_link"></a><img class="footer-li_img" src="img/pinterest.png" alt="pinterest"></a></li>
                <li class="footer-li_item"><a class="footer-li_link"></a><img class="footer-li_img" src="img/youtube.png" alt="youtube"></a></li>
            </ul>   
            <p class="footer-p"> A proyect by <br> Priscilla Rivera <br> Hiram González</p> 
        </nav>       
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="js/app.js"></script>
</body>
</html>