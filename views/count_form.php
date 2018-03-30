		</div>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
            <div id="menu2" class="tab-pane fade-in">
         
              	<p id="uid" style="display:none"  ><?php echo $_SESSION['u_id']; ?></p>


				<button type="button" class="btn btn-default btn-lg" id="AddBtn"><span></span></button>
				<button class="undo">Undo</button>
				<button class="reset">Reset</button>
				<button class="save">Save Changes</button>
				<div id="counts"></div>
				<div class="container">
				    <!-- Trigger the modal with a button -->
				  

				    <!-- Modal -->
				    <div class="modal fade mcount" id="AddModal" role="dialog">

				        <div class="modal-header">
				          <button type="button" class="close" data-dismiss="modal">&times;</button>
				          <h4>Add Event</h4>
				        </div>
				        <div class="modal-body">
				          
				          <input id="titl" type="text" placeholder="Enter Event Title" maxlength="25"></input>
				          <div id="datepicker" class="input-append">
				            <input id="dat" type="text" placeholder="Enter Event Date"></input>
				            <span class="add-on">
				              <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
				            </span>
				           </div>
				     

				      
				        <div id="timepicker" class="input-append">
				         <input id="tim" type="text" placeholder="Enter Event Time"></input>
				           <span class="add-on">
				            <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
				          </span>
				        </div>
				        <button id="addevt">Add</button>
					</div>

				</div>
		</div>
	