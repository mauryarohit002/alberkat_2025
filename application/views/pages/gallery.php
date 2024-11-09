<?php $this->load->view('templates/temp_header') ?>
<div class="container" >
    <div class="row">
        <div class="col-md-12">
            <?php if(!empty($data)):
                foreach ($data as $key => $value): 
                    if(!empty($value['gallery_image'])):
            ?>
                <h1 class="about_title"><?php echo $value['gallery_title_name']; ?></h1>
                    <?php  foreach ($value['gallery_image'] as $k => $v): ?>
                        <img class="pan lazy" src="<?php echo assets('js/loading.webp'); ?>" data-src="<?php echo $v; ?>" alt="Albarkaat" onclick="zoom(this)" title="Albarkaat" style="height: 280px; width: 270px;margin: 1px;">
                    
            <?php
                        endforeach; 
                    endif;
                endforeach; 
                else:
            ?>
                <h1 class="about_title">NO IMAGE FOUND</h1>
            <?php 
                endif;
             ?>

        </div>
    </div>   
</div>
<script type="text/javascript" src="<?php echo assets('js/lazy_loading.js')?>"></script>
</body>
</html>