<?php
/**
 * Created by PhpStorm.
 * User: imi
 * Date: 7/25/17
 * Time: 9:27 AM
 */

namespace Repositories;

interface TodoRepositoryInterface
{

    public function forUser(User $user);

    public function byDate( $date);

    public function count($date);

    public function find($id);

    public function user();

    public function byType($type);
}

