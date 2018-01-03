@extends('layouts.app')

@section('title','Laravel Admin Panel')
@section('description','Simple Laravel Admin panel and CMS')


@section('content')



  <div class="container bg-white m-t-md m-b-md">

      <div class="wrapper">


      <div class="page-header" id="banner">
        <div class="row">
          <div class="col-lg-8 col-md-7 col-sm-6">
            <h1 class="font-thin text-black">ORCHID</h1>
            <p class="lead">UI Kit</p>
          </div>
        </div>
      </div>

    <!-- Navbar
    ================================================== -->
      <div class="bs-docs-section clearfix">
        <div class="row">
          <div class="col-lg-12">
            <div class="page-header">
              <h1 id="navbars">Navbars</h1>
            </div>

            <div class="bs-component">
                <div class="navbar bg-white-only padder-v">
                  <div class="//container">
                    <div class="navbar-header">
                      <button class="btn btn-link visible-xs pull-right m-r" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                        <i class="fa fa-bars"></i>
                      </button>
                      <a href="#" class="navbar-brand m-r-lg"><img src="img/logo.png" class="m-r-sm hide"><span class="h3 font-bold">Logo</span></a>
                    </div>
                    <div class="collapse navbar-collapse">
                      <ul class="nav navbar-nav font-bold">
                        <li>
                          <a href="#features">Features</a>
                        </li>
                        <li>
                          <a href="#download">Download</a>
                        </li>
                      </ul>
                      <ul class="nav navbar-nav navbar-right">
                        <li>
                          <div class="m-t-sm">
                            <a href="#signin" class="btn btn-link btn-sm">Sign in</a> or
                            <a href="#signup" class="btn btn-sm btn-success btn-rounded m-l"><strong>Sign up</strong></a>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
            </div>

            <div class="bs-component">
              <div class="navbar bg-white-only padder-v">
                <div class="box-shadow bg-white-only">
                      <!-- buttons -->
                      <div class="nav navbar-nav hidden-xs">
                        <a href="#" class="btn no-shadow navbar-btn">
                          <i class="fa fa-dedent fa-fw text"></i>
                          <i class="fa fa-indent fa-fw text-active"></i>
                        </a>
                        <a href="#" class="btn no-shadow navbar-btn" target="#aside-user">
                          <i class="icon-user fa-fw"></i>
                        </a>
                      </div>
                      <!-- / buttons -->

                      <!-- link and dropdown -->
                      <ul class="nav navbar-nav hidden-sm">
                        <li class="dropdown pos-stc">
                          <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                            <span>Mega</span>
                            <span class="caret"></span>
                          </a>
                          <div class="dropdown-menu wrapper w-full bg-white">
                            <div class="row">
                              <div class="col-sm-4">
                                <div class="m-l-xs m-t-xs m-b-xs font-bold">Pages <span class="badge badge-sm bg-success">10</span></div>
                                <div class="row">
                                  <div class="col-xs-6">
                                    <ul class="list-unstyled l-h-2x">
                                      <li>
                                        <a href=""><i class="fa fa-fw fa-angle-right text-muted m-r-xs"></i>Profile</a>
                                      </li>
                                      <li>
                                        <a href=""><i class="fa fa-fw fa-angle-right text-muted m-r-xs"></i>Post</a>
                                      </li>
                                      <li>
                                        <a href=""><i class="fa fa-fw fa-angle-right text-muted m-r-xs"></i>Search</a>
                                      </li>
                                      <li>
                                        <a href=""><i class="fa fa-fw fa-angle-right text-muted m-r-xs"></i>Invoice</a>
                                      </li>
                                    </ul>
                                  </div>
                                  <div class="col-xs-6">
                                    <ul class="list-unstyled l-h-2x">
                                      <li>
                                        <a href=""><i class="fa fa-fw fa-angle-right text-muted m-r-xs"></i>Price</a>
                                      </li>
                                      <li>
                                        <a href=""><i class="fa fa-fw fa-angle-right text-muted m-r-xs"></i>Lock screen</a>
                                      </li>
                                      <li>
                                        <a href=""><i class="fa fa-fw fa-angle-right text-muted m-r-xs"></i>Sign in</a>
                                      </li>
                                      <li>
                                        <a href=""><i class="fa fa-fw fa-angle-right text-muted m-r-xs"></i>Sign up</a>
                                      </li>
                                    </ul>
                                  </div>
                                </div>
                              </div>
                              <div class="col-sm-4 b-l b-light">
                                <div class="m-l-xs m-t-xs m-b-xs font-bold">UI Kits <span class="label label-sm bg-primary">12</span></div>
                                <div class="row">
                                  <div class="col-xs-6">
                                    <ul class="list-unstyled l-h-2x">
                                      <li>
                                        <a href=""><i class="fa fa-fw fa-angle-right text-muted m-r-xs"></i>Buttons</a>
                                      </li>
                                      <li>
                                        <a href=""><i class="fa fa-fw fa-angle-right text-muted m-r-xs"></i>Icons <span class="badge badge-sm bg-warning">1000+</span></a>
                                      </li>
                                      <li>
                                        <a href=""><i class="fa fa-fw fa-angle-right text-muted m-r-xs"></i>Grid</a>
                                      </li>
                                      <li>
                                        <a href=""><i class="fa fa-fw fa-angle-right text-muted m-r-xs"></i>Widgets</a>
                                      </li>
                                    </ul>
                                  </div>
                                  <div class="col-xs-6">
                                    <ul class="list-unstyled l-h-2x">
                                      <li>
                                        <a href=""><i class="fa fa-fw fa-angle-right text-muted m-r-xs"></i>Bootstap</a>
                                      </li>
                                      <li>
                                        <a href=""><i class="fa fa-fw fa-angle-right text-muted m-r-xs"></i>Sortable</a>
                                      </li>
                                      <li>
                                        <a href=""><i class="fa fa-fw fa-angle-right text-muted m-r-xs"></i>Portlet</a>
                                      </li>
                                      <li>
                                        <a href=""><i class="fa fa-fw fa-angle-right text-muted m-r-xs"></i>Timeline</a>
                                      </li>
                                    </ul>
                                  </div>
                                </div>
                              </div>
                              <div class="col-sm-4 b-l b-light">
                                <div class="m-l-xs m-t-xs m-b-xs font-bold">UI Kits <span class="label label-sm bg-primary">12</span></div>
                                <div class="row">
                                  <div class="col-xs-6">
                                    <ul class="list-unstyled l-h-2x">
                                      <li>
                                        <a href=""><i class="fa fa-fw fa-angle-right text-muted m-r-xs"></i>Buttons</a>
                                      </li>
                                      <li>
                                        <a href=""><i class="fa fa-fw fa-angle-right text-muted m-r-xs"></i>Icons <span class="badge badge-sm bg-warning">1000+</span></a>
                                      </li>
                                      <li>
                                        <a href=""><i class="fa fa-fw fa-angle-right text-muted m-r-xs"></i>Grid</a>
                                      </li>
                                      <li>
                                        <a href=""><i class="fa fa-fw fa-angle-right text-muted m-r-xs"></i>Widgets</a>
                                      </li>
                                    </ul>
                                  </div>
                                  <div class="col-xs-6">
                                    <ul class="list-unstyled l-h-2x">
                                      <li>
                                        <a href=""><i class="fa fa-fw fa-angle-right text-muted m-r-xs"></i>Bootstap</a>
                                      </li>
                                      <li>
                                        <a href=""><i class="fa fa-fw fa-angle-right text-muted m-r-xs"></i>Sortable</a>
                                      </li>
                                      <li>
                                        <a href=""><i class="fa fa-fw fa-angle-right text-muted m-r-xs"></i>Portlet</a>
                                      </li>
                                      <li>
                                        <a href=""><i class="fa fa-fw fa-angle-right text-muted m-r-xs"></i>Timeline</a>
                                      </li>
                                    </ul>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </li>
                        <li class="dropdown">
                          <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                            <i class="fa fa-fw fa-plus visible-xs-inline-block"></i>
                            <span translate="header.navbar.new.NEW">New</span> <span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="#" translate="header.navbar.new.PROJECT">Projects</a></li>
                            <li>
                              <a href="">
                                <span class="badge bg-info pull-right">5</span>
                                <span translate="header.navbar.new.TASK">Task</span>
                              </a>
                            </li>
                            <li><a href="" translate="header.navbar.new.USER">User</a></li>
                            <li class="divider"></li>
                            <li>
                              <a href="">
                                <span class="badge bg-danger pull-right">4</span>
                                <span translate="header.navbar.new.EMAIL">Email</span>
                              </a>
                            </li>
                          </ul>
                        </li>
                      </ul>
                      <!-- / link and dropdown -->


                      <!-- nabar right -->
                      <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                          <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                            <i class="icon-bell fa-fw"></i>
                            <span class="visible-xs-inline">Notifications</span>
                            <span class="badge badge-sm up bg-danger pull-right-xs">2</span>
                          </a>
                          <!-- dropdown -->
                          <div class="dropdown-menu w-xl animated fadeInUp">
                            <div class="panel bg-white">
                              <div class="panel-heading b-light bg-light">
                                <strong>You have <span>2</span> notifications</strong>
                              </div>
                              <div class="list-group">
                                <a href="" class="list-group-item">
                                  <span class="pull-left m-r thumb-sm">
                                    <img src="img/a0.jpg" alt="..." class="img-circle">
                                  </span>
                                  <span class="clear block m-b-none">
                                    Use awesome animate.css<br>
                                    <small class="text-muted">10 minutes ago</small>
                                  </span>
                                </a>
                                <a href="" class="list-group-item">
                                  <span class="clear block m-b-none">
                                    1.0 initial released<br>
                                    <small class="text-muted">1 hour ago</small>
                                  </span>
                                </a>
                              </div>
                              <div class="panel-footer text-sm">
                                <a href="" class="pull-right"><i class="fa fa-cog"></i></a>
                                <a href="#notes" data-toggle="class:show animated fadeInRight">See all the notifications</a>
                              </div>
                            </div>
                          </div>
                          <!-- / dropdown -->
                        </li>
                        <li class="dropdown">
                          <a href="#" data-toggle="dropdown" class="dropdown-toggle clear">
                            <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
                              <img src="img/a0.jpg" alt="...">
                              <i class="on md b-white bottom"></i>
                            </span>
                            <span class="hidden-sm hidden-md">John.Smith</span> <b class="caret"></b>
                          </a>
                          <!-- dropdown -->
                          <ul class="dropdown-menu animated fadeInRight w">
                            <li class="wrapper b-b m-b-sm bg-light m-t-n-xs">
                              <div>
                                <p>300mb of 500mb used</p>
                              </div>
                              <div class="progress progress-xs m-b-none dker">
                                <div class="progress-bar progress-bar-info" data-toggle="tooltip" data-original-title="50%" style="width: 50%"></div>
                              </div>
                            </li>
                            <li>
                              <a href="">
                                <span class="badge bg-danger pull-right">30%</span>
                                <span>Settings</span>
                              </a>
                            </li>
                            <li>
                              <a ui-sref="app.page.profile">Profile</a>
                            </li>
                            <li>
                              <a ui-sref="app.docs">
                                <span class="label bg-info pull-right">new</span>
                                Help
                              </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                              <a ui-sref="access.signin">Logout</a>
                            </li>
                          </ul>
                          <!-- / dropdown -->
                        </li>
                      </ul>
                      <!-- / navbar right -->
                </div>
              </div>
            </div>


          </div>
        </div>
      </div>


    <!-- Buttons
    ================================================== -->
      <div class="bs-docs-section">
        <div class="page-header">
          <div class="row">
            <div class="col-lg-12">
              <h1 id="buttons">Buttons</h1>
            </div>
          </div>
        </div>

        <div class="row">
    <div class="col-md-6">
      <h4 class="m-t-xs">Button options</h4>
      <div>
        <button class="btn m-b-xs w-xs btn-default">Default</button>
        <button class="btn m-b-xs w-xs btn-primary">Primary</button>
        <button class="btn m-b-xs w-xs btn-success">Success</button>
        <button class="btn m-b-xs w-xs btn-info">Info</button>
        <button class="btn m-b-xs w-xs btn-warning">Warning</button>
        <button class="btn m-b-xs w-xs btn-danger">Danger</button>
        <button class="btn m-b-xs w-xs btn-dark">Dark</button>
        <button class="btn m-b-xs w-xs btn-default disabled">Disabled</button>
      </div>

      <h4 class="m-t-lg">
        Button addon
      </h4>
      <p>
        <button class="btn m-b-xs btn-sm btn-primary btn-addon"><i class="fa fa-plus"></i>Primary</button>
        <button class="btn m-b-xs btn-sm btn-info btn-addon"><i class="fa fa-trash-o"></i>Info</button>
        <button class="btn m-b-xs btn-sm btn-success btn-addon"><i class="fa fa-minus pull-right"></i>Success</button>
        <button class="btn m-b-xs btn-sm btn-warning btn-addon"><i class="fa fa-circle"></i>Warning</button>
        <button class="btn m-b-xs btn-sm btn-default btn-addon"><i class="fa fa-plus"></i>Default</button>
      </p>
      <p>
        <button class="btn btn-default btn-addon"><i class="fa fa-music"></i>Default</button>
        <button class="btn btn-info btn-addon"><i class="fa fa-play"></i>Info</button>
      </p>

      <h4 class="m-t">Button size</h4>
      <p>
        <button class="btn btn-default btn-lg">Large</button>
        <button class="btn btn-primary btn-addon btn-lg"><i class="fa fa-plus"></i>Addon</button>
      </p>
      <p>
        <button class="btn btn-default">Default button</button>
      </p>
      <p>
        <button class="btn btn-default btn-sm">Small button</button>
      </p>
      <p>
        <button class="btn btn-default btn-xs">Extra small button</button>
      </p>

      <h4 class="m-t-lg">Button dropdowns</h4>
      <p class="text-muted">Single button dropdowns</p>
      <div class="m-b-sm">
        <div class="btn-group dropdown">
          <button class="btn btn-default" data-toggle="dropdown">Action <span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li><a href="">Action</a></li>
            <li><a href="">Another action</a></li>
            <li><a href="">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="">Separated link</a></li>
          </ul>
        </div>
        <div class="btn-group dropdown">
          <button class="btn btn-success" data-toggle="dropdown">Action <span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li><a href="">Action</a></li>
            <li><a href="">Another action</a></li>
            <li><a href="">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="">Separated link</a></li>
          </ul>
        </div>
      </div>
      <div class="m-b-sm">
        <div class="btn-group dropdown">
          <button class="btn btn-default btn-sm" data-toggle="dropdown">Action <span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li><a href="">Action</a></li>
            <li><a href="">Another action</a></li>
            <li><a href="">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="">Separated link</a></li>
          </ul>
        </div>
      </div>
      <div class="m-b-sm">
        <div class="btn-group dropdown">
          <button class="btn btn-default btn-xs" data-toggle="dropdown">Action <span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li><a href="">Action</a></li>
            <li><a href="">Another action</a></li>
            <li><a href="">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="">Separated link</a></li>
          </ul>
        </div>
      </div>
      <p class="text-muted">Split button dropdowns &amp; variation </p>
      <div class="m-b-sm">
        <div class="btn-group dropdown">
          <button class="btn btn-default">Action</button>
          <button class="btn btn-default" data-toggle="dropdown"><span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li><a href="">Action</a></li>
            <li><a href="">Another action</a></li>
            <li><a href="">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="">Separated link</a></li>
          </ul>
        </div>
        <div class="btn-group dropdown dropup">
          <button class="btn btn-default">Action</button>
          <button class="btn btn-default" data-toggle="dropdown"><span class="caret"></span></button>
          <ul class="dropdown-menu">
            <li><a href="">Action</a></li>
            <li><a href="">Another action</a></li>
            <li><a href="">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="">Separated link</a></li>
          </ul>
        </div>
      </div>

      <h4 class="m-t-lg">Button with icon</h4>
      <p>
        <button class="btn btn-default"><i class="fa fa-html5"></i> Html5</button>
        <button class="btn btn-info"><i class="fa fa-css3"></i> CSS3</button>
      </p>
      <p>
        <button class="btn btn-default btn-lg btn-block"><i class="fa fa-bars pull-right"></i> Block button with icon</button>
      </p>
      <p>
        <button class="btn btn-default btn-block"><i class="fa fa-bars pull-left"></i> Block button with icon</button>
      </p>
      <h4 class="m-t-lg">
        Button icon
      </h4>
      <p>
        <button class="btn btn-sm btn-icon btn-info"><i class="fa fa-twitter"></i></button>
        <button class="btn btn-sm btn-icon btn-danger"><i class="fa fa-google-plus"></i></button>
      </p>
      <h4 class="m-t-lg">
        Button icon rounded
      </h4>
      <p>
        <button class="btn btn-rounded btn-sm btn-icon btn-default"><i class="fa fa-twitter"></i></button>
        <button class="btn btn-rounded btn btn-icon btn-default"><i class="fa fa-facebook"></i></button>
        <button class="btn btn-rounded btn-lg btn-icon btn-default"><i class="fa fa-google-plus"></i></button>
      </p>
    </div>
    <div class="col-md-6">
      <h4 class="m-t-xs">Rounded button</h4>
      <div>
        <button class="btn m-b-xs w-xs btn-default btn-rounded">Default</button>
        <button class="btn m-b-xs w-xs btn-primary btn-rounded">Primary</button>
        <button class="btn m-b-xs w-xs btn-success btn-rounded">Success</button>
        <button class="btn m-b-xs w-xs btn-info btn-rounded">Info</button>
        <button class="btn m-b-xs w-xs btn-warning btn-rounded">Warning</button>
        <button class="btn m-b-xs w-xs btn-danger btn-rounded">Danger</button>
        <button class="btn m-b-xs w-xs btn-dark btn-rounded">Dark</button>
        <button class="btn m-b-xs w-xs btn-default btn-rounded disabled">Disabled</button>
      </div>

      <h4 class="m-t-lg">Button groups</h4>
      <div class="m-b-sm">
        <div class="btn-group">
          <button type="button" class="btn btn-default">Left</button>
          <button type="button" class="btn btn-default">Middle</button>
          <button type="button" class="btn btn-default">Right</button>
        </div>
      </div>
      <p class="text-muted">Vertical button groups</p>
      <div class="btn-group-vertical m-b-sm">
        <button type="button" class="btn btn-default">Top</button>
        <button type="button" class="btn btn-default">Middle</button>
        <button type="button" class="btn btn-default">Bottom</button>
      </div>
      <p class="text-muted">Nested button groups</p>
      <div class="btn-group m-b-sm">
        <button type="button" class="btn btn-default">1</button>
        <button type="button" class="btn btn-success">2</button>
        <button type="button" class="btn btn-default">3</button>
        <div class="btn-group dropdown">
          <button type="button" class="btn btn-default" data-toggle="dropdown">
            Dropdown
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            <li><a href="">Dropdown link</a></li>
            <li><a href="">Dropdown link</a></li>
            <li><a href="">Dropdown link</a></li>
          </ul>
        </div>
      </div>
      <p class="text-muted">Justified button groups</p>
      <div class="m-b-sm">
        <div class="btn-group btn-group-justified">
          <a href="" class="btn btn-primary">Left</a>
          <a href="" class="btn btn-info">Middle</a>
          <a href="" class="btn btn-success">Right</a>
        </div>
      </div>
      <p class="text-muted">Multiple button groups</p>
      <div class="btn-toolbar">
        <div class="btn-group">
          <button type="button" class="btn btn-default">1</button>
          <button type="button" class="btn btn-default active">2</button>
          <button type="button" class="btn btn-default">3</button>
          <button type="button" class="btn btn-default">4</button>
        </div>
        <div class="btn-group">
          <button type="button" class="btn btn-default">5</button>
          <button type="button" class="btn btn-default">6</button>
          <button type="button" class="btn btn-default">7</button>
        </div>
        <div class="btn-group">
          <button type="button" class="btn btn-default">8</button>
        </div>
      </div>

      <h4 class="m-t-lg">Button components</h4>
      <p class="text-muted">
        <span>There are a few easy ways to quickly get started with Bootstrap, each one ...</span>
        <span class="text-muted hide" id="moreless"> appealing to a different skill level and use case. Read through to see what suits your particular needs.</span>
      </p>
      <p>
        <button class="btn btn-sm btn-default" ui-toggle-class="show" target="#moreless">
          <i class="fa fa-plus text"></i>
          <span class="text">More</span>
          <i class="fa fa-minus text-active"></i>
          <span class="text-active">Less</span>
        </button>
      </p>
      <p>
        <button class="btn btn-default" ui-toggle-class="btn-success">
          <i class="fa fa-cloud-upload text"></i>
          <span class="text">Upload</span>
          <i class="fa fa-check text-active"></i>
          <span class="text-active">Success</span>
        </button>
        <a class="btn btn-default" ui-toggle-class="button">
          <i class="fa fa-heart-o text"></i>
          <i class="fa fa-heart text-active text-danger"></i>
        </a>
        <a class="btn btn-default" ui-toggle-class="button">
          <span class="text">
            <i class="fa fa-thumbs-up text-success"></i> 25
          </span>
          <span class="text-active">
            <i class="fa fa-thumbs-down text-danger"></i> 10
          </span>
        </a>
        <button class="btn btn-success" ui-toggle-class="show inline" target="#spin">
          <span class="text">Save</span>
          <span class="text-active">Saving...</span>
        </button>
        <i class="fa fa-spin fa-spinner hide" id="spin"></i>
      </p>
      <div class="m-b-sm">
        <div class="btn-group" ng-init="radioModel = 'Male'">
          <label class="btn btn-sm btn-info" ng-model="radioModel" btn-radio="'Male'"><i class="fa fa-check text-active"></i> Male</label>
          <label class="btn btn-sm btn-success" ng-model="radioModel" btn-radio="'Female'"><i class="fa fa-check text-active"></i> Female</label>
          <label class="btn btn-sm btn-primary" ng-model="radioModel" btn-radio="'N/A'"><i class="fa fa-check text-active"></i> N/A</label>
        </div>
      </div>

      <div class="m-b-sm">
        <div class="btn-group" ng-init="checkModel = {option1: true, option2: false}">
          <label class="btn btn-sm btn-default" ng-model="checkModel.option1" btn-checkbox="">Option1</label>
          <label class="btn btn-sm btn-default" ng-model="checkModel.option3" btn-checkbox="">Option2</label>
        </div>
      </div>

      <h4 class="m-t-lg">
        <button class="pull-right text-sm btn btn-xs btn-default" ui-toggle-class="btn-rounded" target="#social-buttons button">Toggle</button>
        Social buttons
      </h4>
      <p id="social-buttons">
        <button class="btn btn-rounded btn-sm btn-info"><i class="fa fa-fw fa-twitter"></i> Twitter</button>
        <button class="btn btn-rounded btn-sm btn-danger"><i class="fa fa-fw fa-google-plus"></i> Google+</button>
      </p>
    </div>
  </div>
      </div>

    <!-- Typography
    ================================================== -->
      <div class="bs-docs-section">
        <div class="row">
          <div class="col-lg-12">
            <div class="page-header">
              <h1 id="typography">Typography</h1>
            </div>
          </div>
        </div>

          <!-- Headings -->

        <div class="row">
          <div class="col-lg-4">
            <div class="bs-component">
              <h1>Heading 1</h1>
              <h2>Heading 2</h2>
              <h3>Heading 3</h3>
              <h4>Heading 4</h4>
              <h5>Heading 5</h5>
              <h6>Heading 6</h6>
              <h3>
                Heading
                <small class="text-muted">with muted text</small>
              </h3>
              <p class="lead">Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="bs-component">
              <h2>Example body text</h2>
              <p>Nullam quis risus eget <a href="#">urna mollis ornare</a> vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula.</p>
              <p><small>This line of text is meant to be treated as fine print.</small></p>
              <p>The following is <strong>rendered as bold text</strong>.</p>
              <p>The following is <em>rendered as italicized text</em>.</p>
              <p>An abbreviation of the word attribute is <abbr title="attribute">attr</abbr>.</p>
            </div>

          </div>
          <div class="col-lg-4">
            <div class="bs-component">
              <h2>Emphasis classes</h2>
              <p class="text-muted">Fusce dapibus, tellus ac cursus commodo, tortor mauris nibh.</p>
              <p class="text-primary">Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p class="text-warning">Etiam porta sem malesuada magna mollis euismod.</p>
              <p class="text-danger">Donec ullamcorper nulla non metus auctor fringilla.</p>
              <p class="text-success">Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</p>
              <p class="text-info">Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
            </div>

          </div>
        </div>

          <!-- Blockquotes -->

        <div class="row">
          <div class="col-lg-12">
            <h2 id="type-blockquotes">Blockquotes</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class="bs-component">
              <blockquote class="blockquote">
                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
              </blockquote>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="bs-component">
              <blockquote class="blockquote text-center">
                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
              </blockquote>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="bs-component">
              <blockquote class="blockquote text-right">
                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
              </blockquote>
            </div>
          </div>
        </div>
      </div>

    <!-- Tables
    ================================================== -->
      <div class="bs-docs-section">

        <div class="row">
          <div class="col-lg-12">
            <div class="page-header">
              <h1 id="tables">Tables</h1>
            </div>

            <div class="bs-component">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Type</th>
                    <th scope="col">Column heading</th>
                    <th scope="col">Column heading</th>
                    <th scope="col">Column heading</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="table-active">
                    <th scope="row">Active</th>
                    <td>Column content</td>
                    <td>Column content</td>
                    <td>Column content</td>
                  </tr>
                  <tr>
                    <th scope="row">Default</th>
                    <td>Column content</td>
                    <td>Column content</td>
                    <td>Column content</td>
                  </tr>
                  <tr class="table-primary">
                    <th scope="row">Primary</th>
                    <td>Column content</td>
                    <td>Column content</td>
                    <td>Column content</td>
                  </tr>
                  <tr class="table-secondary">
                    <th scope="row">Secondary</th>
                    <td>Column content</td>
                    <td>Column content</td>
                    <td>Column content</td>
                  </tr>
                  <tr class="table-success">
                    <th scope="row">Success</th>
                    <td>Column content</td>
                    <td>Column content</td>
                    <td>Column content</td>
                  </tr>
                  <tr class="table-danger">
                    <th scope="row">Danger</th>
                    <td>Column content</td>
                    <td>Column content</td>
                    <td>Column content</td>
                  </tr>
                  <tr class="table-warning">
                    <th scope="row">Warning</th>
                    <td>Column content</td>
                    <td>Column content</td>
                    <td>Column content</td>
                  </tr>
                  <tr class="table-info">
                    <th scope="row">Info</th>
                    <td>Column content</td>
                    <td>Column content</td>
                    <td>Column content</td>
                  </tr>
                  <tr class="table-light">
                    <th scope="row">Light</th>
                    <td>Column content</td>
                    <td>Column content</td>
                    <td>Column content</td>
                  </tr>
                  <tr class="table-dark">
                    <th scope="row">Dark</th>
                    <td>Column content</td>
                    <td>Column content</td>
                    <td>Column content</td>
                  </tr>
                </tbody>
              </table>
            </div><!-- /example -->
          </div>
        </div>
      </div>

    <!-- Forms
    ================================================== -->
      <div class="bs-docs-section">
        <div class="row">
          <div class="col-lg-12">
            <div class="page-header">
              <h1 id="forms">Forms</h1>
            </div>
          </div>
        </div>

        <div class="row">
    <div class="col-sm-6">
      <div class="panel panel-default">
        <div class="panel-heading font-bold">Basic form</div>
        <div class="panel-body">
          <form role="form">
            <div class="form-group">
              <label>Email address</label>
              <input type="email" class="form-control" placeholder="Enter email">
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" class="form-control" placeholder="Password">
            </div>
            <div class="checkbox">
              <label class="i-checks">
                <input type="checkbox" checked="" disabled=""><i></i> Check me out
              </label>
            </div>
            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="panel panel-default">
        <div class="panel-heading font-bold">Horizontal form</div>
        <div class="panel-body">
          <form class="bs-example form-horizontal">
            <div class="form-group">
              <label class="col-lg-2 control-label">Email</label>
              <div class="col-lg-10">
                <input type="email" class="form-control" placeholder="Email">
                <span class="help-block m-b-none">Example block-level help text here.</span>
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-2 control-label">Password</label>
              <div class="col-lg-10">
                <input type="password" class="form-control" placeholder="Password">
              </div>
            </div>
            <div class="form-group">
              <div class="col-lg-offset-2 col-lg-10">
                <div class="checkbox">
                  <label class="i-checks">
                    <input type="checkbox" checked=""><i></i> Remember me
                  </label>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-lg-offset-2 col-lg-10">
                <button type="submit" class="btn btn-sm btn-info">Sign in</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
        <div class="panel panel-default">
    <div class="panel-heading font-bold">
      Inline form
    </div>
    <div class="panel-body">
      <form class="form-inline" role="form">
        <div class="form-group">
          <label class="sr-only" for="exampleInputEmail2">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Enter email">
        </div>
        <div class="form-group">
          <label class="sr-only" for="exampleInputPassword2">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
        </div>
        <div class="checkbox m-l m-r-xs">
          <label class="i-checks">
            <input type="checkbox"><i></i> Remember me
          </label>
        </div>
        <button type="submit" class="btn btn-default">Sign in</button>
        <span ng-controller="ModalDemoCtrl">
          <script type="text/ng-template" id="myModalContent.html">
            <div ng-include="'tpl/modal.form.html'"></div>
          </script>
          <button class="btn btn-success" ng-click="open('lg')">Form in a modal</button>
        </span>
      </form>
    </div>
  </div>
        <div class="panel panel-default">
    <div class="panel-heading font-bold">
      Form elements
    </div>
    <div class="panel-body">
      <form class="form-horizontal" method="get">
        <div class="form-group">
          <label class="col-sm-2 control-label">Rounded</label>
          <div class="col-sm-10">
            <input type="text" class="form-control rounded">
          </div>
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">With help</label>
          <div class="col-sm-10">
            <input type="text" class="form-control">
            <span class="help-block m-b-none">A block of help text that breaks onto a new line and may extend beyond one line.</span>
          </div>
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label" for="input-id-1">Label focus</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="input-id-1">
          </div>
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Password</label>
          <div class="col-sm-10">
            <input type="password" name="password" class="form-control">
          </div>
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Placeholder</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="placeholder">
          </div>
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
          <label class="col-lg-2 control-label">Disabled</label>
          <div class="col-lg-10">
            <input class="form-control" type="text" placeholder="Disabled input here..." disabled="">
          </div>
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
          <label class="col-lg-2 control-label">Static control</label>
          <div class="col-lg-10">
            <p class="form-control-static">email@example.com</p>
          </div>
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Checkboxes and radios</label>
          <div class="col-sm-10">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="">
                Option one is this and that—be sure to include why it's great
              </label>
            </div>

            <div class="radio">
              <label>
                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
                Option one is this and that—be sure to include why it's great
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                Option two can be something else and selecting it will deselect option one
              </label>
            </div>
          </div>
        </div>

        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Inline checkboxes</label>
          <div class="col-sm-10">
            <label class="checkbox-inline">
              <input type="checkbox" value="option1"> a
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="option2"> b
            </label>
            <label class="checkbox-inline">
              <input type="checkbox" value="option3"> c
            </label>
          </div>
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">CSS3 Checkboxes &amp; radios</label>
          <div class="col-sm-10">
            <div class="checkbox">
              <label class="i-checks">
                <input type="checkbox" value="">
                <i></i>
                Option one
              </label>
            </div>
            <div class="checkbox">
              <label class="i-checks">
                <input type="checkbox" checked="" value="">
                <i></i>
                Option two checked
              </label>
            </div>
            <div class="checkbox">
              <label class="i-checks">
                <input type="checkbox" checked="" disabled="" value="">
                <i></i>
                Option three checked and disabled
              </label>
            </div>
            <div class="checkbox">
              <label class="i-checks">
                <input type="checkbox" disabled="" value="">
                <i></i>
                Option four disabled
              </label>
            </div>
            <div class="radio">
              <label class="i-checks">
                <input type="radio" name="a" value="option1">
                <i></i>
                Option one
              </label>
            </div>
            <div class="radio">
              <label class="i-checks">
                <input type="radio" name="a" value="option2" checked="">
                <i></i>
                Option two checked
              </label>
            </div>
            <div class="radio">
              <label class="i-checks">
                <input type="radio" value="option2" checked="" disabled="">
                <i></i>
                Option three checked and disabled
              </label>
            </div>
            <div class="radio">
              <label class="i-checks">
                <input type="radio" name="a" disabled="">
                <i></i>
                Option four disabled
              </label>
            </div>

            <div class="radio">
              <label class="i-checks i-checks-sm">
                <input type="radio" name="a">
                <i></i>
                Small size radio
              </label>
            </div>
            <div class="checkbox">
              <label class="i-checks i-checks-sm">
                <input type="checkbox">
                <i></i>
                Small size checkbox
              </label>
            </div>
            <div class="m-b-xs m-t">
              <label class="i-checks i-checks-lg">
                <input type="radio" name="a">
                <i></i>
                Large size radio
              </label>
            </div>
            <div class="checkbox">
              <label class="i-checks i-checks-lg">
                <input type="checkbox">
                <i></i>
                Large size checkbox
              </label>
            </div>
          </div>
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Inline checkboxes</label>
          <div class="col-sm-10">
            <label class="checkbox-inline i-checks">
              <input type="checkbox" value="option1"><i></i> a
            </label>
            <label class="checkbox-inline i-checks">
              <input type="checkbox" value="option2"><i></i> b
            </label>
            <label class="checkbox-inline i-checks">
              <input type="checkbox" value="option3"><i></i> c
            </label>
          </div>
        </div>

        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Switch</label>
          <div class="col-sm-10">
            <label class="i-switch m-t-xs m-r">
              <input type="checkbox" checked="">
              <i></i>
            </label>
            <label class="i-switch bg-info m-t-xs m-r">
              <input type="checkbox" checked="">
              <i></i>
            </label>
            <label class="i-switch bg-primary m-t-xs m-r">
              <input type="checkbox" checked="">
              <i></i>
            </label>
            <label class="i-switch bg-danger m-t-xs m-r">
              <input type="checkbox" checked="">
              <i></i>
            </label>
          </div>
        </div>

        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Radio Switch</label>
          <div class="col-sm-10">
            <label class="i-switch bg-primary m-t-xs m-r">
              <input type="radio" name="switch" checked="">
              <i></i>
            </label>
            <label class="i-switch bg-warning m-t-xs m-r">
              <input type="radio" name="switch">
              <i></i>
            </label>
          </div>
        </div>

        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Switch size</label>
          <div class="col-sm-10">
            <label class="i-switch i-switch-md bg-info m-t-xs m-r">
              <input type="checkbox" checked="">
              <i></i>
            </label>
            <label class="i-switch i-switch-lg bg-dark m-t-xs m-r">
              <input type="checkbox">
              <i></i>
            </label>
          </div>
        </div>

        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Select</label>
          <div class="col-sm-10">
            <select name="account" class="form-control m-b">
              <option>option 1</option>
              <option>option 2</option>
              <option>option 3</option>
              <option>option 4</option>
            </select>
            <div class="col-lg-4 m-l-n">
              <select multiple="" class="form-control">
                <option>option 1</option>
                <option>option 2</option>
                <option>option 3</option>
                <option>option 4</option>
              </select>
            </div>
          </div>
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group has-success">
          <label class="col-sm-2 control-label">Input with success</label>
          <div class="col-sm-10">
            <input type="text" class="form-control">
          </div>
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group has-warning">
          <label class="col-sm-2 control-label">Input with warning</label>
          <div class="col-sm-10">
            <input type="text" class="form-control">
          </div>
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group has-error">
          <label class="col-sm-2 control-label">Input with error</label>
          <div class="col-sm-10">
            <input type="text" class="form-control">
          </div>
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Control sizing</label>
          <div class="col-sm-10">
            <input class="form-control input-lg m-b" type="text" placeholder=".input-lg">
            <input class="form-control m-b" type="text" placeholder="Default input">
            <input class="form-control input-sm" type="text" placeholder=".input-sm">
          </div>
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Column sizing</label>
          <div class="col-sm-10">
            <div class="row">
              <div class="col-md-2">
                <input type="text" class="form-control" placeholder=".col-md-2">
              </div>
              <div class="col-md-3">
                <input type="text" class="form-control" placeholder=".col-md-3">
              </div>
              <div class="col-md-4">
                <input type="text" class="form-control" placeholder=".col-md-4">
              </div>
            </div>
          </div>
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Input groups</label>
          <div class="col-sm-10">
            <div class="input-group m-b">
              <span class="input-group-addon">@</span>
              <input type="text" class="form-control" placeholder="Username">
            </div>
            <div class="input-group m-b">
              <input type="text" class="form-control">
              <span class="input-group-addon">.00</span>
            </div>
            <div class="input-group m-b">
              <span class="input-group-addon">$</span>
              <input type="text" class="form-control">
              <span class="input-group-addon">.00</span>
            </div>
            <div class="input-group m-b">
              <span class="input-group-addon">
                <input type="checkbox">
              </span>
              <input type="text" class="form-control">
            </div>
            <div class="input-group">
              <span class="input-group-addon">
                <input type="radio">
              </span>
              <input type="text" class="form-control">
            </div>
          </div>
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Button addons</label>
          <div class="col-sm-10">
            <div class="input-group m-b">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button">Go!</button>
              </span>
              <input type="text" class="form-control">
            </div>
            <div class="input-group">
              <input type="text" class="form-control">
              <span class="input-group-btn">
                <button class="btn btn-default" type="button">Go!</button>
              </span>
            </div>
          </div>
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">With dropdowns</label>
          <div class="col-sm-10">
            <div class="input-group m-b">
              <div class="input-group-btn dropdown" dropdown="">
                <button type="button" class="btn btn-default" dropdown-toggle="">Action <span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <li><a href="">Action</a></li>
                  <li><a href="">Another action</a></li>
                  <li><a href="">Something else here</a></li>
                  <li class="divider"></li>
                  <li><a href="">Separated link</a></li>
                </ul>
              </div><!-- /btn-group -->
              <input type="text" class="form-control">
            </div>
            <div class="input-group">
              <input type="text" class="form-control">
              <div class="input-group-btn dropdown" dropdown="">
                <button type="button" class="btn btn-default" dropdown-toggle="">Action <span class="caret"></span></button>
                <ul class="dropdown-menu pull-right">
                  <li><a href="">Action</a></li>
                  <li><a href="">Another action</a></li>
                  <li><a href="">Something else here</a></li>
                  <li class="divider"></li>
                  <li><a href="">Separated link</a></li>
                </ul>
              </div><!-- /btn-group -->
            </div>
          </div>
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Segmented</label>
          <div class="col-sm-10">
            <div class="input-group m-b">
              <div class="input-group-btn dropdown" dropdown="">
                <button type="button" class="btn btn-default" tabindex="-1">Action</button>
                <button type="button" class="btn btn-default" dropdown-toggle=""><span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <li><a href="">Action</a></li>
                  <li><a href="">Another action</a></li>
                  <li><a href="">Something else here</a></li>
                  <li class="divider"></li>
                  <li><a href="">Separated link</a></li>
                </ul>
              </div><!-- /btn-group -->
              <input type="text" class="form-control">
            </div>
            <div class="input-group">
              <input type="text" class="form-control">
              <div class="input-group-btn dropdown" dropdown="">
                <button type="button" class="btn btn-default" tabindex="-1">Action</button>
                <button type="button" class="btn btn-default" dropdown-toggle=""><span class="caret"></span></button>
                <ul class="dropdown-menu pull-right">
                  <li><a href="">Action</a></li>
                  <li><a href="">Another action</a></li>
                  <li><a href="">Something else here</a></li>
                  <li class="divider"></li>
                  <li><a href="">Separated link</a></li>
                </ul>
              </div><!-- /btn-group -->
            </div>
          </div>
        </div>


        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Button radio</label>
          <div class="col-sm-10">
            <div class="btn-group m-r" ng-controller="ButtonsDemoCtrl">
              <label class="btn btn-default" ng-model="radioModel" btn-radio="'Left'" uncheckable="">Left</label>
              <label class="btn btn-default" ng-model="radioModel" btn-radio="'Middle'" uncheckable="">Middle</label>
              <label class="btn btn-default" ng-model="radioModel" btn-radio="'Right'" uncheckable="">Right</label>
            </div>
          </div>
        </div>

        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Button checkbox</label>
          <div class="col-sm-10">
            <div class="btn-group">
                <label class="btn btn-default" ng-model="checkModel.left" btn-checkbox="">Left</label>
                <label class="btn btn-default" ng-model="checkModel.middle" btn-checkbox="">Middle</label>
                <label class="btn btn-default" ng-model="checkModel.right" btn-checkbox="">Right</label>
            </div>
          </div>
        </div>

        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Slider</label>
          <div class="col-sm-10">
            <div class="slider slider-horizontal" style="width: 210px;"><div class="slider-track"><div class="slider-selection" style="left: 0%; width: 25%;"></div><div class="slider-handle round" style="left: 25%;"></div><div class="slider-handle round hide" style="left: 0%;"></div></div><div class="tooltip top" style="top: -30px; left: 41px;"><div class="tooltip-arrow"></div><div class="tooltip-inner">5</div></div><input id="slider" ui-jq="slider" ui-options="{
              min: 0,
              max: 20,
              step: 1,
              value: 5
            }" class="slider slider-horizontal form-control" type="text" style="display: none;"></div> 5
          </div>
        </div>

        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Vertical slider</label>
          <div class="col-sm-10">
            <div class="slider slider-vertical"><div class="slider-track"><div class="slider-selection" style="top: 0%; height: 40%;"></div><div class="slider-handle round" style="top: 40%;"></div><div class="slider-handle round hide" style="top: 0%;"></div></div><div class="tooltip right" style="left: 100%; top: 73px;"><div class="tooltip-arrow"></div><div class="tooltip-inner">11</div></div><input ui-jq="slider" class="slider slider-vertical form-control" type="text" value="" data-slider-min="5" data-slider-max="20" data-slider-step="1" data-slider-value="11" data-slider-orientation="vertical" style="display: none;"></div>
            <div class="slider slider-vertical"><div class="slider-track"><div class="slider-selection" style="top: 0%; height: 66.6667%;"></div><div class="slider-handle round" style="top: 66.6667%;"></div><div class="slider-handle round hide" style="top: 0%;"></div></div><div class="tooltip right" style="left: 100%; top: 129px;"><div class="tooltip-arrow"></div><div class="tooltip-inner">15</div></div><input ui-jq="slider" class="slider slider-vertical form-control" type="text" value="" data-slider-min="5" data-slider-max="20" data-slider-step="1" data-slider-value="15" data-slider-orientation="vertical" style="display: none;"></div>
            <div class="slider slider-vertical"><div class="slider-track"><div class="slider-selection" style="top: 0%; height: 46.6667%;"></div><div class="slider-handle round" style="top: 46.6667%;"></div><div class="slider-handle round hide" style="top: 0%;"></div></div><div class="tooltip right" style="left: 100%; top: 87px;"><div class="tooltip-arrow"></div><div class="tooltip-inner">12</div></div><input ui-jq="slider" class="slider slider-vertical form-control" type="text" value="" data-slider-min="5" data-slider-max="20" data-slider-step="1" data-slider-value="12" data-slider-orientation="vertical" style="display: none;"></div>
          </div>
        </div>

        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Range selector</label>
          <div class="col-sm-10">
            <div class="slider slider-horizontal" style="width: 210px;"><div class="slider-track"><div class="slider-selection" style="left: 24.2424%; width: 50.5051%;"></div><div class="slider-handle round" style="left: 24.2424%;"></div><div class="slider-handle round" style="left: 74.7475%;"></div></div><div class="tooltip top" style="top: -30px; left: 70.9394px;"><div class="tooltip-arrow"></div><div class="tooltip-inner">250 : 750</div></div><input type="text" ui-jq="slider" class="slider form-control" value="" data-slider-min="10" data-slider-max="1000" data-slider-step="5" data-slider-value="[250,750]" style="display: none;"></div>
          </div>
        </div>

        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Spinner</label>
          <div class="col-sm-10">
            <div class="m-b">
              <div class="input-group bootstrap-touchspin"><span class="input-group-btn"><button class="btn btn-default bootstrap-touchspin-down" type="button">-</button></span><span class="input-group-addon bootstrap-touchspin-prefix">$</span><input ui-jq="TouchSpin" type="text" value="0" class="form-control" data-min="0" data-max="10" data-step="0.1" data-decimals="2" data-prefix="$" style="display: block;"><span class="input-group-addon bootstrap-touchspin-postfix" style="display: none;"></span><span class="input-group-btn"><button class="btn btn-default bootstrap-touchspin-up" type="button">+</button></span></div>
            </div>
            <div class="m-b">
              <div class="input-group bootstrap-touchspin"><span class="input-group-btn"><button class="btn btn-default bootstrap-touchspin-down" type="button">-</button></span><span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span><input ui-jq="TouchSpin" type="text" value="5" class="form-control" data-min="0" data-max="10" data-step="0.1" data-decimals="2" data-postfix="%" style="display: block;"><span class="input-group-addon bootstrap-touchspin-postfix">%</span><span class="input-group-btn"><button class="btn btn-default bootstrap-touchspin-up" type="button">+</button></span></div>
            </div>
            <div>
              <div class="input-group bootstrap-touchspin"><span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span><input ui-jq="TouchSpin" type="text" value="10" class="form-control" data-min="0" data-max="20" data-verticalbuttons="true" data-verticalupclass="fa fa-caret-up" data-verticaldownclass="fa fa-caret-down" style="display: block;"><span class="input-group-addon bootstrap-touchspin-postfix" style="display: none;"></span><span class="input-group-btn-vertical"><button class="btn btn-default bootstrap-touchspin-up" type="button"><i class="fa fa-caret-up"></i></button><button class="btn btn-default bootstrap-touchspin-down" type="button"><i class="fa fa-caret-down"></i></button></span></div>
            </div>
          </div>
        </div>

        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Chosen</label>
          <div class="col-sm-10">
            <select ui-jq="chosen" class="w-full" style="display: none;">
                <optgroup label="Alaskan/Hawaiian Time Zone">
                    <option value="AK">Alaska</option>
                    <option value="HI">Hawaii</option>
                </optgroup>
                <optgroup label="Pacific Time Zone">
                    <option value="CA">California</option>
                    <option value="NV">Nevada</option>
                    <option value="OR">Oregon</option>
                    <option value="WA">Washington</option>
                </optgroup>
                <optgroup label="Mountain Time Zone">
                    <option value="AZ">Arizona</option>
                    <option value="CO">Colorado</option>
                    <option value="ID">Idaho</option>
                    <option value="MT">Montana</option><option value="NE">Nebraska</option>
                    <option value="NM">New Mexico</option>
                    <option value="ND">North Dakota</option>
                    <option value="UT">Utah</option>
                    <option value="WY">Wyoming</option>
                </optgroup>
                <optgroup label="Central Time Zone">
                    <option value="AL">Alabama</option>
                    <option value="AR">Arkansas</option>
                    <option value="IL">Illinois</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="OK">Oklahoma</option>
                    <option value="SD">South Dakota</option>
                    <option value="TX">Texas</option>
                    <option value="TN">Tennessee</option>
                    <option value="WI">Wisconsin</option>
                </optgroup>
                <optgroup label="Eastern Time Zone">
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="FL">Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="IN">Indiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="NH">New Hampshire</option><option value="NJ">New Jersey</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="OH">Ohio</option>
                    <option value="PA">Pennsylvania</option><option value="RI">Rhode Island</option><option value="SC">South Carolina</option>
                    <option value="VT">Vermont</option><option value="VA">Virginia</option>
                    <option value="WV">West Virginia</option>
                </optgroup>
            </select><div class="chosen-container chosen-container-single" style="width: 894px;" title=""><a class="chosen-single" tabindex="-1"><span>Alaska</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off"></div><ul class="chosen-results"></ul></div></div>
          </div>
        </div>

        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Chosen multiple</label>
          <div class="col-sm-10">
            <select ui-jq="chosen" multiple="" class="w-md" style="display: none;">
              <option value="AK">Alaska</option>
              <option value="HI">Hawaii</option>
              <option value="CA">California</option>
              <option value="NV">Nevada</option>
              <option value="OR">Oregon</option>
              <option value="WA">Washington</option>
            </select><div class="chosen-container chosen-container-multi" style="width: 240px;" title=""><ul class="chosen-choices"><li class="search-field"><input type="text" value="Select Some Options" class="default" autocomplete="off" style="width: 147px;"></li></ul><div class="chosen-drop"><ul class="chosen-results"></ul></div></div>
          </div>
        </div>

        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Tags input</label>
          <div class="col-sm-10">
            <input ui-jq="tagsinput" ui-options="" class="form-control w-md" style="display: none;"><div class="bootstrap-tagsinput"><input type="text" placeholder="" style="width: 3em !important;"></div>
          </div>
        </div>

        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Datepicker</label>
          <div class="col-sm-10" ng-controller="DatepickerDemoCtrl">
            <div class="input-group w-md">
              <input type="text" class="form-control" datepicker-popup="" ng-model="dt" is-open="opened" datepicker-options="dateOptions" ng-required="true" close-text="Close">
              <span class="input-group-btn">
                <button type="button" class="btn btn-default" ng-click="open($event)"><i class="glyphicon glyphicon-calendar"></i></button>
              </span>
            </div>
          </div>
        </div>

        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Date range picker</label>
          <div class="col-sm-10">
            <input ui-jq="daterangepicker" ui-options="{
                format: 'YYYY-MM-DD',
                startDate: '2013-01-01',
                endDate: '2013-12-31'
              }" class="form-control w-md">
          </div>
        </div>

        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">File input</label>
          <div class="col-sm-10">
            <input ui-jq="filestyle" type="file" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="filestyle-0" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control " disabled=""> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="filestyle-0" class="btn btn-default "><span class="glyphicon glyphicon-folder-open"></span> Choose file</label></span></div>
          </div>
        </div>
        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Wysiwyg</label>
          <div class="col-sm-10">
            <div class="btn-toolbar m-b-sm btn-editor" data-role="editor-toolbar" data-target="#editor">
              <div class="btn-group dropdown" dropdown="">
                <a class="btn btn-default" dropdown-toggle="" tooltip="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="" data-edit="fontName Serif" style="font-family:'Serif'">Serif</a></li>
                  <li><a href="" data-edit="fontName Sans" style="font-family:'Sans'">Sans</a></li>
                  <li><a href="" data-edit="fontName Arial" style="font-family:'Arial'">Arial</a></li></ul>
              </div>
              <div class="btn-group dropdown" dropdown="">
                <a class="btn btn-default" dropdown-toggle="" data-toggle="dropdown" tooltip="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="" data-edit="fontSize 5" style="font-size:24px">Huge</a></li>
                  <li><a href="" data-edit="fontSize 3" style="font-size:18px">Normal</a></li>
                  <li><a href="" data-edit="fontSize 1" style="font-size:14px">Small</a></li>
                </ul>
              </div>
              <div class="btn-group">
                <a class="btn btn-default" data-edit="bold" tooltip="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                <a class="btn btn-default" data-edit="italic" tooltip="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                <a class="btn btn-default" data-edit="strikethrough" tooltip="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                <a class="btn btn-default" data-edit="underline" tooltip="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
              </div>
              <div class="btn-group">
                <a class="btn btn-default" data-edit="insertunorderedlist" tooltip="Bullet list"><i class="fa fa-list-ul"></i></a>
                <a class="btn btn-default" data-edit="insertorderedlist" tooltip="Number list"><i class="fa fa-list-ol"></i></a>
                <a class="btn btn-default" data-edit="outdent" tooltip="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
                <a class="btn btn-default" data-edit="indent" tooltip="Indent (Tab)"><i class="fa fa-indent"></i></a>
              </div>
              <div class="btn-group">
                <a class="btn btn-default" data-edit="justifyleft" tooltip="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                <a class="btn btn-default" data-edit="justifycenter" tooltip="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                <a class="btn btn-default" data-edit="justifyright" tooltip="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
                <a class="btn btn-default" data-edit="justifyfull" tooltip="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
              </div>
              <div class="btn-group dropdown" dropdown="">
                <a class="btn btn-default" dropdown-toggle="" tooltip="Hyperlink"><i class="fa fa-link"></i></a>
                <div class="dropdown-menu">
                  <div class="input-group m-l-xs m-r-xs">
                    <input class="form-control input-sm" id="LinkInput" placeholder="URL" type="text" data-edit="createLink">
                    <div class="input-group-btn">
                      <button class="btn btn-sm btn-default" type="button">Add</button>
                    </div>
                  </div>
                </div>
                <a class="btn btn-default" data-edit="unlink" tooltip="Remove Hyperlink"><i class="fa fa-cut"></i></a>
              </div>

              <div class="btn-group">
                <a class="btn btn-default" tooltip="Insert picture (or just drag &amp; drop)" id="pictureBtn"><i class="fa fa-picture-o"></i></a>
                <input type="file" data-edit="insertImage" style="position:absolute; opacity:0; width:41px; height:34px">
              </div>
              <div class="btn-group">
                <a class="btn btn-default" data-edit="undo" tooltip="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                <a class="btn btn-default" data-edit="redo" tooltip="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
              </div>
            </div>
            <div ui-jq="wysiwyg" class="form-control" style="overflow:scroll;height:200px;max-height:200px" contenteditable="true">
              Go ahead…
            </div>
          </div>
        </div>

        <div class="line line-dashed b-b line-lg pull-in"></div>
        <div class="form-group">
          <div class="col-sm-4 col-sm-offset-2">
            <button type="submit" class="btn btn-default">Cancel</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </form>
    </div>
  </div>
      </div>

    <!-- Navs
    ================================================== -->
      <div class="bs-docs-section">

        <div class="row">
          <div class="col-lg-12">
            <div class="page-header">
              <h1 id="navs">Navs</h1>
            </div>
          </div>
        </div>

        <div class="row" style="margin-bottom: 2rem;">
          <div class="col-lg-6">
            <h2 id="nav-tabs">Tabs</h2>
            <div class="bs-component">
              <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#home">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#profile">Profile</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" href="#">Disabled</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Separated link</a>
                  </div>
                </li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade show active" id="home">
                  <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                </div>
                <div class="tab-pane fade" id="profile">
                  <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit.</p>
                </div>
                <div class="tab-pane fade" id="dropdown1">
                  <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork.</p>
                </div>
                <div class="tab-pane fade" id="dropdown2">
                  <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater.</p>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <h2 id="nav-pills">Pills</h2>
            <div class="bs-component">
              <ul class="nav nav-pills">
                <li class="nav-item">
                  <a class="nav-link active" href="#">Active</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Separated link</a>
                  </div>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" href="#">Disabled</a>
                </li>
              </ul>
            </div>
            <br>
            <div class="bs-component">
              <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                  <a class="nav-link active" href="#">Active</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Separated link</a>
                  </div>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" href="#">Disabled</a>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-6">
            <h2 id="nav-breadcrumbs">Breadcrumbs</h2>
            <div class="bs-component">
              <ol class="breadcrumb">
                <li class="breadcrumb-item active">Home</li>
              </ol>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Library</li>
              </ol>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Library</a></li>
                <li class="breadcrumb-item active">Data</li>
              </ol>
            </div>
          </div>

          <div class="col-lg-6">
            <h2 id="pagination">Pagination</h2>
            <div class="bs-component">
              <div>
                <ul class="pagination">
                  <li class="page-item disabled">
                    <a class="page-link" href="#">«</a>
                  </li>
                  <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">2</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">3</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">4</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">5</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">»</a>
                  </li>
                </ul>
              </div>

              <div>
                <ul class="pagination pagination-lg">
                  <li class="page-item disabled">
                    <a class="page-link" href="#">«</a>
                  </li>
                  <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">2</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">3</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">4</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">5</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">»</a>
                  </li>
                </ul>
              </div>

              <div>
                <ul class="pagination pagination-sm">
                  <li class="page-item disabled">
                    <a class="page-link" href="#">«</a>
                  </li>
                  <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">2</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">3</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">4</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">5</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">»</a>
                  </li>
                </ul>
              </div>

            </div>
          </div>
        </div>
      </div>

    <!-- Indicators
    ================================================== -->
      <div class="bs-docs-section">

        <div class="row">
          <div class="col-lg-12">
            <div class="page-header">
              <h1 id="indicators">Indicators</h1>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <h2>Alerts</h2>
            <div class="bs-component">
              <div class="alert alert-dismissible alert-warning">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <h4 class="alert-heading">Warning!</h4>
                <p class="mb-0">Best check yo self, you're not looking too good. Nulla vitae elit libero, a pharetra augue. Praesent commodo cursus magna, <a href="#" class="alert-link">vel scelerisque nisl consectetur et</a>.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class="bs-component">
              <div class="alert alert-dismissible alert-danger">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Oh snap!</strong> <a href="#" class="alert-link">Change a few things up</a> and try submitting again.
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="bs-component">
              <div class="alert alert-dismissible alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Well done!</strong> You successfully read <a href="#" class="alert-link">this important alert message</a>.
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="bs-component">
              <div class="alert alert-dismissible alert-info">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Heads up!</strong> This <a href="#" class="alert-link">alert needs your attention</a>, but it's not super important.
              </div>
            </div>
          </div>
        </div>
        <div>
          <h2>Badges</h2>
          <div class="bs-component" style="margin-bottom: 40px;">
            <span class="badge badge-primary">Primary</span>
            <span class="badge badge-secondary">Secondary</span>
            <span class="badge badge-success">Success</span>
            <span class="badge badge-danger">Danger</span>
            <span class="badge badge-warning">Warning</span>
            <span class="badge badge-info">Info</span>
            <span class="badge badge-light">Light</span>
            <span class="badge badge-dark">Dark</span>
          </div>
          <div class="bs-component">
            <span class="badge badge-pill badge-primary">Primary</span>
            <span class="badge badge-pill badge-secondary">Secondary</span>
            <span class="badge badge-pill badge-success">Success</span>
            <span class="badge badge-pill badge-danger">Danger</span>
            <span class="badge badge-pill badge-warning">Warning</span>
            <span class="badge badge-pill badge-info">Info</span>
            <span class="badge badge-pill badge-light">Light</span>
            <span class="badge badge-pill badge-dark">Dark</span>
          </div>
        </div>
      </div>

    <!-- Progress
    ================================================== -->
      <div class="bs-docs-section">

        <div class="row">
          <div class="col-lg-12">
            <div class="page-header">
              <h1 id="progress">Progress</h1>
            </div>

            <h3 id="progress-basic">Basic</h3>
            <div class="bs-component">
              <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

            <h3 id="progress-alternatives">Contextual alternatives</h3>
            <div class="bs-component">
              <div class="progress">
                <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <div class="progress">
                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <div class="progress">
                <div class="progress-bar bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <div class="progress">
                <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

            <h3 id="progress-multiple">Multiple bars</h3>
            <div class="bs-component">
              <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                <div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

            <h3 id="progress-striped">Striped</h3>
            <div class="bs-component">
              <div class="progress">
                <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <div class="progress">
                <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <div class="progress">
                <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <div class="progress">
                <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <div class="progress">
                <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>

            <h3 id="progress-animated">Animated</h3>
            <div class="bs-component">
              <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
              </div>
            </div>
          </div>
        </div>
      </div>

    <!-- Containers
    ================================================== -->
      <div class="bs-docs-section">

        <div class="row">
          <div class="col-lg-12">
            <div class="page-header">
              <h1 id="containers">Containers</h1>
            </div>
            <div class="bs-component">
              <div class="jumbotron">
                <h1 class="display-3">Hello, world!</h1>
                <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                <hr class="my-4">
                <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
                <p class="lead">
                  <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
                </p>
              </div>
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-lg-12">
            <h2>List groups</h2>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-4">
            <div class="bs-component">
              <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  Cras justo odio
                  <span class="badge badge-primary badge-pill">14</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  Dapibus ac facilisis in
                  <span class="badge badge-primary badge-pill">2</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  Morbi leo risus
                  <span class="badge badge-primary badge-pill">1</span>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="bs-component">
              <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action active">
                  Cras justo odio
                </a>
                <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in
                </a>
                <a href="#" class="list-group-item list-group-item-action disabled">Morbi leo risus
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="bs-component">
              <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">List group item heading</h5>
                    <small>3 days ago</small>
                  </div>
                  <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                  <small>Donec id elit non mi porta.</small>
                </a>
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">List group item heading</h5>
                    <small class="text-muted">3 days ago</small>
                  </div>
                  <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                  <small class="text-muted">Donec id elit non mi porta.</small>
                </a>
              </div>
            </div>
          </div>
        </div>


      </div>




      </div>
    </div>



@endsection
