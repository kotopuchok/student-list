<?php

class LinkHelper
{
  private $sort;
  private $search;
  private $page;

  public function __construct($search, $sort, $page)
  {
    $this->search = $search;
    $this->sort = $sort;
    $this->page = $page;
  }

  private function buildRef($sort, $search, $page)
  {
    $uriPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)  . '?';
    $ref = $uriPath . http_build_query([
      'sort' => $sort,
      'search' => $search,
      'page' => $page
    ]);
    return $ref;
  }

  public function getSortLink($title, $a, $b)
  {
    $sort = $this->sort;
    $search = $this->search;
    $page = $this->page;

    if ($sort == $a) {
      $sort = $b;
      $ref = $this->buildRef($sort, $search, $page);
      return '<a href="' . htmlspecialchars($ref) . '">' . $title . ' <i>▲</i></a>';
    } elseif ($sort == $b) {
      $sort = $a;
      $ref = $this->buildRef($sort, $search, $page);
      return '<a href="' . htmlspecialchars($ref) . '">' . $title . ' <i>▼</i></a>';
    } else {
      $sort = $a;
      $ref = $this->buildRef($sort, $search, $page);
      return '<a href="' . htmlspecialchars($ref) . '">' . $title . '</a>';
    }
  }


  public function getPageLink($page)
  {
    $uriPath = '/?';
    $link = $uriPath . http_build_query([
      'search' => $this->search,
      'sort' => $this->sort,
      'page' => $page
    ]);
    return $link;
  }
}
