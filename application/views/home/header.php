<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        <?php
        if (!empty($page_title)) {
            echo $page_title;
        } else {
            echo "KeralKart";
        }
        ?>
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <!-- adding fevicon -->
        <link rel="icon" href="<?=base_url()?>assets/fevicon/KeralKart-fevicon.png" type="image/png" sizes="16x16">
    <!-- End of fevicon -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/home/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/home/css/style.css">
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>assets/home/css/socialmedia.css">
    <!-- <link rel="stylesheet" href="<?= base_url() ?>assets/home/css/accordions.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/home/css/accordions.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/home/css/megamenu.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/home/css/styleCart.css">
       <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/style1.css">
       <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/style-blog.css" />
   
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;lang=en" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <!-- <script src="<?= base_url() ?>assets/home/js/jquery.min.js"></script> -->
    <script src="<?= base_url() ?>assets/home/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/home/js/validate.js"></script>
    <script src="<?= base_url() ?>assets/home/js/accordions.js"></script>
    <script src="<?= base_url() ?>assets/home/js/list.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" media="screen">
    <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
 <!--   <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/home/verdana/style.css" />-->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/home/css/jquery-ui.css">
    <!-- <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/home/css/slidebar.css"> -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/home/css/styleproduct.css">
   <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/home/css/styleSheet.css">

 <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/home/css/responsive.css">
    <!-- share this api -->
    <!-- <script type="text/javascript"
        src="https://platform-api.sharethis.com/js/sharethis.js#property=5e48bf41eb84eb00123923fc&product=inline-share-buttons"
        async="async"></script> -->

    <!-- Rating  -->
    <script src="<?= base_url() ?>assets/home/js/rating.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
        crossorigin="anonymous">
    <script integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <!--Rating End   -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <style type="text/css">
    a {
        text-decoration: none;
        /*color: blue;*/
        color: black;
    }

    </style>


    <style type="text/css">


    #more_result {
        width:600px;
         width:auto; 
        border-radius: 0 0 2px 2px;
        border-top: 1px solid #e0e0e0;
        position: absolute;
        background-color: #fff;
        color: #000;
        z-index: -1;
        margin-top:45px;
        margin-left:360px;
        overflow: scroll;
        display: none;
        box-shadow: 2px 3px 5px -1px rgba(0, 0, 0, .5);
        overflow: absolute;
        white-space: nowrap;
        overflow-x: hidden;
        /*position: relative;*/
        /*z-index: 99999999999999999999999999999999999999;*/
    }

       @media  (max-width: 600px) {
        #more_result {
            /* width: 780px; */
            width: 225px;
            border-radius: 0 0 2px 2px;
            border-top: 1px solid #e0e0e0;
            position: absolute;
            background-color: #fff;
            color: #000;
            z-index: -1;
            margin-top:4px;
             margin-left: 110px;
            overflow: scroll;
            display: none;
            box-shadow: 2px 3px 5px -1px rgba(0, 0, 0, .5);
            overflow: absolute;
            white-space: nowrap;
            overflow-x: true;
          
            /*position: relative;*/
            /*z-index: 99999999999999999999999999999999999999;*/
        }
    }
@media (max-width:320px)  {
 /* smartphones, portrait iPhone, portrait 480x320 phones (Android) */
    #more_result {
            /* width: 780px; */
            width: 225px;
            border-radius: 0 0 2px 2px;
            border-top: 1px solid #e0e0e0;
            position: absolute;
            background-color: #fff;
            color: #000;
            z-index: -1;
            overflow: scroll;
            display: none;
            box-shadow: 2px 3px 5px -1px rgba(0, 0, 0, .5);
            overflow: absolute;
            white-space: nowrap;
            overflow-x: true;
            /*margin-left:2;*/
             margin-left: 110px;
            margin-top:4px;
            
  }
}

    li:hover ul {
        display: block;
    }

    ul li {
        display: block;

    }

