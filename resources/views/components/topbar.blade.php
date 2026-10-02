@php
    /*
    |--------------------------------------------------------------------------
    | PAGE CONTEXT
    |--------------------------------------------------------------------------
    */

    $topbarTitle = 'Dashboard';
    $topbarParent = null;
    $topbarParentUrl = null;
    $topbarIcon = 'dashboard';


    /*
    |--------------------------------------------------------------------------
    | INVENTORY & ASSETS
    |--------------------------------------------------------------------------
    */

    if (request()->routeIs('inventory.*')) {
        $topbarTitle = 'Inventory & Assets';
        $topbarIcon = 'inventory';

        if (request()->routeIs('inventory.create')) {
            $topbarTitle = 'Add Asset';
        } elseif (request()->routeIs('inventory.show')) {
            $topbarTitle = 'Asset Details';
        } elseif (request()->routeIs('inventory.edit')) {
            $topbarTitle = 'Edit Asset';
        }

        if (!request()->routeIs('inventory.index')) {
            $topbarParent = 'Inventory & Assets';
            $topbarParentUrl = route('inventory.index');
        }
    }


    /*
    |--------------------------------------------------------------------------
    | LOGISTICS REQUESTS
    |--------------------------------------------------------------------------
    */

    elseif (request()->routeIs('requests.*')) {
        $topbarTitle = 'Logistics Requests';
        $topbarIcon = 'requests';

        if (request()->routeIs('requests.create')) {
            $topbarTitle = 'New Request';
        } elseif (request()->routeIs('requests.show')) {
            $topbarTitle = 'Request Details';
        }

        if (!request()->routeIs('requests.index')) {
            $topbarParent = 'Logistics Requests';
            $topbarParentUrl = route('requests.index');
        }
    }


    /*
    |--------------------------------------------------------------------------
    | BORROW & RETURN
    |--------------------------------------------------------------------------
    */

    elseif (request()->routeIs('borrow.*')) {
        $topbarTitle = 'Borrow & Return';
        $topbarIcon = 'borrow';

        if (request()->routeIs('borrow.show')) {
            $topbarTitle = 'Borrowing Details';
            $topbarParent = 'Borrow & Return';
            $topbarParentUrl = route('borrow.index');
        }
    }


    /*
    |--------------------------------------------------------------------------
    | PROJECTS
    |--------------------------------------------------------------------------
    */

    elseif (request()->routeIs('projects.*')) {
        $topbarTitle = 'Projects';
        $topbarIcon = 'projects';

        if (request()->routeIs('projects.show')) {
            $topbarTitle = 'Project Details';
        }

        if (!request()->routeIs('projects.index')) {
            $topbarParent = 'Projects';
            $topbarParentUrl = route('projects.index');
        }
    }


    /*
    |--------------------------------------------------------------------------
    | DONATIONS
    |--------------------------------------------------------------------------
    */

    elseif (request()->routeIs('donations.*')) {
        $topbarTitle = 'Donations';
        $topbarIcon = 'donations';

        if (request()->routeIs('donations.show')) {
            $topbarTitle = 'Donation Details';
        }

        if (!request()->routeIs('donations.index')) {
            $topbarParent = 'Donations';
            $topbarParentUrl = route('donations.index');
        }
    }


    /*
    |--------------------------------------------------------------------------
    | REPORTS & HISTORY
    |--------------------------------------------------------------------------
    */

    elseif (request()->routeIs('reports.*')) {
        $topbarTitle = 'Reports & History';
        $topbarIcon = 'reports';

        if (request()->routeIs('reports.inventory')) {
            $topbarTitle = 'Inventory Report';
        } elseif (request()->routeIs('reports.requests')) {
            $topbarTitle = 'Requests Report';
        } elseif (request()->routeIs('reports.borrow')) {
            $topbarTitle = 'Borrow & Return Report';
        } elseif (request()->routeIs('reports.projects')) {
            $topbarTitle = 'Projects Report';
        } elseif (request()->routeIs('reports.donations')) {
            $topbarTitle = 'Donations Report';
        } elseif (request()->routeIs('reports.activity')) {
            $topbarTitle = 'Activity History';
        }

        if (!request()->routeIs('reports.index')) {
            $topbarParent = 'Reports & History';
            $topbarParentUrl = route('reports.index');
        }
    }


    /*
    |--------------------------------------------------------------------------
    | USER / DATE
    |--------------------------------------------------------------------------
    */

    $topbarDate = now('Asia/Manila');

    $topbarUser =
        session()->get(
            'logistics_user',
            [
                'name' => 'Paul Roldan',
                'role' => 'Logistics Head',
                'initials' => 'PR',
            ]
        );

    $topbarUserName =
        $topbarUser['name'] ??
        'Paul Roldan';

    $topbarUserRole =
        $topbarUser['role'] ??
        'Logistics Head';

    $topbarUserInitials =
        $topbarUser['initials'] ??
        'PR';
@endphp


