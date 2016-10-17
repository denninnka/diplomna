


<?php

render ('header', array('name'=>isLogged() ? $_SESSION['ime'] : ''));
if(isset($_SESSION['success'])){
  echo '<div class="alert alert-success">'.$_SESSION['success'].'</div>';
  unset($_SESSION['success']);
}
