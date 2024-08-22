<template>
    <div class="topnav">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle arrow-none" href="index.html" id="topnav-dashboard"
                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bx bx-home-circle icon"></i>
                            <span data-key="t-dashboard">Dashboard</span>
                        </a>
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

                            <a href="apps-calendar.html" class="dropdown-item" data-key="t-calendar">Calendar</a>

                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email"
                                    role="button">
                                    <span data-key="t-email">Category</span>
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
                                    <span data-key="t-email">Brand</span>
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
                                    <span data-key="t-email">Supplier</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-email">
                                    <RouterLink :to="{ name: 'supplier.create' }" class="dropdown-item" data-key="t-inbox">
                                        Create</RouterLink>
                                    <RouterLink :to="{ name: 'supplier.index' }" class="dropdown-item" data-key="t-inbox">
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
                                    <span data-key="t-forms">Forms</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-form">
                                    <a href="form-elements.html" class="dropdown-item" data-key="t-basic-elements">Basic
                                        Elements</a>
                                    <a href="form-validation.html" class="dropdown-item"
                                        data-key="t-validation">Validation</a>
                                    <a href="form-advanced.html" class="dropdown-item"
                                        data-key="t-advanced-plugins">Advanced Plugins</a>
                                    <a href="form-editors.html" class="dropdown-item" data-key="t-editors">Editors</a>
                                    <a href="form-uploads.html" class="dropdown-item" data-key="t-file-upload">File
                                        Upload</a>
                                    <a href="form-wizard.html" class="dropdown-item" data-key="t-wizard">Wizard</a>
                                    <a href="form-mask.html" class="dropdown-item" data-key="t-mask">Mask</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-table"
                                    role="button">
                                    <span data-key="t-tables">Tables</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-table">
                                    <a href="tables-basic.html" class="dropdown-item"
                                        data-key="t-bootstrap-basic">Bootstrap Basic</a>
                                    <a href="tables-advanced.html" class="dropdown-item"
                                        data-key="t-advanced-tables">Advance Tables</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-charts"
                                    role="button">
                                    <span data-key="t-apex-charts">Apex Charts</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-charts">
                                    <a href="charts-timeline.html" class="dropdown-item"
                                        data-key="t-timeline">Timeline</a>
                                    <a href="charts-candlestick.html" class="dropdown-item"
                                        data-key="t-candlestick">Candlestick</a>
                                    <a href="charts-boxplot.html" class="dropdown-item" data-key="t-boxplot">Boxplot</a>
                                    <a href="charts-bubble.html" class="dropdown-item" data-key="t-bubble">Bubble</a>
                                    <a href="charts-scatter.html" class="dropdown-item" data-key="t-scatter">Scatter</a>

                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-icons"
                                    role="button">
                                    <span data-key="t-icons">Icons</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-icons">
                                    <a href="icons-unicons.html" class="dropdown-item" data-key="t-unicons">Unicons</a>
                                    <a href="icons-feathericons.html" class="dropdown-item"
                                        data-key="t-feather-icons">Feather icons</a>
                                    <a href="icons-boxicons.html" class="dropdown-item"
                                        data-key="t-boxicons">Boxicons</a>
                                    <a href="icons-materialdesign.html" class="dropdown-item"
                                        data-key="t-material-design">Material Design</a>
                                    <a href="icons-fontawesome.html" class="dropdown-item"
                                        data-key="t-font-awesome">Font Awesome 5</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-map"
                                    role="button">
                                    <span data-key="t-maps">Maps</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-map">
                                    <a href="maps-google.html" class="dropdown-item" data-key="t-google">Google</a>
                                    <a href="maps-vector.html" class="dropdown-item" data-key="t-vector">Vector</a>
                                    <a href="maps-leaflet.html" class="dropdown-item" data-key="t-leaflet">Leaflet</a>
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
                                    <span data-key="t-pricing">Customar</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pricing">
                                    <RouterLink :to="{ name: 'customar.create' }" class="dropdown-item" data-key="t-inbox">
                                        Create</RouterLink>
                                    <RouterLink :to="{ name: 'customar.index' }" class="dropdown-item" data-key="t-inbox">
                                        Inbox</RouterLink>
                                </div>
                            </div>

                            

                            <a href="layout-vertical.html" class="dropdown-item" data-key="t-vertical">Vertical</a>
                        </div>
                    </li>

                </ul>
            </div>
        </nav>
    </div>
</template>