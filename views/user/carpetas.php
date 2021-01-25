<?php if($no_ver == false){ ?>
   <?php if($_GET['ruta'] != ''){ ?>
      <a href="<?= base_url ?>directorio/anterior/<?= $_GET['ruta'] ?>" class="atras"><i class="fas fa-reply" style="margin-right: 6px; color: #484c4c;"></i>..</a>
   <?php } ?>
   <?php if($vacio == true){ ?>
   <?php if(isset($_SESSION['archivo'])){ ?>
       <div class="grid-5">
           <div><i class="i fas fa-file-alt archivo"></i></div>
           <div class="name-deta"><?= $_SESSION['archivo']['nombre'] ?></div>
           <div>Extension: <?= $_SESSION['archivo']['extension'] ?></div>
           <div>Tamaño: <?= $_SESSION['archivo']['size'] ?> <?= isset($_SESSION['mb']) ? 'MB' : 'KB' ?></div>
           <div><a href="<?= $_SESSION['archivo']['ruta'] ?>" download="<?= $_SESSION['archivo']['nombre'] ?>.<?= $_SESSION['archivo']['extension'] ?>"><i class="i fas fa-download red"></i></a></div>
       </div>
   <?php } ?>
      <div class="grid-3">
      <?php while(false != ($archivo = readdir($gestor))){ ?>
            <?php if($archivo != '.' && $archivo != '..'){ ?>
               <?php if($carpeta->isArchivo($archivo)){ ?>
               <?php if($carpeta->isImage($archivo)){ ?>
                  <div class="carpetas">
                      <a class="a-sub mas" href="<?= base_url ?>directorio/config/<?= $_GET['ruta'] != '' ? $_GET['ruta'].'-' : ''; ?><?= $archivo ?>"><i class="fas fa-ellipsis-v"></i></a>
                      <a class="a-sub" href="<?= base_url ?>directorio/image/<?= $_GET['ruta'] != '' ? $_GET['ruta'].'-' : ''; ?><?= $archivo ?>"><?= $archivo ?></a>
                      <a class="a-sub" href="<?= base_url ?>directorio/image/<?= $_GET['ruta'] != '' ? $_GET['ruta'].'-' : ''; ?><?= $archivo ?>"><i class="far fa-image fa-2x image"></i></a>
                  </div>
               <?php }else{ ?>
                  <div class="carpetas">
                      <a class="a-sub mas" href="<?= base_url ?>directorio/config/<?= $_GET['ruta'] != '' ? $_GET['ruta'].'-' : ''; ?><?= $archivo ?>"><i class="fas fa-ellipsis-v"></i></a>
                      <a class="a-sub" href="<?= base_url ?>directorio/detalles/<?= $_GET['ruta'] != '' ? $_GET['ruta'].'-' : ''; ?><?= $archivo ?>"><?= $archivo ?></a>
                      <a class="a-sub" href="<?= base_url ?>directorio/detalles/<?= $_GET['ruta'] != '' ? $_GET['ruta'].'-' : ''; ?><?= $archivo ?>"><i class="fas fa-file-alt fa-2x archivo"></i></a>
                  </div> 
               <?php } ?>
               <?php }else{ ?>
                  <div class="carpetas">
                      <a class="a-sub mas" href="<?= base_url ?>directorio/config/<?= $_GET['ruta'] != '' ? $_GET['ruta'].'-' : ''; ?><?= $archivo ?>"><i class="fas fa-ellipsis-v"></i></a>
                      <a class="a-sub" href="<?= base_url ?>user/carpetas/<?= $_GET['ruta'] != '' ? $_GET['ruta'].'-' : ''; ?><?= $archivo ?>"><?= $archivo ?></a>
                      <a class="a-sub" href="<?= base_url ?>user/carpetas/<?= $_GET['ruta'] != '' ? $_GET['ruta'].'-' : ''; ?><?= $archivo ?>"><i class="fas fa-folder-open fa-2x carpeta"></i></a>
                  </div>
               <?php } ?>
            <?php } ?>
      <?php } ?>
      </div>
   <?php }else{ ?>
        <h2 class="text-center">La carpeta esta vacia</h2>
   <?php } ?>
<?php }else{ ?>
   <a href="<?= base_url ?>user/carpetas/" class="atras"><i class="fas fa-reply" style="margin-right: 6px; color: #484c4c;"></i>Home</a>
    <h1>La carpeta no existe</h1>
<?php } ?>

<?php Utils::deleteSession('archivo'); ?>
<?php Utils::deleteSession('mb'); ?>