<?php
/**
 * Created by PhpStorm.
 * User: imi
 * Date: 7/25/17
 * Time: 9:27 AM
 */

namespace Repositories;

interface OcasionRepositoryInterface
{


    public function name($id);

    public function time($id);

    public function date($id);

    public function place($id);

    public function complete();

    public function incomplete();

    public function create($data);

    public function notcomplete();

    public function organizerId($id);

    public function notcompleteWork();

    public function notcompleteHome();

    public function notcompleteSchool();

    public function notcompleteFreeTime();





}