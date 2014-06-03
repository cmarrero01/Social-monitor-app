<?=$header; ?>



<div id="container-smtv">
	<h3>Nombre del Filtro</h3>
	<div class="filtros-tabla clearfix">

		<a href="#" id="more">More</a>
		<input type="hidden" name="since_id" id="since_id" value="<?=$since_id;?>" />
		<input type="hidden" name="next" id="next" value="<?=$facebook['paging']['next'];?>" />
		<table>
			<thead>
		    	<tr>
		        	<th></th>
		        	<th></th>
		        </tr>
		    </thead>
			<tbody id="moreTwitts">  	
			<?=$filter_partial;?>
			</tbody>
		    <thead>
		    	<tr>
		        	<th>Twitt</th>
		        </tr>
		    </thead>
		</table>

	</div><!-- end filtros-tabla -->
</div><!-- end container-smtv -->


<script>
$(document).ready(function() {
    $('#more').live('click',function(){

		var since_id = $('#since_id').val();
		var next = $('#next').val();
		
		var data = {
			since_id:since_id,
			next:next
		}
		
		$.get('/home/show/<?=$argument;?>/true',data,function(r){
			$('#moreTwitts').prepend(r);
		});
	});
});
</script>


<?=$footer;?>