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

    public function byDate( $date);

    public function count($date);

    public function find($id);

    public function user();

    public function byType($type);

    public function create($data);

    public function complete();

    public function incomplete();

    public function order();

    public function notcomplete();
}

