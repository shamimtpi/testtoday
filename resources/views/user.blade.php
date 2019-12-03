<?php
use Illuminate\Support\Facades\Route;
$currentPaths= Route::getFacadeRoot()->current()->uri();  
$url = URL::to("/");
$setid=1;
    $setts = DB::table('settings')
    ->where('id', '=', $setid)
    ->get();
$default = DB::table('codepopular_langs')
                ->where('lang_default','=',1)
               ->get();


$default_cnt = DB::table('codepopular_langs')
                ->where('lang_default','=',1)
               ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }     
?>


<!DOCTYPE html>
<html lang="en">
<head>

    

   @include('style')
  <title><?php echo translate( 25, $lang);?> - <?php echo translate( 517, $lang);?></title>

   
   <link rel="stylesheet" href="{{$url}}/local/resources/views/theme/css/page/user-profile.css">

  <script type="text/javascript">
    $(document).ready(function() {
        

        $(".listShow").cPager({
            pageSize:6, 
            pageid: "welpager", 
            itemClass: "li-item",
      pageIndex: 1

        });
  });
    </script>

</head>
<body>

    <!-- fixed navigation bar -->
    @include('header')

<div class="row justify-content-center">
  @if(Session::has('success'))
        <div class="alert alert-success">
          {{ Session::get('success') }}
        </div>

    @endif
    
    @if(Session::has('error'))
        <div class="alert alert-danger">
          {{ Session::get('error') }}

        </div>
    @endif
</div>

<br>
<section data-id="home" class="pt-page pt-page-home">
   <div class="section-inner start-page-content container">
      <div class="page-header" style="background:url(
        @if($user[0]->profile_banner!="")
          {{$url}}/local/images/media/userphoto/{{$user[0]->profile_banner}}
        @else
        {{$url}}/local/images/no-banner.jpg
      
        @endif
      )no-repeat scroll 0 0 / 100% 100%">
         <div class="profile-overlay">
         <div class="row">
            <div class="col-sm-4 col-md-4 col-lg-4">
               <div class="photo">
                  <a href="{{url()->current()}}">
                   @if($user[0]->photo!="")
                     <img src="{{$url}}/local/images/media/userphoto/<?php echo $user[0]->photo;?>" alt="{{$user[0]->name}}">
                    @else
                    <img src="{{$url}}/local/images/nophoto.jpg" alt="{{$user[0]->name}}">
                     @endif
                  </a>
                
               </div>
            </div>
            <div class="col-sm-8 col-md-8 col-lg-8">
               <div class="title-block">
                  <h1>{{$user[0]->name}}</h1>
                   <div class="sp-subtitle" style="padding-top:20px">
                    {{$user[0]->profile_title}} 
                     @if(Auth::check())
                    @if(Auth::user()->id==$user[0]->id)
                    <i class="fa fa-pencil edit_user_title"></i>
                     @endif
                    @endif
                   </div>
                   
                   <div class="user_title_input">
                   <form action="{{ route('profile_title') }}" method="post">
                    @csrf
                   <input maxlength="80" name="profile_title" value="{{$user[0]->profile_title}}"/>
                   @if(Auth::check())
                    <input type="hidden" value="{{Auth::user()->id}}"  name="user_id">
                    @endif
                   <div class="float-right">
                      <button type="button" id="user_title_cencel" class="btn btn-secondary btn-sm">cencel</button>
                      <button type="submit" id="user_update_title" class="btn btn-primary  btn-sm">Add</button>
                  </div>
                  </form>
                  </div>
                 
               </div>
               <div class="social-links">
                  <a href="#" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a>
                  <a href="#" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a>
                  <a href="#" target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a>
                  <a href="#" target="_blank" title="LinkedIn"><i class="fa fa-linkedin"></i></a>
               </div>
             
             
            </div>
         </div>
         </div>
      </div>
      <div class="page-content">
         <div class="fw-page-builder-content">
            <section class="fw-main-row ">
               <div class="fw-container">
                  <div class="row">
                     <div class=" col-xs-12 col-sm-6 ">
                        <div id="" class="fw-col-inner" data-paddings="0px 0px 0px 0px">
                           <div class="block-title">
                              <h3>About<span> Me</span></h3>
                           </div>
                           <p class="text-justify">{!! \Illuminate\Support\Str::words($user[0]->about, 80,' ')  !!} <i class="fa fa-pencil"></i></p>
                           <a href="#user_contact" class="btn btn-primary">Hire Me</a>  
                            <a href="#cp_portfolio" class="btn btn-success">Portfolio</a>
                        </div>
                     </div>
                     <div class=" col-xs-12 col-sm-6 ">
                        <div id="col_inner_id-5d38a57151160" class="fw-col-inner" data-paddings="0px 0px 0px 0px">
                           <div id="info-list-5d38a57151200" class="info-list">
                              <ul class="fw-info-list info-list">
                                 <li><span class="title">Joined</span>
                                    <span class="value">
                                    
                  
                                      {{\Carbon\Carbon::parse($user[0]->created_at)->format('d M Y')}}
                                    </span>
                                 </li>
                                 <li><span class="title">Residence</span>
                                    <span class="value">
                                    @if(!empty($country->country_name))
                                    {{$country->country_name}}
                                    @endif              
                                 </span>
                                 </li>
                                 <li><span class="title">Address</span>
                                    <span class="value">
                                      @if(!empty($user[0]->address))
                                       {{$user[0]->address}}
                                      {{$user[0]->address}}
                                      
                                      @endif
                                  </span>
                                 </li>
                                 @if($profile_status=="on")
                                 @if(!empty($user[0]->email))
                                 <li>
                                  <span class="title">e-mail</span>
                                    <span class="value">
                                    <a href="mailto:{{$user[0]->email}}" target="_self">
                                    {{$user[0]->email}}
                                     </a>
                                    </span>
                                 </li>
                                 @endif
                                 <li><span class="title">Phone</span>
                                    <span class="value">
                                      {{$user[0]->phone}}
                                    </span>
                                 </li>
                                @endif
                                 <li><span class="title">Freelance</span>
                                    <span class="value">
                                    Available                 </span>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
         </div>
      </div>
   </div>
