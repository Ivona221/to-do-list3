<?php
/**
 * Created by PhpStorm.
 * User: Athena
 * Date: 7/25/2017
 * Time: 8:27 PM
 */
namespace Repositories;


interface EventRepositoryInterface
{
    public function now();

    public function find();

    public function complete();

    public function incomplete();

    public function notcomplete();

    public function notcompleteWork();

    public function notcompleteHome();

    public function notcompleteSchool();

    public function notcompleteFreeTime();

}