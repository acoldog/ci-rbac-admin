			<hr/>
			<footer>
				<p>Copyright @ acol</p>
			</footer>
		</div><!--/.container-->


		<div class="modal fade" id="acolModal" tabindex="-1" role="dialog" aria-labelledby="acolModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header" style="border-bottom:0px;">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="line-height: 0;"><span aria-hidden="true">&times;</span></button>
		      </div>
		      <div class="modal-body">
		        	<a data-slide="prev" onclick="modalNext('-')" href="#" class="left carousel-control">‹</a>
					
					<div id="modal_body"></div>

		        	<a data-slide="next" onclick="modalNext('+')" href="#" class="right carousel-control">›</a>
		      </div>
		    </div>
		  </div>
		</div>

		<script type="text/javascript" src="<?php echo base_url();?>static/common.js"></script>
	</body>
</html>