</section>
<section data-id="resume" class="pt-page-resume pt-page-current pt-page-relative">
   <div class="section-inner custom-page-content container"  style="padding-top:30px">
      <div class="page-header">
         <h2 class="section-title">Resume</h2>
      </div>
      <div class="page-content">
         <div class="fw-page-builder-content">
            <section class="fw-main-row ">
               <div class="fw-container">
                  <div class="row">
                     <div class=" col-xs-12 col-sm-6 ">
                        <div id="col_inner_id-5d38acb723e19" class="fw-col-inner" data-paddings="0px 0px 0px 0px">
                           <div class="block-title">
                              <h3>Education<span> Qualification</span> </h3>

                           </div>
                         
                          @foreach($user_edu_lists as $user_edu_list)
                           
                            <div class="timeline" id="user_edu{{$user_edu_list->id}}">
                              <div class="timeline-item">
                                 <h4 class="item-title">{{$user_edu_list->institute_name}}</h4>
                                 <span class="item-period">{{$user_edu_list->passing_year}}</span>
                                 <span class="item-small">{{$user_edu_list->degree}}</span>
                                 <p>{{$user_edu_list->details}}</p>
                              </div>
                               <div class="user_edu_action">
                                @if(Auth::check())
                                @if(Auth::user()->id==$user[0]->id)
                              
                                  <a href="javascript::void(0)" class="user_edu_edit" id="{{$user_edu_list->id}}"><i class="fa fa-pencil"></i></a>
                                  <a href="#" class="user_edu_trash" id="{{$user_edu_list->id}}"><i class="fa fa-trash"></i></a>
                               
                               @endif
                               @endif
                               </div>
                            </div>
                                @if(Auth::check())
                                @if(Auth::user()->id==$user[0]->id)
                            @include('template-parts.user.user_edu_edit')
                               @endif
                               @endif

                          @endforeach
                                 @if(Auth::check())
                                @if(Auth::user()->id==$user[0]->id)
                          @include('template-parts.user.user_edu_add')
                               @endif
                               @endif

                           <div class="fw-divider-space" style="padding-top: 30px;">
                             
                           </div>
                        </div>
                     </div>
                     <div class=" col-xs-12 col-sm-6 ">
                        <div id="col_inner_id-5d38acb723ffd" class="fw-col-inner" data-paddings="0px 0px 0px 0px">
                           <div class="block-title">
                              <h3>Employment<span> History</span></h3>
                           </div>
                     
                          @foreach($user_emp_historys as $user_emp_history)
                          
                            <div class="timeline" id="user_emp{{$user_emp_history->id}}">
                              <div class="timeline-item">
                                 <h4 class="item-title">{{$user_emp_history->title}}</h4>
                                <span class="item-period">{{date('M Y', strtotime($user_emp_history->start_date))}}

                                  - @if($user_emp_history->end_date == '')
                                  <span style="color:red">
                                 
                                  Current *
                                  </span>
                                  @else
                                 {{date('M Y', strtotime($user_emp_history->end_date))}}
                                  @endif
                                </span>
                                 <span class="item-small">{{$user_emp_history->company_name}}.</span>
                                 <p>{{$user_emp_history->emp_details}}.</p>
                              </div>
                               <div class="user_edu_action">
                                 @if(Auth::check())
                                 @if(Auth::user()->id==$user[0]->id)
                                  <a href="javascript::void(0)" class="user_emp_edit" id="{{$user_emp_history->id}}"><i class="fa fa-pencil"></i></a>
                                  <a href="javascript::void(0)" class="user_emp_trash" id="{{$user_emp_history->id}}"><i class="fa fa-trash"></i></a>
                                    @endif
                                    @endif
                               </div>
                            </div>
                            @include('template-parts.user.user_emp_edit')

                          @endforeach
                                @if(Auth::check())
                                @if(Auth::user()->id==$user[0]->id)
                          @include('template-parts.user.user_emp_add')
                               @endif
                               @endif
                           <div class="fw-divider-space" style="padding-top: 30px;"></div>
                        </div>
                     </div>
                  </div>

                   <div class="height30"></div>
                  <div class="block-title">
                         <h3>Professional<span> Skills</span></h3>
                  </div>
                  <div class="row">
                    @foreach($userskills as $userskill)
                     <div class="col-xs-12 col-sm-6 ">
                           <div class="skills-info">
                              <h4>{{$userskill->title}}</h4>
                              <div id="skill-1" class="skill-container">
                                 <div class="skill-percentage" style="width:{{$userskill->skill_value}}%"></div>
                                 @if(Auth::check())
                                 @if(Auth::user()->id==$userskill->user_id)
                                 <div class="skill_action">
                                   <button  id="{{$userskill->id}}" class="btn btn-info btn-sm edit_skill" data-toggle="modal" data-target="#edit_skill_modal">
                                    <i class="fa fa-pencil"></i>
                                  </button>
                                   <button class="btn btn-danger btn-sm trash" id="{{$userskill->id}}" data-toggle="modal" data-target="#skill_modal_delete">
                                    <i class="fa fa-close"></i>
                                  </button>
                                 </div>
                                 @endif
                                 @endif
                              </div>
                           </div>
                     </div>
                    @endforeach


                  </div>
                    @if(Auth::check())
                       @if(Auth::user()->id==$user[0]->id)
                   <button id="add_btn" type="button"  data-toggle="modal" data-target="#addskill" class=" btn btn-primary btn-sm float-right d-inline-block"></i> Add Skill</button>
                   @endif
                   @endif
                
                   <div class="height40"></div>
               </div>
            </section>
         </div>
      </div>
   </div>
