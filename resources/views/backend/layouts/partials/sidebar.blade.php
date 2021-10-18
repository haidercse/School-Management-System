<!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="index.html"><img src="{{ asset('admin/assets/images/icon/logo.png') }}" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                                <ul class="collapse">
                                    <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}"><a href="{{ route('admin.dashboard') }}">Dashboard Page</a></li>
                                    
                                </ul>
                            </li>
                            @if (Auth::user()->role == 'Admin')
                            <li class="{{ Route::is('user.index') ? 'active' : '' }}">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left"></i><span>User Management
                                    </span></a>
                                <ul class="collapse">
                                    <li class="{{ Route::is('user.index') ? 'active' : '' }}"><a href="{{ route('user.index') }}">User Management</a></li>
                                </ul>
                            </li>
                           
                            @endif
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-pie-chart"></i><span>Profile Management</span></a>
                                <ul class="collapse">
                                    <li><a href="barchart.html">bar chart</a></li>
                                    <li><a href="linechart.html">line Chart</a></li>
                                    <li><a href="piechart.html">pie chart</a></li>
                                </ul>
                            </li>
                            <li class="{{ Route::is('student-class.index')||Route::is('student-year.index') || Route::is('student-shift.index')|| Route::is('student-group.index') || Route::is('student-fee.index') || Route::is('student-fee-amount.index') || Route::is('student-exam-type.index') || Route::is('student-subject.index') || Route::is('student-assign-subject.index') || Route::is('designation.index') ? 'active' : '' }}">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-palette"></i><span>Setup Managemnet</span></a>
                                <ul class="collapse">
                                    <li class="{{ Route::is('student-class.index') ? 'active' : '' }}"><a href="{{ route('student-class.index') }}">Student Class</a></li>
                                    <li class="{{ Route::is('student-year.index') ? 'active': '' }}"><a href="{{ route('student-year.index') }}">Student Year</a></li>
                                    <li class="{{ Route::is('student-shift.index') ? 'active': '' }}"><a href="{{ route('student-shift.index') }}">Student Shift</a></li>
                                    <li class="{{ Route::is('student-group.index') ? 'active' : '' }}"><a href="{{ route('student-group.index') }}">Student Group</a></li>
                                    <li class="{{ Route::is('student-fee.index') ? 'active' : '' }}"><a href="{{ route('student-fee.index') }}">Student Fee Category</a></li>
                                    <li class="{{ Route::is('student-fee-amount.index') ? 'active' : '' }}"><a href="{{ route('student-fee-amount.index') }}">Student Fee Category Amount</a></li>
                                    <li class="{{ Route::is('student-exam.index') ? 'active' : '' }}"><a href="{{ route('student-exam.index') }}">Student Exam Type</a></li>
                                    <li class="{{ Route::is('student-subject.index') ? 'active' : '' }}"><a href="{{ route('student-subject.index') }}">Student Subject</a></li>
                                    <li class="{{ Route::is('student-assign-subject.index') ? 'active' : '' }}"><a href="{{ route('student-assign-subject.index') }}">Student Assign Subject</a></li>
                                    <li class="{{ Route::is('designation.index') ? 'active' : '' }}"><a href="{{ route('designation.index') }}">Designation</a></li>
                                </ul>
                            </li>
                            <li class=" {{ Route::is('student-registration.index') || Route::is('roll-generate.index') ? 'active' : '' }}">
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-slice"></i><span>Student Management</span></a>
                                <ul class="collapse">
                                    <li class=" {{ Route::is('student-registration.index') ? 'active' : '' }}"><a href="{{ route('student-registration.index') }}">Student Registration</a></li>
                                    <li class="{{ Route::is('roll-generate.index') ? 'active' : '' }}"><a href="{{ route('roll-generate.index') }}">Student Roll Generate</a></li>
                                </ul>
                            </li>
                            {{-- <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-palette"></i><span>UI Features</span></a>
                                <ul class="collapse">
                                    <li><a href="accordion.html">Accordion</a></li>
                                    <li><a href="alert.html">Alert</a></li>
                                    <li><a href="badge.html">Badge</a></li>
                                    <li><a href="button.html">Button</a></li>
                                    <li><a href="button-group.html">Button Group</a></li>
                                    <li><a href="cards.html">Cards</a></li>
                                   
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-slice"></i><span>icons</span></a>
                                <ul class="collapse">
                                    <li><a href="fontawesome.html">fontawesome icons</a></li>
                                    <li><a href="themify.html">themify icons</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-table"></i>
                                    <span>Tables</span></a>
                                <ul class="collapse">
                                    <li><a href="table-basic.html">basic table</a></li>
                                    <li><a href="table-layout.html">table layout</a></li>
                                    <li><a href="datatable.html">datatable</a></li>
                                </ul>
                            </li>
                            <li><a href="maps.html"><i class="ti-map-alt"></i> <span>maps</span></a></li>
                            <li><a href="invoice.html"><i class="ti-receipt"></i> <span>Invoice Summary</span></a></li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layers-alt"></i> <span>Pages</span></a>
                                <ul class="collapse">
                                    <li><a href="login.html">Login</a></li>
                                    <li><a href="login2.html">Login 2</a></li>
                                    <li><a href="login3.html">Login 3</a></li>
                                    <li><a href="register.html">Register</a></li>
                                    <li><a href="register2.html">Register 2</a></li>
                                    <li><a href="register3.html">Register 3</a></li>
                                    <li><a href="register4.html">Register 4</a></li>
                                    <li><a href="screenlock.html">Lock Screen</a></li>
                                    <li><a href="screenlock2.html">Lock Screen 2</a></li>
                                    <li><a href="reset-pass.html">reset password</a></li>
                                    <li><a href="pricing.html">Pricing</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-exclamation-triangle"></i>
                                    <span>Error</span></a>
                                <ul class="collapse">
                                    <li><a href="404.html">Error 404</a></li>
                                    <li><a href="403.html">Error 403</a></li>
                                    <li><a href="500.html">Error 500</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-align-left"></i> <span>Multi
                                        level menu</span></a>
                                <ul class="collapse">
                                    <li><a href="#">Item level (1)</a></li>
                                    <li><a href="#">Item level (1)</a></li>
                                    <li><a href="#" aria-expanded="true">Item level (1)</a>
                                        <ul class="collapse">
                                            <li><a href="#">Item level (2)</a></li>
                                            <li><a href="#">Item level (2)</a></li>
                                            <li><a href="#">Item level (2)</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Item level (1)</a></li>
                                </ul>
                            </li> --}}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
