<body class="off-canvas hide-extras">
<script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=AM_HTMLorMML-full"></script>

<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('navigation'); ?>

	<div class="large-6 columns">
		<div class="section-container auto" data-section="" data-options="deep_linking: true;" data-section-resized="true" style="min-height: 50px;">
  		  <?php 
  		  	for ($i=0;$i<4;$i++) {
            $subj_array=array('science','mathematics','english','reading_comprehension');
            $q_array=array($q_science,$q_mathematics,$q_english,$q_reading_comprehension);
            $curr_subj = $q_array[$i];
            $subj = $subj_array[$i];
  		  		echo '<section';
  		  		if ($i==0) echo ' class="active"';
  		  		echo ' style="padding-top: 50px;">';

  		  		echo '<p class="title" data-section-title="" style="left:';
  		  		echo $i*100;
  		  		echo 'px;height:50px;" onclick="changesubj(\''.$subj.'\')">';
            echo '<a class="white" style="width:100px;padding:10px 0px 0px 0px;font-size:30px;text-align:center;vertical-align:middle;" id="panel_';
  		  		echo $subj;
  		  		echo '" onclick="changesubj(\''.$subj.'\')">';
            
            $icon_array=array('beaker','plus','comments','book');

            echo '<i class="icon-';
            echo $icon_array[$i];
            echo '"></i>';
            
  		  		echo '</a>';
            echo '</p>';

  		  		echo '<div class="content panel radius';
            if ($i==0) echo ' first';
            echo '" data-slug="panel_';
  		  		echo $subj;
  		  		echo '" data-section-content="" style="background-color:rgba(238,68,53,0.6);margin-bottom:0px">';

  		  		echo '<div class="panel" style="background-color:rgba(238,68,53,0);margin-bottom:0px"><h3>';
  		  		if ($i==0) {
              echo 'Science';
            }
            else if ($i==1) {
              echo 'Mathematics';
            }
            else if ($i==2) {
              echo 'English';
            }
            else if ($i==3) {
              echo 'Reading Comprehension';
            }
  		  		echo '</h3><ol id="questions_';
  		  		echo $subj;
  		  		echo'" style="list-style-type:none;margin-bottom:0px;margin-top:10px;">';

            $choice = array('choice1', 'choice2', 'choice3', 'correct_answer');

            $item=0;
            $randolph = array(30,30,25,15);
            // for($k = 0, $item=1; $k < 4; $k++, $item++)
            for($k = 0, $item=1; $k < $randolph[$i]; $k++, $item++)
            {
              $row = $curr_subj[$rev_vals['seq_'.$subj][$k]];
              //$row = $q_science[$rev_vals['seq_'.$subj][$i]];
              $name = "answer" .$item;

              // $c_array = array();
              // for($counter = 0; $counter < 4; $counter++){
              //   $randomize = rand(0,3);
                
              //   while(in_array($randomize,$c_array)){
              //     $randomize = rand(0,3);
              //   }

              //   array_push($c_array,$randomize);
                            
              //   $c_array[$counter] = $randomize;
              // }

              echo '<li';
              if ($k>0) echo ' class="hidden"';
              echo '><div class="panel radius" style="min-height:400px;background-color:#fff;margin-bottom:0px"><div class="large-12">';
              echo '<h3 style="color:rgba(90,153,207,0.6);">';
              echo $item;
              echo '</h3> ';

                echo '<strong>';
                  echo $row['ask'];
                echo '</strong><div class="row"><div class="large-12 columns">';
                echo '<table width="100%" style="margin-top:1.25em;margin-bottom:0em"><tbody>';

              for($j = 0; $j < 4; $j++){
                

                  //print_r($c_array);
                  $answer_text = $row[$choice[$j]];
                  //if($answer_text == $answers[$item])
                  //  echo '<label onclick="checkifcomplete()"><input type="radio" name='.$name.' id="'.$name.'_'.($j+1).'" value="'.$answer_text.'" checked="checked"><span class="custom radio checked"></span> ' . $answer_text.'</label>';
                  //else
                  echo '<tr style="min-height:42px"><td';
                  if ($answer_text == $row['correct_answer']) echo ' class="correct"';
                  else if ($answer_text == $rev_vals['ans_'.$subj][$item]) echo ' class="wrong"';
                  echo '>';
                  echo '<label';
                  if ($answer_text == $row['correct_answer']) echo ' class="correct"';
                  else if ($answer_text == $rev_vals['ans_'.$subj][$item]) echo ' class="wrong"';
                  echo '>'.$answer_text;
                  echo '</label>';
                  echo '</td></tr>';
              }
              echo '</tbody></table>';
              echo '</div></div></div></div></li>'; 
            }
            
  		  		echo '</ol></div>';
            echo
            '<div class ="row">
                <div class="large-12 columns" style="float:right">
                  <div class="row">
                    <div class="large-6 medium-6 small-6 columns" id="prev-pseudo_'.$subj.'-div"><a style="margin-bottom:0px" class="button disabled expand radius" id="prev-pseudo_'.$subj.'">Prev</a></div>
                    <div class="large-6 medium-6 small-6 columns hidden" id="prev_'.$subj.'-div"><a style="margin-bottom:0px" class="button expand radius" name="prev_'.$subj.'" id="prev_'.$subj.'" onclick="prevq(\''.$subj.'\')">Prev</a></div>
                    <div class="large-6 medium-6 small-6 columns" id="next_'.$subj.'-div"><a style="margin-bottom:0px" class="button expand radius" name="next_'.$subj.'" id="next_'.$subj.'" onclick="nextq(\''.$subj.'\')">Next</a></div>
                    <div class="large-6 medium-6 small-6 columns hidden" id="next-pseudo_'.$subj.'-div"><a style="margin-bottom:0px" class="button disabled expand radius" id="next-pseudo_'.$subj.'">Next</a></div>
                  </div>
                </div>
              </div>';
  		  		echo '</div></section>';
  		  	}
  		  ?>
        </div>
	</div>

  <div class="large-3 columns">
    <div class="row">
      <div class="large-12 columns">
        <div class="row fullrow">
          <div class="large-10 push-1 columns">
            <div class="panel radius" style="background-color:rgba(244,166,16,0.6);padding:15px 0px 15 0px">
              <h4 style="padding-left:15px">Questions</h4>
                <?php
                $subj_array=array('science','mathematics','english','reading_comprehension');
                $subj_echo_array=array('Science','Mathematics','English','Reading Comprehension');
                $q_array=array($q_science,$q_mathematics,$q_english,$q_reading_comprehension);
                // var_dump($q_array);
                for ($j=0;$j<4;$j++) {
                  echo '<div class="panel';
                  if ($j>0) echo ' hidden';
                  echo '" style="background-color:#fff;min-height:250px"';
                  echo ';margin-top:10px;margin-bottom:0px';
                  echo '" id="panelpagination_';
                  $subj = $subj_array[$j];
                  $curr_subj = $q_array[$j];
                  echo $subj;
                  echo '">';

                  echo '<ul class="pagination';
                  
                  echo '" id="pagination_';
                  
                  echo $subj;
                  echo '" style="margin-top:10px';
                  $choice = array('choice1', 'choice2', 'choice3', 'correct_answer');
                  // if ($j==3) 
                  echo ';margin-bottom:0px';
                  echo '">';
                  echo '<strong>';

                  $item=0;
                  $earle = array(30,30,25,15);
                  for ($i = 0,$item=1; $i < $earle[$j]; $i++, $item++) {
                  //for ($i = 0; $i < 4; $i++) {
                    $huehue = $rev_vals['seq_'.$subj];
                    $shet = $huehue[$i];
                    $row = $curr_subj[$shet];
                    echo '<li style="margin:4px;" ';
                    if ($i==0) echo ' class="current"';
                    echo '><span data-tooltip class="has-tip" title="';
                    echo $row['title'];
                    echo '"><a href="#" onclick="jumpto(\'';
                    echo $subj_array[$j];
                    echo '\',';
                    echo $i+1;
                    echo ')"';
                    
                    if ($rev_vals['ans_'.$subj][$item] == $row['correct_answer'])
                      echo ' class="correct"';
                    elseif ($rev_vals['ans_'.$subj][$item]==FALSE)
                      echo ' class="omit"';
                    else
                      echo ' class="wrong"';
                    echo '>';
                    echo $i+1;
                    echo '</a></span></li>';
                  }
                  echo '</strong>';
                  // echo '<br/>Subject:';
                  echo '</ul>';
                  echo '</div>';
                }
                
               ?>
            </div>

            <!-- Overview -->

            <div class="panel radius" style="background-color:rgba(42,209,117,0.6);padding:15px 0px 15 0px">
              <h4 style="padding-left:15px">Overview</h4>
                <?php
                $items_array=array(30,30,25,15);
                $subj_array=array('science','mathematics','english','reading_comprehension');
                $subj_echo_array=array('Science','Mathematics','English','Reading Comprehension');
                $q_array=array($q_science,$q_mathematics,$q_english,$q_reading_comprehension);
                echo '<table style="width:100%;margin-bottom:0px"><thead><tr><th style="width:50%;text-align:center">';
                echo 'SCORE';
                echo '</th><th style="width:50%;text-align:center">';
                echo 'ITEMS';
                echo '</th></tr></thead><tbody><tr><td style="text-align:center">';
                echo $score[4];
                echo '</td><td style="text-align:center">';
                echo '100';
                echo '</td></tr></tbody></table>';
                for ($j=0;$j<4;$j++) {
                  echo '<div class="panel';
                  if ($j>0) echo ' hidden';
                  echo '" style="background-color:#fff';
                  echo ';margin:0px;padding:0px';
                  echo '" id="paneloverview_';
                  $subj = $subj_array[$j];
                  $curr_subj = $q_array[$j];
                  echo $subj;
                  echo '">';
                  // echo '<h6 style="color: #222222;"><small style="color: #6f6f6f;">Breakdown:</small>&nbsp;';
                  // echo $subj_echo_array[$j];
                  // echo '</h6>';

                  echo '<table style="width:100%;margin-bottom:0px"><thead><tr><th style="width:25%;text-align:center">';
                  echo '<i class="fi-star" title="Items"></i>';
                  echo '</th><th style="width:25%;text-align:center">';
                  echo '<i class="fi-check" title="Correct"></i>';
                  echo '</th><th style="width:25%;text-align:center">';
                  echo '<i class="fi-x" title="Wrong"></i>';
                  echo '</th><th style="width:25%;text-align:center">';
                  echo '<i class="fi-minus" title="Omit"></i>';
                  echo '</th></tr></thead><tbody><tr><td style="text-align:center">';
                  echo $items_array[$j];
                  echo '</td><td style="text-align:center">';
                  echo $score[$j];
                  echo '</td><td style="text-align:center">';
                  echo $items_array[$j]-($score[$j]+$omits[$j]);
                  echo '</td><td style="text-align:center">';
                  echo $omits[$j];
                  echo '</td></tr></tbody></table>';

                  // echo '<br/>Subject:';
                  echo '</div>';
                }
                
               ?>
            </div>

            <a class = "button radius large expand" href = "site">Okay, I'm done!</a>

          </div>
        </div>
      </div>
    </div>
  </div>

