<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\NetworkRouter
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $host
 * @property string $admin_username
 * @property string $admin_password
 * @property int $is_primary
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NetworkRouter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NetworkRouter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NetworkRouter query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NetworkRouter whereAdminPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NetworkRouter whereAdminUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NetworkRouter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NetworkRouter whereHost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NetworkRouter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NetworkRouter whereIsPrimary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NetworkRouter whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NetworkRouter whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\NetworkRouter whereUserId($value)
 */
	class NetworkRouter extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $level
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $api_token
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $username
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\NetworkRouter[] $network_routers
 * @property-read int|null $network_routers_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereApiToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUsername($value)
 */
	class User extends \Eloquent {}
}

namespace App{
/**
 * App\UserLog
 *
 * @property int $id
 * @property int $user_id
 * @property string $text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserLog whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserLog whereUserId($value)
 */
	class UserLog extends \Eloquent {}
}