@once
<style>
    /* ================================================================
       TOPBAR BASE
       ================================================================ */

    .pulso-topbar,
    .pulso-topbar *,
    .pulso-topbar *::before,
    .pulso-topbar *::after {
        box-sizing: border-box;
    }


    .pulso-topbar {
        position: sticky;
        top: 0;
        z-index: 40;

        width: 100%;

        border-bottom:
            1px
            solid
            rgba(255, 255, 255, 0.95);

        background:
            rgba(
                245,
                251,
                254,
                0.94
            );

        color: #10263d;

        box-shadow:
            0
            6px
            18px
            rgba(69, 102, 123, 0.055);

        backdrop-filter:
            blur(
                22px
            );

        -webkit-backdrop-filter:
            blur(
                22px
            );
    }


    .pt-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 18px;

        width: 100%;
        min-width: 0;
        min-height: 82px;

        padding:
            14px
            28px;
    }


    .pulso-topbar svg {
        display: block;

        fill: none;

        stroke: currentColor;
        stroke-linecap: round;
        stroke-linejoin: round;

        flex-shrink: 0;
    }


    /* ================================================================
       LEFT
       ================================================================ */

    .pt-left,
    .pt-location,
    .pt-breadcrumb {
        display: flex;
        align-items: center;
    }


    .pt-left {
        flex: 1;

        min-width: 0;

        gap: 13px;
    }


    .pt-location {
        flex: 1;

        min-width: 0;

        gap: 13px;
    }


    /* ================================================================
       BUTTON BASE
       ================================================================ */

    .pulso-topbar .pt-icon-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        width: 42px;
        height: 42px;

        flex: 0 0 42px;

        margin: 0;
        padding: 0;

        border:
            1px
            solid
            rgba(255, 255, 255, 0.96);

        border-radius: 14px;

        background:
            linear-gradient(
                145deg,
                #f7fbfd,
                #e4eef3
            );

        color: #496580;

        box-shadow:
            4px
            5px
            11px
            rgba(68, 106, 130, 0.09),
            -3px
            -3px
            8px
            rgba(255, 255, 255, 0.84);

        font: inherit;

        cursor: pointer;

        transition:
            color 160ms ease,
            background 160ms ease,
            transform 160ms ease,
            box-shadow 160ms ease;
    }


    .pulso-topbar .pt-icon-button:hover {
        color: #007780;

        background:
            linear-gradient(
                145deg,
                #f9fdfe,
                #deedf1
            );

        transform:
            translateY(
                -1px
            );
    }


    .pulso-topbar .pt-icon-button svg {
        width: 20px;
        height: 20px;

        stroke-width: 1.8;
    }


    /* ================================================================
       MOBILE MENU
       ================================================================ */

    .pulso-topbar .pt-mobile-menu {
        display: none;
    }


    /* ================================================================
       PAGE ICON
       ================================================================ */

    .pt-page-icon {
        display: grid;
        place-items: center;

        width: 45px;
        height: 45px;

        flex: 0 0 45px;

        border:
            1px
            solid
            #ffffff;

        border-radius: 14px;

        background:
            linear-gradient(
                145deg,
                #e3f8fa,
                #caedf0
            );

        color: #007780;

        box-shadow:
            4px
            5px
            11px
            rgba(70, 120, 139, 0.09),
            -3px
            -3px
            8px
            rgba(255, 255, 255, 0.78);
    }


    .pt-page-icon svg {
        width: 22px;
        height: 22px;

        stroke-width: 1.75;
    }


    /* ================================================================
       PAGE INFO
       ================================================================ */

    .pt-location-copy {
        flex: 1;

        min-width: 0;
    }


    .pt-workspace-label {
        display: block;

        margin-bottom: 5px;

        overflow: hidden;

        color: #597b94;

        font-size: 10px;
        font-weight: 800;
        line-height: 1.2;

        letter-spacing: 0.12em;

        text-overflow: ellipsis;
        text-transform: uppercase;

        white-space: nowrap;
    }


    .pt-breadcrumb {
        min-width: 0;

        gap: 9px;
    }


    .pulso-topbar .pt-parent {
        min-width: 0;

        overflow: hidden;

        color: #496580;

        font-size: 13px;
        font-weight: 500;

        text-decoration: none;

        text-overflow: ellipsis;

        white-space: nowrap;
    }


    .pulso-topbar .pt-parent:hover {
        color: #007780;
    }


    .pt-breadcrumb-separator {
        width: 14px;
        height: 14px;

        color: #8aa0b0;

        stroke-width: 1.8;
    }


    .pt-current {
        min-width: 0;

        overflow: hidden;

        color: #10263d;

        font-size: 18px;
        font-weight: 800;
        line-height: 1.25;

        letter-spacing: -0.035em;

        text-overflow: ellipsis;

        white-space: nowrap;
    }


    /* ================================================================
       RIGHT
       ================================================================ */

    .pt-right {
        display: flex;
        align-items: center;

        gap: 9px;

        flex-shrink: 0;

        margin-left: auto;
    }


    /* ================================================================
       DATE
       ================================================================ */

    .pt-date {
        display: flex;
        align-items: center;

        gap: 8px;

        min-height: 42px;

        padding:
            6px
            10px;

        border:
            1px
            solid
            rgba(255, 255, 255, 0.92);

        border-radius: 13px;

        background:
            linear-gradient(
                145deg,
                #eef6f9,
                #e4eff3
            );

        box-shadow:
            inset
            2px
            2px
            5px
            rgba(76, 109, 129, 0.045),
            inset
            -2px
            -2px
            5px
            rgba(255, 255, 255, 0.7);
    }


    .pt-date-icon {
        display: grid;
        place-items: center;

        width: 27px;
        height: 27px;

        flex: 0 0 27px;

        border-radius: 9px;

        background:
            linear-gradient(
                145deg,
                #dff5f6,
                #cee9eb
            );

        color: #007780;
    }


    .pt-date-icon svg {
        width: 14px;
        height: 14px;

        stroke-width: 1.8;
    }


    .pt-date-copy {
        display: grid;

        gap: 1px;
    }


    .pt-date-day {
        color: #34536a;

        font-size: 9px;
        font-weight: 800;

        white-space: nowrap;
    }


    .pt-date-full {
        color: #7c92a2;

        font-size: 8px;

        white-space: nowrap;
    }


    /* ================================================================
       DETAILS / POPOVERS
       ================================================================ */

    .pt-popover {
        position: relative;

        flex-shrink: 0;

        margin: 0;
    }


    .pt-popover > summary {
        list-style: none;
    }


    .pt-popover > summary::-webkit-details-marker {
        display: none;
    }


    .pt-popover > summary::marker {
        content: "";
    }


    .pt-popover-summary {
        display: flex;
        align-items: center;
        justify-content: center;

        cursor: pointer;
    }


    .pt-popover-panel {
        position: absolute;

        top:
            calc(
                100%
                +
                10px
            );

        right: 0;
        z-index: 90;

        width: 310px;
        max-width:
            calc(
                100vw
                -
                24px
            );

        overflow: hidden;

        border:
            1px
            solid
            rgba(255, 255, 255, 0.96);

        border-radius: 17px;

        background:
            linear-gradient(
                145deg,
                #f8fcfd,
                #e8f1f5
            );

        box-shadow:
            10px
            14px
            30px
            rgba(42, 71, 89, 0.18),
            -4px
            -4px
            12px
            rgba(255, 255, 255, 0.72);
    }


    .pt-popover-header {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 12px;

        padding:
            14px
            15px;

        border-bottom:
            1px
            solid
            rgba(207, 224, 233, 0.8);
    }


    .pt-popover-header strong {
        color: #29475f;

        font-size: 11.5px;
        font-weight: 800;
    }


    .pt-popover-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-width: 23px;
        height: 23px;

        padding:
            0
            7px;

        border-radius: 8px;

        background:
            linear-gradient(
                145deg,
                #f9e0ec,
                #efd0df
            );

        color: #b90c61;

        font-size: 9px;
        font-weight: 800;
    }


    /* ================================================================
       NOTIFICATION
       ================================================================ */

    .pt-notification-button {
        position: relative;
    }


    .pt-notification-dot {
        position: absolute;

        top: 7px;
        right: 7px;

        width: 7px;
        height: 7px;

        border:
            2px
            solid
            #eef6f9;

        border-radius: 50%;

        background: #ee1280;

        box-shadow:
            0
            1px
            4px
            rgba(185, 12, 97, 0.2);
    }


    .pt-notification-list {
        display: grid;
    }


    .pt-notification {
        display: flex;
        align-items: flex-start;

        gap: 10px;

        padding:
            12px
            14px;

        border-bottom:
            1px
            solid
            rgba(214, 228, 236, 0.7);
    }


    .pt-notification:last-child {
        border-bottom: 0;
    }


    .pt-notification-icon {
        display: grid;
        place-items: center;

        width: 32px;
        height: 32px;

        flex: 0 0 32px;

        border-radius: 10px;

        background:
            linear-gradient(
                145deg,
                #e1f5f6,
                #cfeaed
            );

        color: #007780;
    }


    .pt-notification-icon.is-pink {
        background:
            linear-gradient(
                145deg,
                #fae8f1,
                #efd4e1
            );

        color: #b90c61;
    }


    .pt-notification-icon.is-amber {
        background:
            linear-gradient(
                145deg,
                #fff3df,
                #f6e2c1
            );

        color: #895408;
    }


    .pt-notification-icon svg {
        width: 14px;
        height: 14px;

        stroke-width: 1.8;
    }


    .pt-notification-copy {
        min-width: 0;
    }


    .pt-notification-title {
        display: block;

        color: #29475f;

        font-size: 10px;
        font-weight: 800;
        line-height: 1.4;
    }


    .pt-notification-text {
        display: block;

        margin-top: 2px;

        color: #71899c;

        font-size: 9px;
        line-height: 1.5;
    }


    .pt-notification-time {
        display: block;

        margin-top: 5px;

        color: #9aabba;

        font-size: 8px;
    }


    /* ================================================================
       PROFILE
       ================================================================ */

    .pt-profile-trigger {
        display: flex;
        align-items: center;

        gap: 8px;

        min-height: 42px;

        padding:
            5px
            8px
            5px
            6px;

        border:
            1px
            solid
            rgba(255, 255, 255, 0.94);

        border-radius: 14px;

        background:
            linear-gradient(
                145deg,
                #f8fcfd,
                #e6f0f4
            );

        box-shadow:
            4px
            5px
            10px
            rgba(78, 110, 130, 0.08),
            -3px
            -3px
            7px
            rgba(255, 255, 255, 0.74);
    }


    .pt-profile-avatar {
        display: grid;
        place-items: center;

        width: 32px;
        height: 32px;

        flex: 0 0 32px;

        border:
            1px
            solid
            rgba(255, 255, 255, 0.9);

        border-radius: 10px;

        background:
            linear-gradient(
                145deg,
                #fae6f0,
                #efd1df
            );

        color: #b90c61;

        font-size: 9px;
        font-weight: 900;
    }


    .pt-profile-copy {
        min-width: 0;

        text-align: left;
    }


    .pt-profile-name {
        display: block;

        max-width: 110px;

        overflow: hidden;

        color: #29475f;

        font-size: 9.5px;
        font-weight: 800;

        text-overflow: ellipsis;

        white-space: nowrap;
    }


    .pt-profile-role {
        display: block;

        margin-top: 2px;

        color: #8397a6;

        font-size: 8px;

        white-space: nowrap;
    }


    .pt-profile-chevron {
        width: 13px;
        height: 13px;

        color: #8599a8;

        stroke-width: 2;

        transition:
            transform 160ms ease;
    }


    .pt-popover[open]
    .pt-profile-chevron {
        transform:
            rotate(
                180deg
            );
    }


    /* ================================================================
       PROFILE PANEL
       ================================================================ */

    .pt-profile-panel {
        width: 240px;
    }


    .pt-profile-card {
        display: flex;
        align-items: center;

        gap: 11px;

        padding:
            14px
            15px;

        border-bottom:
            1px
            solid
            rgba(207, 224, 233, 0.8);
    }


    .pt-profile-card-avatar {
        display: grid;
        place-items: center;

        width: 40px;
        height: 40px;

        flex: 0 0 40px;

        border-radius: 12px;

        background:
            linear-gradient(
                145deg,
                #fae5ef,
                #efd0de
            );

        color: #b90c61;

        font-size: 10px;
        font-weight: 900;
    }


    .pt-profile-card-copy {
        min-width: 0;
    }


    .pt-profile-card-name {
        display: block;

        color: #29475f;

        font-size: 10.5px;
        font-weight: 800;
    }


    .pt-profile-card-role {
        display: block;

        margin-top: 2px;

        color: #8296a5;

        font-size: 8.5px;
    }


    .pt-profile-menu {
        display: grid;

        padding: 7px;
    }


    .pt-profile-menu-item {
        display: flex;
        align-items: center;

        gap: 9px;

        min-height: 38px;

        padding:
            7px
            9px;

        border: 0;
        border-radius: 10px;

        background: transparent;

        color: #516d81;

        text-decoration: none;

        font: inherit;
        font-size: 9.5px;
        font-weight: 700;

        cursor: pointer;
    }


    .pt-profile-menu-item:hover {
        background:
            rgba(255, 255, 255, 0.52);

        color: #007780;
    }


    .pt-profile-menu-item.is-logout {
        width: 100%;

        text-align: left;
    }


    .pt-profile-menu-item.is-logout:hover {
        color: #b90c61;
    }


    .pt-profile-menu-item svg {
        width: 15px;
        height: 15px;

        stroke-width: 1.8;
    }


    /* ================================================================
       SIDEBAR MOBILE BACKDROP
       ================================================================ */

    #sidebar-backdrop {
        position: fixed;
        inset: 0;
        z-index: 49;

        display: none;

        background:
            rgba(16, 38, 61, 0.32);

        backdrop-filter:
            blur(
                2px
            );

        -webkit-backdrop-filter:
            blur(
                2px
            );
    }


    #sidebar-backdrop.is-visible {
        display: block;
    }


    body.hub-mobile-sidebar-open {
        overflow: hidden;
    }


    /* ================================================================
       FOCUS
       ================================================================ */

    .pulso-topbar button:focus-visible,
    .pulso-topbar summary:focus-visible,
    .pulso-topbar a:focus-visible {
        outline:
            3px
            solid
            rgba(5, 173, 182, 0.28);

        outline-offset: 3px;
    }


    /* ================================================================
       TABLET
       ================================================================ */

    @media (max-width: 1180px) {
        .pt-date-copy {
            display: none;
        }


        .pt-date {
            width: 40px;
            height: 40px;

            min-height: 40px;

            padding: 5px;

            justify-content: center;
        }
    }


    /* ================================================================
       MOBILE DRAWER MODE
       ================================================================ */

    @media (max-width: 1023px) {
        .pt-inner {
            min-height: 72px;

            padding:
                11px
                18px;
        }


        .pulso-topbar
        .pt-mobile-menu {
            display: inline-flex;
        }


        .pt-right {
            gap: 7px;
        }
    }


    /* ================================================================
       MOBILE
       ================================================================ */

    @media (max-width: 720px) {
        .pt-inner {
            gap: 10px;

            min-height: 68px;

            padding:
                9px
                12px;
        }


        .pt-left {
            gap: 10px;
        }


        /*
        |----------------------------------------------------------
        | Hide the desktop visual extras.
        | Hamburger + text is enough on mobile.
        |----------------------------------------------------------
        */

        .pt-page-icon {
            display: none !important;
        }


        .pt-date {
            display: none !important;
        }


        .pulso-topbar
        .pt-parent,
        .pt-breadcrumb-separator {
            display: none !important;
        }


        /*
        |----------------------------------------------------------
        | Important:
        | Profile must become ONE square avatar.
        |----------------------------------------------------------
        */

        .pulso-topbar
        .pt-profile-copy,
        .pulso-topbar
        .pt-profile-chevron {
            display: none !important;
        }


        .pt-profile-trigger {
            display: grid;

            place-items: center;

            width: 40px;
            height: 40px;

            min-height: 40px;

            padding: 3px;

            border-radius: 13px;
        }


        .pt-profile-avatar {
            width: 31px;
            height: 31px;

            flex-basis: 31px;

            border-radius: 10px;
        }


        .pulso-topbar
        .pt-icon-button {
            width: 40px;
            height: 40px;

            flex: 0 0 40px;

            border-radius: 13px;
        }


        .pt-location-copy {
            max-width: none;
        }


        .pt-workspace-label {
            margin-bottom: 3px;

            font-size: 8.5px;

            letter-spacing: 0.1em;
        }


        .pt-current {
            max-width:
                calc(
                    100vw
                    -
                    176px
                );

            font-size: 17px;

            text-overflow: ellipsis;

            white-space: nowrap;
        }


        /*
        |----------------------------------------------------------
        | Mobile popovers become fixed overlays below the topbar.
        |----------------------------------------------------------
        */

        .pt-popover-panel {
            position: fixed;

            top: 76px;
            right: 10px;
            left: 10px;

            width: auto;
            max-width: none;
        }


        .pt-profile-panel {
            right: 10px;
            left: auto;

            width:
                min(
                    240px,
                    calc(
                        100vw
                        -
                        20px
                    )
                );
        }
    }


    /* ================================================================
       SMALL MOBILE
       ================================================================ */

    @media (max-width: 430px) {
        .pt-inner {
            gap: 8px;

            min-height: 64px;

            padding:
                8px
                10px;
        }


        .pt-left {
            gap: 8px;
        }


        .pulso-topbar
        .pt-icon-button,
        .pt-profile-trigger {
            width: 38px;
            height: 38px;

            min-height: 38px;

            flex: 0 0 38px;

            border-radius: 12px;
        }


        .pt-profile-avatar {
            width: 30px;
            height: 30px;

            flex-basis: 30px;
        }


        .pt-workspace-label {
            font-size: 8px;
        }


        .pt-current {
            max-width:
                calc(
                    100vw
                    -
                    158px
                );

            font-size: 16px;
        }


        .pt-popover-panel {
            top: 70px;
        }
    }


    /* ================================================================
       VERY SMALL MOBILE
       ================================================================ */

    @media (max-width: 360px) {
        .pt-workspace-label {
            display: none;
        }


        .pt-current {
            max-width:
                calc(
                    100vw
                    -
                    150px
                );
        }
    }


    @media (min-width: 1024px) {
        body.hub-mobile-sidebar-open {
            overflow: auto;
        }


        #sidebar-backdrop {
            display: none !important;
        }
    }


    @media (prefers-reduced-motion: reduce) {
        .pulso-topbar
        .pt-icon-button,
        .pt-profile-chevron {
            transition: none;
        }
    }
