<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Users\Parcels\User\Capabilities;

use Heritage\Parcels\Parcel;

/**
 * The User attributes to save: an attached model is updated, otherwise one is created.
 *
 * Built with fromArray()/fromRequest(), the parcel remembers which keys were provided:
 * toAttributes() returns only those, so a key sent as null clears its column while an
 * omitted key leaves it untouched.
 */
class SaveUserParcel extends Parcel
{
    /**
     * Create a new Parcel instance.
     *
     * @param  int|null  $id  The record identifier.
     * @param  int|null  $entity_id  The entity_id column.
     * @param  string|null  $username  The username column.
     */
    public function __construct(
        public ?int $id = null,
        public ?int $entity_id = null,
        public ?string $username = null,
    ) {}
}