/* Top Header */

    #top {
    background:#3ab54a;
    padding: 10px 0;
     font-size:;
    }
  
   .header-right-menu ul li a{
       font-size: 16px;
   } 
        @media (max-width: 991.98px) {
        #top {
        font-size: 1rem;
        text-align: center;
        }
        #top a {
        color: #fff;
        }

        #top ul.top-header {
        padding-top: 5px;
        margin: 0;
        font-size: 0.738rem;
        }
        #top ul.top-header > li {
        margin-right: 0;
        }

        #top ul.top-header > li a {
        color:#eee;
        }
        .care{
        margin-right: 50px;
        }
        #top ul.top-header > .active {
        color: #eee;
        }
        }

    /*style for the top header buttons*/

        @media (min-width: 801px) {
            /* tablet, landscape iPad, lo-res laptops ands desktops */
            .show-login-button {
              
            }
        }

        @media (min-width: 1025px) {
            /* big landscape tablets, laptops, and desktops */
            .show-login-button {
           
            }
            #login-button{
               
        }


    </style>
</head>

<body >
        <div id="top">
           <div class="container">
             <div class="row">
                 <div class="col-lg-6 col-md-6 offer ">
                          <h4 style="color:white" id="welcome">Welcome To Keralkart</h4>
                </div>
            <div class="col-lg-6 col-md-6 text-center pull-right header-right-menu">
                <ul class=" list-inline right-menu ">
                    <li id="show-login-button">
                        <?php
                        if ($this->session->userdata('user')) {
                        ?>
                        <a href="#" class="show-login-button"><?= $this->session->userdata('customerName'); ?> <i
                                    class="fa fa-angle-down"></i></a>
                        <div class="right-submenu" >
                            <div id="text-right-submenu" class="right-submenu-text"><a href="<?= base_url() ?>edit-profile">My Account</a></div>
                            <div id="text-right-submenu" ><a   href="<?= base_url() ?>active-orders">My Orders</a></div>
                            <!-- <div><a href="<?= base_url() ?>user-logout">Sign Out</a></div> -->
                        </div>
                    <li>
                        <a href="<?= base_url() ?>user-logout"><i class="fa fa-sign-out"></i> Logout</a></li>
                    <?php } else { ?>

                        </li>
                        <li class="" id="login-button">
                            <a href="<?= base_url() ?>userLogin"><i class="fa fa-sign-in"></i>&nbsp;Login</a>
                        </li>
                    <?php } ?>

                    <li><a href="<?= base_url() ?>blogs-list"><i class="fa fa-newspaper-o">
                             
                                &nbsp;</i>Blog</a></li>

<!--                    <li class=""><a href="#">24x7 Customer Care</a></li>-->
                </ul>
            </div>
        </div>
        </div>
     </div>
     <br>

     <!-- New Header Integrate -->

          <div class="container">
  
    <div class="header-inner">
      <div class="col-sm-3 col-xs-3 header-left">
        <div id="logo"> <a href="<?=base_url()?>"><img src="<?= base_url() ?>assets/Logoo.png" title="Keralkart-Commerce" alt="Keralkart-Commerce" class="img-responsive" /></a> </div>
      </div>
      <div class="col-sm-6 col-xs-6 header-right">
           <form method="GET" action="<?=base_url()?>get-search-result" enctype="multipart/form-data" autocomplete="off">
        <div id="search" class="input-group">
          <input type="text" name="category_search_name" value="" id="category_search_name" placeholder="Search  Products  ..." class="form-control input-lg custom-search" />
          <span class="input-group-btn">
          <button type="submit" class="btn btn-info btn-lg"><span>Search</span></button>
        </span>
      </div>
    </form>
          </span> 
         </div>
          <div>
                    <ul id="more_result" style="z-index:99999999999; padding:5px; padding-botton:5px;  min-height: auto; max-height:400px; overflow:true;"></ul>
                </div>
       </div>
       <div class="col-sm-2 col-xs-2 ">
     <a href="<?= base_url() ?>cart"><div id="cart" class="btn-group btn-block" >
           <span id="cart-total"><span>Shoping Cart</span><br style="color: #999999"> <?= count($this->cart->contents()); ?> Items

         </span>
       <!--   <div id="cart" class="btn-group btn-block">
        <img src="<?=base_url()?>assets/home/css/cart2.png" style="height:40px;">Shopping Cart</span></button> -->
      </div></a>

    <!--     
 -->       </div>
   </div>
