<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Log In | OT Advanture</title>

   <!-- Favicon -->
   <!-- <link rel="shortcut icon" href="https://www.trafoindonesia.com/favicon.ico" type="image/x-icon"> -->
   <link rel="stylesheet" href="/templateview/assets/css/backend-plugin.min.css">
   <link rel="stylesheet" href="/templateview/assets/css/backend.css?v=1.0.0">
   <link rel="stylesheet" href="/templateview/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
   <link rel="stylesheet" href="/templateview/assets/vendor/remixicon/fonts/remixicon.css">

   <link rel="stylesheet" href="/templateview/assets/vendor/tui-calendar/tui-calendar/dist/tui-calendar.css">
   <link rel="stylesheet" href="/templateview/assets/vendor/tui-calendar/tui-date-picker/dist/tui-date-picker.css">
   <link rel="stylesheet" href="/templateview/assets/vendor/tui-calendar/tui-time-picker/dist/tui-time-picker.css">
</head>

<body class=" ">
   <!-- loader Start -->
   <div id="loading">
      <div id="loading-center">
      </div>
   </div>
   <!-- loader END -->
   @if(session('success'))
   <div class="alert alert-success">
      {{ session('success') }}
   </div>
   @endif

   @if($errors->any())
   <div class="alert alert-danger">
      <ul>
         @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
         @endforeach
      </ul>
   </div>
   @endif
   
   <div class="wrapper">
      <section class="login-content">
         <div class="container">
            <div class="row align-items-center justify-content-center height-self-center">
               <div class="col-lg-8">
                  <div class="card auth-card">
                     <div class="card-body p-0">
                        <div class="d-flex align-items-center auth-content">
                           <div class="col-lg-6 bg-primary content-left">
                              <div class="p-3">
                                 <h2 class="mb-2 text-white">Sign In</h2>
                                 <p>Login to stay connected.</p>
                                 <form action="{{ route ('login')}}" method="POST">
                                    @csrf
                                    <div class="row">
                                       <div class="col-lg-12">
                                          <div class="floating-label form-group">
                                             <input class="floating-input form-control" type="email" id="email" name="email" placeholder=" ">
                                             <label>Email</label>
                                          </div>
                                       </div>
                                       <div class="col-lg-12">
                                          <div class="floating-label form-group">
                                             <input class="floating-input form-control" type="password" id="password" name="password" placeholder=" ">
                                             <label>Password</label>
                                          </div>
                                       </div>
                                       <div class="col-lg-6">
                                          <div class="custom-control custom-checkbox mb-3">
                                             <input type="checkbox" class="custom-control-input" id="customCheck1" name="remember">
                                             <label class="custom-control-label control-label-1 text-white" for="customCheck1">Remember Me</label>
                                          </div>
                                       </div>
                                       <!-- <div class="col-lg-6">
                                          <a href="auth-recoverpw.html" class="text-white float-right">Forgot Password?</a>
                                       </div> -->
                                    </div>
                                    <button type="submit" class="btn btn-white">Sign In</button>
                                    <p class="mt-3">
                                       Create an Account <a href="/register" class="text-white text-underline">Sign Up</a>
                                    </p>
                                 </form>
                              </div>
                           </div>
                           <div class="col-lg-6 content-right">
                              <img src="/templateview/assets/images/login/01.png" class="img-fluid image-right" alt="">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </div>
   <!-- Backend Bundle JavaScript -->
   <script src="/templateview/assets/js/backend-bundle.min.js"></script>

   <!-- Table Treeview JavaScript -->
   <script src="/templateview/assets/js/table-treeview.js"></script>

   <!-- Chart Custom JavaScript -->
   <script src="/templateview/assets/js/customizer.js"></script>

   <!-- Chart Custom JavaScript -->
   <script async src="/templateview/assets/js/chart-custom.js"></script>
   <!-- Chart Custom JavaScript -->
   <script async src="/templateview/assets/js/slider.js"></script>

   <!-- app JavaScript -->
   <script src="/templateview/assets/js/app.js"></script>

   <script src="/templateview/assets/vendor/moment.min.js"></script>
</body>

</html>