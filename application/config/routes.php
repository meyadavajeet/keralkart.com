<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
 */
$route['default_controller'] = 'Home';
$route['404_override'] = 'Custom404';
$route['translate_uri_dashes'] = FALSE;

//homepage
//$route['change_url'] = 'Home/change_url';


$route['home'] = 'Home/index';
$route['About'] = 'Home/about';
$route['Privacy-Policy'] = 'Home/privacy';
$route['Cancellation-and-Return'] = 'Home/cancellation';
$route['Shipping-Policy'] = 'Home/shipping';
$route['contact-us']='Home/contact_us';
$route['security-policy']='Home/security';
$route['payment_Response'] = 'Product/payment_Response';
$route['checkoutPage'] = 'Product/checkoutPage';

$route['fetch_data']='Product_filter_subcategory/fetch_data';

$route['products/(:any)'] = 'Home/productDetail/$1';
$route['Category/(:any)'] = 'Home/category/$1';
#pass data by id
// $route['cat/(:any)'] = 'Home/categoryById/$1';
$route['SubCategory/(:any)'] = 'Home/subcategory/$1';
// userUse Only
$route['checkout'] = 'Product/checkout';
$route['orderConfirm'] = 'Product/orderConfirm';
$route['success'] = 'Product/success';
$route['failure-order'] = 'Product/failure_order';

$route['check-user-login'] = 'Users/checkUserLogin';

$route['contact-info']='Users/contact_post';

$route['addToCart'] = 'Product/addToCart';
$route['addToCartProduct'] = 'Product/addToCartProduct';
$route['cart'] = 'Product/viewCart';
$route['generateHash'] = 'Product/generateHash';
$route['remove/(:any)'] = 'Product/remove/$1';

$route['clear-cart-item'] = 'Product/clear';

$route['userLogin'] = 'Users/userLogin';
$route['user-logout'] = "Users/userLogout";
$route['userRegister'] = 'Users/userRegister';
$route['check-user-login'] = 'Users/checkUserLogin';
$route['user-dashboard'] = 'Users/userDashboard';
$route['my-account'] = 'Users/myAccount';
$route['order-history'] = 'Users/orderHistory';
$route['active-orders'] = 'Users/activeOrders';
$route['my-address'] = 'Users/myAddress';
// $route['track-order'] = 'Users/trackOrder';
$route['notifications'] = 'Users/notifications';

$route['subscribe-email'] = 'SubscribeEmail/subscribe_email';

#|||||||||||||||||||| Customer Dashboard Routing ||||||||||||||||

$route['customer-dashboard'] = 'Users/customer_dashboard';
$route['get-data-by-orderid/(:any)'] = 'Users/getDataByOrderId/$1';
$route['trackOrderByOrderId/(:any)'] = 'Users/trackOrderByOrderId/$1';
$route['get-data-by-orderid-active-orders/(:any)'] = 'Users/getDataByOrderIdActiveOrders/$1';
$route['reset-password'] = 'Users/reset_password';
$route['address-list'] = 'Users/address_list';
$route['edit-profile'] = 'Users/edit_profile';
$route['update-user-profile'] = 'Users/updateUserProfile';
$route['update-user-profile-picture'] = 'Users/updateUserProfilePicture';
$route['update-user-address'] = 'Users/UpdateUserAddress';
#|||||||||||||||||| Add Rating to product ||||||||||||

$route['add-rating'] = 'Users/feedback';

// |||||||||||||||||||| Blog section for the user ||||||||||||||||||||||
$route['blogs-list'] = "Blog/blogs_list";
$route['blogs-list/(:any)'] = "Blog/blogs_list";
$route['blogList/(:any)']="Blog/blogs_list";
$route['get-one-blog/(:any)'] = "Blog/get_one_blog/$1";

// |||||||||||||||||||||||||||||||| Routing for the search box ||||||||||||||||||||||||||||
$route['category-search-name'] = "Product/category_search_name";
$route['get-search-result'] = "Product/get_search_result";


$route['search-category'] = "Home/search_category";


$route['allCategory']='Welcome/fetch_subcategory';

