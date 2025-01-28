<div class="col-lg-4 col-12">
    <div class="side-bar p-3">
        <div class="d-flex flex-column mt-3 my-account-tab-list nav">
            
                <span class="sidebar-item-title2"><a href="#dashboad"  data-bs-toggle="tab"><i
                            class="lastudioicon-home-2"></i>@langucw('dashboard')</a></span>
              
               
           
            
                <span class="sidebar-item-title2"><a href="#orders" data-bs-toggle="tab"><i class="dlicon files_notebook"></i>@langucw('Orders') </a></span>
               
           
            
                <span class="sidebar-item-title2"><a href="#referral" data-bs-toggle="tab"><i class="dlicon arrows-1_cloud-download-93"></i>@langucw('the referral')</a></span>
               
               
           
            
                <span class="sidebar-item-title2"><a href="#points" data-bs-toggle="tab"><i class="dlicon location_map-big"></i>@langucw('points') </a></span>
               
               
           
            
                <span class="sidebar-item-title2"><a href="#user-occasion" data-bs-toggle="tab"><i class="dlicon location_map-big"></i> @langucw('user-occasion')</a></span>
               
               
           
            
                <span class="sidebar-item-title2"><a href="#account-info" data-bs-toggle="tab"><i class="dlicon users_single-01"></i>{{ __('Account Details') }}</a></span>
               
               
           
            
                <span class="sidebar-item-title2"><form id="logout-form" method="POST" action="{{ route('logout') }}">@csrf<a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dlicon arrows-1_log-out">@langucw('Logout')</a></form></span>
               
               
           
        </div>
    </div>
    
</div>
