@php
    /*
    |--------------------------------------------------------------------------
    | LOGIN ERROR STATE
    |--------------------------------------------------------------------------
    |
    | The static/demo login route currently returns this exact message when
    | the supplied account does not match the Logistics Head credentials.
    | Keeping this separate prevents the same error from appearing twice.
    |
    */

    $credentialError =
        $errors->first('email') ===
        'Invalid email or password.';
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
        content="Sign in to the PULSO Logistics Hub workspace for authorized members and officers."
    >

    <title>Sign in — PULSO Logistics Hub</title>

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

    <link
        rel="stylesheet"
        href="{{ asset('css/login.css') }}"
    >

    <style>
        /* ============================================================
           LOGIN PAGE POLISH
           ============================================================ */

        .auth-page {
            min-height: 100vh;
            min-height: 100dvh;
        }


        .auth-shell {
            min-height: 100vh;
            min-height: 100dvh;
        }


        /*
        |--------------------------------------------------------------------------
        | HEADER
        |--------------------------------------------------------------------------
        */

        .auth-header {
            position: relative;
            z-index: 10;
        }


        .auth-back-link {
            min-height: 43px;

            padding:
                10px
                14px;

            border:
                1px
                solid
                rgba(255, 255, 255, .92);

            border-radius: 13px;

            background:
                linear-gradient(
                    145deg,
                    rgba(250, 253, 255, .9),
                    rgba(230, 240, 245, .9)
                );

            box-shadow:
                4px 5px 11px rgba(81, 114, 135, .1),
                -3px -3px 8px rgba(255, 255, 255, .72);

            color: #31546d;

            font-weight: 700;

            transition:
                color 160ms ease,
                transform 160ms ease,
                box-shadow 160ms ease;
        }


        .auth-back-link:hover {
            color: #007780;

            transform:
                translateY(
                    -1px
                );

            box-shadow:
                5px 7px 13px rgba(81, 114, 135, .12),
                -3px -3px 8px rgba(255, 255, 255, .76);
        }


        /*
        |--------------------------------------------------------------------------
        | MAIN LAYOUT
        |--------------------------------------------------------------------------
        */

        .auth-main {
            align-items: center;
        }


        .auth-story {
            align-self: center;
        }


        .auth-story-description {
            max-width: 520px;
        }


        /*
        |--------------------------------------------------------------------------
        | LOGIN PANEL
        |--------------------------------------------------------------------------
        */

        .auth-panel {
            position: relative;

            width: min(
                100%,
                460px
            );

            padding:
                clamp(
                    24px,
                    3vw,
                    31px
                );

            overflow: hidden;

            border:
                1px
                solid
                rgba(255, 255, 255, .96);

            border-radius: 25px;

            background:
                linear-gradient(
                    145deg,
                    rgba(249, 253, 255, .94),
                    rgba(231, 241, 246, .9)
                );

            box-shadow:
                10px 14px 30px rgba(67, 105, 127, .13),
                -6px -6px 16px rgba(255, 255, 255, .68),
                inset 1px 1px 2px rgba(255, 255, 255, .94);
        }


        .auth-panel::before {
            position: absolute;

            top: 0;
            right: 28px;

            width: 54px;
            height: 4px;

            border-radius:
                0
                0
                999px
                999px;

            background:
                linear-gradient(
                    90deg,
                    #05adb6,
                    #ee1280
                );

            opacity: .78;

            content: "";
        }


        /*
        |--------------------------------------------------------------------------
        | PANEL HEADING
        |--------------------------------------------------------------------------
        */

        .auth-panel-heading {
            margin-bottom: 22px;
        }


        .auth-heading-icon {
            margin-bottom: 13px;

            box-shadow:
                4px 5px 10px rgba(0, 119, 128, .1),
                -3px -3px 8px rgba(255, 255, 255, .72);
        }


        .auth-panel-heading .eyebrow {
            margin-bottom: 7px;
        }


        .auth-panel-heading h2 {
            margin:
                0
                0
                7px;

            color: #10263d;

            font-size:
                clamp(
                    27px,
                    3vw,
                    34px
                );

            font-weight: 850;

            letter-spacing: -.045em;
        }


        .auth-panel-description {
            margin: 0;

            color: #557188;

            font-size: 12.5px;
            line-height: 1.65;
        }


        /*
        |--------------------------------------------------------------------------
        | SESSION / SERVER MESSAGES
        |--------------------------------------------------------------------------
        */

        .auth-server-message {
            display: flex;
            align-items: flex-start;

            gap: 10px;

            margin-bottom: 17px;
            padding: 12px 13px;

            border:
                1px
                solid
                rgba(255, 255, 255, .9);

            border-radius: 13px;

            box-shadow:
                inset 1px 1px 2px rgba(255, 255, 255, .65);

            font-size: 10.5px;
            line-height: 1.6;
        }


        .auth-server-message svg {
            width: 17px;
            height: 17px;

            flex: 0 0 17px;

            margin-top: 1px;
        }


        .auth-server-message.info {
            border-color:
                rgba(5, 173, 182, .13);

            background:
                linear-gradient(
                    145deg,
                    #e6f7f8,
                    #d8edef
                );

            color: #006f77;
        }


        .auth-server-message.success {
            border-color:
                rgba(43, 115, 93, .13);

            background:
                linear-gradient(
                    145deg,
                    #e8f5ef,
                    #dceee6
                );

            color: #2b735d;
        }


        .auth-server-message.error {
            border-color:
                rgba(185, 12, 97, .14);

            background:
                linear-gradient(
                    145deg,
                    #fff0f5,
                    #f5dfe9
                );

            color: #a3195b;
        }


        /*
        |--------------------------------------------------------------------------
        | FORM
        |--------------------------------------------------------------------------
        */

        .auth-form {
            display: grid;

            gap: 17px;
        }


        .auth-field {
            margin: 0;
        }


        .auth-field > label {
            display: block;

            margin-bottom: 7px;

            color: #18344c;

            font-size: 11.5px;
            font-weight: 750;
        }


        /*
        |--------------------------------------------------------------------------
        | INPUTS
        |--------------------------------------------------------------------------
        */

        .auth-input-wrap {
            position: relative;

            display: flex;
            align-items: center;

            min-height: 50px;

            border:
                1px
                solid
                #ccdee7;

            border-radius: 14px;

            background:
                linear-gradient(
                    145deg,
                    #e8f1f6,
                    #edf5f9
                );

            box-shadow:
                inset 3px 3px 7px rgba(91, 125, 147, .11),
                inset -3px -3px 7px rgba(255, 255, 255, .83);

            transition:
                border-color 160ms ease,
                box-shadow 160ms ease,
                background 160ms ease;
        }


        .auth-input-wrap:hover {
            border-color:
                rgba(103, 161, 174, .42);
        }


        .auth-input-wrap:focus-within {
            border-color:
                rgba(0, 119, 128, .55);

            background:
                linear-gradient(
                    145deg,
                    #edf7fa,
                    #e8f3f7
                );

            box-shadow:
                inset 3px 3px 7px rgba(91, 125, 147, .09),
                inset -3px -3px 7px rgba(255, 255, 255, .86),
                0 0 0 4px rgba(5, 173, 182, .08);
        }


        .auth-input-icon {
            color: #648095;

            transition:
                color 160ms ease;
        }


        .auth-input-wrap:focus-within
        .auth-input-icon {
            color: #007780;
        }


        .auth-input-wrap input {
            min-height: 48px;

            color: #10263d;

            font-size: 13px;
        }


        .auth-input-wrap input::placeholder {
            color: #7690a3;
        }


        /*
        |--------------------------------------------------------------------------
        | ERROR INPUT STATE
        |--------------------------------------------------------------------------
        */

        .auth-input-wrap.has-error {
            border-color:
                rgba(
                    185,
                    12,
                    97,
                    .42
                ) !important;

            box-shadow:
                inset 3px 3px 7px rgba(91, 125, 147, .1),
                inset -3px -3px 7px rgba(255, 255, 255, .78),
                0 0 0 3px rgba(185, 12, 97, .07) !important;
        }


        .auth-field-error {
            margin:
                6px
                2px
                0;

            color: #a3195b;

            font-size: 9.5px;
            font-weight: 650;
            line-height: 1.5;
        }


        /*
        |--------------------------------------------------------------------------
        | PASSWORD TOGGLE
        |--------------------------------------------------------------------------
        */

        .auth-password-toggle {
            display: grid;
            place-items: center;

            width: 38px;
            height: 38px;

            flex: 0 0 38px;

            margin-right: 5px;

            border: 0;
            border-radius: 11px;

            background: transparent;

            color: #688297;

            cursor: pointer;

            transition:
                color 150ms ease,
                background 150ms ease,
                transform 150ms ease;
        }


        .auth-password-toggle:hover {
            background:
                rgba(
                    255,
                    255,
                    255,
                    .48
                );

            color: #007780;
        }


        .auth-password-toggle:active {
            transform:
                scale(
                    .95
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CAPS LOCK WARNING
        |--------------------------------------------------------------------------
        */

        .auth-caps-warning {
            display: flex;
            align-items: center;

            gap: 6px;

            margin:
                6px
                2px
                0;

            color: #895408;

            font-size: 9.5px;
            font-weight: 700;
            line-height: 1.4;
        }


        .auth-caps-warning[hidden] {
            display: none !important;
        }


        .auth-caps-warning svg {
            width: 13px;
            height: 13px;

            flex: 0 0 13px;
        }


        /*
        |--------------------------------------------------------------------------
        | HELP LINK
        |--------------------------------------------------------------------------
        */

        .auth-form-help {
            margin:
                -3px
                0
                0;

            text-align: right;
        }


        .auth-form-help button {
            padding: 0;

            border: 0;

            background: transparent;

            color: #007780;

            font: inherit;
            font-size: 10px;
            font-weight: 750;

            cursor: pointer;

            transition:
                color 150ms ease;
        }


        .auth-form-help button:hover {
            color: #b90c61;
        }


        /*
        |--------------------------------------------------------------------------
        | SUBMIT BUTTON
        |--------------------------------------------------------------------------
        */

        .auth-submit {
            position: relative;

            min-height: 47px;

            margin-top: 1px;

            overflow: hidden;
        }


        .auth-submit-content {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: 9px;
        }


        .auth-submit-spinner {
            display: none;

            width: 15px;
            height: 15px;

            flex: 0 0 15px;

            border:
                2px
                solid
                rgba(
                    255,
                    255,
                    255,
                    .42
                );

            border-top-color: #ffffff;

            border-radius: 50%;

            animation:
                auth-spin
                .75s
                linear
                infinite;
        }


        .auth-submit.is-loading
        .auth-submit-spinner {
            display: block;
        }


        .auth-submit.is-loading
        .auth-submit-arrow {
            display: none;
        }


        .auth-submit:disabled {
            opacity: .72;

            cursor: wait;

            transform: none !important;
        }


        @keyframes auth-spin {
            to {
                transform:
                    rotate(
                        360deg
                    );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | LIVE STATUS
        |--------------------------------------------------------------------------
        */

        .auth-form-status {
            min-height: 0;

            margin: 0;

            color: #007780;

            font-size: 9.5px;
            font-weight: 650;
            line-height: 1.5;

            text-align: center;
        }


        .auth-form-status:empty {
            display: none;
        }


        /*
        |--------------------------------------------------------------------------
        | EXPANDABLE ACCOUNT HELP
        |--------------------------------------------------------------------------
        */

        .auth-account-help {
            display: grid;

            grid-template-rows:
                0fr;

            margin-top: 19px;

            overflow: hidden;

            border:
                1px
                solid
                transparent;

            border-radius: 14px;

            background: transparent;

            opacity: 0;

            transition:
                grid-template-rows 200ms ease,
                opacity 180ms ease,
                margin 180ms ease,
                border-color 180ms ease,
                background 180ms ease,
                padding 180ms ease;
        }


        .auth-account-help.is-open {
            grid-template-rows:
                1fr;

            padding: 12px;

            border-color:
                rgba(
                    255,
                    255,
                    255,
                    .82
                );

            background:
                linear-gradient(
                    145deg,
                    #edf6fa,
                    #e5f0f4
                );

            box-shadow:
                inset 2px 2px 5px rgba(84, 118, 139, .05),
                inset -2px -2px 5px rgba(255, 255, 255, .62);

            opacity: 1;
        }


        .auth-account-help-inner {
            min-height: 0;
        }


        .auth-account-help-content {
            display: flex;
            align-items: flex-start;

            gap: 10px;
        }


        .auth-account-help h3 {
            margin:
                1px
                0
                3px;

            color: #18344c;

            font-size: 10.5px;
            font-weight: 800;
        }


        .auth-account-help p {
            margin: 0;

            color: #607b8f;

            font-size: 9.5px;
            line-height: 1.55;
        }


        /*
        |--------------------------------------------------------------------------
        | ACCESS CAPTION
        |--------------------------------------------------------------------------
        */

        .auth-access-caption {
            margin:
                17px
                0
                0;

            padding-top: 15px;

            border-top:
                1px
                solid
                rgba(
                    202,
                    222,
                    231,
                    .84
                );

            color: #7890a2;

            font-size: 8.8px;
            font-weight: 700;

            letter-spacing: .035em;

            text-align: center;

            text-transform: uppercase;
        }


        /*
        |--------------------------------------------------------------------------
        | FOOTER
        |--------------------------------------------------------------------------
        */

        .auth-footer {
            opacity: .86;
        }


        /*
        |--------------------------------------------------------------------------
        | KEYBOARD FOCUS
        |--------------------------------------------------------------------------
        */

        .auth-page
        a:focus-visible,
        .auth-page
        button:focus-visible,
        .auth-page
        input:focus-visible {
            outline:
                3px
                solid
                rgba(
                    238,
                    18,
                    128,
                    .25
                );

            outline-offset: 3px;
        }


        /*
        |--------------------------------------------------------------------------
        | RESPONSIVE
        |--------------------------------------------------------------------------
        */

        @media (max-width: 960px) {
            .auth-main {
                gap: 38px;
            }


            .auth-panel {
                width: min(
                    100%,
                    440px
                );
            }
        }


        @media (max-width: 760px) {
            .auth-main {
                align-items: stretch;

                gap: 30px;
            }


            .auth-story {
                max-width: 620px;

                text-align: center;
            }


            .auth-story-description {
                margin-right: auto;
                margin-left: auto;
            }


            .auth-panel {
                width:
                    min(
                        100%,
                        500px
                    );

                margin-right: auto;
                margin-left: auto;
            }
        }


        @media (max-width: 520px) {
            .auth-header {
                gap: 12px;
            }


            .auth-header .brand span span {
                display: none;
            }


            .auth-back-link {
                min-height: 40px;

                padding:
                    8px
                    11px;

                font-size: 10px;
            }


            .auth-panel {
                padding: 21px;

                border-radius: 21px;
            }


            .auth-panel-heading {
                margin-bottom: 19px;
            }


            .auth-panel-heading h2 {
                font-size: 27px;
            }


            .auth-field > label {
                font-size: 11px;
            }
        }


        @media (prefers-reduced-motion: reduce) {
            .auth-back-link,
            .auth-input-wrap,
            .auth-input-icon,
            .auth-password-toggle,
            .auth-account-help {
                transition: none;
            }


            .auth-submit-spinner {
                animation: none;
            }
        }
    </style>
</head>

<body class="auth-page">

    <a
        class="skip-link"
        href="#login-panel"
    >
        Skip to sign in
    </a>


    {{-- ============================================================
         ICON LIBRARY
         ============================================================ --}}

    <svg
        class="icon-library"
        xmlns="http://www.w3.org/2000/svg"
        aria-hidden="true"
    >

        <symbol
            id="icon-arrow-right"
            viewBox="0 0 24 24"
        >
            <path d="M4 12h16m-6-6 6 6-6 6"/>
        </symbol>


        <symbol
            id="icon-arrow-left"
            viewBox="0 0 24 24"
        >
            <path d="M20 12H4m6-6-6 6 6 6"/>
        </symbol>


        <symbol
            id="icon-mail"
            viewBox="0 0 24 24"
        >
            <rect
                x="3"
                y="5"
                width="18"
                height="14"
                rx="3"
            />

            <path d="m4 7 8 6 8-6"/>
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

            <path d="M8 10V7a4 4 0 0 1 8 0v3m-4 5v2"/>
        </symbol>


        <symbol
            id="icon-eye"
            viewBox="0 0 24 24"
        >
            <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/>

            <circle
                cx="12"
                cy="12"
                r="3"
            />
        </symbol>


        <symbol
            id="icon-eye-off"
            viewBox="0 0 24 24"
        >
            <path d="m3 3 18 18M10.6 10.6a2 2 0 0 0 2.8 2.8M9.8 5.2A11 11 0 0 1 12 5c6.5 0 10 7 10 7a18 18 0 0 1-3 3.8M6.3 6.3A19 19 0 0 0 2 12s3.5 7 10 7a12 12 0 0 0 5.7-1.7"/>
        </symbol>


        <symbol
            id="icon-info"
            viewBox="0 0 24 24"
        >
            <circle
                cx="12"
                cy="12"
                r="9"
            />

            <path d="M12 11v6m0-10v.1"/>
        </symbol>


        <symbol
            id="icon-check"
            viewBox="0 0 24 24"
        >
            <path d="m5 12 4 4L19 6"/>
        </symbol>


        <symbol
            id="icon-warning"
            viewBox="0 0 24 24"
        >
            <path d="M10.3 3.7 2.8 17a2 2 0 0 0 1.7 3h15a2 2 0 0 0 1.7-3L13.7 3.7a2 2 0 0 0-3.4 0Z"/>

            <path d="M12 9v4"/>
            <path d="M12 17h.01"/>
        </symbol>

    </svg>


    <div class="auth-shell">

        {{-- ============================================================
             HEADER
             ============================================================ --}}

        <header class="auth-header">

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


            <a
                class="auth-back-link"
                href="{{ route('home') }}"
            >
                <svg
                    class="icon"
                    aria-hidden="true"
                >
                    <use href="#icon-arrow-left"/>
                </svg>

                Back to home
            </a>

        </header>


        {{-- ============================================================
             MAIN
             ============================================================ --}}

        <main class="auth-main">

            {{-- ========================================================
                 LEFT CONTENT
                 ======================================================== --}}

            <section
                class="auth-story"
                aria-labelledby="auth-story-title"
            >
                <p class="eyebrow">
                    PULSO PAGSANJAN
                </p>


                <h1 id="auth-story-title">
                    Shared resources.<br>
                    Stronger communities.
                </h1>


                <p class="auth-story-description">
                    A shared space for the people, supplies, and
                    coordination behind every PULSO project.
                </p>
            </section>


            {{-- ========================================================
                 LOGIN PANEL
                 ======================================================== --}}

            <section
                class="auth-panel"
                id="login-panel"
                aria-labelledby="login-title"
                tabindex="-1"
            >

                <div class="auth-panel-heading">

                    <span class="icon-well teal auth-heading-icon">

                        <svg
                            class="icon"
                            aria-hidden="true"
                        >
                            <use href="#icon-lock"/>
                        </svg>

                    </span>


                    <p class="eyebrow">
                        YOUR PULSO WORKSPACE
                    </p>


                    <h2 id="login-title">
                        Welcome back.
                    </h2>


                    <p class="auth-panel-description">
                        Sign in using your assigned PULSO Logistics Hub account.
                    </p>

                </div>


                {{-- ====================================================
                     SESSION MESSAGES
                     ==================================================== --}}

                @if (session('auth_required'))

                    <div
                        class="
                            auth-server-message
                            info
                        "
                        role="status"
                    >
                        <svg
                            class="icon"
                            aria-hidden="true"
                        >
                            <use href="#icon-info"/>
                        </svg>


                        <span>
                            {{ session('auth_required') }}
                        </span>
                    </div>

                @endif


                @if (session('logout_success'))

                    <div
                        class="
                            auth-server-message
                            success
                        "
                        role="status"
                    >
                        <svg
                            class="icon"
                            aria-hidden="true"
                        >
                            <use href="#icon-check"/>
                        </svg>


                        <span>
                            {{ session('logout_success') }}
                        </span>
                    </div>

                @endif


                @if ($credentialError)

                    <div
                        class="
                            auth-server-message
                            error
                        "
                        role="alert"
                    >
                        <svg
                            class="icon"
                            aria-hidden="true"
                        >
                            <use href="#icon-warning"/>
                        </svg>


                        <span>
                            The email or password you entered is incorrect.
                            Please check your credentials and try again.
                        </span>
                    </div>

                @endif


                {{-- ====================================================
                     LOGIN FORM
                     ==================================================== --}}

                <form
                    class="auth-form"
                    id="login-form"
                    action="{{ route('login.submit') }}"
                    method="POST"
                >
                    @csrf


                    {{-- ==================================================
                         EMAIL
                         ================================================== --}}

                    <div class="auth-field">

                        <label for="login-email">
                            Email address
                        </label>


                        <div
                            class="
                                auth-input-wrap

                                @if (
                                    $errors->has('email')
                                    &&
                                    !$credentialError
                                )
                                    has-error
                                @endif
                            "
                        >

                            <svg
                                class="icon auth-input-icon"
                                aria-hidden="true"
                            >
                                <use href="#icon-mail"/>
                            </svg>


                            <input
                                id="login-email"
                                name="email"
                                type="email"
                                value="{{ old('email') }}"
                                placeholder="you@example.com"
                                autocomplete="username"
                                inputmode="email"
                                autocapitalize="none"
                                spellcheck="false"
                                maxlength="254"

                                @if (
                                    $errors->has('email')
                                    &&
                                    !$credentialError
                                )
                                    aria-invalid="true"
                                @endif

                                required
                            >

                        </div>


                        @if (
                            $errors->has('email')
                            &&
                            !$credentialError
                        )

                            <p class="auth-field-error">
                                {{ $errors->first('email') }}
                            </p>

                        @endif

                    </div>


                    {{-- ==================================================
                         PASSWORD
                         ================================================== --}}

                    <div class="auth-field">

                        <label for="login-password">
                            Password
                        </label>


                        <div
                            class="
                                auth-input-wrap

                                @if ($errors->has('password'))
                                    has-error
                                @endif
                            "
                        >

                            <svg
                                class="icon auth-input-icon"
                                aria-hidden="true"
                            >
                                <use href="#icon-lock"/>
                            </svg>


                            <input
                                id="login-password"
                                name="password"
                                type="password"
                                placeholder="Enter your password"
                                autocomplete="current-password"

                                @if ($errors->has('password'))
                                    aria-invalid="true"
                                @endif

                                required
                            >


                            <button
                                class="auth-password-toggle"
                                id="toggle-password"
                                type="button"
                                aria-label="Show password"
                                aria-controls="login-password"
                                aria-pressed="false"
                            >
                                <svg
                                    class="icon"
                                    aria-hidden="true"
                                >
                                    <use
                                        id="password-visibility-icon"
                                        href="#icon-eye"
                                    />
                                </svg>
                            </button>

                        </div>


                        @if ($errors->has('password'))

                            <p class="auth-field-error">
                                {{ $errors->first('password') }}
                            </p>

                        @endif


                        <p
                            class="auth-caps-warning"
                            id="caps-lock-warning"
                            role="status"
                            hidden
                        >
                            <svg
                                class="icon"
                                aria-hidden="true"
                            >
                                <use href="#icon-warning"/>
                            </svg>

                            Caps Lock is on.
                        </p>

                    </div>


                    {{-- ==================================================
                         HELP
                         ================================================== --}}

                    <div class="auth-form-help">

                        <button
                            id="toggle-account-help"
                            type="button"
                            aria-expanded="false"
                            aria-controls="account-help"
                        >
                            Trouble signing in?
                        </button>

                    </div>


                    {{-- ==================================================
                         SUBMIT
                         ================================================== --}}

                    <button
                        class="
                            button
                            button-primary
                            auth-submit
                        "
                        id="login-submit"
                        type="submit"
                    >
                        <span class="auth-submit-content">

                            <span
                                class="auth-submit-spinner"
                                aria-hidden="true"
                            ></span>


                            <span id="login-submit-label">
                                Sign in
                            </span>


                            <svg
                                class="
                                    icon
                                    auth-submit-arrow
                                "
                                aria-hidden="true"
                            >
                                <use href="#icon-arrow-right"/>
                            </svg>

                        </span>
                    </button>


                    <p
                        class="auth-form-status"
                        id="login-status"
                        role="status"
                        aria-live="polite"
                        aria-atomic="true"
                    ></p>

                </form>


                {{-- ====================================================
                     EXPANDABLE HELP
                     ==================================================== --}}

                <div
                    class="auth-account-help"
                    id="account-help"
                    aria-hidden="true"
                >
                    <div class="auth-account-help-inner">

                        <div class="auth-account-help-content">

                            <span class="icon-well small">

                                <svg
                                    class="icon"
                                    aria-hidden="true"
                                >
                                    <use href="#icon-info"/>
                                </svg>

                            </span>


                            <div>

                                <h3>
                                    Need an account or a password reset?
                                </h3>


                                <p>
                                    Contact your PULSO administrator for
                                    assistance with account access or password
                                    recovery.
                                </p>

                            </div>

                        </div>

                    </div>
                </div>


                <p class="auth-access-caption">
                    Authorized PULSO Logistics Head access only.
                </p>

            </section>

        </main>


        {{-- ============================================================
             FOOTER
             ============================================================ --}}

        <footer class="auth-footer">

            <p>
                PULSO Pagsanjan · Logistics Hub
            </p>


            <p>
                Supporting people. Equipping communities.
            </p>

        </footer>

    </div>


    {{-- ================================================================
         LOGIN INTERACTIONS
         ================================================================ --}}

    <script>
        (() => {
            const initializeLogin = () => {
                const form =
                    document.getElementById(
                        'login-form'
                    );


                const email =
                    document.getElementById(
                        'login-email'
                    );


                const password =
                    document.getElementById(
                        'login-password'
                    );


                const passwordToggle =
                    document.getElementById(
                        'toggle-password'
                    );


                const passwordIcon =
                    document.getElementById(
                        'password-visibility-icon'
                    );


                const capsWarning =
                    document.getElementById(
                        'caps-lock-warning'
                    );


                const helpButton =
                    document.getElementById(
                        'toggle-account-help'
                    );


                const helpPanel =
                    document.getElementById(
                        'account-help'
                    );


                const submitButton =
                    document.getElementById(
                        'login-submit'
                    );


                const submitLabel =
                    document.getElementById(
                        'login-submit-label'
                    );


                const status =
                    document.getElementById(
                        'login-status'
                    );


                if (
                    !form ||
                    !email ||
                    !password
                ) {
                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | PASSWORD VISIBILITY
                |--------------------------------------------------------------------------
                */

                passwordToggle?.addEventListener(
                    'click',
                    () => {
                        const isVisible =
                            password.type ===
                            'text';


                        password.type =
                            isVisible
                                ? 'password'
                                : 'text';


                        passwordToggle.setAttribute(
                            'aria-pressed',
                            String(
                                !isVisible
                            )
                        );


                        passwordToggle.setAttribute(
                            'aria-label',
                            isVisible
                                ? 'Show password'
                                : 'Hide password'
                        );


                        if (
                            passwordIcon
                        ) {
                            passwordIcon.setAttribute(
                                'href',
                                isVisible
                                    ? '#icon-eye'
                                    : '#icon-eye-off'
                            );
                        }


                        password.focus();
                    }
                );


                /*
                |--------------------------------------------------------------------------
                | CAPS LOCK WARNING
                |--------------------------------------------------------------------------
                */

                const updateCapsLock = (
                    event
                ) => {
                    if (
                        !capsWarning ||
                        typeof event.getModifierState !==
                            'function'
                    ) {
                        return;
                    }


                    capsWarning.hidden =
                        !event.getModifierState(
                            'CapsLock'
                        );
                };


                password.addEventListener(
                    'keydown',
                    updateCapsLock
                );


                password.addEventListener(
                    'keyup',
                    updateCapsLock
                );


                password.addEventListener(
                    'blur',
                    () => {
                        if (
                            capsWarning
                        ) {
                            capsWarning.hidden =
                                true;
                        }
                    }
                );


                /*
                |--------------------------------------------------------------------------
                | EXPANDABLE ACCOUNT HELP
                |--------------------------------------------------------------------------
                */

                helpButton?.addEventListener(
                    'click',
                    () => {
                        if (
                            !helpPanel
                        ) {
                            return;
                        }


                        const isOpen =
                            helpPanel.classList.toggle(
                                'is-open'
                            );


                        helpButton.setAttribute(
                            'aria-expanded',
                            String(
                                isOpen
                            )
                        );


                        helpPanel.setAttribute(
                            'aria-hidden',
                            String(
                                !isOpen
                            )
                        );


                        helpButton.textContent =
                            isOpen
                                ? 'Hide sign-in help'
                                : 'Trouble signing in?';
                    }
                );


                /*
                |--------------------------------------------------------------------------
                | REMOVE FIELD ERROR APPEARANCE WHILE EDITING
                |--------------------------------------------------------------------------
                */

                const clearFieldError = (
                    input
                ) => {
                    const wrapper =
                        input.closest(
                            '.auth-input-wrap'
                        );


                    wrapper?.classList.remove(
                        'has-error'
                    );


                    input.removeAttribute(
                        'aria-invalid'
                    );
                };


                email.addEventListener(
                    'input',
                    () => {
                        clearFieldError(
                            email
                        );
                    }
                );


                password.addEventListener(
                    'input',
                    () => {
                        clearFieldError(
                            password
                        );
                    }
                );


                /*
                |--------------------------------------------------------------------------
                | SUBMIT STATE
                |--------------------------------------------------------------------------
                */

                form.addEventListener(
                    'submit',
                    () => {
                        if (
                            submitButton.disabled
                        ) {
                            return;
                        }


                        submitButton.disabled =
                            true;


                        submitButton.classList.add(
                            'is-loading'
                        );


                        if (
                            submitLabel
                        ) {
                            submitLabel.textContent =
                                'Signing in...';
                        }


                        if (
                            status
                        ) {
                            status.textContent =
                                'Checking your account...';
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
                    initializeLogin,
                    {
                        once: true
                    }
                );
            } else {
                initializeLogin();
            }
        })();
    </script>

</body>
</html>