</div>
<?php $this->load->view('includes/footer');?>
<script src="<?php echo site_url('js/jquery-1.7.1.min.js'); ?>"> </script>
<script>

  function changesubj(subj) {
    //alert(subj);
    
    if(subj!='science') {
      $('#panelpagination_science').addClass('hidden');
      $('#paneloverview_science').addClass('hidden');
    }
    if(subj!='mathematics') {
      $('#panelpagination_mathematics').addClass('hidden');
      $('#paneloverview_mathematics').addClass('hidden');
    }
    if(subj!='english') {
      $('#panelpagination_english').addClass('hidden');
      $('#paneloverview_english').addClass('hidden');
    }
    if(subj!='reading_comprehension') {
      $('#panelpagination_reading_comprehension').addClass('hidden');
      $('#paneloverview_reading_comprehension').addClass('hidden');
    }
    $('#panelpagination_'+subj).removeClass('hidden');
    $('#paneloverview_'+subj).removeClass('hidden');
  }

  function jumpto(subj, number){
    var num = number;
    $qlist = $("#questions_"+subj+" li");
    // alert($qlist.length);
    for (var i=0; i < $qlist.length; i++)
    {
      if ((i+1)==num) {
        $('#questions_'+subj+' li:eq(' + i + ')').removeClass("hidden");
        $('#pagination_'+subj+' li:eq(' + i + ')').addClass("current");
        if(i+1==$qlist.length) {
          $("#next_"+subj+"-div").addClass("hidden");
          $("#next-pseudo_"+subj+"-div").removeClass("hidden");
        }
        else {
          $("#next_"+subj+"-div").removeClass("hidden");
          $("#next-pseudo_"+subj+"-div").addClass("hidden");
        }
        if(i==0) {
          $("#prev_"+subj+"-div").addClass("hidden");
          $("#prev-pseudo_"+subj+"-div").removeClass("hidden");
        }
        else {
          $("#prev_"+subj+"-div").removeClass("hidden");
          $("#prev-pseudo_"+subj+"-div").addClass("hidden");
        }
      }
      else if(!($('#questions li:eq(' + i + ')').hasClass("hidden"))) {
        $('#questions_'+subj+' li:eq(' + i + ')').addClass("hidden");
        $('#pagination_'+subj+' li:eq(' + i + ')').removeClass("current");
      };
    }
  }

  function nextq(subj){
    var earle = false;
    $qlist = $("#questions_"+subj+" li");
    for (var i=0; i < $qlist.length; i++)
    {
      if(earle) {
        $('#questions_'+subj+' li:eq(' + i + ')').removeClass("hidden");
        $('#pagination_'+subj+' li:eq(' + i + ')').addClass("current");
        if(i+1==$qlist.length) {
          $("#next_"+subj+"-div").addClass("hidden");
          $("#next-pseudo_"+subj+"-div").removeClass("hidden");
        }
        else {
          $("#next_"+subj+"-div").removeClass("hidden");
          $("#next-pseudo_"+subj+"-div").addClass("hidden");
        }
        if(i==0) {
          $("#prev_"+subj+"-div").addClass("hidden");
          $("#prev-pseudo_"+subj+"-div").removeClass("hidden");
        }
        else {
          $("#prev_"+subj+"-div").removeClass("hidden");
          $("#prev-pseudo_"+subj+"-div").addClass("hidden");
        }
        earle = false;
      }
      else if(!($('#questions_'+subj+' li:eq(' + i + ')').hasClass("hidden"))) {
        $('#questions_'+subj+' li:eq(' + i + ')').addClass("hidden");
        $('#pagination_'+subj+' li:eq(' + i + ')').removeClass("current");
        earle=true;
      };
    }
  }

  function prevq(subj){
    var earle = false;
    //$("#next").text("What?");
    $qlist = $("#questions_"+subj+" li");
    //alert($qlist.length);
    for (var i=0; i < $qlist.length; i++)
    {
      //$("#next").text("Whet?"+i);
      if(earle) {
        $('#questions_'+subj+' li:eq(' + i + ')').removeClass("hidden");
        $('#pagination_'+subj+' li:eq(' + i + ')').addClass("current");
        if(i+1==$qlist.length) {
          $("#next_"+subj+"-div").addClass("hidden");
          $("#next-pseudo_"+subj+"-div").removeClass("hidden");
        }
        else {
          $("#next_"+subj+"-div").removeClass("hidden");
          $("#next-pseudo_"+subj+"-div").addClass("hidden");
        }
        if(i==0) {
          $("#prev_"+subj+"-div").addClass("hidden");
          $("#prev-pseudo_"+subj+"-div").removeClass("hidden");
        }
        else {
          $("#prev_"+subj+"-div").removeClass("hidden");
          $("#prev-pseudo_"+subj+"-div").addClass("hidden");
        }
        earle = false;
      }
      else if(!($('#questions_'+subj+' li:eq(' + i + ')').hasClass("hidden"))) {
        $('#questions_'+subj+' li:eq(' + i + ')').addClass("hidden");
        $('#pagination_'+subj+' li:eq(' + i + ')').removeClass("current");
        i=i-2;
        earle=true;
      };
    }
  }
  //);
//});
</script>