</div>

             
          <!-- End  -->

    <!-- header  -->
    <!-- <div class="container-fluid" id="nav-heading">
        <div class="row">
            <div class="col-sm-3 col-xs-3 col-lg-2  image-code"><a href="<?= base_url() ?>">
              <img class="" src="<?= base_url() ?>assets/Logoo.png"></a>
             </div>

       <div class="col-xs-5 col-sm-5 col-lg-8">          
           <br>
        <form method="GET" action="<?=base_url()?>get-search-result" enctype="multipart/form-data" autocomplete="off">
            <div class="input-group">
                          <input type="text" class="form-control custom-search" name="category_search_name"
                          id="category_search_name" placeholder="Search All Products" style="">
                    <span class="input-group-addon" style="background-color: transparent;border: 0px;">
                    <button class="btn btn-search-product btn-sm"
                    type="submit"><i class="fa fa-search "></i><i class="hidden-xs">Search</i></button>
                    </span>
            </div>
        </form>
              
                <div>
                    <ul id="more_result" style="z-index:99999999999; padding:5px; padding-botton:5px;  min-height: auto; max-height:400px; overflow:true;"></ul>
                </div>

            </div>

            <div class="col-xs-4 col-sm-5 col-lg-2 c-button">
                <a href="<?= base_url() ?>cart" class="cart-button">
                    <span class="glyphicon glyphicon-shopping-cart"></span> Cart <span
                        style="background-color:;padding:0px 0px;"><?= count($this->cart->contents()); ?></span>
                </a>
            </div>
        </div>
    </div> -->


    
<br>
    <!-- Mega dropdown menu -->
    <div class="navbar navbar-default navbar-static-top " style="margin-bottom:0px !important;">
        <div class="container-fluid" style="">
            <div class="row">
                <div class="">
                    <div class="content">
                        <ul class="exo-menu">
                            <li>
                                <a class="" href="<?= base_url() ?>"><i class="fa fa-home"></i> Home</a>
                            </li>
                            <!--
                    <li><a href="#"><i class="fa fa-cogs"></i> Services</a></li>
                    <li><a href="#"><i class="fa fa-briefcase"></i> Portfolio</a></li> -->

                            <!-- mega menu code satart -->
