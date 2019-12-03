<!-- add user education-->
                           <div class="user_edu_add_form">
                                   <button id="add_education" type="button" class="btn btn-primary float-right d-inline-block btn-sm"><i class="fa fa-plus"></i> Add New</button>
                                  <form action="{{route('user-edu.store')}}" method="post" id="edu_form">
                                    @csrf
                                   <div class="height30"></div>
                                    <div class="form-group">
                                      <label for="insitute">Institute name</label>
                                      <input type="text" class="form-control" id="insitute" placeholder="Ex: Oford Univercity" name="institute_name" required="required">
                                      @if($errors->has('institute_name'))
                                      <p class="help-block"> {{$errors->first('institute_name')}}</p>
                                      @endif
                                    </div>

                                    <div class="form-group">
                                      <label for="degree">Degree</label>
                                       <select name="degree" id="degree" required="required">
                                        <option value="">Title</option>
                                        <option value="Secondary School Certificate">S.S.C</option>
                                        <option value="Higher Secondary Certificate">H.S.C</option>
                                        <option value="Diploma">Diploma</option>
                                        <option value="associate">Associate</option>
                                        <option value="certificate">Certificate</option>
                                        <option value="ba">B.A.</option>
                                        <option value="barch">BArch</option>
                                        <option value="bm">BM</option>
                                        <option value="bfa">BFA</option>
                                        <option value="bsc">B.Sc.</option>
                                        <option value="ma">M.A.</option>
                                        <option value="mba">M.B.A.</option>
                                        <option value="mfa">MFA</option>
                                        <option value="msc">M.Sc.</option>
                                        <option value="jd">J.D.</option>
                                        <option value="md">M.D.</option>
                                        <option value="phd">Ph.D</option>
                                        <option value="llb">LLB</option>
                                        <option value="llm">LLM</option>
                                       </select>

                                    </div> 

                                    <div class="form-group">
                                      <label for="edit_passing_year">Passing Year</label>
                                        <select name="passing_year" id="edit_passing_year" required="required">
                                          <option value="" class="hidden">Year</option><option value="2019">2019</option><option value="2018">2018</option><option value="2017">2017</option><option value="2016">2016</option><option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option>
                                        </select>
                                    </div> 

                                     <div class="form-group">
                                      <label for="edu_detials">Details</label>
                                          <textarea name="details" id="edu_detials" required="required"></textarea>
                                    </div>

                                     @if(Auth::check())
                                      <input type="hidden" value="{{Auth::user()->id}}"  name="user_id">
                                      @endif
                                  <div class="float-right">
                                      <button type="button" id="edu_cencel" class="btn btn-secondary btn-sm">cencel</button>
                                      <button type="submit" id="edu_add" class="btn btn-primary  btn-sm">Add</button>
                                  </div>
                                  </form>

                              </div> 
                            <!-- end add user education -->