</style>
@endonce


<header
    class="pulso-topbar"
    id="pulso-topbar"
>
    <div class="pt-inner">

        {{-- ============================================================
             LEFT
             ============================================================ --}}

        <div class="pt-left">

            <button
                class="
                    pt-icon-button
                    pt-mobile-menu
                "
                id="open-sidebar"
                type="button"
                aria-label="Open navigation"
                aria-controls="app-sidebar"
                aria-expanded="false"
            >
                <svg
                    viewBox="0 0 24 24"
                    aria-hidden="true"
                >
                    <path d="M4 6h16"/>
                    <path d="M4 12h16"/>
                    <path d="M4 18h16"/>
                </svg>
            </button>


            <div class="pt-location">

                {{-- PAGE ICON --}}

                <span
                    class="pt-page-icon"
                    aria-hidden="true"
                >
                    <svg viewBox="0 0 24 24">

                        @switch($topbarIcon)

                            @case('inventory')

                                <path d="m12 3 9 5-9 5-9-5 9-5Z"/>
                                <path d="M3 8v9l9 5 9-5V8"/>
                                <path d="M12 13v9"/>

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

                                <path d="M3 7a2 2 0 0 1 2-2h5l2 2h7a2 2 0 0 1 2 2v10H3Z"/>

                                <path d="M12 11v6"/>
                                <path d="M9 14h6"/>

                                @break


                            @case('donations')

                                <path d="M4 10h16v10H4Z"/>
                                <path d="M3 7h18v3H3Z"/>
                                <path d="M12 7v13"/>

                                @break


                            @case('reports')

                                <path d="M4 3v18h17"/>
                                <path d="M8 16v-5"/>
                                <path d="M12 16V7"/>
                                <path d="M16 16V9"/>
                                <path d="M20 16v-3"/>

                                @break


                            @default

                                <path d="M4 13h6V4H4Z"/>
                                <path d="M14 20h6V11h-6Z"/>
                                <path d="M14 4h6v4h-6Z"/>
                                <path d="M4 17h6v3H4Z"/>

                        @endswitch

                    </svg>
                </span>


                {{-- PAGE COPY --}}

                <div class="pt-location-copy">

                    <span class="pt-workspace-label">
                        Logistics Workspace
                    </span>


                    <div class="pt-breadcrumb">

                        @if ($topbarParent)

                            <a
                                class="pt-parent"
                                href="{{ $topbarParentUrl }}"
                            >
                                {{ $topbarParent }}
                            </a>


                            <svg
                                class="pt-breadcrumb-separator"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path d="m9 6 6 6-6 6"/>
                            </svg>

                        @endif


                        <strong class="pt-current">
                            {{ $topbarTitle }}
                        </strong>

                    </div>

                </div>

            </div>
        </div>


        {{-- ============================================================
             RIGHT
             ============================================================ --}}

        <div class="pt-right">

            {{-- DATE --}}

            <div class="pt-date">

                <span
                    class="pt-date-icon"
                    aria-hidden="true"
                >
                    <svg viewBox="0 0 24 24">
                        <rect
                            x="3"
                            y="5"
                            width="18"
                            height="16"
                            rx="2"
                        />

                        <path d="M16 3v4"/>
                        <path d="M8 3v4"/>
                        <path d="M3 10h18"/>
                    </svg>
                </span>


                <span class="pt-date-copy">

                    <strong class="pt-date-day">
                        {{ $topbarDate->format('l') }}
                    </strong>


                    <span class="pt-date-full">
                        {{ $topbarDate->format('M d, Y') }}
                    </span>

                </span>

            </div>


            {{-- ========================================================
                 NOTIFICATIONS
                 ======================================================== --}}

            <details
                class="pt-popover"
                data-topbar-popover
            >
                <summary
                    class="pt-popover-summary"
                    aria-label="Open notifications"
                >
                    <span
                        class="
                            pt-icon-button
                            pt-notification-button
                        "
                    >
                        <svg
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9"/>
                            <path d="M10 21h4"/>
                        </svg>


                        <span
                            class="pt-notification-dot"
                            aria-hidden="true"
                        ></span>
                    </span>
                </summary>


                <div class="pt-popover-panel">

                    <header class="pt-popover-header">

                        <strong>
                            Notifications
                        </strong>


                        <span class="pt-popover-count">
                            3
                        </span>

                    </header>


                    <div class="pt-notification-list">

                        <article class="pt-notification">

                            <span class="pt-notification-icon">
                                <svg viewBox="0 0 24 24">
                                    <path d="M4 7h15"/>
                                    <path d="m15 3 4 4-4 4"/>
                                </svg>
                            </span>


                            <div class="pt-notification-copy">

                                <strong class="pt-notification-title">
                                    Borrowing needs attention
                                </strong>

                                <span class="pt-notification-text">
                                    A released resource record requires follow-up.
                                </span>

                                <span class="pt-notification-time">
                                    Today
                                </span>

                            </div>

                        </article>


                        <article class="pt-notification">

                            <span
                                class="
                                    pt-notification-icon
                                    is-pink
                                "
                            >
                                <svg viewBox="0 0 24 24">
                                    <rect
                                        x="5"
                                        y="3"
                                        width="14"
                                        height="18"
                                        rx="2"
                                    />

                                    <path d="M9 8h6"/>
                                    <path d="M9 12h6"/>
                                </svg>
                            </span>


                            <div class="pt-notification-copy">

                                <strong class="pt-notification-title">
                                    Request needs resolution
                                </strong>

                                <span class="pt-notification-text">
                                    Youth Leadership Summit has a resource issue.
                                </span>

                                <span class="pt-notification-time">
                                    Today
                                </span>

                            </div>

                        </article>


                        <article class="pt-notification">

                            <span
                                class="
                                    pt-notification-icon
                                    is-amber
                                "
                            >
                                <svg viewBox="0 0 24 24">
                                    <path d="M4 10h16v10H4Z"/>
                                    <path d="M3 7h18v3H3Z"/>
                                </svg>
                            </span>


                            <div class="pt-notification-copy">

                                <strong class="pt-notification-title">
                                    Donation awaiting verification
                                </strong>

                                <span class="pt-notification-text">
                                    A physical donation is waiting for intake inspection.
                                </span>

                                <span class="pt-notification-time">
                                    Recently
                                </span>

                            </div>

                        </article>

                    </div>
                </div>
            </details>


            {{-- ========================================================
                 PROFILE
                 ======================================================== --}}

            <details
                class="pt-popover"
                data-topbar-popover
            >
                <summary
                    class="pt-popover-summary"
                    aria-label="Open account options"
                >
                    <span class="pt-profile-trigger">

                        <span class="pt-profile-avatar">
                            {{ $topbarUserInitials }}
                        </span>


                        <span class="pt-profile-copy">

                            <strong class="pt-profile-name">
                                {{ $topbarUserName }}
                            </strong>


                            <span class="pt-profile-role">
                                {{ $topbarUserRole }}
                            </span>

                        </span>


                        <svg
                            class="pt-profile-chevron"
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <path d="m7 10 5 5 5-5"/>
                        </svg>

                    </span>
                </summary>


                <div
                    class="
                        pt-popover-panel
                        pt-profile-panel
                    "
                >

                    <div class="pt-profile-card">

                        <span class="pt-profile-card-avatar">
                            {{ $topbarUserInitials }}
                        </span>


                        <div class="pt-profile-card-copy">

                            <strong class="pt-profile-card-name">
                                {{ $topbarUserName }}
                            </strong>


                            <span class="pt-profile-card-role">
                                {{ $topbarUserRole }}
                            </span>

                        </div>

                    </div>


                    <div class="pt-profile-menu">

                        <a
                            class="pt-profile-menu-item"
                            href="{{ route('dashboard') }}"
                        >
                            <svg viewBox="0 0 24 24">
                                <path d="M4 13h6V4H4Z"/>
                                <path d="M14 20h6V11h-6Z"/>
                                <path d="M14 4h6v4h-6Z"/>
                                <path d="M4 17h6v3H4Z"/>
                            </svg>

                            Dashboard
                        </a>


                        <button
                            class="
                                pt-profile-menu-item
                                is-logout
                            "
                            id="topbar-logout-button"
                            type="button"
                        >
                            <svg viewBox="0 0 24 24">
                                <path d="M10 17l5-5-5-5"/>
                                <path d="M15 12H3"/>
                                <path d="M14 4h5a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-5"/>
                            </svg>

                            Log out
                        </button>

                    </div>
                </div>
            </details>

        </div>
    </div>
