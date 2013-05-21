<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<?php $row = $vars->row; 

?>
<?php $div_id = "mediamanager_id_" . $row->media_id; ?>
<?php $count = $vars->db_files_count;
$params = $vars->row->params;

?>

        <!--
        #################################
            - THEMEPUNCH BANNER -
        #################################
        -->

            <div class="fullwidthbanner-container">
                    <div class="fullwidthabnner">
                        <ul>
                            <?php foreach ($vars->db_files as $key => $item) : ?>
                            <li data-transition="3dcurtain-vertical" data-slotamount="10" data-masterspeed="300" data-thumb="<?php echo $item->file; ?>">
                                        <!-- THE MAIN IMAGE IN THE FIRST SLIDE -->
                                        <img src="<?php echo $item->file; ?>" >
                                    </li>


                            
                            <?php endforeach; ?>

                            <?php /*
                            <!-- THE FIRST SLIDE -->
                            <li data-transition="3dcurtain-vertical" data-slotamount="10" data-masterspeed="300" data-thumb="images/thumbs/thumb1.jpg">
                                        <!-- THE MAIN IMAGE IN THE FIRST SLIDE -->
                                        <img src="images/slides/wide1.jpg" >

                                        <!-- THE CAPTIONS IN THIS SLDIE -->
                                        <div class="caption large_text sfb"
                                             data-x="176"
                                             data-y="15"
                                             data-speed="300"
                                             data-start="800"
                                             data-easing="easeOutExpo"  >OVER <span style="color: #ffcc00;">1000</span> SATISFIED CUSTOMERS</div>

                                        <div class="caption randomrotate"
                                             data-x="189"
                                             data-y="76"
                                             data-speed="600"
                                             data-start="1100"
                                             data-easing="easeOutExpo"  ><img src="images/slides/p1.jpg" alt="Image 2"></div>

                                        <div class="caption randomrotate"
                                             data-x="0"
                                             data-y="92"
                                             data-speed="600"
                                             data-start="1200"
                                             data-easing="easeOutExpo"  ><img src="images/slides/p2.jpg" alt="Image 3"></div>

                                        <div class="caption randomrotate"
                                             data-x="200"
                                             data-y="209"
                                             data-speed="600"
                                             data-start="1300"
                                             data-easing="easeOutExpo"  ><img src="images/slides/p3.jpg" alt="Image 4"></div>

                                        <div class="caption randomrotate"
                                             data-x="97"
                                             data-y="117"
                                             data-speed="300"
                                             data-start="1400"
                                             data-easing="easeOutExpo"  ><img src="images/slides/p4.jpg" alt="Image 5"></div>

                                        <div class="caption randomrotate"
                                             data-x="14"
                                             data-y="222"
                                             data-speed="600"
                                             data-start="1500"
                                             data-easing="easeOutExpo"  ><img src="images/slides/p5.jpg" alt="Image 6"></div>

                                        <div class="caption randomrotate"
                                             data-x="638"
                                             data-y="201"
                                             data-speed="300"
                                             data-start="1600"
                                             data-easing="easeOutExpo"  ><img src="images/slides/p6.jpg" alt="Image 7"></div>

                                        <div class="caption randomrotate"
                                             data-x="717"
                                             data-y="294"
                                             data-speed="300"
                                             data-start="1700"
                                             data-easing="easeOutExpo"  ><img src="images/slides/p7.jpg" alt="Image 8"></div>

                                        <div class="caption randomrotate"
                                             data-x="682"
                                             data-y="79"
                                             data-speed="300"
                                             data-start="1800"
                                             data-easing="easeOutExpo"  ><img src="images/slides/p8.jpg" alt="Image 9"></div>

                                        <div class="caption randomrotate"
                                             data-x="807"
                                             data-y="71"
                                             data-speed="300"
                                             data-start="1900"
                                             data-easing="easeOutExpo"  ><img src="images/slides/p9.jpg" alt="Image 10"></div>

                                        <div class="caption randomrotate"
                                             data-x="818"
                                             data-y="271"
                                             data-speed="300"
                                             data-start="2000"
                                             data-easing="easeOutExpo"  ><img src="images/slides/p10.jpg" alt="Image 11"></div>

                                        <div class="caption randomrotate"
                                             data-x="95"
                                             data-y="248"
                                             data-speed="300"
                                             data-start="2100"
                                             data-easing="easeOutExpo"  ><img src="images/slides/p11.jpg" alt="Image 12"></div>

                                        <div class="caption randomrotate"
                                             data-x="762"
                                             data-y="165"
                                             data-speed="300"
                                             data-start="2200"
                                             data-easing="easeOutExpo"  ><img src="images/slides/p12.jpg" alt="Image 13"></div>
                                                                        </li>

                            <!-- THE SECOND SLIDE -->
                            <li data-transition="papercut" data-slotamount="15" data-masterspeed="300" data-delay="9400" data-thumb="images/thumbs/thumb2.jpg">
                                        <img src="images/slides/slide2_wide1.jpg" >

                                        <div class="caption very_big_white lfl stl"
                                             data-x="18"
                                             data-y="293"
                                             data-speed="300"
                                             data-start="500"
                                             data-easing="easeOutExpo" data-end="8800" data-endspeed="300" data-endeasing="easeInSine" >TIMELINED CAPTIONS</div>

                                        <div class="caption big_white lfl stl"
                                             data-x="18"
                                             data-y="333"
                                             data-speed="300"
                                             data-start="800"
                                             data-easing="easeOutExpo" data-end="9100" data-endspeed="300" data-endeasing="easeInSine" >MOVE CAPTIONS IN AND OUT ON ONE SLIDE</div>

                                        <div class="caption lft ltb"
                                             data-x="500"
                                             data-y="0"
                                             data-speed="600"
                                             data-start="1100"
                                             data-easing="easeOutExpo" data-end="3100" data-endspeed="600" data-endeasing="easeInSine" ><img src="images/slides/drink1.jpg" alt="Image 3"></div>

                                        <div class="caption bold_red_text sft stb"
                                             data-x="720"
                                             data-y="290"
                                             data-speed="300"
                                             data-start="1400"
                                             data-easing="easeOutExpo" data-end="3300" data-endspeed="300" data-endeasing="easeInSine" >STRAWBERRY COCTAIL</div>

                                        <div class="caption big_black sfb stb"
                                             data-x="720"
                                             data-y="320"
                                             data-speed="300"
                                             data-start="1700"
                                             data-easing="easeOutExpo" data-end="3200" data-endspeed="300" data-endeasing="easeInSine" >$ 7.49</div>

                                        <div class="caption lft ltb"
                                             data-x="500"
                                             data-y="0"
                                             data-speed="600"
                                             data-start="3600"
                                             data-easing="easeOutExpo" data-end="5600" data-endspeed="600" data-endeasing="easeInSine" ><img src="images/slides/drink2.jpg" alt="Image 6"></div>

                                        <div class="caption bold_brown_text sft stb"
                                             data-x="720"
                                             data-y="290"
                                             data-speed="300"
                                             data-start="3900"
                                             data-easing="easeOutExpo" data-end="5800" data-endspeed="300" data-endeasing="easeInSine" >COKE & RUM</div>

                                        <div class="caption big_black sfb stb"
                                             data-x="720"
                                             data-y="320"
                                             data-speed="300"
                                             data-start="4200"
                                             data-easing="easeOutExpo" data-end="5700" data-endspeed="300" data-endeasing="easeInSine" >$ 5.99</div>

                                        <div class="caption lft ltb"
                                             data-x="500"
                                             data-y="0"
                                             data-speed="600"
                                             data-start="6100"
                                             data-easing="easeOutExpo" data-end="8100" data-endspeed="300" data-endeasing="easeInSine" ><img src="images/slides/drink3.jpg" alt="Image 9"></div>

                                        <div class="caption bold_green_text sft stb"
                                             data-x="720"
                                             data-y="290"
                                             data-speed="300"
                                             data-start="6400"
                                             data-easing="easeOutExpo" data-end="8300" data-endspeed="300" data-endeasing="easeInSine" >MOJITO COCTAIL</div>

                                        <div class="caption big_black sfb stb"
                                             data-x="720"
                                             data-y="320"
                                             data-speed="300"
                                             data-start="6700"
                                             data-easing="easeOutExpo" data-end="8200" data-endspeed="300" data-endeasing="easeInSine" >$ 6.79</div>
                                                                        </li>
                            <li data-transition="turnoff" data-slotamount="1" data-masterspeed="300" data-thumb="images/thumbs/thumb3.jpg">
                                                <img src="images/slides/slide3_wide1.jpg" >

                                        <div class="caption large_text fade"
                                             data-x="509"
                                             data-y="290"
                                             data-speed="300"
                                             data-start="800"
                                             data-easing="easeOutExpo"  ></div>

                                        <div class="caption very_large_black_text randomrotate"
                                             data-x="641"
                                             data-y="95"
                                             data-speed="300"
                                             data-start="1100"
                                             data-easing="easeOutExpo"  >SLIDER</div>

                                        <div class="caption large_black_text randomrotate"
                                             data-x="642"
                                             data-y="161"
                                             data-speed="300"
                                             data-start="1400"
                                             data-easing="easeOutExpo"  >REVOLUTION</div>

                                        <div class="caption bold_red_text randomrotate"
                                             data-x="645"
                                             data-y="201"
                                             data-speed="300"
                                             data-start="1700"
                                             data-easing="easeOutExpo"  >GOT FULLSCREEN VIDEO</div>

                                        <div class="caption sfb"
                                             data-x="640"
                                             data-y="223"
                                             data-speed="300"
                                             data-start="2000"
                                             data-easing="easeOutBack"  ><img src="images/slides/video.jpg" alt="Image 7"></div>

                                        <div class="caption sft"
                                             data-x="639"
                                             data-y="383"
                                             data-speed="300"
                                             data-start="2300"
                                             data-easing="easeOutExpo"  data-linktoslide="4" ><img src="images/slides/videobutton.jpg" alt="Image 8"></div>
                            </li>

                            <!-- THE THIRD SLIDE -->
                            <li data-transition="slidedown" data-slotamount="7" data-masterspeed="300" data-thumb="images/thumbs/thumb4.jpg">
                                    <img src="images/slides/black.jpg" >

                                    <div class="caption fade fullscreenvideo" data-autoplay="false" data-x="0" data-y="0" data-speed="500" data-start="10" data-easing="easeOutBack"><iframe src="http://player.vimeo.com/video/22775048?title=0&amp;byline=0&amp;portrait=0;api=1" width="100%" height="100%"></iframe></div>

                                    <div class="caption big_white sft stt"
                                         data-x="327"
                                         data-y="25"
                                         data-speed="300"
                                         data-start="500"
                                         data-easing="easeOutExpo" data-end="4000" data-endspeed="300" data-endeasing="easeInSine" >Have Fun Watching the Video</div>
                            </li>

                            <!-- THE FOURTH SLIDE -->
                            <li data-transition="slideleft" data-slotamount="1" data-masterspeed="300" data-thumb="images/thumbs/thumb5.jpg">

                                    <img src="images/slides/slide4_wide1.jpg" >

                                    <div class="caption large_text sft"
                                         data-x="50"
                                         data-y="44"
                                         data-speed="300"
                                         data-start="800"
                                         data-easing="easeOutExpo"  >TOUCH ENABLED</div>

                                    <div class="caption medium_text sfl"
                                         data-x="79"
                                         data-y="82"
                                         data-speed="300"
                                         data-start="1100"
                                         data-easing="easeOutExpo"  >AND</div>

                                    <div class="caption large_text sfr"
                                         data-x="128"
                                         data-y="78"
                                         data-speed="300"
                                         data-start="1100"
                                         data-easing="easeOutExpo"  ><span style="color: #ffc600;">RESPONSIVE</span></div>

                                    <div class="caption lfl"
                                         data-x="53"
                                         data-y="192"
                                         data-speed="300"
                                         data-start="1400"
                                         data-easing="easeOutExpo"  ><img src="images/slides/imac.png" alt="Image 4"></div>

                                    <div class="caption lfl"
                                         data-x="253"
                                         data-y="282"
                                         data-speed="300"
                                         data-start="1500"
                                         data-easing="easeOutExpo"  ><img src="images/slides/ipad.png" alt="Image 5"></div>

                                    <div class="caption lfl"
                                         data-x="322"
                                         data-y="313"
                                         data-speed="300"
                                         data-start="1600"
                                         data-easing="easeOutExpo"  ><img src="images/slides/iphone.png" alt="Image 6"></div>
                            </li>


                            <!-- THE FIFTH SLIDE -->
                            <li data-transition="flyin" data-slotamount="1" data-masterspeed="300" data-thumb="images/thumbs/thumb6.jpg">
                                    <img src="images/slides/slide5_wide.jpg" >

                                    <div class="caption large_text sfl"
                                         data-x="38"
                                         data-y="200"
                                         data-speed="300"
                                         data-start="1000"
                                         data-easing="easeOutExpo"  >A Happy</div>

                                    <div class="caption large_text sfl"
                                         data-x="37"
                                         data-y="243"
                                         data-speed="300"
                                         data-start="1300"
                                         data-easing="easeOutExpo"  >Holiday Season</div>

                                    <div class="caption randomrotate"
                                         data-x="610"
                                         data-y="174"
                                         data-speed="800"
                                         data-start="1600"
                                         data-easing="easeOutExpo"  ><img src="images/slides/TP_logo.png" alt="Image 4"></div>
                            </li>*/ ?>
                        </ul>



                        <div class="tp-bannertimer"></div>
                    </div>
                </div>

              


        <script>
            var api;
            jQuery(document).ready(function() {
                 api =  jQuery('.fullwidthabnner').revolution(
                                {
                                    delay:9000,
                                    startheight:500,
                                    startwidth:960,

                                    hideThumbs:10,

                                    thumbWidth:100,                         // Thumb With and Height and Amount (only if navigation Tyope set to thumb !)
                                    thumbHeight:50,
                                    thumbAmount:5,

                                    navigationType:"bullet",                // bullet, thumb, none
                                    navigationArrows:"nexttobullets",               // nexttobullets, solo (old name verticalcentered), none

                                    navigationStyle:"round",                // round,square,navbar,round-old,square-old,navbar-old, or any from the list in the docu (choose between 50+ different item), custom


                                    navigationHAlign:"center",              // Vertical Align top,center,bottom
                                    navigationVAlign:"bottom",                  // Horizontal Align left,center,right
                                    navigationHOffset:0,
                                    navigationVOffset:20,

                                    soloArrowLeftHalign:"left",
                                    soloArrowLeftValign:"center",
                                    soloArrowLeftHOffset:20,
                                    soloArrowLeftVOffset:0,

                                    soloArrowRightHalign:"right",
                                    soloArrowRightValign:"center",
                                    soloArrowRightHOffset:20,
                                    soloArrowRightVOffset:0,

                                    touchenabled:"on",                      // Enable Swipe Function : on/off
                                    onHoverStop:"on",                       // Stop Banner Timet at Hover on Slide on/off



                                    stopAtSlide:-1,
                                    stopAfterLoops:-1,

                                    shadow:1,                               //0 = no Shadow, 1,2,3 = 3 Different Art of Shadows  (No Shadow in Fullwidth Version !)
                                    fullWidth:"on"                          // Turns On or Off the Fullwidth Image Centering in FullWidth Modus
                                });
            });
        </script>