<?php
foreach ($type as $view) {
$type_id = $view->id;
// echo $type_id;
?>
<li class="mega-drop-down" >
<a href="#">
<!-- <i class="fa fa-list"></i>  -->
<?= $view->typeName; ?>
</a>
<div class="animated fadeIn mega-menu mega-data">
<div class="mega-menu-wrap">
<div class="row">
<!-- <div class="col-md-4">
<h4 class="row mega-title">Feature</h4>
<img class="img-responsive"
src="https://3.bp.blogspot.com/-rUk36pd-LbM/VcLb48X4f-I/AAAAAAAAGCI/Y_UxBAgEqwA/s1600/Magento_themes.jpg">
</div> -->
<?php
$i=1;
foreach ($category_list as $key => $cat ) {
if ($cat->typeId == $view->id && ++$i<=8) {
?>
<div class="col-md-3" style="height:300px;">
<h4 class="row mega-title ">
<a href="<?= base_url() ?>Category/<?= $cat->url_slug ?>"
style="color:black;">
<span class="<?= $cat->categoryThumbnail ?>"></span>
<?php echo $cat->categoryName; ?>
</a>
</h4>
<ul class="stander ">
<!-- <li><a href="#">Mobile</a></li> -->
<?php
$j=1;
foreach ($all_product_sub_category as $sub_cat) {
if ($sub_cat->categoryId == $cat->id && ++$j<=8) { 
// echo $sub_cat->categoryId;
// echo $j;
?>
<li>
<a href="<?= base_url() ?>SubCategory/<?= $sub_cat->url_slug ?>"
style="color:black;"><?php echo $sub_cat->subCategoryName; ?>
</a>
</li>

<?php
}
}
?>
<li><a class="btn-sm"
href="<?= base_url() ?>Category/<?= $cat->url_slug ?>" style="font-size:12px">View
More</a></li>
</ul>
</div>
                                            <?php
                                              
                                            }
                                        }
                                        ?>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <?php } ?>

                            <!--   <li><a href="#"><i class="fa fa-envelope"></i> Contact</a>
                          <div class="contact">

                          </div>
                      </li> -->
                            <a href="#" class="toggle-menu visible-xs-block" style=""><i class="fa fa-bars"></i></a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row text-center">
        <div class="col-sm-10 col-sm-offset-1">
               <?= $this->session->flashdata('correct_pass'); ?>
              <?= $this->session->flashdata("Not_match")?><!-- OTP Not Match -->
            <?php if ($this->session->userdata('success_msg')) { ?>
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>
                    <center> <?= $this->session->flashdata('success_msg'); ?> </center>
                </strong>
            </div>
            <?php } ?>
            <?php if ($this->session->userdata('error_msg')) { ?>
            <div class="alert alert-danger alert-dismissible ">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong> <?= $this->session->flashdata('error_msg'); ?></strong>
            </div>
            <?php } ?>
        </div>
    </div>
    <script type="text/javascript">
    $(function() {
        $('.toggle-menu').click(function() {
            $('.exo-menu').toggleClass('display');
        });

    });
    </script>

    <!-- for search box  -->
    <script type="text/javascript">
    function addText(Textval) {
        // alert("hellow");
        $('#category_search_name').val(Textval);
        $('#more_result').empty();
        if($('#more_result').empty()){
            $('#more_result').hide();
        }
    }

    $(document).ready(function() {
        $('#category_search_name').on('keyup', function() {
            var search_text = $('#category_search_name').val();
            // alert(search_text);
            if (search_text == "") {
                $('#more_result').empty();
                $('#more_result').hide();
            } else {
                $.ajax({
                    method: "POST",
                    url: "<?=base_url()?>category-search-name",
                    data: {
                        search_name: search_text
                    },
                    // dataType:"Json",
                    success: function(html) {
                        console.log(html);
                        $("#more_result").html(html).show();
                    },
                    error: function(error) {
                        console.log(error);
                        // alert('error' + error);
                    }
                });
            }
        });
    });
    </script>

    <script type="text/javascript">
    // function addText(Textval) {
    //     $('#product_search_name').val(Textval);

    // }

    $(document).ready(function() {
        // this is the id of the form
        $("#idForm").submit(function(e) {

            e.preventDefault(); // avoid to execute the actual submit of the form.

            var form = $(this);
            var url = form.attr('action');

            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function(data) {
                    alert(data); // show response from the php script.
                },
                error: function(error) {
                    console.log(error);
                    alert('error' + error);
                }
            });


        });
    });
    </script>
    <!-- script for the autocomplete with the help of typehead js -->

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> -->
    <!-- <link rel="stylesheet" href="https://twitter.github.io/typeahead.js/css/examples.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js">
    </script>
    <script src="https://twitter.github.io/typeahead.js/js/handlebars.js"></script>
    <script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>-->
    <script> 
    // $(document).ready(function() {

    //     var sample_data = new Bloodhound({
    //         datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
    //         queryTokenizer: Bloodhound.tokenizers.whitespace,
    //         prefetch: '<?php echo base_url(); ?>index.php/Home/fetch',
    //         remote: {
    //             url: '<?php echo base_url(); ?>Home/fetch/%QUERY',
    //             wildcard: '%QUERY'
    //         }
    //     });

    //     // alert(sample_data);

    //     var imgSrc = "<?=base_url()?>'uploads/product/'";
    //     $('#prefetch .typeahead').typeahead(null, {
    //         name: 'sample_data',
    //         display: 'name',
    //         source: sample_data,
    //         limit: 10,
    //         templates: {
    //             suggestion: Handlebars.compile(
    //                 '<div class="row"><div class="col-md-2" style="padding-right:5px; padding-left:5px;  style=" z-index:99999999999999999 !important; ""><img src="<?=base_url()?>uploads/product/{{image}}" class="img-thumbnail" width="48" /></div><div class="col-md-10" style="padding-right:5px; padding-left:5px;">{{name}}</div></div>'
    //             )
    //         }
    //     });
    // });
    </script>

    <!-- end of script for the autocomplete with the help of typehead js -->