<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\ContextController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CronController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\PageBuilderController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\ImagelibraryController;
use App\Http\Controllers\SeoController;

use App\Http\Middleware\UserCheck;
use App\Http\Middleware\VerifyAuthAdmin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//


Route::get('/staticUser', [HomeController::class, 'staticUser'])->name('staticUser');

//Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/', function () {
    $pathInfo = \Request::getPathInfo();
    if (!empty(getCookie('produktkategori')) && (getCookie('produktkategori') == 1 || getCookie('produktkategori') == 2) && ($pathInfo == '/' || $pathInfo == '/home')) {
        return redirect('/produktkategori/' . getCookie('produktkategori'));
    }
    return redirect('/home');
})->name('home');


//Route::get('/about', [HomeController::class, 'about'])->name('about');
//Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/custom_signup', [ProfileController::class, 'custom_signup'])->name('custom_signup');
Route::post('/sendEmail_kontakt', [HomeController::class, 'sendEmail_kontakt'])->name('sendEmail_kontakt');
//Product pages

Route::get('/produktkategori/{subCategoryId}', [HomeController::class, 'produktkategori'])->name('produktkategori');
Route::get('/produkttype/{categoryId}/{areaId}', [HomeController::class, 'produkttype'])->name('produkttype');
Route::get('/produkt/{area}/{id}/{name}', [HomeController::class, 'produkt'])->name('produkt');
Route::get('/refreshProductsAPI', [CronController::class, 'refreshProductsAPI'])->name('refreshProductsAPI');
Route::get('/search-produkt', [HomeController::class, 'searchProdukt'])->name('searchProdukt');
Route::get('/search-content/{key}', [HomeController::class, 'searchContent'])->name('searchContent');
Route::get('/getProdukt_Result', [HomeController::class, 'getProdukt_Result'])->name('getProdukt_Result');
Route::get('/getProduktPrice', [ProductController::class, 'getProduktPrice'])->name('getProduktPrice');
Route::get('/getVariantSim', [ProductController::class, 'getVariantSim'])->name('getVariantSim');
Route::get('/productSimStatus', [ProductController::class, 'productSimStatus'])->name('productSimStatus');

//Product pages

//GPSnet Organisation pages start

Route::get('/refreshOrganizationAPI', [CronController::class, 'refreshOrganizationAPI'])->name('refreshOrganizationAPI');

//GPSnet Organisation pages end

//services page start

Route::get('/service', [HomeController::class, 'service'])->name('service');
Route::get('/support-landbrug', [HomeController::class, 'support_landbrug'])->name('support_landbrug');
Route::get('/filterFaqResult', [HomeController::class, 'filterFaqResult'])->name('filterFaqResult');
Route::get('/getfaq_Result', [FaqController::class, 'getfaq_Result'])->name('getfaq_Result');

//services page end

