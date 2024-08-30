<template>
    <div class="topnav">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <RouterLink class="nav-link dropdown-toggle arrow-none" :to="{ name: 'dashboard' }" id="topnav-dashboard"
                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-home-circle icon"></i>
                            <span data-key="t-dashboard">Dashboard</span>
                        </RouterLink>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle arrow-none" href="index.html" id="topnav-dashboard"
                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-cart icon"></i>
                            <span data-key="t-dashboard">POS</span>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                            <i class="bx bx-customize icon"></i>
                            <span data-key="t-apps">Inventory</span>
                            <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-pages">

                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email"
                                    role="button">
                                    <span data-key="t-email">Category Management</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-email">
                                    <RouterLink :to="{ name: 'category.create' }" class="dropdown-item" data-key="t-inbox">
                                        Create</RouterLink>
                                    <RouterLink :to="{ name: 'category.index' }" class="dropdown-item" data-key="t-inbox">
                                        Inbox</RouterLink>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email"
                                    role="button">
                                    <span data-key="t-email">Brand Management</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-email">
                                    <RouterLink :to="{ name: 'brand.create' }" class="dropdown-item" data-key="t-inbox">
                                        Create</RouterLink>
                                    <RouterLink :to="{ name: 'brand.index' }" class="dropdown-item" data-key="t-inbox">
                                        Inbox</RouterLink>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email"
                                    role="button">
                                    <span data-key="t-email">Supplier Management</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-email">
                                    <RouterLink :to="{ name: 'supplier.create' }" class="dropdown-item" data-key="t-inbox">
                                        Create</RouterLink>
                                    <RouterLink :to="{ name: 'supplier.index' }" class="dropdown-item" data-key="t-inbox">
                                        Inbox</RouterLink>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email"
                                    role="button">
                                    <span data-key="t-email">Product Management</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-email">
                                    <RouterLink :to="{ name: 'product.create' }" class="dropdown-item" data-key="t-inbox">
                                        Create</RouterLink>
                                    <RouterLink :to="{ name: 'product.index' }" class="dropdown-item" data-key="t-inbox">
                                        Inbox</RouterLink>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email"
                                    role="button">
                                    <span data-key="t-email">Expense Category Management</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-email">
                                    <RouterLink :to="{ name: 'expense.category.create' }" class="dropdown-item" data-key="t-inbox">
                                        Create</RouterLink>
                                    <RouterLink :to="{ name: 'expense.category.index' }" class="dropdown-item" data-key="t-inbox">
                                        Inbox</RouterLink>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email"
                                    role="button">
                                    <span data-key="t-email">Expense Management</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-email">
                                    <RouterLink :to="{ name: 'expense.create' }" class="dropdown-item" data-key="t-inbox">
                                        Create</RouterLink>
                                    <RouterLink :to="{ name: 'expense.index' }" class="dropdown-item" data-key="t-inbox">
                                        Inbox</RouterLink>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-components" role="button">
                            <i class="bx bx-layer icon"></i>
                            <span data-key="t-components">HRM</span>
                            <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-components">
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-form"
                                    role="button">
                                    <span data-key="t-forms">Staff Management</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-form">
                                    <RouterLink :to="{ name: 'staff.create' }" class="dropdown-item" data-key="t-inbox">
                                        Create</RouterLink>
                                    <RouterLink :to="{ name: 'staff.index' }" class="dropdown-item" data-key="t-inbox">
                                        Inbox</RouterLink>
                                </div>
                            </div>
                            
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-more" role="button">
                            <i class="bx bx-file icon"></i>
                            <span data-key="t-pages">CRM</span>
                            <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-more">
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-pricing"
                                    role="button">
                                    <span data-key="t-pricing">Customar Management</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pricing">
                                    <RouterLink :to="{ name: 'customar.create' }" class="dropdown-item" data-key="t-inbox">
                                        Create</RouterLink>
                                    <RouterLink :to="{ name: 'customar.index' }" class="dropdown-item" data-key="t-inbox">
                                        Inbox</RouterLink>
                                </div>
                            </div>

                        </div>
                    </li>

                </ul>
            </div>
        </nav>
    </div>
</template>