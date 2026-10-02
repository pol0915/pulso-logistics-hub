@php
    $isLoggedIn =
        session()->get(
            'is_logistics_head',
            false
        );

    $workspaceRoute =
        $isLoggedIn
            ? route('dashboard')
            : route('login');

    $workspaceLabel =
        $isLoggedIn
            ? 'Open workspace'
            : 'Sign in';

    $heroActionLabel =
        $isLoggedIn
            ? 'Continue to your workspace'
            : 'Sign in to your workspace';
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
        name="theme-color"
        content="#05ADB6"
    >

    <meta
        name="description"
        content="PULSO Pagsanjan's shared logistics hub for equipment, logistics requests, borrowing, project resources, physical donations, and operational reporting."
    >

    <title>PULSO Logistics Hub — Every resource. Every project.</title>

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

    <link
        rel="stylesheet"
        href="{{ asset('css/landing.css') }}"
    >

    <style>
        html {
            scroll-behavior: smooth;
        }


        body {
            overflow-x: hidden;
        }


        /* ============================================================
           HEADER
           ============================================================ */

        .site-header {
            position: sticky;
            top: 14px;
            z-index: 40;

            isolation: isolate;
        }


        .site-header nav {
            display: flex;
            align-items: center;

            gap: 8px;
        }


        .site-header nav a {
            position: relative;

            padding:
                9px
                12px;

            border-radius: 10px;

            transition:
                color 160ms ease,
                background 160ms ease;
        }


        .site-header nav a:hover {
            background:
                rgba(
                    255,
                    255,
                    255,
                    .44
                );

            color: #007780;
        }


        /* ============================================================
           HERO
           ============================================================ */

        .hero {
            position: relative;

            isolation: isolate;
        }


        .hero-copy {
            position: relative;
            z-index: 3;
        }


        .hero-copy h1 span {
            display: inline-block;

            background:
                linear-gradient(
                    100deg,
                    #007780,
                    #05adb6 54%,
                    #b90c61
                );

            -webkit-background-clip: text;
            background-clip: text;

            color: transparent;
        }


        .hero-description {
            max-width: 570px;
        }


        .hero-actions {
            flex-wrap: wrap;
        }


        .hero-actions .button {
            min-height: 48px;
        }


        /* ============================================================
           HERO ART BLEND
           ============================================================ */

        .hero-visual {
            position: relative;

            isolation: isolate;
        }


        /*
        |--------------------------------------------------------------------------
        | Ambient background glow
        |--------------------------------------------------------------------------
        |
        | This stays behind the existing artwork. It does not crop, mask,
        | resize, or expose the rectangular boundary of the PNG.
        |
        */

        .hero-visual::before {
            position: absolute;
            z-index: -1;

            top: 10%;
            right: 5%;
            bottom: 9%;
            left: 6%;

            border-radius: 50%;

            background:
                radial-gradient(
                    circle at 36% 42%,
                    rgba(
                        5,
                        173,
                        182,
                        .11
                    ),
                    transparent 45%
                ),
                radial-gradient(
                    circle at 76% 61%,
                    rgba(
                        238,
                        18,
                        128,
                        .075
                    ),
                    transparent 43%
                ),
                radial-gradient(
                    circle at 58% 78%,
                    rgba(
                        255,
                        255,
                        255,
                        .48
                    ),
                    transparent 45%
                );

            filter:
                blur(
                    36px
                );

            opacity: .82;

            content: "";

            pointer-events: none;
        }


        /*
        |--------------------------------------------------------------------------
        | Illustration enhancement
        |--------------------------------------------------------------------------
        |
        | We intentionally do NOT set width, max-width, mask-image,
        | clip-path, border-radius, or overflow here. The original
        | landing.css stays in charge of the artwork's natural blend.
        |
        */

        .hero-art {
            filter:
                saturate(1.025)
                contrast(1.012)
                brightness(1.008)
                drop-shadow(
                    0
                    13px
                    18px
                    rgba(
                        41,
                        83,
                        107,
                        .065
                    )
                )
                drop-shadow(
                    0
                    27px
                    40px
                    rgba(
                        41,
                        83,
                        107,
                        .045
                    )
                );

            transition:
                filter 220ms ease,
                transform 220ms ease;
        }


        .hero-visual:hover .hero-art {
            filter:
                saturate(1.035)
                contrast(1.016)
                brightness(1.01)
                drop-shadow(
                    0
                    15px
                    20px
                    rgba(
                        41,
                        83,
                        107,
                        .075
                    )
                )
                drop-shadow(
                    0
                    29px
                    43px
                    rgba(
                        41,
                        83,
                        107,
                        .05
                    )
                );
        }


        /* ============================================================
           FLOATING HERO LABELS
           ============================================================ */

        .floating-label {
            backdrop-filter:
                blur(
                    12px
                );

            -webkit-backdrop-filter:
                blur(
                    12px
                );

            border-color:
                rgba(
                    255,
                    255,
                    255,
                    .84
                );

            background:
                linear-gradient(
                    145deg,
                    rgba(
                        255,
                        255,
                        255,
                        .8
                    ),
                    rgba(
                        232,
                        243,
                        248,
                        .69
                    )
                );

            box-shadow:
                7px 10px 20px rgba(69, 104, 125, .095),
                -3px -3px 10px rgba(255, 255, 255, .67),
                inset 1px 1px 1px rgba(255, 255, 255, .72);

            transition:
                transform 180ms ease,
                box-shadow 180ms ease;
        }


        .floating-label:hover {
            transform:
                translateY(
                    -3px
                );

            box-shadow:
                9px 13px 25px rgba(69, 104, 125, .13),
                -4px -4px 12px rgba(255, 255, 255, .72);
        }


        /* ============================================================
           SECTION HEADING
           ============================================================ */

        .section-heading {
            max-width: 720px;

            margin-right: auto;
            margin-left: auto;

            text-align: center;
        }


        .section-heading h2 {
            text-wrap: balance;
        }


        /* ============================================================
           FEATURES
           ============================================================ */

        .features {
            position: relative;
        }


        .feature-grid {
            display: grid;

            grid-template-columns:
                repeat(
                    3,
                    minmax(0, 1fr)
                );

            gap: 18px;
        }


        .feature-card {
            --feature-accent: #007780;

            --feature-icon-bg:
                linear-gradient(
                    145deg,
                    #e2f8f8,
                    #cef0f0
                );

            position: relative;

            min-height: 205px;

            overflow: hidden;

            transition:
                transform 180ms ease,
                box-shadow 180ms ease,
                border-color 180ms ease;
        }


        /* ============================================================
           FEATURE COLORS
           ============================================================ */

        .feature-card[data-tone="teal"] {
            --feature-accent: #007780;

            --feature-icon-bg:
                linear-gradient(
                    145deg,
                    #dcf8f8,
                    #c7eeee
                );
        }


        .feature-card[data-tone="pink"] {
            --feature-accent: #b90c61;

            --feature-icon-bg:
                linear-gradient(
                    145deg,
                    #fce6f1,
                    #f3cfdf
                );
        }


        .feature-card[data-tone="navy"] {
            --feature-accent: #31546d;

            --feature-icon-bg:
                linear-gradient(
                    145deg,
                    #e8f0f5,
                    #d8e6ee
                );
        }


        .feature-card[data-tone="gold"] {
            --feature-accent: #895408;

            --feature-icon-bg:
                linear-gradient(
                    145deg,
                    #fff1d9,
                    #f5deb6
                );
        }


        .feature-card[data-tone="green"] {
            --feature-accent: #2b735d;

            --feature-icon-bg:
                linear-gradient(
                    145deg,
                    #e1f3eb,
                    #cfe8de
                );
        }


        /* ============================================================
           FEATURE TOP ACCENT
           ============================================================ */

        .feature-card::after {
            position: absolute;

            top: 0;
            right: 22px;

            width: 38px;
            height: 3px;

            border-radius:
                0
                0
                999px
                999px;

            background:
                var(
                    --feature-accent
                );

            opacity: .72;

            content: "";
        }


        /* ============================================================
           FEATURE ICONS
           ============================================================ */

        .feature-card > .icon-well {
            border-color:
                rgba(
                    255,
                    255,
                    255,
                    .96
                ) !important;

            background:
                var(
                    --feature-icon-bg
                ) !important;

            color:
                var(
                    --feature-accent
                ) !important;

            box-shadow:
                4px 5px 11px rgba(78, 111, 132, .1),
                -3px -3px 8px rgba(255, 255, 255, .76),
                inset 1px 1px 2px rgba(255, 255, 255, .8) !important;
        }


        .feature-card > .icon-well .icon {
            color:
                var(
                    --feature-accent
                ) !important;

            stroke: currentColor;
        }


        /* ============================================================
           FEATURE CONTENT
           ============================================================ */

        .feature-card h3 {
            margin-top: 18px;
        }


        .feature-card p {
            max-width: 290px;
        }


        /* ============================================================
           FEATURE NUMBER
           ============================================================ */

        .feature-number {
            position: absolute;

            right: 20px;
            bottom: 16px;

            color:
                var(
                    --feature-accent
                );

            font-size: 34px;
            font-weight: 900;
            line-height: 1;

            letter-spacing: -.07em;

            opacity: .52;

            text-shadow:
                0
                1px
                0
                rgba(
                    255,
                    255,
                    255,
                    .72
                );

            user-select: none;
        }


        /* ============================================================
           FEATURE HOVER
           ============================================================ */

        .feature-card:hover {
            border-color:
                rgba(
                    255,
                    255,
                    255,
                    .98
                );

            transform:
                translateY(
                    -4px
                );

            box-shadow:
                10px 14px 28px rgba(72, 110, 132, .12),
                -5px -5px 14px rgba(255, 255, 255, .68);
        }


        .feature-card:hover > .icon-well {
            transform:
                translateY(
                    -1px
                );

            box-shadow:
                5px 7px 13px rgba(78, 111, 132, .12),
                -3px -3px 8px rgba(255, 255, 255, .8) !important;
        }


        .feature-card:hover .feature-number {
            opacity: .72;
        }


        /* ============================================================
           WORKFLOW
           ============================================================ */

        .workflow-section {
            padding:
                clamp(
                    72px,
                    9vw,
                    110px
                )
                0;
        }


        .workflow-shell {
            position: relative;

            overflow: hidden;

            padding:
                clamp(
                    25px,
                    4vw,
                    42px
                );

            border:
                1px
                solid
                rgba(
                    255,
                    255,
                    255,
                    .88
                );

            border-radius: 30px;

            background:
                radial-gradient(
                    circle at 4% 10%,
                    rgba(
                        238,
                        18,
                        128,
                        .07
                    ),
                    transparent 27%
                ),
                radial-gradient(
                    circle at 96% 86%,
                    rgba(
                        5,
                        173,
                        182,
                        .09
                    ),
                    transparent 30%
                ),
                linear-gradient(
                    145deg,
                    rgba(
                        249,
                        253,
                        255,
                        .86
                    ),
                    rgba(
                        231,
                        243,
                        248,
                        .8
                    )
                );

            box-shadow:
                10px 14px 32px rgba(76, 111, 132, .09),
                -7px -7px 20px rgba(255, 255, 255, .58),
                inset 1px 1px 2px rgba(255, 255, 255, .86);
        }


        .workflow-heading {
            max-width: 680px;

            margin-bottom: 30px;
        }


        .workflow-heading h2 {
            margin:
                8px
                0
                0;

            color: #10263d;

            font-size:
                clamp(
                    27px,
                    3vw,
                    40px
                );

            font-weight: 850;

            letter-spacing: -.045em;

            text-wrap: balance;
        }


        .workflow-heading p:last-child {
            margin:
                12px
                0
                0;

            color: #557188;

            font-size: 14px;
            line-height: 1.75;
        }


        .workflow-grid {
            position: relative;

            display: grid;

            grid-template-columns:
                repeat(
                    3,
                    minmax(0, 1fr)
                );

            gap: 17px;
        }


        .workflow-step {
            position: relative;

            min-width: 0;

            padding: 21px;

            border:
                1px
                solid
                rgba(
                    255,
                    255,
                    255,
                    .9
                );

            border-radius: 20px;

            background:
                linear-gradient(
                    145deg,
                    #f8fcfe,
                    #e8f2f6
                );

            box-shadow:
                5px 7px 14px rgba(84, 119, 139, .08),
                -4px -4px 10px rgba(255, 255, 255, .7);
        }


        .workflow-step-top {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 12px;

            margin-bottom: 17px;
        }


        .workflow-step-number {
            display: grid;
            place-items: center;

            width: 36px;
            height: 36px;

            flex: 0 0 36px;

            border:
                1px
                solid
                rgba(
                    255,
                    255,
                    255,
                    .92
                );

            border-radius: 12px;

            background:
                linear-gradient(
                    145deg,
                    #e2f7f8,
                    #ccebed
                );

            color: #007780;

            font-size: 12px;
            font-weight: 850;
        }


        .workflow-step:nth-child(2)
        .workflow-step-number {
            background:
                linear-gradient(
                    145deg,
                    #fbe8f1,
                    #efd3e0
                );

            color: #b90c61;
        }


        .workflow-step:nth-child(3)
        .workflow-step-number {
            background:
                linear-gradient(
                    145deg,
                    #e5edf3,
                    #d8e5ed
                );

            color: #31546d;
        }


        .workflow-step-icon {
            display: grid;
            place-items: center;

            width: 34px;
            height: 34px;

            border-radius: 11px;

            color: #688297;
        }


        .workflow-step-icon .icon {
            width: 19px;
            height: 19px;
        }


        .workflow-step h3 {
            margin: 0;

            color: #18344c;

            font-size: 16px;
            font-weight: 800;

            letter-spacing: -.02em;
        }


        .workflow-step p {
            margin:
                8px
                0
                0;

            color: #607b8f;

            font-size: 11.5px;
            line-height: 1.65;
        }


        /* ============================================================
           ACCESS
           ============================================================ */

        .access-strip {
            display: grid;

            grid-template-columns:
                auto
                minmax(0, 1fr)
                auto;

            align-items: center;

            gap:
                18px
                22px;
        }


        .access-strip-copy {
            min-width: 0;
        }


        .access-strip-copy h2 {
            margin: 0;
        }


        .access-strip-copy p {
            margin:
                6px
                0
                0;
        }


        .access-strip-action {
            display: flex;
            align-items: center;

            gap: 16px;
        }


        .access-motto {
            text-align: right;
        }


        .access-strip .button {
            white-space: nowrap;
        }


        /* ============================================================
           FOOTER
           ============================================================ */

        .site-footer {
            gap: 20px;
        }


        .site-footer > a:last-child {
            display: inline-flex;
            align-items: center;

            gap: 7px;
        }


        /* ============================================================
           RESPONSIVE
           ============================================================ */

        @media (max-width: 980px) {
            .feature-grid {
                grid-template-columns:
                    repeat(
                        2,
                        minmax(0, 1fr)
                    );
            }


            .access-strip {
                grid-template-columns:
                    auto
                    minmax(0, 1fr);
            }


            .access-strip-action {
                grid-column:
                    1
                    /
                    -1;

                justify-content: space-between;
            }


            .hero-visual::before {
                top: 8%;
                right: 3%;
                bottom: 7%;
                left: 4%;

                filter:
                    blur(
                        29px
                    );

                opacity: .7;
            }
        }


        @media (max-width: 760px) {
            .site-header nav {
                display: none;
            }


            .workflow-grid {
                grid-template-columns:
                    minmax(0, 1fr);
            }


            .hero-visual::before {
                top: 7%;
                right: 3%;
                bottom: 7%;
                left: 3%;

                filter:
                    blur(
                        24px
                    );

                opacity: .56;
            }


            .hero-art {
                filter:
                    saturate(1.018)
                    contrast(1.008)
                    brightness(1.006)
                    drop-shadow(
                        0
                        12px
                        18px
                        rgba(
                            41,
                            83,
                            107,
                            .06
                        )
                    );
            }
        }


        @media (max-width: 620px) {
            .feature-grid {
                grid-template-columns:
                    minmax(0, 1fr);
            }


            .feature-card {
                min-height: 180px;
            }


            .feature-number {
                font-size: 31px;
            }


            .access-strip {
                grid-template-columns:
                    minmax(0, 1fr);

                text-align: left;
            }


            .access-strip > .icon-well {
                display: none;
            }


            .access-strip-action {
                grid-column: auto;

                align-items: stretch;
                flex-direction: column;
            }


            .access-motto {
                text-align: left;
            }


            .access-strip .button {
                width: 100%;
            }
        }


        @media (prefers-reduced-motion: reduce) {
            html {
                scroll-behavior: auto;
            }


            .hero-art,
            .feature-card,
            .feature-card > .icon-well,
            .floating-label {
                transition: none;
            }


            .feature-card:hover,
            .feature-card:hover > .icon-well,
            .floating-label:hover {
                transform: none;
            }
        }
    </style>
