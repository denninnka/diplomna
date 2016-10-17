<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css"/>
<link rel="stylesheet" type="text/css" href="css/carousel.css"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>
	Online test
</title>


</head>
<body>

    <div class="navbar-wrapper <?php if(isset($_GET['page'])) echo "nocarousel"; ?> ">
  <div class="container">

	<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Начало</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?=((isset($_GET['page']) && $_GET['page'] =='teachers')? 'class="active"' : '') ?>><a href="index.php?page=teachers">Преподаватели</a></li>
        <li <?=((isset($_GET['page']) && $_GET['page'] =='subjects')? 'class="active"' : '') ?>><a href="index.php?page=subjects">Предмети</a></li>
        <li <?=((isset($_GET['page']) && $_GET['page'] =='students')? 'class="active"' : '') ?>><a href="index.php?page=students">Ученици</a></li>
        <li <?=((isset($_GET['page']) && $_GET['page'] =='tests')? 'class="active"' : '') ?>><a href="index.php?page=tests">Тестове</a></li>
        <?php
        if (isTeacher() && !isDirektor()) {
        ?>
        <li <?=((isset($_GET['page']) && $_GET['page'] =='questions')? 'class="active"' : '') ?>><a href="index.php?page=questions">Въпроси</a></li>
        <?php } ?>
        <!-- <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Седмична програма <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">

            <li><a href="#">Първи клас</a></li>
            <li><a href="#">Втори клас</a></li>
            <li><a href="#">Трети клас</a></li>
            <li><a href="#">Четвърти клас</a></li> -->
           
          </ul>
        </li>

      </ul>
     <!--  <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Търси в системата">
        </div>
        <button type="submit" class="btn btn-default">Търси</button>
      </form> -->
      <ul class="nav navbar-nav navbar-right">
      <?php
        if(isLogged()){ 
      ?> 
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $name; ?><span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
          <?php if(isTeacher()) : ?>
            <li><a href="index.php?page=teachers&amp;action=edit&amp;ID_prepodavatel=<?=$_SESSION['ID_prepodavatel']; ?>" 
             class="btn btn-info btn-xs ">Профил</a></li>
              <li><a href="index.php?page=tests&amp;action=filled" 
             class="btn btn-info btn-xs ">Попълнени тестове</a></li>
           <?php else : ?> 
             <li><a href="index.php?page=students&amp;action=edit&amp;ID_uchenik=<?=$_SESSION['ID_uchenik']; ?>" 
             class="btn btn-info btn-xs ">Профил</a></li>
             <li><a href="index.php?page=tests&amp;action=filled" 
             class="btn btn-info btn-xs ">Попълнени тестове</a></li>
           <?php endif; ?>
            <li><a href="index.php?page=logout" 
             class="btn btn-warning btn-xs ">Излез</a></li>
          </ul>
        </li>

      <?php
        } else {
      ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Впиши се  <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="index.php?page=login_prepodavatel">Преподавател</a></li>
            <li><a href="index.php?page=login_students">Ученик</a></li>
          </ul>
        </li>
        <?php } ?>
      </ul>
    </div><!-- /.navbar-collapse -->
 
    </div>
  </div><!-- /.container-fluid -->
  
</nav>
</div>
<?php if(!isset($_GET['page'])) : ?>
<!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="First slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Основно Училище САМАРА.</h1>
              <p>Добре дошли на новият ни сайт<br />Разберете повече за нас като ни посетите лично </p>
              <p><br /><br /><br /></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="data:image/gif;base64,R0lGODlhAQABAIAAAGZmZgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Новините на ОУ САМАРА </h1>
              <p>Най-новите и горещи оферти на ОУ САМАРА </p><br /><br /><br />
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Прочети повече тук</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="data:image/gif;base64,R0lGODlhAQABAIAAAFVVVQAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Third slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Дистанционно обучение</h1>
              <p>Вижте нашите предложения за едно по различно обучение. </p><br /><br /><br />
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Прочети повече тук</a></p>
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div><!-- /.carousel -->
  <?php endif; ?>
<div class="container"> 