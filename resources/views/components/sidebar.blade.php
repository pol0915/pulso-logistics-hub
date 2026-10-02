@php
    $sidebarItems = [
        [
            'label' => 'Dashboard',
            'route' => 'dashboard',
            'active' => request()->routeIs('dashboard'),
            'icon' => 'dashboard',
        ],
        [
            'label' => 'Inventory & Assets',
            'route' => 'inventory.index',
            'active' => request()->routeIs('inventory.*'),
            'icon' => 'inventory',
        ],
        [
            'label' => 'Logistics Requests',
            'route' => 'requests.index',
            'active' => request()->routeIs('requests.*'),
            'icon' => 'requests',
        ],
        [
            'label' => 'Borrow & Return',
            'route' => 'borrow.index',
            'active' => request()->routeIs('borrow.*'),
            'icon' => 'borrow',
        ],
        [
            'label' => 'Projects',
            'route' => 'projects.index',
            'active' => request()->routeIs('projects.*'),
            'icon' => 'projects',
        ],
        [
            'label' => 'Donations',
            'route' => 'donations.index',
            'active' => request()->routeIs('donations.*'),
            'icon' => 'donations',
        ],
        [
            'label' => 'Reports & History',
            'route' => 'reports.index',
            'active' => request()->routeIs('reports.*'),
            'icon' => 'reports',
        ],
    ];

    $hasLogoutRoute =
        \Illuminate\Support\Facades\Route::has('logout');
@endphp


