
    <div class="filtros-tabla clearfix">
         <!-- FACEBOOK -->

        <?php foreach($posts['data'] as $p){ ?>
            <?php if(!empty($p['message'])){ ?>
        <div class="filtros-tbody">
            <div class="span1">
                <div class="post-img">
                    <img src="https://graph.facebook.com/<?=$p['from']['id'];?>/picture" />
                </div>
            </div>
            <div class="span9">
                <div class="post-texto">
                    <input type="hidden" value="<?=$p['id'];?>" name="faId" />
                    <?php
                     echo '<strong>'.$p['from']['name'].'</strong><br/>';
                     echo $this->functions->stringLength($p['message']);
                     ?>
                </div>
            </div>
            <div class="span2">
                <div class="data-red">
                    <div class="hours">
                        <span><i class="icon-time"></i><?=$this->functions->parseDate($p['created_time']);?></span>
                    </div>
                    <div class="actions">
                        <a href=""><i class="icon-globe" title=""></i><img src="<?=base_url('/media/img/line-red.png');?>"></a>
                        <a href="#retwittPost" data-toggle="modal" class="btnRetwitter" data-idred="2" data-idpost="<?=$p['id'];?>" data-iduser="<?=$p['from']['id'];?>" data-idfiltro="<?=$idFiltro;?>"><i class="icon-edit" title="Etiquetar en una publicacion"></i><img src="<?=base_url('/media/img/line-red.png');?>"></a>
                        <a href="#sharePost" data-toggle="modal" class="btnShare" data-idred="2" data-idpost="<?=$p['id'];?>" data-iduser="<?=$p['from']['id'];?>" data-idfiltro="<?=$idFiltro;?>"><i class="icon-share" title="Compartir"></i><img src="<?=base_url('/media/img/line-red.png');?>"></a>
                        <a title="Facebook"><img src="<?=base_url('/media/img/fb-icon.png');?>"></a>
                    </div>
                </div><!-- end data-red -->
            </div>
        </div><!-- end filtros-tbody -->
            <?php } ?>
        <?php } ?>

        <!-- TWITTER -->
        <?php foreach($twitts->statuses as $t){ ?>
        <div class="filtros-tbody">
            <div class="span1">
                <div class="post-img">
                    <img src="<?=$t->user->profile_image_url;?>" />
                </div>
            </div>
            <div class="span9">
                <div class="post-texto">
                    <input type="hidden" value="<?=$t->id_str;?>" name="twId" />
                    <?=$this->functions->stringLength($t->text); ?>
                </div>
            </div>
            <div class="span2">
                <div class="data-red">
                    <div class="hours">
                        <span><i class="icon-time"></i><?=$this->functions->parseDate($t->created_at);?></span>
                    </div>
                    <div class="actions">
                        <a href=""><i class="icon-globe" title=""></i><img src="<?=base_url('/media/img/line-red.png');?>"></a>
                        <a href="#retwittPost" data-toggle="modal" class="btnRetwitter" data-idred="1" data-idpost="<?=$t->id_str;?>" data-idfiltro="<?=$idFiltro;?>"><i class="icon-retweet" title="Retwitear"></i><img src="<?=base_url('/media/img/line-red.png');?>"></a>
                        <a href="#sharePost" data-toggle="modal" class="btnShare" data-idred="1" data-idpost="<?=$t->id_str;?>" data-idfiltro="<?=$idFiltro;?>"><i class="icon-share" title="Mencionar"></i><img src="<?=base_url('/media/img/line-red.png');?>"></a>
                        <a href="" title="twitter"><img src="<?=base_url('/media/img/tw-icon.png');?>"></a>
                    </div>
                </div><!-- end data-red -->
            </div>
        </div><!-- end filtros-tbody -->
        <?php } ?>
    </div><!-- end filtro-tabla -->
