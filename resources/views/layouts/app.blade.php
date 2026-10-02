@php
    $workspaceSidebar = view('components.sidebar')->render();
    $workspaceTopbar = view('components.topbar')->render();
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <meta
        name="theme-color"
        content="#05ADB6"
    >

    <title>
        @yield('title', 'PULSO Logistics Hub')
    </title>

    <link
        rel="icon"
        href="{{ asset('images/pulso-logo.png') }}"
    >

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet"
    >

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <style>
        /* ============================================================
           PULSO WORKSPACE FOUNDATION
           ============================================================ */

        body.hub-workspace {
            --hub-navy: #10263d;
            --hub-navy-soft: #183752;

            --hub-text: #182230;
            --hub-muted: #526c82;
            --hub-muted-light: #748b9d;

            --hub-teal: #05adb6;
            --hub-teal-dark: #007780;
            --hub-teal-ink: #007680;

            --hub-pink: #ee1280;
            --hub-pink-dark: #b90c61;

            --hub-border: #d6e5ed;
            --hub-border-soft: rgba(255, 255, 255, 0.88);

            --hub-surface: #edf5fa;
            --hub-surface-light: #f5fbfe;
            --hub-surface-dark: #e5f0f6;

            --hub-raised:
                7px 8px 18px rgba(101, 138, 163, 0.16),
                -6px -6px 15px rgba(255, 255, 255, 0.82),
                inset 1px 1px 2px rgba(255, 255, 255, 0.92);

            --hub-raised-soft:
                4px 5px 12px rgba(83, 119, 141, 0.12),
                -3px -3px 9px rgba(255, 255, 255, 0.82),
                inset 1px 1px 1px rgba(255, 255, 255, 0.9);

            --hub-inset:
                inset 3px 3px 7px rgba(113, 142, 163, 0.16),
                inset -3px -3px 7px rgba(255, 255, 255, 0.92);

            --hub-pressed:
                inset 3px 3px 7px rgba(63, 96, 118, 0.18),
                inset -2px -2px 5px rgba(255, 255, 255, 0.72);

            min-width: 320px;
            min-height: 100vh;
            min-height: 100svh;

            margin: 0;

            color: var(--hub-text);

            font-family:
                "Inter",
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;

            background:
                radial-gradient(
                    ellipse at 4% 5%,
                    rgba(248, 206, 233, 0.72) 0%,
                    transparent 31%
                ),
                radial-gradient(
                    ellipse at 84% 8%,
                    rgba(184, 239, 241, 0.78) 0%,
                    transparent 35%
                ),
                radial-gradient(
                    ellipse at 98% 83%,
                    rgba(246, 212, 234, 0.7) 0%,
                    transparent 32%
                ),
                radial-gradient(
                    ellipse at 10% 92%,
                    rgba(192, 238, 241, 0.72) 0%,
                    transparent 38%
                ),
                linear-gradient(
                    145deg,
                    #edf6fb 0%,
                    #eaf3f8 48%,
                    #edf6fa 100%
                );

            background-attachment: fixed;

            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }


        /* ============================================================
           GLOBAL BOX MODEL
           ============================================================ */

        .hub-workspace *,
        .hub-workspace *::before,
        .hub-workspace *::after {
            box-sizing: border-box;
        }


        /* ============================================================
           WORKSPACE SHELL
           ============================================================ */

        .hub-shell {
            width: 100%;
            min-height: 100vh;
            min-height: 100svh;
        }


        .hub-workspace #app-main {
            min-width: 0;

            min-height: 100vh;
            min-height: 100svh;

            background: transparent;
        }


        /* ============================================================
           TOPBAR BASE
           ============================================================ */

        .hub-workspace #app-main > header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.76);

            background:
                linear-gradient(
                    180deg,
                    rgba(246, 252, 253, 0.95),
                    rgba(238, 247, 250, 0.92)
                );

            box-shadow:
                0 7px 20px rgba(74, 110, 132, 0.09),
                inset 0 -1px 0 rgba(255, 255, 255, 0.72);

            -webkit-backdrop-filter: blur(16px);
            backdrop-filter: blur(16px);
        }


        /* ============================================================
           MAIN CONTENT
           ============================================================ */

        .hub-content {
            width: 100%;
            min-width: 0;

            padding:
                30px
                28px
                44px;
        }


        .hub-content-inner {
            width: 100%;
            max-width: 1496px;
            min-width: 0;

            margin: 0 auto;
        }


        .hub-content-inner > * {
            min-width: 0;
        }


        /* ============================================================
           GENERIC NEUMORPHIC PANEL
           ============================================================ */

        .hub-panel {
            min-width: 0;

            border: 1px solid rgba(255, 255, 255, 0.94);
            border-radius: 22px;

            background:
                linear-gradient(
                    145deg,
                    rgba(249, 253, 255, 0.97),
                    rgba(230, 242, 248, 0.96)
                );

            box-shadow: var(--hub-raised);
        }


        /* ============================================================
           SOFT TRANSLUCENT PANEL
           ============================================================ */

        .hub-glass {
            border: 1px solid rgba(255, 255, 255, 0.9);
            border-radius: 22px;

            background:
                linear-gradient(
                    145deg,
                    rgba(248, 253, 255, 0.9),
                    rgba(232, 244, 248, 0.88)
                );

            box-shadow:
                7px 8px 18px rgba(101, 138, 163, 0.12),
                -5px -5px 13px rgba(255, 255, 255, 0.76),
                inset 1px 1px 2px rgba(255, 255, 255, 0.9);

            -webkit-backdrop-filter: blur(12px);
            backdrop-filter: blur(12px);
        }


        /* ============================================================
           INSET SURFACE
           ============================================================ */

        .hub-inset {
            border: 1px solid #d1e1e9;
            border-radius: 14px;

            background:
                linear-gradient(
                    145deg,
                    #e8f1f6,
                    #edf5f9
                );

            box-shadow: var(--hub-inset);
        }


        /* ============================================================
           ICON WELLS
           ============================================================ */

        .hub-icon-well {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;

            width: 48px;
            height: 48px;

            border: 1px solid rgba(255, 255, 255, 0.92);
            border-radius: 16px;

            color: var(--hub-navy);

            background:
                linear-gradient(
                    145deg,
                    #f8fcff,
                    #e2edf4
                );

            box-shadow:
                4px 5px 10px rgba(100, 128, 151, 0.15),
                -4px -4px 9px rgba(255, 255, 255, 0.84),
                inset 1px 1px 2px rgba(255, 255, 255, 0.96);
        }


        .hub-icon-well svg {
            width: 23px;
            height: 23px;

            flex-shrink: 0;
        }


        .hub-icon-well--teal {
            color: var(--hub-teal-ink);

            background:
                linear-gradient(
                    145deg,
                    #e8ffff,
                    #c6edf0
                );
        }


        .hub-icon-well--pink {
            color: var(--hub-pink-dark);

            background:
                linear-gradient(
                    145deg,
                    #fff4fa,
                    #f7d6e7
                );
        }


        /* ============================================================
           PRIMARY BUTTON
           ============================================================ */

        .hub-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;

            min-height: 44px;

            padding:
                11px
                18px;

            border: 1px solid #bff8fa;
            border-radius: 14px;

            color: #ffffff;

            background:
                linear-gradient(
                    145deg,
                    #00858e,
                    #00747f
                );

            box-shadow:
                4px 5px 11px rgba(0, 126, 139, 0.19),
                -3px -3px 8px rgba(255, 255, 255, 0.7),
                inset 1px 1px 3px rgba(125, 234, 240, 0.62);

            font-family: inherit;
            font-size: 14px;
            font-weight: 700;
            line-height: 1.4;

            text-align: center;
            text-decoration: none;

            cursor: pointer;

            transition:
                color 180ms ease,
                background 180ms ease,
                box-shadow 180ms ease,
                transform 180ms ease;
        }


        .hub-button svg {
            width: 19px;
            height: 19px;

            flex-shrink: 0;
        }


        .hub-button:hover:not(:disabled) {
            color: #ffffff;

            background:
                linear-gradient(
                    145deg,
                    #007c86,
                    #006a74
                );

            box-shadow:
                5px 6px 13px rgba(0, 108, 120, 0.22),
                -3px -3px 8px rgba(255, 255, 255, 0.72),
                inset 1px 1px 3px rgba(125, 234, 240, 0.5);

            transform: translateY(-1px);
        }


        .hub-button:active:not(:disabled) {
            transform: translateY(0);

            box-shadow:
                inset 3px 3px 7px rgba(0, 79, 104, 0.62),
                inset -2px -2px 5px rgba(62, 185, 193, 0.28);
        }


        .hub-button:disabled {
            cursor: not-allowed;
            opacity: 0.58;
        }


        /* ============================================================
           TEXT
           ============================================================ */

        .hub-workspace h1,
        .hub-workspace h2,
        .hub-workspace h3,
        .hub-workspace h4,
        .hub-workspace h5,
        .hub-workspace h6 {
            text-wrap: balance;
        }


        .hub-workspace p {
            text-wrap: pretty;
        }


        /* ============================================================
           LINKS
           ============================================================ */

        .hub-workspace a {
            -webkit-tap-highlight-color: transparent;
        }


        /* ============================================================
           IMAGES
           ============================================================ */

        .hub-workspace img,
        .hub-workspace svg {
            max-width: 100%;
        }


        /* ============================================================
           FOCUS
           ============================================================ */

        .hub-workspace :focus-visible {
            outline: 3px solid rgba(185, 12, 97, 0.78);
            outline-offset: 4px;
        }


        /* ============================================================
           TEXT SELECTION
           ============================================================ */

        .hub-workspace ::selection {
            background: #f8b8d9;
            color: var(--hub-navy);
        }


        /* ============================================================
           SCROLLBAR
           ============================================================ */

        .hub-workspace {
            scrollbar-color:
                rgba(0, 119, 128, 0.45)
                rgba(225, 239, 246, 0.7);

            scrollbar-width: thin;
        }


        .hub-workspace::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }


        .hub-workspace::-webkit-scrollbar-track {
            background: rgba(225, 239, 246, 0.72);
        }


        .hub-workspace::-webkit-scrollbar-thumb {
            border: 2px solid rgba(225, 239, 246, 0.72);
            border-radius: 999px;

            background: rgba(0, 119, 128, 0.38);
        }


        .hub-workspace::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 119, 128, 0.58);
        }


        /* ============================================================
           SKIP LINK
           ============================================================ */

        .hub-skip-link {
            position: fixed;
            top: -120px;
            left: 20px;
            z-index: 9999;

            padding:
                12px
                16px;

            border: 1px solid rgba(255, 255, 255, 0.94);
            border-radius: 13px;

            background:
                linear-gradient(
                    145deg,
                    #f9fdff,
                    #e6f1f6
                );

            color: var(--hub-navy);

            box-shadow: var(--hub-raised-soft);

            font-size: 14px;
            font-weight: 700;

            text-decoration: none;
        }


        .hub-skip-link:focus {
            top: 16px;
        }


        /* ============================================================
           TABLE OVERFLOW SAFETY
           ============================================================ */

        .hub-workspace table {
            max-width: 100%;
        }


        /* ============================================================
           LARGE TABLET
           ============================================================ */

        @media (max-width: 1199px) {
            .hub-content {
                padding:
                    28px
                    24px
                    40px;
            }
        }


        /* ============================================================
           TABLET
           ============================================================ */

        @media (max-width: 1023px) {
            .hub-content {
                padding:
                    24px
                    22px
                    36px;
            }
        }


        /* ============================================================
           MOBILE
           ============================================================ */

        @media (max-width: 639px) {
            .hub-content {
                padding:
                    20px
                    16px
                    32px;
            }


            .hub-panel,
            .hub-glass {
                border-radius: 18px;

                box-shadow:
                    5px 6px 14px rgba(101, 138, 163, 0.14),
                    -4px -4px 11px rgba(255, 255, 255, 0.78),
                    inset 1px 1px 2px rgba(255, 255, 255, 0.88);
            }


            .hub-inset {
                border-radius: 13px;
            }


            .hub-icon-well {
                width: 42px;
                height: 42px;

                border-radius: 14px;
            }


            .hub-icon-well svg {
                width: 21px;
                height: 21px;
            }


            .hub-button {
                min-height: 43px;

                padding:
                    10px
                    15px;

                border-radius: 13px;
            }
        }


        /* ============================================================
           REDUCED MOTION
           ============================================================ */

        @media (prefers-reduced-motion: reduce) {
            .hub-workspace {
                scroll-behavior: auto;
            }


            .hub-workspace *,
            .hub-workspace *::before,
            .hub-workspace *::after {
                scroll-behavior: auto !important;

                transition-duration: 0.01ms !important;
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
            }


            .hub-button:hover:not(:disabled) {
                transform: none;
            }
        }
    </style>

    {{-- Page-specific styles --}}
    @stack('styles')

    {{--
        IMPORTANT:
        Loaded AFTER page-specific styles so the PULSO design system
        remains consistent even if an individual page contains older CSS.
    --}}
    @include('components.theme-guardrails')
</head>

<body class="hub-workspace">
    <a
        class="hub-skip-link"
        href="#workspace-content"
    >
        Skip to main content
    </a>

    <div class="hub-shell">
        {!! $workspaceSidebar !!}

        <div
            id="sidebar-backdrop"
            class="fixed inset-0 z-40 hidden bg-[#10263D]/40 opacity-0 backdrop-blur-[2px] transition-opacity duration-200 lg:hidden"
            aria-hidden="true"
        ></div>

        <div id="app-main">
            {!! $workspaceTopbar !!}

            <main
                class="hub-content"
                id="workspace-content"
                tabindex="-1"
            >
                <div class="hub-content-inner">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>