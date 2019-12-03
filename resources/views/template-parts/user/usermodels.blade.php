
<!-- All Modals -->
 <!-- skill add modal -->
 <form action="{{route('myskill.store')}}" method="post">
  @csrf
 <div class="container">
  <div class="modal fade" id="addskill">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add New Skill</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">

            <div class="form-group">
              <label for="title">Skill</label>
              <input type="text" class="form-control" placeholder="Ex: html5" name="title" required="required">
            </div>

             <div class="form-group">
              <label for="title">Skill Range</label>
              <input type="range" class="form-control" name="skill_value" min="0" max="99" required="required">
            </div>
             @if(Auth::check())
            <input type="hidden" value="{{Auth::user()->id}}"  name="user_id">
            @endif
          
        </div>
        
        <div class="modal-footer">
          <a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
          <button type="submit" class="btn btn-info">Add Skill</button>
        </div>

        
      </div>
    </div>
  </div>
</div>
</form>
 <!-- skill add modal -->
  <!--Edit Skill --> 
 <form action="#" method="post" id="skillupdate">
      @method('put')
      @csrf
 <div class="container">
  <div class="modal fade" id="edit_skill_modal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add New Skill</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">

            <div class="form-group">
              <label for="title">Skill</label>
              <input type="text" class="form-control" placeholder="Ex: html5" name="title" required="required" id="edit_title">
            </div>

             <div class="form-group">
              <label for="title">Skill Range</label>
              <input type="range" class="form-control" name="skill_value" min="0" max="99" required="required" id="edit_skill_value">
            </div>
             @if(Auth::check())
            <input type="hidden" value="{{Auth::user()->id}}"  name="user_id">
            @endif
          

        </div>
        
        <div class="modal-footer">
          <a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
          <button type="submit" class="btn btn-info">Add Skill</button>
        </div>

        
      </div>
    </div>
  </div>
</div>
</form> 

<!--Edit Skill --> 

<!-- Skill Deleted -->
 <form method="post" id="skilldeleted"> 
     <input name="_method" type="hidden" value="DELETE">
  @csrf
 <div class="container">
  <div class="modal fade" id="skill_modal_delete">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <!-- Modal body -->
        <div class="modal-body">
           <h4 class="text-center">Are you sure want to delete data</h4>
        </div>
        
        <div class="modal-footer">
          <a href="#" class="btn btn-info" data-dismiss="modal">Close</a>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>

        
      </div>
    </div>
  </div>
</div>
</form>

  <!--Skill Deleted --> 
<!-- End Skill Modal -->
