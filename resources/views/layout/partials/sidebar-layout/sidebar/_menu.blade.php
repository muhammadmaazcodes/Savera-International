<!--begin::sidebar menu-->
<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
	<!--begin::Menu wrapper-->
	<div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
		<!--begin::Menu-->
		<div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
			<!--begin:Menu item-->
			<div data-kt-menu-trigger="click" class="menu-item">
				<!--begin:Menu link-->
				<span class="menu-link">
					<span class="menu-icon">{!! getIcon('element-11', 'fs-2') !!}</span>
					<span class="menu-title">Dashboards</span>
				</span>
				<!--end:Menu link-->
			</div>
			<!--end:Menu item-->
			<!--begin:Menu item-->
			<div class="menu-item pt-5">
				<!--begin:Menu content-->
				<div class="menu-content">
					<span class="menu-heading fw-bold text-uppercase fs-7">Trade</span>
				</div>
				<!--end:Menu content-->
			</div>
			<!--end:Menu item-->
			<!--begin:Menu item-->
			<div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Request::is('international-contract') || Request::is('international-contract/*') ? 'show' : '' }}">
				<!--begin:Menu link-->
				<span class="menu-link">
					<span class="menu-icon">{!! getIcon('address-book', 'fs-2') !!}</span>
					<span class="menu-title">International</span>
					<span class="menu-arrow"></span>
				</span>
				<!--end:Menu link-->
				<!--begin:Menu sub-->
				<div class="menu-sub menu-sub-accordion">
					<!--begin:Menu item-->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link" href="/international-contract">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">View All Contracts</span>
						</a>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
					<!--begin:Menu item-->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link" href="/international-contract/create">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">New Contract</span>
						</a>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
				</div>
				<!--end:Menu sub-->
			</div>
			<!--end:Menu item-->
						<!--begin:Menu item-->
			@if (Auth::user()->role_as == 'admin' || Auth::user()->role_as == 'full' || Auth::user()->role_as == 'lic')
				<div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Request::is('local-contracts') || Request::is('local-contracts/*') ? 'show' : '' }}">
					<!--begin:Menu link-->
					<span class="menu-link">
						<span class="menu-icon">{!! getIcon('address-book', 'fs-2') !!}</span>
						<span class="menu-title">Local Contract</span>
						<span class="menu-arrow"></span>
					</span>
					<!--end:Menu link-->
					<!--begin:Menu sub-->
					<div class="menu-sub menu-sub-accordion">
						<!--begin:Menu item-->
						<div class="menu-item">
							<!--begin:Menu link-->
							<a class="menu-link" href="/local-contracts/contracts">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title">View All</span>
							</a>
							<!--end:Menu link-->
						</div>
						<!--end:Menu item-->

						<!--begin:Menu item-->
						<div class="menu-item">
							<!--begin:Menu link-->
							<a class="menu-link" href="/local-contract/create">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title">Add New</span>
							</a>
							<!--end:Menu link-->
						</div>
						<!--end:Menu item-->

						<!--begin:Menu item-->
						<div class="menu-item">
							<!--begin:Menu link-->
							<a class="menu-link" href="/local-contracts/price-update">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title">Contract Pricing</span>
							</a>
							<!--end:Menu link-->
						</div>
						<!--end:Menu item-->

						<!--begin:Menu item-->
						<div class="menu-item">
							<!--begin:Menu link-->
							<a class="menu-link" href="/local-contracts/vessel-allocation">
								<span class="menu-bullet">
									<span class="bullet bullet-dot"></span>
								</span>
								<span class="menu-title">Vessel Allocation</span>
							</a>
							<!--end:Menu link-->
						</div>
						<!--end:Menu item-->
						
					</div>
					<!--end:Menu sub-->
				</div>
			@endif
			<!--end:Menu item-->
			
			@if (Auth::user()->role_as == 'admin' || Auth::user()->role_as == 'full' || Auth::user()->role_as == 'lic')
			<!--begin:Menu item-->
			<div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Request::is('inventories') || Request::is('inventories/*') ? 'show' : '' }}">
				<!--begin:Menu link-->
				<span class="menu-link">
					<span class="menu-icon">{!! getIcon('address-book', 'fs-2') !!}</span>
					<span class="menu-title">Inventory</span>
					<span class="menu-arrow"></span>
				</span>
				<!--end:Menu link-->
				<!--begin:Menu sub-->
				<div class="menu-sub menu-sub-accordion">
					<!--begin:Menu item-->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link" href="/inventories/">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">View All</span>
						</a>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
					
					<!--begin:Menu item-->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link" href="/inventories/create">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">New Inventory</span>
						</a>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->

					<!--begin:Menu item-->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#SearchBL">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">BL Search</span>
						</a>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->

				</div>
				<!--end:Menu sub-->
			</div>
			<!--end:Menu item-->
			@endif

			@if (Auth::user()->role_as == 'admin' || Auth::user()->role_as == 'full' || Auth::user()->role_as == 'lic')
			<!--begin:Menu item-->
			<div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Request::is('sales-request') || Request::is('sales-request/*') ? 'show' : '' }}">
				<!--begin:Menu link-->
				<span class="menu-link">
					<span class="menu-icon">{!! getIcon('address-book', 'fs-2') !!}</span>
					<span class="menu-title">Sales / Lifting</span>
					<span class="menu-arrow"></span>
				</span>
				<!--end:Menu link-->
				<!--begin:Menu sub-->
				<div class="menu-sub menu-sub-accordion">
					<!--begin:Menu item-->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link" href="/sales-request/">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">Pending</span>
						</a>
						<!--end:Menu link-->
					</div>
					<!--begin:Menu item-->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link" href="/sales-request/process">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">Processing</span>
						</a>
						<!--end:Menu link-->
					</div>

					<!--begin:Menu item-->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link" href="/sales-request/allocation">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">Allocation</span>
						</a>
						<!--end:Menu link-->
					</div>

					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link" href="/sales-request/success">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">Completed</span>
						</a>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
					<!--begin:Menu item-->
					<!--end:Menu item-->
				</div>
				<!--end:Menu sub-->
			</div>
			<!--end:Menu item-->
			@endif

			@if (Auth::user()->role_as == 'admin' || Auth::user()->role_as == 'full' || Auth::user()->role_as == 'collection')
			<!--begin:Menu item-->
			<div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Request::is('custom-payments') || Request::is('custom-payments/*') ? 'show' : '' }}">
				<!--begin:Menu link-->
				<span class="menu-link">
					<span class="menu-icon">{!! getIcon('abstract-41', 'fs-2') !!}</span>
					<span class="menu-title">Custom Payments</span>
					<span class="menu-arrow"></span>
				</span>
				<!--end:Menu link-->
				<!--begin:Menu sub-->
				<div class="menu-sub menu-sub-accordion">
					<!--begin:Menu item-->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link" href="/custom-payments/posting-date">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">View All</span>
						</a>
						<!--end:Menu link-->
						<!--begin:Menu link-->
						<a class="menu-link" href="/custom-payments/create-bank-deposit">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">Bank Deposit</span>
						</a>
						<!--end:Menu link-->
						<!--begin:Menu link-->
						<a class="menu-link" href="/custom-payments/create-cash">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">Cash Deposit</span>
						</a>
						<!--end:Menu link-->
						<!--begin:Menu link-->
						<a class="menu-link" href="/custom-payments/create-settlement">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">Settlement</span>
						</a>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
				</div>
				<!--end:Menu sub-->
			</div>
			<!--end:Menu item-->		
			@endif

			@if (Auth::user()->role_as == 'admin' || Auth::user()->role_as == 'full')
			<!--begin:Menu item-->
			<div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Request::is('document') ? 'show' : '' }}">
				<!--begin:Menu link-->
				<span class="menu-link">
					<span class="menu-icon">{!! getIcon('address-book', 'fs-2') !!}</span>
					<span class="menu-title">Documents</span>
					<span class="menu-arrow"></span>
				</span>
				<!--end:Menu link-->
				<!--begin:Menu sub-->
				<div class="menu-sub menu-sub-accordion">
					<!--begin:Menu item-->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link" href="/document/">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">View All</span>
						</a>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
				</div>
				<!--end:Menu sub-->
			</div>
			<!--end:Menu item-->
			@endif

			@if (Auth::user()->role_as == 'admin' || Auth::user()->role_as == 'full')
		<!--begin:Menu item-->
			<div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Request::is('accounts') || Request::is('accounts/*') ? 'show' : '' }}">
				<!--begin:Menu link-->
				<span class="menu-link">
					<span class="menu-icon">{!! getIcon('address-book', 'fs-2') !!}</span>
					<span class="menu-title">Accounts</span>
					<span class="menu-arrow"></span>
				</span>
				<!--end:Menu link-->
				<!--begin:Menu sub-->
				<div class="menu-sub menu-sub-accordion">
					<!--begin:Menu item-->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link" href="/accounts/">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">View All</span>
						</a>
						<!--end:Menu link-->
						<!--begin:Menu link-->
						<a class="menu-link" href="/account/chart">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">COA</span>
						</a>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
				</div>
				<!--end:Menu sub-->
			</div>
			<!--end:Menu item-->
			@endif

			@if (Auth::user()->role_as == 'admin' || Auth::user()->role_as == 'full')
					<!--begin:Menu item-->
					<div data-kt-menu-trigger="click" class="menu-item {{ Request::is('journals') ? 'show' : '' }}">
						<!--begin:Menu link-->
							<a href="/journals/">
								<span class="menu-link">
									<span class="menu-icon">{!! getIcon('abstract-41', 'fs-2') !!}</span>
									<span class="menu-title">Journals</span>
									<span class="menu-arrow"></span>
								</span>
							</a>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
			@endif

			@if (Auth::user()->role_as == 'admin' || Auth::user()->role_as == 'full')
					<!--begin:Menu item-->
					<div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Request::is('emails') ? 'show' : '' }}">
						<!--begin:Menu link-->
						<span class="menu-link">
							<span class="menu-icon">{!! getIcon('abstract-41', 'fs-2') !!}</span>
							<span class="menu-title">Mails</span>
							<span class="menu-arrow"></span>
						</span>
						<!--end:Menu link-->
						<!--begin:Menu sub-->
						<div class="menu-sub menu-sub-accordion">
							<!--begin:Menu item-->
							<div class="menu-item">
								<!--begin:Menu link-->
								<a class="menu-link" href="/emails/">
									<span class="menu-bullet">
										<span class="bullet bullet-dot"></span>
									</span>
									<span class="menu-title">View All</span>
								</a>
								<!--end:Menu link-->
							</div>
							<!--end:Menu item-->
						</div>
						<!--end:Menu sub-->
					</div>
					<!--end:Menu item-->	
			@endif		

			@if (Auth::user()->role_as == 'admin')
			<!--begin:Menu item-->
			<div class="menu-item pt-5">
				<!--begin:Menu content-->
				<div class="menu-content">
					<span class="menu-heading fw-bold text-uppercase fs-7">Options</span>
				</div>
				<!--end:Menu content-->
			</div>
			<!--end:Menu item-->
			@endif
			
			@if (Auth::user()->role_as == 'admin')
			<!--begin:Menu item-->
			<div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Request::is('options') ? 'show' : '' }}">
				<!--begin:Menu link-->
				<span class="menu-link">
					<span class="menu-icon">{!! getIcon('abstract-41', 'fs-2') !!}</span>
					<span class="menu-title">Configurations</span>
					<span class="menu-arrow"></span>
				</span>
				<!--end:Menu link-->
				<!--begin:Menu sub-->
				<div class="menu-sub menu-sub-accordion">
					<!--begin:Menu item-->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link" href="/options">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">Edit</span>
						</a>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
				</div>
				<!--end:Menu sub-->
			</div>
			<!--end:Menu item-->
			@endif

			@if (Auth::user()->role_as == 'admin')
			<!--begin:Menu item-->
			<div data-kt-menu-trigger="click" class="menu-item {{ Request::is('activity-logs') ? 'show' : '' }}">
				<!--begin:Menu link-->
				<a href="/activity-logs">
					<span class="menu-link">
						<span class="menu-icon">{!! getIcon('abstract-41', 'fs-2') !!}</span>
						<span class="menu-title">Activity Logs</span>
						<span class="menu-arrow"></span>
					</span>
				</a>
				<!--end:Menu link-->
			</div>
			<!--end:Menu item-->
			@endif

			@if (Auth::user()->role_as == 'admin')
			<!--begin:Menu item-->
			<div data-kt-menu-trigger="click" class="menu-item {{ Request::is('users') || Request::is('users/*') ? 'show' : '' }}">
				<!--begin:Menu link-->
				<a href="/users">
					<span class="menu-link">
						<span class="menu-icon">{!! getIcon('abstract-41', 'fs-2') !!}</span>
						<span class="menu-title">Users</span>
						<span class="menu-arrow"></span>
					</span>
				</a>
				<!--end:Menu link-->
				<!--begin:Menu sub-->
				<!--end:Menu sub-->
			</div>
			<!--end:Menu item-->
			@endif

			@if (Auth::user()->role_as == 'admin')
				<!--begin:Menu item-->
				<div data-kt-menu-trigger="click" class="menu-item {{ Request::is('roles') || Request::is('roles/*') ? 'show' : '' }}">
					<!--begin:Menu link-->
					<a href="/roles">
						<span class="menu-link">
							<span class="menu-icon">{!! getIcon('abstract-41', 'fs-2') !!}</span>
							<span class="menu-title">Role & Permissions</span>
							<span class="menu-arrow"></span>
						</span>
					</a>
					<!--end:Menu link-->
					<!--begin:Menu sub-->
					<!--end:Menu sub-->
				</div>
				<!--end:Menu item-->
			@endif

			@if (Auth::user()->role_as == 'admin')
			<!--begin:Menu item-->
			<div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Request::is('notes') || Request::is('notes/*') ? 'show' : '' }}">
				<!--begin:Menu link-->
				<span class="menu-link">
					<span class="menu-icon">{!! getIcon('abstract-41', 'fs-2') !!}</span>
					<span class="menu-title">Notes</span>
					<span class="menu-arrow"></span>
				</span>
				<!--end:Menu link-->
				<!--begin:Menu sub-->
				<div class="menu-sub menu-sub-accordion">
					<!--begin:Menu item-->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link" href="/notes/">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">View All</span>
						</a>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
					<!--begin:Menu item-->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link" href="/notes/create">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">Add New</span>
						</a>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
				</div>
				<!--end:Menu sub-->
			</div>
			<!--end:Menu item-->
			@endif

			@if (Auth::user()->role_as == 'admin')
			<!--begin:Menu item-->
			<div data-kt-menu-trigger="click" class="menu-item {{ Request::is('businesses') || Request::is('businesses/*') ? 'show' : '' }}">
				<!--begin:Menu link-->
				<a href="/businesses/">
					<span class="menu-link">
						<span class="menu-icon">{!! getIcon('abstract-41', 'fs-2') !!}</span>
						<span class="menu-title">Businesses</span>
						<span class="menu-arrow"></span>
					</span>
				</a>
				<!--end:Menu link-->
				<!--begin:Menu sub-->
				<div class="menu-sub menu-sub-accordion d-none">
					<!--begin:Menu item-->
					<div class="menu-item">
						<!--begin:Menu link-->
						<a class="menu-link" href="/businesses/">
							<span class="menu-bullet">
								<span class="bullet bullet-dot"></span>
							</span>
							<span class="menu-title">View All</span>
						</a>
						<!--end:Menu link-->
					</div>
					<!--end:Menu item-->
				</div>
				<!--end:Menu sub-->
			</div>
			<!--end:Menu item-->
			@endif

			@if (Auth::user()->role_as == 'admin')
			<!--begin:Menu item-->
			<div data-kt-menu-trigger="click" class="menu-item {{ Request::is('companies') || Request::is('companies/*') ? 'show' : '' }}">
				<!--begin:Menu link-->
			<a href="/companies/">
				<span class="menu-link">
					<span class="menu-icon">{!! getIcon('abstract-41', 'fs-2') !!}</span>
					<span class="menu-title">Buyer/Sellers</span>
					<span class="menu-arrow"></span>
				</span>
			</a>
				<!--end:Menu link-->
				<!--begin:Menu sub-->
				
				<!--end:Menu sub-->
			</div>
			<!--end:Menu item-->
			@endif

			@if (Auth::user()->role_as == 'admin')
			<!--begin:Menu item-->
			<div data-kt-menu-trigger="click" class="menu-item {{ Request::is('products') || Request::is('products/*') ? 'show' : '' }}">
				<!--begin:Menu link-->
			<a href="/products/">
				<span class="menu-link">
					<span class="menu-icon">{!! getIcon('abstract-41', 'fs-2') !!}</span>
					<span class="menu-title">Products</span>
					<span class="menu-arrow"></span>
				</span>
			</a>
				<!--end:Menu link-->
				
			</div>
			<!--end:Menu item-->
			@endif

			@if (Auth::user()->role_as == 'admin')
			<!--begin:Menu item-->
			<div data-kt-menu-trigger="click" class="menu-item {{ Request::is('ports') || Request::is('ports/*') ? 'show' : '' }}">
				<!--begin:Menu link-->
				<a href="/ports/">
					<span class="menu-link">
						<span class="menu-icon">{!! getIcon('abstract-41', 'fs-2') !!}</span>
						<span class="menu-title">Ports</span>
						<span class="menu-arrow"></span>
					</span>
				</a>
				<!--end:Menu link-->
				<!--begin:Menu sub-->
				
				<!--end:Menu sub-->
			</div>
			<!--end:Menu item-->
			@endif

		@if (Auth::user()->role_as == 'admin')
		<!--begin:Menu item-->
		<div data-kt-menu-trigger="click" class="menu-item {{ Request::is('payment-types') || Request::is('payment-types/*') ? 'show' : '' }}">
				<!--begin:Menu link-->
				<a href="/payment-types/">
					<span class="menu-link">
						<span class="menu-icon">{!! getIcon('abstract-41', 'fs-2') !!}</span>
						<span class="menu-title">Payment Types</span>
						<span class="menu-arrow"></span>
					</span>
				</a>
				<!--end:Menu link-->
				<!--begin:Menu sub-->
				
				<!--end:Menu sub-->
			</div>
			<!--end:Menu item-->
			@endif

		@if (Auth::user()->role_as == 'admin')
		<!--begin:Menu item-->
		<div data-kt-menu-trigger="click" class="menu-item {{ Request::is('transaction-type') || Request::is('transaction-type/*') ? 'show' : '' }}">
			<!--begin:Menu link-->
		<a href="/transaction-type">
			<span class="menu-link">
				<span class="menu-icon">{!! getIcon('abstract-41', 'fs-2') !!}</span>
				<span class="menu-title">Transaction Type</span>
				<span class="menu-arrow"></span>
			</span>
		</a>
			<!--end:Menu link-->
			
		</div>
		<!--end:Menu item-->
		@endif

		@if (Auth::user()->role_as == 'admin')
			<!--begin:Menu item-->
			<div data-kt-menu-trigger="click" class="menu-item {{ Request::is('payment-terms') || Request::is('payment-terms/*') ? 'show' : '' }}">
				<!--begin:Menu link-->
				<a href="/payment-terms">
					<span class="menu-link">
						<span class="menu-icon">{!! getIcon('abstract-41', 'fs-2') !!}</span>
						<span class="menu-title">Payment Terms</span>
						<span class="menu-arrow"></span>
					</span>
				</a>
				<!--end:Menu link-->
				<!--begin:Menu sub-->
				<!--end:Menu sub-->
			</div>
			<!--end:Menu item-->
		@endif

		@if (Auth::user()->role_as == 'admin')
			<!--begin:Menu item-->
			<div data-kt-menu-trigger="click" class="menu-item {{ Request::is('vessels') || Request::is('vessels/*') ? 'show' : '' }}">
				<!--begin:Menu link-->
				<a href="/vessels/">
					<span class="menu-link">
						<span class="menu-icon">{!! getIcon('abstract-41', 'fs-2') !!}</span>
						<span class="menu-title">Vessels</span>
						<span class="menu-arrow"></span>
					</span>
				</a>
				<!--end:Menu link-->
				<!--begin:Menu sub-->
				<!--end:Menu sub-->
			</div>
			<!--end:Menu item-->
			@endif

			@if (Auth::user()->role_as == 'admin')
			<!--begin:Menu item-->
			<div data-kt-menu-trigger="click" class="menu-item {{ Request::is('terminals') || Request::is('terminals/*') ? 'show' : '' }}">
				<!--begin:Menu link-->
				<a href="/terminals">
					<span class="menu-link">
						<span class="menu-icon">{!! getIcon('abstract-41', 'fs-2') !!}</span>
						<span class="menu-title">Terminals</span>
						<span class="menu-arrow"></span>
					</span>
				</a>
				<!--end:Menu link-->
				<!--begin:Menu sub-->
				<!--end:Menu sub-->
			</div>
			<!--end:Menu item-->
			@endif

			@if (Auth::user()->role_as == 'admin')
			<!--begin:Menu item-->
			<div data-kt-menu-trigger="click" class="menu-item {{ Request::is('clearing-agents') || Request::is('clearing-agents/*') ? 'show' : '' }}">
				<!--begin:Menu link-->
				<a href="/clearing-agents">
					<span class="menu-link">
						<span class="menu-icon">{!! getIcon('abstract-41', 'fs-2') !!}</span>
						<span class="menu-title">Clearing Agents</span>
						<span class="menu-arrow"></span>
					</span>
				</a>
				<!--end:Menu link-->
				<!--begin:Menu sub-->
				<!--end:Menu sub-->
			</div>
			<!--end:Menu item-->
			@endif

			@if (Auth::user()->role_as == 'admin')
			<!--begin:Menu item-->
			<div data-kt-menu-trigger="click" class="menu-item {{ Request::is('surveyor') || Request::is('surveyor/*') ? 'show' : '' }}">
				<!--begin:Menu link-->
				<a href="/surveyor">
					<span class="menu-link">
						<span class="menu-icon">{!! getIcon('abstract-41', 'fs-2') !!}</span>
						<span class="menu-title">Surveyor</span>
						<span class="menu-arrow"></span>
					</span>
				</a>
				<!--end:Menu link-->
				<!--begin:Menu sub-->
				<!--end:Menu sub-->
			</div>
			<!--end:Menu item-->
			@endif

			@if (Auth::user()->role_as == 'admin')
			<!--begin:Menu item-->
			<div data-kt-menu-trigger="click" class="menu-item {{ Request::is('bank-accounts') || Request::is('bank-accounts/*') ? 'show' : '' }}">
				<!--begin:Menu link-->
				<a href="/bank-accounts">
					<span class="menu-link">
						<span class="menu-icon">{!! getIcon('abstract-41', 'fs-2') !!}</span>
						<span class="menu-title">Bank Accounts</span>
						<span class="menu-arrow"></span>
					</span>
				</a>
				<!--end:Menu link-->
				<!--begin:Menu sub-->
				<!--end:Menu sub-->
			</div>
			<!--end:Menu item-->
			@endif

		</div>
		<!--end::Menu-->
	</div>
	<!--end::Menu wrapper-->
</div>
<!--end::sidebar menu-->
