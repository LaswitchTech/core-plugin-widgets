<!-- ======= Widgets ======= -->
<ul id="plugin_widgets" class="flex-grow-1 nav nav-pills ms-3 d-flex align-items-center justify-content-end ms-auto z-1040">

    <!-- ======= Search Field ======= -->
    <li id="searchField" class="ms-3 <?php if(is_null($this->Request->getParams('GET','query'))){ echo 'd-none'; } ?> nav-item flex-grow-1" style="transition: all 0.5s ease-in-out;">
        <form class="d-flex" method="get" autocomplete="on" novalidate>
            <input type="text" name="query" class="form-control search" placeholder="<?= $this->Locale->get('Search'); ?>..." aria-label="<?= $this->Locale->get('Search'); ?>" value="<?= $this->Request->getParams('GET','query') ?>" style="transition: all 0.5s ease-in-out;">
        </form>
    </li>
    <!-- ======= End Search Field ======= -->

    <!-- ======= Search Button ======= -->
    <li id="searchBtn" class="nav-item">
        <button type="button" class="nav-link text-decoration-none py-2 animate-pulse-hover">
            <i class="bi bi-search fs-4" style="height: 2.25rem !important;width: 1.5rem !important"></i>
        </button>
    </li>
    <!-- ======= End Search Button ======= -->

    <!-- ======= Search Script ======= -->
    <script>
        $(document).ready(function(){
            $('#searchBtn').on('click', function(){
                $('#searchField').toggleClass('d-none');
                $('#searchField').find('.search').focus();
            });
        });
    </script>
    <!-- ======= End Search Script ======= -->

    <!-- ======= FullScreen ======= -->
    <li class="nav-item d-md-block d-none">
        <button id="fullscreenToggle" type="button" class="nav-link text-decoration-none py-2 animate-pulse-hover">
            <i class="bi bi-fullscreen fs-4" style="height: 2.25rem !important;width: 1.5rem !important"></i>
        </button>
    </li>
    <!-- ======= End FullScreen ======= -->

    <!-- ======= FullScreen Script ======= -->
    <script>
        $(document).ready(function(){
            $("#fullscreenToggle").on("click", function () {
                if (document.fullscreenElement) {
                    document.exitFullscreen();
                    $("#fullscreenToggle").find('i').removeClass('bi-fullscreen-exit').addClass('bi-fullscreen');
                } else {
                    document.documentElement.requestFullscreen();
                    $("#fullscreenToggle").find('i').removeClass('bi-fullscreen').addClass('bi-fullscreen-exit');
                }
            });
        });
    </script>
    <!-- ======= End FullScreen Script ======= -->

    <!-- ======= Plugin's Widget ======= -->
    <?php $this->load(); ?>
    <!-- ======= End Plugin's Widget ======= -->

    <!-- ======= App Drawer ======= -->
    <?php if($this->Auth && $this->Auth->isAuthenticated()): ?>
        <?php if(count($this->Builder->menu('apps')) > 0): ?>
            <li class="nav-item">
                <div class="dropdown">
                    <button class="nav-link text-decoration-none py-2 animate-pulse-hover" type="button" data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fs-4 bi bi-grid" style="height: 2.25rem !important;width: 1.5rem !important"></i>
                        <span class="position-absolute top-25 start-75 translate-middle border border-light rounded-circle d-none text-bg-primary" style="padding:8px"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end pb-0" style="min-width: 350px; max-width: 500px;">
                        <li>
                            <h5 class="py-2 px-3 m-0 cursor-default d-flex justify-content-center align-items-center">
                                <span><?= $this->Locale->get('Apps') ?></span>
                            </h5>
                        </li>
                        <li>
                            <hr class="dropdown-divider m-0">
                        </li>
                        <li class="overflow-auto rounded-bottom p-2" style="max-height:500px">
                            <div class="row row-cols-3 m-0 p-0">
                                <?php foreach($this->Builder->menu('apps') as $route => $nav): ?>
                                    <?php
                                        // Check if the route is internal or external by checking if the route starts with a slash
                                        if (strpos($route, '.') !== false) {
                                            $url = 'https://'.$nav['link'];
                                        } else {
                                            $url = $nav['link'];
                                        }
                                    ?>
                                    <div class="col p-0 m-0">
                                        <a class="dropdown-item rounded d-flex flex-column justify-content-center align-items-center p-2" href="<?= $url ?>">
                                            <i class="bi bi-<?= $nav['icon'] ?> fs-3"></i>
                                            <span class="text-wrap text-center"><?= $this->Locale->get($nav['label']); ?></span>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
        <?php endif; ?>
    <?php endif; ?>
    <!-- ======= End App Drawer ======= -->

    <!-- ======= Profile ======= -->
    <?php if($this->Auth && $this->Auth->isAuthenticated()): ?>
        <li class="nav-item dropdown">
            <button id="profileMenu" type="button" class="nav-link text-decoration-none ms-2 p-0 animate-pulse-hover" data-bs-auto-close="outside" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="/avatar?username=<?= $this->Auth->user()->username ?>" alt="avatar" width="48" height="48" class="rounded-circle">
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileMenu" style="min-width:350px;max-width:500px;">
                <li class="my-2">
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <div class="position-relative rounded-circle border border-3 border-light my-2">
                            <img src="/avatar?username=<?= $this->Auth->user()->username ?>" alt="avatar" class="rounded-circle" style="max-height: 122px; max-width: 122px; height: 122px; width: 122px; object-fit: contain; object-position: center;">
                        </div>
                        <div>
                            <h5><?= $this->Auth->user()->vcard['name'] ?></h5>
                        </div>
                    </div>
                </li>
                <li><hr class="dropdown-divider"></li>
                <?php foreach($this->Builder->menu('user') as $route => $nav): ?>
                    <li>
                        <a class="dropdown-item" href="<?= $nav['link'] ?>">
                            <i class="bi bi-<?= $nav['icon'] ?> me-1"></i>
                            <span><?= $this->Locale->get($nav['label']); ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
                <?php if(count($this->Builder->menu('user')) > 0): ?>
                    <li><hr class="dropdown-divider"></li>
                <?php endif; ?>
                <li>
                    <a class="dropdown-item" href="?signout">
                        <i class="bi bi-box-arrow-right me-1"></i>
                        <span><?= $this->Locale->get('Sign Out'); ?></span>
                    </a>
                </li>
            </ul>
        </li>
    <?php endif; ?>
    <!-- ======= End Profile ======= -->

    <!-- ======= Sign In ======= -->
    <?php if($this->Auth && !$this->Auth->isAuthenticated()): ?>
        <li class="nav-item ms-2">
            <a href="/signin?redirect=<?= $this->Request->getNamespace() ?>" class="btn btn-outline-light my-1 px-2"><?= $this->Locale->get('Sign in'); ?></a>
        </li>
    <?php endif; ?>
    <!-- ======= End Sign In ======= -->

</ul>
<!-- ======= End Widgets ======= -->
