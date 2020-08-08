<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php
// Program to display URL of current page.

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
	$link = "https";
else
	$link = "http";

// Here append the common URL characters.
$link .= "://";

// Append the host(domain name, ip) to the URL.
$link .= $_SERVER['HTTP_HOST'];

// Append the requested resource location to the URL
$link .= $_SERVER['REQUEST_URI'];

// Print the link
$link;

//https://www.facebook.com/plugins/share_button.php?href='.urlencode($link).'&appId=201511064046972

// $finalFBURL='https://www.facebook.com/dialog/feed?app_id=621572568420951&display=touch&link='.urlencode($link).'%2F&redirect_uri='.urlencode($link);
$finalFBURL='https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fkeralkart.com%2F&appId=427813947821443';

$linkedinURL='https://www.linkedin.com/shareArticle?mini=true&url='.$link.'&title=LinkedIn%20Developer%20Network&summary=My%20favorite%20developer%20program&source=LinkedIn';

$finalTwitterURL ='https://twitter.com/intent/tweet?url='.$link.'&text=keralkart%20blog';
?>


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
            .card {
                background-color: white;
                padding: 10px;
                margin-top: 20px;
                box-shadow: 1px 1px 3px 1px;
                margin-left: 10px;
                margin-right: 10px;
                /*height: 500px;*/
            }
            .card1{
              /*  background-color: white;
                margin-left: 40px;
                margin-top: 20px;
                border: 1px solid #52bf52;
                padding:10px;
                margin-bottom:20px;*/

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
                
                }
                .card{
                    background-color: white;
                    padding: 20px;
                    margin-top: 20px;
                    border: 1px solid #52bf52;
                    padding-left:20px;
                    margin-left:100px;
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
            .header1{
                /*background-color: #52bf52;*/
                width:100%;
                /*padding-bottom:30px;*/
                /*margin-top:30px;*/
            }
                .img-blog{
                height:30px;
                width: 30px;
                }
                .card-text a{
                text-decoration:none;
                color:#6c757d;
                }
                .card-text{
                height:50px;
                border: 1px solid #6c757d;
                width:50%;
                background-color: white;
                padding: 16px;
                margin-left:25%;
                }
           

        </style>
<section class="loginSection">
    <div class="container">
      <div class="row col-lg-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?=base_url();?>">Home</a></li>
                                <li aria-current="page" class="breadcrumb-item active"> Blog  Details</li>
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
                <li><p><a href="<?=base_url()?>get-one-blog/<?=$Heading->url_slug?>"><img src="<?=base_url()?>uploads/admin/blog/<?=$Heading->blog_image;?>" class="img-thumbnail img-blog"><?=substr($Heading->blogHeading,0,60)?></a>
                <i class="fa fa-long-arrow-right" aria-hidden="true"></i></li>
                <?php endforeach ?>
            </ul>
            <h3>Popular Blog</h3>
            <?php foreach ($Popular_Heading as $row):?>
            <ul class="pop-blog">
                <li><p><a href="<?=base_url()?>get-one-blog/<?=$row->url_slug?>"><img src="<?=base_url()?>uploads/admin/blog/<?=$row->blog_image;?>" class="img-thumbnail img-blog"><?=substr($row->blogHeading,0,80)?></a><i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                    
                </li>
            </ul>
            <?php endforeach ?>
        </div>
        <div class="section-two col-lg-7 col-sm-7 col-md-7 col-xs-12">
           <?php foreach ($blogList as $row):?>
            <div class="mid-blog">
                <img src="<?=base_url()?>uploads/admin/blog/<?=$row->blog_image;?>">
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
		<div class="row">
			<div class="text-center">
				<div class="post-shares sticky-shares">

					<a target="_blank" href="<?=$finalFBURL?>"  id="shareBtn" title="Share to facebook" class="share-facebook"><img src="<?=base_url()?>assets/images/fb.png" width="22" height="22"></a>
					<a href="<?=$finalTwitterURL?>" target="_blank" title="Share to twitter" class="share-twitter"><img src="<?=base_url()?>assets/images/twitter.png" width="22" height="22"></a>
					<a target="_blank" title="Share via Whatsapp" href="https://wa.me/?text=<?=urlencode($link)?>" class="share-pinterest"><img src="<?=base_url()?>assets/images/whatsapp.png" width="22" height="22"></a>
					<a target="_blank" href="<?=$linkedinURL?>" target="_blank" title="share to linkedin" class="share-linkedin"><img src="<?=base_url()?>assets/images/icon-linkedin.webp" width="22" height="22"></a>
					<a target="_blank" href="mailto:?subject=Keral Kart&body=I have got a wonderful product for you! Please go through it  <?=$link?>" title="Share link via Email" class="share-envelope"><img src="<?=base_url()?>assets/images/envelope.png" width="22" height="22"></a>

				</div>
			</div>
		</div>

    </div>
</div>  
<br>
</section>
