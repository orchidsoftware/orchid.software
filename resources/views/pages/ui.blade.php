@extends('layouts.app')

@section('content')



    <div class="container bg-white b block-shadow m-t-xl m-b-xl  wrapper-lg">

        <!-- Navbar
        ================================================== -->
      <div class="bs-docs-section clearfix">
        <div class="row">
          <div class="col-lg-12">
            <div class="page-header">
              <h1 class="font-thin"  class="font-thin" id="navbar">Navbar</h1>
            </div>


          <div class="bs-component">
              <nav class="navbar bg-white">
                <div class="container-fluid">
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Brand</a>
                  </div>

                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                      <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                      <li><a href="#">Link</a></li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Action</a></li>
                          <li><a href="#">Another action</a></li>
                          <li><a href="#">Something else here</a></li>
                          <li class="divider"></li>
                          <li><a href="#">Separated link</a></li>
                          <li class="divider"></li>
                          <li><a href="#">One more separated link</a></li>
                        </ul>
                      </li>
                    </ul>
                    <form class="navbar-form navbar-left" role="search">
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                      </div>
                      <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                    <ul class="nav navbar-nav navbar-right">
                      <li><a href="#">Link</a></li>
                    </ul>
                  </div>
                </div>
              </nav>
            </div>

            <div class="bs-component">
              <nav class="navbar navbar-default">
                <div class="container-fluid">
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Brand</a>
                  </div>

                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                      <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                      <li><a href="#">Link</a></li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Action</a></li>
                          <li><a href="#">Another action</a></li>
                          <li><a href="#">Something else here</a></li>
                          <li class="divider"></li>
                          <li><a href="#">Separated link</a></li>
                          <li class="divider"></li>
                          <li><a href="#">One more separated link</a></li>
                        </ul>
                      </li>
                    </ul>
                    <form class="navbar-form navbar-left" role="search">
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                      </div>
                      <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                    <ul class="nav navbar-nav navbar-right">
                      <li><a href="#">Link</a></li>
                    </ul>
                  </div>
                </div>
              </nav>
            </div>


            <div class="bs-component">
              <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Brand</a>
                  </div>

                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                    <ul class="nav navbar-nav">
                      <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                      <li><a href="#">Link</a></li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Action</a></li>
                          <li><a href="#">Another action</a></li>
                          <li><a href="#">Something else here</a></li>
                          <li class="divider"></li>
                          <li><a href="#">Separated link</a></li>
                          <li class="divider"></li>
                          <li><a href="#">One more separated link</a></li>
                        </ul>
                      </li>
                    </ul>
                    <form class="navbar-form navbar-left" role="search">
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search">
                      </div>
                      <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                    <ul class="nav navbar-nav navbar-right">
                      <li><a href="#">Link</a></li>
                    </ul>
                  </div>
                </div>
              </nav>
            </div><!-- /example -->

          </div>
        </div>
      </div>


        <!-- Buttons
        ================================================== -->
      <div class="bs-docs-section">
        <div class="page-header">
          <div class="row">
            <div class="col-lg-12">
              <h1 class="font-thin"  id="buttons">Buttons</h1>
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
              <h1 class="font-thin"  id="typography">Typography</h1>
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
              <p class="lead">Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="bs-component">
              <h2>Example body text</h2>
              <p>Nullam quis risus eget <a href="#">urna mollis ornare</a> vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula.</p>
              <p><small>This line of text is meant to be treated as fine print.</small></p>
              <p>The following snippet of text is <strong>rendered as bold text</strong>.</p>
              <p>The following snippet of text is <em>rendered as italicized text</em>.</p>
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
          <div class="col-lg-6">
            <div class="bs-component">
              <blockquote>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                <small>Someone famous in <cite title="Source Title">Source Title</cite></small>
              </blockquote>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="bs-component">
              <blockquote class="blockquote-reverse">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                <small>Someone famous in <cite title="Source Title">Source Title</cite></small>
              </blockquote>
            </div>
          </div>
        </div>
      </div>



        <!-- Grid System
   ================================================== -->
      <div class="bs-docs-section">
        <div class="page-header">
          <div class="row">
            <div class="col-lg-12">
              <h1 class="font-thin"  id="grid">Grid System</h1>
            </div>
          </div>
        </div>

        <div class="row">
    <div class="col-lg-12">
      <p>Base on Bootstrap grid system, you can get the columns as you want. 12 / (cols) = col-lg-(each-col-width-taken), like 12/3 = col-lg-4, 12/5 = col-lg-2.4 <span class="text-muted">(replace the '.' with '-')</span></p>
    </div>
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-body">col-lg-12</div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="panel panel-default">
        <div class="panel-body">col-lg-6</div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="panel panel-default">
        <div class="panel-body">col-lg-6</div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="panel panel-default">
        <div class="panel-body">col-lg-4</div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="panel panel-default">
        <div class="panel-body">col-lg-4</div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="panel panel-default">
        <div class="panel-body">col-lg-4</div>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="panel panel-default">
        <div class="panel-body">col-lg-3</div>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="panel panel-default">
        <div class="panel-body">col-lg-3</div>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="panel panel-default">
        <div class="panel-body">col-lg-3</div>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="panel panel-default">
        <div class="panel-body">col-lg-3</div>
      </div>
    </div>
    <div class="col-lg-2-4">
      <div class="panel panel-default">
        <div class="panel-body">col-lg-2-4</div>
      </div>
    </div>
    <div class="col-lg-2-4">
      <div class="panel panel-default">
        <div class="panel-body">col-lg-2-4</div>
      </div>
    </div>
    <div class="col-lg-2-4">
      <div class="panel panel-default">
        <div class="panel-body">col-lg-2-4</div>
      </div>
    </div>
    <div class="col-lg-2-4">
      <div class="panel panel-default">
        <div class="panel-body">col-lg-2-4</div>
      </div>
    </div>
    <div class="col-lg-2-4">
      <div class="panel panel-default">
        <div class="panel-body">col-lg-2-4</div>
      </div>
    </div>
    <div class="col-lg-2">
      <div class="panel panel-default">
        <div class="panel-body">col-lg-2</div>
      </div>
    </div>
    <div class="col-lg-2">
      <div class="panel panel-default">
        <div class="panel-body">col-lg-2</div>
      </div>
    </div>
    <div class="col-lg-2">
      <div class="panel panel-default">
        <div class="panel-body">col-lg-2</div>
      </div>
    </div>
    <div class="col-lg-2">
      <div class="panel panel-default">
        <div class="panel-body">col-lg-2</div>
      </div>
    </div>
    <div class="col-lg-2">
      <div class="panel panel-default">
        <div class="panel-body">col-lg-2</div>
      </div>
    </div>
    <div class="col-lg-2">
      <div class="panel panel-default">
        <div class="panel-body">col-lg-2</div>
      </div>
    </div>
    <div class="col-lg-12">
      <p>Mobile, tablet, and desktop</p>
    </div>
    <div class="col-lg-4">
      <div class="row">
        <div class="col-xs-6">
          <div class="panel panel-default">
            <div class="panel-body">col-xs-6</div>
          </div>
        </div>
        <div class="col-xs-6">
          <div class="panel panel-default">
            <div class="panel-body">col-xs-6</div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="panel panel-default">
        <div class="panel-body">col-lg-8</div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="row">
        <div class="col-sm-6">
          <div class="panel panel-default">
            <div class="panel-body">col-sm-6</div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="panel panel-default">
            <div class="panel-body">col-sm-6</div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="panel panel-default">
        <div class="panel-body">col-lg-6</div>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="row">
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-body">col-md-6</div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-body">col-md-6</div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="panel panel-default">
        <div class="panel-body">col-lg-4</div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="panel panel-default">
        <div class="panel-body">col-sm-6</div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="panel panel-default">
        <div class="panel-body">col-sm-6</div>
      </div>
    </div>
  </div>
      </div>



        <!-- Form Elements
