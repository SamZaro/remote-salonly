@push('head')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
    body { margin: 0; padding: 0; }

    .lp-bg {
        min-height: 100vh;
        background-color: #f9fafb;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 3rem 1.25rem;
        position: relative;
    }

    .lp-back {
        position: absolute;
        top: 1.5rem;
        right: 2rem;
        font-family: 'Outfit', sans-serif;
        font-size: .6875rem;
        font-weight: 400;
        letter-spacing: .12em;
        text-transform: uppercase;
        color: #71717a;
        text-decoration: none;
        transition: color .2s ease;
    }
    .lp-back:hover { color: #374151; }

    .lp-card {
        width: 100%;
        max-width: 420px;
        background: #ffffff;
        border-radius: 6px;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(0,0,0,.08), 0 1px 3px rgba(0,0,0,.06);
        animation: lp-rise .7s cubic-bezier(.16,1,.3,1) both;
    }
    @keyframes lp-rise {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0);    }
    }

    .lp-header {
        padding: 2.25rem 2.5rem 1.875rem;
        border-bottom: 1px solid #f1f1f3;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .lp-sub {
        font-family: 'Outfit', sans-serif;
        font-size: .6875rem;
        color: #a1a1aa;
        letter-spacing: .11em;
        text-transform: uppercase;
        margin-top: .5rem;
        text-align: center;
    }

    .lp-body {
        padding: 2rem 2.5rem 2.5rem;
    }

    .lp-body label,
    .lp-body .label span,
    .lp-body .form-control label {
        font-family: 'Outfit', sans-serif !important;
        font-size: .6875rem !important;
        font-weight: 500 !important;
        letter-spacing: .09em !important;
        text-transform: uppercase !important;
        color: #71717a !important;
    }
    .lp-body input[type="email"],
    .lp-body input[type="password"],
    .lp-body input[type="text"] {
        font-family: 'Outfit', sans-serif !important;
        font-size: .9375rem !important;
        font-weight: 300 !important;
        border: 1px solid #e4e4e7 !important;
        border-radius: 6px !important;
        padding: .75rem 1rem !important;
        width: 100% !important;
        background: #fafafa !important;
        color: #0b0c0e !important;
        transition: border-color .2s ease, box-shadow .2s ease, background .2s ease !important;
        outline: none !important;
        box-shadow: none !important;
    }
    .lp-body input[type="email"]:focus,
    .lp-body input[type="password"]:focus,
    .lp-body input[type="text"]:focus {
        border-color: #f97316 !important;
        box-shadow: 0 0 0 3px rgba(249,115,22,.13) !important;
        background: #ffffff !important;
    }
    .lp-body a {
        color: #f97316;
        font-family: 'Outfit', sans-serif;
        font-size: .75rem;
        text-decoration: none;
        transition: opacity .15s ease;
    }
    .lp-body a:hover { opacity: .75; }
    .lp-body .btn,
    .lp-body button[type="submit"],
    .lp-body input[type="submit"] {
        font-family: 'Outfit', sans-serif !important;
        font-size: .75rem !important;
        font-weight: 500 !important;
        letter-spacing: .13em !important;
        text-transform: uppercase !important;
        background: #f97316 !important;
        border: none !important;
        border-radius: 6px !important;
        color: #ffffff !important;
        padding: .9375rem 2rem !important;
        width: 100% !important;
        cursor: pointer !important;
        transition: background .2s ease, transform .1s ease !important;
    }
    .lp-body .btn:hover,
    .lp-body button[type="submit"]:hover { background: #ea580c !important; }
    .lp-body .btn:active,
    .lp-body button[type="submit"]:active { transform: scale(.99) !important; }
    .lp-body .checkbox {
        border-radius: 0 !important;
        border-color: #d4d4d8 !important;
        accent-color: #f97316;
    }
    .lp-body .divider {
        font-family: 'Outfit', sans-serif;
        font-size: .625rem;
        letter-spacing: .1em;
        text-transform: uppercase;
        color: #a1a1aa;
    }

    .lp-footer {
        font-family: 'Outfit', sans-serif;
        font-size: .625rem;
        color: #9ca3af;
        letter-spacing: .08em;
        margin-top: 1.75rem;
        text-align: center;
    }
</style>
@endpush
