<?php
namespace PremierNewsletter\Controllers;

use Herbert\Framework\Models\Post;
use PremierNewsletter\Helper;

class ListController {

    /**
     * Show list emails list
     */
    public function list($id)
    {
        return view('@PremierNewsletterList/list.twig', ['gilson' => 'terra']);
    }
}
