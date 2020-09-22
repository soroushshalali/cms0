<style>
    .main_menu{
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 20%;
        background-color: #f2f2ff;
        box-shadow: 0 0 4px #d2d2ff;
    }
    .main_menu > ul{
        display: flex;
        list-style-type: none;
        justify-content: space-between;
        align-items: center;
        width: 500px;
        font-size: 20px;
    }
    .main_menu > ul > li{
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.4s;
        border-radius: 4px;
    }
    .main_menu > ul > li:hover{
        background-color: #adb4f5;
        box-shadow: 0 0 5px #c6c6c6;
        color: white;
        margin: 8px;
        cursor: pointer;
    }
    .main_menu > ul > li > a{
        text-decoration: none;
        color: #4a4a4a;
    }
    .main_menu > div > h2{
       color: #4a4a4a;
        text-shadow: 0 0 5px #c6c6c6 ;
        font-size: 40px;
        font-weight: 500;
    }
</style>


<nav class="main_menu" >
    <div>
        <h2>LOGO</h2>
    </div>
    <ul>
        <li><a href="http://localhost/frontend/web/index.php?r=cms" >Home</a></li>
        <li><a href="http://localhost/frontend/web/index.php?r=cms%2Farticles" >Articles</a></li>
        <li><a href="http://localhost/frontend/web/index.php?r=cms%2Fabout" >About</a></li>
        <?php if ($isGuest){ ?>
            <li><a href="http://localhost/frontend/web/index.php?r=cms%2Fsignup" >Signup</a></li>
        <?php } ?>
        <li><a href="http://localhost/frontend/web/index.php?r=cms%2F<?php echo ($isGuest) ? 'login' : 'logout' ; ?>" ><?php echo ($isGuest) ? 'Login' : 'Logout' ; ?></a></li>
    </ul>
</nav>