================================================== -->
      <div class="bs-docs-section">
        <div class="page-header">
          <div class="row">
            <div class="col-lg-12">
              <h1 class="font-thin"  id="form">Form Elements</h1>
            </div>
          </div>
        </div>

<div class="wrapper-md" ng-controller="FormDemoCtrl">
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
            </select><div class="chosen-container chosen-container-single" style="width: 837px;" title=""><a class="chosen-single" tabindex="-1"><span>Alaska</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off"></div><ul class="chosen-results"></ul></div></div>
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


      </div>



        <!-- Tables
        ================================================== -->
      <div class="bs-docs-section">

        <div class="row">
          <div class="col-lg-12">
            <div class="page-header">
              <h1 class="font-thin"  id="tables">Tables</h1>
            </div>

            <div class="bs-component">
              <div class="wrapper-md">
  <div class="row">
    <div class="col-sm-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <span class="label bg-danger pull-right m-t-xs">4 left</span>
          Tasks
        </div>
        <table class="table table-striped m-b-none">
          <thead>
            <tr>
              <th>Progress</th>
              <th>Item</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <div class="progress progress-sm progress-striped active m-t-xs m-b-none">
                  <div class="progress-bar bg-success" data-toggle="tooltip" data-original-title="80%" style="width: 80%"></div>
                </div>
              </td>
              <td>App prototype design</td>
            </tr>
            <tr>
              <td>
                <div class="progress progress-xs m-t-xs m-b-none">
                  <div class="progress-bar bg-info" data-toggle="tooltip" data-original-title="40%" style="width: 40%"></div>
                </div>
              </td>
              <td>Design documents</td>
            </tr>
            <tr>
              <td>
                <div class="progress progress-xs m-t-xs m-b-none">
                  <div class="progress-bar bg-warning" data-toggle="tooltip" data-original-title="20%" style="width: 20%"></div>
                </div>
              </td>
              <td>UI toolkit</td>
            </tr>
            <tr>
              <td>
                <div class="progress progress-xs m-t-xs m-b-none">
                  <div class="progress-bar bg-danger" data-toggle="tooltip" data-original-title="15%" style="width: 15%"></div>
                </div>
              </td>
              <td>Testing</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="panel panel-default">
        <div class="panel-heading">Stats</div>
        <table class="table table-striped m-b-none">
          <thead>
            <tr>
              <th>Item</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr>

              <td>App downloads</td>
              <td class="text-success">
                <i class="fa fa-level-up"></i> 40%
              </td>
            </tr>
            <tr>
              <td>Social connection</td>
              <td class="text-success">
                <i class="fa fa-level-up"></i> 20%
              </td>
            </tr>
            <tr>
              <td>Revenue</td>
              <td class="text-warning">
                <i class="fa fa-level-down"></i> 5%
              </td>
            </tr>
            <tr>
              <td>Customer increase</td>
              <td class="text-danger">
                <i class="fa fa-level-down"></i> 20%
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      Responsive Table
    </div>
    <div class="row wrapper">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Project</th>
            <th>Task</th>
            <th>Date</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>Idrawfast prototype design prototype design prototype design prototype design prototype design</td>
            <td><span class="text-ellipsis">{item.PrHelpText1}</span></td>
            <td><span class="text-ellipsis">{item.PrHelpText1}</span></td>
            <td>
              <a href="" class="active" ui-toggle-class=""><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>Formasa</td>
            <td>8c</td>
            <td>Jul 22, 2013</td>
            <td>
              <a href="" ui-toggle-class=""><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>Avatar system</td>
            <td>15c</td>
            <td>Jul 15, 2013</td>
            <td>
              <a href="" class="active" ui-toggle-class=""><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>Throwdown</td>
            <td>4c</td>
            <td>Jul 11, 2013</td>
            <td>
              <a href="" class="active" ui-toggle-class=""><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>Idrawfast</td>
            <td>4c</td>
            <td>Jul 7, 2013</td>
            <td>
              <a href="" class="active" ui-toggle-class=""><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>Formasa</td>
            <td>8c</td>
            <td>Jul 3, 2013</td>
            <td>
              <a href="" class="active" ui-toggle-class=""><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>Avatar system</td>
            <td>15c</td>
            <td>Jul 2, 2013</td>
            <td>
              <a href="" class="active" ui-toggle-class=""><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>Videodown</td>
            <td>4c</td>
            <td>Jul 1, 2013</td>
            <td>
              <a href="" class="active" ui-toggle-class=""><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        <div class="col-sm-4 hidden-xs">
          <select class="input-sm form-control w-sm inline v-middle">
            <option value="0">Bulk action</option>
            <option value="1">Delete selected</option>
            <option value="2">Bulk edit</option>
            <option value="3">Export</option>
          </select>
          <button class="btn btn-sm btn-default">Apply</button>
        </div>
        <div class="col-sm-4 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-4 text-right text-center-xs">
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href="">5</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
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
              <h1 class="font-thin"  id="forms">Forms</h1>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-6">
            <div class="well bs-component">
              <form class="form-horizontal">
                <fieldset>
                  <legend>Legend</legend>
                  <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                    <div class="col-lg-10">
                      <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> Checkbox
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="textArea" class="col-lg-2 control-label">Textarea</label>
                    <div class="col-lg-10">
                      <textarea class="form-control" rows="3" id="textArea"></textarea>
                      <span class="help-block">A longer block of help text that breaks onto a new line and may extend beyond one line.</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-lg-2 control-label">Radios</label>
                    <div class="col-lg-10">
                      <div class="radio">
                        <label>
                          <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
                          Option one is this
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                          Option two can be something else
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="select" class="col-lg-2 control-label">Selects</label>
                    <div class="col-lg-10">
                      <select class="form-control" id="select">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                      </select>
                      <br>
                      <select multiple="" class="form-control">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                      <button type="reset" class="btn btn-default">Cancel</button>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </div>
                </fieldset>
              </form>
            </div>
          </div>
          <div class="col-lg-4 col-lg-offset-1">

              <form class="bs-component">
                <div class="form-group">
                  <label class="control-label" for="focusedInput">Focused input</label>
                  <input class="form-control" id="focusedInput" type="text" value="This is focused...">
                </div>

                <div class="form-group">
                  <label class="control-label" for="disabledInput">Disabled input</label>
                  <input class="form-control" id="disabledInput" type="text" placeholder="Disabled input here..." disabled="">
                </div>

                <div class="form-group has-warning">
                  <label class="control-label" for="inputWarning">Input warning</label>
                  <input type="text" class="form-control" id="inputWarning">
                </div>

                <div class="form-group has-error">
                  <label class="control-label" for="inputError">Input error</label>
                  <input type="text" class="form-control" id="inputError">
                </div>

                <div class="form-group has-success">
                  <label class="control-label" for="inputSuccess">Input success</label>
                  <input type="text" class="form-control" id="inputSuccess">
                </div>

                <div class="form-group">
                  <label class="control-label" for="inputLarge">Large input</label>
                  <input class="form-control input-lg" type="text" id="inputLarge">
                </div>

                <div class="form-group">
                  <label class="control-label" for="inputDefault">Default input</label>
                  <input type="text" class="form-control" id="inputDefault">
                </div>

                <div class="form-group">
                  <label class="control-label" for="inputSmall">Small input</label>
                  <input class="form-control input-sm" type="text" id="inputSmall">
                </div>

                <div class="form-group">
                  <label class="control-label">Input addons</label>
                  <div class="input-group">
                    <span class="input-group-addon">$</span>
                    <input type="text" class="form-control">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Button</button>
                    </span>
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
              <h1 class="font-thin"  id="navs">Navs</h1>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-4">
            <h2 id="nav-tabs">Tabs</h2>
            <div class="bs-component">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#home" data-toggle="tab">Home</a></li>
                <li><a href="#profile" data-toggle="tab">Profile</a></li>
                <li class="disabled"><a>Disabled</a></li>
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    Dropdown <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a href="#dropdown1" data-toggle="tab">Action</a></li>
                    <li class="divider"></li>
                    <li><a href="#dropdown2" data-toggle="tab">Another action</a></li>
                  </ul>
                </li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="home">
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
          <div class="col-lg-4">
            <h2 id="nav-pills">Pills</h2>
            <div class="bs-component">
              <ul class="nav nav-pills">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Profile</a></li>
                <li class="disabled"><a href="#">Disabled</a></li>
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    Dropdown <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </li>
              </ul>
            </div>
            <br>
            <div class="bs-component">
              <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Profile</a></li>
                <li class="disabled"><a href="#">Disabled</a></li>
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    Dropdown <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-lg-4">
            <h2 id="nav-breadcrumbs">Breadcrumbs</h2>
            <div class="bs-component">
              <ul class="breadcrumb">
                <li class="active">Home</li>
              </ul>

              <ul class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Library</li>
              </ul>

              <ul class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#">Library</a></li>
                <li class="active">Data</li>
              </ul>
            </div>

          </div>
        </div>


        <div class="row">
          <div class="col-lg-4">
            <h2 id="pagination">Pagination</h2>
            <div class="bs-component">
              <ul class="pagination">
                <li class="disabled"><a href="#">&laquo;</a></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&raquo;</a></li>
              </ul>

              <ul class="pagination pagination-lg">
                <li class="disabled"><a href="#">&laquo;</a></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">&raquo;</a></li>
              </ul>

              <ul class="pagination pagination-sm">
                <li class="disabled"><a href="#">&laquo;</a></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&raquo;</a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-4">
            <h2 id="pager">Pager</h2>
            <div class="bs-component">
              <ul class="pager">
                <li><a href="#">Previous</a></li>
                <li><a href="#">Next</a></li>
              </ul>

              <ul class="pager">
                <li class="previous disabled"><a href="#">&larr; Older</a></li>
                <li class="next"><a href="#">Newer &rarr;</a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-4">

          </div>
        </div>
      </div>

        <!-- Indicators
        ================================================== -->
      <div class="bs-docs-section">

        <div class="row">
          <div class="col-lg-12">
            <div class="page-header">
              <h1 class="font-thin"  id="indicators">Indicators</h1>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <h2>Alerts</h2>
            <div class="bs-component">
              <div class="alert alert-dismissible alert-warning">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h4>Warning!</h4>
                <p>Best check yo self, you're not looking too good. Nulla vitae elit libero, a pharetra augue. Praesent commodo cursus magna, <a href="#" class="alert-link">vel scelerisque nisl consectetur et</a>.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class="bs-component">
              <div class="alert alert-dismissible alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Oh snap!</strong> <a href="#" class="alert-link">Change a few things up</a> and try submitting again.
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="bs-component">
              <div class="alert alert-dismissible alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Well done!</strong> You successfully read <a href="#" class="alert-link">this important alert message</a>.
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="bs-component">
              <div class="alert alert-dismissible alert-info">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Heads up!</strong> This <a href="#" class="alert-link">alert needs your attention</a>, but it's not super important.
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <h2>Labels</h2>
            <div class="bs-component" style="margin-bottom: 40px;">
              <span class="label label-default">Default</span>
              <span class="label label-primary">Primary</span>
              <span class="label label-success">Success</span>
              <span class="label label-warning">Warning</span>
              <span class="label label-danger">Danger</span>
              <span class="label label-info">Info</span>
            </div>
          </div>
          <div class="col-lg-4">
            <h2>Badges</h2>
            <div class="bs-component">
              <ul class="nav nav-pills">
                <li class="active"><a href="#">Home <span class="badge">42</span></a></li>
                <li><a href="#">Profile <span class="badge"></span></a></li>
                <li><a href="#">Messages <span class="badge">3</span></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>

        <!-- Progress bars
        ================================================== -->
      <div class="bs-docs-section">

        <div class="row">
          <div class="col-lg-12">
            <div class="page-header">
              <h1 class="font-thin"  id="progress-bars">Progress bars</h1>
            </div>

            <h3 id="progress-basic">Basic</h3>
            <div class="bs-component">
              <div class="progress">
                <div class="progress-bar" style="width: 60%;"></div>
              </div>
            </div>

            <h3 id="progress-alternatives">Contextual alternatives</h3>
            <div class="bs-component">
              <div class="progress">
                <div class="progress-bar progress-bar-info" style="width: 20%"></div>
              </div>

              <div class="progress">
                <div class="progress-bar progress-bar-success" style="width: 40%"></div>
              </div>

              <div class="progress">
                <div class="progress-bar progress-bar-warning" style="width: 60%"></div>
              </div>

              <div class="progress">
                <div class="progress-bar progress-bar-danger" style="width: 80%"></div>
              </div>
            </div>

            <h3 id="progress-striped">Striped</h3>
            <div class="bs-component">
              <div class="progress progress-striped">
                <div class="progress-bar progress-bar-info" style="width: 20%"></div>
              </div>

              <div class="progress progress-striped">
                <div class="progress-bar progress-bar-success" style="width: 40%"></div>
              </div>

              <div class="progress progress-striped">
                <div class="progress-bar progress-bar-warning" style="width: 60%"></div>
              </div>

              <div class="progress progress-striped">
                <div class="progress-bar progress-bar-danger" style="width: 80%"></div>
              </div>
            </div>

            <h3 id="progress-animated">Animated</h3>
            <div class="bs-component">
              <div class="progress progress-striped active">
                <div class="progress-bar" style="width: 45%"></div>
              </div>
            </div>

            <h3 id="progress-stacked">Stacked</h3>
            <div class="bs-component">
              <div class="progress">
                <div class="progress-bar progress-bar-success" style="width: 35%"></div>
                <div class="progress-bar progress-bar-warning" style="width: 20%"></div>
                <div class="progress-bar progress-bar-danger" style="width: 10%"></div>
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
              <h1 class="font-thin"  id="containers">Containers</h1>
            </div>
            <div class="bs-component">
              <div class="jumbotron">
                <h1 class="font-thin" >Jumbotron</h1>
                <p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
                <p><a class="btn btn-primary btn-lg">Learn more</a></p>
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
                <li class="list-group-item">
                  <span class="badge">14</span>
                  Cras justo odio
                </li>
                <li class="list-group-item">
                  <span class="badge">2</span>
                  Dapibus ac facilisis in
                </li>
                <li class="list-group-item">
                  <span class="badge">1</span>
                  Morbi leo risus
                </li>
              </ul>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="bs-component">
              <div class="list-group">
                <a href="#" class="list-group-item active">
                  Cras justo odio
                </a>
                <a href="#" class="list-group-item">Dapibus ac facilisis in
                </a>
                <a href="#" class="list-group-item">Morbi leo risus
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="bs-component">
              <div class="list-group">
                <a href="#" class="list-group-item">
                  <h4 class="list-group-item-heading">List group item heading</h4>
                  <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                </a>
                <a href="#" class="list-group-item">
                  <h4 class="list-group-item-heading">List group item heading</h4>
                  <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                </a>
              </div>
            </div>
          </div>
        </div>


        <div class="row">
          <div class="col-lg-12">
            <h2>Panels</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class="bs-component">
              <div class="panel panel-default">
                <div class="panel-body">
                  Basic panel
                </div>
              </div>

              <div class="panel panel-default">
                <div class="panel-heading">Panel heading</div>
                <div class="panel-body">
                  Panel content
                </div>
              </div>

              <div class="panel panel-default">
                <div class="panel-body">
                  Panel content
                </div>
                <div class="panel-footer">Panel footer</div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="bs-component">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title">Panel primary</h3>
                </div>
                <div class="panel-body">
                  Panel content
                </div>
              </div>

              <div class="panel panel-success">
                <div class="panel-heading">
                  <h3 class="panel-title">Panel success</h3>
                </div>
                <div class="panel-body">
                  Panel content
                </div>
              </div>

              <div class="panel panel-warning">
                <div class="panel-heading">
                  <h3 class="panel-title">Panel warning</h3>
                </div>
                <div class="panel-body">
                  Panel content
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="bs-component">
              <div class="panel panel-danger">
                <div class="panel-heading">
                  <h3 class="panel-title">Panel danger</h3>
                </div>
                <div class="panel-body">
                  Panel content
                </div>
              </div>

              <div class="panel panel-info">
                <div class="panel-heading">
                  <h3 class="panel-title">Panel info</h3>
                </div>
                <div class="panel-body">
                  Panel content
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <h2>Wells</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4">
            <div class="bs-component">
              <div class="well">
                Look, I'm in a well!
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="bs-component">
              <div class="well well-sm">
                Look, I'm in a small well!
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="bs-component">
              <div class="well well-lg">
                Look, I'm in a large well!
              </div>
            </div>
          </div>
        </div>
      </div>




        <!-- Widgets
  ================================================== -->
      <div class="bs-docs-section">

        <div class="row">
          <div class="col-lg-12">
            <div class="page-header">
              <h1 class="font-thin"  id="widgets">Widgets</h1>
            </div>
            <div class="bs-component">

              <div class="row">
    <div class="col-md-4">
      <div class="panel b-a">
        <div class="panel-heading no-border bg-primary">
          <span class="text-lt">The Restaurant</span>
        </div>
        <div class="item m-l-n-xxs m-r-n-xxs">
          <div ng-init="x = 3" class="top text-right padder m-t-xs w-full">
            <rating ng-model="x" max="5" state-on="'fa fa-star text-white'" state-off="'fa fa-star-o text-white'"></rating>
          </div>
          <div class="center text-center w-full" style="margin-top:-60px">
            <div ui-jq="easyPieChart" ui-refresh="x" ui-options="{
                percent: 45,
                lineWidth: 60,
                trackColor: 'rgba(255,255,255,0)',
                barColor: 'rgba(35,183,229,0.7)',
                scaleColor: false,
                size: 120,
                lineCap: 'butt',
                rotate: 0,
                animate: 1000
              }" class="inline easyPieChart" style="width: 120px; height: 120px; line-height: 120px;">
            <canvas width="120" height="120"></canvas></div>
          </div>
          <div class="bottom wrapper bg-gd-dk text-white">
            <div class="text-u-c h3 m-b-sm text-primary-lter">Coffee</div>
            <div>Restaurant</div>
            <div>9:00 am - 12:00 pm</div>
          </div>
          <img src="img/c0.jpg" class="img-full">
        </div>
        <div class="hbox text-center b-b b-light text-sm">
          <a href="" class="col padder-v text-muted b-r b-light">
            <i class="icon-call-end block m-b-xs fa-2x"></i>
            <span>Call</span>
          </a>
          <a href="" class="col padder-v text-muted b-r b-light">
            <i class="icon-pointer block m-b-xs fa-2x"></i>
            <span>Location</span>
          </a>
          <a href="" class="col padder-v text-muted">
            <i class="icon-cursor block m-b-xs fa-2x"></i>
            <span>Direction</span>
          </a>
        </div>
        <div class="hbox text-center text-sm">
          <a href="" class="col padder-v text-muted b-r b-light">
            <i class="icon-plus block m-b-xs fa-2x"></i>
            <span>Add a tip</span>
          </a>
          <a href="" class="col padder-v text-muted b-r b-light">
            <i class="icon-like block m-b-xs fa-2x"></i>
            <span>Like it</span>
          </a>
          <a href="" class="col padder-v text-muted">
            <i class="icon-link block m-b-xs fa-2x"></i>
            <span>Website</span>
          </a>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="row">
        <div class="col-sm-6">
          <div class="panel b-a">
            <div class="panel-heading bg-info dk no-border wrapper-lg">
              <button class="btn btn-sm btn-icon btn-rounded btn-info pull-right m-r"><i class="fa fa-phone"></i></button>
              <button class="btn btn-sm btn-icon btn-rounded btn-info m-l"><i class="fa fa-heart"></i></button>
            </div>
            <div class="text-center m-b clearfix">
              <div class="thumb-lg avatar m-t-n-xxl">
                <img src="img/a5.jpg" alt="..." class="b b-3x b-white">
                <div class="h4 font-thin m-t-sm">Jacobs Simon</div>
              </div>
            </div>
            <div class="padder-v b-t b-light bg-light lter row text-center no-gutter">
              <div class="col-xs-4">
                <div>Facebook</div>
                <div class="inline m-t-sm">
                  <div ui-jq="easyPieChart" ui-options="{
                      percent: 30,
                      lineWidth: 3,
                      trackColor: '#e8eff0',
                      barColor: '#7266ba',
                      scaleColor: false,
                      color: '#fff',
                      size: 65,
                      lineCap: 'butt',
                      rotate: 45,
                      animate: 1000
                    }" class="easyPieChart" style="width: 65px; height: 65px; line-height: 65px;">
                    <div>
                      <span class="step">30</span>%
                    </div>
                  <canvas width="65" height="65"></canvas></div>
                </div>
              </div>
              <div class="col-xs-4">
                <div>Twitter</div>
                <div class="inline m-t-sm">
                  <div ui-jq="easyPieChart" ui-options="{
                      percent: 50,
                      lineWidth: 3,
                      trackColor: '#e8eff0',
                      barColor: '#23b7e5',
                      scaleColor: false,
                      color: '#fff',
                      size: 65,
                      lineCap: 'butt',
                      rotate: 90,
                      animate: 1000
                    }" class="easyPieChart" style="width: 65px; height: 65px; line-height: 65px;">
                    <div>
                      <span class="step">50</span>%
                    </div>
                  <canvas width="65" height="65"></canvas></div>
                </div>
              </div>
              <div class="col-xs-4">
                <div>Linkin</div>
                <div class="inline m-t-sm">
                  <div ui-jq="easyPieChart" ui-options="{
                      percent: 20,
                      lineWidth: 3,
                      trackColor: '#e8eff0',
                      barColor: '#fad733',
                      scaleColor: false,
                      color: '#fff',
                      size: 65,
                      lineCap: 'butt',
                      rotate: 180,
                      animate: 1000
                    }" class="easyPieChart" style="width: 65px; height: 65px; line-height: 65px;">
                    <div>
                      <span class="step">20</span>%
                    </div>
                  <canvas width="65" height="65"></canvas></div>
                </div>
              </div>
            </div>
            <div class="hbox text-center b-t b-light">
              <a href="" class="col padder-v text-muted b-r b-light">
                <div class="h4">5032</div>
                <span>Posts</span>
              </a>
              <a href="" class="col padder-v text-muted">
                <div class="h4">689</div>
                <span>Photos</span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="panel no-border">
            <div class="panel-heading bg-primary lt">
              <div class="m-sm">
                <span class="pull-right"><i class="fa fa-caret-up text-warning text-lg"></i></span>
                <span class="h4 text-white">Member Stats</span>
              </div>
              <div class="text-center m-t-md">
                  <div ui-jq="sparkline" ui-options="
                  [50.32,45.23,47.56,36.25,53.85,40.15,41.25,50.15,57.14,36.15,97.26,50.15,45.32,47.19,37.75,25.15,56.34,50.35,47.25,53.15],
                  {type:'line', height:80, width: '100%', lineWidth:4, lineColor:'#fff', spotColor:'#fff', fillColor:'', highlightLineColor:'#fff', spotRadius:6, minSpotColor:'#fad733', maxSpotColor:'#23b7e5'}
                  "><canvas style="display: inline-block; width: 297px; height: 80px; vertical-align: top;" width="297" height="80"></canvas></div>

                  <div ui-jq="sparkline" ui-options="[ 10,9,11,10,11,10,12,10,9,10,11,9,8 ],
                  {type:'bar', height:60, barWidth:4, barSpacing:6, barColor:'#7266ba'}
                  " class="sparkline inline m-t m-b-n-sm"><canvas width="124" height="60" style="display: inline-block; width: 124px; height: 60px; vertical-align: top;"></canvas></div>
              </div>
            </div>
            <div class="hbox bg-primary bg">
              <div class="col wrapper">
                <span>Customers</span>
                <div class="h1 text-info font-thin">12,790</div>
              </div>
              <div class="col wrapper bg-info">
                <span>VIP</span>
                <div class="h1 text-warning font-thin">2,560</div>
              </div>
            </div>
            <div class="panel-footer bg-light lter wrapper">
              <div class="row">
                <div class="col-xs-4">
                  <small class="text-muted block">Active</small>
                  <span class="text-md">1,500</span>
                </div>
                <div class="col-xs-4">
                  <small class="text-muted block">Inactive</small>
                  <span class="text-md">10,430</span>
                </div>
                <div class="col-xs-4">
                  <small class="text-muted block">Sleeping</small>
                  <span class="text-md">400</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


              <div class="row">
    <div class="col-lg-8">
      <div class="row">
        <div class="col-sm-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="clearfix">
                <a href="" class="pull-left thumb-md avatar b-3x m-r">
                  <img src="img/a2.jpg" alt="...">
                </a>
                <div class="clear">
                  <div class="h3 m-t-xs m-b-xs">
                    John.Smith
                    <i class="fa fa-circle text-success pull-right text-xs m-t-sm"></i>
                  </div>
                  <small class="text-muted">Art director</small>
                </div>
              </div>
            </div>
            <div class="list-group no-radius alt">
              <a class="list-group-item" href="">
                <span class="badge bg-success">25</span>
                <i class="fa fa-comment fa-fw text-muted"></i>
                Messages
              </a>
              <a class="list-group-item" href="">
                <span class="badge bg-info">16</span>
                <i class="fa fa-envelope fa-fw text-muted"></i>
                Inbox
              </a>
              <a class="list-group-item" href="">
                <span class="badge bg-light">5</span>
                <i class="fa fa-eye fa-fw text-muted"></i>
                Profile visits
              </a>
            </div>
          </div>
          <div class="panel panel-info">
            <div class="panel-body">
              <a href="" class="thumb pull-right m-l m-t-xs avatar">
                <img src="img/a4.jpg" alt="...">
                <i class="on md b-white bottom"></i>
              </a>
              <div class="clear">
                <a href="" class="text-info block m-b-xs">@Mike Mcalidek <i class="icon-twitter"></i></a>
                <a href="" class="btn btn-addon btn-sm btn-info m-t-xs"><i class="fa fa-eye"></i> Follow</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="panel panel-default">
            <a href="" class="text-muted m-t-sm m-l inline" ng-click="data=[40, 40, 20]"><i class="icon-pie-chart"></i></a>
            <div class="text-center wrapper m-b-sm">
              <div ui-refresh="data" ui-jq="sparkline" ui-options="
              [55, 30, 15],
              {
                type:'pie',
                height:126,
                sliceColors:['#7266ba','#23b7e5','#fad733']
              }
              " class="sparkline inline"><canvas width="126" height="126" style="display: inline-block; width: 126px; height: 126px; vertical-align: top;"></canvas></div>
            </div>
            <ul class="list-group no-radius">
              <li class="list-group-item">
                <span class="pull-right">45,000</span>
                <span class="label bg-primary">1</span>
                .inc company
              </li>
              <li class="list-group-item">
                <span class="pull-right">23,200</span>
                <span class="label bg-info">2</span>
                Gamecorp
              </li>
              <li class="list-group-item">
                <span class="pull-right">21,000</span>
                <span class="label bg-warning">3</span>
                Starup
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="clearfix text-center m-t">
            <div class="inline">
              <div ui-jq="easyPieChart" ui-options="{
                    percent: 75,
                    lineWidth: 5,
                    trackColor: '#e8eff0',
                    barColor: '#23b7e5',
                    scaleColor: false,
                    color: '#3a3f51',
                    size: 134,
                    lineCap: 'butt',
                    rotate: -90,
                    animate: 1000
                  }" class="easyPieChart" style="width: 134px; height: 134px; line-height: 134px;">
                <div class="thumb-xl">
                  <img src="img/a8.jpg" class="img-circle" alt="...">
                </div>
              <canvas width="134" height="134"></canvas></div>
              <div class="h4 m-t m-b-xs">John.Smith</div>
              <small class="text-muted m-b">Art director</small>
            </div>
          </div>
        </div>
        <footer class="panel-footer bg-info text-center no-padder">
          <div class="row no-gutter">
            <div class="col-xs-4">
              <div class="wrapper">
                <span class="m-b-xs h3 block text-white">245</span>
                <small class="text-muted">Followers</small>
              </div>
            </div>
            <div class="col-xs-4 dk">
              <div class="wrapper">
                <span class="m-b-xs h3 block text-white">55</span>
                <small class="text-muted">Following</small>
              </div>
            </div>
            <div class="col-xs-4">
              <div class="wrapper">
                <span class="m-b-xs h3 block text-white">2,035</span>
                <small class="text-muted">Tweets</small>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
  </div>


              <div class="row">
    <div class="col-lg-6">
      <!-- chat -->
      <div class="panel panel-default">
        <div class="panel-heading">Chat</div>
        <div class="panel-body">
          <div class="m-b">
            <a href="" class="pull-left thumb-sm avatar"><img src="img/a2.jpg" alt="..."></a>
            <div class="m-l-xxl">
              <div class="pos-rlt wrapper b b-light r r-2x">
                <span class="arrow left pull-up"></span>
                <p class="m-b-none">Hi John, What's up...</p>
              </div>
              <small class="text-muted"><i class="fa fa-ok text-success"></i> 2 minutes ago</small>
            </div>
          </div>
          <div class="m-b">
            <a href="" class="pull-right thumb-sm avatar"><img src="img/a3.jpg" class="img-circle" alt="..."></a>
            <div class="m-r-xxl">
              <div class="pos-rlt wrapper bg-primary r r-2x">
                <span class="arrow right pull-up arrow-primary"></span>
                <p class="m-b-none">Lorem ipsum dolor sit amet, conse <br>adipiscing eli...<br>:)</p>
              </div>
              <small class="text-muted">1 minutes ago</small>
            </div>
          </div>
        </div>
        <footer class="panel-footer">
          <!-- chat form -->
          <div>
            <a class="pull-left thumb-xs avatar"><img src="img/a3.jpg" class="img-circle" alt="..."></a>
            <form class="m-b-none m-l-xl">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Say something">
                <span class="input-group-btn">
                  <button class="btn btn-default" type="button">SEND</button>
                </span>
              </div>
            </form>
          </div>
        </footer>
      </div>
      <!-- /chat -->
      <div class="panel panel-default">
        <div class="panel-heading">
          <span class="label bg-dark">15</span> News
        </div>
        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 250px;"><div class="panel-body" ui-jq="slimScroll" ui-options="{height:'250px', size:'8px'}" style="overflow: hidden; width: auto; height: 250px;">
          <div class="media">
            <span class="pull-left thumb-sm"><img src="img/a2.jpg" alt="..."></span>
            <div class="media-body">
              <div class="pull-right text-center text-muted">
                <strong class="h4">12:18</strong><br>
                <small class="label bg-light">pm</small>
              </div>
              <a href="" class="h4">Bootstrap 3 released</a>
              <small class="block"><a href="" class="">John Smith</a> <span class="label label-success">Circle</span></small>
              <small class="block m-t-sm">Sleek, intuitive, and powerful mobile-first front-end framework for faster and easier web development.</small>
            </div>
          </div>
          <div class="line pull-in"></div>
          <div class="media">
            <span class="pull-left thumb-sm"><i class="fa fa-file-o fa-3x text-muted"></i></span>
            <div class="media-body">
              <div class="pull-right text-center text-muted">
                <strong class="h4">17</strong><br>
                <small class="label bg-light">feb</small>
              </div>
              <a href="" class="h4">Bootstrap documents</a>
              <small class="block"><a href="">John Smith</a> <span class="label label-info">Friends</span></small>
              <small class="block m-t-sm">There are a few easy ways to quickly get started with Bootstrap, each one appealing to a different skill level and use case. Read through to see what suits your particular needs.</small>
            </div>
          </div>
          <div class="line pull-in"></div>
          <div class="media">
            <div class="media-body">
              <div class="pull-right text-center text-muted">
                <strong class="h4">09</strong><br>
                <small class="label bg-light">jan</small>
              </div>
              <a href="" class="h4 text-success">Mobile first html/css framework</a>
              <small class="block m-t-sm">Bootstrap, Ratchet</small>
            </div>
          </div>
        </div><div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 8px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; height: 194.704px;"></div><div class="slimScrollRail" style="width: 8px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
      </div>
    </div>
    <div class="col-lg-6">
      <!-- .comment-list -->
      <div class="m-b b-l m-l-md streamline">
        <div>
          <a class="pull-left thumb-sm avatar m-l-n-md">
            <img src="img/a1.jpg" class="img-circle" alt="...">
          </a>
          <div class="m-l-lg panel b-a">
            <div class="panel-heading pos-rlt b-b b-light">
              <span class="arrow left"></span>
              <a href="">John smith</a>
              <label class="label bg-info m-l-xs">Editor</label>
              <span class="text-muted m-l-sm pull-right">
                <i class="fa fa-clock-o"></i>
                Just now
              </span>
            </div>
            <div class="panel-body">
              <div>Lorem ipsum dolor sit amet, consecteter adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet.</div>
              <div class="m-t-sm">
                <a href="" ui-toggle-class="" class="btn btn-default btn-xs active">
                  <i class="fa fa-star-o text-muted text"></i>
                  <i class="fa fa-star text-danger text-active"></i>
                  Like
                </a>
                <a href="" class="btn btn-default btn-xs">
                  <i class="fa fa-mail-reply text-muted"></i> Reply
                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- .comment-reply -->
        <div class="m-l-lg">
          <a class="pull-left thumb-sm avatar">
            <img src="img/a8.jpg" alt="...">
          </a>
          <div class="m-l-xxl panel b-a">
            <div class="panel-heading pos-rlt">
              <span class="arrow left pull-up"></span>
              <span class="text-muted m-l-sm pull-right">
                <i class="fa fa-clock-o"></i>
                10m ago
              </span>
              <a href="">Mika Sam</a>
              Report this comment is helpful
            </div>
          </div>
        </div>
        <!-- / .comment-reply -->
        <div>
          <a class="pull-left thumb-sm avatar m-l-n-md">
            <img src="img/a9.jpg" alt="...">
          </a>
          <div class="m-l-lg panel b-a">
            <div class="panel-heading pos-rlt b-b b-light">
              <span class="arrow left"></span>
              <a href="">By me</a>
              <label class="label bg-success m-l-xs">User</label>
              <span class="text-muted m-l-sm pull-right">
                <i class="fa fa-clock-o"></i>
                1h ago
              </span>
            </div>
            <div class="panel-body">
              <div>This comment was posted by you.</div>
            </div>
          </div>
        </div>
        <div>
          <a class="pull-left thumb-sm avatar m-l-n-md"><img src="img/a5.jpg" alt="..."></a>
          <div class="m-l-lg panel b-a">
            <div class="panel-heading pos-rlt b-b b-light">
              <span class="arrow left"></span>
              <a href="">Peter</a>
              <label class="label bg-primary m-l-xs">Vip</label>
              <span class="text-muted m-l-sm pull-right">
                <i class="fa fa-clock-o"></i>
                2hs ago
              </span>
            </div>
            <div class="panel-body">
              <blockquote>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                <small>Someone famous in <cite title="Source Title">Source Title</cite></small>
              </blockquote>
              <div>Lorem ipsum dolor sit amet, consecteter adipiscing elit...</div>
              <div class="m-t-sm">
                <a href="" data-toggle="class" class="btn btn-default btn-xs">
                  <i class="fa fa-star-o text-muted text"></i>
                  <i class="fa fa-star text-danger text-active"></i>
                  Like
                </a>
                <a href="" class="btn btn-default btn-xs"><i class="fa fa-mail-reply text-muted"></i> Reply</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="clearfix m-b-lg">
        <a class="pull-left thumb-sm avatar"><img src="img/a6.jpg" alt="..."></a>
        <div class="m-l-xxl">
          <form class="m-b-none">
            <div class="input-group">
              <input type="text" class="form-control input-lg" placeholder="Input your comment here">
              <span class="input-group-btn">
                <button class="btn btn-info btn-lg" type="button">POST</button>
              </span>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


              <div class="row">
    <div class="col-sm-6">
      <div class="list-group">
        <a href="" class="list-group-item">
          <span class="badge badge-empty">201</span>
          <i class="fa fa-envelope fa-fw m-r-xs"></i> Inbox
        </a>
        <a href="" class="list-group-item">
          <span class="badge bg-info">5021</span>
          <i class="fa fa-eye fa-fw m-r-xs"></i> Profile visits
        </a>
        <a href="" class="list-group-item">
          <i class="fa fa-chevron-right text-muted"></i>
          <span class="badge bg-success">14</span>
          <i class="fa fa-phone fa-fw m-r-xs"></i> Call
        </a>
        <a href="" class="list-group-item">
          <span class="badge bg-dark">20</span>
          <i class="fa fa-comments-o fa-fw m-r-xs"></i> Messages
        </a>
        <a href="" class="list-group-item">
          <span class="badge bg-warning">14</span>
          <i class="fa fa-bookmark fa-fw m-r-xs"></i> Bookmarks
        </a>
        <a href="" class="list-group-item">
          <span class="badge bg-info">30</span>
          <i class="fa fa-bell fa-fw m-r-xs"></i> Notifications
        </a>
        <a href="" class="list-group-item">
          <span class="badge bg-danger">10</span>
          <i class="fa fa-clock-o fa-fw m-r-xs"></i> Watch
        </a>
      </div>
      <div class="m-b m-t-lg">
        <a href="" class="avatar thumb-xs m-r-xs">
          <img src="img/a7.jpg" alt="...">
          <i class="on b-white"></i>
        </a>
        <a href="" class="avatar thumb-xs m-r-xs">
          <img src="img/a8.jpg" alt="...">
          <i class="busy b-white"></i>
        </a>
        <a href="" class="avatar thumb-xs m-r-xs">
          <img src="img/a9.jpg" alt="...">
          <i class="away b-white"></i>
        </a>
        <a href="" class="avatar thumb-xs m-r-xs">
          <img src="img/a10.jpg" alt="...">
          <i class="on b-white"></i>
        </a>
        <a href="" class="btn btn-success btn-rounded font-bold"> +152 </a>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="panel b-a">
        <div class="panel-heading b-b b-light">
          <span class="badge bg-warning pull-right">10</span>
          <a href="" class="font-bold">Messages</a>
        </div>
        <ul class="list-group list-group-lg no-bg auto">
          <li class="list-group-item clearfix">
            <span class="pull-left thumb-sm avatar m-r">
              <img src="img/a4.jpg" alt="...">
              <i class="on b-white bottom"></i>
            </span>
            <span class="clear">
              <span>Chris Fox</span>
              <small class="text-muted clear text-ellipsis">What's up, buddy</small>
            </span>
          </li>
          <li class="list-group-item clearfix">
            <span class="pull-left thumb-sm avatar m-r">
              <img src="img/a5.jpg" alt="...">
              <i class="on b-white bottom"></i>
            </span>
            <span class="clear">
              <span>Amanda Conlan</span>
              <small class="text-muted clear text-ellipsis">Come online and we need talk about the plans that we have discussed</small>
            </span>
          </li>
          <li class="list-group-item clearfix">
            <span class="pull-left thumb-sm avatar m-r">
              <img src="img/a6.jpg" alt="...">
              <i class="busy b-white bottom"></i>
            </span>
            <span class="clear">
              <span>Dan Doorack</span>
              <small class="text-muted clear text-ellipsis">Hey, Some good news</small>
            </span>
          </li>
          <li class="list-group-item clearfix">
            <span class="pull-left thumb-sm avatar m-r">
              <img src="img/a7.jpg" alt="...">
              <i class="away b-white bottom"></i>
            </span>
            <span class="clear">
              <span>Lauren Taylor</span>
              <small class="text-muted clear text-ellipsis">Nice to talk with you.</small>
            </span>
          </li>
        </ul>
        <div class="clearfix panel-footer">
          <div class="input-group">
            <input type="text" class="form-control input-sm btn-rounded" placeholder="Search">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-default btn-sm btn-rounded"><i class="fa fa-search"></i></button>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>



            </div>
          </div>
        </div>


      </div>



    </div>




@stop