</section>

 @include('template-parts.user.user-portfolio')



  <!--Start Contact Section-->
  <div class="user-contact-section" id="user_contact">
      <div class="container section-inner">
            <div class="page-header">
           <h2 class="section-title">Hire Me</h2>
         </div>
        <div class="row justify-content-center">
          
           <div class="col-lg-6 col-md-6">
              <div class="height50"></div>
              <form method="post" action="{{ route('user') }}" class="form" role="form" id="formID">
              {{ csrf_field() }}
              <div class="row">
              <input type="hidden" id="vendor_id" name="vendor_id" placeholder="" class="input-xlarge" value="<?php echo $user[0]->id;?>">
              <div class="col-xs-6 col-md-6 form-group">
              <input class="form-control validate[required]" id="name" name="name" placeholder="<?php echo translate( 244, $lang);?>" type="text" autofocus />
              </div>
              <div class="col-xs-6 col-md-6 form-group">
              <input class="form-control validate[required,custom[email]]" value="<?php if(Auth::check()) { echo Auth::user()->email; }?>" id="email" name="email" placeholder="<?php echo translate( 247, $lang);?>" type="email"/>
              </div>
              </div>
              
              <div class="col-xs-12 col-md-12 form-group paddingoff">
              <input class="form-control validate[required]" id="phone" name="phone" placeholder="<?php echo translate( 340, $lang);?>" type="text" />
              </div>
              <textarea class="form-control validate[required]" id="msg" name="msg" placeholder="<?php echo translate( 250, $lang);?>" rows="5"></textarea>
              <br />
              <div class="row text-center">
              <div class="col-xs-12 col-md-12 form-group">
              <button class="btn btn-primary text-center" type="submit"><?php echo translate( 580, $lang);?></button>
              </div>
                </form>
           </div>
         </div>

      </div>
  </div>
  <!--End Contact Section-->
