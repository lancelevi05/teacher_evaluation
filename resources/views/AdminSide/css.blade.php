<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&amp;display=swap" rel="stylesheet">
<link
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap"
    rel="stylesheet">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html,
    body {
        height: 100%;
        font-family: 'DM Sans', sans-serif;
    }

    .app-wrapper {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        background: #edf2f7;
        overflow: auto;
    }

    .app-body {
        flex: 1;
        display: flex;
        min-height: 0;
    }

    /* Sidebar */
    .sidebar {
        width: 240px;
        min-width: 240px;
        background: #1e3a5f;
        color: #c9daf0;
        display: flex;
        flex-direction: column;
        height: 100vh;
        /* Full viewport height */
        overflow-y: auto;
        /* Enable vertical scrolling */
        overflow-x: hidden;
        /* Prevent horizontal scroll */

    }

    .sidebar-brand {
        padding: 24px 20px 20px;
        font-size: 20px;
        font-weight: 700;
        color: #fff;
        letter-spacing: -.3px;
        border-bottom: 1px solid rgba(255, 255, 255, .08);
    }

    /* .sidebar-nav {
            padding: 16px 12px;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 2px;
        } */

    .sidebar-nav {
        flex: 1;
        overflow-y: auto;
        /* padding: 16px 12px; */
        padding: 16px 12px 80px;
        /* bottom padding */
    }

    .nav-label {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #7aa3cc;
        padding: 12px 12px 6px;
        font-weight: 600;
    }

    .nav-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 12px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        color: #b0cceb;
        cursor: pointer;
        transition: background .15s, color .15s;
        text-decoration: none;
    }

    .nav-item:hover {
        background: rgba(255, 255, 255, .07);
        color: #fff;
    }

    .nav-item.active {
        background: #2c6fba;
        color: #fff;
    }

    .nav-icon {
        width: 18px;
        height: 18px;
        opacity: .7;
    }

    .nav-item.active .nav-icon {
        opacity: 1;
    }

    /* Main */
    .main-area {
        flex: 1;
        display: flex;
        flex-direction: column;
        overflow-y: auto;
    }

    .top-bar {
        background: #fff;
        padding: 16px 32px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #dce6f0;
    }

    .top-bar-title {
        font-size: 16px;
        font-weight: 600;
        color: #1e3a5f;
    }

    .avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #2c6fba;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 14px;
    }

    /* Dropdown container */
    .nav-dropdown {
        position: absolute;
        right: 20px;
        top: 60px;
        width: 180px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        display: none;
        overflow: hidden;
        z-index: 999;
    }

    /* Items */
    .nav-dropdown .dropdown-item {
        display: block;
        padding: 12px 15px;
        text-decoration: none;
        color: #333;
        font-size: 14px;
        background: none;
        border: none;
        width: 100%;
        text-align: left;
        cursor: pointer;
    }

    /* Hover */
    .nav-dropdown .dropdown-item:hover {
        background: #f5f5f5;
    }

    /* Logout style */
    .logout-btn {
        color: #e74c3c;
    }

    .content {
        flex: 1;
        padding: 28px 32px;
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    /*HOME PAGE CSS*/
    .welcome-card {
        background: linear-gradient(135deg, #2c6fba 0%, #1e3a5f 100%);
        border-radius: 14px;
        padding: 32px 36px;
        color: #fff;
    }

    .welcome-card h1 {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .welcome-card p {
        font-size: 14px;
        color: #b8d4f0;
        line-height: 1.6;
    }

    .cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 16px;
    }

    .stat-card {
        background: #fff;
        border-radius: 12px;
        padding: 22px 24px;
        border: 1px solid #dce6f0;
    }

    .stat-label {
        font-size: 12px;
        color: #6889a8;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    .stat-value {
        font-size: 28px;
        font-weight: 700;
        color: #1e3a5f;
        margin-top: 6px;
    }

    .activity-item{
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.activity-date{
    color: #6b7280;
    font-size: 0.9rem;
    white-space: nowrap;
}

    .stat-change {
        font-size: 12px;
        color: #2c9c6a;
        margin-top: 4px;
        font-weight: 500;
    }

    

    .section-card {
        background: #fff;
        border-radius: 12px;
        padding: 24px;
        border: 1px solid #dce6f0;
    }

    .section-card h2 {
        font-size: 16px;
        font-weight: 600;
        color: #1e3a5f;
        margin-bottom: 16px;
    }

    .activity-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 0;
        border-bottom: 1px solid #edf2f7;
        font-size: 13px;
        color: #4a6a87;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #2c6fba;
        flex-shrink: 0;
    }

    /* Expand Button */
    .expand-button {
        background: #2c6fba;
        color: #fff;
        border: none;
        padding: 12px 16px;
        cursor: pointer;
        font-weight: 600;
        font-size: 13px;
        border-radius: 8px;
        transition: background .2s, max-height .3s ease;
        align-self: flex-start;
        margin-bottom: 4px;
    }

    .expand-button:hover {
        background: #1e3a5f;
    }

    .expand-panel {
        background: #f0f5fb;
        border-radius: 8px;
        padding: 0 16px;
        max-height: 0;
        overflow: hidden;
        transition: max-height .3s ease, padding .3s ease;
        margin-bottom: 16px;
    }

    .expand-panel.open {
        max-height: 300px;
        padding: 16px;
    }

    .expand-line {
        padding: 8px 0;
        border-bottom: 1px solid #dce6f0;
        font-size: 13px;
        color: #4a6a87;
        line-height: 1.5;
    }

    .expand-line:last-child {
        border-bottom: none;
    }

    /* Footer */
    .app-footer {
        background: #1e3a5f;
        color: #7aa3cc;
        padding: 14px 32px;
        font-size: 12px;
        text-align: center;
        border-top: 1px solid rgba(255, 255, 255, .06);
    }

    /* Mobile Menu Toggle */
    .mobile-menu-btn {
        display: none;
        background: none;
        border: none;
        cursor: pointer;
        padding: 8px;
        color: #1e3a5f;
        font-size: 20px;
    }

    .sidebar.mobile-open {
        transform: translateX(0);
    }

    @media(max-width:768px) {
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            min-width: 0;
            height: auto;
            max-height: 100vh;
            z-index: 1000;
            overflow-y: auto;
            transform: translateY(-100%);
            transition: transform .3s ease;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .15);
        }

        .sidebar.mobile-open {
            transform: translateY(0);
        }

        .mobile-menu-btn {
            display: block;
        }

        .app-body {
            position: relative;
        }

        .content {
            padding: 20px 16px;
            gap: 16px;
        }

        .top-bar {
            padding: 14px 16px;
        }

        .welcome-card {
            padding: 20px 16px;
        }

        .welcome-card h1 {
            font-size: 20px;
        }

        .welcome-card p {
            font-size: 13px;
        }

        .cards-grid {
            grid-template-columns: 1fr;
        }

        .stat-card {
            padding: 18px 16px;
        }

        .stat-value {
            font-size: 24px;
        }

        .section-card {
            padding: 20px 16px;
        }

        .app-footer {
            padding: 12px 16px;
            font-size: 11px;
        }

        .activity-item {
            padding: 8px 0;
            font-size: 12px;
        }
    }

    @media(max-width:480px) {
        .sidebar {
            width: 100%;
        }

        .top-bar {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }

        .top-bar-title {
            font-size: 14px;
        }

        .avatar {
            align-self: flex-end;
        }

        .welcome-card h1 {
            font-size: 18px;
            margin-bottom: 4px;
        }

        .welcome-card {
            padding: 16px 12px;
        }

        .stat-label {
            font-size: 11px;
        }

        .stat-value {
            font-size: 20px;
        }

        .section-card h2 {
            font-size: 14px;
        }
    }
    /*HOME PAGE CSS// */





    /* ===== HEADER n SEARCH BAR ===== */

    .section-header01 {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        gap: 20px;
        flex-wrap: wrap;
    }

    .section-title01 h2 {
        margin: 0;
        font-size: 32px;
        font-weight: 700;
        color: #222;
    }

    .section-title01 p {
        margin-top: 5px;
        color: #777;
        font-size: 15px;
    }

    .section-actions01 {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .search-input01 {
        width: 250px;
        padding: 10px 14px;
        border: 1px solid #dcdcdc;
        border-radius: 6px;
        font-size: 14px;
        outline: none;
    }

    .search-input01:focus {
        border-color: #4f46e5;
    }

    .search-btn01 {
        width: 42px;
        height: 42px;
        border: 1px solid #dcdcdc;
        background: #fff;
        border-radius: 6px;
        cursor: pointer;
        font-size: 18px;
    }

    .search-btn01:hover {
        background: #f4f4f4;
    }

    .add-btn01 {
        padding: 10px 18px;
        background: #4f46e5;
        color: #fff;
        border: none;
        border-radius: 6px;
        font-size: 15px;
        cursor: pointer;
        font-weight: 600;
    }

    .add-btn01:hover {
        background: #4338ca;
    }

    /* ===== MOBILE ===== */

    @media(max-width:768px) {

        .section-header01 {
            flex-direction: column;
            align-items: flex-start;
        }

        .section-actions01 {
            width: 100%;
        }

        .search-input01 {
            flex: 1;
            width: 100%;
        }
    }




    .success-msg {
        background: #d4edda;
        color: #155724;
        padding: 10px;
        border-radius: 6px;
        margin-bottom: 15px;
    }

    .error-msg {
        background: #edd9d4;
        color: #721c24;
        padding: 10px;
        border-radius: 6px;
        margin-bottom: 15px;
    }


    


    
</style>
<style>
    body {
        box-sizing: border-box;
    }
</style>
<script src="https://cdn.tailwindcss.com/3.4.17" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/lucide@0.263.0/dist/umd/lucide.min.js" type="text/javascript"></script>
<script src="/_sdk/data_sdk.js" type="text/javascript"></script>