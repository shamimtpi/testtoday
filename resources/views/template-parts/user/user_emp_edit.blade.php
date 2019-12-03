<!-- Edit education -->

 <div id="user_emp_edit_form{{$user_emp_history->id}}" class="user_emp_class">
          <form action="#" method="post" class="emp_edit_form">
              @method('put')
               @csrf
               <div class="form-group">
                <label for="Title">Title</label>
                <input type="text" class="form-control title" name="title" placeholder="Ex: Web Developer" required="required">
              </div>

              <div class="form-group">
                <label for="comapny_name">Company Name</label>
                <input type="text" class="form-control company_name" name="company_name" placeholder="Ex: Apple inc" required="required">
              </div>

              <div class="form-group">
                <label class="form-check-label"> </label>
                  Currently Working<input type="checkbox" name="currently_working" class="form-check-input current_working" value="true">
              </div>


               <div class="row">    
                   <div class="col">
                      <div class="form-group">
                        <label for="degree">Start Date</label>
                         <input type="text" class="form-control emp_date edit_start_date" name="start_date" required="required" autocomplete="false">
                      </div> 
                    </div> 
                 <div class="col checked_hide">
                    <div class="form-group">
                      <label for="edit_passing_year">End Date</label>
                        <input type="text" class="form-control emp_date edit_end_date" name="end_date" autocomplete="false">
                    </div> 
                </div>
             
            </div>

             <div class="form-group">
              <label for="edu_detials">Details</label>
                  <textarea name="emp_details" class="emp_edit_detials"></textarea>
            </div>

            <div class="float-right">
                <button type="button" id="{{$user_emp_history->id}}" class="btn btn-secondary btn-sm emp_edit_cencel">cencel</button>
                <button type="submit" id="emp_update" class="btn btn-primary  btn-sm">Update</button>
            </div>
          </form>

<div class="height50"></div>
            </div> 
          <!-- Edit education -->