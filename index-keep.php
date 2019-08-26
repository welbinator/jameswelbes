<?php include "includes/header.php"; ?>
    <div class="container-fluid photos">
      <h2 id="indexH2" class="text-white mb-4 text-center" data-aos="fade-up">Here are some stuffs I have done</h2>
      <div class="row index">  
      <!-- end header -->

   
<!--        <h2 class="text-white mb-4 text-center" data-aos="fade-up">Website Design Portfolio</h2><br> -->
      
         <div id="stuffs">
       <?php
              $query = "SELECT * FROM stuffs";
              $select_all_stuffs_query = mysqli_query($connection, $query);

              while($row = mysqli_fetch_assoc( $select_all_stuffs_query)) {

              $stuffs_title = $row['stuffs_title'];
              $stuffs_tagline = $row['stuffs_tagline'];
              $stuffs_image = $row['stuffs_image'];
              $stuffs_id = $row['stuffs_id'];
              $stuffs_permalink = $row['stuffs_permalink'];
              $stuffs_desc = $row['stuffs_desc'];
                    
                      
         ?>
      
       
      
       
        
                <div class="stuffs-inner">
                    <a data-fancybox data-src="#<?php echo $stuffs_permalink; ?>" href class="d-block photo-item">
                        <img src="images/index/thumbnails/<?php echo $stuffs_image ?>" alt="Image" class="img-fluid">
                        <div class="photo-text-more">
                       
                            <h3 class="heading"><?php echo $stuffs_title ?></h3>
                            <span class="meta"><?php echo $stuffs_tagline ?></span>

                        
                        </div>
                    </a>
                </div>
           
           <div style="display:none;" id="<?php echo $stuffs_permalink; ?>"><?php echo $stuffs_desc; ?></div>
         
      
      <?php } ?>
            </div> <!-- stuffs -->
          
       <div id="quotes" class="fade">
         <div>
        <h1>"Adding quotes to website landing pages is stupid."</h1><br>
        <h3>-James Welbes</h3>
         </div>
        </div>
      
      <div id="thanks" class="fade">
         <div>
        <h1>Thank you for visiting JamesWelbes.com</h1><br>
        
         </div>
        </div>
      
      <div id="name" class="fade dots">
         <div>
           <h1>My name is<span id="nameSpan">.</span><span id="nameSpan2">.</span><span id="nameSpan3">.</span></h1><br>
        
         </div>
        </div>
      
      
      
      <div id="jameswelbes" class="fade">
         <div>
        <h1>James Welbes</h1><br>
        
         </div>
        </div>
        
         <div id="callMe" class="fade dots">
         <div>
        <h1>But you can call me<span id="callMeSpan">.</span><span id="callMeSpan2">.</span><span id="callMeSpan3">.</span></h1><br>
        
         </div>
        </div>
      
      <div id="guy" class="fade">
         <div>
           <h1><span style="color:#4285f4;">G</span><span style="color:#ea4335;">o</span><span style="color:#fbbc05;">o</span><span style="color:#4285f4;">g</span><span style="color:#34a853;">l</span><span style="color:#ea4335;">e</span> Hat Guy.</h1><br>
        
         </div>
        </div>
      
