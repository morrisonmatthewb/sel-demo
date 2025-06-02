@use('App\Helpers\FormApi')
@use('App\Models\Module')
@use('App\Http\Controllers\StudentController')
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- The above 3 meta tags *must* come first in the head -->
    <!-- any other head content must come *after* these tags -->
   <title>CMSC435 Peer Mentoring</title>
   <link rel="icon" href="https://vale.cs.umd.edu/mentors/favicon.ico" type="image/x-icon">
   <link rel="stylesheet" href="https://vale.cs.umd.edu/mentors/css/bootstrap.min.css">
   <link rel="icon" href="favicon.ico" type="image/x-icon">
   <link rel="stylesheet" href="https://vale.cs.umd.edu/mentors/css/local.css">
  </head>
  <body>
  <div class="container">
    <nav class="navbar navbar-default">
      <ul class="nav navbar-nav">
      <li>
            <a href="{{ url('/') }}" class="navbar-btn">HOME</a>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            TICKETS <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="#" onclick="return false;">ADD</a></li>
            <li><a href="#" onclick="return false;">LIST</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            ADVICE <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="#" onclick="return false;">ADD</a></li>
            <li><a href="#" onclick="return false;">LIST</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            INQUIRIES <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="#" onclick="return false;">POLLS</a></li>
            <li><a href="#" onclick="return false;">SCHEDULER</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            MODULES <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('modules') }}"><b>Overview</b></a></li>
            @if(FormApi::logged_in_admin())
            <li><a href="{{ route('admin.console') }}"><b>Teacher Console</b></a></li>
            @endif
            @foreach (Module::where('user', FormApi::current_user())->orWhereNull('user')
                            ->select('module')->distinct()->get() as $module)
                <li><a href="{{ route('modules.lab', ['lab'=>$module->module]) }}">
                    {{ StudentController::$labControllers[$module->module]::$display}}
                </li></a>
            @endforeach
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            @if(FormApi::current_user())
              {{ FormApi::current_user() }} <span class="caret"></span>
            @else
              LOGIN <span class="caret"></span>
            @endif
          </a>
          <ul class="dropdown-menu">
            @if(FormApi::current_user())
              <li><a href="{{ url('/logout') }}">Logout</a></li>
            @else
              <li><a href="{{ url('/login') }}">Login with UMD CAS</a></li>
            @endif
          </ul>
        </li>
      </ul>
    </nav>
    <P> </P>
    @if(FormApi::current_user())
      <P>Logged in as: {{ FormApi::current_user() }}</P>
    @else
      <P>Not logged in. </P>
    @endif
    @yield('content')
  </div>  <!-- container -->
  <div class="footer">
    <A HREF="http://www.umd.edu/web-accessibility">Web Accessibility</A>
  </div>
  <script src="https://vale.cs.umd.edu/mentors/js/jquery.min.js"></script>
  <script src="https://vale.cs.umd.edu/mentors/js/bootstrap.min.js"></script>

  @yield('optionscripts')
  </body>
</html>
