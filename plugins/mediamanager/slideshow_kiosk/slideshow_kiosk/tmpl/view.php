<?php defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<?php $row = $vars->row; 

?>
<?php $div_id = "mediamanager_id_" . $row->media_id; ?>
<?php $count = $vars->db_files_count;
$params = $vars->row->params;






?>
<div id="container">
    <ul>
    <?php foreach ($vars->db_files as $key => $item) : ?>
    <?php switch ($item->file_extension) {
                                case 'webm':
                                case 'ogg':
                                case 'ogv':
                                case 'mp4': ?>

                       <li data-type="vid" data-id="<?php echo $item->mediafile_id; ?>">         
                       <video controls autobuffer>         
                                  <?php   
                    $string = unserialize($item->file_params);
                    foreach ($string as $skey => $value) : ?>
                    <?php $skey = str_replace("'", "", $skey) ; ?>
                        <?php if($skey == 'ogg' || $skey == 'mp4' || $skey == 'webm') :?>
                            <?php if(strlen($value)) : ?>
                        <source src="<?php echo $value; ?>" type="video/<?php echo  $skey; ?>"> 
                            <?php endif; ?>
                        <?php endif; ?>
                        
                    <?php endforeach; ?>
                     </video>
                 </li>
                 <?php  break;
                                
                                default: ?>
                                <li data-type="img" data-id="1" data-delay="15000"><img src="<?php echo $item->file; ?>" ></li>
                        
                                <?php    break;
                            } ?>
      <?php endforeach; ?>
    </ul>
  </div>

                                                    
<script type="text/javascript">


$(document).ready(function(){ 


    $("video").bind("ended", function() {


          if (current >= slides.length-1) {
            current=0;
          } else {
            current=current+1;
          }

          nextSlide = slides.eq(current);   
          currentSlide.removeClass('show');    
          nextSlide.addClass('show');

          playSlide();


    });


        

        var slides, current=0,currentSlide,nextSlide;

    playSlide();
    
    function playSlide(){
        
         slides = $('#container li'); 
         currentSlide= slides.eq(current);

            console.log('slide ' + (current+1) + ' of ' + slides.length);
  
        if(currentSlide.data('type')=='img') { 

          setTimeout(function(){ 
    
      

          if (current >= slides.length-1) {
            current=0;
          } else {
            current=current+1;
          }

          nextSlide = slides.eq(current);   
          currentSlide.removeClass('show');    
          nextSlide.addClass('show');

          playSlide();


          }, currentSlide.data('delay')); 

            } else {   

        currentSlide.children('video').get(0).play();

        }
        }

 
});


  </script>