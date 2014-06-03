<?=$header;?>
<a href="#" id="more"></a>
<input type="hidden" name="since_id" id="since_id" value="<?=$since_id;?>" />
<input type="hidden" name="next" id="next" value="<?=$posts['paging']['next'];?>" />
<table>
	<thead>
    	<tr>
        	<th></th>
        	<th></th>
        </tr>
    </thead>
	<tbody>
    <div id="container-smtv">
        <div class="top">
            <h3>Filtro: <?=$filtro->name;?></h3>

            <div class="container-seemore">
                <a href="#" id="more">
                    <div class="see-more">
                        Ver Más
                    </div>
                </a>
            </div>
        </div><!-- end top -->
        <div  id="moreTwitts">
	        <?=$filter_partial;?>
        </div>
    </div><!-- end container-smtv-->
	</tbody>
    <tfoot>
    	<tr>
        	<th></th>
        </tr>
    </tfoot>
</table>

<!-- Modal para retwitter tiwtt-->
<div id="retwittPost" class="modal fade in hide">

</div>

<!-- Modal para compartir post o twitt -->
<div id="sharePost" class="modal fade in hide">

</div>

    <script>
        $('#since_id').val('<?=$since_id;?>');
        $('#next').val('<?=$posts['paging']['next'];?>');

        $(document).ready(function(e) {
            //For Retwitt
            $('.btnRetwitter').live('click',function(){
                var $this = $(this);
                $('#retwittPost').html('');

                var data = {
                    idRed:$this.data('idred'),
                    idPost:$this.data('idpost'),
                    idFiltro:$this.data('idfiltro'),
                    iduser:$this.data('iduser')
                };

                $.post('/filtros/retwittPost/',data,function(r){
                    if(r){
                        $('#retwittPost').html(r);
                    }
                });
            });
            //For share
            $('.btnShare').live('click',function(){
                var $this = $(this);
                $('#sharePost').html('');

                var data = {
                    idRed:$this.data('idred'),
                    idPost:$this.data('idpost'),
                    idFiltro:$this.data('idfiltro'),
                    iduser:$this.data('iduser')
                };

                $.post('/filtros/answerModal',data,function(r){
                    if(r){
                        $('#sharePost').html(r);
                    }
                });
            });

            filter.sendMessages();

            $('#more').live('click',function(){

                var since_id = $('#since_id').val();
                var next = $('#next').val();

                var data = {
                    since_id:since_id,
                    next:next
                }

                $.get('/filtros/see/<?=$idFiltro;?>/1/1',data,function(r){
                    console.log(r);
                    $('#moreTwitts').prepend(r);
                });
            });
        });

    </script>
<?=$footer; ?>