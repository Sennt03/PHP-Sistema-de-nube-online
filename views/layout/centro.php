<div class="col-md-9 mx-auto p-5" id="central">
        <div class="card">
            <div class="card-header text-center">
                <h4><?= $_SESSION['user']->nombre ?></h4>
            </div>
            <div class="card-body">
                <div class="grid-2">
                    <div class="p-2">
                    <?php if(isset($_SESSION['aquiA'])){ ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><?= $_SESSION['aquiA'] ?></strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>
                    <?php if(isset($_SESSION['erra'])){ ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><?= $_SESSION['erra'] ?></strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } if(isset($_SESSION['oka'])){ ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong><?= $_SESSION['oka'] ?></strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>
                        <form action="<?= base_url ?>directorio/subir/<?= isset($_GET['ruta']) ? $_GET['ruta'] : ''?>" method="POST" enctype="multipart/form-data" >
                            <label for="formFile" class="form-label" id="label-sub">Subir archivos</label>
                            <input class="form-control" type="file" name="archivo" multiple>
                            <button type="submit" class="btn btn-sub"><i class="fas fa-cloud-upload-alt" style="margin-right: 6px; color: white;"></i>Subir archivos</button>
                        </form>    
                    </div>
                    <div class="p-2">
                    <?php if(isset($_SESSION['aqui'])){ ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><?= $_SESSION['aqui'] ?></strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>
                    <?php if(isset($_SESSION['err'])){ ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><?= $_SESSION['err'] ?></strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } if(isset($_SESSION['ok'])){ ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong><?= $_SESSION['ok'] ?></strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>
                        <form action="<?= base_url ?>directorio/crear/<?= isset($_GET['ruta']) ? $_GET['ruta'] : ''?>" method="POST">
                            <label for="name" class="form-label">Crear carpeta</label>
                            <input name="name" type="text" class="form-control" placeholder="Nombre de la carpeta">
                            <button type="submit" class="btn btn-sub"><i class="fas fa-folder-open" style="margin-right: 6px; color: white;"></i>Crear carpeta</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-footer">

            <?php Utils::deleteSession('ok') ?>
            <?php Utils::deleteSession('err') ?>

            <?php Utils::deleteSession('oka') ?>
            <?php Utils::deleteSession('erra') ?>
            
            <?php Utils::deleteSession('aqui') ?>
            <?php Utils::deleteSession('aquiA') ?>