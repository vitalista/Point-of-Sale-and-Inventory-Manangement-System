<aside id="sidebar" style="position: fixed; z-index: 1010;">

    <?php
    $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1);
    if ($page == 'sidebar.php') {
        echo '<script>window.location.href = "index.html"; </script>';
    }
    ?>

    <div class="d-flex">
        <button class="toggle-btn" type="button">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-list" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
            </svg>
        </button>
        <div class="sidebar-logo">
            <a href="#">Menu</a>
        </div>
    </div>

    <div class="d-flex" style="display: flex;">
        <div class="vl" style="border-left: 1px solid black; height: 170px;"></div>
        <div class="sidebar-logo">
            <a href="images/M&J.png" target="_blank" style="display: block; margin-left: auto; margin-right: auto; width: 50%;">
                <img src="images/M&J.png" alt="" style=" width: 170px; border-radius: 50%; transition: all 1s ease-out;">
            </a>
        </div>
    </div>



    <ul class="sidebar-nav">
        <li class="sidebar-item">
            <a href="homepage.php" class="sidebar-link" style=" color:<?= $page == 'homepage.php' ? 'gold' : 'white'; ?>;">
                <i class="bi bi-bar-chart" style="margin-right: 0px"></i>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bar-chart" viewBox="0 0 16 16">
                    <path d="M4 11H2v3h2zm5-4H7v7h2zm5-5v12h-2V2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1z" />
                </svg>
                <span style="margin-left: 13px">Dashboard</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="items.php" class="sidebar-link" style=" color:<?= $page == 'items.php' ? 'gold' : 'white'; ?>;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-week" viewBox="0 0 16 16">
            <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
            </svg>
                <span style="margin-left: 13px">Item Reports</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#auth01" aria-expanded="false01" aria-controls="auth" style=" color:<?= $page == 'purchase-orders.php' || $page == 'purchase-order-create.php' ? 'gold' : 'white'; ?>;">

                <i class="bi bi-card-checklist" style="margin-right: 0px"></i>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
                    <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0M7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0" />
                </svg>
                <span style="margin-left: 13px">Purchase Orders</span>

            </a>
            <ul id="auth01" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">

                <li class="sidebar-item">
                    <a href="purchase-orders.php" class="sidebar-link" style=" color:<?= $page == 'purchase-orders.php' ? 'gold' : 'white'; ?>;">
                        View Purchase Orders</a>
                </li>

                <li class="sidebar-item">
                    <a href="purchase-order-create.php" class="sidebar-link" style=" color:<?= $page == 'purchase-order-create.php' ? 'gold' : 'white'; ?>;">
                        Create Purchase Order</a>
                </li>
            </ul>
        </li>

        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#auth" aria-expanded="false" aria-controls="auth" style=" color:<?= $page == 'orders.php' || $page == 'order-create.php' ? 'gold' : 'white'; ?>;">

                <i class="bi bi-card-checklist" style="margin-right: 0px"></i>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
                    <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0M7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0" />
                </svg>
                <span style="margin-left: 13px">Customer Orders</span>

            </a>
            <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">

                <li class="sidebar-item">
                    <a href="orders.php" class="sidebar-link" style=" color:<?= $page == 'orders.php' ? 'gold' : 'white'; ?>;">
                        View Orders</a>
                </li>

                <li class="sidebar-item">
                    <a href="order-create.php" class="sidebar-link" style=" color:<?= $page == 'order-create.php' ? 'gold' : 'white'; ?>;">
                        Create Order</a>
                </li>
            </ul>
        </li>

        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#auth2" aria-expanded="false" aria-controls="auth2" style=" color:<?= $page == 'categories.php' || $page == 'categories-create.php' ? 'gold' : 'white'; ?>;">
                <?php if (hasInternet()) : ?>
                    <i class="lni lni-agenda"></i>
                <?php else : ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16" style="margin-right: 13px">
                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
                        <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0" />
                    </svg>
                <?php endif; ?>
                <span>Category</span>
            </a>

            <ul id="auth2" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">

                <li class="sidebar-item">
                    <a href="categories.php" class="sidebar-link" style=" color:<?= $page == 'categories.php' ? 'gold' : 'white'; ?>;">View Categories</a>
                </li>
                <?php if($_SESSION['LoggedInUser']['can_create'] == 1):?>
                    <li class="sidebar-item">
                    <a href="categories-create.php" class="sidebar-link" style=" color:<?= $page == 'categories-create.php' ? 'gold' : 'white'; ?>;">Add Category</a>
                    </li>
                  <?php else:?>
                  <?php endif; ?>
                
            </ul>

        </li>

        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#auth3" aria-expanded="false" aria-controls="auth3" style=" color:<?= $page == 'products.php' || $page == 'products-create.php' ? 'gold' : 'white'; ?>;">
                <?php if (hasInternet()) : ?>
                    <i class="lni lni-agenda"></i>
                <?php else : ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16" style="margin-right: 13px">
                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
                        <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0" />
                    </svg>
                <?php endif; ?>

                <span>Product</span>

            </a>
            <ul id="auth3" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">

                <li class="sidebar-item">
                    <a href="products.php" class="sidebar-link" style=" color:<?= $page == 'products.php' ? 'gold' : 'white'; ?>;">View Products</a>
                </li>

                <li class="sidebar-item">
                <?php if($_SESSION['LoggedInUser']['can_create'] == 1):?>
                    <a href="products-create.php" class="sidebar-link" style=" color:<?= $page == 'products-create.php' ? 'gold' : 'white'; ?>;">Add Product</a>
                  <?php else:?>
                  <?php endif; ?>
                </li>
            </ul>
        </li>

        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#auth4" aria-expanded="false" aria-controls="auth4" style=" color:<?= $page == 'customers.php' || $page == 'customers-create.php' ? 'gold' : 'white'; ?>;">

                <?php if (hasInternet()) : ?>
                    <i class="lni lni-agenda"></i>
                <?php else : ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16" style="margin-right: 13px">
                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
                        <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0" />
                    </svg>
                <?php endif; ?>

                <span>Customer</span>

            </a>
            <ul id="auth4" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">

                <li class="sidebar-item">
                    <a href="customers.php" class="sidebar-link" style=" color:<?= $page == 'customers.php' ? 'gold' : 'white'; ?>;">View Customers</a>
                </li>

                <?php if($_SESSION['LoggedInUser']['can_create'] == 1):?>
                    <li class="sidebar-item">
                    <a href="customers-create.php" class="sidebar-link" style=" color:<?= $page == 'customers-create.php' ? 'gold' : 'white'; ?>;">Add Customer</a>
                    </li>
                <?php else:?>
                <?php endif; ?>

            
            </ul>
        </li>

        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#auth5" aria-expanded="false" aria-controls="auth5" style=" color:<?= $page == 'suppliers.php' || $page == 'suppliers-create.php' ? 'gold' : 'white'; ?>;">

                <?php if (hasInternet()) : ?>
                    <i class="lni lni-agenda"></i>
                <?php else : ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16" style="margin-right: 13px">
                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
                        <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0" />
                    </svg>
                <?php endif; ?>

                <span>Supplier</span>

            </a>
            <ul id="auth5" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">

                <li class="sidebar-item">
                    <a href="suppliers.php" class="sidebar-link" style=" color:<?= $page == 'suppliers.php' ? 'gold' : 'white'; ?>;">View Suppliers</a>
                </li>

                <?php if($_SESSION['LoggedInUser']['can_create'] == 1):?>
                    <li class="sidebar-item">
                    <a href="suppliers-create.php" class="sidebar-link" style=" color:<?= $page == 'suppliers-create.php' ? 'gold' : 'white'; ?>;">Add Supplier</a>
                    </li>
                <?php else:?>
                <?php endif; ?>
            </ul>
        </li>

        <?php if ($_SESSION['LoggedInUser']['user_role'] == 'ADMIN') : ?>
            <div style="background-color: black;">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#auth6" aria-expanded="false" aria-controls="auth6" style=" color:<?= $page == 'users.php' || $page == 'users-create.php' ? 'gold' : 'white'; ?>;">

                        <?php if (hasInternet()) : ?>
                            <i class="lni lni-user"></i>
                        <?php else : ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-gear" viewBox="0 0 16 16" style="margin-right: 13px">
                                <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m.256 7a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1zm3.63-4.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0" />
                            </svg>
                        <?php endif; ?>

                        <span>User</span>

                    </a>

                    <ul id="auth6" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">

                        <li class="sidebar-item">
                            <a href="users.php" class="sidebar-link" style=" color:<?= $page == 'users.php' ? 'gold' : 'white'; ?>;">View Users</a>
                        </li>

                        <li class="sidebar-item">
                            <a href="users-create.php" class="sidebar-link" style=" color:<?= $page == 'users-create.php' ? 'gold' : 'white'; ?>;">Add User</a>
                        </li>
                    </ul>
            </div>
            </li>
        <?php else : ?>
        <?php endif; ?>

    </ul>
    <div class="sidebar-footer" style="background-color: black;">
        <a href="../logout.php" class="sidebar-link">

            <?php if (hasInternet()) : ?>
                <i class="lni lni-exit"></i>
            <?php else : ?>
                <svg style="margin-right: 13px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                    <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                </svg>
            <?php endif; ?>


            <span>Logout</span>
        </a>
    </div>
</aside>