</head>

<body>

    <a
        class="skip-link"
        href="#main"
    >
        Skip to content
    </a>


    {{-- ================================================================
         ICON LIBRARY
         ================================================================ --}}

    <svg
        class="icon-library"
        xmlns="http://www.w3.org/2000/svg"
        aria-hidden="true"
    >

        <symbol
            id="icon-arrow"
            viewBox="0 0 24 24"
        >
            <path d="M4 12h16m-6-6 6 6-6 6"/>
        </symbol>


        <symbol
            id="icon-box"
            viewBox="0 0 24 24"
        >
            <path d="m12 3 9 5-9 5-9-5 9-5Z"/>
            <path d="M3 8v9l9 5 9-5V8"/>
            <path d="M12 13v9"/>
            <path d="M7.5 5.5l9 5"/>
        </symbol>


        <symbol
            id="icon-exchange"
            viewBox="0 0 24 24"
        >
            <path d="M3 7h17"/>
            <path d="m15 2 5 5-5 5"/>
            <path d="M21 17H4"/>
            <path d="m9 12-5 5 5 5"/>
        </symbol>


        <symbol
            id="icon-list"
            viewBox="0 0 24 24"
        >
            <rect
                x="5"
                y="3"
                width="14"
                height="18"
                rx="2"
            />

            <path d="M9 8h6"/>
            <path d="M9 12h6"/>
            <path d="M9 16h4"/>
        </symbol>


        <symbol
            id="icon-people"
            viewBox="0 0 24 24"
        >
            <circle
                cx="12"
                cy="7"
                r="3"
            />

            <path d="M6 21v-3a6 6 0 0 1 12 0v3"/>
            <path d="M19 5a3 3 0 0 1 0 6"/>
            <path d="M21 14a5 5 0 0 1 2 4v3"/>
            <path d="M5 5a3 3 0 0 0 0 6"/>
            <path d="M3 14a5 5 0 0 0-2 4v3"/>
        </symbol>


        <symbol
            id="icon-lock"
            viewBox="0 0 24 24"
        >
            <rect
                x="5"
                y="10"
                width="14"
                height="11"
                rx="3"
            />

            <path d="M8 10V7a4 4 0 0 1 8 0v3"/>
            <path d="M12 15v2"/>
        </symbol>


        <symbol
            id="icon-project"
            viewBox="0 0 24 24"
        >
            <path d="M3 7a2 2 0 0 1 2-2h5l2 2h7a2 2 0 0 1 2 2v10H3Z"/>
            <path d="M12 11v6"/>
            <path d="M9 14h6"/>
        </symbol>


        <symbol
            id="icon-gift"
            viewBox="0 0 24 24"
        >
            <path d="M4 10h16v10H4Z"/>
            <path d="M3 7h18v3H3Z"/>
            <path d="M12 7v13"/>
            <path d="M12 7c-3 0-5-1.2-5-3 0-1.2 1-2 2.2-2C11 2 12 4 12 7Z"/>
            <path d="M12 7c3 0 5-1.2 5-3 0-1.2-1-2-2.2-2C13 2 12 4 12 7Z"/>
        </symbol>


        <symbol
            id="icon-chart"
            viewBox="0 0 24 24"
        >
            <path d="M4 3v18h17"/>
            <path d="M8 16v-5"/>
            <path d="M12 16V7"/>
            <path d="M16 16V9"/>
            <path d="M20 16v-3"/>
        </symbol>


        <symbol
            id="icon-check"
            viewBox="0 0 24 24"
        >
            <circle
                cx="12"
                cy="12"
                r="9"
            />

            <path d="m8 12 3 3 5-6"/>
        </symbol>

    </svg>


    <div class="page-shell">

        {{-- ============================================================
             HEADER
             ============================================================ --}}

        <header class="site-header glass">

            <a
                class="brand"
                href="{{ route('home') }}"
                aria-label="PULSO Logistics Hub home"
            >
                <img
                    src="{{ asset('images/pulso-logo.png') }}"
                    width="48"
                    height="48"
                    alt=""
                >

                <span>
                    <strong>
                        PULSO
                    </strong>

                    <span>
                        Logistics Hub
                    </span>
                </span>
            </a>


            <nav aria-label="Main navigation">

                <a href="#about">
                    About
                </a>

                <a href="#features">
                    Features
                </a>

                <a href="#workflow">
                    How it works
                </a>

            </nav>


            <a
                class="
                    button
                    button-primary
                    nav-signin
                "
                href="{{ $workspaceRoute }}"
            >
                {{ $workspaceLabel }}

                <svg
                    class="icon"
                    aria-hidden="true"
                >
                    <use href="#icon-arrow"/>
                </svg>
            </a>

        </header>


        <main id="main">

            {{-- ========================================================
                 HERO
                 ======================================================== --}}

            <section
                class="hero"
                id="about"
                aria-labelledby="hero-title"
            >

                <div class="hero-copy">

                    <p class="eyebrow">
                        PULSO PAGSANJAN
                    </p>


                    <h1 id="hero-title">
                        Every resource.<br>
                        Every project.<br>

                        <span>
                            One shared hub.
                        </span>
                    </h1>


                    <p class="hero-description">
                        Organize equipment, coordinate logistics requests,
                        monitor borrowed resources, support projects, and
                        keep every movement accountable—all in one place.
                    </p>


                    <div class="hero-actions">

                        <a
                            class="
                                button
                                button-primary
                            "
                            href="{{ $workspaceRoute }}"
                        >
                            {{ $heroActionLabel }}

                            <svg
                                class="icon"
                                aria-hidden="true"
                            >
                                <use href="#icon-arrow"/>
                            </svg>
                        </a>


                        <a
                            class="text-link"
                            href="#features"
                        >
                            Explore features

                            <svg
                                class="icon"
                                aria-hidden="true"
                            >
                                <use href="#icon-arrow"/>
                            </svg>
                        </a>

                    </div>


                    <p class="access-note">

                        <span class="icon-well small">
                            <svg
                                class="icon"
                                aria-hidden="true"
                            >
                                <use href="#icon-lock"/>
                            </svg>
                        </span>


                        @if ($isLoggedIn)

                            You are signed in as the Logistics Head.

                        @else

                            Authorized PULSO logistics personnel only.

                        @endif

                    </p>

                </div>


                <div class="hero-visual">

                    <img
                        class="hero-art"
                        src="{{ asset('images/pulso-community-hero.png') }}"
                        width="1448"
                        height="1086"
                        fetchpriority="high"
                        alt="A beige PULSO supplies box with folders, towels and a checklist, in front of an illustrated Philippine town, river and bridge."
                    >


                    <div class="floating-label label-resources">

                        <span class="icon-well teal">
                            <svg
                                class="icon"
                                aria-hidden="true"
                            >
                                <use href="#icon-box"/>
                            </svg>
                        </span>


                        <span>
                            Organized<br>
                            resources
                        </span>

                    </div>


                    <div class="floating-label label-projects">

                        <span class="icon-well pink">
                            <svg
                                class="icon"
                                aria-hidden="true"
                            >
                                <use href="#icon-people"/>
                            </svg>
                        </span>


                        <span>
                            Coordinated<br>
                            projects
                        </span>

                    </div>

                </div>

            </section>


            {{-- ========================================================
                 FEATURES
                 ======================================================== --}}

            <section
                class="features"
                id="features"
                aria-labelledby="features-title"
            >

                <div class="section-heading">

                    <p class="eyebrow">
                        A SHARED SPACE FOR COMMUNITY WORK
                    </p>


                    <h2 id="features-title">
                        Built for the work behind every project.
                    </h2>


                    <p>
                        One logistics workspace for resources, requests,
                        custody, projects, donations, and accountability.
                    </p>

                </div>


                <div class="feature-grid">

                    {{-- INVENTORY --}}

                    <article
                        class="
                            feature-card
                            soft-surface
                        "
                        data-tone="teal"
                    >

                        <span class="icon-well">
                            <svg
                                class="icon"
                                aria-hidden="true"
                            >
                                <use href="#icon-box"/>
                            </svg>
                        </span>


                        <h3>
                            Inventory &amp; Assets
                        </h3>


                        <p>
                            Keep equipment and reusable resources organized,
                            visible, and ready for community activities.
                        </p>


                        <span
                            class="feature-number"
                            aria-hidden="true"
                        >
                            01
                        </span>

                    </article>


                    {{-- REQUESTS --}}

                    <article
                        class="
                            feature-card
                            soft-surface
                        "
                        data-tone="pink"
                    >

                        <span class="icon-well">
                            <svg
                                class="icon"
                                aria-hidden="true"
                            >
                                <use href="#icon-list"/>
                            </svg>
                        </span>


                        <h3>
                            Logistics Requests
                        </h3>


                        <p>
                            Review activity requirements, check available
                            resources, and coordinate what each committee needs.
                        </p>


                        <span
                            class="feature-number"
                            aria-hidden="true"
                        >
                            02
                        </span>

                    </article>


                    {{-- BORROW --}}

                    <article
                        class="
                            feature-card
                            soft-surface
                        "
                        data-tone="navy"
                    >

                        <span class="icon-well">
                            <svg
                                class="icon"
                                aria-hidden="true"
                            >
                                <use href="#icon-exchange"/>
                            </svg>
                        </span>


                        <h3>
                            Borrow &amp; Return
                        </h3>


                        <p>
                            Track resource releases, borrower responsibility,
                            due dates, partial returns, and completed returns.
                        </p>


                        <span
                            class="feature-number"
                            aria-hidden="true"
                        >
                            03
                        </span>

                    </article>


                    {{-- PROJECTS --}}

                    <article
                        class="
                            feature-card
                            soft-surface
                        "
                        data-tone="gold"
                    >

                        <span class="icon-well">
                            <svg
                                class="icon"
                                aria-hidden="true"
                            >
                                <use href="#icon-project"/>
                            </svg>
                        </span>


                        <h3>
                            Project Logistics
                        </h3>


                        <p>
                            Follow approved activities from resource
                            allocation and readiness through completion.
                        </p>


                        <span
                            class="feature-number"
                            aria-hidden="true"
                        >
                            04
                        </span>

                    </article>


                    {{-- DONATIONS --}}

                    <article
                        class="
                            feature-card
                            soft-surface
                        "
                        data-tone="green"
                    >

                        <span class="icon-well">
                            <svg
                                class="icon"
                                aria-hidden="true"
                            >
                                <use href="#icon-gift"/>
                            </svg>
                        </span>


                        <h3>
                            Physical Donations
                        </h3>


                        <p>
                            Record, verify, allocate, and integrate donated
                            physical resources into PULSO logistics operations.
                        </p>


                        <span
                            class="feature-number"
                            aria-hidden="true"
                        >
                            05
                        </span>

                    </article>


                    {{-- REPORTS --}}

                    <article
                        class="
                            feature-card
                            soft-surface
                        "
                        data-tone="teal"
                    >

                        <span class="icon-well">
                            <svg
                                class="icon"
                                aria-hidden="true"
                            >
                                <use href="#icon-chart"/>
                            </svg>
                        </span>


                        <h3>
                            Reports &amp; History
                        </h3>


                        <p>
                            Review logistics activity, operational trends,
                            current records, and accountability history.
                        </p>


                        <span
                            class="feature-number"
                            aria-hidden="true"
                        >
                            06
                        </span>

                    </article>

                </div>

            </section>


            {{-- ========================================================
                 HOW IT WORKS
                 ======================================================== --}}

            <section
                class="workflow-section"
                id="workflow"
                aria-labelledby="workflow-title"
            >

                <div class="workflow-shell">

                    <div class="workflow-heading">

                        <p class="eyebrow">
                            ONE CONNECTED LOGISTICS FLOW
                        </p>


                        <h2 id="workflow-title">
                            From a request to a completed activity.
                        </h2>


                        <p>
                            PULSO Logistics Hub keeps each stage connected
                            so the Logistics Head can see what is needed,
                            where resources are, and what still requires action.
                        </p>

                    </div>


                    <div class="workflow-grid">

                        <article class="workflow-step">

                            <div class="workflow-step-top">

                                <span class="workflow-step-number">
                                    01
                                </span>


                                <span class="workflow-step-icon">
                                    <svg
                                        class="icon"
                                        aria-hidden="true"
                                    >
                                        <use href="#icon-list"/>
                                    </svg>
                                </span>

                            </div>


                            <h3>
                                Coordinate the need
                            </h3>


                            <p>
                                Review logistics requests, identify required
                                resources, and confirm what can be prepared.
                            </p>

                        </article>


                        <article class="workflow-step">

                            <div class="workflow-step-top">

                                <span class="workflow-step-number">
                                    02
                                </span>


                                <span class="workflow-step-icon">
                                    <svg
                                        class="icon"
                                        aria-hidden="true"
                                    >
                                        <use href="#icon-exchange"/>
                                    </svg>
                                </span>

                            </div>


                            <h3>
                                Prepare &amp; release
                            </h3>


                            <p>
                                Allocate resources to projects and record
                                borrowed reusable equipment when items leave custody.
                            </p>

                        </article>


                        <article class="workflow-step">

                            <div class="workflow-step-top">

                                <span class="workflow-step-number">
                                    03
                                </span>


                                <span class="workflow-step-icon">
                                    <svg
                                        class="icon"
                                        aria-hidden="true"
                                    >
                                        <use href="#icon-check"/>
                                    </svg>
                                </span>

                            </div>


                            <h3>
                                Track &amp; account
                            </h3>


                            <p>
                                Monitor projects, returns, donated resources,
                                and activity history until logistics work is complete.
                            </p>

                        </article>

                    </div>

                </div>

            </section>


            {{-- ========================================================
                 ACCESS
                 ======================================================== --}}

            <section
                class="
                    access-strip
                    glass
                "
                id="access"
                aria-labelledby="access-title"
            >

                <span class="icon-well">
                    <svg
                        class="icon"
                        aria-hidden="true"
                    >
                        <use href="#icon-lock"/>
                    </svg>
                </span>


                <div class="access-strip-copy">

                    <h2 id="access-title">

                        @if ($isLoggedIn)

                            Your workspace is ready.

                        @else

                            Authorized access to the Logistics Hub.

                        @endif

                    </h2>


                    <p>

                        @if ($isLoggedIn)

                            Continue managing resources, activities,
                            and logistics records.

                        @else

                            Sign in using your assigned Logistics Head account.
                            Contact your PULSO administrator if you need access.

                        @endif

                    </p>

                </div>


                <div class="access-strip-action">

                    <p class="access-motto">
                        Same community.<br>

                        <strong>
                            Bigger possibilities.
                        </strong>
                    </p>


                    <a
                        class="
                            button
                            button-primary
                        "
                        href="{{ $workspaceRoute }}"
                    >
                        {{ $workspaceLabel }}

                        <svg
                            class="icon"
                            aria-hidden="true"
                        >
                            <use href="#icon-arrow"/>
                        </svg>
                    </a>

                </div>

            </section>

        </main>


        {{-- ============================================================
             FOOTER
             ============================================================ --}}

        <footer class="site-footer">

            <a
                class="
                    brand
                    footer-brand
                "
                href="{{ route('home') }}"
                aria-label="PULSO Logistics Hub home"
            >
                <img
                    src="{{ asset('images/pulso-logo.png') }}"
                    width="40"
                    height="40"
                    alt=""
                >

                <span>
                    <strong>
                        PULSO
                    </strong>

                    <span>
                        Logistics Hub
                    </span>
                </span>
            </a>


            <p>
                PULSO Pagsanjan

                <span>
                    Supporting people. Equipping communities.
                </span>
            </p>


            <a href="{{ $workspaceRoute }}">

                {{ $isLoggedIn ? 'Open workspace' : 'Workspace access' }}

                <svg
                    class="icon"
                    aria-hidden="true"
                >
                    <use href="#icon-arrow"/>
                </svg>

            </a>

        </footer>

    </div>

</body>
</html>