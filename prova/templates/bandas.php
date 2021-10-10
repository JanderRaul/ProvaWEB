<div class="bandas" id="bd">
    <h4>Bandas</h4>
    <div class="row">
        <?php foreach($bandas as $banda) { ?>
            <div class="col s4 md3">
                <div class="card z-depth-0" style="font-size: 17px; border-radius: 10px; background: #010f1f; color: #fff;">
                    <div class="card-content">
                        <h6 class="center" style="font-family: 'New Rocker', cursive; font-size: 32px; border-radius: 10px; background: #FFF; padding: 30px 10px; color: #010f1f;"><?php echo htmlspecialchars($banda['nm_banda']); ?></h6>
                    </div>
                    <div class="card-action right-align" style="border-radius: 10px">
                        <a class="brand-text" href="informacao.php?id=<?php echo $banda['id_banda'] ?>">Informações</a>
                    </div>
                </div>
            </div>
        <?php } ?>			
    </div>
</div>