<br>
<br>



@include('template-parts.user.usermodels');

      @include('footer')


<script>
// handle links with @href started with '#' only
$(document).on('click', 'a[href^="#"]', function(e) {
    // target element id
    var id = $(this).attr('href');
    // target element
    var $id = $(id);
    if ($id.length === 0) {
        return;
    }
    // prevent standard hash navigation (avoid blinking in IE)
    e.preventDefault();

    // top position relative to the document
    var pos = $id.offset().top;

    // animated top scrolling
    $('body, html').animate({scrollTop: pos});
});
</script>





<script> 

// Employment History edit form


  // user title
  $('.user_title_input').hide();
  $('.edit_user_title').click(function(){
    var id=$(this).attr('id');
     $('.sp-subtitle').hide();
     $('.user_title_input').show();
    });

  $('#user_title_cencel').click(function(){
     var id=$(this).attr('id');
    $('.user_title_input').hide();
      $('.sp-subtitle').show();
  });



  $('.user_emp_class').hide();
  $('.user_emp_edit').click(function(){
    var id=$(this).attr('id');
     $('.user_emp_class').hide();
     $('.timeline').show();
    $('#user_emp'+id).hide();
    $('#user_emp_edit_form'+id).show();
    });

  $('.emp_edit_cencel').click(function(){
     var id=$(this).attr('id');
     $('#user_emp_edit_form'+id).hide();
      $('#user_emp'+id).show();
  });

   // Employment add form
 $('#emp_form').hide();
 $('#add_emp').click(function(){
   $('#emp_form').show();
});
$('#emp_cencel').click(function(){
   $('#emp_form').hide();
});

// date picker
  $( ".emp_date" ).datepicker();
 // current working action

