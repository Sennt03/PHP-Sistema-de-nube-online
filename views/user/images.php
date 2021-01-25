<a href="<?= base_url ?>directorio/anterior/<?= $_GET['ruta'] ?>" class="atras"><i class="fas fa-reply" style="margin-right: 6px; color: #484c4c;"></i>..</a>
    <div class="grid-5">
        <div><i class="far fa-image fa-2x image"></i></div>
        <div class="name-deta">Nombre: <?= $nombre ?></div>
        <div>Extension: <?= $extension ?></div>
        <div>Tamaño: <?= $tamaño ?> <?= $mb ? 'MB' :'KB' ?></div>
        <div><a href="<?= $image ?>" download="<?= $nombre ?>.<?= $extension ?>"><i class="i fas fa-download red"></i></a></div>
    </div>
<img class="abrir-image" src="<?= $image ?>" >
