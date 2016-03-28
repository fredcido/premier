<?php

namespace PremierNewsletter\Controllers;

final class DashboardController extends AbstractController
{
    /**
     * Show list emails list.
     */
    public function index($id)
    {
        return view('@PremierNewsletter/dashboard/index.twig', ['gilson' => 'terra']);
    }
}