$('.current_working').click(function(){
    if($(this).is(":checked")){
       $('.checked_hide').hide();
      
    }
    else if($(this).is(":not(:checked)")){
        $('.checked_hide').show();

    }
});


 /*********************************
         Employment History Edit
  **************************************/
   $('.user_emp_edit').click(function(){
        var id=$(this).attr('id');
        var url='{{route("user-employment.edit",":id")}}';
        var url = url.replace(':id', id);
        var url2='{{route("user-employment.update",":id")}}';
        var url2 = url2.replace(':id', id);
        // edit
         $.ajax({
            url:url,
            type:'GET',
            dataType:'json',
            success:function(data){
               $('.title').val(data.title);
               $('.company_name').val(data.company_name);
               $('.edit_start_date').val(data.start_date);
               $('.edit_end_date').val(data.end_date);
              
               $('.emp_edit_detials').val(data.emp_details);
               $('.emp_edit_form').attr('action',url2);
            }
        });
      });





  /*********************************
         Employment History Delete
  **************************************/
 $('.user_emp_trash').click(function(e){
    e.preventDefault();
    var id=$(this).attr('id');
      var edu_deleted = confirm("Want to delete?");
      if (edu_deleted) {
        var url='{{route("user-employment.destroy",":id")}}';
        url = url.replace(':id', id);
        var csrf_token=$('meta[name="csrf-token"]').attr('content');
        $.ajax({
           url:url,
           type:'POST',
           data:{'_method':'DELETE','_token': csrf_token },
           success:function(data){
               $('#user_emp'+id).hide();
           }
       });
      }

    });

</script>
<script>

/**********************************
      Education Edit Form
**************************************/

  $('.user_edit_class').hide();
  $('.user_edu_edit').click(function(){
    var id=$(this).attr('id');
     $('.user_edit_class').hide();
     $('.timeline').show();
    $('#user_edu'+id).hide();
    $('#user_edu_edit_form'+id).show();
    });

  $('.edu_edit_cencel').click(function(){
     var id=$(this).attr('id');
     $('#user_edu_edit_form'+id).hide();
      $('#user_edu'+id).show();
  });
   

  /*********************************
         Education add form
  **************************************/
 $('#edu_form').hide();
 $('#add_education').click(function(){
   $('#edu_form').show();
});
$('#edu_cencel').click(function(){
   $('#edu_form').hide();
});







  /*********************************
         Education Edit
  **************************************/


   $('.user_edu_edit').click(function(){
        var id=$(this).attr('id');
        var url='{{route("user-edu.edit",":id")}}';
        var url = url.replace(':id', id);
        var url2='{{route("user-edu.update",":id")}}';
        var url2 = url2.replace(':id', id);
        // edit
         $.ajax({
            url:url,
            type:'GET',
            dataType:'json',
            success:function(data){
               $('.edit_institute').val(data.institute_name);
               $('.edu_edit_detials').val(data.details);
               $(".edit_digree").val(data.degree)
               $(".edit_passing_year").val(data.passing_year)
               $('.edu_edit_form').attr('action',url2);
            }
        });
      });



  /*********************************
         Education Delete
  **************************************/

  $('.user_edu_trash').click(function(e){
    e.preventDefault();
    var id=$(this).attr('id');
      var edu_deleted = confirm("Want to delete?");
      if (edu_deleted) {
        var url='{{route("user-edu.destroy",":id")}}';
        url = url.replace(':id', id);
        var csrf_token=$('meta[name="csrf-token"]').attr('content');
        $.ajax({
           url:url,
           type:'POST',
           data:{'_method':'DELETE','_token': csrf_token },
           success:function(data){
               $('#user_edu'+id).hide();
           }
       });
      }

    });
  </script>





 <!-- Edit Skill -->
  <script>
    $('.edit_skill').click(function(){
        var id=$(this).attr('id');
        var skill_url='{{route("myskill.edit",":id")}}';
        var get_skill_url = skill_url.replace(':id', id);
        var url2='{{route("myskill.update",":id")}}';
        var url2 = url2.replace(':id', id);
        // edit
         $.ajax({
            url:get_skill_url,
            type:'GET',
            dataType:'json',
            success:function(data){
               $('#edit_title').val(data.title);
               $('#edit_skill_value').val(data.skill_value);
               $('#skillupdate').attr('action',url2);
            }
        });
      });
  </script>


 <script>
    $('.trash').click(function(){
       var id=$(this).attr('id');
       var url='{{route("myskill.destroy",":id")}}';
       var url = url.replace(':id', id);
        $('#skilldeleted').attr('action',url);
    });
</script>




</body>
</html>