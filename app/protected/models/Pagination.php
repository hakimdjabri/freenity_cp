<?php
class Pagination extends BaseModel
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public function getPages($count,$limit,$offset)
    {
        $count_pages = ceil($count / $limit);
        $page = ceil($offset / $limit);
        $pages = [];
        $last = $count_pages - $page - 1;
        $first = $page;
        $to = $first < 2 ? 4 - $first : 2;
        $from = $last < 2 ? 4 - $last : 2;
        for($i = $page - $from; $i <= $page + $to; $i++)
        {
            if($i >= 0 && $i < $count_pages)
            {
                if($page != $i)
                    $pages[] = [$i,$limit,0];
                else
                    $pages[] = [$i,$limit,1];
            }
        }
        return $pages;
    }
}
