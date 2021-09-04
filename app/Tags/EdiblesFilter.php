<?php

namespace App\Tags;

use Statamic\Facades\Entry;
use Statamic\Support\Arr;
use Statamic\Tags\Concerns;
use Statamic\Tags\Tags;

class EdiblesFilter extends Tags
{
    use Concerns\OutputsItems;

    /**
     * The {{ edibles_filter }} tag.
     *
     * Get an array of Edibles entry items, filtered by the 'colours' array query string.
     *
     * In Antlers, include the "logic" parameter to define "and" or "or" behaviour.
     *
     * @return array
     */
    public function index()
    {
        // set up the query for the "edibles" collection
        $edibles = Entry::query()
            ->where('collection', 'edibles');

        // get the params we need, and santize them
        $params = Arr::sanitize($this->context->get('get'));

        // if we have colours, and it is an array, and there's at least 1
        if (array_key_exists('colours', $params) && is_array($params['colours']) && count($params['colours']) > 0) {

            // what logic are we trying to run?
            $logic = $this->params->get('logic', 'and');

            if ($logic == 'or') {
                // running as "or" logic
                $colours = [];

                // add each colour to the "or" array
                foreach ($params['colours'] as $colour) {
                    $colours[] = 'colours::'.$colour;
                }

                // add for "or" logic
                $edibles = $edibles->whereTaxonomyIn($colours);
            } else {
                // default fallback to "and" logic

                // loop through each colour, and explicitly query
                foreach ($params['colours'] as $colour) {
                    $edibles = $edibles->whereTaxonomy('colours::'.$colour);
                }
            }
        }

        // paginate if needed
        if ($this->params->get('paginate', false)) {
            // look for "limit", or default to 10
            $edibles = $edibles->paginate($this->params->get('limit', 10));
        } else {
            // just get the edibles
            $edibles = $edibles->get();
        }

        // output using the OutputsItems concern
        return $this->output($edibles);
    }


    /**
     * The {{ edibles_filter:logic }} tag.
     *
     * Outputs a pretty string of the query terms and logic type.
     *
     * This has been written purely for the demo purposes.
     *
     * @return string
     */
    public function logic()
    {
        // get the params we need, and santize them
        $params = Arr::sanitize($this->context->get('get'));

        if (array_key_exists('colours', $params) && is_array($params['colours']) && count($params['colours']) > 0) {
            // convert to a collection
            $colours = collect($params['colours']);

            // return what we're looking at
            return '<em>'.$colours->join(
                    '</em>, <em>',
                    '</em> <strong>'.$this->params->get('logic', 'and').'</strong> <em>').'</em>';
        } else {
            return 'everything';
        }
    }
}
