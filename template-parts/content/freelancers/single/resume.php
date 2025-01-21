<div class="resume" id="resume">
    <div class="experience introduction">
        <div class="title_intro"><?php echo esc_html__('Experience','freeagent');?></div>
        <div class="jws_timeline layout1">
          <div class="jws_timeline_wrap">
        <?php
        $experiences = get_field('experience', get_the_id());
            if ($experiences) {
                foreach ($experiences as $experience) {
                    $line='';
                    $position = isset($experience['experience_position']) ? $experience['experience_position']:'';
                    $url = isset($experience['url_work']) ? $experience['url_work']:'';
                    $start_date = isset($experience['ex_start_date']) ? $experience['ex_start_date']:'';
                    $end_date = isset($experience['ex_end_date']) && !empty($experience['ex_end_date']) ? $experience['ex_end_date']: esc_html__('Present','freeagent');
                    $description = isset($experience['ex_description'])  ? $experience['ex_description']:'';
                  
                    if(!empty($start_date) && !empty($end_date)){
                        $line= ' - ';
                    }

         ?>
            
             <div class="jws_timeline_field">
                <div class="jws_timeline_circle"></div>
                    <div class="jws_timeline_content_inner">
                        <div class="jws_timeline_year"><?php echo ''.$start_date .$line. $end_date;?></div>
                        <h5 class="jws_timeline_title"><?php echo ''.$position;?></h5>
                        <div class="jws_timeline_link"><a href="<?php echo esc_url($url);?>"><?php echo ''.$url;?></a></div>
                        <div class="jws_timeline_desc"><?php echo ''.$description;?></div>
                  </div>
              </div>   
            
            <?php 
              }
            }?>
          </div>
        </div>
    </div>
    
    <div class="experience introduction">
        <div class="title_intro"><?php echo esc_html__('Education','freeagent');?></div>
        <div class="jws_timeline layout2">
            <div class="jws_timeline_wrap">
                    <?php
                        $educations = get_field('education', get_the_id());
                            if ($educations) {
                                foreach ($educations as $education) {
                                    $uni = isset($education['university']) ? $education['university']:'';
                                    $education_degree =  isset($education['university']) ?  $education['education_degree'] : '';
                                    $start_date =  isset($education['e_start_date']) ?  $education['e_start_date']: '';
                                    $end_date =  isset($education['e_end_date'])  && !empty($experience['e_end_date']) ?  $education['e_end_date']: esc_html__('Present','freeagent');
                                  $line='';
                                   if(!empty($start_date) && !empty($end_date)){
                                        $line= ' - ';
                                    }
                
                         ?>
                <div class="jws_timeline_field">
                <div class="jws_timeline_circle"></div>
                    <div class="jws_timeline_content_inner">
                        <h6 class="jws_timeline_title"><?php echo ''.$education_degree;?></h6>
                        <p class="jws_timeline_link"><?php echo ''.$uni;?></p>
                        <div class="jws_timeline_year"><?php echo ''.$start_date .$line. $end_date;?></div>
                    </div>
                </div>
                <?php 
              }
            }?>
            </div>
            <div class="jws_timeline_line" style="top: 0px;"></div>
        </div>
    </div>
</div>