<?php

function initSession(): void
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
}

function setUserSession(array $userData): void
{
    initSession();
    $_SESSION['user'] = $userData;
    $_SESSION['logged_in'] = true;
}

function getUserSession(): ?array
{
    initSession();
    return $_SESSION['user'] ?? null;
}

function isUserLoggedIn(): bool
{
    initSession();
    return !empty($_SESSION['logged_in']);
}

function logoutUser(): void
{
    initSession();
    $_SESSION = [];
    session_destroy();
}

function setFlashMessage($type, $message) {
    if (!isset($_SESSION)) {
        session_start();
    }
    $_SESSION['flash'][$type] = $message;
}

function getFlashMessage($type) {
    if (!isset($_SESSION)) {
        session_start();
    }
    if (isset($_SESSION['flash'][$type])) {
        $message = $_SESSION['flash'][$type];
        unset($_SESSION['flash'][$type]);
        return $message;
    }
    return null;
}

initSession();
