<?php
namespace PremierNewsletter\Controllers;

use Herbert\Framework\Models\Post;
use PremierNewsletter\Helper;

class DashboardController {

    /**
     * Show list emails list
     */
    public function index($id)
    {
        return view('@PremierNewsletter/dashboard/index.twig', ['gilson' => 'terra']);
    }
}
