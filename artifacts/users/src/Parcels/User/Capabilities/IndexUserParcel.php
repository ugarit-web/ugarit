<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Users\Parcels\User\Capabilities;

use Heritage\Parcels\QueryParcel;

/**
 * The criteria of the User listing, read from the query string with fromQuery():
 * `search`, `sort` (`-column` descending), `page`, `per_page` and the filters below.
 */
class IndexUserParcel extends QueryParcel
{
    /**
     * Create a new Parcel instance; each parameter is a filter, applied when it is not null.
     *
     * @param  int|null  $entity_id  Only the records with this entity_id.
     */
    public function __construct(
        public ?int $entity_id = null,
    ) {}

    /**
     * The columns the search term is matched against.
     *
     * @return array<int, string>
     */
    public function searchable(): array
    {
        return ['username'];
    }

    /**
     * The columns the listing may be sorted by.
     *
     * @return array<int, string>
     */
    public function sortable(): array
    {
        return ['username', 'created_at'];
    }
}