/**** Cart Routes *****/

Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::post('/cart', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart_add', [CartController::class, 'cart_add'])->name('cart_add');
Route::post('/cart_add_subscription', [CartController::class, 'cart_add_subscription'])->name('cart_add_subscription');
Route::post('/alter_quantity', [CartController::class, 'alter_quantity'])->name('cart.alter_quantity');
Route::post('/removeItem', [CartController::class, 'removeItem'])->name('cart.removeItem');
Route::get('/share-cart/{key}', [CartController::class, 'shareCart'])->name('cart.share');
Route::get('/generate-cart-link', [CartController::class, 'generateLink'])->name('cart.linkGenerate');
Route::get('/send-cart-link', [CartController::class, 'sendLink'])->name('cart.linkSend');
Route::get('/sharedBasketDetails', [CartController::class, 'sharedBasketDetails'])->name('sharedBasketDetails');
Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/Address/save', [CartController::class, 'address_save'])->name('deliveryAddress.insert');
Route::get('/check-payment-method', [CartController::class, 'check_payment_method'])->name('check-payment-method');
Route::get('/bambora-payment', [CartController::class, 'bambora_payment'])->name('bambora-payment');
Route::get('/payment-status', [PaymentController::class, 'payment_status'])->name('payment-status');

/**** End Cart Routes *****/


/**** Trimble Access *****/
//Route::get('/trimble-access', [HomeController::class, 'trimbleAccess'])->name('trimbleAccess');
Route::get('/trimble', [HomeController::class, 'getTrimble'])->name('trimble');
Route::get('/getChildPage', [HomeController::class, 'getChildPage'])->name('getChildPage');

/**** End Trimble Access *****/


//login pages start
Route::middleware([UserCheck::class])->group(function () {
    Route::get('/login-register', [HomeController::class, 'login_register'])->name('login-register');
    Route::post('/submit_login', [AuthController::class, 'submit_login'])->name('submit_login');
    Route::post('/create_account', [HomeController::class, 'create_account'])->name('create_account');
    Route::post('/submit_forget_password', [HomeController::class, 'submitForgetPassword'])->name('submitForgetPassword');
    Route::post('/organization-register', [AuthController::class, 'organization_register']);
});
//login pages end

//test pages start
Route::get('/capture', [TestController::class, 'capture']);
Route::get('/authorizeSubscription', [TestController::class, 'authorizeSubscription']);
Route::get('/test', [TestController::class, 'test']);
Route::get('/test_mail', [TestController::class, 'test_mail']);
Route::get('/test_chat', [TestController::class, 'test_chat']);
Route::post('/login-user', [AuthController::class, 'userLogin']);
Route::get('/mailchimp', [TestController::class, 'mailchimp']);
//Route::post('/organization-register', [TestController::class, 'organization_register']);

// test pages end

//  Mailchimp Routes

//Route::post('/landburg-mailchimp',[HomeController::class,'landburg_mailchimp']);
//Route::post('/landmailing-mailchimp',[HomeController::class,'landmailing_mailchimp']);
Route::get('/mailchimp', [HomeController::class, 'mailchimp'])->name('mailchimp');

//
Route::get('/gpsnet', [HomeController::class, 'gpsnet']);
//Route::get('/nyhed', [HomeController::class, 'nyhed']);
Route::get('/verify/{token}', [HomeController::class, 'verifyUser']);
Route::get('/reset-password/{token}', [HomeController::class, 'resetPassUser']);
Route::post('/submit_reset_password', [HomeController::class, 'submitResetPassword'])->name('submitResetPassword');

Route::get('/getUserData', [ProfileController::class, 'getUserData'])->name('getUserData');
Route::post('/forgotPass', [ProfileController::class, 'forgotPass'])->name('forgotPass');


///////// Admin Route Start  //////////////

Route::middleware(['Admincheck'])->group(function () {
    Route::group(['prefix' => 'admin'], function () {
//Route::group(['prefix' => 'admin', 'middleware' => [VerifyAuthAdmin::class]], function () {

        Route::get('/', [HomeController::class, 'admin'])->name('adminHome');

        // Drag and DropCMS Start
        Route::any('/pages/{id}/build', [PageBuilderController::class, 'build'])->name('pagebuilder.build');
        Route::any('/pages/build', [PageBuilderController::class, 'build']);
        Route::any('/pages/copy/{id}', [PageBuilderController::class, 'copy']);

        Route::any('/pages', [PageBuilderController::class, 'list'])->name('pagebuilder.list');
        Route::any('/add', [PageBuilderController::class, 'add'])->name('pagebuilder.add');
        Route::any('/add_pages', [PageBuilderController::class, 'add_pages'])->name('pagebuilder.add_pages');
        Route::any('/delete_page/{id}', [PageBuilderController::class, 'delete_page'])->name('pagebuilder.delete_page');

        // Drag nad Drop CMS end

        // Dynamic Content start
        Route::get('/dynamic-pages', [ContentController::class, 'dynamicPages'])->name('dynamicPages');
        Route::get('/social-media', [SocialMediaController::class, 'index'])->name('social-media');
        Route::post('/submit_social', [SocialMediaController::class, 'insert'])->name('submit_social');
        Route::get('/edit_social/{id}', [SocialMediaController::class, 'edit'])->name('edit_social');
        Route::post('/update_social/{id}', [SocialMediaController::class, 'update'])->name('update_social');
        // Dynamic Content End

        /* FAQs start */

        Route::get('/faqs', [FaqController::class, 'faqs'])->name('faqs');
        Route::post('/submit_faqs', [FaqController::class, 'submitFaqs'])->name('submitFaqs');
        Route::get('/edit-faq/{productId}', [FaqController::class, 'editFaq'])->name('editFaq');
        Route::get('/delete-faq/{productId}', [FaqController::class, 'deleteFaq'])->name('deleteFaq');
        Route::post('/update-faq', [FaqController::class, 'updateFaq'])->name('updateFaq');


        /* FAQs end */

        /* Content Start */
        Route::get('/tinymceEditor', [ContentController::class, 'tinymceEditor'])->name('tinymceEditor');
        Route::post('/upload', [ContentController::class, 'imgUpload'])->name('imgUpload');


        Route::get('/editStaticContent/{page}', [ContentController::class, 'editStaticContent'])->name('editStaticContent');
        Route::post('ckeditor/upload', [ContentController::class, 'upload'])->name('ckeditor.image-upload');

        Route::get('/editStatic/{page}', [ContentController::class, 'editStatic'])->name('editStatic');
        Route::get('/editHome/{page}', [ContentController::class, 'editHome'])->name('editHome');
        Route::get('/edit-footer', [ContentController::class, 'edit_footer'])->name('edit.footer');
        Route::post('/update-footer', [ContentController::class, 'update_footer'])->name('update.footer');
        Route::post('/updateContent', [ContentController::class, 'updateContent'])->name('updateContent');

        Route::get('/edit-support', [ContentController::class, 'editSupport'])->name('editSupport');
        Route::post('/update-support', [ContentController::class, 'updateSupport'])->name('updateSupport');

        // team start

        Route::get('/addTeam', [ContentController::class, 'addTeam'])->name('addTeam');
        Route::post('/postTeam', [ContentController::class, 'postTeam'])->name('postTeam');

        Route::get('/editTeam/{id}', [ContentController::class, 'editTeam'])->name('editTeam');
        Route::get('/deleteTeam/{id}', [ContentController::class, 'deleteTeam'])->name('deleteTeam');
        Route::post('/updateTeam', [ContentController::class, 'updateTeam'])->name('updateTeam');

        // team end


        /* Content End */

        /* Categories and subcategories CRUD start */

        Route::get('/ecommerce-products-categories', [CategoryController::class, 'index'])->name('categories');
        Route::post('/submit_categories', [CategoryController::class, 'submitCategories'])->name('submit_categories');
        Route::get('/edit_categories/{categoryId}', [CategoryController::class, 'editCategories'])->name('edit_categories');
        Route::get('/delete_categories/{categoryId}', [CategoryController::class, 'deleteCategory'])->name('delete_categories');
        Route::post('/update_categories', [CategoryController::class, 'postCategories'])->name('update_categories');

        Route::get('/ecommerce-search-categories', [CategoryController::class, 'search_categories'])->name('search_categories');
        Route::post('/submit_search_categories', [CategoryController::class, 'submit_search_categories'])->name('submit_search_categories');
        Route::get('/edit_search_categories/{categoryId}', [CategoryController::class, 'editSearchCategories'])->name('edit_search_categories');
        Route::get('/delete_searchCategories/{categoryId}', [CategoryController::class, 'deleteSearchCategory'])->name('delete_searchCategories');
        Route::post('/update_search_categories', [CategoryController::class, 'updateSearchCategories'])->name('update_search_categories');

        Route::get('/ecommerce-areas', [AreaController::class, 'index'])->name('areas');
        Route::post('/submit_area', [AreaController::class, 'submitArea'])->name('submit_area');
        Route::get('/edit_area/{areaId}', [AreaController::class, 'editArea'])->name('edit_area');
        Route::get('/delete_area/{categoryId}', [AreaController::class, 'deleteArea'])->name('delete_area');
        Route::post('/update_area', [AreaController::class, 'updateArea'])->name('update_area');

        Route::get('/ecommerce-content', [ContextController::class, 'index'])->name('context');
        Route::post('/getGuidePage', [ContextController::class, 'getGuidePage'])->name('getGuidePage');
        Route::post('/submit_context', [ContextController::class, 'submitContext'])->name('submit_context');
        Route::get('/delete_context/{categoryId}', [ContextController::class, 'deleteContext'])->name('delete_context');
        Route::get('/edit_context/{contextId}', [ContextController::class, 'editContext'])->name('edit_context');
        Route::post('/update_context', [ContextController::class, 'updateContext'])->name('update_context');

        Route::get('/sub_categories/{categoryId}', [CategoryController::class, 'sub_categories'])->name('sub_categories');
        Route::get('/login_reg', [ContentController::class, 'login_reg'])->name('login_reg');
        Route::post('/update_login_reg', [ContentController::class, 'update_login_reg'])->name('update_login_reg');
        // Route::post('/submit_sub_categories', [CategoryController::class, 'submitSubCategories'])->name('submit_sub_categories');
        // Route::get('/edit_subcategories/{subCategoryId}', [CategoryController::class, 'editSubcategories'])->name('edit_subcategories');
        // Route::post('/update_sub_categories', [CategoryController::class, 'postSubCategories'])->name('update_sub_categories');

        /* Categories and subcategories CRUD end */

        /* Products start */

        Route::get('/add_products', [ProductController::class, 'addProducts'])->name('addProducts');
        // Route::post('/submit_products', [ProductController::class, 'submitProducts'])->name('submitProducts');
        Route::post('/update_products', [ProductController::class, 'updateProducts'])->name('updateProducts');
        Route::post('/deleteProductImage', [ProductController::class, 'deleteProductImage'])->name('deleteProductImage');
        Route::post('/changeImage', [ProductController::class, 'changeImage'])->name('changeImage');
        Route::post('/deleteAllImage', [ProductController::class, 'deleteAllImage'])->name('deleteAllImage');
        Route::get('/sim-products', [ProductController::class, 'sim_products'])->name('sim-products');
        Route::get('/productStatus', [ProductController::class, 'productStatus'])->name('productStatus');
        Route::get('/productAskSim', [ProductController::class, 'productAskSim'])->name('productAskSim');


        /*** SEO Routes ***/
        Route::get('/manage_seo', [SeoController::class, 'manage_seo'])->name('manage_seo');
        Route::post('/update_seoTbl', [SeoController::class, 'update_seoTbl'])->name('update_seoTbl');
        Route::post('/update_seoPage', [SeoController::class, 'update_seoPage'])->name('update_seoPage');

        /**** Add New Variants  ******/
        Route::get('/add-variant', [ProductController::class, 'add_variant'])->name('add-variant');
        Route::post('/submitVariantProduct', [ProductController::class, 'submitVariantProduct'])->name('submitVariantProduct');

        /******  Image Library Management  ******/

        Route::get('/imageLibrary', [ImagelibraryController::class, 'index'])->name('imageLibrary');
        Route::get('/deleteImageLib/{id}', [ImagelibraryController::class, 'deleteImageLib'])->name('deleteImageLib');
        Route::post('/updateFiles', [ImagelibraryController::class, 'updateFiles'])->name('updateFiles');
        Route::post('/uploadNewFile', [ImagelibraryController::class, 'uploadNewFile'])->name('uploadNewFile');
        Route::post('/fileSearch', [ImagelibraryController::class, 'fileSearch'])->name('fileSearch');
        Route::post('/getAllImg', [ImagelibraryController::class, 'getAllImg'])->name('getAllImg');


        Route::get('/account-page', [ProfileController::class, 'account'])->name('account');


        Route::get('/ecommerce-products-list', [ProductController::class, 'productsLists'])->name('productsLists');
        Route::get('/ecommerce-products-edit/{productId}', [ProductController::class, 'editProducts'])->name('editProducts');
        Route::get('/ecommerce-products-delete/{productId}', [ProductController::class, 'deleteProduct'])->name('deleteProduct');

        Route::get('/ecommerce-produkters-list', [ProductController::class, 'produktersLists'])->name('produktersLists');
        Route::post('/submit_produkter', [ProductController::class, 'submit_produkter'])->name('submit_produkter');
        Route::get('/ecommerce-produkter-edit/{productId}', [ProductController::class, 'editProdukter'])->name('editProdukter');
        Route::get('/ecommerce-produkter-delete/{productId}', [ProductController::class, 'deleteProdukter'])->name('deleteProdukter');
        Route::post('/update-produkter', [ProductController::class, 'updateProdukter'])->name('updateProdukter');

        Route::get('/ecommerce-sub-produkters/{productId}', [ProductController::class, 'subProdukter'])->name('subProdukter');
        Route::post('/submit-sub-produkter', [ProductController::class, 'submitSubProdukter'])->name('submitSubProdukter');
        Route::get('/ecommerce-sub-produkter-edit/{productId}', [ProductController::class, 'editSubProdukter'])->name('editSubProdukter');
        Route::get('/ecommerce-sub-produkter-delete/{productId}', [ProductController::class, 'deleteSubProdukter'])->name('deleteSubProdukter');
        Route::post('/update-sub-produkter', [ProductController::class, 'postSubProdukter'])->name('postSubProdukter');


        Route::get('/dynamic-header', [MenuController::class, 'index'])->name('dynamic.header');
        Route::get('/edit_menu/{id}', [MenuController::class, 'edit_menu'])->name('edit_menu');
        Route::get('/delete_menu/{id}', [MenuController::class, 'delete_menu'])->name('delete_menu');
        Route::post('/submit_menus', [MenuController::class, 'submit_menus'])->name('submit_menus');
        Route::post('/update_menus/{id}', [MenuController::class, 'update_menus'])->name('update_menus');


        Route::get('/submenus/{id}', [MenuController::class, 'index'])->name('submenus');
        Route::get('/submenus/listing/{id}', [MenuController::class, 'submenus'])->name('submenus.listing');
        Route::post('/submit_submenus', [MenuController::class, 'submit_submenus'])->name('submit_submenus');
        Route::get('/edit_submenu/{id}', [MenuController::class, 'edit_submenu'])->name('edit_submenu');
        Route::post('/update_submenus/{id}', [MenuController::class, 'update_submenus'])->name('update_submenus');
        Route::get('/delete_submenu/{id}/{menuId}', [MenuController::class, 'delete_submenu'])->name('delete_submenu');


        Route::get('/newsletters', [ContentController::class, 'newsletters'])->name('newsletters');
        Route::post('/update_newsletter', [ContentController::class, 'update_newsletter'])->name('update_newsletter');

        Route::get('/kontakat_os_modal', [ContentController::class, 'kontakat_os_modal'])->name('kontakat_os_modal');
        Route::post('/update_kontakt_os_modal', [ContentController::class, 'update_kontakt_os_modal'])->name('update_kontakt_os_modal');

        Route::get('/bliv_ringet_modal', [ContentController::class, 'bliv_ringet_modal'])->name('bliv_ringet_modal');
        Route::post('/update_bliv_ringet_modal', [ContentController::class, 'update_bliv_ringet_modal'])->name('update_bliv_ringet_modal');

        Route::get('/checkout_terms', [ContentController::class, 'checkout_terms'])->name('checkout_terms');
        Route::post('/update_checkout_terms', [ContentController::class, 'update_checkout_terms'])->name('update_checkout_terms');


        //
        /* Products end */

        /*Admin Profile start*/

        Route::get('/profile', [ProfileController::class, 'adminProfile'])->name('adminProfile');
        Route::post('/profile-update', [ProfileController::class, 'adminProfileUpdate'])->name('adminProfileUpdate');

        /*Admin profile end */

        /*Admin Logout */
        Route::get('/logout', [ProfileController::class, 'adminLogout'])->name('adminLogout');
        /*Admin Logout */

        /*Admin Users */
        Route::get('/customers', [UserController::class, 'customerList'])->name('customerList');
        Route::get('/customers/view/{userId}', [UserController::class, 'viewUser'])->name('viewUser');
        Route::get('/customers/userAdminUpdate/{userId}/{status}', [UserController::class, 'userAdminUpdate'])->name('userAdminUpdate');

        /*Admin Users */

        /*Ajax start*/
        Route::post('/get_subcategories', [AjaxController::class, 'sub_categories'])->name('get_subcategories');
        /*Ajax end*/


    });
});

///////// Admin Route End  //////////////
Route::middleware(['UserLogincheck'])->group(function () {
    Route::group(['prefix' => 'customer'], function () {
        Route::get('/logout', [ProfileController::class, 'adminLogout'])->name('adminLogout');
        Route::get('/account-page', [ProfileController::class, 'account'])->name('account');
        Route::post('/createGPSNetUser', [ProfileController::class, 'createGPSNetUser'])->name('createGPSNetUser');
        Route::post('/GPSNetUser_Delete', [ProfileController::class, 'GPSNetUser_Delete'])->name('GPSNetUser_Delete');
        Route::post('/terminateSubscription', [ProfileController::class, 'terminateSubscription'])->name('terminateSubscription');
        Route::post('/GPSNetSubscriptions_update', [ProfileController::class, 'GPSNetSubscriptions_update'])->name('GPSNetSubscriptions_update');
        Route::post('/deleteGPSNetSubscriptions', [ProfileController::class, 'deleteGPSNetSubscriptions'])->name('deleteGPSNetSubscriptions');
        Route::post('/GPSNetUser_update', [ProfileController::class, 'GPSNetUser_update'])->name('GPSNetUser_update');
        Route::post('/passwordUpdate', [ProfileController::class, 'passwordUpdate'])->name('passwordUpdate');
        Route::post('/updatePass', [ProfileController::class, 'updatePass'])->name('updatePass');
        // Route::get('/getUserData', [ProfileController::class, 'getUserData'])->name('getUserData');
        Route::get('/downloadPdf', [ProfileController::class, 'downloadPdf'])->name('downloadPdf');
        Route::get('/getPdf/{type}/{invoice}/{fileName}', [ProfileController::class, 'getPdf'])->name('getPdf');
        Route::get('/exportAllOrder', [ProfileController::class, 'exportAllOrder'])->name('exportAllOrder');
        Route::post('/userAcountUpdate', [ProfileController::class, 'userAcountUpdate'])->name('userAcountUpdate');
    });
});

// This is the final rout (no route will be created after this one)
Route::any('{uri}', [
    'uses' => 'App\Http\Controllers\WebsiteController@uri',
    'as' => 'page',
])->where('uri', '.*');
