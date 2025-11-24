<!-- footer -->
<footer id="quicktech-footer">
     <div class="container">
      <div class="row gap">
        <div class="col-lg-4 col-12">
         <div class="quikctech-footer-main">
          @php
          use App\Models\CompanyInfo;
          $companyinfo = CompanyInfo::orderBy('id','DESC')->first();
          @endphp
         {{-- <h3 class="text-white">{{$companyinfo->name}}</h3> --}}
        
          <p class="text-white">{!!$companyinfo->about!!}</p>
         </div>
         <br>
         <div class="quicktech-social">
          <h5>Social Media</h5>
          <ul>
            <li><a href="{{$companyinfo->facebook}}"><i class="fa-brands fa-facebook"></i></a></li>
            <li><a href="{{$companyinfo->youtube}}"><i class="fa-brands fa-youtube"></i></a></li>
            <li><a href="{{$companyinfo->instagram}}"><i class="fa-brands fa-instagram"></i></a></li>
           
          </ul>
         </div>
          
        </div>
        <div class="col-lg-8 col-12">
          <div class="row gapp">
            <div class="col-lg-4 col-6">
              <div class="quikctech-footer-inner">
                <h6>Company</h6>
                <ul>

                  @php
                  use App\Models\Page;
                  $pages = Page::orderBy('id', 'DESC')->get();
                @endphp
                  @forelse ($pages  as $page )
            
                   <li><a href="{{route('pagesdetails',$page->name)}}">{{$page->name}}</a></li>
              @empty
                
              @endforelse
                  {{-- <li><a href="#">About</a></li>
                  <li><a href="#">News</a></li>
                  <li><a href="#">Impact</a></li>
                  <li><a href="#">Our team</a></li>
                  <li><a href="#">Our interns</a></li>
                  <li><a href="#">Our content specialists</a></li>
                  <li><a href="#">Our leadership</a></li>
                  <li><a href="#">Our supporters</a></li>
                  <li><a href="#">Our contributors</a></li>
                  <li><a href="#">Careers</a></li>
                  <li><a href="#">Internships</a></li>
                  <li><a href="#">Cookie Preferences</a></li> --}}

                </ul>
              </div>
            </div>
            <div class="col-lg-4 col-6">
              <div class="quikctech-footer-inner">
                {{-- <h6>Contact</h6>
                <ul>
                  <li><a href="#">Help center</a></li>
                  <li><a href="#">Support community</a></li>
                  <li><a href="#">Share your story</a></li>
                  <li><a href="#">Press</a></li>
                </ul>
                <br> --}}
                <h6>Download Our Apps</h6>
                <ul>
                  {{-- <li><a href="#"><img src="../../../assets/frontend/images/app.png" alt=""></a></li> --}}
                  <li><a href="{{$companyinfo->app_link}}"><img src="../../../assets/frontend/images/app.png" alt=""></a></li>
                  
                </ul>

              </div>
            </div>
            <div class="col-lg-4 col-6">
              <div class="quikctech-footer-inner">
                <h6>Courses</h6>
                <ul>

                 
                   @php
                        use App\Models\Course;
                     $courses = Course::orderBy('id', 'DESC')->limit(10)->get();
                  @endphp

              @forelse ($courses  as $course )
              <li><a href="{{route('coursedetails',$course->id)}}">{{$course->name}}</a></li>
              @empty
                
              @endforelse
                  {{-- <li><a href="#">Math: Pre-K - 8th grade</a></li>
                  <li><a href="#">Math: Get ready courses</a></li>
                  <li><a href="#">Math: high school & college</a></li>
                  <li><a href="#">Test prep</a></li>
                  <li><a href="#">Science</a></li>
                  <li><a href="#">Computing</a></li>
                  <li><a href="#">Arts & humanities</a></li>
                  <li><a href="#">Economics</a></li>
                  <li><a href="#">Reading & language arts</a></li>
                  <li><a href="#">Life skills</a></li>
                  <li><a href="#">Partner courses</a></li> --}}
                 
                  
                </ul>
                

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-5">
        <div class="col-lg-12">
          <div class="quikctech-copy-right text-center">
            <p> Copyright © 2025 | {{$companyinfo->name}}  | All rights reserved | Design and Developed by <a href="https://www.quicktech-ltd.com/">QuickTech IT</a>
            </p>
          </div>
        </div>
      </div>
     </div>

    </footer>
 <!-- footer -->