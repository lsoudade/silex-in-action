<?php

namespace Project\Lib;

class Paginator
{
    const DEFAULT_NB_ROWS_PER_PAGE = 10,
          DEFAULT_NB_PAGES_SIDES   = 5;
    
    protected $pageNumber,
              $currentPage,
              $currentMinRow,
              $rowNumber,
              $pageNumberSides,
              $route;

    /**
     * @param array $rows Results from database
     * @param int $currentPage Current Page number
     * @param int $rowsPerPage Defines how many rows are displayed on a Page
     * @param mixed $pageNumberSides Defines how many pages are displayed on 
     * the paginator on left & right of the current Page. May be null if no limit.
     * @param string $route Specifies a route to build pagination on (for example, if paginator view is on a different route than displayed Page)
     * @params array $parameters Get parameters can be set to the route
     */
    public function __construct($rows, $currentPage, $rowsPerPage = self::DEFAULT_NB_ROWS_PER_PAGE, $pageNumberSides = self::DEFAULT_NB_PAGES_SIDES, $route = null, $parameters = null) 
    {
        $this->currentPage     = $currentPage;
        $this->pageNumberSides = $pageNumberSides;
        $this->rowNumber       = count($rows);
        $this->pageNumber      = ceil($this->rowNumber / $rowsPerPage);
        $this->rows            = array_slice($rows, ($this->getPreviousPage()*$rowsPerPage), $rowsPerPage, true);
        $this->route           = $route;
        $this->parameters      = $parameters;
    }
    
    /**
     * Returns number of pages
     * 
     * @return int
     */
    public function getPageNumber() 
    {
        return $this->pageNumber;
    }
    
    public function getCurrentPage() 
    {
        return $this->currentPage;
    }
    
    public function getPreviousPage() 
    {
        return $this->currentPage-1;
    }
    
    public function getNextPage() 
    {
        return $this->currentPage+1;
    }
    
    public function getRowNumber() 
    {
        return $this->rowNumber;
    }
    
    public function isFirstPage() 
    {
        return $this->getCurrentPage() == 1;
    }
    
    public function isLastPage() 
    {
        return $this->getCurrentPage() == $this->getPageNumber();
    }
    
    public function getPageNumberSides() 
    {
        return $this->pageNumberSides;
    }
    
    public function getRoute() 
    {
        return $this->route;
    }
    
    public function getParameters() 
    {
        return $this->parameters;
    }
    
    /**
     * Indicates if pagination block must be displayed or not
     * Condition is many pages to display
     * 
     * @return boolean
     */
    public function displayable()
    {
        return $this->getPageNumber() > 1;
    }
    
    /**
     * Returns an array of all the Page numbers to return for the paginator
     * 
     * @return array
     */
    public function getPages() 
    {
        $pages = array();
        for ( $i = 1 ; $i <= $this->getPageNumber() ; $i++ ) {
            // Take care of maximum Page number defined
            if ( is_null($this->getPageNumberSides()) ||
                 ( $i >= ($this->getCurrentPage()-$this->getPageNumberSides()) &&  // Pages before current Page
                   $i <= ($this->getCurrentPage()+$this->getPageNumberSides()) ) ) { // Pages after current Page
                $pages[] = $i;
            }
        }
        
        return $pages;
    }
    
    /**
     * Returns an array of all the current rows to return, according to number 
     * of rows per Page
     * 
     * @return array
     */
    public function getRows() 
    {
        return $this->rows;
    }
}