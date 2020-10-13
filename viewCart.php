
<div class="header-cart-title flex-w flex-sb-m p-b-8">
<span class="mtext-103 cl2">
Your Cart
</span>
<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
<i class="zmdi zmdi-close"></i>
</div>
</div>
<div class="header-cart-content flex-w js-pscroll">
<ul class="header-cart-wrapitem w-full">
<?php 
session_start();
include "includes/config.php";

	

$total = 0;
foreach ($_SESSION["cart"] as $cart) {
	$p_id = $cart["prod_id"];
	$prov = $cart["prov_name"];
	$query= "SELECT * FROM products where prod_id='$p_id'";
	$res  = mysqli_query($conn , $query);
	$row  = mysqli_fetch_assoc($res);

	echo '<li class="header-cart-item flex-w flex-t m-b-12">';
	echo '<div class="header-cart-item-img">';
	echo '<img src="admin/images/productsImage/'.$row["prod_image"].'" alt="IMG">';
	echo '</div>
		  <div class="header-cart-item-txt p-t-8">
		  <a href="#" class="header-cart-item-name m-b-5 hov-cl1 trans-04">';
	echo $row["prod_name"];
	echo '</a>';
	echo '<small class="stext-102">'.$prov.'</small>';
	echo '<span class="header-cart-item-info">';
	echo $cart["quantity"]." X JD".$row["prod_new_price"];
	echo '</span>
		  </div>';  
	echo '</li>';
	$total+= $row["prod_new_price"]*$cart["quantity"];
}
	

?>
</ul>
<div class="w-full">
<div class="header-cart-total w-full p-tb-40">
Total: <?php echo "JD".$total;?>
</div>
<div class="header-cart-buttons flex-w w-full">
<a href="shoping-cart.html" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
View Cart
</a>
<a href="shoping-cart.html" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
Check Out
</a>
</div>
</div>
</div>


<script src="vendor/animsition/js/animsition.min.js" type="13f91e63a57d4d55753151fd-text/javascript"></script>





<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js" type="13f91e63a57d4d55753151fd-text/javascript"></script>
<script type="13f91e63a57d4d55753151fd-text/javascript">
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});
	</script>

<script src="vendor/sweetalert/sweetalert.min.js" type="13f91e63a57d4d55753151fd-text/javascript"></script>
<script type="13f91e63a57d4d55753151fd-text/javascript">
		$('.js-addwish-b2').on('click', function(e){
			e.preventDefault();
		});

		$('.js-addwish-b2').each(function(){
			var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-b2');
				$(this).off('click');
			});
		});

		$('.js-addwish-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-detail');
				$(this).off('click');
			});
		});

		/*---------------------------------------------*/

		$('.js-addcart-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});
	$('.js-hide-cart').on('click',function(){
        $('.js-panel-cart').removeClass('show-header-cart');
    });
	</script>




