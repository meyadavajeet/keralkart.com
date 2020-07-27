    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style type="text/css">
            * {
                box-sizing: border-box;

            }

    /* Add a gray background color with some padding */
    /*                       body {
                                font-family: Arial;
                                margin-left: 20px;
                                background: #f1f1f1;
                            }*/

    /* Create two unequal columns that floats next to each other */
            /* Left column */
            .leftcolumn {   
                float: left;
                width: 73%;
                padding-left:20px;
                /*margin-left:-20px;*/
            }

            /* Right column */
            .rightcolumn {
                float: left;
                width: 25%;
                padding-left: 10px;
                margin-left: -50px;

            }

            /* Fake image */
            .fakeimg {
                background-color: #aaa;
                width: 100%;
                /*padding: 20px;*/
                overflow:hidden;
                
            }
            .fakeimg1 {
                background-color: #aaa;
                width: 100%;
                /*padding: 20px;*/
                overflow:hidden;
            }  
            .fakeimg1:hover{
                transform: scale(1.01);
            }

            /* Add a card effect for articles */
            
            .card1{
              /*  background-color: white;
                margin-left: 40px;
                margin-top: 20px;
                border: 1px solid #52bf52;
                padding:10px;
                margin-bottom:20px;*/

            }
            .img-blog{
                height:30px;
                width: 30px;
            }
           


            /* Clear floats after the columns */
            .row:after {
                content: "";
                display: table;
                clear: both;
            }


            /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other */
            @media screen and (max-width: 800px) {
                .leftcolumn, .rightcolumn {   
                    width: 100%;
                    padding-left: 10px;
                    padding-right:10px;
                }
                body {
                    font-family: Arial;
                    padding: 20px;
                    background:;
                }
                
                .col-lg-5{
                    margin-left:50px;
                }
                .showmore{
                        /*margin:  30px 0 50px;*/
                          
                            margin-top:-15px;
                            
                            border: none;  
                }
                
            }
            a{
            	text-decoration: none;
            	/*color: black;*/
                color: blue;
            }
        </style>
        <style>
            .textdec{
               /* color:black;
                text-align:center;
                padding-top:30px;
                background-color: #52bf52;*/

            }
           

        </style>
<section class="loginSection">
      <div class="container">
	    <div class="row col-lg-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb card-text">
                                <li class="breadcrumb-item"><a href="<?=base_url();?>">Home</a></li>
                                <li aria-current="page" class="breadcrumb-item active"> Blog </li>
                            </ol>
                        </nav>
                    </div>
                </div>
	<!-- Blog Section List Of Blog -->

<!--- Blog section -->
<div class="blog-section">
    <div class="container-fluid">
        <div class="section-one col-lg-3 col-sm-3 col-md-3 col-xs-12">
            <h3>Follow Us On</h3>
            <ul class="links">
                <li><a href="#"><img src="<?= base_url() ?>assets/images/facebook.png"></a></li>
                <li><a href="#"><img src="<?= base_url() ?>assets/images/googleplus.png"></a></li>
                <li><a href="#"><img src="<?= base_url() ?>assets/images/instagram.png"></a></li>
                <li><a href="#"><img src="<?= base_url() ?>assets/images/linkedin.png"></a></li>
            </ul>
            <h3>Previous Blog</h3>
            <?php foreach ($Heading_name as $Heading):?>
            <ul class="pre-blog">
                <li><p><a href="<?=base_url()?>get-one-blog/<?=$Heading->url_slug?>"> <img src="<?=base_url()?>uploads/admin/blog/<?=$Heading->blog_image;?>" class="img-thumbnail img-blog"><?=substr($Heading->blogHeading,0,60)?></a>
                <i class="fa fa-long-arrow-right" aria-hidden="true"></i></li>
                <?php endforeach ?>
            </ul>
            <h3>Popular Blog</h3>
            <?php foreach ($Popular_Heading as $row):?>
            <ul class="pop-blog">
                <li><p><a href="<?=base_url()?>get-one-blog/<?=$row->url_slug?>"> <img src="<?=base_url()?>uploads/admin/blog/<?=$row->blog_image;?>"class="img-thumbnail img-blog"><?=substr($row->blogHeading,0,80)?></a><i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                    
                </li>
            </ul>
            <?php endforeach ?>
        </div>
        <div class="section-two col-lg-7 col-sm-7 col-md-7 col-xs-12">
           <?php foreach ($blogList as $row):?>
            <div class="mid-blog">
                <center><a href="<?=base_url()?>get-one-blog/<?=$row->url_slug?>"><img src="<?=base_url()?>uploads/admin/blog/<?=$row->blog_image;?>" class="img-responsive"></a></center>
                <h2><?= substr($row->blogHeading,0,55)?> </h2>
                <h5>By <?= $row->createdBy?><i class="fa fa-clock-o"></i> 
                    <?= date("H:i A",strtotime($row->added_at)) ?> 
                    <?= date("F",strtotime($row->added_at))?>
                    <?= date("d",strtotime($row->added_at)) ?>
                     <?= date("Y",strtotime($row->added_at)) ?>

                </h5>
                <p><?= htmlspecialchars_decode($row->blogContent);?></p>
            </div>
            <?php endforeach?>
            
             
                       <?php
                        // echo $links;
                        ?>
             <div class="pagination pull-right">
                    <?php echo $links; ?>
                </div>
        </div>
        <div class="section-three col-lg-2 col-sm-2 col-md-2 col-xs-12">
            <?php foreach($allProducts as $row):?>
            <div class="refer-product">
                 <a href="<?=base_url().'products/'.$row->slug?>">
                    <img width="" class="img-responsive img-thumbnail"
                    src="<?= base_url() ?>uploads/product/<?=$row->thumbnail2?>" style="height: 200px;">
                </a>
                
                    <h4><?= $row->productName?></h4>
                    
                       <h6>Price : <i>Rs.<?= $row->mrp?></i>  Rs. <?= $row->price?></h6>
                    </div>
                            
        <?php endforeach ?>
            
        </div>
    </div>
</div>  
<br>
</section>