$route['saveAddress'] = 'Product/saveAddress';
// ||||||||||||||||||||||| ADMIN ROUTING START  ||||||||||||||||||||||||||
//for admin use only
$route['myadmin'] = 'Login/index';
$route['change-password'] = "Welcome/change_password";
$route['administration'] = "Welcome/administration";
$route['coupon'] = "Welcome/coupon";
$route['coupon-manager'] = "Welcome/coupon_manager";
$route['logout'] = 'Login/logout';
$route['dashboard'] = "Welcome/index";
$route['type'] = 'Welcome/type';
$route['category'] = "Welcome/category";
$route['sub-category'] = "Welcome/subCategory";
$route['notification'] = "Welcome/notification";
$route['brand'] = "Welcome/brand";
$route['gst'] ="GstController/gst";
$route['subscriber-list'] = "Welcome/subscriber_list";

// carousal section
$route['manage-carousal'] = "Carousal/manageCarousal";

// product routing
$route['product'] = "Welcome/product";
$route['edit-product/(:any)'] = "Welcome/editProduct/$1";
$route['update-product'] = "Welcome/updatedProduct";
$route['productDelete/(:any)'] = "Welcome/productDelete/$1";
$route['product-status-update/(:any)'] = "Welcome/productStatusUpdate/$1";
$route['view-product/(:any)'] = "Welcome/viewProduct/$1";
$route['product-list'] = "Welcome/productList";

// stock
$route['stock'] = "Welcome/stock";
$route['add-stock'] = "Welcome/addStock";
$route['available-stock'] = "Welcome/available_stock";
$route['stock-status-update/(:any)'] = "Welcome/stockStatusUpdate/$1";


// ||||||||||| Customer routing |||||||||||||||||||||||
$route['customer-list'] = "Welcome/customerList";
$route['customer-status-update/(:any)'] = "Welcome/customerStatusUpdate/$1";
$route['contact-message']='Welcome/contact_message';
//  |||||||||||||||||||||||||||   Reporting Routing |||||||||||||||||||||||
$route['get-all-stock'] = "Welcome/getAllStock";
$route['get-stock-by-date'] = "Welcome/getStockByDate";
$route['get-all-sales'] = "Welcome/getAllSales";
$route['get-sales-by-date'] = "Welcome/getSalesByDate";
$route['get-all-orders'] = "Welcome/getAllOrders";
$route['get-orders-by-date'] = "Welcome/getOrdersByDate";
$route['get-all-payments'] = "Welcome/getAllPayments";
$route['get-payments-by-date'] = "Welcome/getPaymentsByDate";

// #|||||||||||||||||||||||||||  Blog section |||||||||||||||||||

$route['blog'] = "Blog/index";
$route['create-blog'] = "Blog/createBlog";
$route['blog-list'] = "Blog/blogList";
$route['blog-delete/(:any)'] = "Blog/blogDelete/$1";
$route['blog-change-status/(:any)'] = "Blog/blogChangeStatus/$1";
$route['update-blog'] = "Blog/updateBlog";


//color filter from product-details
$route['color-filter']='Product/color_filter';

#|||||||||||||||||||||||| CHANGE ORDER STATUS  |||||||||||||||||||||||
$route['change-order-status'] = "Welcome/changeOrderStatus";


// |||||||||||||||||||| Invoice Routing Start ||||||||||||||||||||||||||
$route['view-orders-by-order-id/(:any)']  = "InvoiceController/view_order_by_order_id/$1";
$route['generate-invoice-by-invoice-id/(:any)']  = "InvoiceController/generate_invoice_by_invoice_id/$1";
$route['change-order-status-user'] = 'Users/changeOrderStatusUser';


// Forget Password 

 $route['user-password']='Users/forget_password';
 $route['check-user-email']='Users/Email_verify';
 $route['user-otp-verify']='Users/User_Otp';
 $route['opt-verify']='Users/user_otp_verify';
 $route['user-new-password']='Users/user_new_password';
 $route['Update-password']='Users/Update_user_password';

 
 //Register Time Get Otp
  $route['register-otp']='Users/register_mobile_otp';
  $route['Register-otp-verify']='Users/register_otp_verify';


