 <!-- footer_start  -->
 <footer class="footer">
     <div class="footer_top">
         <div class="container">
             <div class="row">
                 <div class="col-xl-5 col-md-6 col-lg-5 ">
                     <div class="footer_widget">
                         <div class="footer_logo">
                             <a href="#">
                                 <img src="{{asset('img/logo.png')}} alt="">
                             </a>
                         </div>
                         <p class="address_text">Lorem ipsum dolor sit amet, consectetur <br> adipiscing elit, sed do
                             eiusmod tempor <br> incididunt ut labore et dolore magna aliqua. <br> Quis ipsum
                             suspendisse.
                         </p>
                         <div class="socail_links">
                             <ul>
                                 <li>
                                     <a href="#">
                                         <i class="ti-facebook"></i>
                                     </a>
                                 </li>
                                 <li>
                                     <a href="#">
                                         <i class="ti-twitter-alt"></i>
                                     </a>
                                 </li>
                                 <li>
                                     <a href="#">
                                         <i class="fa fa-dribbble"></i>
                                     </a>
                                 </li>
                                 <li>
                                     <a href="#">
                                         <i class="fa fa-instagram"></i>
                                     </a>
                                 </li>
                             </ul>
                         </div>

                     </div>
                 </div>
                 <div class="col-xl-3 col-md-6 col-lg-3">
                     <div class="footer_widget">
                         <h3 class="footer_title">
                             Information
                         </h3>
                         <ul class="links">
                             <li><a href="#">About</a></li>
                             <li><a href="#">Services</a></li>
                             <li><a href="#">Testimonial</a></li>
                         </ul>
                     </div>
                 </div>
                 <div class="col-xl-2  col-md-6 col-lg-2">
                     <div class="footer_widget">
                         <h3 class="footer_title">
                             Services
                         </h3>
                         <ul class="links">
                             <li><a href="#">Smooth Shave </a></li>
                             <li><a href="#">Beard Triming</a></li>
                             <li><a href="#"> Haircut Styles</a></li>
                         </ul>
                     </div>
                 </div>
                 <div class="col-xl-2  col-md-6 col-lg-2">
                     <div class="footer_widget">
                         <h3 class="footer_title">
                             Follow Us
                         </h3>
                         <ul class="links">
                             <li><a href="#">FaceBook</a></li>
                             <li><a href="#">Instagram</a></li>
                             <li><a href="#"> LinkedIn</a></li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="copy-right_text">
         <div class="container">
             <div class="row">
                 <div class="col-xl-12">
                     <p class="copy_right text-center">
                     <p>&copy; {{ date('Y') }} . All Rights Reserved.</p>
                     </p>
                 </div>
             </div>
         </div>
     </div>
 </footer>
 <script src="{{ asset('js/vendor/modernizr-3.5.0.min.js') }}"></script>
 <script src="{{ asset('js/vendor/jquery-1.12.4.min.js') }}"></script>
 <script src="{{ asset('js/popper.min.js') }}"></script>
 <script src="{{ asset('js/bootstrap.min.js') }}"></script>
 <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
 <script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>
 <script src="{{ asset('js/ajax-form.js') }}"></script>
 <script src="{{ asset('js/waypoints.min.js') }}"></script>
 <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
 <script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
 <script src="{{ asset('js/scrollIt.js') }}"></script>
 <script src="{{ asset('js/jquery.scrollUp.min.js') }}"></script>
 <script src="{{ asset('js/wow.min.js') }}"></script>
 <script src="{{ asset('js/nice-select.min.js') }}"></script>
 <script src="{{ asset('js/jquery.slicknav.min.js') }}"></script>
 <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
 <script src="{{ asset('js/plugins.js') }}"></script>
 <script src="{{ asset('js/gijgo.min.js') }}"></script>

 <!-- Contact js -->
 <script src="{{ asset('js/contact.js') }}"></script>
 <script src="{{ asset('js/jquery.ajaxchimp.min.js') }}"></script>
 <script src="{{ asset('js/jquery.form.js') }}"></script>
 <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
 <script src="{{ asset('js/mail-script.js') }}"></script>

 <script src="{{ asset('js/main.js') }}"></script>

 <script>
     $('#datepicker').datepicker({
         iconsLibrary: 'fontawesome',
         disableDaysOfWeek: [0, 0],
     });

     $('#datepicker2').datepicker({
         iconsLibrary: 'fontawesome',
         icons: {
             rightIcon: '<span class="fa fa-caret-down"></span>'
         }
     });

     var timepicker = $('#timepicker').timepicker({
         format: 'HH.MM'
     });
 </script>
 <!-- footer_end  -->
