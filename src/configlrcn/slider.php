      <?php
      $sqlUser3 = "SELECT * FROM nrims_tanzania.apvr_web_slider";
		$queryUser3 = $mysqli->query($sqlUser3);
        $totalUser3 = $queryUser3->num_rows;
        while($r3 = $queryUser3->fetch_array()){?>
         <div class="slid_item">
                                        <div class="home_text ">
                                            <h2 class="text-white"><strong>&nbsp;</strong></h2>
                                            <h1 class="text-white">&nbsp;Welcome, Get started<?php //echo $r3['text'];?></h1>
                                            <h3 class="text-white"><?php echo $r3['title'];?></h3>
                                            
                                            <h2 class="classheader">&nbsp;</h2>
                                            
                                        </div>

                                        <div class="home_btns m-top-40">
                                            <a href="#home" class="btn btn-primary m-top-20" onclick="document.getElementById('id01').style.display='block'">Login / Register</a>
                                       
                                        </div>
                                        
                                    </div><!-- End off slid item --> 

                            
                   <?php }?>