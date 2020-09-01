<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SiPeka &middot; Terms of Service</title>
    <link href="/assets/img/sipekawarna-min.png" rel="icon">

    <link href="{{url('/assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="/assets/css/sb-admin-2.css" rel="stylesheet">

    <link href="/assets/vendor-utama/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/vendor-utama/icofont/icofont.min.css" rel="stylesheet">
    <link href="/assets/vendor-utama/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/assets/vendor-utama/venobox/venobox.css" rel="stylesheet">
    <link href="/assets/vendor-utama/line-awesome/css/line-awesome.min.css" rel="stylesheet">
    <link href="/assets/vendor-utama/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="/assets/vendor-utama/aos/aos.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="/assets/css/style.css" rel="stylesheet">

    <style>
        #header {
            background: rgb(40, 75, 99);
        }
        a {
            color: rgb(40, 75, 99);
        }
    </style>

</head>
<body id="page-top">
  <div id="wrapper">

    <header id="header" class="fixed-top header-scrolled">
        <div class="container d-flex">

          <div class="logo mr-auto">
            <!-- <img src="sipeka.png" width="509px" height="339px" alt=""> -->
            <!-- Uncomment below if you prefer to use an image logo -->
            <a href="{{url('/'.'#hero')}}"><img src="/assets/img/sipeka.png" width="82px" height="55px" alt="" class="img-fluid"></a>
          </div>

          <nav class="nav-menu d-none d-lg-block">
            <ul>
              <li><a href="{{url('/'.'#hero')}}">Home</a></li>

              <li><a href="{{url('/'.'#about')}}">Tentang</a></li>
              <li><a href="{{url('/'.'#cta')}}">Fitur</a></li>
              @if (Auth::check())
              @auth
              <li><a href={{url(session('akses'))}}>{{Auth::user()->fullname}}</a></li>
              @endauth
              @endif
            </ul>
          </nav><!-- .nav-menu -->

        </div>
    </header>

    <div id="content-wrapper" class="d-flex flex-column" style="margin-top: 50px">
      <div id="content">
        <div class="container-fluid">
          <div class="card" style="margin:50px">
            <div class="card-body">

                <div class='card-text'>
                    <h1>Privacy Policy for SiPeka</h1>

                    <p>At SiPeka, accessible from https://sipeka.bagjagroup.site/, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by SiPeka and how we use it.</p>

                    <p>If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us.</p>

                    <p>This Privacy Policy applies only to our online activities and is valid for visitors to our website with regards to the information that they shared and/or collect in SiPeka. This policy is not applicable to any information collected offline or via channels other than this website. Our Privacy Policy was created with the help of the <a href="https://www.privacypolicygenerator.info">Privacy Policy Generator</a> and the <a href="https://www.generateprivacypolicy.com">Generate Privacy Policy Generator</a>.</p>

                    <h2>Consent</h2>

                    <p>By using our website, you hereby consent to our Privacy Policy and agree to its terms.</p>

                    <h2>Information we collect</h2>

                    <p>The personal information that you are asked to provide, and the reasons why you are asked to provide it, will be made clear to you at the point we ask you to provide your personal information.</p>
                    <p>If you contact us directly, we may receive additional information about you such as your name, email address, phone number, the contents of the message and/or attachments you may send us, and any other information you may choose to provide.</p>
                    <p>When you register for an Account, we may ask for your contact information, including items such as name, company name, address, email address, and telephone number. Part of them are provided by users' Gmail Account that linked with SiPeka. We also will use https://www.googleapis.com/auth/calendar to create [SiPeka] calendar for managing users events while using our platform, such as creating conference using Google Meet, and send email notification regarding the event, so that users can manage their schedules through SiPeka and sync the changes with their Google calendar.</p>

                    <h2>How we use your information</h2>

                    <p>We use the information we collect in various ways, including to:</p>

                    <ul>
                    <li>Provide, operate, and maintain our webste</li>
                    <li>Improve, personalize, and expand our webste</li>
                    <li>Understand and analyze how you use our webste</li>
                    <li>Develop new products, services, features, and functionality</li>
                    <li>Communicate with you, either directly or through one of our partners, including for customer service, to provide you with updates and other information relating to the webste, and for marketing and promotional purposes</li>
                    <li>Send you emails</li>
                    <li>Find and prevent fraud</li>
                    </ul>

                    <h2>Log Files</h2>

                    <p>SiPeka follows a standard procedure of using log files. These files log visitors when they visit websites. All hosting companies do this and a part of hosting services' analytics. The information collected by log files include internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, referring/exit pages, and possibly the number of clicks. These are not linked to any information that is personally identifiable. The purpose of the information is for analyzing trends, administering the site, tracking users' movement on the website, and gathering demographic information.</p>

                    <h2>Cookies and Web Beacons</h2>

                    <p>Like any other website, SiPeka uses 'cookies'. These cookies are used to store information including visitors' preferences, and the pages on the website that the visitor accessed or visited. The information is used to optimize the users' experience by customizing our web page content based on visitors' browser type and/or other information.</p>

                    <p>For more general information on cookies, please read <a href="https://www.cookieconsent.com/what-are-cookies/">"What Are Cookies"</a>.</p>



                    <h2>Advertising Partners Privacy Policies</h2>

                    <P>You may consult this list to find the Privacy Policy for each of the advertising partners of SiPeka.</p>

                    <p>Third-party ad servers or ad networks uses technologies like cookies, JavaScript, or Web Beacons that are used in their respective advertisements and links that appear on SiPeka, which are sent directly to users' browser. They automatically receive your IP address when this occurs. These technologies are used to measure the effectiveness of their advertising campaigns and/or to personalize the advertising content that you see on websites that you visit.</p>

                    <p>Note that SiPeka has no access to or control over these cookies that are used by third-party advertisers.</p>

                    <h2>Third Party Privacy Policies</h2>

                    <p>SiPeka's Privacy Policy does not apply to other advertisers or websites. Thus, we are advising you to consult the respective Privacy Policies of these third-party ad servers for more detailed information. It may include their practices and instructions about how to opt-out of certain options. </p>

                    <p>You can choose to disable cookies through your individual browser options. To know more detailed information about cookie management with specific web browsers, it can be found at the browsers' respective websites.</p>

                    <h2>CCPA Privacy Rights (Do Not Sell My Personal Information)</h2>

                    <p>Under the CCPA, among other rights, California consumers have the right to:</p>
                    <p>Request that a business that collects a consumer's personal data disclose the categories and specific pieces of personal data that a business has collected about consumers.</p>
                    <p>Request that a business delete any personal data about the consumer that a business has collected.</p>
                    <p>Request that a business that sells a consumer's personal data, not sell the consumer's personal data.</p>
                    <p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p>

                    <h2>GDPR Data Protection Rights</h2>

                    <p>We would like to make sure you are fully aware of all of your data protection rights. Every user is entitled to the following:</p>
                    <p>The right to access – You have the right to request copies of your personal data. We may charge you a small fee for this service.</p>
                    <p>The right to rectification – You have the right to request that we correct any information you believe is inaccurate. You also have the right to request that we complete the information you believe is incomplete.</p>
                    <p>The right to erasure – You have the right to request that we erase your personal data, under certain conditions.</p>
                    <p>The right to restrict processing – You have the right to request that we restrict the processing of your personal data, under certain conditions.</p>
                    <p>The right to object to processing – You have the right to object to our processing of your personal data, under certain conditions.</p>
                    <p>The right to data portability – You have the right to request that we transfer the data that we have collected to another organization, or directly to you, under certain conditions.</p>
                    <p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p>

                    <h2>Children's Information</h2>

                    <p>Another part of our priority is adding protection for children while using the internet. We encourage parents and guardians to observe, participate in, and/or monitor and guide their online activity.</p>

                    <p>SiPeka does not knowingly collect any Personal Identifiable Information from children under the age of 13. If you think that your child provided this kind of information on our website, we strongly encourage you to contact us immediately and we will do our best efforts to promptly remove such information from our records.</p>
                </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

<!-- Vendor JS Files -->
<script src="/assets/vendor-utama/jquery/jquery.min.js"></script>
<script src="/assets/vendor-utama/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/vendor-utama/jquery.easing/jquery.easing.min.js"></script>
<!-- <script src="assets/vendor/php-email-form/validate.js"></script> -->
<script src="/assets/vendor-utama/waypoints/jquery.waypoints.min.js"></script>
<script src="/assets/vendor-utama/counterup/counterup.min.js"></script>
<!-- <script src="assets/vendor/venobox/venobox.min.js"></script> -->
<script src="/assets/vendor-utama/owl.carousel/owl.carousel.min.js"></script>
<script src="/assets/vendor-utama/isotope-layout/isotope.pkgd.min.js"></script>
<script src="/assets/vendor-utama/aos/aos.js"></script>

<!-- Template Main JS File -->
</html>
