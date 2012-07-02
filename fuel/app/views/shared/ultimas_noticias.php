<div class="whead">
    <h6>Últimas Notícias</h6>
    <div class="clear"></div>
</div>
<?php if($noticias): ?>
<ul class="updates">
    <?php foreach($noticias as $noticia): ?>
    <li>
        <span class="uNotice">
            <?php echo Html::anchor('noticias/' . $noticia->id, $noticia->titulo, array('title' => 'Clique para ler mais', 'class' => 'tipS')); ?>
            <span>
                <?php echo Str::truncate($noticia->conteudo, 90, '...', true); ?>
            </span>
        </span>
        <span class="uDate"><span><?php echo date('d', $noticia->created_at); ?></span><?php echo date('M', $noticia->created_at); ?></span>
        <span class="clear"></span>
    </li>
    <?php endforeach ?>
</ul>
<?php endif ?>