@once
<style>
    /* ============================================================
       SIDEBAR BASE
       ============================================================ */

    #app-sidebar,
    #app-sidebar * {
        box-sizing: border-box;
    }


    #app-sidebar {
        position: fixed;
        inset: 0 auto 0 0;
        z-index: 50;

        display: flex;
        flex-direction: column;

        width: 260px;
        height: 100vh;
        height: 100dvh;

        overflow: hidden;

        border-right:
            1px
            solid
            rgba(255, 255, 255, 0.92);

        background:
            radial-gradient(
                circle at 16% 6%,
                rgba(246, 198, 226, 0.34),
                transparent 27%
            ),
            radial-gradient(
                circle at 92% 92%,
                rgba(141, 225, 231, 0.28),
                transparent 32%
            ),
            linear-gradient(
                165deg,
                #eff7fa 0%,
                #edf5f8 48%,
                #e8f2f6 100%
            );

        color: #10263d;

        box-shadow:
            8px 0 22px rgba(67, 103, 126, 0.1),
            inset -1px 0 0 rgba(255, 255, 255, 0.62);

        transition:
            width 220ms ease,
            transform 220ms ease;
    }


    #app-main {
        min-width: 0;

        transition:
            padding-left 220ms ease;
    }


    #app-sidebar svg {
        display: block;

        width: 20px;
        height: 20px;

        flex-shrink: 0;
    }


    /* ============================================================
       BRAND
       ============================================================ */

    #app-sidebar .hub-sidebar-brand {
        position: relative;

        display: flex;
        align-items: center;

        gap: 11px;

        min-height: 88px;

        flex-shrink: 0;

        padding:
            16px
            15px;

        border-bottom:
            1px
            solid
            rgba(203, 224, 234, 0.82);
    }


    #app-sidebar .hub-sidebar-brand::after {
        position: absolute;

        right: 16px;
        bottom: -1px;
        left: 16px;

        height: 1px;

        background:
            linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, 0.92),
                transparent
            );

        content: "";

        pointer-events: none;
    }


    #app-sidebar .hub-sidebar-brand-link {
        display: flex;
        align-items: center;

        gap: 11px;

        min-width: 0;

        color: #10263d;

        text-decoration: none;
    }


    #app-sidebar .hub-sidebar-logo {
        display: grid;
        place-items: center;

        width: 46px;
        height: 46px;

        flex: 0 0 46px;

        overflow: hidden;

        border:
            1px
            solid
            rgba(255, 255, 255, 0.98);

        border-radius: 15px;

        background:
            linear-gradient(
                145deg,
                #ffffff,
                #e8f2f6
            );

        box-shadow:
            5px 6px 13px rgba(91, 124, 145, 0.15),
            -4px -4px 10px rgba(255, 255, 255, 0.88),
            inset 1px 1px 2px rgba(255, 255, 255, 0.96);
    }


    #app-sidebar .hub-sidebar-logo img {
        display: block;

        width: 36px;
        height: 36px;

        object-fit: contain;
    }


    #app-sidebar .hub-sidebar-brand-copy {
        min-width: 0;

        white-space: nowrap;
    }


    #app-sidebar .hub-sidebar-brand-copy strong {
        display: block;

        color: #10263d;

        font-size: 23px;
        font-weight: 900;
        line-height: 1;

        letter-spacing: -0.055em;
    }


    #app-sidebar .hub-sidebar-brand-copy small {
        display: block;

        margin-top: 6px;

        color: #557188;

        font-size: 11.5px;
        font-weight: 550;
        line-height: 1.3;
    }


    /* ============================================================
       SIDEBAR CONTROLS
       ============================================================ */

    #app-sidebar .hub-sidebar-control {
        display: none;
        align-items: center;
        justify-content: center;

        width: 38px;
        height: 38px;

        flex: 0 0 38px;

        margin-left: auto;
        padding: 0;

        border:
            1px
            solid
            rgba(255, 255, 255, 0.96);

        border-radius: 13px;

        background:
            linear-gradient(
                145deg,
                #f8fcfe,
                #e4eef4
            );

        color: #557188;

        box-shadow:
            4px 5px 10px rgba(77, 111, 133, 0.13),
            -3px -3px 8px rgba(255, 255, 255, 0.86),
            inset 1px 1px 2px rgba(255, 255, 255, 0.92);

        font: inherit;

        cursor: pointer;

        transition:
            background 180ms ease,
            color 180ms ease,
            box-shadow 180ms ease,
            transform 180ms ease;
    }


    #app-sidebar .hub-sidebar-control:hover {
        background:
            linear-gradient(
                145deg,
                #faffff,
                #dcebf1
            );

        color: #007780;

        transform: translateY(-1px);
    }


    #app-sidebar .hub-sidebar-control:active {
        transform: translateY(0);

        box-shadow:
            inset 3px 3px 6px rgba(76, 106, 126, 0.16),
            inset -2px -2px 5px rgba(255, 255, 255, 0.76);
    }


    #app-sidebar #sidebar-collapse-icon {
        width: 20px;
        height: 20px;
    }


    #app-sidebar .hub-collapse-direction {
        transform-box: view-box;
        transform-origin: 16px 12px;

        transition:
            transform
            180ms
            ease;
    }


    /* ============================================================
       NAVIGATION
       ============================================================ */

    #app-sidebar .hub-sidebar-nav {
        flex: 1;

        min-height: 0;

        overflow-x: hidden;
        overflow-y: auto;

        padding:
            12px
            12px
            10px;

        scrollbar-width: none;
    }


    #app-sidebar .hub-sidebar-nav::-webkit-scrollbar {
        display: none;
    }


    #app-sidebar .hub-sidebar-list {
        display: flex;
        flex-direction: column;

        gap: 6px;

        margin: 0;
        padding: 0;

        list-style: none;
    }


    #app-sidebar .hub-sidebar-list > li {
        margin: 0;
        padding: 0;

        list-style: none;
    }


    /* ============================================================
       NAVIGATION LINKS
       ============================================================ */

    #app-sidebar .hub-sidebar-link {
        position: relative;

        display: flex;
        align-items: center;

        gap: 12px;

        min-height: 52px;

        padding:
            7px
            10px;

        border:
            1px
            solid
            transparent;

        border-radius: 16px;

        color: #4d687f;

        text-decoration: none;

        transition:
            color 180ms ease,
            background 180ms ease,
            border-color 180ms ease,
            box-shadow 180ms ease,
            transform 180ms ease;
    }


    #app-sidebar a.hub-sidebar-link:hover {
        border-color:
            rgba(255, 255, 255, 0.7);

        background:
            linear-gradient(
                145deg,
                rgba(247, 252, 254, 0.9),
                rgba(229, 241, 246, 0.9)
            );

        color: #007780;

        box-shadow:
            3px 4px 9px rgba(90, 124, 143, 0.08),
            -2px -2px 6px rgba(255, 255, 255, 0.65);

        transform: translateX(1px);
    }


    #app-sidebar .hub-sidebar-link::after {
        display: none !important;

        content: none !important;
    }


    /* ============================================================
       ACTIVE LINK
       ============================================================ */

    #app-sidebar .hub-sidebar-link.is-active {
        border-color:
            rgba(255, 255, 255, 0.96);

        background:
            linear-gradient(
                145deg,
                #e1f6f7,
                #cbecef
            );

        color: #00727b;

        box-shadow:
            inset 3px 3px 7px rgba(74, 117, 137, 0.13),
            inset -3px -3px 7px rgba(255, 255, 255, 0.78);
    }


    #app-sidebar .hub-sidebar-link.is-active::before {
        position: absolute;

        top: 50%;
        left: -5px;

        width: 4px;
        height: 25px;

        border-radius: 999px;

        background:
            linear-gradient(
                180deg,
                #ee1280,
                #05adb6
            );

        box-shadow:
            0 2px 7px rgba(5, 173, 182, 0.23);

        content: "";

        transform:
            translateY(
                -50%
            );
    }


    /* ============================================================
       ICONS
       ============================================================ */

    #app-sidebar .hub-sidebar-icon {
        display: grid;
        place-items: center;

        width: 38px;
        height: 38px;

        flex: 0 0 38px;

        border:
            1px
            solid
            rgba(255, 255, 255, 0.94);

        border-radius: 13px;

        background:
            linear-gradient(
                145deg,
                #f8fcff,
                #e2edf3
            );

        color: inherit;

        box-shadow:
            3px 4px 8px rgba(71, 110, 131, 0.11),
            -3px -3px 7px rgba(255, 255, 255, 0.82),
            inset 1px 1px 1px rgba(255, 255, 255, 0.92);

        transition:
            background 180ms ease,
            color 180ms ease,
            box-shadow 180ms ease,
            transform 180ms ease;
    }


    #app-sidebar .hub-sidebar-link.is-active .hub-sidebar-icon {
        border-color:
            rgba(255, 255, 255, 0.84);

        background:
            linear-gradient(
                145deg,
                #d9f7f8,
                #bee6e9
            );

        color: #00747e;

        box-shadow:
            inset 2px 2px 5px rgba(71, 119, 136, 0.11),
            inset -2px -2px 5px rgba(255, 255, 255, 0.72);
    }


    /* ============================================================
       LINK TEXT
       ============================================================ */

    #app-sidebar .hub-sidebar-link-copy {
        min-width: 0;
    }


    #app-sidebar .hub-sidebar-link-title {
        display: block;

        font-size: 13px;
        font-weight: 620;
        line-height: 1.45;

        white-space: nowrap;
    }


    #app-sidebar .hub-sidebar-link.is-active .hub-sidebar-link-title {
        font-weight: 760;
    }


    #app-sidebar .hub-sidebar-soon {
        display: block;

        margin-top: 3px;

        color: #758d9e;

        font-size: 10.5px;
    }


    #app-sidebar .hub-sidebar-link.is-disabled {
        color: #71899a;

        cursor: not-allowed;

        opacity: 0.76;
    }


    /* ============================================================
       FOOTER
       ============================================================ */

    #app-sidebar .hub-sidebar-footer {
        flex-shrink: 0;

        margin:
            0
            14px;

        padding:
            11px
            0
            14px;

        border-top:
            1px
            solid
            rgba(197, 220, 231, 0.86);
    }


    /* ============================================================
       LOGOUT
       ============================================================ */

    #app-sidebar .hub-sidebar-logout {
        display: flex;
        align-items: center;

        gap: 10px;

        width: 100%;
        min-height: 48px;

        margin: 0;
        padding:
            7px
            11px;

        border:
            1px
            solid
            rgba(255, 255, 255, 0.92);

        border-radius: 15px;

        background:
            linear-gradient(
                145deg,
                #fff8fb,
                #f3e5ec
            );

        color: #a82260;

        box-shadow:
            3px 4px 9px rgba(122, 77, 100, 0.08),
            -3px -3px 7px rgba(255, 255, 255, 0.72);

        font: inherit;
        font-size: 11.5px;
        font-weight: 700;

        text-align: left;

        cursor: pointer;

        transition:
            color 180ms ease,
            background 180ms ease,
            border-color 180ms ease,
            box-shadow 180ms ease,
            transform 180ms ease;
    }


    #app-sidebar .hub-sidebar-logout:hover {
        border-color:
            rgba(225, 153, 186, 0.76);

        background:
            linear-gradient(
                145deg,
                #fff7fb,
                #efdce6
            );

        color: #b90c61;

        box-shadow:
            4px 5px 10px rgba(150, 57, 102, 0.11),
            -3px -3px 8px rgba(255, 255, 255, 0.78);

        transform: translateY(-1px);
    }


    #app-sidebar .hub-sidebar-logout-icon {
        display: grid;
        place-items: center;

        width: 34px;
        height: 34px;

        flex: 0 0 34px;

        border:
            1px
            solid
            rgba(255, 255, 255, 0.9);

        border-radius: 11px;

        background:
            linear-gradient(
                145deg,
                #fbe8f1,
                #efd3e0
            );

        color: #b90c61;

        box-shadow:
            2px 3px 6px rgba(158, 49, 102, 0.08),
            -2px -2px 5px rgba(255, 255, 255, 0.66);
    }


    #app-sidebar .hub-sidebar-logout-icon svg {
        width: 17px;
        height: 17px;
    }


    #app-sidebar .hub-sidebar-logout-label {
        min-width: 0;

        white-space: nowrap;
    }


    /* ============================================================
       FOCUS
       ============================================================ */

    #app-sidebar a:focus-visible,
    #app-sidebar button:focus-visible {
        outline:
            3px
            solid
            rgba(238, 18, 128, 0.38);

        outline-offset: 3px;
    }


    /* ============================================================
       LOGOUT MODAL
       ============================================================ */

    body.hub-logout-modal-open {
        overflow: hidden;
    }


    .hub-logout-modal {
        position: fixed;
        inset: 0;
        z-index: 9999;

        display: grid;
        place-items: center;

        padding: 20px;
    }


    .hub-logout-modal[hidden] {
        display: none !important;
    }


    .hub-logout-backdrop {
        position: absolute;
        inset: 0;

        border: 0;

        background:
            rgba(16, 38, 61, 0.34);

        backdrop-filter:
            blur(
                4px
            );

        -webkit-backdrop-filter:
            blur(
                4px
            );
    }


    .hub-logout-dialog {
        position: relative;
        z-index: 2;

        width:
            min(
                420px,
                100%
            );

        padding: 23px;

        border:
            1px
            solid
            rgba(255, 255, 255, 0.96);

        border-radius: 22px;

        background:
            linear-gradient(
                145deg,
                #f9fcfd,
                #e9f3f7
            );

        box-shadow:
            16px 20px 44px rgba(24, 53, 73, 0.23),
            -8px -8px 22px rgba(255, 255, 255, 0.72),
            inset 1px 1px 2px rgba(255, 255, 255, 0.92);
    }


    .hub-logout-dialog-header {
        display: flex;
        align-items: flex-start;

        gap: 14px;
    }


    .hub-logout-dialog-icon {
        display: grid;
        place-items: center;

        width: 46px;
        height: 46px;

        flex: 0 0 46px;

        border:
            1px
            solid
            rgba(255, 255, 255, 0.94);

        border-radius: 15px;

        background:
            linear-gradient(
                145deg,
                #fbe8f1,
                #efd3e0
            );

        color: #b90c61;

        box-shadow:
            3px 4px 8px rgba(150, 57, 102, 0.09),
            -3px -3px 7px rgba(255, 255, 255, 0.72);
    }


    .hub-logout-dialog-icon svg {
        width: 20px;
        height: 20px;
    }


    .hub-logout-dialog-copy {
        min-width: 0;

        flex: 1;
    }


    .hub-logout-dialog-copy h2 {
        margin:
            1px
            0
            0;

        color: #10263d;

        font-size: 18px;
        font-weight: 850;
        line-height: 1.3;

        letter-spacing: -0.025em;
    }


    .hub-logout-dialog-copy p {
        margin:
            7px
            0
            0;

        color: #587388;

        font-size: 11.5px;
        line-height: 1.65;
    }


    .hub-logout-close {
        display: grid;
        place-items: center;

        width: 34px;
        height: 34px;

        flex: 0 0 34px;

        padding: 0;

        border:
            1px
            solid
            rgba(255, 255, 255, 0.92);

        border-radius: 11px;

        background:
            linear-gradient(
                145deg,
                #f6fbfd,
                #e4eef3
            );

        color: #688297;

        box-shadow:
            2px 3px 7px rgba(82, 115, 136, 0.1),
            -2px -2px 6px rgba(255, 255, 255, 0.68);

        cursor: pointer;
    }


    .hub-logout-close:hover {
        color: #b90c61;
    }


    .hub-logout-dialog-actions {
        display: flex;
        justify-content: flex-end;

        gap: 10px;

        margin-top: 22px;
    }


    .hub-logout-modal-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 42px;

        padding:
            10px
            15px;

        border:
            1px
            solid
            rgba(255, 255, 255, 0.92);

        border-radius: 12px;

        font: inherit;
        font-size: 11px;
        font-weight: 750;

        cursor: pointer;

        transition:
            transform 160ms ease,
            box-shadow 160ms ease,
            background 160ms ease;
    }


    .hub-logout-cancel {
        background:
            linear-gradient(
                145deg,
                #f7fbfd,
                #e5eef3
            );

        color: #496580;

        box-shadow:
            3px 4px 8px rgba(81, 113, 134, 0.1),
            -2px -2px 6px rgba(255, 255, 255, 0.7);
    }


    .hub-logout-confirm {
        border-color:
            rgba(240, 171, 203, 0.8);

        background:
            linear-gradient(
                145deg,
                #ca176e,
                #aa0b58
            );

        color: #ffffff;

        box-shadow:
            4px 5px 10px rgba(185, 12, 97, 0.18),
            inset 1px 1px 2px rgba(255, 203, 227, 0.2);
    }


    .hub-logout-modal-button:hover {
        transform: translateY(-1px);
    }


    /* ============================================================
       LARGE DESKTOP
       ============================================================ */

    @media (min-width: 1280px) {
        #app-sidebar {
            width: 260px;

            transform: translateX(0);
        }


        #app-main {
            padding-left: 260px;
        }


        #app-sidebar #toggle-sidebar-collapse {
            display: inline-flex;
        }


        body.sidebar-collapsed #app-sidebar {
            width: 84px;
        }


        body.sidebar-collapsed #app-main {
            padding-left: 84px;
        }


        body.sidebar-collapsed #app-sidebar [data-sidebar-label],
        body.sidebar-collapsed #app-sidebar [data-sidebar-brand-text],
        body.sidebar-collapsed #app-sidebar [data-sidebar-footer-label] {
            display: none;
        }


        body.sidebar-collapsed #app-sidebar .hub-sidebar-brand {
            flex-direction: column;
            justify-content: center;

            gap: 8px;

            min-height: 112px;

            padding:
                13px
                12px;
        }


        body.sidebar-collapsed #app-sidebar .hub-sidebar-brand-link {
            justify-content: center;

            gap: 0;
        }


        body.sidebar-collapsed #app-sidebar .hub-sidebar-control {
            margin-left: 0;
        }


        body.sidebar-collapsed #app-sidebar .hub-collapse-direction {
            transform:
                rotate(
                    180deg
                );
        }


        body.sidebar-collapsed #app-sidebar .hub-sidebar-nav {
            padding:
                10px
                10px
                8px;
        }


        body.sidebar-collapsed #app-sidebar .hub-sidebar-link {
            justify-content: center;

            gap: 0;

            min-height: 50px;

            padding:
                6px
                0;
        }


        body.sidebar-collapsed #app-sidebar .hub-sidebar-link.is-active::before {
            left: -3px;
        }


        body.sidebar-collapsed #app-sidebar a.hub-sidebar-link:hover {
            transform: none;
        }


        body.sidebar-collapsed #app-sidebar a.hub-sidebar-link:hover
        .hub-sidebar-icon {
            transform:
                translateY(
                    -1px
                );
        }


        body.sidebar-collapsed #app-sidebar .hub-sidebar-footer {
            margin:
                0
                10px;

            padding:
                10px
                0
                12px;
        }


        body.sidebar-collapsed #app-sidebar .hub-sidebar-logout {
            justify-content: center;

            gap: 0;

            min-height: 50px;

            padding:
                7px
                0;
        }
    }


    /* ============================================================
       COMPACT DESKTOP
       ============================================================ */

    @media (min-width: 1024px) and (max-width: 1279px) {
        #app-sidebar {
            width: 84px;

            transform: translateX(0);
        }


        #app-main {
            padding-left: 84px;
        }


        #app-sidebar [data-sidebar-label],
        #app-sidebar [data-sidebar-brand-text],
        #app-sidebar [data-sidebar-footer-label] {
            display: none;
        }


        #app-sidebar .hub-sidebar-brand {
            justify-content: center;

            min-height: 82px;

            padding:
                12px;
        }


        #app-sidebar .hub-sidebar-brand-link {
            justify-content: center;

            gap: 0;
        }


        #app-sidebar .hub-sidebar-nav {
            padding:
                10px
                10px
                8px;
        }


        #app-sidebar .hub-sidebar-link {
            justify-content: center;

            gap: 0;

            min-height: 50px;

            padding:
                6px
                0;
        }


        #app-sidebar .hub-sidebar-link.is-active::before {
            left: -3px;
        }


        #app-sidebar a.hub-sidebar-link:hover {
            transform: none;
        }


        #app-sidebar a.hub-sidebar-link:hover
        .hub-sidebar-icon {
            transform:
                translateY(
                    -1px
                );
        }


        #app-sidebar .hub-sidebar-footer {
            margin:
                0
                10px;

            padding:
                10px
                0
                12px;
        }


        #app-sidebar .hub-sidebar-logout {
            justify-content: center;

            gap: 0;

            min-height: 50px;

            padding:
                7px
                0;
        }
    }


    /* ============================================================
       MOBILE / TABLET
       ============================================================ */

    @media (max-width: 1023px) {
        #app-sidebar {
            width: 272px;

            max-width:
                calc(
                    100vw
                    -
                    24px
                );

            background:
                radial-gradient(
                    circle at 12% 4%,
                    rgba(246, 198, 226, 0.34),
                    transparent 25%
                ),
                radial-gradient(
                    circle at 92% 92%,
                    rgba(141, 225, 231, 0.28),
                    transparent 34%
                ),
                linear-gradient(
                    165deg,
                    #eff7fa,
                    #e9f3f7
                );

            box-shadow:
                10px 0 26px rgba(44, 73, 94, 0.16),
                inset -1px 0 0 rgba(255, 255, 255, 0.72);

            transform: translateX(0);
        }


        #app-sidebar[class~="-translate-x-full"] {
            transform: translateX(-100%);
        }


        #app-main {
            padding-left: 0;
        }


        #app-sidebar [data-sidebar-label],
        #app-sidebar [data-sidebar-brand-text],
        #app-sidebar [data-sidebar-footer-label] {
            display: block;
        }


        #app-sidebar .hub-sidebar-brand {
            min-height: 82px;

            padding:
                14px;
        }


        #app-sidebar #close-sidebar {
            display: inline-flex;
        }


        #app-sidebar .hub-sidebar-nav {
            padding:
                10px
                12px
                8px;
        }


        #app-sidebar .hub-sidebar-link {
            min-height: 50px;
        }


        #app-sidebar .hub-sidebar-logout {
            justify-content: flex-start;

            gap: 10px;

            padding:
                7px
                11px;
        }
    }


    /* ============================================================
       SMALL MOBILE
       ============================================================ */

    @media (max-width: 480px) {
        #app-sidebar {
            width:
                min(
                    278px,
                    calc(
                        100vw
                        -
                        20px
                    )
                );
        }


        #app-sidebar .hub-sidebar-brand-copy strong {
            font-size: 21px;
        }


        #app-sidebar .hub-sidebar-logo {
            width: 43px;
            height: 43px;

            flex-basis: 43px;
        }


        #app-sidebar .hub-sidebar-logo img {
            width: 34px;
            height: 34px;
        }


        .hub-logout-dialog-actions {
            flex-direction: column-reverse;
        }


        .hub-logout-modal-button {
            width: 100%;
        }
    }


    /* ============================================================
       REDUCED MOTION
       ============================================================ */

    @media (prefers-reduced-motion: reduce) {
        #app-sidebar,
        #app-main,
        #app-sidebar .hub-collapse-direction,
        #app-sidebar .hub-sidebar-link,
        #app-sidebar .hub-sidebar-control,
        #app-sidebar .hub-sidebar-icon,
        #app-sidebar .hub-sidebar-logout,
        .hub-logout-modal-button {
            transition: none;
        }
    }
