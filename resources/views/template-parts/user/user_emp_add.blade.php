<!-- add user education-->
   <div class="user_emp_add_form">
           <button id="add_emp" type="button" class="btn btn-primary float-right d-inline-block btn-sm"><i class="fa fa-plus"></i> Add New</button>
          <form action="{{route('user-employment.store')}}" method="post" id="emp_form">
            @csrf
           <div class="height30"></div>
            <div class="form-group">
              <label for="Title">Title</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Ex: Web Developer" required="required">
            </div>
            <div class="form-group">
              <label for="comapny_name">Company Name</label>
              <input type="text" class="form-control" id="comapny_name" name="company_name" placeholder="Ex: Apple inc" required="required">
            </div>

          <div class="form-group">
      <label class="form-check-label"> </label>
        Currently Working<input type="checkbox" name="currently_working" class="form-check-input current_working">
       </div>

          <div class="row">    
                 <div class="col">
                    <div class="form-group">
                      <label for="degree">Start Date</label>
                       <input type="text" class="form-control emp_date" name="start_date" required="required" autocomplete="off">
                    </div> 
                  </div> 
               <div class="col checked_hide">
                  <div class="form-group">
                    <label for="edit_passing_year">End Date</label>
                      <input type="text" class="form-control emp_date" name="end_date" autocomplete="off">
                  </div> 
              </div> 
          </div> 

             <div class="form-group">
              <label for="edu_detials">Details</label>
                  <textarea name="emp_details" id="emp_details" required="required"></textarea>
            </div>
              @if(Auth::check())
                <input type="hidden" value="{{Auth::user()->id}}"  name="user_id">
              @endif
          <div class="float-right">
              <button type="button" id="emp_cencel" class="btn btn-secondary btn-sm">cencel</button>
              <button type="submit" id="emp_add" class="btn btn-primary  btn-sm">Add</button>
          </div>
          </form>

      </div> 
    <!-- end add user education -->