</header>


{{-- ================================================================
     MOBILE SIDEBAR BACKDROP
     ================================================================ --}}

<div
    id="sidebar-backdrop"
    aria-hidden="true"
></div>


{{-- ================================================================
     TOPBAR LOGOUT FORM
     ================================================================ --}}

@if (\Illuminate\Support\Facades\Route::has('logout'))

    <form
        id="topbar-logout-form"
        method="POST"
        action="{{ route('logout') }}"
        hidden
    >
        @csrf
    </form>

@endif


@once
<script>
(() => {
    const initializePulsoTopbar = () => {
        const topbar =
            document.getElementById(
                'pulso-topbar'
            );


        if (
            !topbar ||
            topbar.dataset.ready ===
                'true'
        ) {
            return;
        }


        topbar.dataset.ready =
            'true';


        /*
        |--------------------------------------------------------------------------
        | ELEMENTS
        |--------------------------------------------------------------------------
        */

        const openSidebarButton =
            document.getElementById(
                'open-sidebar'
            );


        const sidebar =
            document.getElementById(
                'app-sidebar'
            );


        const closeSidebarButton =
            document.getElementById(
                'close-sidebar'
            );


        const sidebarBackdrop =
            document.getElementById(
                'sidebar-backdrop'
            );


        const topbarLogoutButton =
            document.getElementById(
                'topbar-logout-button'
            );


        const topbarLogoutForm =
            document.getElementById(
                'topbar-logout-form'
            );


        /*
        |--------------------------------------------------------------------------
        | MOBILE SIDEBAR
        |--------------------------------------------------------------------------
        */

        const isMobileSidebar = () => {
            return (
                window.innerWidth <
                1024
            );
        };


        const openSidebar = () => {
            if (
                !sidebar ||
                !isMobileSidebar()
            ) {
                return;
            }


            sidebar.classList.remove(
                '-translate-x-full'
            );


            sidebarBackdrop?.classList.add(
                'is-visible'
            );


            sidebarBackdrop?.setAttribute(
                'aria-hidden',
                'false'
            );


            document.body.classList.add(
                'hub-mobile-sidebar-open'
            );


            openSidebarButton?.setAttribute(
                'aria-expanded',
                'true'
            );
        };


        const closeSidebar = () => {
            if (
                !sidebar
            ) {
                return;
            }


            if (
                isMobileSidebar()
            ) {
                sidebar.classList.add(
                    '-translate-x-full'
                );
            }


            sidebarBackdrop?.classList.remove(
                'is-visible'
            );


            sidebarBackdrop?.setAttribute(
                'aria-hidden',
                'true'
            );


            document.body.classList.remove(
                'hub-mobile-sidebar-open'
            );


            openSidebarButton?.setAttribute(
                'aria-expanded',
                'false'
            );
        };


        openSidebarButton?.addEventListener(
            'click',
            openSidebar
        );


        closeSidebarButton?.addEventListener(
            'click',
            closeSidebar
        );


        sidebarBackdrop?.addEventListener(
            'click',
            closeSidebar
        );


        /*
        |--------------------------------------------------------------------------
        | CLOSE SIDEBAR AFTER MOBILE NAVIGATION
        |--------------------------------------------------------------------------
        */

        sidebar
            ?.querySelectorAll(
                'a.hub-sidebar-link'
            )
            .forEach(
                (link) => {
                    link.addEventListener(
                        'click',
                        () => {
                            if (
                                isMobileSidebar()
                            ) {
                                closeSidebar();
                            }
                        }
                    );
                }
            );


        /*
        |--------------------------------------------------------------------------
        | POPOVERS
        |--------------------------------------------------------------------------
        */

        const popovers =
            Array.from(
                topbar.querySelectorAll(
                    '[data-topbar-popover]'
                )
            );


        const closePopovers = (
            except = null
        ) => {
            popovers.forEach(
                (popover) => {
                    if (
                        popover !==
                        except
                    ) {
                        popover.open =
                            false;
                    }
                }
            );
        };


        popovers.forEach(
            (popover) => {
                popover.addEventListener(
                    'toggle',
                    () => {
                        if (
                            popover.open
                        ) {
                            closePopovers(
                                popover
                            );
                        }
                    }
                );
            }
        );


        document.addEventListener(
            'click',
            (event) => {
                popovers.forEach(
                    (popover) => {
                        if (
                            popover.open &&
                            !popover.contains(
                                event.target
                            )
                        ) {
                            popover.open =
                                false;
                        }
                    }
                );
            }
        );


        /*
        |--------------------------------------------------------------------------
        | ESCAPE
        |--------------------------------------------------------------------------
        */

        document.addEventListener(
            'keydown',
            (event) => {
                if (
                    event.key !==
                    'Escape'
                ) {
                    return;
                }


                closePopovers();


                if (
                    isMobileSidebar()
                ) {
                    closeSidebar();
                }
            }
        );


        /*
        |--------------------------------------------------------------------------
        | RESIZE
        |--------------------------------------------------------------------------
        */

        window.addEventListener(
            'resize',
            () => {
                if (
                    window.innerWidth >=
                    1024
                ) {
                    sidebarBackdrop
                        ?.classList
                        .remove(
                            'is-visible'
                        );


                    sidebarBackdrop
                        ?.setAttribute(
                            'aria-hidden',
                            'true'
                        );


                    document.body.classList.remove(
                        'hub-mobile-sidebar-open'
                    );


                    openSidebarButton?.setAttribute(
                        'aria-expanded',
                        'false'
                    );


                    return;
                }


                /*
                | When entering mobile size, start with
                | the sidebar closed.
                */

                sidebar?.classList.add(
                    '-translate-x-full'
                );
            }
        );


        /*
        |--------------------------------------------------------------------------
        | TOPBAR LOGOUT
        |--------------------------------------------------------------------------
        */

        topbarLogoutButton?.addEventListener(
            'click',
            () => {
                if (
                    topbarLogoutForm
                ) {
                    topbarLogoutForm.submit();

                    return;
                }


                window.location.href =
                    @json(route('login'));
            }
        );


        /*
        |--------------------------------------------------------------------------
        | INITIAL MOBILE STATE
        |--------------------------------------------------------------------------
        */

        if (
            isMobileSidebar()
        ) {
            sidebar?.classList.add(
                '-translate-x-full'
            );


            openSidebarButton?.setAttribute(
                'aria-expanded',
                'false'
            );
        }
    };


    if (
        document.readyState ===
        'loading'
    ) {
        document.addEventListener(
            'DOMContentLoaded',
            initializePulsoTopbar,
            {
                once: true
            }
        );
    } else {
        initializePulsoTopbar();
    }
})();
</script>
@endonce