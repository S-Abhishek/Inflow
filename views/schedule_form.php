		</div>
          <div id="menu1" class="tab-pane fade-in active">
				<p id="uid1" style="display:none"  ><?php echo $_SESSION['u_id']; ?></p>
<button type="button" class="btn btn-default btn-lg" id="AddSch"><span></span></button>
  <div class="modal fade mcount" id="SchModal" role="dialog">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4>Add Task</h4>
        </div>
        <div class="modal-body">
          
          <input id="schtitl" type="text" placeholder="Enter Event Title"></input>
          <div id="datepicker1" class="input-append">
            <input id="schdat" type="text" placeholder="Enter Event Date"></input>
            <span class="add-on">
              <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
            </span>
            </div>
     

      
        <div id="timepicker1" class="input-append">
         <input id="schtim" type="text" placeholder="Enter Event Time"></input>
           <span class="add-on">
            <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
          </span>
        </div>
        <button id="adds">Add</button>
      </div>

</div>
<br>
<br> 
  <p id="ey"></p>
  <div id="x">
        <ul id="horizontal-style">
            
        </ul>
</div>


