<?php
namespace App\Helpers;

class Pagination {
    public static $limit = 5;
    static function paginate($request, $query) {
        $page      = ($request->getParam('page', 0) > 0) ? $request->getParam('page') : 1;
        $limit     = self::$limit;
        $skip      = ($page - 1) * $limit;
        $count     = $query->count();
        $lastpage = (ceil($count / $limit) == 0 ? 1 : ceil($count / $limit));

        return [
            'type'          => 1,
            'needed'        => $count > $limit,
            'count'         => $count,
            'page'          => $page,
            'lastpage'      => $lastpage,
            'limit'         => $limit,
            'skip'          => $skip
        ];
    }
}