<!doctype html>
@props(['title' => null, 'pageNav' => null])
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @php
        $pageTitle = $title ?: $setting->name;
    @endphp
    <title>{{ $pageTitle }}</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f2f2e2;
            margin: 0 0 30px;
        }

        body > * {
            padding-left: 1em;
            padding-right: 1em;
        }

        nav {
            padding: 0;
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            overflow-x: auto;
            background-color: #9abef2;
        }

        nav > * {
            margin-top: auto;
            margin-bottom: auto;
            padding: 20px;
            color: black;
        }

        main {
            width: 80%;
            margin: auto;
        }

        a {
            text-decoration: none;
        }

        p {
            margin-top: 0.7em;
            margin-bottom: 0.7em;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        tr:not(:last-child) {
            border-bottom: 1px solid;
        }

        th, td {
            padding: 5px;
            text-align: left;
        }

        textarea {
            width: 50em;
            height: 15em;
            font-size: 1em;
        }

        input[type=text] {
            width: 50em;
            font-family: monospace;
            font-size: 1em;
        }

        .logo {
            margin: 0;
            padding: 5px;
            padding-left: 15px;
            font-size: 3em;
            font-weight: bold;
        }

        table.form {
            border-collapse: unset;
            width: auto;
        }

        table.form > * > tr > td, th {
            vertical-align: top;
        }

        .comment {
            margin-top: 15px;
            margin-bottom: 15px;
            padding-left: 10px;
            border-left: 1px dotted;
        }

        .validation-error {
            color: #ff4646;
        }

        .flash.success {
            background-color: lightgreen;
            border-radius: 5px;
            padding: 8px;
        }

        .flash.error {
            background-color: #ff4646;
            border-radius: 5px;
            padding: 8px;
        }

        .login {
            width: 50%;
        }

        .login input[type=text], .login input[type=password] {
            width: 90%;
        }

        /* Abuse checkboxes to collapse comments */
        .collapse {
            appearance: none;
            cursor: pointer;
        }

        .collapse:checked + * {
            display: none
        }

        .collapse:after {
            content: '[-]';
        }

        .collapse:checked:after {
            content: '[+]';
        }

        .small {
            font-size: 85%;
        }

        .page-nav {
            margin: 15px 0;
        }

        .page-nav > * + *::before {
            display: inline-block;
            content: '>';
            opacity: 0.6;
            padding: 0 5px;
        }

        .markdown pre {
            background-color: #fffff1;
            padding: 1em;
            line-height: 1.5;
        }
    </style>
</head>
<body>

<nav>
    <a class="logo" href="/">A</a>
    <div style="margin:auto"></div>
    @auth
        <a href="{{ route('user.edit', ['user' => request()->user()]) }}">{{ request()->user()->name }}</a>
        <span> | </span>
    @endauth
    @can('admin')
        <a href="{{ route('admin.index') }}">管理面板</a>
        <span> | </span>
    @endcan
    @auth
        <a href="{{ route('logout') }}">退出</a>
        <span> | </span>
    @endauth
    @guest
        @can('register')
            <a href="{{ route('register') }}">注册</a>
            <span> | </span>
        @endcan
        <a href="{{ route('login') }}">登陆</a>
        <span> | </span>
    @endguest
    <a href="{{ route('help') }}">帮助</a>
</nav>

<main>
    {{ $pageNav }}

    <h1>{{ $pageTitle }}</h1>

    @if(session('success'))
        <p class="flash success">{{ session('success') }}</p>
    @endif

    {{ $slot }}
</main>

</body>
</html>
