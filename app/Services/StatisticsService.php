<?php


namespace App\Services;


use App\Statistic;

class StatisticsService
{
    public function getQtdPosts()
    {
        return Statistic::where('type','POST')->count();
    }

    public function getQtdPut()
    {
        return Statistic::where('type','PUT')->count();
    }

    public function getQtdDelete()
    {
        return Statistic::where('type','DELETE')->count();
    }

    public function getQtdGet()
    {
        return Statistic::where('type','GET')->count();
    }
}