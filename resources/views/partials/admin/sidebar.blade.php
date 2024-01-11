<nav id="sidebar" class="sidebar js-sidebar">
	<div class="sidebar-content js-simplebar">
		<a class="sidebar-brand" href="index.html">
          	<span class="align-middle">SISTEM MENU</span>
        </a>

		<ul class="sidebar-nav">

			<li class="sidebar-header">
                Analytic
            </li>

            <li class="sidebar-item {{ Request::routeIs('admin.dashboard*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('admin.dashboard')}}">
					<i class="align-middle" data-feather="sliders"></i>                                                       
					<span class="align-middle">Dashboard</span>                                                       
				</a>
            </li>
                    
			<li class="sidebar-item">
				<a class="sidebar-link" href="{{ route('item.index')}}">   
					<i class="align-middle" data-feather="sliders"></i>
					<span class="align-middle">Insight</span>
				</a>
            </li>


			<li class="sidebar-header">
				Manage Items
			</li>

			<li class="sidebar-item {{ Request::routeIs('item.index*') ? 'active' : '' }}">
				<a class="sidebar-link" href="{{ route('item.index')}}">
              		<i class="align-middle" data-feather="sliders"></i>
					<span class="align-middle">Item List</span>
            	</a>
			</li>

            <li class="sidebar-item {{ Request::routeIs('item.create*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('item.create')}}">
                    <i class="align-middle" data-feather="sliders"></i>
                	<span class="align-middle"> Add Items</span>
                </a>
            </li>

			<li class="sidebar-item">
				<a class="sidebar-link" href="pages-profile.html">
              		<i class="align-middle" data-feather="user"></i> 
					<span class="align-middle">Item Discount</span>
            	</a>
			</li>

			<li class="sidebar-item">
				<a class="sidebar-link" href="pages-sign-in.html">
              		<i class="align-middle" data-feather="log-in"></i> 
					<span class="align-middle">Showing Item</span>
            	</a>
			</li>

			<li class="sidebar-header">
				Group
			</li>

			<li class="sidebar-item">
				<a class="sidebar-link" href="ui-buttons.html">
              		<i class="align-middle" data-feather="square"></i>
					<span class="align-middle">Group List</span>
        		</a>
			</li>	

			<li class="sidebar-item">                       
				<a class="sidebar-link" href="ui-buttons.html">
			        <i class="align-middle" data-feather="square"></i>  
					<span class="align-middle">Add Group</span>            
				</a>                                  
			</li>

			<li class="sidebar-header">     
				Display 
			</li>

			<li class="sidebar-item">            
				<a class="sidebar-link" href="ui-buttons.html">
			                <i class="align-middle" data-feather="square"></i>  
					<span class="align-middle">Manage Display</span>        
				</a>             
			</li>

			<li class="sidebar-item">                                                                                         
				<a class="sidebar-link" href="ui-buttons.html">
                	<i class="align-middle" data-feather="square"></i>
					<span class="align-middle">Store Settings</span>
                </a>
            </li>

		</ul>
	</div>
</nav>
