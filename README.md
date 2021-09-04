# Demo of AND and OR logic when working with Taxonomies in Statamic 3

![Statamic 3.0+](https://img.shields.io/badge/Statamic-3.0+-FF269E?style=for-the-badge&link=https://statamic.com)

Sometimes you need greater flexibility and control when filtering a collection based on a taxonomy (or even multiple
taxonomies).

Within your own tag, it is easy to build your own query using Statamic's EntryQueryBuilder that can perform different
query logic (AND or OR) on your taxonomies to determine whether your filters become stricter (AND) or broader (OR).

For more information, check out my [filtering entries by Taxonomy in Statamic 3 using AND or OR logic](https://www.martyfriedel.com/blog/filtering-entries-by-taxonomy-in-statamic-3-using-and-or-logic).

## Run the demo

If you're reading this, you're probably already in the Statamic and/or Laravel way of thinking, so this should be
straight forward.

1. Clone the repo, and configure your server as you normally would
2. Create and configure your `.env` as necessary
3. Run `composer install`
4. Run `npm install`
5. Build the assets with `npm run production`
6. If you want to log in to the Control Panel, make yourself a user with `php please make:user`

## License

This addon is licensed under the MIT license.
