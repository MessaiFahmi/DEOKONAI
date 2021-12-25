<style>

    html,
    body {
        min-height: 100vh;
    } 

    main {
        display: flex;
        /* flex-wrap: nowrap; */
        height: 100vh;
        height: -webkit-fill-available;
        max-height: 100vh;
        background-color:#f8f9fc;
        /* overflow-x: hidden;
        overflow-y: auto; */
    }

    .bi {
        vertical-align: -.125em;
        pointer-events: none;
        fill: currentColor;
    }

    .dropdown-toggle { outline: 0; }

    .nav-flush .nav-link {
        border-radius: 0;
    }

    .btn-toggle {
        width: 100%;
        position: relative;
        display: inline-flex;
        align-items: center;
        padding: .25rem .5rem;
        font-weight: 600;
        color: rgba(255,255,255,.25);
        background-color: transparent;
        border: 0;
    }
    .btn-toggle:hover,
    .btn-toggle:focus {
        /* color */
        /* background-color: #d2f4ea; */
        /* background-color: rgba(255,255,255,0.25); */
        color: rgba(255,255,255,1);
    }

    .btn-toggle::after {
        width: 1.25em;
        position: absolute;
        right: 0;
        line-height: 0;
        content: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='rgba%28255,255,255,1%29' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 14l6-6-6-6'/%3e%3c/svg%3e");
        transition: transform .35s ease;
        transform-origin: .5em 50%;
    }

    .btn-toggle[aria-expanded="true"] {
        color: rgba(255,255,255,1);
    }
    .btn-toggle[aria-expanded="true"]::after {
        transform: rotate(90deg);
    }

    .btn-toggle-nav a {
        display: inline-flex;
        width: 100%;
        padding: .1875rem .5rem;
        margin-top: .125rem;
        margin-left: 1.25rem;
        text-decoration: none;
    }

    .nav-link,
    .btn-toggle-nav a {
        color: rgba(255,255,255,.5);
    }

    .btn-toggle-nav a:hover,
    .btn-toggle-nav a:focus,
    .nav-link:hover,
    .nav-link:focus {
        color: rgba(255,255,255,1);
    }
    
    .scrollarea {
        overflow-y: auto;
    }

    .btn:hover {
        color: #fff;
        /* background-color: #d2f4ea; */
    }

    .fw-semibold { font-weight: 600; }
    .lh-tight { line-height: 1.25; }

</style>

<div class="flex-shrink-0 p-3 bg-dark col-2" style="overflow-y: auto; overflow-x: hidden;">

    <a href="/" class="d-flex align-items-center link-light text-decoration-none">
        <span class="fs-5 fw-semibold mx-auto">Tableau de bord</span>
    </a>

    <hr class="bg-secondary">

    <ul class="list-unstyled ps-0">

        <li class="nav-item mb-3">
            <a href="{{ route('admin.index') }}" class="nav-link text-decoration-none">
                <i class="bi bi-speedometer2 mx-1"></i>
                <span class="ml-2">Tableau de bord</span>
            </a>
        </li>

        <hr class="bg-secondary">

        <label class="fs-6 text-muted">Paramètres</label>
        <li class="mb-1">
            <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                <i class="bi bi-sliders me-2"></i>
                Paramètres
            </button>
            <div class="collapse show" id="home-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li><a href="{{ route('admin.settings.index') }}" class="link-light rounded">Général</a></li>
                    <li><a href="#" class="link-light rounded">SEO</a></li>
                    <li><a href="#" class="link-light rounded">Mail</a></li>
                    <li><a href="#" class="link-light rounded">Performances</a></li>
                    <li><a href="#" class="link-light rounded">Maintenance</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item mb-3">
            <a href="{{ route('admin.index') }}" class="nav-link link-light text-decoration-none ps-2">
                <i class="bi bi-list me-2"></i>
                <span class="ml-2">
                    Navigation
                </span>
            </a>
        </li>

        
        <hr class="bg-secondary">

        <label class="fs-6 text-muted">Utilisateurs</label>
        <li class="nav-item mb-3">
            <a href="{{ route('admin.index') }}" class="nav-link link-light text-decoration-none ps-2">
                <i class="bi bi-people-fill me-2"></i>
                <span class="ml-2">
                    Utilisateurs
                </span>
            </a>
        </li>
        <li class="nav-item mb-3">
            <a href="{{ route('admin.index') }}" class="nav-link link-light text-decoration-none ps-2">
                <i class="bi bi-tag-fill me-2"></i>
                <span class="ml-2">
                    Rôles
                </span>
            </a>
        </li>
        <li class="nav-item mb-3">
            <a href="{{ route('admin.index') }}" class="nav-link link-light text-decoration-none ps-2">
                <i class="bi bi-person-x-fill me-2"></i>
                <span class="ml-2">
                    Bannissements
                </span>
            </a>
        </li>

        <hr class="bg-secondary">

        <label class="fs-6 text-muted">Contenu</label>
        <li class="nav-item mb-3">
            <a href="{{ route('admin.index') }}" class="nav-link link-light text-decoration-none ps-2">
                <i class="bi bi-file-text-fill me-2"></i>
                <span class="ml-2">
                    Pages
                </span>
            </a>
        </li>
        <li class="nav-item mb-3">
            <a href="{{ route('admin.index') }}" class="nav-link link-light text-decoration-none ps-2">
                <i class="bi bi-newspaper me-2"></i>
                <span class="ml-2">
                    Articles
                </span>
            </a>
        </li>
        <li class="nav-item mb-3">
            <a href="{{ route('admin.images.index') }}" class="nav-link link-light text-decoration-none ps-2">
                <i class="bi bi-card-image me-2"></i>
                <span class="ml-2">
                    Images
                </span>
            </a>
        </li>
        <li class="nav-item mb-3">
            <a href="{{ route('admin.index') }}" class="nav-link link-light text-decoration-none ps-2">
                <i class="bi bi-arrow-90deg-right me-2"></i>
                <span class="ml-2">
                    Redirections
                </span>
            </a>
        </li>

        <hr class="bg-secondary">

        <label class="fs-6 text-muted">Autre</label>
        @if(Route::has('admin.update.index'))
            <li class="nav-item mb-3">
                <a href="{{ route('admin.update.index') }}" class="nav-link link-light text-decoration-none ps-2">
                    <i class="bi bi-cloud-arrow-down-fill me-2"></i>
                    <span class="ml-2">
                        Mise à jour
                    </span>
                </a>
            </li>
        @endif
        <li class="nav-item mb-3">
            <a href="{{ route('admin.index') }}" class="nav-link link-light text-decoration-none ps-2">
                <i class="bi bi-info-circle-fill me-2"></i>
                <span class="ml-2">
                    Logs
                </span>
            </a>
        </li>

    </ul>
</div>