</style>
@endonce


<aside
    id="app-sidebar"
    class="-translate-x-full"
    aria-label="Workspace sidebar"
>
    {{-- ============================================================
         BRAND
         ============================================================ --}}

    <div
        class="hub-sidebar-brand"
        data-sidebar-brand
    >
        <a
            class="hub-sidebar-brand-link"
            href="{{ route('dashboard') }}"
            aria-label="PULSO Logistics Hub dashboard"
        >
            <span class="hub-sidebar-logo">
                <img
                    src="{{ asset('images/pulso-logo.png') }}"
                    alt=""
                    width="36"
                    height="36"
                >
            </span>


            <span
                class="hub-sidebar-brand-copy"
                data-sidebar-brand-text
            >
                <strong>
                    PULSO
                </strong>

                <small>
                    Logistics Hub
                </small>
            </span>
        </a>


        <button
            class="hub-sidebar-control"
            id="toggle-sidebar-collapse"
            type="button"
            aria-label="Collapse sidebar"
            aria-controls="app-sidebar"
            aria-expanded="true"
            title="Collapse sidebar"
        >
            <svg
                id="sidebar-collapse-icon"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.7"
                stroke-linecap="round"
                stroke-linejoin="round"
                aria-hidden="true"
            >
                <rect
                    x="3"
                    y="4"
                    width="18"
                    height="16"
                    rx="3"
                />

                <path d="M9 4v16"/>

                <g class="hub-collapse-direction">
                    <path d="m17 9-3 3 3 3"/>
                </g>
            </svg>
        </button>


        <button
            class="hub-sidebar-control"
            id="close-sidebar"
            type="button"
            aria-label="Close navigation"
            aria-controls="app-sidebar"
            title="Close navigation"
        >
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round"
                aria-hidden="true"
            >
                <path d="m6 6 12 12"/>
                <path d="M18 6 6 18"/>
            </svg>
        </button>
    </div>


    {{-- ============================================================
         NAVIGATION
         ============================================================ --}}

    <nav
        class="hub-sidebar-nav"
        aria-label="Workspace navigation"
    >
        <ul class="hub-sidebar-list">

            @foreach ($sidebarItems as $item)

                <li>

                    @if ($item['route'])

                        <a
                            class="hub-sidebar-link {{ $item['active'] ? 'is-active' : '' }}"
                            href="{{ route($item['route']) }}"
                            title="{{ $item['label'] }}"
                            aria-label="{{ $item['label'] }}"
                            data-sidebar-link

                            @if ($item['active'])
                                aria-current="page"
                            @endif
                        >

                    @else

                        <span
                            class="hub-sidebar-link is-disabled"
                            title="{{ $item['label'] }} — Coming soon"
                            aria-label="{{ $item['label'] }} — Coming soon"
                            aria-disabled="true"
                            data-sidebar-link
                        >

                    @endif


                    <span
                        class="hub-sidebar-icon"
                        aria-hidden="true"
                    >
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.7"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >

                            @switch($item['icon'])

                                @case('dashboard')

                                    <path d="m3 10 9-7 9 7"/>
                                    <path d="M5 9v12h14V9"/>
                                    <path d="M9 21v-8h6v8"/>

                                    @break


                                @case('inventory')

                                    <path d="m12 3 9 5-9 5-9-5 9-5Z"/>
                                    <path d="M3 8v9l9 5 9-5V8"/>
                                    <path d="M12 13v9"/>
                                    <path d="M7.5 5.5l9 5"/>

                                    @break


                                @case('requests')

                                    <rect
                                        x="5"
                                        y="3"
                                        width="14"
                                        height="18"
                                        rx="2"
                                    />

                                    <path d="M9 7h6"/>
                                    <path d="M9 11h6"/>
                                    <path d="M9 15h4"/>

                                    @break


                                @case('borrow')

                                    <path d="M4 7h15"/>
                                    <path d="m15 3 4 4-4 4"/>
                                    <path d="M20 17H5"/>
                                    <path d="m9 13-4 4 4 4"/>

                                    @break


                                @case('projects')

                                    <path
                                        d="M3 7a2 2 0 0 1 2-2h5l2 2h7a2 2 0 0 1 2 2v10H3Z"
                                    />

                                    <path d="M12 11v6"/>
                                    <path d="M9 14h6"/>

                                    @break


                                @case('donations')

                                    <path d="M4 10h16v10H4Z"/>
                                    <path d="M3 7h18v3H3Z"/>
                                    <path d="M12 7v13"/>

                                    <path d="M12 7c-3 0-5-1.2-5-3 0-1.2 1-2 2.2-2C11 2 12 4 12 7Z"/>

                                    <path d="M12 7c3 0 5-1.2 5-3 0-1.2-1-2-2.2-2C13 2 12 4 12 7Z"/>

                                    @break


                                @case('reports')

                                    <path d="M4 3v18h17"/>
                                    <path d="M8 16v-5"/>
                                    <path d="M12 16V7"/>
                                    <path d="M16 16V8"/>
                                    <path d="M20 16v-3"/>

                                    @break

                            @endswitch

                        </svg>
                    </span>


                    <span
                        class="hub-sidebar-link-copy"
                        data-sidebar-label
                    >
                        <span class="hub-sidebar-link-title">
                            {{ $item['label'] }}
                        </span>


                        @if (!$item['route'])

                            <small class="hub-sidebar-soon">
                                Soon
                            </small>

                        @endif
                    </span>


                    @if ($item['route'])

                        </a>

                    @else

                        </span>

                    @endif

                </li>

            @endforeach

        </ul>
    </nav>


    {{-- ============================================================
         LOGOUT
         ============================================================ --}}

    <div class="hub-sidebar-footer">

        <button
            class="hub-sidebar-logout"
            id="sidebar-logout-button"
            type="button"
            aria-haspopup="dialog"
            aria-controls="sidebar-logout-modal"
            title="Logout"
        >
            <span
                class="hub-sidebar-logout-icon"
                aria-hidden="true"
            >
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="M10 5H5v14h5"/>
                    <path d="M14 8l4 4-4 4"/>
                    <path d="M18 12H9"/>
                </svg>
            </span>


            <span
                class="hub-sidebar-logout-label"
                data-sidebar-footer-label
            >
                Logout
            </span>
        </button>


        @if ($hasLogoutRoute)

            <form
                id="sidebar-logout-form"
                method="POST"
                action="{{ route('logout') }}"
                hidden
            >
                @csrf
            </form>

        @endif

    </div>
