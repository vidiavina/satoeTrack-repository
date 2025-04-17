<style>
    /* SIDEBAR */
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');
    @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap");
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');

    :root {
        --header-height: 5rem;
        --nav-width: 68px;
        --sidebar-expanded-width: 224px;
        --first-color: #326CBC;
        --first-color-light: #AFA5D9;
        --white-color: #F7F6FB;
        --secondary-color: #719099;
        --msr-font: "Montserrat", sans-serif;
        --inter: "Inter", sans-serif;
        --body-font: "Nunito", sans-serif;
        --header-font: "Montserrat", sans-serif;
        --normal-font-size: 1rem;
        --z-fixed: 100
    }

    .secondary-color {
        color: var(--secondary-color);
    }

    .msr-font {
        font-family: "Montserrat", sans-serif;
    }

    .inter {
        font-family: "Inter", sans-serif;
    }

    *,
    ::before,
    ::after {
        box-sizing: border-box
    }

    body {
        position: relative;
        margin: var(--header-height) 0 0 0;
        padding: 0 1rem;
        font-family: var(--body-font);
        font-size: var(--normal-font-size);
        transition: .5s;
        background-color: var(--white-color);
    }

    a {
        text-decoration: none
    }

    .header {
        width: 100%;
        height: var(--header-height);
        position: fixed;
        top: 0;
        left: 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 1rem;
        background-color: white;
        z-index: var(--z-fixed);
        transition: .5s;
        box-shadow: 0px 0px 8px 0px rgba(0, 0, 0, 0.3);

    }


    .header_left {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        padding: 0 1rem 0 0;
    }

    .header_toggle {
        margin-top: 10px;
        color: var(--first-color);
        font-size: 1.5rem;
        cursor: pointer
    }

    .header_text {
        outline: 0 !important;
        font-family: var(--msr-font);
        background: linear-gradient(45deg, #07A4E3, #38C8F1);
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-size: 40px;
        font-weight: bold;
        padding: 0 1.5rem;
    }

    .header_img {
        width: 70px;
        display: flex;
        justify-content: end;
        overflow: hidden
    }

    .l-navbar {
        position: fixed;
        top: 0;
        left: -30%;
        width: var(--nav-width);
        height: 100vh;
        background-color: var(--first-color);
        padding: .5rem 1rem 0 0;
        transition: .5s;
        z-index: var(--z-fixed)
    }

    .nav {
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        overflow: auto;
        scrollbar-width: none;
    }

    .nav_logo,
    .nav_link {
        display: grid;
        grid-template-columns: max-content max-content;
        align-items: center;
        column-gap: 1rem;
        padding: .5rem 0 .5rem 1.5rem
    }

    .nav_logo {
        margin-top: 10px;
        margin-bottom: 2rem;
    }

    .nav-logo-avatar {
        display: flex;
        justify-content: flex-start;
        width: 25px;
    }

    .nav_logo-icon {
        font-size: 1.25rem;
        color: var(--white-color)
    }

    .nav_logo-name {
        color: var(--white-color);
        font-weight: 700
    }

    .nav_link {
        position: relative;
        color: var(--first-color-light);
        margin-bottom: .8rem;
        transition: .3s
    }

    .nav_link:hover {
        font-weight: bold !important;
        color: var(--white-color)
    }

    .nav_icon {
        font-size: 1.25rem
    }

    .show-custom {
        left: 0
    }

    .body-pd {
        padding-left: calc(var(--nav-width) + 1rem)
    }

    .active {
        font-weight: bold !important;
        color: var(--white-color)
    }

    .active::before {
        content: '';
        position: absolute;
        left: 0;
        width: 2px;
        height: 32px;
        background-color: var(--white-color)
    }

    .height-100 {
        height: 100vh
    }

    /* Accordion menu styling */
    .nav_accordion {
        position: relative;
        width: 100%;
    }

    .accordion-toggle {
        display: grid;
        grid-template-columns: max-content 1fr max-content;
        justify-content: space-between;
        cursor: pointer;
    }

    .nav_accordion-icon {
        transition: transform 0.3s;
        justify-self: end;
        margin-right: 10px;
    }

    .accordion-toggle.active .nav_accordion-icon {
        transform: rotate(180deg);
    }

    .accordion-menu {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease, opacity 0.2s ease;
        opacity: 0;
    }

    .accordion-menu.open {
        max-height: 500px;
        /* Adjust as needed */
        opacity: 1;
    }

    .sub-link {
        padding-left: 2.5rem;
        font-size: 0.9rem;
        opacity: 0.85;
        margin-bottom: 0.3rem;
    }

    .sub-link:hover {
        opacity: 1;
    }

    /* Responsive Styles */
    @media screen and (min-width: 576px) {

        /* Styles for screens 576px and larger */
        body {
            padding-left: calc(var(--nav-width) + 1rem);
            transition: padding-left 0.3s ease-in-out;
        }

        body.body-expanded {
            padding-left: calc(var(--sidebar-expanded-width) + 1rem);
        }

        .header {
            padding-left: calc(var(--nav-width) + 1rem);
            transition: padding-left 0.3s ease-in-out;
        }

        .header.header-expanded {
            padding-left: calc(var(--sidebar-expanded-width) + 1rem);
        }

        .l-navbar {
            left: 0;
            width: var(--nav-width);
            transition: width 0.3s ease-in-out;
        }

        .l-navbar:hover,
        .l-navbar.expanded {
            width: var(--sidebar-expanded-width);
        }

        /* Hide text in collapsed state */
        .nav_name,
        .nav_logo-name {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease;
            white-space: nowrap;
        }

        /* Show text in expanded state */
        .l-navbar:hover .nav_name,
        .l-navbar:hover .nav_logo-name,
        .l-navbar.expanded .nav_name,
        .l-navbar.expanded .nav_logo-name {
            opacity: 1;
            visibility: visible;
        }

        /* Accordion icon visibility */
        .nav_accordion-icon {
            opacity: 0;
            visibility: hidden;
        }

        .l-navbar:hover .nav_accordion-icon,
        .l-navbar.expanded .nav_accordion-icon {
            opacity: 1;
            visibility: visible;
        }
    }

    .welcome {
        display: flex;
        align-items: flex-start;
        justify-content: flex-start;
    }

    .arrow {
        font-size: 40px;
        color: black;
        margin-right: 15px;
    }

    .title h1 {
        font-family: var(--header-font);
        font-size: 44px;
        color: #6c7a89;
        font-weight: bold;
        margin: 0;
    }

    .title p {
        font-size: 28px;
        color: #a0a5ad;
        margin: 0;
    }


    .cards {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 20px;

    }

    .line {
        width: 1px;
        height: 75%;
        background: var(--first-color-light);
        position: absolute;
        left: 30px;
    }

    .text {
        font-size: 45px;
        font-weight: bold;
        color: #6c7a89;
        font-family: var(--body-font);

    }

    .jurusan {
        font-size: 20px;
        color: #6c7a89;
        font-family: var(--body-font);
        padding-left: 20px;
    }


    main {
        padding-top: 1rem;
    }

    @media screen and (min-width: 768px) {
        body {
            margin: calc(var(--header-height) + 1rem) 0 0 0;
        }

        .header {
            height: calc(var(--header-height) + 1rem);
            padding: 0 2rem 0 calc(var(--nav-width) + 2rem);
        }

        .header.header-expanded {
            padding-left: calc(var(--sidebar-expanded-width) + 2rem);
        }

        .l-navbar {
            padding: 1rem 1rem 0 0
        }

        .show-custom {
            width: calc(var(--nav-width) + 156px)
        }

        .body-pd {
            padding-left: calc(var(--nav-width) + 188px)
        }

    }

    /* GENERAL */
    .d-flex-center {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .d-flex-jend {
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    .select2-container {
        width: 100% !important;
    }

    .select2-container .select2-selection--single {
        height: 35px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 35px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 33px;
    }

    .tooltip.fade {
        transition: opacity .17s ease-out;
    }

    .tooltip .tooltip-inner {
        font-family: var(--inter) !important;
        font-size: 1rem;
    }

    .dropify-wrapper {
        font-family: var(--inter) !important;
    }

    .dropify-wrapper span>p {
        font-size: 1rem !important;
    }

    /* BUTTONS */
    .btn-main {
        display: flex;
        align-items: center;
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        border: none;
        border-radius: 8px;
        background: linear-gradient(45deg, #07A4E3, #38C8F1);
        color: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease-in-out;
        cursor: pointer;
    }

    .btn-main:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.25);
    }

    .btn-main:active {
        transform: scale(0.98);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    div.dt-container .dt-paging .dt-paging-button:hover,
    div.dt-container .dt-paging .dt-paging-button:active {
        border-color: #07A4E3;
        background: linear-gradient(45deg, #07A4E3, #38C8F1);
    }

    .role-badge {
        display: inline-flex;
        justify-content: center;
        padding: 8px 20px;
        border-radius: 20px;
        background: rgba(7, 164, 227, 0.1);
        color: #07A4E3;
        font-weight: bold;
    }

    .role-badge.purple {
        background: rgba(156, 39, 176, 0.1);
        color: #9c27b0;
    }

    .role-badge.green {
        background: rgba(76, 175, 80, 0.1);
        color: #4CAF50;
    }

    .role-badge.gray {
        background: rgba(0, 0, 0, 0.125);
        color: #555;
    }
</style>