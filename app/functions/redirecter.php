<?php
declare(strict_types=1);
// Simple page redirect
function redirect($page): void
{
    header('location: ' . URLROOT . '/' . $page);
}