</aside>


{{-- ================================================================
     LOGOUT MODAL
     ================================================================ --}}

<div
    class="hub-logout-modal"
    id="sidebar-logout-modal"
    role="dialog"
    aria-modal="true"
    aria-labelledby="sidebar-logout-title"
    aria-describedby="sidebar-logout-description"
    hidden
>
    <button
        class="hub-logout-backdrop"
        type="button"
        data-sidebar-logout-close
        tabindex="-1"
        aria-label="Close logout confirmation"
    ></button>


    <section
        class="hub-logout-dialog"
        role="document"
    >
        <div class="hub-logout-dialog-header">

            <span
                class="hub-logout-dialog-icon"
                aria-hidden="true"
            >
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="M10 5H5v14h5"/>
                    <path d="M14 8l4 4-4 4"/>
                    <path d="M18 12H9"/>
                </svg>
            </span>


            <div class="hub-logout-dialog-copy">

                <h2 id="sidebar-logout-title">
                    Logout from Logistics Hub?
                </h2>

                <p id="sidebar-logout-description">
                    Are you sure you want to end your current session
                    and return to the login page?
                </p>

            </div>


            <button
                class="hub-logout-close"
                type="button"
                data-sidebar-logout-close
                aria-label="Close confirmation"
            >
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="m6 6 12 12"/>
                    <path d="M18 6 6 18"/>
                </svg>
            </button>

        </div>


        <div class="hub-logout-dialog-actions">

            <button
                class="
                    hub-logout-modal-button
                    hub-logout-cancel
                "
                type="button"
                data-sidebar-logout-close
            >
                Cancel
            </button>


            <button
                class="
                    hub-logout-modal-button
                    hub-logout-confirm
                "
                id="sidebar-confirm-logout"
                type="button"
            >
                Yes, Logout
            </button>

        </div>
    </section>