<!--       <div id="stuff" class="fade">
         <div>
        <h1>I'm just a guy, who does stuff.</h1><br>
        
         </div>
        </div> -->
       

     

      <script>
        var one = 1000;
        var two = 2000;
        var next = 3500;
        var read = 4000;
        var five = 5000;
        
        hideHeader();
        
                      function hideHeader() {
                      document.getElementById('header').style.opacity = '0';
                      setTimeout(quotesIn,two);
                      }

                          function quotesIn () {
                          document.getElementById('quotes').style.opacity = '1';
                          setTimeout(quotesOut,read);
                          }


                          function quotesOut () {
                          document.getElementById('quotes').style.opacity = '0';
                          setTimeout(thanksIn,next);

                          }

                              function thanksIn () {
                              document.getElementById('thanks').style.opacity = '1';
                              setTimeout(thanksOut,read);

                              }

                              function  thanksOut () {
                              document.getElementById('thanks').style.opacity = '0';   
                              setTimeout(nameIn,next);

                              }

                                  function nameIn () {
                                  document.getElementById('name').style.opacity = '1';
                                  setTimeout(nameSpan,one);

                                  }


                                  function nameSpan () {
                                  document.getElementById('nameSpan').style.opacity = '1';
                                  setTimeout(nameSpan2,one);

                                  }

                                  function nameSpan2 () {
                                  document.getElementById('nameSpan2').style.opacity = '1';
                                  setTimeout(nameSpan3,one);

                                  }

                                  function nameSpan3 () {
                                  document.getElementById('nameSpan3').style.opacity = '1';
                                  setTimeout(nameOut,two);

                                  }

                                  function nameOut () {
                                  document.getElementById('name').style.opacity = '0';
                                  setTimeout(jameswelbesIn,next);

                                  }

                                        function jameswelbesIn () {
                                        document.getElementById('jameswelbes').style.opacity = '1';
                                        setTimeout(jameswelbesOut,next);

                                        }

                                        function jameswelbesOut () {
                                        document.getElementById('jameswelbes').style.opacity = '0';
                                        setTimeout(callMeIn,next);

                                        }

                                                function callMeIn () {
                                                document.getElementById('callMe').style.opacity = '1';
                                                setTimeout(callMeSpan,one);

                                                }

                                                function callMeSpan () {
                                                document.getElementById('callMeSpan').style.opacity = '1';
                                                setTimeout(callMeSpan2,one);

                                                }

                                                function callMeSpan2 () {
                                                document.getElementById('callMeSpan2').style.opacity = '1';
                                                setTimeout(callMeSpan3,one);

                                                }

                                                function callMeSpan3 () {
                                                document.getElementById('callMeSpan3').style.opacity = '1';
                                                setTimeout(callMeOut,two);

                                                }

                                                function callMeOut () {
                                                document.getElementById('callMe').style.opacity = '0';
                                                setTimeout(guyIn,next);

                                                }

                                                        function guyIn () {
                                                        document.getElementById('guy').style.opacity = '1';
                                                        setTimeout(guyOut,read);

                                                        }

                                                        function guyOut () {
                                                        document.getElementById('guy').style.opacity = '0';
                                                        setTimeout(headerIn, two);

                                                        }



                                                            function headerIn () {
                                                            document.getElementById('header').style.opacity = '1';
                                                            document.getElementById('stuffs').style.display = 'flex';
                                                            document.getElementById('stuffs').style.opacity = '1';
                                                            document.getElementById('indexH2').style.opacity = '1';


                                                            }

        
         
// function guyIn () {
// document.getElementById('guy').style.opacity = '1';


// }
        
//      guyIn();   
        
       
       
      
       
      
        
        
       
        
        
       
        
         
        
        
       
        
         
        
//         window.onload function() {
//             window.setTimeout(quotesIn, 1000); 
//             window.setTimeout(quotesOut, 6000); 
            
//             window.setTimeout(thanksIn, 8000);
//             window.setTimeout(thanksOut, 12000);

//             window.setTimeout(nameIn, 14000);
//             window.setTimeout(nameSpan, 15000);
//             window.setTimeout(nameSpan2, 16000);
//             window.setTimeout(nameOut, 18000);

//             window.setTimeout(insignificantIn, 20000);
//             window.setTimeout(insignificantOut, 24000);
          
//             window.setTimeout(justIn, 26000);
//             window.setTimeout(justSpan, 28000);
//             window.setTimeout(justOut, 30000);
          
//             window.setTimeout(headerIn, 32000);
//           window.setTimeout(headerIn, 1000);
          
          
         
          
          
        
// }
        
       
     
        
        
        
        
        
        
        
        
        
      </script> 
      </div></div>
    <?php include "footer.php"; ?>