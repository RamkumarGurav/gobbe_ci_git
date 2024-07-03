<div class="col-md-3">
    <div class="dashboard-menu">
        <ul class="nav flex-column" role="tablist">
            <li class="nav-item">
                <a class="nav-link <?=($active_left_menu=='dashboard')?' active':''?>" href="<?=base_url(__dashboard__)?>"><i class="fa fa-tachometer mr-10"></i>Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?=($active_left_menu=='orders')?' active':''?>" href="<?=base_url(__orderHistory__)?>"><i class="fa fa-shopping-bag mr-10"></i>Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?=($active_left_menu=='order_tracking')?' active':''?>" href="<?=base_url('order_tracking')?>"><i class="fa fa-shopping-cart mr-10"></i>Track Your Order</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?=($active_left_menu=='manage_address')?' active':''?>" href="<?=base_url(__shippingAddress__)?>"><i class="fa fa-map-marker mr-10"></i>My Address</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?=($active_left_menu=='profile')?' active':''?>" href="<?=base_url(__profileInformation__)?>"><i class="fa fa-user mr-10"></i>Account details</a>
            </li>
            <li class="nav-item">
                <a class='nav-link' href="<?=base_url(__logout__)?>"><i class="fa fa-sign-out mr-10"></i>Logout</a>
            </li>
        </ul>
    </div>
</div>
