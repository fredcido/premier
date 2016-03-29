<?php
namespace PremierNewsletter\Grids;

use WP_List_Table;

class ListGrid extends WP_List_Table
{

/**
 * Plugin settings page.
 */
public function plugin_settings_page()
{
    ?>
	<div class="wrap">
		<h2>WP_List_Table Class Example</h2>

		<div id="poststuff">
			<div id="post-body" class="metabox-holder columns-2">
				<div id="post-body-content">
					<div class="meta-box-sortables ui-sortable">
						<form method="post">
							<?php
                            $this->customers_obj->prepare_items();
    $this->customers_obj->display();
    ?>
						</form>
					</div>
				</div>
			</div>
			<br class="clear">
		</div>
	</div>
<?php

}

    /**
     * Display the list table page.
     */
    public function list_table_page()
    {
        //$exampleListTable = new ListGrid2();
        $this->prepare_items();
        ?>
            <div class="wrap">
                <div id="icon-users" class="icon32"></div>
                <h2>Controleler</h2>
                <p class="search-box">
                    <label class="screen-reader-text" for="search_id-search-input">
                    search:</label>
                    <input id="search_id-search-input" type="text" name="s" value="" />
                    <input id="search-submit" class="button" type="submit" name="" value="search" />
                    </p>
                <?php $this->display(); ?>
            </div>
        <?php

    }

    /** Text displayed when no customer data is available */
    public function no_items()
    {
        _e('No customers avaliable.', 'sp');
    }

/**
 * Render the bulk edit checkbox.
 *
 * @param array $item
 *
 * @return string
 */
public function column_cb($item)
{
    return sprintf(
    '<input type="checkbox" name="bulk-delete[]" value="%s" />', $item['ID']
  );
}

    /**
     * Returns an associative array containing the bulk action.
     *
     * @return array
     */
    public function get_bulk_actions()
    {
        $actions = [
        'bulk-delete' => 'Delete',
      ];

        return $actions;
    }

    /**
     * Prepare the items for the table to process.
     */
    public function prepare_items()
    {
        $columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();

        $data = $this->table_data();
        usort($data, array(&$this, 'sort_data'));

        $perPage = 5;
        $currentPage = $this->get_pagenum();
        $totalItems = count($data);

        $this->set_pagination_args(array(
            'total_items' => $totalItems,
            'per_page' => $perPage,
        ));

        $data = array_slice($data, (($currentPage - 1) * $perPage), $perPage);

        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->items = $data;
    }

    /**
     * Override the parent columns method. Defines the columns to use in your listing table.
     *
     * @return array
     */
    public function get_columns()
    {
        $columns = array(
            //'cb'      => '<input type="checkbox" />',
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'year' => 'Year',
            'director' => 'Director',
            'rating' => 'Rating',
        );

        return $columns;
    }

    /**
     * Define which columns are hidden.
     *
     * @return array
     */
    public function get_hidden_columns()
    {
        return array();
    }

    /**
     * Define the sortable columns.
     *
     * @return array
     */
    public function get_sortable_columns()
    {
        return array('title' => array('title', false));
    }

    /**
     * Get the table data.
     *
     * @return array
     */
    private function table_data()
    {
        $data = array();

        $data[] = array(
                    'id' => 1,
                    'title' => 'The Shawshank Redemption',
                    'description' => 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.',
                    'year' => '1994',
                    'director' => 'Frank Darabont',
                    'rating' => '9.3',
                    );


        $data[] = array(
                    'id' => 5,
                    'title' => 'The Good, the Bad and the Ugly',
                    'description' => 'A bounty hunting scam joins two men in an uneasy alliance against a third in a race to find a fortune in gold buried in a remote cemetery.',
                    'year' => '1966',
                    'director' => 'Sergio Leone',
                    'rating' => '9.0',
                    );

        $data[] = array(
                    'id' => 6,
                    'title' => 'The Dark Knight',
                    'description' => 'When Batman, Gordon and Harvey Dent launch an assault on the mob, they let the clown out of the box, the Joker, bent on turning Gotham on itself and bringing any heroes down to his level.',
                    'year' => '2008',
                    'director' => 'Christopher Nolan',
                    'rating' => '9.0',
                    );

        $data[] = array(
                    'id' => 7,
                    'title' => '12 Angry Men',
                    'description' => 'A dissenting juror in a murder trial slowly manages to convince the others that the case is not as obviously clear as it seemed in court.',
                    'year' => '1957',
                    'director' => 'Sidney Lumet',
                    'rating' => '8.9',
                    );

        $data[] = array(
                    'id' => 8,
                    'title' => 'Schindler\'s List',
                    'description' => 'In Poland during World War II, Oskar Schindler gradually becomes concerned for his Jewish workforce after witnessing their persecution by the Nazis.',
                    'year' => '1993',
                    'director' => 'Steven Spielberg',
                    'rating' => '8.9',
                    );

        $data[] = array(
                    'id' => 9,
                    'title' => 'The Lord of the Rings: The Return of the King',
                    'description' => 'Gandalf and Aragorn lead the World of Men against Sauron\'s army to draw his gaze from Frodo and Sam as they approach Mount Doom with the One Ring.',
                    'year' => '2003',
                    'director' => 'Peter Jackson',
                    'rating' => '8.9',
                    );

        $data[] = array(
                    'id' => 10,
                    'title' => 'Fight Club',
                    'description' => 'An insomniac office worker looking for a way to change his life crosses paths with a devil-may-care soap maker and they form an underground fight club that evolves into something much, much more...',
                    'year' => '1999',
                    'director' => 'David Fincher',
                    'rating' => '8.8',
                    );

        return $data;
    }

    /**
     * Define what data to show on each column of the table.
     *
     * @param array  $item        Data
     * @param string $column_name - Current column name
     *
     * @return mixed
     */
    public function column_default($item, $column_name)
    {
        switch ($column_name) {
            case 'id':
            case 'title':
            case 'description':
            case 'year':
            case 'director':
            case 'rating':
                return $item[ $column_name ];

            default:
                return print_r($item, true);
        }
    }

    /**
     * Allows you to sort the data by the variables set in the $_GET.
     *
     * @return mixed
     */
    private function sort_data($a, $b)
    {
        // Set defaults
        $orderby = 'title';
        $order = 'asc';

        // If orderby is set, use this as the sort column
        if (!empty($_GET['orderby'])) {
            $orderby = $_GET['orderby'];
        }

        // If order is set use this as the order
        if (!empty($_GET['order'])) {
            $order = $_GET['order'];
        }

        $result = strnatcmp($a[$orderby], $b[$orderby]);

        if ($order === 'asc') {
            return $result;
        }

        return -$result;
    }
}
