 <aside class="left-sidebar" data-sidebarbg="skin6" style="height: 100% !important;overflow:scroll">

     <!-- Sidebar scroll-->
     <div class="scroll-sidebar" data-sidebarbg="skin6" style="height: 100% !important"
         style="background-color: greenyellow">
         <!-- Sidebar navigation-->
         <nav class="sidebar-nav">
             <ul id="sidebarnav">
                 <li class="sidebar-item">
                     <a class="sidebar-link sidebar-link" href="{{ url('/') }}" aria-expanded="false">
                         <i data-feather="users" class="feather-icon"></i>
                         <span class="hide-menu"> Dashboard</span>
                     </a>
                 </li>
                 <li class="sidebar-item">
                     <button class="sidebar-link dropdown-toggle btn  " type="button" id="dropdownMenuButton"
                         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <i data-feather="users" class="feather-icon"></i>
                         <span class="hide-menu"> Company Staff & Salary</span>
                     </button>
                     <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                         <li class="sidebar-item">
                             <a class="sidebar-link sidebar-link" href="{{ url('employees/index') }}"
                                 aria-expanded="false">
                                 <i data-feather="users" class="feather-icon"></i>
                                 <span class="hide-menu"> Employee</span>
                             </a>
                         </li>
                         <li class="sidebar-item">
                             <a class="sidebar-link sidebar-link" href="{{ url('time-schedule/index') }}"
                                 aria-expanded="false">
                                 <i data-feather="users" class="feather-icon"></i>
                                 <span class="hide-menu"> Time Schedule</span>
                             </a>
                         </li>
                         <li class="sidebar-item">
                             <a class="sidebar-link sidebar-link" href="{{ url('salary-vouchar/index') }}"
                                 aria-expanded="false">
                                 <i data-feather="users" class="feather-icon"></i>
                                 <span class="hide-menu"> Salary Vouchar </span>
                             </a>
                         </li>
                         <li class="sidebar-item">
                             <a class="sidebar-link sidebar-link" href="{{ route('staff_cpfs.index') }}"
                                 aria-expanded="false">
                                 <i data-feather="users" class="feather-icon"></i>
                                 <span class="hide-menu"> Staff CPF & Salary </span>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="sidebar-item">
                     <button class="sidebar-link dropdown-toggle btn" type="button" id="companyAndProjectDropdown"
                         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <i data-feather="users" class="feather-icon"></i>
                         <span class="hide-menu"> Company & Project</span>
                     </button>
                     <ul class="dropdown-menu" aria-labelledby="companyAndProjectDropdown">



                         <li class="sidebar-item">
                             <a class="sidebar-link sidebar-link" href="{{ url('companies/index') }}"
                                 aria-expanded="false">
                                 <i data-feather="users" class="feather-icon"></i>
                                 <span class="hide-menu"> Company</span>
                             </a>
                         </li>
                         
                         <li class="sidebar-item">
                            <a class="sidebar-link sidebar-link" href="{{ url('projects/index') }}"
                                aria-expanded="false">
                                <i data-feather="users" class="feather-icon"></i>
                                <span class="hide-menu"> Project</span>
                            </a>
                        </li>
                        
                         <li class="sidebar-item">
                             <a class="sidebar-link sidebar-link" href="{{ url('vendors/index') }}"
                                 aria-expanded="false">
                                 <i data-feather="users" class="feather-icon"></i>
                                 <span class="hide-menu"> Quotation</span>
                             </a>
                         </li>
                         <li class="sidebar-item">
                             <a class="sidebar-link sidebar-link" href="{{ url('progress-claim/index') }}"
                                 aria-expanded="false">
                                 <i data-feather="users" class="feather-icon"></i>
                                 <span class="hide-menu"> Progress Claim</span>
                             </a>
                         </li>
                         <li class="sidebar-item">
                             <a class="sidebar-link sidebar-link" href="{{ url('invoice/index') }}"
                                 aria-expanded="false">
                                 <i data-feather="users" class="feather-icon"></i>
                                 <span class="hide-menu"> Invoice</span>
                             </a>
                         </li>
                         <li class="sidebar-item">
                             <a class="sidebar-link sidebar-link" href="{{ route('payment_receives.index') }}"
                                 aria-expanded="false">
                                 <i data-feather="users" class="feather-icon"></i>
                                 <span class="hide-menu"> Payment Received </span>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="sidebar-item">
                     <button class="sidebar-link dropdown-toggle btn" type="button" id="companyAndProjectDropdown"
                         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <i data-feather="users" class="feather-icon"></i>
                         <span class="hide-menu"> Sub Project</span>
                     </button>
                     <ul class="dropdown-menu" aria-labelledby="companyAndProjectDropdown">

                         <li class="sidebar-item">
                             <a class="sidebar-link sidebar-link" href="{{ url('subcontract/index') }}"
                                 aria-expanded="false">
                                 <i data-feather="users" class="feather-icon"></i>
                                 <span class="hide-menu"> Subcontractor</span>
                             </a>
                         </li>
                         <li class="sidebar-item">
                             <a class="sidebar-link sidebar-link" href="{{ url('subcontract_project/index') }}"
                                 aria-expanded="false">
                                 <i data-feather="users" class="feather-icon"></i>
                                 <span class="hide-menu"> Subcontractor Project</span>
                             </a>
                         </li>
                         <li class="sidebar-item">
                             <a class="sidebar-link sidebar-link" href="{{ route('sub_contact_costs.index') }}"
                                 aria-expanded="false">
                                 <i data-feather="users" class="feather-icon"></i>
                                 <span class="hide-menu">Subcontractor Payment </span>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="sidebar-item">
                     <button class="sidebar-link dropdown-toggle btn" type="button" id="companyCost"
                         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <i data-feather="users" class="feather-icon"></i>
                         <span class="hide-menu"> Company Cost</span>
                     </button>
                     <ul class="dropdown-menu" aria-labelledby="companyCost">

                         <li class="sidebar-item">
                             <a class="sidebar-link sidebar-link" href="{{ route('official_or_other_costs.index') }}"
                                 aria-expanded="false">
                                 <i data-feather="users" class="feather-icon"></i>
                                 <span class="hide-menu"> Official/Other Cost </span>
                             </a>
                         </li>

                         <li class="sidebar-item">
                             <a class="sidebar-link sidebar-link" href="{{ route('material_costs.index') }}"
                                 aria-expanded="false">
                                 <i data-feather="users" class="feather-icon"></i>
                                 <span class="hide-menu"> Material Cost </span>
                             </a>
                         </li>

                         <li class="sidebar-item">
                             <a class="sidebar-link sidebar-link" href="{{ url('levies/index') }}"
                                 aria-expanded="false">
                                 <i data-feather="users" class="feather-icon"></i>
                                 <span class="hide-menu"> Levy</span>
                             </a>
                         </li>
                     </ul>
                 </li>



                 <li class="sidebar-item">
                     <a class="sidebar-link sidebar-link" href="{{ route('products.index') }}"
                         aria-expanded="false">
                         <i data-feather="users" class="feather-icon"></i>
                         <span class="hide-menu"> Product</span>
                     </a>
                 </li>
                 {{-- <li class="sidebar-item">
                            <a class="sidebar-link sidebar-link" href="{{url('companies/index')}}" aria-expanded="false">
                                <i data-feather="users" class="feather-icon"></i>
                                <span class="hide-menu"> Company</span>
                            </a>
                        </li> --}}


                 <li class="sidebar-item">
                     <a class="sidebar-link sidebar-link" href="{{ route('loan.index') }}" aria-expanded="false">
                         <i data-feather="users" class="feather-icon"></i>
                         <span class="hide-menu"> Loan </span>
                     </a>
                 </li>

                 {{-- <li class="sidebar-item">
                            <a class="sidebar-link sidebar-link" href="{{route('annual_reports.index')}}" aria-expanded="false">
                                <i data-feather="users" class="feather-icon"></i>
                                <span class="hide-menu"> Annual Report  </span>
                            </a>
                        </li> --}}



             </ul>
         </nav>
         <!-- End Sidebar navigation -->
     </div>
     <!-- End Sidebar scroll-->
 </aside>
