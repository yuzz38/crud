<?php
   
    $url = $_SERVER["REQUEST_URI"]; 
    $is_image = ($url == "/mark90/image");
    
    $is_info = ($url == "/mark90/info");
  
?>
<h1>Марк 2 в 90 кузове</h1>
<ul class="nav nav-pills">
    <li class="nav-item">
        <a class="nav-link <?php echo $is_image ? 'active' : ''; ?>" href="../mark90/image">Картинка</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo $is_info ? 'active' : ''; ?>" href="../mark90/info">Описание</a>
    </li>
</ul>

<div class="border p-3 mt-3">
    <?php  if ($is_image) {
        require "mark90_image.php";
    } elseif ($is_info) {
        require "mark90_info.php";
    } else  {
        echo "<span>Выберите раздел выше</span>";
    }?>
</div>