</div>


@once
<script>
(() => {
    const initializeSidebarLogout = () => {
        const openButton =
            document.getElementById(
                'sidebar-logout-button'
            );


        const modal =
            document.getElementById(
                'sidebar-logout-modal'
            );


        const confirmButton =
            document.getElementById(
                'sidebar-confirm-logout'
            );


        const logoutForm =
            document.getElementById(
                'sidebar-logout-form'
            );


        if (
            !openButton ||
            !modal ||
            !confirmButton
        ) {
            return;
        }


        if (
            modal.dataset.initialized ===
                'true'
        ) {
            return;
        }


        modal.dataset.initialized =
            'true';


        let lastFocusedElement =
            null;


        const closeButtons =
            Array.from(
                modal.querySelectorAll(
                    '[data-sidebar-logout-close]'
                )
            );


        const getFocusableElements = () => {
            return Array.from(
                modal.querySelectorAll(
                    [
                        'button:not([disabled])',
                        'a[href]',
                        'input:not([disabled])',
                        'select:not([disabled])',
                        'textarea:not([disabled])',
                        '[tabindex]:not([tabindex="-1"])'
                    ].join(',')
                )
            );
        };


        const openModal = () => {
            lastFocusedElement =
                document.activeElement;


            modal.hidden =
                false;


            document.body.classList.add(
                'hub-logout-modal-open'
            );


            window.requestAnimationFrame(
                () => {
                    const focusable =
                        getFocusableElements();


                    (
                        focusable[0]
                        ||
                        confirmButton
                    ).focus();
                }
            );
        };


        const closeModal = () => {
            modal.hidden =
                true;


            document.body.classList.remove(
                'hub-logout-modal-open'
            );


            if (
                lastFocusedElement &&
                typeof lastFocusedElement.focus ===
                    'function'
            ) {
                lastFocusedElement.focus();
            }
        };


        const logout = () => {
            confirmButton.disabled =
                true;


            confirmButton.textContent =
                'Logging out...';


            if (
                logoutForm
            ) {
                logoutForm.submit();

                return;
            }


            window.location.href =
                @json(route('login'));
        };


        openButton.addEventListener(
            'click',
            openModal
        );


        closeButtons.forEach(
            (button) => {
                button.addEventListener(
                    'click',
                    closeModal
                );
            }
        );


        confirmButton.addEventListener(
            'click',
            logout
        );


        document.addEventListener(
            'keydown',
            (event) => {
                if (
                    modal.hidden
                ) {
                    return;
                }


                if (
                    event.key ===
                        'Escape'
                ) {
                    event.preventDefault();

                    closeModal();

                    return;
                }


                if (
                    event.key !==
                        'Tab'
                ) {
                    return;
                }


                const focusable =
                    getFocusableElements();


                if (
                    focusable.length ===
                        0
                ) {
                    event.preventDefault();

                    return;
                }


                const first =
                    focusable[0];


                const last =
                    focusable[
                        focusable.length
                        - 1
                    ];


                if (
                    event.shiftKey &&
                    document.activeElement ===
                        first
                ) {
                    event.preventDefault();

                    last.focus();

                    return;
                }


                if (
                    !event.shiftKey &&
                    document.activeElement ===
                        last
                ) {
                    event.preventDefault();

                    first.focus();
                }
            }
        );
    };


    if (
        document.readyState ===
            'loading'
    ) {
        document.addEventListener(
            'DOMContentLoaded',
            initializeSidebarLogout,
            {
                once: true
            }
        );
    } else {
        initializeSidebarLogout();
    }
})();
</script>
@endonce